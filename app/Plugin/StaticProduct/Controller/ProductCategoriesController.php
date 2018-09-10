<?php

App::uses('AppController', 'Controller');

/**
 * ProductCategories Controller
 *
 * @property ProductCategory $ProductCategory
 */
class ProductCategoriesController extends AppController {

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
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index() {
        $this->helpers[] = 'FebTime';
        $this->ProductCategory->recursive = 0;
        $this->set('productCategories', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
//        $slug = $this->ProductCategory->isSlug($slug);
//        if (!$slug) {
//            throw new NotFoundException(__('Strona nie istnieje.'));
//        }
//        if (!empty($slug['error'])) {
//            $this->redirect(array($slug['slug']), $slug['error']);
//        }
//        $this->ProductCategory->id = $slug['id'];

        $this->ProductCategory->id = $id;
        if (!$this->ProductCategory->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('productCategory', $this->ProductCategory->read(null, $id));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index() {
        $this->helpers[] = 'FebTime';
        $this->ProductCategory->recover();
        
        $this->ProductCategory->setScope("ProductCategory.selection_id = {$this->selection_id}");
        
        $this->ProductCategory->recursive = 1;
        $this->ProductCategory->locale = Configure::read('Config.languages');
        $this->ProductCategory->bindTranslation(array('name' => 'translateDisplay'));
		$tree = $this->ProductCategory->findTree();
        
        $this->set(compact('tree'));
        if ($this->request->is('ajax')) {
            $this->render('/Elements/ProductCategories/table_index');
        }
    }
    
    
    function admin_update() {
        if(empty($this->request->data['dest_id']) or empty($this->request->data['id'])){
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        if(empty($this->data['mode'])) {
            $this->request->data['mode'] = null;
        }

        $valid = $this->ProductCategory->validateDepth($this->data['id'], $this->data['dest_id'], $this->data['mode']);
        
        if($valid === false){
            $this->Session->setFlash($this->ProductCategory->validate['depth']['message']);
        }

        if($valid === true && $this->ProductCategory->moveNode($this->data['id'], $this->data['dest_id'], $this->data['mode'])){
            $this->Session->setFlash(__d('public','Zmieniono pozycję'));
        }
        
        $this->render(false);
    }
    
    
    public function admin_reload() {
        $this->ProductCategory->recursive = 1;
        $this->ProductCategory->locale = Configure::read('Config.languages');
        $this->ProductCategory->bindTranslation(array('title' => 'translateDisplay'));
        $productCategories = $this->ProductCategory->findTree();
        
        $this->set(compact('productCategories'));
        
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {

        $this->ProductCategory->id = $id;
        if (!$this->ProductCategory->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('productCategory', $this->ProductCategory->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->ProductCategory->create();
            
            $this->request->data['ProductCategory']['selection_id'] = $this->selection_id;
            
            if ($this->ProductCategory->save($this->request->data)) {
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
        $this->ProductCategory->id = $id;
        if (!$this->ProductCategory->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ProductCategory->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('admin', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.', 'flash/error'));
            }
        } else {
            $this->ProductCategory->locale = Configure::read('Config.languages');
            $this->request->data = $this->ProductCategory->read(null, $id);
        }
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    function admin_delete($id = null, $all = null) {
        $this->FebI18n->delete($id, $all);
        $this->redirect(array('action' => 'index'), null, true);
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
        //    $params['conditions']['ProductCategory.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->ProductCategory->recursive = -1;
        $params['conditions']["ProductCategory.name LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->ProductCategory->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
