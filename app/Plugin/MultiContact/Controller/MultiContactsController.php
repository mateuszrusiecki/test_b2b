<?php

App::uses('AppController', 'Controller');

/**
 * MultiContacts Controller
 *
 * @property MultiContact $MultiContact
 */
class MultiContactsController extends AppController {

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

    public function admin_sort() {
        $this->Order->sort();
    }
    
    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index() {
        $this->helpers[] = 'FebTime';
        $this->MultiContact->recursive = -1;
        $this->set('multiContacts', $this->MultiContact->find('all'));
        $this->render('index');
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index() {
        $this->helpers[] = 'FebTime';
        $this->MultiContact->recursive = 0;
        $this->set('multiContacts', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {

        $this->MultiContact->id = $id;
        if (!$this->MultiContact->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('multiContact', $this->MultiContact->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function admin_add() {
        $this->helpers[] = 'FebTinyMce4';
        if ($this->request->is('post')) {
            $this->MultiContact->create();
            if ($this->MultiContact->save($this->request->data)) {
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
        $this->helpers[] = 'FebTinyMce4';
        $this->MultiContact->id = $id;
        if (!$this->MultiContact->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->MultiContact->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else {
            $this->request->data = $this->MultiContact->read(null, $id);
        }
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->MultiContact->id = $id;
        if (!$this->MultiContact->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->MultiContact->delete()) {
            $this->Session->setFlash(__d('cms', 'Poprawnie usunięto.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('cms', 'Nie można usunąć.'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Akcja do podpowiadaina danych z formularza
     * 
     * @param type $term
     * @throws MethodNotAllowedException 
     */
    function admin_autocomplete($term = null) {
        $this->layout = 'ajax';
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $params = array();
        $params['fields'] = array('label');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['MultiContact.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->MultiContact->recursive = -1;
        $params['conditions']["MultiContact.label LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->MultiContact->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
