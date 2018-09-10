<?php
App::uses('AppController', 'Controller');
App::uses('FebEmail', 'Lib');

class NewsletterMessagesController extends AppController {

    public $name = 'NewsletterMessages';
    public $layout = 'admin';
    public $helpers = array(
        'FebTinyMce4'
    );
    public $uses = array('Newsletter.NewsletterMessage', 'Newsletter.Newsletter');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('send'));
        $this->pageTitle = 'Newsletter';

        if (!empty($this->params['requested']))
            $this->Auth->allow(array($this->action));
    }

    function admin_index() {
        $this->NewsletterMessage->recursive = 0;
        $this->set('newsletterMessages', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowy ID wiadomości'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('newsletterMessage', $this->NewsletterMessage->read(null, $id));
    }

    function admin_htmlpreview($id = null) {
        $this->layout = 'Emails/html/default';
        if (!$id) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowy ID wiadomości'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('newsletterMessage', $this->NewsletterMessage->read(array('html_content'), $id));
    }

    function admin_add() {
        if (!empty($this->request->data)) {
            $this->NewsletterMessage->create();
            if ($this->NewsletterMessage->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Wiadomość została zapisana'));
                $id = $this->NewsletterMessage->getInsertID();
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__d('cms', 'Zapisywanie wiadomości nie powiodło się, sprawdź formularz i spróbuj ponownie'));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowy ID wiadomości'));
            $this->redirect(array('action' => 'index'));
        }
        $message = $this->NewsletterMessage->read(null, $id);
        if ($message['NewsletterMessage']['status']) {
            $this->Session->setFlash(sprintf(__d('cms', 'Nie można edytować, wiadomość została już wysłana do %s odbiorców'), $message['NewsletterMessage']['recipients']));
            $this->redirect(array('action' => 'view', $id));
        }

        if (!empty($this->request->data)) {
            if ($this->NewsletterMessage->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Wiadomość została zapisana'));
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__d('cms', 'Zapisywanie wiadomości nie powiodło się, sprawdź formularz i spróbuj ponownie'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $message;
        }
    }

    function admin_send($id = null) {
        $this->loadModel('NewsletterMessageRecipient');

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowy ID wiadomości'));
            $this->redirect(array('action' => 'index'));
        }
        $message = $this->NewsletterMessage->read(null, $id);

        if (empty($message)) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowy ID wiadomości'));
            $this->redirect(array('action' => 'index'));
        }
        
        if ($message['NewsletterMessage']['status']) {
            $this->Session->setFlash(sprintf(__d('cms', 'Wiadomość w trakcie wysyłki (wysłano %s)'), $message['NewsletterMessage']['recipients']));
            $this->redirect(array('action' => 'view', $id));
        }

        if (!empty($this->request->data)) {
            $paramsNewsletter['order'] = 'Newsletter.created ASC';
            $paramsNewsletter['fields'] = array('email');
            $paramsNewsletter['conditions']['Newsletter.confirmed'] = 1;
            $recipients = $this->Newsletter->find('list', $paramsNewsletter);
  
            foreach ($recipients AS $email) {
                $toSave['NewsletterMessageRecipient']['newsletter_message_id'] = $id;
                $toSave['NewsletterMessageRecipient']['recipient_email'] = $email;
                $this->NewsletterMessageRecipient->create();
                if (!$this->NewsletterMessageRecipient->save($toSave)) {
                    throw new Exception('Krytyczny błąd podczas przepisywania do bazy newslettera');
                }
            }
            
            //Ustawiam status, oddany do wysyłki
            $this->NewsletterMessage->id = $id;
            $this->NewsletterMessage->saveField('status', 1);
            $this->NewsletterMessage->saveField('recipients', count($recipients));
            
            $this->Session->setFlash(__d('cms', 'Wiadomość została przekazana do wysyłki'));
            $this->redirect(array('action' => 'view', $id));
        }

        $this->Session->setFlash(__d('cms', 'Użyj przycisku "Wyślij wiadomość newslettera", aby dokonać wysyłki'));
        $this->redirect(array('action' => 'view', $id));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowy ID wiadomości'));
            $this->redirect(array('action' => 'index'));
        }
        
        $message = $this->NewsletterMessage->read(null, $id);
        if ($message['NewsletterMessage']['status']) {
            $this->Session->setFlash(sprintf(__d('cms', 'Nie można usunąć, wiadomość została już wysłana do %s odbiorców'), $message['NewsletterMessage']['recipients']));
        }

        if ($this->NewsletterMessage->delete($id)) {
            $this->Session->setFlash(__d('cms', 'Wiadomość została usunięta'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->Session->setFlash(__d('cms', 'Usuwanie wiadomości nie powiodło się'));
        $this->redirect(array('action' => 'index'));
    }

    function admin_test_send($message_id = null) {

        $message = $this->NewsletterMessage->read(null, $message_id);

        if (empty($message) or empty($this->request->data['NewsletterMessage']['email'])) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowe wywołanie'));
            $this->redirect($this->referer());
        }

        // Ustawienie adresu nadawcy
        $MyEmail = new FebEmail('public');
        $MyEmail->viewVars(array('email' => $this->request->data['NewsletterMessage']['email'], 'message' => $message));
        //        $email->helpers(array('Html'));
        $MyEmail->template('Newsletter.user_newsletter')
                ->to($this->request->data['NewsletterMessage']['email'])
                ->from(array($message['NewsletterMessage']['sender_email'] => $message['NewsletterMessage']['sender_name']))
                ->subject($message['NewsletterMessage']['title']);
        $emailFormat = 'text';
        if (!empty($message['NewsletterMessage']['html_content'])) {
            $emailFormat = 'both';
        }
        $MyEmail->emailFormat($emailFormat);

        $email_sent = $MyEmail->send();
        $email_sent = true;
        $MyEmail->reset();

        if ($email_sent) {
            $this->Session->setFlash(__d('cms', 'Wiadomość testowa została wysłana na adres ' . $this->request->data['NewsletterMessage']['email']));
            $this->redirect($this->referer());
        }

        $this->Session->setFlash(__d('cms', 'Wysyłka testowa na adres ' . $this->request->data['NewsletterMessage']['email'] . ' nie powiodła się'));
        $this->redirect($this->referer());
    }

}

?>