<?php

App::uses('AppModel', 'Model');
App::uses('FebCategory', 'Category');

/**
 * Product Model
 *
 * @property Photo $Photo
 * @property ProductCategory $ProductCategory
 */
class Product extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array(
        'Image.Upload',
        'Slug.Slug',
        'Translate.TranslateRelated',
        'Translate' => array('title', 'content', 'slug', 'tiny_content', 'tech', 'application', 'layout'),
    );

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'title';

    /**
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'Product.created DESC';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'slug' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Photo' => array(
            'className' => 'Photo.Photo',
            'foreignKey' => 'photo_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Photos' => array(
            'className' => 'Photo.Photo',
            'foreignKey' => 'product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    public $hasAndBelongsToMany = array(
        'ProductCategory' => array(
            'className' => 'StaticProduct.ProductCategory',
            'joinTable' => 'products_product_categories',
            'foreignKey' => 'product_id',
            'associationForeignKey' => 'product_category_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'SimilarProduct' => array(
            'className' => 'StaticProduct.SimilarProduct',
            'joinTable' => 'products_similar_products',
            'foreignKey' => 'similar_product_id',
            'associationForeignKey' => 'product_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'SimilarProductRevert' => array(
            'className' => 'StaticProduct.SimilarProduct',
            'joinTable' => 'products_similar_products',
            'foreignKey' => 'product_id',
            'associationForeignKey' => 'similar_product_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'Accessory' => array(
            'className' => 'StaticProduct.Accessory',
            'joinTable' => 'products_accessories',
            'foreignKey' => 'accessory_id',
            'associationForeignKey' => 'product_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );

    /**
     * Wyciąga dane do modułu frontowych boxów
     * 
     * @return type array
     */
    public function frontBox($params, $selection = 0) {
        $this->Behaviors->attach('Containable');

        $this->contain('Photo');

        return $this->find('all', array(
            'conditions' => array(
                'Product.promoted' => 1,
                'Product.selection_id' => $selection
            )
        ));
    }

    public function afterFind($results, $primary = false) {
        foreach ($results as $k => &$r) {
            if (isSet($r['SimilarProductRevert']) && isSet($r['SimilarProduct'])) {
                $r['SimilarProduct'] = am($r['SimilarProduct'], $r['SimilarProductRevert']);
            }
        }
        return $results;
    }

    public function getAccesories($productId = null) {

        $params['joins'][] = array(
            'table' => 'products_accessories',
            'alias' => 'ProductsAccessory',
            'type' => 'INNER',
            'conditions' => array(
                "ProductsAccessory.accessory_id = {$productId}",
                "ProductsAccessory.product_id = Product.id",
            )
        );

        return $this->find('all', $params);
    }

    public function getSimilarProduct($productId = null, $fields = array()) {

        $params['joins'][] = array(
            'table' => 'products_similar_products',
            'alias' => 'ProductsSimilarProduct',
            'type' => 'INNER',
            'conditions' => array(
                "ProductsSimilarProduct.similar_product_id = {$productId}",
                "ProductsSimilarProduct.product_id = Product.id",
            )
        );

        return $this->find('all', $params);
    }

    public function getDynaTreeCategories($activeProductCategory = null) {

        $productProductCategory = ClassRegistry::init('StaticProduct.ProductsProductCategory');

        $productCategories = $this->ProductCategory->findTree();

        //Pierwszy z brzegu
        $this->activeProductCategory = $activeProductCategory;

        $parents = $this->ProductCategory->getPath($activeProductCategory);
        
        $this->dynaTreeParents = Set::combine($parents, '{n}.ProductCategory.id', '{n}.ProductCategory.id');
        
        $this->categoryWithProducts = $productProductCategory->find('list', array(
            'fields' => array(
                'product_category_id', 'product_category_id'
            ),
            'group' => 'product_category_id'
        ));
        
        FebCategory::reorganizeDataTree($productCategories, 'ProductCategory', $this, function($data, $_this) {
                    $data['title'] = $data['name'];

                    $data['isFolder'] = true;
                    
                    if (in_array($data['id'], $_this->categoryWithProducts)) {
                        $data['isFolder'] = false;
                    }
                    
                    $data['isActive'] = 0;

                    if ($_this->activeProductCategory == $data['id']) {
                        $data['isActive'] = 1;
                    }

                    if (in_array($data['id'], $_this->dynaTreeParents)) {
                        $data['expand'] = true;
                    }
                });

        unSet($this->dynaTreeParents, $this->activeProductCategory);
        
        return $productCategories;
    }

    /**
     * Konstruktor klasy modelu
     * 
     * @param int $id
     * @param array $table
     * @param bool $ds 
     */
    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
//$this->virtualFields = array('fullname' => "CONCAT({$this->alias}.field_1, ' ', {$this->alias}.field_2)");
//        $this->getEventManager()->dispatch(new CakeEvent('Model.Product.afterInit', $this));
    }

    public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {

        if (!is_array($this->locale)) {
            $results = $this->find('first', array(
                'conditions' => $conditions,
                'fields' => array('COUNT(DISTINCT Product.id) AS cnt', 'Product.title', 'Product.content')
                    ));
            return $results[0]['cnt'];
        } else {
            if (!empty($extra['group'])) {
                $field = $extra['group'];
                unSet($extra['group']);
                $params = array_merge(
                        array('conditions' => $conditions), array('fields' => array("COUNT(DISTINCT {$field}) AS count")), $extra
                );
                $results = $this->find('all', $params);
                return $results[0][0]['count'];
            }

            $params = array_merge(array('conditions' => $conditions), array());

            return $this->find('count', $params);
        }
    }

    /**
     * Logika dla globalnej wyszukiwarki w cms
     * nadpisuje metodę z AppModel
     * 
     * @param array $options
     * @param array $params
     * @return type array
     */
//    public function search($options, $params = array()) {
//        $fraz = $options['Searcher']['fraz'];
//        $params['conditions']['OR']["Product.title LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}

