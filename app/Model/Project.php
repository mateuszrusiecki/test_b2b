<?php

App::uses('AppModel', 'Model');

/**
 * Project Model
 *
 */
class Project extends AppModel
{

//    const defaultColor = '#777';
//    const TYPE_OTHER = 1;
//    const TYPE_CREATED = 2;
//    const TYPE_BEFORE_CONTRACT = 3;
//    const TYPE_ENDED = 4;
//    const TYPE_OWN = 5;
//
//    public static $TYPES = array(
//        Project::TYPE_OTHER => 'Stworzony automatycznie',
//        Project::TYPE_BEFORE_CONTRACT => 'Przed podpisaniem umowy',
//        Project::TYPE_CREATED => 'Podpisana umowa',
//        Project::TYPE_ENDED => 'Zakończony',
//        Project::TYPE_OWN => 'Projekt wewnętrzny',
//    );

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
//    public $actsAs = array();

    /**
     * Display field
     *
     * @var string
     */
//    public $displayField = 'name';

    /**
     *
     * sS@Ahasy3a
     *
     * Domyślne sortowanie
     *
     * @var string
     */
//    public $order = 'Project.created DESC';

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
//    public function beforeValidate($options = array())
//    {
//        $this->validate = array(
//            'alias' => array(
//                'notempty' => array(
//                    'rule' => array('notempty'),
//                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
//                ),
//            ),
//        );
//    }

  //  public $hasMany = array(
//        'ProjectCalculation' => array(
//            'className' => 'ProjectCalculation',
//            'foreignKey' => 'project_id',
//            'dependent' => true,
//            'conditions' => '',
//            'fields' => '',
//            'order' => '',
//            'limit' => '',
//            'offset' => '',
//            'exclusive' => '',
//            'finderQuery' => '',
//            'counterQuery' => ''
//        ),
//        'ProjectCost' => array(
//            'className' => 'ProjectCost',
//            'foreignKey' => 'project_id',
//            'dependent' => true,
//            'conditions' => '',
//            'fields' => '',
//            'order' => '',
//            'limit' => '',
//            'offset' => '',
//            'exclusive' => '',
//            'finderQuery' => '',
//            'counterQuery' => ''
//        ),
//        'ProjectIssue' => array(
//            'className' => 'ProjectIssue',
//            'foreignKey' => 'projects_id',
//            'dependent' => true,
//            'conditions' => '',
//            'fields' => '',
//            'order' => '',
//            'limit' => '',
//            'offset' => '',
//            'exclusive' => '',
//            'finderQuery' => '',
//            'counterQuery' => ''
//        )
//    );
//    public $belongsTo = array(
//        'AccountManager' => array(
//            'className' => 'User.User',
//            'foreignKey' => 'manager',
//            'conditions' => '',
//            'fields' => '',
//            'order' => ''
//        ),
//        'Coordinator' => array(
//            'className' => 'User.User',
//            'foreignKey' => 'cordinator',
//            'conditions' => '',
//            'fields' => '',
//            'order' => ''
//        )
//    );

    /**
     * @todo -> metoda prawdopodobnie do usunięcia
     *
     * Pobieranie danych z pojektu oraz na virala fields suma stawek 
     * oraz suma godzin w odpowiedzi daje tablic ProjectIssueEntry
     * 
     * @param type $projects_id
     * @return type array()
     * @throws ErrorException 
     */
//    public function getCostByProject($pid = null)
//    {
//        return $this->ProjectIssue->ProjectIssueEntry->getCostByProject($pid);
//    }

    /**
     * Konstruktor klasy modelu
     * 
     * @param int $id
     * @param array $table
     * @param bool $ds 
     */
//    function __construct($id = false, $table = null, $ds = null)
//    {
//        parent::__construct($id, $table, $ds);
        //$this->virtualFields = array('fullname' => "CONCAT({$this->alias}.field_1, ' ', {$this->alias}.field_2)");
//    }

    /**
     * Szula majmniejszeszej oraz najwiekszego czasu
     * w odpowiedzi zwraca tablice o kluczach time, maxTime, minTime
     * 
     * @param type $times
     * @return type array(time=>(int),maxTime=>(int),minTime=>(int))
     * @throws ErrorException 
     */
    public function calculateTime($times = array())
    {
        if(empty($times)){
            return false;
        }
        if (isSet($times['@end']))
        {
            $times = array($times);
        }

		//die(debug($times));
        $ret['time'] = array();
        $ret['maxTime'] = 0;
        $tmp = reset($times);
        $ret['minTime'] = strtotime($tmp['@start']);
        foreach ($times as $time)
        {
            $start = strtotime($time['@start']);
            $end = strtotime($time['@end']);
			
			$xol = date('Y_m', $start);
			//die(debug($start));
			if(empty($ret['time'][$xol])){
				$ret['time'][$xol] = 0;
			}
			
            $ret['time'][$xol] += $end - $start;
            if ($end > $ret['maxTime'])
            {
                $ret['maxTime'] = $end;
            }

            if ($start < $ret['minTime'])
            {
                $ret['minTime'] = $start;
            }
        }

        return $ret;
    }

    /**
     * Filtrowanie Project w zalezności od parametrów przesłanych w parmetrze
     * w odpowiedzi zwraca tablice z conditions
     * 
     * @param type $data
     * @return type array()
     * @throws ErrorException 
     */
//    function filterParams($data)
//    {
//        $params = array();
//        $privs = array_intersect(array(Group::SUPER_ADMIN, Group::ZARZAD, Group::GRAPHIC), array_keys($_SESSION['Auth']['Groups']));
//
//        if (empty($privs))
//        {
//            $params['conditions']['OR']['Project.manager'] = $_SESSION['Auth']['User']['id'];
//            $params['conditions']['OR']['Project.cordinator'] = $_SESSION['Auth']['User']['id'];
//        }
//
//        if (!empty($data['Project']['name']))
//        {
//            $this->virtualFields['name_alias'] = "CONCAT(Project.name, ' (', Project.alias, ')')";
//            $params['conditions']['Project.name_alias LIKE'] = '%' . $data['Project']['name'] . '%';
//        }
//
//        if (!empty($data['Project']['type']))
//        {
//            $params['conditions']['Project.type'] = $data['Project']['type'];
//        }
//
//        if (!empty($data['Project']['account']))
//        {
//            $params['conditions']['Project.manager'] = $data['Project']['account'];
//        }
//
//        if (!empty($data['Project']['coordinator']))
//        {
//            $params['conditions']['Project.cordinator'] = $data['Project']['coordinator'];
//        }
//
//        return $params;
//    }

    /**
     * Poprawka do zliczania paginacji
     * 
     * @param type $conditions
     * @param type $recursive
     * @param type $extra
     * @return type int
     * @throws ErrorException 
     */
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
//
//    public function beforeSave($options = array())
//    {
//        if (!$this->id)
//        {
//            $this->data[$this->alias]['color'] = '#' . dechex(rand(0, 10000000));
//        }
//    }
//
//    public function afterFind($results, $primary = false)
//    {
//
//        foreach ($results as &$project)
//        {
//            if (empty($project['Project']))
//                break;
//
//            if (isSet($project['Project']['type']) && $project['Project']['type'] == Project::TYPE_OTHER)
//            {
//                $project['Project']['color'] = '#CCC';
//            }
//        }
//
//        return $results;
//    }

    /**
     * Lista projektów
     * 
     * 
     * @return mixed            array z danymi profili
     *                          false w przeciwnym błedu
     */
    public function listProjects()
    {
        return $this->find('list');
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
//        $params['conditions']['OR']["Project.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}
