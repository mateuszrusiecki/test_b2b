<?php

App::uses('FebEmail', 'Lib');		
App::uses('NewClientsAppController', 'NewClients.Controller');

class EmailsController extends NewClientsAppController {
    
    public $autoRender = false;
    
    //public $components = array('FebEmail');
    public $components = array('RequestHandler','FebEmail');
    
    public $uses = array(
        'NewClients.Comment',
    );
    
    public function testing(){
        
        $subject = 'Jakis tam email';
        $to = 'mkustra0@gmail.com';
        //$to[] = $record['coordinatorEmail'];
        $template = 'gc_change_version_status';
        $from = null;
        $sender = null;
        $emailFormat = 'html';
        $debug = false;
        $data = array();
        $return = $this->FebEmail->sendFastEmail($subject, $to, $template, $data, $from, $sender, $emailFormat, $debug);
        $this->FebEmail->reset();
        echo 'aaa';
        die();
    }
    
    /**
     * Pobieranie komentarzy do potwierdzenia mailowego
     * 
     * @return array             lista komentarzy
     */
    private function getComments(){
        
        return $this->Comment->find('all', array(
                'conditions' => array(
                    'Comment.email_confirmed' => 0
                ),
                'fields' => array(
                    'Comment.id',
                    'Comment.content',
                    'Comment.version_id',
                    'Comment.created',
                    'Comment.modified',
                    'Comment.email_confirmed',
                ),
                'contain' => array(
                    'Version' => array(
                        'fields' => array(
                            'Version.id',
                            'Version.view_id',
                            'Version.view_id',
                        ),
                        'View' => array(
                            'fields' => array(
                                'View.id',
                                'View.project_id',
                            ),
                            'Project' => array(
                                'fields' => array(
                                    'Project.id',
                                    'Project.manager_id',
                                    'Project.title',
                                ),
                                'Manager' => array(
                                    'fields' => array(
                                        'Manager.id',
                                        'Manager.email',
                                    )
                                )
                            )                               
                        )                    
                    )
                )
            )
        );
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
           $coordinatorEmail = $comment['Version']['View']['Project']['Manager']['email'];
           $projectTitle = $comment['Version']['View']['Project']['title'];
           
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
        
        return $coordinatorsData;
    }
    
    /**
     * Funkcja uruchamiająca się w cronie. Wysyłająca sumaryczne maile z komentarzami do koordynatorów projektów
     * 
     * @return void
     */
    public function sendCommentsEmails(){
        
        foreach (array(10, 20, 30, 40, 50, 60, 70, 80, 90, 100) as $i)
        {

            //$to[] = "<mkustra0@gmail.com>";
            $subject = 'test';
            $to = 'd.czyz@febdev.pl';
            $to = 'm.kustra@febdev.pl';
            $template = 'gc_confirm';
            $from = null;
            $sender = null;
            $emailFormat = 'html';
            $debug = false;
            $data['commentsCount'] = $i;
            $data['projectName'] = 'teststttttt'.$i;
            $return = $this->FebEmail->sendFastEmail($subject, $to, $template, $data, $from, $sender, $emailFormat, $debug);
            debug($return);
        }
        
        exit();
    }
}    