<?php

App::uses('AppController', 'Controller');

/**
 * Partners Controller
 *
 * @property Partner $Partner
 */
class PartnersController extends AppController {

    public $helpers = array('FebTinyMce', 'FebForm');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('partners_to_front', 'view', 'index');
    }

    public function partners_to_front() {
        $partners = $this->Partner->find('all');
        $this->set(compact('partners'));
        $this->render('/Elements/partners/partners');
    }

 

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Partner->recursive = -1;
        //$this->set('partners', $this->paginate());
        $partners = $this->Partner->find('all');
        $this->set(compact('partners'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->layout = 'admin';
        $language = Configure::read('Config.languages');
        $this->Partner->locale = $language;
        $this->Partner->bindTranslation(array('name' => 'translateDisplay'));
        $this->Partner->recursive = 1;
        $this->set('partners', $this->paginate());
    }

    /**
     * admin_view method
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        $this->layout = 'admin';
        $this->Partner->id = $id;
        if (!$this->Partner->exists()) {
            throw new NotFoundException(__('Invalid partner'));
        }
        $this->set('partner', $this->Partner->read(null, $id));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        $this->layout = 'admin';
        if ($this->request->is('post')) {
            $this->Partner->create();
            if ($this->Partner->save($this->request->data)) {
                $this->Session->setFlash(__('The partner has been saved'));
                $this->redirect(array('action' => 'index'));
//                $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash(__('The partner could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * admin_edit method
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->layout = 'admin';
        $this->Partner->id = $id;
        if (!$this->Partner->exists()) {
            throw new NotFoundException(__('Invalid partner'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Partner->save($this->request->data)) {
                $this->Session->setFlash(__('The partner has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The partner could not be saved. Please, try again.'));
            }
        } else {
            $this->Partner->locale = Configure::read('Config.languages');
            $this->request->data = $this->Partner->read(null, $id);
        }
    }

    /**
     * admin_delete method
     *
     * @param string $id
     * @return void
     */
    function admin_delete($id = null, $all = null) {
        $this->FebI18n->delete($id, $all);
        $this->redirect(array('action' => 'index'), null, true);
    }

}
