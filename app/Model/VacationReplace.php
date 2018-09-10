<?php

App::uses('AppModel', 'Model');

/**
 * VacationReplace Model
 *
 * @package b2b
 * @property Vacation $Vacation
 * @property User $User
 * @property Project $Project
 */
class VacationReplace extends AppModel
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
    public $displayField = 'vacation_id';

    /**
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'VacationReplace.created DESC';

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Vacation' => array(
            'className' => 'Vacation',
            'foreignKey' => 'vacation_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
//		'Project' => array(
//			'className' => 'Project',
//			'foreignKey' => 'project_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		)
    );

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array())
    {
        $this->validate = array(
            'vacation_id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'user_id' => array(
                'uuid' => array(
                    'rule' => array('uuid'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'project_id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'no_project' => array(
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
//        $params['conditions']['OR']["VacationReplace.vacation_id LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }

    /**
     * Lista zastępstw
     * 
     * @param int $vacation_id     ID urlopu
     * 
     * @return mixed            array z danymi do zastępstwami
     *                          false w przeciwnym błedu
     */
    public function listVacationProfile($vacation_id = null)
    {
        if (!$vacation_id)
        {
            return false;
        }

        $params['conditions'] = array(
            'VacationReplace.vacation_id' => $vacation_id
        );
        $params['recursive'] = -1;
        $params['fields'] = $this->fields;

        $type = $this->find('all', $params);

        return !empty($type) ? $type : false;
    }

    /**
     * Zapis zastępstwa do projektu
     * 
     * @param int $user_id     ID użytkownika
     * @param array $data     tablica array(
     *                                 project_id,
     *                                 user_id,
     *                                 vacation_id
     *                                 )
     * 
     * @return bool            true w przypadku zapisania danych
     *                          false w przeciwnym błedu
     */
    public function saveVacationReplace($user_id = null, $data = array())
    {
        if (!$user_id || !$data)
        {
            return false;
        } else
        {
            $data['user_id'] = $user_id;
            if (empty($data['project_id']) || $data['project_id'] == 0)
            {
                $data['no_project'] = 1;
                $data['project_id'] = 0;
            }
        }

        $this->create();
        if ($this->save($data))
        {
            return true;
        } else {
            return false;
        }
    }

}
