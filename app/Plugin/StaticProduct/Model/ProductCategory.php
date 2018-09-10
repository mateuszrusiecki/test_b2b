<?php

App::uses('AppModel', 'Model');

/**
 * ProductCategory Model
 *
 */
class ProductCategory extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array(
        'Menu.Menu',
        'Slug.Slug',
        'Translate' => array('name', 'slug')
    );

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'ProductCategory.created DESC';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
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
     * Konstruktor klasy modelu
     * 
     * @param int $id
     * @param array $table
     * @param bool $ds 
     */
    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        //$this->virtualFields = array('fullname' => "CONCAT({$this->alias}.field_1, ' ', {$this->alias}.field_2)");
    }

    public function setScope($scope) {
        $this->Behaviors->attach('Menu.Menu', array('scope' => $scope));
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
//        $params['conditions']['OR']["ProductCategory.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}

