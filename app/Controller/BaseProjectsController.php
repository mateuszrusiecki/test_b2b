<?php

App::uses('AppController', 'Controller');
App::uses('QqFileUploader', 'Uploader');

/**
 * BaseProjectsController Controller
 */
class BaseProjectsController extends AppController
{
    
    public $uses = array('UserUser', 'BaseProject');
    
    var $helpers = array(
        'Recaptcha.CaptchaTool',
        'FebForm',
        'FebTinyMce4',
    );
    
    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }
    
    /**
     * Lista bazy projektów
     */
    public function index()           
    {
        $title = $subtitle = 'Baza projektów';

        $session = $this->Session->read();
        $user_permission = $session['user_permission'];
        
        if ($this->request->is('post'))
        {

            $baseProjects = $this->BaseProject->getBaseProjects();

            $this->set(compact('baseProjects'));
            $this->set('_serialize', array('baseProjects'));
        } else
        {

            $this->set(compact('title', 'subtitle', 'user_permission'));
        }
    } 
    
    /**
     * Pomocnicza funkcja pobierająca koordynatorów
     */
    public function getCoordinators(){
        
        $this->loadModel('Section');
        
        $coordinators = $this->Section->getSectionsBoss();
        
        foreach($coordinators as $key => $value){
            
            if(strlen($key) != 36){
                
                unset($coordinators[$key]);
            }
        }
        
        $this->loadModel('ClientProject');
        
        $allProjectsCoordinators = $this->ClientProject->getClientsProjectsCoordinators();
        
        return $coordinators + $allProjectsCoordinators;
    }

    /**
     * Akcja tworzenia nowego projektu w bazie projektów
     * 
     * @return void
     */
    public function create($client_project_id = null){
        
        $this->loadModel('ClientProject');
        $this->ClientProject->id = $client_project_id;

        if (!$this->ClientProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        } 
        
        $clientProject = $this->ClientProject->findById($client_project_id);
        
        $subtitle = "Dodaj projekt " . $clientProject['ClientProject']['name'] . " do bazy projektów";   
        $title = 'Baza projektów';
        
        $textdocument = array();
        
        if ($this->request->is('post'))
        {           
            $this->loadModel('BaseProject');
            $base_project = $this->BaseProject->findByClientProjectId($client_project_id);
            if(isset($base_project)){
                $this->Session->setFlash(__d('public', 'Taki projekt jest już w bazie projektów.'), 'flash/error');    
                $this->redirect(array('action' => 'index'));
            }
            
            $this->BaseProject->create();         
            $requestData = $this->request->data;
            $requestData['BaseProject']['pictures'] = '';
 
            if ($this->BaseProject->save($requestData))
            {
                $this->ClientProject->id = $client_project_id;
                $this->ClientProject->saveField('project_database',1);
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                              
                $this->redirect(array('action' => 'index'));

            } else {
                
                $baseproject = $requestData;
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        
        $coordinators = $this->getCoordinators();
        $programmers = $this->UserUser->getProgrammers();
        
        $this->set(compact('title', 'subtitle', 'baseproject', 'client_project_id', 'coordinators', 'programmers'));
    }
    
    /**
     * Akcja podglądu wpisu w bazie projektów
     * 
     * @return void
     */
    public function view($base_project_id = null){
        
        $this->BaseProject->id = $base_project_id;

        if (!$this->BaseProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        
        $this->loadModel('ClientProject');
        
        $baseProject = $this->BaseProject->find('first', array(
            'conditions' => array(
                'BaseProject.id' => $base_project_id
            ),
            'contain' => array(
                'ClientProject',
                'Coordinator' => array(
                    'Profile' => array(
                        'fields' => array(
                            'Profile.name'
                        )
                    )
                ),
                'Programmer' => array(
                    'Profile' => array(
                        'fields' => array(
                            'Profile.name'
                        )
                    )
                )
            )
        ));
        
        $clientProject = $this->ClientProject->findById($baseProject['BaseProject']['client_project_id']);
        
        $subtitle = "Podgląd projektu " . $clientProject['ClientProject']['name'] . "  w bazie projektów";   
        $title = 'Baza projektów';        
        
        $this->set(compact('title', 'subtitle', 'baseProject', 'client_project_id'));
    }
    
    /**
     * Akcja tworzenia nowego projektu w bazie projektów
     * 
     * @return void
     */
    public function update($base_project_id = null){
        
        $this->BaseProject->id = $base_project_id;

        if (!$this->BaseProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        } 
        $this->loadModel('ClientProject');
        
        $baseProject = $this->BaseProject->findById($base_project_id);
        $clientProject = $this->ClientProject->findById($baseProject['BaseProject']['client_project_id']);
        
        $subtitle = "Edycja projektu " . $clientProject['ClientProject']['name'] . "  w bazie projektów";   
        $title = 'Baza projektów';
        
        if ($this->request->is('post'))
        {                   
            $requestData = $this->request->data;
            $requestData['BaseProject']['pictures'] = '';
 
            if ($this->BaseProject->save($requestData))
            {

                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                              
                $this->redirect(array('action' => 'index'));

            } else {
                
                $baseproject = $requestData;
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        
        $coordinators = $this->getCoordinators();
        $programmers = $this->UserUser->getProgrammers();
        
        $this->set(compact('title', 'subtitle', 'baseProject', 'client_project_id', 'coordinators', 'programmers'));
    }
    
    /**
     * Usuwanie projektu z bazy projektów
     */
    public function delete()
    {

        $this->BaseProject->delete($this->request->data['id'], false);
        $this->autoRender = false;
    }
}