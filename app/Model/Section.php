<?php

App::uses('AppModel', 'Model');

/**
 * Section Model
 *
 * @property UserUser $UserUser
 * @property User $User
 */
class Section extends AppModel
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
    public $belongsTo = array(
        'Supervisor' => array(
            'className' => 'User.User',
            'foreignKey' => 'supervisor',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'User' => array(
            'className' => 'User.User',
            'joinTable' => 'user_sections',
            'foreignKey' => 'section_id',
            'associationForeignKey' => 'user_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
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
//        $params['conditions']['OR']["Section.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }

    /**
     * Wyszukuje przełożonego po user_id pracownika
     * 
     * @param char $user_id
     * @return type array
     * @return type bool 
     */
    function findSupervisorByUser($user_id = null)
    {
        if (!$this->User->exists($user_id))
        {
            return false;
        }
        $supervisorCEO = $this->checkUserIsCEO($user_id);  // sprawdzenie czy zalogował się prezes (nie ma nad sobą przełożonego) 
        if ($supervisorCEO == true)
        {
            return false;
        } else
        {
            $supervisorCoordinator = $this->getSupervisorCoordintor($user_id); // sprawdzenie czy to jest koordynator i pobranie jego przelozonego
            if (!empty($supervisorCoordinator))
            {
                return $supervisorCoordinator;
            } else
            {
                return $this->getNormalUserSupervisor($user_id);
            }
        }
    }

    /**
     * Pobranie listy wszystkich handlowców
     * 
     * @return type array
     */
    function getMerchants()
    {
        $params['recursive'] = -1;
        $params['conditions']['Section.name'] = 'Handlowcy';
        $params['joins'] = array(
            array(
                'table' => 'user_sections',
                'alias' => 'UserSection',
                'type' => 'LEFT',
                'conditions' => array(
                    'Section.id = UserSection.section_id'
                )
            ),
            array(
                'table' => 'profiles',
                'alias' => 'Profile',
                'type' => 'LEFT',
                'conditions' => array(
                    'UserSection.user_id = Profile.user_id'
                )
            ),
        );
        $this->virtualFields['profile_name'] = 'concat(`Profile`.`firstname`," ",`Profile`.`surname`)';
        $params['fields'] = array('UserSection.user_id', 'profile_name');
        $list = $this->find('list', $params);
        $this->virtualFields = array();
        return $list;
    }

    function findWithoutUserList($params = array())
    {
        $params['recursive'] = -1;
        $params['joins'] = array(
            array(
                'table' => 'profiles',
                'alias' => 'Profile',
                'type' => 'INNER',
                'conditions' => array(
                    'Section.supervisor = Profile.user_id'
                )
            ),
        );
        $params['fields'] = array('id', 'profile_name');
        $this->virtualFields['profile_name'] = 'concat(`Section`.`name`,", ",`Profile`.`firstname`," ",`Profile`.`surname`)';
        $sections = $this->find('list', $params);
        if (empty($sections))
        {
            return false;
        }
        $this->virtualFields = array();
        return $sections;
    }

    /*
     * Metoda wyszukuje działy które mają nieedytowalne koszty i roboczogodziny
     * "Dla działów IT zdefiniowane są podstawowe grupy kosztów wraz ze stawką za roboczogodzinę. Wartości te są nieedytowalne" dokumentacja s.37
     */

    function getProjectBudgetCostsUneditableSectionList($params = array())
    {
        $params['recursive'] = -1;
        $params['joins'][] = array(
            'table' => 'profiles',
            'alias' => 'Profile',
            'type' => 'LEFT',
            'conditions' => array(
                'Section.supervisor = Profile.user_id'
            )
        );
        $params['conditions']['project_budget_costs_uneditable'] = true;
        $params['fields'] = array('id', 'name');
        $sections = $this->find('list', $params);
        if (empty($sections))
        {
            return false;
        }

        return $sections;
    }

    /**
     *  funkcja pobierająca listę userów którzy są szefami działów firmy
     * 
     * 
     * @return array 
     */
    public function getSectionsBoss()
    {

        $userParms['recursive'] = -1;
        $userParms['joins'] = array(
            array('table' => 'profiles',
                'alias' => 'Supervisor',
                'type' => 'LEFT',
                'conditions' => array(
                    'Section.supervisor = Supervisor.user_id',
                )
        ));
        $userParms['fields'] = array('Supervisor.id', 'Supervisor.user_id', 'Supervisor.firstname', 'Supervisor.surname', 'Supervisor.position', 'Section.*');
        $bossList = $this->find('all', $userParms);
        $returnArray = array();
        //die(debug($bossList));
        foreach ($bossList as $boss)
        {
            $returnArray[$boss['Supervisor']['user_id']] = $boss['Supervisor']['firstname'] . ' ' . $boss['Supervisor']['surname'];
        }
        return $returnArray;
    }

    public function getUserBySection($section_id)
    {
        if (!$this->exists($section_id))
        {
            return false;
        }
        $params['conditions']['Section.id'] = $section_id;
        $params['recursive'] = -1;
        $return = $this->find('first', $params);
        $userParms['recursive'] = -1;
        $userParms['joins'] = array(
            array('table' => 'user_sections',
                'alias' => 'UserSection',
                'type' => 'LEFT',
                'conditions' => array(
                    'Profile.user_id = UserSection.user_id',
                )
            ),
            array('table' => 'user_users',
                'alias' => 'User',
                'type' => 'LEFT',
                'conditions' => array(
                    'User.id = UserSection.user_id',
                )
            )
        );
        $userParms['fields'] = array('Profile.name', 'Profile.position', 'User.avatar', 'User.avatar_url', 'User.email', 'User.id');
        $userParms['conditions']['UserSection.section_id'] = $section_id;
        $userParms['conditions']['NOT']['UserSection.user_id'] = $return['Section']['supervisor'];
        $return['Profile'] = $this->User->Profile->find('all', $userParms);
        //debug($return);
        if (isset($return['Section']))
        {
            $userSupervisor['conditions']['Profile.user_id'] = $return['Section']['supervisor'];
        }
        $userSupervisor['fields'] = array('Profile.name');
        $return['Supervisor'] = $this->User->Profile->find('first', $userSupervisor);
        return $return;
    }

    public function checkUserIsCEO($user_id)
    {
        if (empty($user_id))
        {
            return false;
        }
        if (!$this->User->exists($user_id))
        {
            return false;
        }
        $this->recursive = -1;
        $params = array();
        $params['fields'] = array(
            'supervisor',
        );
        $params['conditions'] = array(
            'name' => 'Zarząd',
        );
        $ceoId = $this->find('list', $params);
        if (reset($ceoId) == $user_id)
        {
            return true;
        } else
        {
            return false;
        }
    }

    public function getSupervisorCoordintor($user_id)
    {
        $isCoordintator = $this->checkIsCoordinator($user_id);
        if ($isCoordintator == true)
        {
            $userCEO = $this->getCEOId();

            $params['recursive'] = -1;
            $params['joins'] = array(
                array(
                    'table' => 'user_users',
                    'alias' => 'User',
                    'fields' => 'email',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Section.supervisor = User.id'
                    )
                ),
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Section.supervisor = Profile.user_id'
                    )
                ),
            );
            $params['conditions'] = array(
                'Section.supervisor' => $userCEO
            );
//            $params['fields'] = array(
//                'Profile.firstname',
//                'Profile.surname',
//                'User.email',
//                'Section.*',
//            );

            $this->virtualFields['profile_name'] = 'concat(`Profile`.`firstname`," ",`Profile`.`surname`)';
            $this->virtualFields['email'] = '`User`.`email`';
            $return = $this->find('first', $params);
            $this->virtualFields = array();
            return $return;
        } else
        {
            return false;
        }
    }

    /*
     *  Pobranie user_id  szefa firmy  
     */

    public function getCEOId()
    {
        $params = array();
        $params['fields'] = array(
            'supervisor'
        );
        $params['conditions'] = array(
            'Section.id' => 1,
            'Section.name' => 'Zarząd'
        );
        $return = $this->find('first', $params);
        $return = $return['Section']['supervisor'];
        return $return;
    }

    /**
     * Sprawdzenie czy user znajduje się w tabeli sections 
     * 
     * @param char(36) $user_id
     * @return bool
     */
    public function checkIsCoordinator($user_id = null)
    {
        if (empty($user_id))
        {
            return false;
        }
        $params = array();
        $params['recursive'] = -1;
        $params['conditions'] = array(
            'supervisor' => $user_id
        );
        $return = $this->find('first', $params);
        return !empty($return);
    }

    /**
     * Pobranie przełożonego zwykłego pracownika
     * 
     * @param type $user_id
     * @return array
     */
    public function getNormalUserSupervisor($user_id)
    {
        $params['recursive'] = -1;
        $params['joins'] = array(
            array(
                'table' => 'user_sections',
                'alias' => 'UserSection',
                'type' => 'INNER',
                'conditions' => array(
                    'Section.id = UserSection.section_id',
                    'UserSection.user_id' => $user_id
                )
            ),
            array(
                'table' => 'profiles',
                'alias' => 'Profile',
                'type' => 'INNER',
                'conditions' => array(
                    'Section.supervisor = Profile.user_id'
                )
            ),
            array(
                'table' => 'user_users',
                'alias' => 'User',
                'type' => 'LEFT',
                'conditions' => array(
                    'Section.supervisor = User.id'
                )
            ),
        );
        $this->virtualFields['profile_name'] = 'concat(`Profile`.`firstname`," ",`Profile`.`surname`)';
        $this->virtualFields['email'] = '`User`.`email`';
        $return = $this->find('first', $params);
        $this->virtualFields = array();
        return $return;
    }

    /**
     * Pobranie wszystkich uzytkowników nalezoncej do danej sekcji 
     * i pogurowane po niej
     * 
     * @return array
     */
    public function listUserGroupSection()
    {
        $userParms['recursive'] = -1;
        $userParms['joins'] = array(
            array('table' => 'user_sections',
                'alias' => 'UserSection',
                'type' => 'LEFT',
                'conditions' => array(
                    'Profile.user_id = UserSection.user_id',
                )
            ),
            array('table' => 'sections',
                'alias' => 'Section',
                'type' => 'LEFT',
                'conditions' => array(
                    'UserSection.section_id = Section.id',
                )
            ),
            array('table' => 'user_users',
                'alias' => 'User',
                'type' => 'LEFT',
                'conditions' => array(
                    'User.id = UserSection.user_id',
                )
            )
        );
        $userParms['fields'] = array('Profile.user_id', 'Profile.name', 'Section.name');
        $return = $this->User->Profile->find('list', $userParms);
        return $return;
    }

    /**
     * Pobranie wszystkich uzytkowników nalezoncej do danej sekcji 
     * 
     * 
     * @return array
     */
    public function listUserBySectionId($section_id = null)
    {
        if (!$this->exists($section_id))
        {
            return false;
        }

        $userParms['recursive'] = -1;
        $userParms['joins'] = array(
            array('table' => 'user_sections',
                'alias' => 'UserSection',
                'type' => 'INNER',
                'conditions' => array(
                    'Profile.user_id = UserSection.user_id',
                    'UserSection.section_id'=>$section_id,
                )
            ),
            array('table' => 'sections',
                'alias' => 'Section',
                'type' => 'INNER',
                'conditions' => array(
                    'UserSection.section_id = Section.id',
                )
            )
        );
        $userParms['fields'] = array('Profile.user_id', 'Profile.name');
        $return = $this->User->Profile->find('list', $userParms);
        return $return;
    }

    /**
     * Pobranie wszystkich uzytkowników nalezoncej do danej sekcji 
     * i pogurowane po niej
     * 
     * @return array
     */
    public function getTileBySection($section_id = null)
    {
        if (!$this->exists($section_id))
        {
            return false;
        }
        $userParms['recursive'] = -1;
        $userParms['joins'] = array(
            array('table' => 'user_sections',
                'alias' => 'UserSection',
                'type' => 'INNER',
                'conditions' => array(
                    'Profile.user_id = UserSection.user_id',
                    'UserSection.section_id' => $section_id,
                )
            ),
            array('table' => 'user_users',
                'alias' => 'User',
                'type' => 'LEFT',
                'conditions' => array(
                    'User.id = UserSection.user_id',
                )
            )
        );
        $userParms['fields'] = array('Profile.name', 'Profile.position', 'Profile.id','User.avatar', 'User.avatar_url', 'User.email', 'User.id');
        $return = $this->User->Profile->find('all', $userParms);
        return $return;
    }

}
