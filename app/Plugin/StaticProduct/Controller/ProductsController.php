<?php

App::uses('AppController', 'Controller');

/**
 * Products Controller
 *
 * @property Product $Product
 */
class ProductsController extends AppController {

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
        $this->Auth->allow(array('front', 'index', 'view'));
    }
    
    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index($slug = null) {
        $this->Product->recursive = 0;

        $params = array();
        $params['conditions']['Product.selection_id'] = $this->selection_id;
        
        $this->Product->ProductCategory->setScope("ProductCategory.selection_id = {$this->selection_id}");
        
        if ($slug) {

            $slug = $this->Product->ProductCategory->isSlug($slug);
            $this->Product->ProductCategory->id = $slug['id'];

            if (!$this->Product->ProductCategory->exists()) {
                throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
            }

            $params['joins'][] = array(
                'table' => 'products_product_categories',
                'alias' => 'ProductProductCategory',
                'type' => 'INNER',
                'conditions' => array(
                    "ProductProductCategory.product_category_id = {$slug['id']}",
                    'ProductProductCategory.product_id = Product.id',
                )
            );
                    
            $this->Product->ProductCategory->recursive = -1;
            $category = $this->Product->ProductCategory->read();
            
            $categoryName = $category['ProductCategory']['name'];
            $productCategories = $this->Product->getDynaTreeCategories($this->Product->ProductCategory->id);
                    
        } else {
            $productCategories = $this->Product->getDynaTreeCategories();
            $categoryName = $productCategories[0]['name'];  
        }
        
        $this->paginate = $params;
        $products = $this->paginate();

        
        
        $this->set(compact('products', 'productCategories', 'category_id', 'categoryName'));
    }

    public function front($category_id = null, $not_category_id = null) {
        $this->Product->recursive = 0;

        //$this->Product->locale = Configure::read('Config.languages');
        if (!empty($category_id)) {
            $category = $this->Product->ProductCategory->findById($category_id);
            $params['conditions']['ProductCategory.lft >='] = $category['ProductCategory']['lft'];
            $params['conditions']['ProductCategory.rght <='] = $category['ProductCategory']['rght'];
        } elseif ($not_category_id) {
            $category = $this->Product->ProductCategory->findById($not_category_id);
            $params['conditions']['OR']['ProductCategory.lft <'] = $category['ProductCategory']['lft'];
            $params['conditions']['OR']['ProductCategory.rght >'] = $category['ProductCategory']['rght'];
        }
        $params['limit'] = 5;
        $params['order'] = 'Product.promoted DESC, RAND()';
        $products = $this->Product->find('all', $params);

        $this->set(compact('products'));
        if (!empty($category_id)) {
            $this->render('front');
        } else {
            $this->render('front_all');
        }
    }

    public function view($slug = null) {
//        $this->helpers[] = 'Fancybox.Fancybox';
        $slug = $this->Product->isSlug($slug);
        $id = $slug['id'];
        $this->Product->id = $id;

        if (!$slug) {
            throw new NotFoundException(__('Invalid localization'));
        }
        if (!empty($slug['error'])) {
            $this->redirect(array($slug['slug']), $slug['error']);
        }

        if (!$this->Product->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        $this->Product->Behaviors->attach('Containable');
        $this->Product->contain(array('Photo', 'Photos', 'ProductCategory'));
        $this->Product->recursive = 0;
        $product = $this->Product->read(null, $id);

        $accessories = $this->Product->getAccesories($product['Product']['id']);
        $simiarProducts = $this->Product->getSimilarProduct($product['Product']['id']);

        $this->Product->ProductCategory->setScope("ProductCategory.selection_id = {$this->selection_id}");

        //Uznaję, że pierwszy z brzegu to poprawny
        $activeProductCategory = @$product['ProductCategory'][0]['id'];

        $productCategories = $this->Product->getDynaTreeCategories($activeProductCategory);

        $this->set(compact('product', 'productCategories', 'category_id', 'simiarProducts', 'accessories', 'activeProductCategory'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index() {
        $this->layout = 'admin';
        $this->helpers[] = 'FebTime';
        $this->Product->recursive = 1;
        $this->Product->locale = Configure::read('Config.languages');
        $this->Product->bindTranslation(array('title' => 'translateDisplay'));

        $params['conditions']['Product.selection_id'] = $this->selection_id;

        $this->paginate = $params;

        $productCategories = $this->Product->ProductCategory->find('list');

        $this->set(compact('productCategories'));
        $this->set('products', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        $this->layout = 'admin';
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('product', $this->Product->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function admin_add() {
        $this->layout = 'admin';
        $this->helpers[] = 'FebTinyMce4';
        if ($this->request->is('post')) {
            $this->Product->create();
            $this->request->data['Product']['selection_id'] = $this->selection_id;
            if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index', 'selection' => $this->selections[$this->selection_id]));
            } else {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }

        $productCategories = $this->Product->ProductCategory->generateTreeList(array(
            'ProductCategory.selection_id' => $this->selection_id
                ));


        $this->set(compact('photos', 'productCategories'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->layout = 'admin';
        $this->helpers[] = 'FebTinyMce4';
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index', 'selection' => $this->selections[$this->selection_id]));
            } else {
                $this->Session->setFlash(__d('admin', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.', 'flash/error'));
            }
        } else {
            $this->Product->locale = Configure::read('Config.languages');
            $this->request->data = $this->Product->read(null, $id);
        }

        $productCategories = $this->Product->ProductCategory->generateTreeList(array(
            'ProductCategory.selection_id' => $this->selection_id
                ));

        $this->set(compact('photos', 'productCategories'));
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    function admin_delete($id = null, $all = null) {
        $this->FebI18n->delete($id, $all);
        $this->redirect(array('action' => 'index', 'selection' => $this->selections[$this->selection_id]), null, true);
    }

    /**
     * Akcja renderująca widok na liście produktów
     */
    public function admin_multiselect_index() {
        $success = 0;
        $products = array();
        $ids = $this->request->data['ids'];

        if (!empty($ids)) {
            $this->Product->locale = Configure::read('Config.languages');
            $this->Product->bindTranslation(array('title' => 'translateDisplay'));
            $params['conditions']['Product.id'] = $ids;
            $products = $this->Product->find('all', $params);
        }

        $this->set(compact('products', 'success', 'ids'));
    }

    /**
     * Akcja wyciągająca dane do multiselecta
     */
    public function admin_multiselect() {

        $params = array();
        $conditions = $this->postConditions($this->request->data, array(
            'Product.id' => '<>',
                ));
        unSet($conditions['Product.category_id']);

        $categories = $this->Product->ProductCategory->generateTreeList(array(
            'ProductCategory.selection_id' => $this->request->data['Product']['selection_id']
        ));

        $params['conditions'] = $conditions;

        if (!empty($this->request->data['Product']['category_id'])) {
            $params['joins'][] = array(
                'table' => 'products_product_categories',
                'alias' => 'ProductsProductCategory',
                'type' => 'INNER',
                'conditions' => array(
                    'ProductsProductCategory.product_id = Product.id',
                    "ProductsProductCategory.product_category_id = {$this->request->data['Product']['category_id']}",
                )
            );
            
        }


        $this->Product->locale = Configure::read('Config.languages');
        $this->Product->bindTranslation(array('title' => 'translateDisplay'));

        $products = $this->Product->find('all', $params);

        $this->set(compact('categories', 'products'));
    }

    public function admin_ctg_by_selection() {

        $categories = $this->Product->ProductCategory->generateTreeList($this->postConditions($this->request->data));

        $this->set(compact('categories'));
        $this->render('/Elements/Products/product_select');
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
        $params['fields'] = array('title');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['Product.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->Product->recursive = -1;
        $params['conditions']["Product.title LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->Product->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
