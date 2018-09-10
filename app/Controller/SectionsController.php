<?php

App::uses('AppController', 'Controller');

/**
 * Sections Controller
 *
 * @property Section $Section
 */
class SectionsController extends AppController {
    /**
     * Nazwa layoutu
     */
//    public $layout = 'admin';

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
        $this->Auth->allow(array(''));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index() {
        $this->helpers[] = 'FebTime';
        $this->Section->recursive = 0;
        $this->set('sections', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {

//        $id = $this->Slug->basic();
        $this->Section->id = $id;
        if (!$this->Section->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('section', $this->Section->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Section->create();
            if ($this->Section->save($this->request->data)) {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $users = $this->Section->User->find('list');
        $this->set(compact('users'));
        $title = 'Działy - dodawanie';
        $subtitle = 'Działy - dodawanie';

        $this->set(compact('title', 'subtitle'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Section->id = $id;
        if (!$this->Section->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Section->save($this->request->data)) {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else {
            $this->request->data = $this->Section->read(null, $id);
        }
        $users = $this->Section->User->find('list');
        $this->set(compact('users'));
        $title = 'Działy - edycja';
        $subtitle = 'Działy - edycja';

        $this->set(compact('title', 'subtitle'));
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Section->id = $id;
        if (!$this->Section->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Section->delete()) {
            $this->Session->setFlash(__d('public', 'Poprawnie usunięto.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('public', 'Nie można usunąć.'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index() {
        $this->helpers[] = 'FebTime';
        $this->Section->recursive = 1;
        $this->set('sections', $this->paginate());
        $title = 'Działy';
        $subtitle = 'Działy';

        $this->set(compact('title', 'subtitle'));
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {

        $this->Section->id = $id;
        if (!$this->Section->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('section', $this->Section->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Section->create();
            if ($this->Section->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $users = $this->Section->User->find('list');
        $supervisors = $this->Section->User->find('list');
        $this->set(compact('users', 'supervisors'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->Section->id = $id;
        if (!$this->Section->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Section->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else {
            $this->request->data = $this->Section->read(null, $id);
        }
        $users = $this->Section->find('all', array(
            'conditions' => array(
                'Section.id' => $id
            ),
            'recursive' => 2
        ));
        $supervisors = $this->Section->User->find('list');
        $this->set(compact('users', 'supervisors'));
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
        $this->Section->id = $id;
        if (!$this->Section->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Section->delete()) {
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
        $params['fields'] = array('name');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['Section.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->Section->recursive = -1;
        $params['conditions']["Section.name LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->Section->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

    /**
     * Usuwanie połączenia pracownik - dział
     */
    function admin_remove_user_section($id = null) {
        $this->loadModel('UserSection');

        if (!$id) {
            $this->Session->setFlash(__d('cms', 'Nie można usunąć.'), 'flash/error');
            $this->redirect($this->referer());
        }

        $this->UserSection->id = $id;
        if (!$this->UserSection->exists()) {
            throw new NotFoundException(__d('cms', 'Połączenie nie istnieje.'));
        }
        if ($this->UserSection->delete()) {
            $this->Session->setFlash(__d('cms', 'Poprawnie usunięto.'));
            $this->redirect($this->referer());
        }

        $this->Session->setFlash(__d('cms', 'Nie można usunąć.'), 'flash/error');
        $this->redirect($this->referer());
    }

    function admin_add_worker($id = null) {
        if (!$id) {
            throw new NotFoundException(__d('cms', 'Dział nie istnieje.'));
        }
        $this->Section->id = $id;
        if (!$this->Section->exists()) {
            throw new NotFoundException(__d('cms', 'Dział nie istnieje.'));
        }


        if ($this->request->is('post') || $this->request->is('put')) {
            //debug($this->request->data); die;
            $this->Section->recursive = 1;
            if ($save = $this->Section->save($this->request->data)) {
                $this->Session->setFlash(__d('users', 'Pracownicy zostali zapisani'), 'flash/confirm');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__d('users', 'Zapisywanie pracowników nie powiodło się. Sprawdź formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $section = $this->Section->read(null, $id);
        if (empty($this->request->data)) {
            $this->request->data = $section;
        }

        $this->User->virtualFields = array(
            'fullname' => 'CONCAT(Profile.firstname, " ", Profile.surname)'
        );

        $users = $this->Section->User->find('list', array(
            'fields' => array(
                'id', 'fullname'
            ),
            'recursive' => 1,
            'order' => array(
                'fullname'
            )
        ));
        $this->set(compact('users'));
    }

}
