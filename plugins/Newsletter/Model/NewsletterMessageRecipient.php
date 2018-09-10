<?php
App::uses('AppModel', 'Model');
/**
 * NewsletterMessageRecipient Model
 *
 * @property NewsletterMessage $NewsletterMessage
 */
class NewsletterMessageRecipient extends AppModel {

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
	public $displayField = 'recipient_email';
    /**
    * Domyślne sortowanie
    *
    * @var string
    */
	public $order = 'NewsletterMessageRecipient.created DESC';

	/**
 	* belongsTo associations
 	*
 	* @var array
 	*/
	public $belongsTo = array(
		'NewsletterMessage' => array(
			'className' => 'NewsletterMessage',
			'foreignKey' => 'newsletter_message_id',
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
		$this->validate = array(
			'newsletter_message_id' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'message' => __d('validate', 'Pole formularza nie może być puste'),
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'recipient_email' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __d('validate', 'Pole formularza nie może być puste'),
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'sent' => array(
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
//        $params['conditions']['OR']["NewsletterMessageRecipient.recipient_email LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}

