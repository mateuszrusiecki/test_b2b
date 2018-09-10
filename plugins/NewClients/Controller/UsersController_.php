<?php

App::uses('NewClientsAppController', 'NewClients.Controller');

class UsersController extends NewClientsAppController {

    public $components = array('RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login');
    }

    /*
     * Obsługa logowania do aplikacji
     */
    public function login() {
        $this->Auth->logout();
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirectUrl());
                $this->Session->setFlash('');
                return 0;
            } else {
                $this->Session->setFlash('Błędny email lub hasło');
                return 1;
            }
        }
        return null; // method get 
    }

    /*
     * Wylogowanie z aplikacji
     */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    /*
     * Lista userów z określoną rolą (manager/client)
     * /users/listing/manager.json | /users/listing/client.json
     */
    public function listing($role = 'manager') {
        $this->autoRender = false;
        $users = $this->User->findAllByRole($role);
        $this->response->body(json_encode($users));
    }
}
