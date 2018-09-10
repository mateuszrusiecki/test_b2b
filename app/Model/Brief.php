<?php

App::uses('AppModel', 'Model');

/**
 * Brief Model
 *
 * @property User $User
 * @property ClientLead $ClientLead
 * @property BriefQuestion $BriefQuestion
 */
class Brief extends AppModel
{

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
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => '',
            'conditions' => array('Profile.user_id = Brief.user_id'),
            'fields' => 'firstname,surname,work_phone',
            'order' => ''
        ),
        'Guardian' => array(
            'className' => 'Profile',
            'foreignKey' => '',
            'conditions' => array('Guardian.user_id = Brief.guardian_id'),
            'fields' => 'firstname,surname,work_phone',
            'order' => ''
        ),
        'ClientLead' => array(
            'className' => 'ClientLead',
            'foreignKey' => 'client_lead_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => '',
            'conditions' => array('Client.id = ClientLead.client_id'),
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
        'BriefQuestion' => array(
            'className' => 'BriefQuestion',
            'foreignKey' => 'brief_id',
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
    public function beforeValidate($options = array())
    {
        
    }

    /**
     * Konstruktor klasy modelu
     * 
     * @param int $id
     * @param array $table
     * @param bool $ds 
     */
    function __construct($id = false, $table = null, $ds = null)
    {
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
//        $params['conditions']['OR']["Brief.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
	
	/*
	 * Funkcja znajduje najnowszy brief do danego leadu
	 * 
	 * @params	$client_lead_id		id leadu
	 *			$recursive			stopień rektursji: -1,0,1
	 * 
	 * @return mixed				array - tablica z danymi briefu
	 *								false - w przypdaku błędu
	 */
	function findByClientLeadId($client_lead_id = null,$recursive=0){
		if(empty($client_lead_id)){
			return false;
		}
		
		$params['conditions'] = array(
			'client_lead_id' => $client_lead_id,
		);
		$params['order'] = array(
			'Brief.id DESC'
		);
		$params['recursive'] = $recursive;
		return $this->find('first',$params);
	}
	

}
