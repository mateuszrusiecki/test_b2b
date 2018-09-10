<?php
App::uses('AppModel', 'Model');
/**
 * ProjectFileCategory Model
 *
 * @property ProjectFile $ProjectFile
 */
class ProjectFileCategory extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();
    
    /**
    * Display field
    *
    * @var string
    */
	public $displayField = 'name';

	/**
 	* hasMany associations
 	*
 	* @var array
 	*/


    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
//    public function beforeValidate($options = array()) {
//		$this->validate = array(
//			'name' => array(
//				'notempty' => array(
//					'rule' => array('notempty'),
//					'message' => __d('validate', 'Pole formularza nie może być puste'),
//					//'allowEmpty' => false,
//					//'required' => false,
//					//'last' => false, // Stop validation after this rule
//					//'on' => 'create', // Limit validation to 'create' or 'update' operations
//				),
//			),
//			'user_accessible' => array(
//				'numeric' => array(
//					'rule' => array('numeric'),
//					'message' => __d('validate', 'Pole formularza nie może być puste'),
//					//'allowEmpty' => false,
//					//'required' => false,
//					//'last' => false, // Stop validation after this rule
//					//'on' => 'create', // Limit validation to 'create' or 'update' operations
//				),
//			),
//		);
//    }
    
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
//        $params['conditions']['OR']["ProjectFileCategory.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
	
	
	/*
	 * Metoda wyszukuje wszystkie kategorie plików
	 */
	function getAll(){
		return $this->find('all');
	}
	
	
	/*
	 * Metoda wyszukuje wszystkie kategorie plików
	 */
	function getList(){
		return $this->find('list');
	}
}

