<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class Contact extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array('Translate' => array('name'));
    
    /**
    * Display field
    *
    *
    * @var string
    */
	public $displayField = 'name';
    /**
    * Domyślne sortowanie
    *
    * @var string
    */
	public $order = 'Contact.created DESC';
    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array()) {
		$this->validate = array(
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
			'show' => array(
				'boolean' => array(
					'rule' => array('boolean'),
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
//        $params['conditions']['OR']["Contact.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}

