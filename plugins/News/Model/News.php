<?php
App::uses('AppModel', 'Model');
/**
 * News Model
 *
 * @property User $User
 * @property Photo $Photo
 * @property Photo $Photo
 */
class News extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array(
        'Slug.Slug',
        'Translate' => array('title', 'content', 'slug')
    );
    
    /**
    * Display field
    *
    * @var string
    */
	public $displayField = 'title';
    /**
    * Domyślne sortowanie
    *
    * @var string
    */
	public $order = 'News.date DESC';

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
		'Photo' => array(
			'className' => 'Photo.Photo',
			'foreignKey' => 'photo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
 	* hasMany associations
 	*
 	* @var array
 	*/
	public $hasMany = array(
		'Photos' => array(
			'className' => 'Photo.Photo',
			'foreignKey' => 'news_id',
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
			'main' => array(
				'boolean' => array(
					'rule' => array('boolean'),
					'message' => __d('validate', 'Pole formularza nie może być puste'),
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'slug' => array(
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
//        $params['conditions']['OR']["News.title LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}

