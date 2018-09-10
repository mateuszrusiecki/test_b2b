<?php

//App::uses('FebEmail', 'Lib');		
App::uses('AppController', 'Controller');

class TestController extends AppController {
    
    public $autoRender = false;
    
    public $components = array('FebEmail');
    
    public $uses = array(
        'Comment',
    );
    
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('sendCommentsEmails');
    }
    
    /**
     * Pobieranie komentarzy
     */
    public function getComments(){
        
        return $this->Comment->find('all', array(
            'conditions' => array(
                'Comment.email_confirmed' => 0
            ),
            'recursive' => 2,
            'joins' => array(
                array(
                    'table' => 'versions',
                    'alias' => 'Version',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Comment.version_id = Version.id',
                    )
                ),
                array(
                    'table' => 'views',
                    'alias' => 'View',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Version.view_id = View.id',
                    )
                ),
                array(
                    'table' => 'projects',
                    'alias' => 'Project',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'View.project_id = Project.id',
                    )
                ),
                array(
                    'table' => 'user_users',
                    'alias' => 'Manager',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Project.manager_id = Manager.id',
                    )
                )
            ),
            'fields' => array(
                'Comment.id',
                'Comment.content',
                'Comment.version_id',
                'Comment.created',
                'Comment.modified',
                'Comment.email_confirmed',
                'Comment.*',         
                'Version.id',
                'Version.view_id',
                'View.id',
                'View.project_id',
                'Project.id',
                'Project.manager_id',
                'Project.title',
                'Manager.id',
                'Manager.email',
            )
            
        ));
    }
    
    /**
     * Funkcja przygotowująca dane do wysyłki maili. Który koordynator, w jakich projektach, otrzymał ile jakich komentarzy
     * 
     * @param array $comments        tablica pobranych wcześniej komentarzy
     * @return array                 dane koordynatorów
     */
    public function prepareCoordinatorsData($comments){
              
        $coordinatorsData = array();
        
        foreach($comments as $comment){
           $coordinatorEmail = $comment['Manager']['email'];
           $projectTitle = $comment['Project']['title'];
           
           if(!isset($coordinatorsData[$coordinatorEmail])){
               $coordinatorsData[$coordinatorEmail] = array();
           }
           
           if(!isset($coordinatorsData[$coordinatorEmail][$projectTitle])){
               $coordinatorsData[$coordinatorEmail][$projectTitle] = array();
           }         
           
           $coordinatorsData[$coordinatorEmail][$projectTitle][] = array(
               'id' => $comment['Comment']['id'],
               'content' => $comment['Comment']['content'],
               'created' => $comment['Comment']['created'],
               'modified' => $comment['Comment']['modified'],
           );
        }
        
        $oneDimensionData = array();
        
        foreach($coordinatorsData as $email => $record){
            
            foreach($record as $project => $comments){
                
                $oneDimensionData[] = array(

                    'coordinatorEmail' => $email,
                    'projectName' => $project,
                    'comments' => $comments,

                );
            }
            

        }
        
        return $oneDimensionData;
    }
    
    /**
     * Funkcja uruchamiająca się w cronie. Wysyłająca sumaryczne maile z komentarzami do koordynatorów projektów
     * 
     * @return void
     */
    public function sendCommentsEmails(){
        
        $comments = $this->getComments();
        
	$coordinatorsData = $this->prepareCoordinatorsData($comments);       
          
        foreach($coordinatorsData as $record){
            
                foreach($record['comments'] AS $comment){

                    $this->Comment->id = $comment['id'];
                    $this->Comment->saveField('email_confirmed', 1);              
                }
 
                $subject = 'Nowe komentarze do projektu ' . $record['projectName'];
                //$to[] = 'm.rudzik@feb.net.pl';
                $to[] = 'mkustra0@gmail.com';
                $to[] = $record['coordinatorEmail'];
                $template = 'gc_confirm';
                $from = null;
                $sender = null;
                $emailFormat = 'html';
                $debug = false;
                $data['commentsCount'] = sizeof($record['comments']);
                $data['projectName'] = $record['projectName'];
                $return = $this->FebEmail->sendFastEmail($subject, $to, $template, $data, $from, $sender, $emailFormat, $debug);
                $this->FebEmail->reset();
                //debug($return);
            
        }
		
    }
}