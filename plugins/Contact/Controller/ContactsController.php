<?php

App::uses('AppController', 'Controller');

/**
 * Contacts Controller
 *
 * @property Contact $Contact
 */
class ContactsController extends AppController {

    /**
     * Nazwa layoutu
     */
    public $layout = 'admin';

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array();

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array(); //Slug.Slug

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index() {
        if (!empty($this->request->data)) {
            $formContact = ClassRegistry::init(array('table' => false, 'class' => 'FormContact'));
            $formContact->set($this->request->data);
            $this->setValidate($formContact);

            if ($formContact->validates()) {
                try {
                    $toEmail = $this->Contact->find('first', array('conditions' => array('id' => $this->request->data['FormContact']['toEmail']), 'fields' => array('Contact.email')));
                    App::uses('FebEmail', 'Lib');
                    $email = new FebEmail('public');
                    $email->viewVars(array('data' => $this->request->data));
                    $email->template('Contact.contact')
                            ->emailFormat('both')
                            ->to(array($toEmail['Contact']['email'] => $toEmail['Contact']['email']))
                            ->from(array($this->request->data['FormContact']['email'] => $this->request->data['FormContact']['email']))
                            ->subject(__d('email', '[www] Zapytanie ze strony autopart'));
                    $email_sent = $email->send();
                    return $this->email_sent();
                } catch (SocketException $e) {
                    $this->log("Caught exception (detiles in file: ): " . $e->getMessage());
                }
            } else {
                $this->validateErrors($formContact);
                $this->set('flash', 'Wystąpił błąd, sprawdź formularz i spróbuj ponownie.');
            }
        }
        $kontakty = $this->Contact->find('list', array('conditions' => array('show' => 1)));
        $this->set('kontakty', $kontakty);
        $this->render('index');
    }

    public function email_sent() {
        $this->render('email_sent');
    }

    private function setValidate(Model $model) {
        $model->validate = array(
            'email' => array(
                'email' => array(
                    'rule' => array('email'),
                    'message' => __d('validate', 'Musisz wpisać poprawny adres email'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'person' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
        );
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index() {
        $this->helpers[] = 'FebTime';
        $this->Contact->recursive = 1;
        $this->Contact->locale = Configure::read('Config.languages');
        $this->Contact->bindTranslation(array($this->Contact->displayField => 'translateDisplay'));
        $this->set('contacts', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {

        $this->Contact->id = $id;
        if (!$this->Contact->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('contact', $this->Contact->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Contact->create();
            if ($this->Contact->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->Contact->id = $id;
        if (!$this->Contact->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Contact->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Contact->locale = Configure::read('Config.languages');
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else {
            $this->request->data = $this->Contact->read(null, $id);
        }
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null, $all = null) {
        $this->FebI18n->delete($id, $all);
        $this->redirect(array('action' => 'index'), null, true);
    }

}
