<?php

App::uses('AppModel', 'Model');
App::uses('ProjectUser', 'Model');

/**
 * ProjectIssue Model
 *
 * @property Project $Project
 * @property ProjectUser $ProjectUser
 */
class ProjectIssue extends AppModel
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
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'ProjectIssue.id DESC';

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'client_project_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ProjectUser' => array(
            'className' => 'ProjectUser',
            'foreignKey' => 'project_users_name',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    public $hasMany = array(
        'ProjectIssueEntry' => array(
            'className' => 'ProjectIssueEntry',
            'foreignKey' => 'project_issue_id',
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
	
	public $virtualFields = array(
        'name' => 'CONCAT(ProjectIssue.project, " ", ProjectIssue.name)'
    );
    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array())
    {
        $this->validate = array(
            'project_user_id' => array(
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

    public function beforeFind($queryData)
    {
        if (isSet($_SESSION['Auth']['Groups']))
        {
            if (!empty($_SESSION['Auth']['User']['pm_user']) && (key_exists('m_it', $_SESSION['Auth']['Groups']) || key_exists('w_it', $_SESSION['Auth']['Groups']) || key_exists('z_it', $_SESSION['Auth']['Groups']) ))
            {
                //$queryData['conditions']['ProjectIssue.project_users_name'] = AuthComponent::user('ProjectUser.name');
                $queryData['conditions']['ProjectIssue.project_users_name'] = $_SESSION['Auth']['User']['pm_user'];
            }
        }
        return $queryData;
    }

    public $findMethods = array('issue' => true);

//    protected function _findIssue($state, $query, $results = array())
//    {
//        if ($state == 'before')
//        {
//            //$query['conditions']['Article.published'] = true;
//            return $query;
//        }
//        return $results;
//    }

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
    }

//    function filterParams($data)
//    {
//
//        $params['joins'][] = array(
//            'table' => 'project_issue_entries',
//            'alias' => 'ProjectIssueEntry',
//            'type' => 'LEFT',
//            'conditions' => array(
//                'ProjectIssueEntry.project_issue_id = ProjectIssue.id',
//            )
//        );
//        $params['group'] = "ProjectIssue.id";
//
//        $this->virtualFields['godziny'] = "SUM(((UNIX_TIMESTAMP(ProjectIssueEntry.end) - UNIX_TIMESTAMP(ProjectIssueEntry.start)) / 3600))";
//
////        if (isSet($data['Filter']['p_type'])) {
////            $params['conditions']['Project.type'] = $data['Filter']['p_type'];
////        }
//
//        if (isSet($data['Filter']['project']))
//        {
//            $params['conditions']['ProjectIssue.project LIKE'] = '%' . $data['Filter']['project'] . '%';
//        }
//
//        if (!empty($data['Filter']['client_project_id']))
//        {
//            $params['conditions']['ProjectIssue.client_project_id'] = $data['Filter']['client_project_id'];
//        }
//
//
//        if (isSet($data['Filter']['issue']))
//        {
//            $params['conditions']['ProjectIssue.name LIKE'] = '%' . $data['Filter']['issue'] . '%';
//        }
//
//        if (!empty($data['Filter']['pracownik']))
//        {
//
//            if ($data['Filter']['pracownik'] != '-1')
//            {
//                $params['conditions']['ProjectIssue.project_users_name'] = $data['Filter']['pracownik'];
//            }
//        } else
//        {
//            $params['conditions']['ProjectIssue.project_users_name'] = null;
//        }
//
//        if (!empty($data['Filter']['start']))
//        {
//            $params['conditions']['ProjectIssueEntry.start >='] = $data['Filter']['start'];
//        }
//
//        if (!empty($data['Filter']['end']))
//        {
//            $params['conditions']['ProjectIssueEntry.end <='] = $data['Filter']['end'];
//        }
//        return $params;
//    }

//    function paginateCount($conditions = null, $recursive = 0, $extra = array())
//    {
//        if (!empty($extra['group']))
//        {
//            $field = $extra['group'];
//            unSet($extra['group']);
//            $params = array_merge(
//                    array('conditions' => $conditions), array('fields' => array("COUNT(DISTINCT {$field}) AS count")), $extra
//            );
//            $results = $this->find('all', $params);
//            return $results[0][0]['count'];
//        }
//
//        $params = array_merge(array('conditions' => $conditions), array());
//
//        return $this->find('count', $params);
//    }

    /**
     * Wyciąganie przepracowanego czasu z Grindstone po synchronizacji
     * 
     * @param string $username  Nazwa użytkownika z dashboard
     * @return mixed            array Liczba godzin, gdy użytkownik istnieje
     *                          false, gdy nie istnieje
     */
    public function getTime($username=null)
    {
        if(!$username) {
            return false;
        }
        
        
        $times = $this->find('all', array(
            'conditions' => array(
                'ProjectIssue.project_users_name' => $username
            ),
            'recursive' => -1,
            'order' => array(
                'ProjectIssue.start'
            ),
        ));
        
        $work_time = array();
        foreach($times as $time) {
            $year = date('Y',strtotime($time['ProjectIssue']['end']));
            $month = date('m',strtotime($time['ProjectIssue']['end']));
            
            $date_start = new DateTime($time['ProjectIssue']['start']);
            $date_end = new DateTime($time['ProjectIssue']['end']);
            $issue_time = $date_start->diff($date_end);
            
            if(empty($work_time[$year][$month])) {
                $work_time[$year][$month] = $issue_time;
            } else {
                $tmp = new DateTime('00:00');
                $tmp_old = clone $tmp;
                $tmp->add($issue_time);
                $tmp->add($work_time[$year][$month]);
                $work_time[$year][$month] = $tmp_old->diff($tmp);
            }
            
        }
        
        foreach($work_time as &$year) {
            ksort($year);
        }
        
        
        return $work_time;
    }
	
	/**
     * Wyciąganie przepracowanego czasu z Grindstone po synchronizacji
     * 
     * @param string $username  Nazwa użytkownika z dashboard
     * @return mixed            array Liczba godzin, gdy użytkownik istnieje
     *                          false, gdy nie istnieje
     */
    public function getTimeByDate($user_id=null,$year=null,$month=null)
    {
        if(empty($user_id) || empty($year) || empty($month)) {
            return false;
        }
		
        $result = $this->find('all', array(
            'conditions' => array(
                'ProjectIssue.user_id' => $user_id,
				'ProjectIssue.year' => $year,
				'ProjectIssue.month' => $month,
            ),
            'recursive' => -1,
        ));
		
        $work_time = 0;
        foreach($result as $value) {
			$work_time += $value['ProjectIssue']['time'];
		} 
		
		return $work_time;
	}
	
	
	/**
     * Lista projektów
     * 
     * 
     * @return mixed            array z danymi profili
     *                          false w przeciwnym błedu
     */
    public function listProjectIssues()
    {
        $params['fields'] = array(
            'id',
            'project',
            'name'
        );
        return $this->find('list');
    }

}
