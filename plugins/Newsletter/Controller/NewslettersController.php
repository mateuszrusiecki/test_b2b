<?php
App::uses('AppController', 'Controller');
App::uses('FebEmail', 'Lib');

class NewslettersController extends AppController {

    var $name = 'Newsletters';
    var $layout = 'admin';
    public $uses = array('Newsletter.Newsletter');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'ok', 'activate', 'delete', 'remove');
    }

    function add($update = '') {
        if (!empty($this->request->data)) {
            $this->Newsletter->create();
            if (!empty($this->request->data['Newsletter']['email'])) {
                $member = $this->Newsletter->findByEmail($this->request->data['Newsletter']['email']);
                if (!empty($member['Newsletter'])) {
                    if ($member['Newsletter']['confirmed']) {
                        $this->email_register($this->request->data['Newsletter']['email'], 'Newsletter.newsletter_unregister');
                        $this->redirect(array('action' => 'remove'));
                    } else {
                        $this->email_register($this->request->data['Newsletter']['email']);
                        $this->redirect(array('action' => 'ok'));
                    }
                }
            }
            if (!empty($this->request->data['Newsletter']['email']) && $this->Newsletter->save($this->request->data)) {
                $this->email_register($this->request->data['Newsletter']['email']);
                $this->redirect(array('action' => 'ok'));
            }
        }
        $this->set('update', $update);
    }

    function remove() {
        
    }

    function ok() {
        
    }

    function email_register($email, $template = 'Newsletter.newsletter_register') {
        // Ustawienie adresu nadawcy
        $MyEmail = new FebEmail('public');

        // Ustawienie tytułu wiadomości
        $subject = '';
        if ($template == 'Newsletter.newsletter_register') {
            $subject = __d('public', 'Witamy wśród odbiorców newslettera');
        } else {
            $subject = __d('public', 'Czy chcesz zrezygnować z newslettera?');
        }

        $MyEmail->viewVars(array('email' => $email));
        //        $email->helpers(array('Html'));
        $MyEmail->template($template)
                ->emailFormat('both')
                ->to($email)
                ->from(array(Configure::read('App.WebSenderEmail') => Configure::read('App.WebSenderName')))
                ->subject($subject);

        return $MyEmail->send();
    }

    function activate($md5 = null) {

        $this->layout = 'default';

        $newsletter = $this->Newsletter->find('first', array('conditions' => array('MD5(Newsletter.email) = "' . $md5 . '"')));

        if ($newsletter['Newsletter']['confirmed'] == 1) {
            $this->Session->setFlash(__('Email jest już aktywny'));
        } elseif (isset($newsletter['Newsletter']['id'])) {
            $this->Newsletter->id = $newsletter['Newsletter']['id'];
            $this->Newsletter->saveField('confirmed', 1);
            $this->Session->setFlash(__('Aktywacja przebiegła pomyślnie'));
        } else {
            $this->Session->setFlash(__('Email nie został aktywowany. Skontaktuj się z administratorem strony.'));
        }
        $this->redirect('/');
    }

    function delete($md5 = null) {

        $this->layout = 'default';

        $newsletter = $this->Newsletter->find('first', array('conditions' => array('MD5(Newsletter.email) = "' . $md5 . '"')));

//        debug($newsletter);
//        exit;

        if (empty($newsletter)) {
            $this->Session->setFlash(__('Nie znaleziono adresu w bazie'));
            $this->redirect('/');
        }

        if (!empty($this->request->data)) {
            if ($this->Newsletter->delete($newsletter['Newsletter']['id'])) {
                $this->Session->setFlash(__('Adres email został usunięty z bazy'));
                $this->redirect('/');
            } else {
                $this->Session->setFlash(__('Nie udalo się usunąć adresu email'));
            }
        }
        $this->set(compact('newsletter'));
    }

    function admin_index() {
        $this->Newsletter->recursive = 0;
        $this->set('newsletters', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid newsletter'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('newsletter', $this->Newsletter->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->request->data)) {
            $this->Newsletter->create();
            if ($this->Newsletter->save($this->request->data)) {
                $this->Session->setFlash(__('The newsletter has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The newsletter could not be saved. Please, try again.'));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid newsletter'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Newsletter->save($this->request->data)) {
                $this->Session->setFlash(__('The newsletter has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The newsletter could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Newsletter->read(null, $id);
        }
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Nieprawidłowy id odbiorcy'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Newsletter->delete($id)) {
            $this->Session->setFlash(__('Odbiorca newslettera został usunięty.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Usuwanie odbiorcy newslettera nie powiodło się.'));
        $this->redirect(array('action' => 'index'));
    }

}

?>