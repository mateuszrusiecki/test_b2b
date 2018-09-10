<?php

App::uses('AppController', 'Controller');

/**
 * BaseProjectsController Controller
 */
class BaseModulesController extends AppController
{
    
    public $uses = array('UserUser', 'BaseModule');
    
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
    public function index($client_project_id = null)           
    {
        $title = $subtitle = 'Baza modułów';
        $session = $this->Session->read();
        $user_permission = $session['user_permission'];

        if ($this->request->is('post'))
        {

            $baseModules = $this->BaseModule->getBaseModules($this->request->data['client_project_id']);

            $this->set(compact('baseModules'));
            $this->set('_serialize', array('baseModules'));
        } else
        {

            $this->set(compact('title', 'subtitle','user_permission'));
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
     * Akcja tworzenia nowego projektu w bazie modułów
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
        
        $subtitle = "Dodaj moduł do projektu " . $clientProject['ClientProject']['name'];   
        $title = 'Baza modułów';
        
        if ($this->request->is('post'))
        {           
            $this->BaseModule->create();         
            $requestData = $this->request->data;
            $requestData['BaseModule']['pictures'] = '';
 
            if ($this->BaseModule->save($requestData))
            {

                $this->ClientProject->id = $client_project_id;
                $this->ClientProject->saveField('modules_database',1);
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                              
                $this->redirect(array('action' => 'index'));

            } else {
                
                $basemodule = $requestData;
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        
        $coordinators = $this->getCoordinators();
        $programmers = $this->UserUser->getProgrammers();
        
        $this->set(compact('title', 'subtitle', 'basemodule', 'client_project_id', 'coordinators', 'programmers'));
    }
    
    /**
     * Akcja podglądu wpisu w bazie mod
     * 
     * @return void
     */
    public function view($base_project_id = null, $client_project_id = null){
        
        $this->BaseModule->id = $base_project_id;

        if (!$this->BaseModule->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        
        $this->loadModel('ClientProject');
        
        $baseModule = $this->BaseModule->find('first', array(
            'conditions' => array(
                'BaseModule.id' => $base_project_id
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
        
        $clientProject = $this->ClientProject->findById($baseModule['BaseModule']['client_project_id']);
        
        $subtitle = "Podgląd modułu " . $baseModule['BaseModule']['name']  . "  w bazie modułów";   
        $title = 'Baza modułów';        
        
        $this->set(compact('title', 'subtitle', 'baseModule', 'client_project_id'));
    }
    
    /**
     * Akcja tworzenia nowego projektu w bazie modułów
     * 
     * @return void
     */
    public function update($base_project_id = null, $client_project_id = null){
        
        $this->BaseModule->id = $base_project_id;

        if (!$this->BaseModule->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        } 
        $this->loadModel('ClientProject');
        
        $baseModule = $this->BaseModule->findById($base_project_id);
        $clientProject = $this->ClientProject->findById($baseModule['BaseModule']['client_project_id']);
        
        $subtitle = "Edycja modułu " . $baseModule['BaseModule']['name'] . "  w bazie modułów";   
        $title = 'Baza Modułów';
        
        if ($this->request->is('post'))
        {                   
            $requestData = $this->request->data;
            $requestData['BaseModule']['pictures'] = '';
 
            if ($this->BaseModule->save($requestData))
            {

                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                              
                if(isset($client_project_id) && $client_project_id != null){
                    
                    $this->redirect(array('action' => 'index', $client_project_id));
                } else {
                    
                    $this->redirect(array('action' => 'index'));
                }

            } else {
                
                $baseModule = $requestData;
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        
        $coordinators = $this->getCoordinators();
        $programmers = $this->UserUser->getProgrammers();
        
        $this->set(compact('title', 'subtitle', 'baseModule', 'client_project_id', 'coordinators', 'programmers'));
    }
    
    /**
     * Usuwanie projektu z bazy modułów
     */
    public function delete()
    {

        $this->BaseModule->delete($this->request->data['id'], false);
        $this->autoRender = false;
    }
}