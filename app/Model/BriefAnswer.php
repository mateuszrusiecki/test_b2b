<?php
App::uses('AppModel', 'Model');
/**
 * BriefAnswer Model
 *
 * @property User $User
 * @property BriefQuestion $BriefQuestion
 */
class BriefAnswer extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();
    

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
			'conditions' => array('Profile.user_id = BriefAnswer.user_id'),
			'fields' => 'firstname,surname',
			'order' => ''
        ),
		'BriefQuestion' => array(
			'className' => 'BriefQuestion',
			'foreignKey' => 'brief_question_id',
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
//        $params['conditions']['OR']["BriefAnswer. LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}

