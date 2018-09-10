<?php

App::uses('NewClientsAppController', 'NewClients.Controller');

class MainController extends NewClientsAppController {

    public $components = array('CheckAccess');

    /*
     * Główna strona aplikacji z rozróżnieniem roli (manager|client)
     */

    public function index() {
        $this->CheckAccess->setRoleForGCModule($this->Session->read('Auth.User.id')); // aktualizacja  Session role dla GC 
        
        $user = $this->Auth->user();
        
        //print_r($user); die();
        
        if ($user['role'] == 'manager') {
            $this->view = 'manager';
        } else {
            $this->view = 'client';
        }

        $title = 'GC';
        $subtitle = 'GC';

        $this->set(compact('title', 'subtitle'));
    }

}
