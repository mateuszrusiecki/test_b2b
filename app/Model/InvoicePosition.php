<?php
App::uses('AppModel', 'Model');
/**
 * InvoicePosition Model
 *
 * @property Invoice $Invoice
 */
class InvoicePosition extends AppModel {

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
 	* belongsTo associations
 	*
 	* @var array
 	*/
	public $belongsTo = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'invoice_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array()) {
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
//        $params['conditions']['OR']["InvoicePosition.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}

