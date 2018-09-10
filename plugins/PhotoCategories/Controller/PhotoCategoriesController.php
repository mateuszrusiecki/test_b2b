<?php

App::uses('AppController', 'Controller');

/**
 * PhotoCategories Controller
 *
 * @property PhotoCategory $PhotoCategory
 */
class PhotoCategoriesController extends AppController {

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
    public $components = array();
    
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
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
//        $slug = $this->PhotoCategory->isSlug($slug);
//        if (!$slug) {
//            throw new NotFoundException(__('Strona nie istnieje.'));
//        }
//        if (!empty($slug['error'])) {
//            $this->redirect(array($slug['slug']), $slug['error']);
//        }
//        $this->PhotoCategory->id = $slug['id'];

        $this->PhotoCategory->id = $id;
        if (!$this->PhotoCategory->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('photoCategory', $this->PhotoCategory->read(null, $id));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index($page_id = null) {
        
        $this->loadModel('Page');
        
        $this->Page->id = $page_id;
        if (!$this->Page->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->PhotoCategory->recursive = 0;
        
        $this->PhotoCategory->setScope("PhotoCategory.page_id = {$page_id}");
        
        $this->PhotoCategory->recover();
        $this->helpers[] = 'FebTime';
		$tree = $this->PhotoCategory->findTree();
        $this->set(compact('tree'));
        if ($this->request->is('ajax')) {
            $this->render('/Elements/PhotoCategories/table_index');
        } 
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {

        $this->PhotoCategory->id = $id;
        if (!$this->PhotoCategory->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('photoCategory', $this->PhotoCategory->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function admin_add($page_id = null) {
        $this->helpers[] = 'FebTinyMce4';
        $this->loadModel('Page');
        
        $this->Page->id = $page_id;
        if (!$this->Page->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->request->data['PhotoCategory']['page_id'] = $page_id;
        if ($this->request->is('post')) {
            $this->PhotoCategory->create();
            if ($this->PhotoCategory->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index', $page_id));
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
        $this->PhotoCategory->id = $id;
        if (!$this->PhotoCategory->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->PhotoCategory->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__d('admin', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.', 'flash/error'));
            }
        } else {
            $this->request->data = $this->PhotoCategory->read(null, $id);
        }
    }

    function admin_update() {
        if(empty($this->request->data['dest_id']) or empty($this->request->data['id'])){
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        if(empty($this->data['mode'])) {
            $this->request->data['mode'] = null;
        }

        $valid = $this->PhotoCategory->validateDepth($this->data['id'], $this->data['dest_id'], $this->data['mode']);
        
        if($valid === false){
            $this->Session->setFlash($this->PhotoCategory->validate['depth']['message']);
        }

        if($valid === true && $this->PhotoCategory->moveNode($this->data['id'], $this->data['dest_id'], $this->data['mode'])){
            $this->Session->setFlash(__d('public','Zmieniono pozycję'));
        }
        
        $this->render(false);
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
        $this->PhotoCategory->id = $id;
        if (!$this->PhotoCategory->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->PhotoCategory->delete()) {
            $this->Session->setFlash(__d('cms', 'Poprawnie usunięto.'));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__d('cms', 'Nie można usunąć.'), 'flash/error');
        $this->redirect($this->referer());
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
        //    $params['conditions']['PhotoCategory.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->PhotoCategory->recursive = -1;
        $params['conditions']["PhotoCategory.name LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->PhotoCategory->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
