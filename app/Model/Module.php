<?php
App::uses('AppModel', 'Model');
/**
 * Module Model
 *
 * @property ClientProject $ClientProject
 * @property ModuleCategory $ModuleCategory
 */
class Module extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array('Image.Upload',);
    
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
	public $order = 'Module.created DESC';
        
        public $repTypes = array(
            'svn'=>'Svn',
            'git'=>'Git',
        );

	/**
 	* belongsTo associations
 	*
 	* @var array
 	*/
	public $belongsTo = array(
		'ClientProject' => array(
			'className' => 'ClientProject',
			'foreignKey' => 'client_project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ModuleCategory' => array(
			'className' => 'ModuleCategory',
			'foreignKey' => 'module_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ManagerUser' => array(
			'className' => 'User.User',
			'foreignKey' => 'manager_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ContactUser' => array(
			'className' => 'User.User',
			'foreignKey' => 'contact_user_id',
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
			'img' => array(
				'mime' => array(
					'rule'=>array('validateMime','image'),
					'message' => 'Ten formularz akceptuje jedynie pliki graficzne (jpeg, gif, png)',
				),
				'upload' => array(
					'rule'=>array('validateUpload'),
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
//        $params['conditions']['OR']["Module.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}

