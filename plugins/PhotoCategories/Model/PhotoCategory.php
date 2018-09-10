<?php
App::uses('AppModel', 'Model');
/**
 * PhotoCategory Model
 *
 */
class PhotoCategory extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array('Menu.Menu' => array('scope' => 'PhotoCategory.page_id = 4'), 'Modification.Modification');
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
	public $order = 'PhotoCategory.created DESC';
    
	/**
 	* belongsTo associations
 	*
 	* @var array
 	*/
	public $belongsTo = array();
    
    public $hasMany = array(
        'Photo' => array(
            'className' => 'Photo.Photo',
            'foreignKey' => 'photo_category_id',
            'dependent' => false,
            'conditions' => '',
            'order' => 'Photo.order ASC',
            'fields' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    
    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array()) {
		$this->validate = array(
			'name' => array(
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
    
    function setScope($scope) {
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
//        $params['conditions']['OR']["PhotoCategory.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}

