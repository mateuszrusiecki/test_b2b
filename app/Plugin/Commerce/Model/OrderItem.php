<?php
App::uses('AppModel', 'Model');
/**
 * OrderItem Model
 *
 * @property Order $Order
 * @property OrderItemFile $OrderItemFile
 */
class OrderItem extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();
    var $tablePrefix = 'commerce_';
    
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
	public $order = 'OrderItem.created DESC';

	/**
 	* belongsTo associations
 	*
 	* @var array
 	*/
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Commerce.Order',
			'foreignKey' => 'order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'Product.id',
			'conditions' => array('OrderItem.product_model' => 'Product'),
			'fields' => '',
			'order' => ''
		),
//		'WindowConfiguration' => array(
//			'className' => 'Window.WindowConfiguration',
//			'foreignKey' => 'product_id',
//			'conditions' => array('OrderItem.product_model' => 'WindowConfiguration'),
//			'fields' => '',
//			'order' => ''
//		),
		'Configuration' => array(
			'className' => 'Configuration',
			'foreignKey' => 'Configuration.id',
			'conditions' => array('OrderItem.product_model' => 'Configuration'),
			'fields' => '',
			'order' => ''
		),		
        //Ewentualnie powiazanie z produktem
	);

	/**
 	* hasMany associations
 	*
 	* @var array
 	*/
	public $hasMany = array(
		'OrderItemFile' => array(
			'className' => 'Commerce.OrderItemFile',
			'foreignKey' => 'order_item_id',
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

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array()) {
		$this->validate = array(
			'order_id' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'message' => __d('validate', 'Pole formularza nie może być puste'),
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'quantity' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'message' => __d('validate', 'Pole formularza nie może być puste'),
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'discount' => array(
				'numeric' => array(
					'rule' => array('numeric'),
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
        $this->virtualFields = array(
            'price_net' => 'IF(' . PRICE_TYPE . ", `{$this->alias}.price` - `{$this->alias}.tax_value`, `{$this->alias}.price`)",
            'price_gross' => 'IF(' . PRICE_TYPE . ", `{$this->alias}.price`, `{$this->alias}.price` + `{$this->alias}.tax_value)`",
        );       
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
//        $params['conditions']['OR']["OrderItem.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
    
    function afterSave($created) {
        if (isSet($this->data['OrderItem']['quantity']) or isSet($this->data['OrderItem']['price'])) {
            $order_id = empty($this->data['OrderItem']['order_id']) ? $this->field('order_id') : $this->data['OrderItem']['order_id'];
            $this->Order->recalculateTotal($order_id);
        }
        return true;
    }

    function beforeDelete() {
        $this->order_id = $this->field('order_id');
        return true;
    }

    function afterDelete() {
        $this->Order->recalculateTotal($this->order_id);
        return true;
    }
    
}

