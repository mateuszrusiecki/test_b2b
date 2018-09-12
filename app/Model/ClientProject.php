<?php

App::uses('AppModel', 'Model');

/**
 * ClientProject Model
 *
 * @property ClientLead $ClientLead
 * @property User $User
 */
class ClientProject extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array('Containable');

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
    public $order = 'ClientProject.created DESC';
    public $status = array(
        1 => 'Przed podpisaniem umowy',
        2 => 'Podpisana umowa',
        3 => 'Zakończony',
        4 => 'Wewnętrzny'
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'ClientLead' => array(
            'className' => 'ClientLead',
            'foreignKey' => 'client_lead_id',
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
        'ProjectAuthor' => array(
            'className' => 'UserUser',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ProjectAuthorsProfile' => array(
            'className' => 'Profile',
            'foreignKey' => false,
            'conditions' => 'ProjectAuthorsProfile.user_id = ClientProject.user_id',
            'fields' => '',
            'order' => ''
        ),
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => '',
            'conditions' => array('Profile.user_id = ClientProject.user_id'),
            'fields' => 'firstname,surname',
            'order' => ''
        )
    );
    public $hasMany = array(
        'ClientProjectShedule' => array(
            'className' => 'ClientProjectShedule',
            'foreignKey' => 'client_project_id',
            'dependent' => false
        ),
        'BaseModule' => array(
            'className' => 'BaseModule',
            'foreignKey' => 'client_project_id',
        ),
    );
    public $hasOne = array(
        'ClientProjectBudget' => array(
            'className' => 'ClientProjectBudget',
            'foreignKey' => 'client_project_id',
            'dependent' => false
        )
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
//    public $hasAndBelongsToMany = array(
//        'ClientSection' => array(
//            'className' => 'User.User',
//            'joinTable' => 'client_project_users',
//            'foreignKey' => 'client_project_id',
//            'associationForeignKey' => 'user_id',
//            'unique' => true,
//            'conditions' => '',
//            'fields' => '',
//            'order' => '',
//            'limit' => '',
//            'offset' => '',
//            'finderQuery' => '',
//            'deleteQuery' => '',
//            'insertQuery' => ''
//        )
//    );

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
//        $params['conditions']['OR']["ClientProject.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }

    /**
     * Lista wszyskich projektów dla wybranego klienta
     * 
     * @param int $client_id
     * @return type array
     */
    function listProject($client_id = null, $recursive = 1)
    {
        if (empty($client_id))
        {
            return false;
        }
        $this->ClientLead->Client->id = $client_id;
        if (!$this->ClientLead->Client->exists())
        {
            return false;
        }
        $params['recursive'] = $recursive;
        $params['conditions']['ClientProject.client_id'] = $client_id;

        $return = $this->find('all', $params);
        return $return;
    }

    /**
     * Lista wszyskich projektów dla wybranego klienta
     * 
     * @param int $client_id
     * @return type array
     */
    function listAllProject($recursive = 1)
    {
        $params['recursive'] = $recursive;

        $return = $this->find('all', $params);
        return $return;
    }

    /**
     * Dane konkretnego projektu
     * 
     * @param int $project_id
     * @return type array
     */
    function getProject($project_id = null, $recursive = 1)
    {
        if (empty($project_id))
        {
            return false;
        }
        $this->id = $project_id;
        if (!$this->exists())
        {
            return false;
        }
        $params['recursive'] = $recursive;
        $params['conditions']['ClientProject.id'] = $project_id;
        $return = $this->find('first', $params);
        return $return;
    }

    /**
     * Dane konkretnego projektu
     * 
     * @param int $project_id
     * @return type array
     */
    function getProjectByLeadId($lead_id = null, $recursive = 1)
    {
        if (empty($lead_id))
        {
            return false;
        }

        $params['recursive'] = $recursive;
        $params['conditions']['ClientProject.client_lead_id'] = $lead_id;
        $return = $this->find('first', $params);
        return $return;
    }

    /**
     * Zapis projektu(krok pierwszy)
     * 
     * @param int $data			array	dane do zapisu
     * @return type boolean		true	gdy zapisze poprawnie
     * 							false	w przypadku błędu
     */
    function saveProject($data = null)
    {
        if (empty($data))
        {
            return false;
        }
        if (!$this->exists())
        {
            $this->create();
        }

        return $this->save($data);
    }

    /*
     * Obsługa this -> request -> data
     * 
     * @param array $data
     * 
     * $return string 
     */

    public function saveAddRequestData($data = array(), $lead_id = null)
    {
        if (empty($lead_id))
        {
            return array(
                'error' => 1,
                'msg' => 'Lead jest nie prawidłowy.',
            );
        }

        if (empty($data))
        {
            return array(
                'error' => 1,
                'msg' => 'Pusta tablia danych',
            );
        }
        if (!$this->ClientLead->exists($lead_id))
        {
            return array(
                'error' => 1,
                'msg' => 'Lead nie istnieje.',
            );
        }

        //zapis informacji o umowie
        $projectFilesJson = $data['ClientProject']['files'];
        $projectFiles = empty($projectFilesJson) ? array() : json_decode($projectFilesJson, 1);

        if (!empty($projectFiles['6']))
        {
            $data['ClientProject']['agreement'] = 1;
        } else
        {
            $data['ClientProject']['agreement'] = 0;
        }

        $paramsCP['conditions']['ClientProject.client_lead_id'] = $lead_id;
        $paramsCP['recursive'] = -1;
        $paramsCP['fields'] = array('id', 'active');

        $cp = $this->find('first', $paramsCP);
        if (empty($cp))
        {
            $this->create();
            $project_start = true;
            $data['ClientProject']['active'] = 0; //trzeba ustawić aktywność projektu na 0(pole not null), w ostatnim kroku jest zmieniane na 1
        } else
        {
            $data['ClientProject']['id'] = $cp['ClientProject']['id'];
            $data['ClientProject']['active'] = $cp['ClientProject']['active'];
            $project_start = false;
        }


        if ($project = $this->saveProject($data))
        {
            $project_id = $project['ClientProject']['id'];

            if (isset($data['ClientProject']['seo_domain']) && is_array($data['ClientProject']['seo_domain']) && $data['ClientProject']['seo_domain'])
            { //lista domen przesyłana w tablicy
                $this->ClientProjectDomain = ClassRegistry::init('ClientProjectDomain');
                foreach ($data['ClientProject']['seo_domain'] as $client_domain_id => $to_save)
                {
                    if ($to_save == '1')
                    { //jeśli 1 to zapisuje a jeśli 0 to usuwam
                        $tmp_result = $this->ClientProjectDomain->saveProjectDomain((int) $project_id, (int) $client_domain_id);
                    } else
                    {
                        $tmp_result = $this->ClientProjectDomain->deleteProjectDomain((int) $project_id, (int) $client_domain_id);
                    }
                }
            }
            //zapisywanie klientów do projektu
            $data['ClientProject']['people'] = empty($data['ClientProject']['people']) ? array() : $data['ClientProject']['people'];
            $projectContacts = array_filter($data['ClientProject']['people']);
            if (!empty($projectContacts))
            {
                if (!$this->saveContactRows($project_id, $projectContacts))
                {
                    return array(
                        'error' => 1,
                        'msg' => 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie. Sprawdź klientów.'
                    );
                }
            }
            $projectFiles = array_filter($projectFiles);  // wyczyszczenie pustych zagnieżdżonych tablic 
            //zapisywanie plików do projektu
            if (!empty($projectFiles))
            {
                $this->ProjectFile = ClassRegistry::init('ProjectFile');
                if (!$this->ProjectFile->saveFileRows($project_id, $data['ClientProject']['user_id'], $projectFiles))
                {
                    return array(
                        'error' => 1,
                        'msg' => 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie. Sprawdź pliki.',
                    );
                }
            }
        } else
        {
            return array(
                'error' => 1,
                'msg' => 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie. Sprawdź projekt.'
            );
        }

        return array(
            'error' => 0,
            'msg' => 'Poprawnie Zapisano',
            'project_id' => $project_id,
            'project_start' => $project_start
        );
    }

    /**
     * 
     * funckcja zapisujaca dane kontaktowe ze strony klienta do danego projektu 
     * 
     * @param int $project_id    numer projektu 
     * @param array $data        tablica wybranych kontaktow
     * 
     * @return boolean
     */
    public function saveContactRows($project_id, $data)
    {
        if (empty($project_id) || empty($data))
        {
            return false;
        }
        $data = array_filter($data);

        $this->ProjectContactPeople = ClassRegistry::init('ProjectContactPeople');


        $toSave = array();
        foreach ($data as $id)
        {
            $toSave[] = array(
                'client_project_id' => $project_id,
                'client_contact_id' => $id
            );
        }

        $toDelete = $this->ProjectContactPeople->getProjectClientContacts($project_id, 'id');

        if ($toDelete)
        {
            foreach ($toDelete as $td)
            {
                $this->ProjectContactPeople->deleteProjectClientContact($td); //usuwam wcześniejzapisane kontakty
            }
        }

        if ($this->ProjectContactPeople->saveAll($toSave))
        {
            return true;
        } else
        {
            return false;
        }
    }

    public function getAliasList()
    {
        $params = array();
        $params['fields'] = array(
            'alias',
        );

        $aliasList = $this->find('list', $params);
        $aliasList = array_unique($aliasList);
        $return = array();
        foreach ($aliasList as $row)
        {
            $return[$row] = $row;
        }
        $return = array_filter($return);

        return $return;
    }

    public function timeline($id = null)
    {
        if (!$this->exists($id))
        {
            return false;
        }
        $ClientProjectShedule = ClassRegistry::init('ClientProjectShedule');
        $timeline = $ClientProjectShedule->parseTimeLine($id);
        $start_project = $this->id = $id;
        $start_project = $this->field('start_project');
        $end_project = $this->field('end_project');
        $warranty = $this->field('warranty');  
        $start_project_parse = $this->parseTime($start_project);
        $end_project_parse = $this->parseTime($end_project);
        $end_project_parse2 = $end_project_parse;
        $lastAgreement = $ClientProjectShedule->lastAgreement($id);
        if (!empty($lastAgreement['date_to']))
        {
            $end_project_parse2 = $this->parseTime($lastAgreement['date_to']);
            if (!empty($warranty))
            {
                $start_warranty = $lastAgreement['date_to'];
                $start_warranty_parse = $this->parseTime($start_warranty);
                $end_warranty = date('Y-m-d', strtotime('+' . $warranty . ' month', strtotime($start_warranty)));
                $end_warranty_parse = $this->parseTime($end_warranty);
            }
        }

        if (!empty($start_project) && !empty($end_project))
        {
            $timeline[] = array(
                'start' => $start_project_parse,
                'end' => $end_project_parse,
                'content' => 'Projekt',
                'type' => 'project',
                'readonly' => true
            );
            $timeline[] = array(
                'start' => $start_project_parse,
                'end' => null,
                'content' => __d('public', 'Początek umowy'),
                'type' => 'milestone',
                'readonly' => true
            );
            $timeline[] = array(
                'start' => $end_project_parse2,
                'end' => null,
                'content' => __d('public', 'Koniec umowy'),
                'type' => 'milestone',
                'readonly' => true
            );
        }
        if (!empty($end_warranty_parse))
        {
            $timeline[] = array(
                'start' => $start_warranty_parse,
                'end' => $end_warranty_parse,
                'content' => 'Gwarancja',
                'type' => 'warranty',
                'readonly' => true
            );
            $timeline[] = array(
                'start' => $start_warranty_parse,
                'end' => null,
                'content' => __d('public', 'Początek gwarancji'),
                'type' => 'milestone',
                'readonly' => true
            );
            $timeline[] = array(
                'start' => $end_warranty_parse,
                'end' => null,
                'content' => __d('public', 'Koniec gwarancji'),
                'type' => 'milestone',
                'readonly' => true
            );
        }
        return $timeline;
    }

    public function parseTime($date = null)
    {
        if (empty($date))
        {
            return null;
        }
        $tmp = strtotime($date);
        $return['Y'] = date('Y', $tmp);
        $return['m'] = date('n', $tmp);
        $return['d'] = date('j', $tmp);
        return $return;
    }

    /*
     * z listy projektów tworzona jest lista kamini milowych
     */

    public function parse2TimelineList($allProjectsQuery = array())
    {
        $this->Payment = ClassRegistry::init('Payment');
        $allProjects = array();
        $today = array(
            'start' => array(
                'Y' => date('Y'),
                'm' => date('m'),
                'd' => date('d')
            ),
            'content' => 'Aktualny dzień',
            'type' => 'today',
            'done' => false,
        );
        if ($allProjectsQuery)
        {
            foreach ($allProjectsQuery as $apq)
            {
                $allProjects[$apq['id']] = $apq;
                $allProjects[$apq['id']]['timeline'] = $this->timeline($apq['id']);
                $allProjects[$apq['id']]['timeline'][] = $today;

                $allProjects[$apq['id']]['timelinePayments'] = $this->Payment->parseTimeLine($apq['id']);
                $allProjects[$apq['id']]['timelinePayments'][] = $today;
            }
        }
        return $allProjects;
    }

    public function getDataTable($client_id = null)
    {
        $params['recursive'] = -1;
        $params['fields'] = array(
            'id',
            'name',
            'active',
            'start_project',
            'end_project',
            'close_realization',
            'close_financing',
            'acceptance_report',
            'client_lead_id',
            'agreement',
            'project_database',
            'total_costs_sum',
            'total_development_costs',
            'total_buffer',
            'Client.email'
        );

        $params['joins'][] = array(
            'alias' => 'Client',
            'table' => 'clients',
            'type' => 'INNER',
            'conditions' => array(
                'Client.id = ClientProject.client_id',
            )
        );
        if ($client_id)
        {
            $params['conditions']["client_id"] = $client_id;
        }

        $projects = $this->find('all', $params);
        //die(debug($projects));
        $delayeds = $this->getDelayedProjectMilestones();
        
        $delayeds = Set::combine($delayeds, '{n}.ClientProject.id', '{n}.ClientProjectShedules.id');
        $return = array();
        foreach ($projects as $k => $project)
        {
            $return[$k] = $project['ClientProject'];
            $return[$k]['Client'] = $project['Client'];
            $return[$k]['delayed'] = !empty($delayeds[$return[$k]['id']]);
            $return[$k]['id_md5'] = md5($return[$k]['id']);
            
            //jeśli projekt nie został zakończony ale mineła już data zakończenia to również wyświetla opóźnienie
            if($project['ClientProject']['close_realization'] == false && (strtotime(date('Y-m-d')) > strtotime($project['ClientProject']['end_project']))){
                $return[$k]['delayed'] = true;
            }
        }
        //die(debug($return));
        return $return;
    }

    /*
     * Metoda wyszukuje wszystkie milestony które są opóźnione względem harmonogramu 
     */

    public function getDelayedProjectMilestones()
    {

        $return = $this->find('all', array(
            'recursive' => -1,
            'joins' => array(
                array(
                    'table' => 'client_project_shedules',
                    'alias' => 'ClientProjectShedules',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'ClientProject.id = ClientProjectShedules.client_project_id',
                    )
                ),
            ),
            'fields' => array(
                'ClientProject.id', 'ClientProject.name', 'ClientProjectShedules.type', 'ClientProjectShedules.id', 'ClientProjectShedules.name', 'ClientProjectShedules.date', 'ClientProjectShedules.payment_day', 'ClientProjectShedules.done'
            ),
            'conditions' => array(
                'ClientProjectShedules.date < "' . date('Y-m-d') . '"',
                'ClientProjectShedules.type = "milestone"',
                'ClientProjectShedules.done = 0'
            ),
            'order' => array(
                'ClientProject.id'
            ),
        ));
        return $return;
    }

    /**
     * Funkcja sprawdzająca czy użytkownik jest może kierownikiem, autorem, czy handlowem projektu 
     * 
     * @param type $project_id  id projektu
     * @param type $user_id  id uzytkownika 
     */
    public function checkUserAuthorManager($project_id, $user_id)
    {
        if (empty($user_id) || empty($project_id))
        {
            return false;
        }

        $params = array();
        $params['fields'] = array(
            'user_id',
            'project_author_id',
            'account_manager_id'
        );
        $params['conditions'] = array(
            'ClientProject.id' => $project_id,
        );
        $this->recursive = -1;
        $arrayId = $this->find('first', $params);
        $arrayId = $arrayId['ClientProject'];
        $check = in_array($user_id, $arrayId);
        return $check;
    }

    /**
     * Funkcja pobierająca listę projektów, w których użytkownik jest dołączony, 
     * jest kierownikiem projektu, autorem lub handlowcem projektu
     * 
     * @param type $user_id  id usera 
     * @return boolean  false -  jeżeli nie ma wyników
     *                  array - tablica 
     */
    public function getUserProjectTable($user_id)
    {
        if (empty($user_id))
        {
            return false;
        }
        $params['recursive'] = -1;
        $params['fields'] = array(
            'id',
            'name',
            'name',
            'active',
            'start_project',
            'end_project',
//           'UserProject.user_id'
            'total_costs_sum',
            'total_development_costs',
            'total_buffer',
            'active',
            'close_realization',
            'close_financing',
            'agreement',
            'project_database',
            'acceptance_report',
            'client_lead_id',
            'Client.email'
        );
        $params['joins'] = array(
            array(
                'alias' => 'UserProject',
                'table' => 'client_project_users',
                'type' => 'LEFT',
                'conditions' => array(
                    'ClientProject.id = UserProject.client_project_id',
                )
            ),
            array(
                'alias' => 'Client',
                'table' => 'clients',
                'type' => 'INNER',
                'conditions' => array(
                    'Client.id = ClientProject.client_id',
                )
            )
        );
        $params['conditions'] = array(
            'ClientProject.active' => 1
        );
        $params['conditions']['or'] = array(
            'ClientProject.user_id' => $user_id,
            'ClientProject.project_author_id' => $user_id,
            'ClientProject.account_manager_id' => $user_id,
            'UserProject.user_id' => $user_id,
        );
        $projectList = $this->find('all', $params);

        $delayeds = $this->getDelayedProjectMilestones();
        $delayeds = Set::combine($delayeds, '{n}.ClientProject.id', '{n}.ClientProjectShedules.id');

        if (empty($projectList))
        {
            return false;
        } else
        {
            foreach ($projectList as $k => $project)
            {
                $return[$k] = $project['ClientProject'];
                $return[$k]['Client'] = $project['Client'];
                $return[$k]['delayed'] = !empty($delayeds[$return[$k]['id']]);
                $return[$k]['id_md5'] = md5($return[$k]['id']);
                //jeśli projekt nie został zakończony ale mineła już data zakończenia to również wyświetla opóźnienie
                if($project['ClientProject']['close_realization'] == false && (strtotime(date('Y-m-d')) > strtotime($project['ClientProject']['end_project']))){
                    $return[$k]['delayed'] = true;
                }
            }
            return $return;
        }
    }

    /**
     * Funkcja pobierająca listę wszystkich  projektów - dla sekretariatu, admina i zarządu
     * @return boolean  false -  jeżeli nie ma wyników
     *                  array - tablica 
     */
    public function getAllProjectTable()
    {
        $params['recursive'] = -1;
        $params['fields'] = array(
            'id',
            'name',
            'active',
            'start_project',
            'end_project',
//           'UserProject.user_id'
            'total_costs_sum',
            'total_development_costs',
            'total_buffer',
            'active',
            'close_realization',
            'close_financing',
            'agreement',
            'project_database',
            'acceptance_report',
            'client_lead_id',
            'Client.email'
        );

        $params['joins'][] = array(
            'alias' => 'Client',
            'table' => 'clients',
            'type' => 'INNER',
            'conditions' => array(
                'Client.id = ClientProject.client_id',
            )
        );

        $params['conditions'] = array(
            'ClientProject.active = 1',
        );

        $projectList = $this->find('all', $params);
        $delayeds = $this->getDelayedProjectMilestones();
        $delayeds = Set::combine($delayeds, '{n}.ClientProject.id', '{n}.ClientProjectShedules.id');

        if (empty($projectList))
        {
            return false;
        } else
        {
            foreach ($projectList as $k => $project)
            {
                $return[$k] = $project['ClientProject'];
                $return[$k]['Client'] = $project['Client'];
                $return[$k]['delayed'] = !empty($delayeds[$return[$k]['id']]);
                $return[$k]['id_md5'] = md5($return[$k]['id']);
                //jeśli projekt nie został zakończony ale mineła już data zakończenia to również wyświetla opóźnienie
                if($project['ClientProject']['close_realization'] == false && (strtotime(date('Y-m-d')) > strtotime($project['ClientProject']['end_project']))){
                    $return[$k]['delayed'] = true;
                }
            }
            return $return;
        }
    }

    /**
     * Funkcja pobierająca listę wszystkich  projektów - dla klienta
     * @return boolean  false -  jeżeli nie ma wyników
     *                  array - tablica 
     */
    public function getClientProjectTable($user_id = null)
    {
        if (!$this->User->exists($user_id))
        {
            return false;
        }
        $params['recursive'] = -1;

        $params['joins'][] = array(
            'alias' => 'Client',
            'table' => 'clients',
            'type' => 'INNER',
            'conditions' => array(
                'Client.id = ClientProject.client_id',
            )
        );
        $params['conditions'] = array(
            'Client.user_id' => $user_id,
            'ClientProject.active = 1',
            'ClientProject.share = 1'
        );
        $params['fields'] = array(
            'Client.user_id',
            'id',
            'name',
            'active',
            'start_project',
            'end_project',
            'close_realization',
//           'UserProject.user_id'
            'total_costs_sum',
            'total_development_costs',
            'total_buffer',
        );

        $projectList = $this->find('all', $params);

        $delayeds = $this->getDelayedProjectMilestones();
        $delayeds = Set::combine($delayeds, '{n}.ClientProject.id', '{n}.ClientProjectShedules.id');
        
        if (empty($projectList))
        {
            return false;
        } else
        {
            foreach ($projectList as $k => $project)
            {
                $return[$k] = $project['ClientProject'];
                $return[$k]['delayed'] = !empty($delayeds[$return[$k]['id']]);
                $return[$k]['id_md5'] = md5($return[$k]['id']);
                
                //jeśli projekt nie został zakończony ale mineła już data zakończenia to również wyświetla opóźnienie
                if($project['ClientProject']['close_realization'] == false && (strtotime(date('Y-m-d')) > strtotime($project['ClientProject']['end_project']))){
                    $return[$k]['delayed'] = true;
                }
            }
            
            return $return;
        }
    }

    /**
     * Funkcja pobierająca listę projektów, w których użytkownik jest kierownikiem projektu, autorem, handlowcem przypisanym lub jego zespół bierze udział w projekcie
     * @param type $section_id  id działu
     * @return boolean  false -  jeżeli nie ma wyników
     *                  array - tablica 
     */
    public function getManagerProjectTableBySection($section_id)
    {

        $user_id = $_SESSION['Auth']['User']['id'];
        if (empty($section_id))
        {
            return false;
        }
        $params['recursive'] = -1;
        $params['fields'] = array(
            'id',
            'name',
            'active',
            'start_project',
            'end_project',
//           'UserProject.user_id'
            'total_costs_sum',
            'total_development_costs',
            'total_buffer',
            'active',
            'close_realization',
            'close_financing',
            'agreement',
            'project_database',
            'acceptance_report',
            'client_lead_id',
            'Client.email'
        );
        $params['joins'] = array(
            array(
                'alias' => 'ClientProjectBudget',
                'table' => 'client_project_budgets',
                'type' => 'LEFT',
                'conditions' => array(
                    'ClientProject.id = ClientProjectBudget.client_project_id',
                )
            ),
            array(
                'alias' => 'Client',
                'table' => 'clients',
                'type' => 'LEFT',
                'conditions' => array(
                    'Client.id = ClientProject.client_id',
                )
            )
        );
        $params['conditions']['or'] = array(
            'ClientProject.user_id' => $user_id,
            'ClientProject.project_author_id' => $user_id,
            'ClientProject.account_manager_id' => $user_id,
            'ClientProjectBudget.section_id' => $section_id,
        );
        $projectList = $this->find('all', $params);
        $delayeds = $this->getDelayedProjectMilestones();
        $delayeds = Set::combine($delayeds, '{n}.ClientProject.id', '{n}.ClientProjectShedules.id');

        if (empty($projectList))
        {
            return false;
        } else {
            foreach ($projectList as $k => $project)
            {
                $return[$k] = $project['ClientProject'];
                $return[$k]['Client'] = $project['Client'];
                $return[$k]['delayed'] = !empty($delayeds[$return[$k]['id']]);
                $return[$k]['id_md5'] = md5($return[$k]['id']);
                
                //jeśli projekt nie został zakończony ale mineła już data zakończenia to również wyświetla opóźnienie
                if($project['ClientProject']['close_realization'] == false && (strtotime(date('Y-m-d')) > strtotime($project['ClientProject']['end_project']))){
                    $return[$k]['delayed'] = true;
                }
            }
            return $return;
        }
    }

    /**
     * Funkcja pobierająca listę projektów, z danego działu
     * @param	$section_id		id działu
     * @param	bolean	$date	flaga - czy mają być pokazywane aktualnie realizowane projekty czy wszystkie
     * @return boolean			false -  jeżeli nie ma wyników
     * 							array - tablica 
     */
    public function getProjectsBySection($section_id = null, $date = false)
    {
        if (empty($section_id))
        {
            return false;
        }
        $params['recursive'] = -1;
        $params['fields'] = array(
            'id',
            'name',
            'active',
            'start_project',
            'end_project',
//           'UserProject.user_id'
        );
        $params['joins'] = array(
            array(
                'alias' => 'ClientProjectBudget',
                'table' => 'client_project_budgets',
                'type' => 'LEFT',
                'conditions' => array(
                    'ClientProject.id = ClientProjectBudget.client_project_id',
                )
            )
        );
        $params['conditions'] = array(
            'ClientProjectBudget.section_id' => $section_id,
                //'ClientProject.end_project >=' => date('Y-m-d')
        );
        if ($date)
        { //wyświetlam tylko obecnie realizowane projekty
            $params['conditions']['ClientProject.end_project >='] = date('Y-m-d');
        }

        $projectList = $this->find('all', $params);

        $delayeds = $this->getDelayedProjectMilestones();
        $delayeds = Set::combine($delayeds, '{n}.ClientProject.id', '{n}.ClientProjectShedules.id');

        if (empty($projectList))
        {
            return false;
        } else
        {
            foreach ($projectList as $k => $project)
            {
                $return[$k] = $project['ClientProject'];
                $return[$k]['delayed'] = !empty($delayeds[$return[$k]['id']]);
                $return[$k]['id_md5'] = md5($return[$k]['id']);
                //jeśli projekt nie został zakończony ale mineła już data zakończenia to również wyświetla opóźnienie
                if($project['ClientProject']['close_realization'] == false && (strtotime(date('Y-m-d')) > strtotime($project['ClientProject']['end_project']))){
                    $return[$k]['delayed'] = true;
                }
            }
            return $return;
        }
    }

    /**
     * Odłącza niepotrzebne modele
     */
    public function unbindProjectModels()
    {

        $this->unbindModel(array('hasMany' => array('ClientProjectShedule', 'BaseModule')));
        $this->unbindModel(array('belongsTo' => array('User', 'ClientLead', 'ProjectAuthor', 'ProjectAuthorsProfile', 'Profile', 'Client', 'ClientProjectShedule', 'BaseModule')));
        $this->unbindModel(array('hasOne' => array('ClientProjectBudget')));
    }

    /**
     * Funkcja pomocnicza dla wyszukiwarki. Szukanie frazy w nazwie projektu
     * 
     * @param	int	$client_project_id	id projektu
     * @return array    dane z bazy	 
     */
    public function getProjectForSearcher($client_project_id = null, $query = null, $user_id = null)
    {

        $this->unbindProjectModels();

        if ($user_id == null)
        {

            $conditions = array(
                'ClientProject.id' => $client_project_id,
                'OR' => array(
                    'ClientProject.name LIKE ' => '%' . $query . '%',
                )
            );
        } else
        {

            $conditions = array(
                array(
                    'OR' => array(
                        'ClientProject.name LIKE ' => '%' . $query . '%',
                    )
                ),
                array(
                    'OR' => array(
                        'ClientProject.user_id LIKE ' => $user_id,
                        'ClientProject.project_author_id LIKE ' => $user_id,
                        'ClientProject.account_manager_id LIKE ' => $user_id,
                    )
                ),
            );
        }

        return $this->find('all', array(
                    'conditions' => $conditions,
                    'fields' => array(
                        'ClientProject.id',
                        'ClientProject.name',
                        'ClientProject.user_id',
                        'ClientProject.project_author_id',
                        'ClientProject.account_manager_id',
                    )
        ));
    }

    /**
     * Funkcja pomocnicza dla wyszukiwarki. Szukanie frazy w autorze projektu
     * 
     * @param	int	$client_project_id	id projektu
     * @return array    dane z bazy	 
     */
    public function getProjectAuthor($client_project_id = null, $query = null, $user_id = null)
    {

        $this->unbindProjectModels();

        if ($user_id == null)
        {

            $conditions = array(
                'ClientProject.id' => $client_project_id,
                'OR' => array(
                    'ProjectAuthor.email LIKE ' => '%' . $query . '%',
                    'ProjectAuthorProfile.firstname LIKE ' => '%' . $query . '%',
                    'ProjectAuthorProfile.surname LIKE ' => '%' . $query . '%',
                )
            );
        } else
        {

            $conditions = array(
                array(
                    'OR' => array(
                        'ProjectAuthor.email LIKE ' => '%' . $query . '%',
                        'ProjectAuthorProfile.firstname LIKE ' => '%' . $query . '%',
                        'ProjectAuthorProfile.surname LIKE ' => '%' . $query . '%',
                    )
                ),
                array(
                    'OR' => array(
                        'ClientProject.user_id LIKE ' => $user_id,
                        'ClientProject.project_author_id LIKE ' => $user_id,
                        'ClientProject.account_manager_id LIKE ' => $user_id,
                    )
                ),
            );
        }

        return $this->find('all', array(
                    'conditions' => $conditions,
                    'joins' => array(
                        array(
                            'table' => 'user_users',
                            'alias' => 'ProjectAuthor',
                            'type' => 'left',
                            'conditions' => 'ProjectAuthor.id = ClientProject.project_author_id',
                        ),
                        array(
                            'table' => 'profiles',
                            'alias' => 'ProjectAuthorProfile',
                            'type' => 'left',
                            'conditions' => 'ProjectAuthorProfile.user_id = ProjectAuthor.id',
                        ),
                    ),
                    'fields' => array(
                        'ClientProject.id',
                        'ClientProject.project_author_id',
                        'ProjectAuthor.id',
                        'ProjectAuthor.email',
                        'ProjectAuthorProfile.id',
                        'ProjectAuthorProfile.user_id',
                        'ProjectAuthorProfile.firstname',
                        'ProjectAuthorProfile.surname',
                    )
        ));
    }

    /**
     * Funkcja pomocnicza dla wyszukiwarki. Szukanie frazy w koordynatorze projektu
     * 
     * @param	int	$client_project_id	id projektu
     * @return array    dane z bazy	 
     */
    public function getProjectCoordinator($client_project_id = null, $query = null, $user_id = null)
    {

        $this->unbindProjectModels();

        if ($user_id == null)
        {

            $conditions = array(
                'ClientProject.id' => $client_project_id,
                'OR' => array(
                    'ProjectCoordinator.email LIKE ' => '%' . $query . '%',
                    'ProjectCoordinatorsProfile.firstname LIKE ' => '%' . $query . '%',
                    'ProjectCoordinatorsProfile.surname LIKE ' => '%' . $query . '%',
                )
            );
        } else
        {

            $conditions = array(
                array(
                    'OR' => array(
                        'ProjectCoordinator.email LIKE ' => '%' . $query . '%',
                        'ProjectCoordinatorsProfile.firstname LIKE ' => '%' . $query . '%',
                        'ProjectCoordinatorsProfile.surname LIKE ' => '%' . $query . '%',
                    )
                ),
                array(
                    'OR' => array(
                        'ClientProject.user_id LIKE ' => $user_id,
                        'ClientProject.project_author_id LIKE ' => $user_id,
                        'ClientProject.account_manager_id LIKE ' => $user_id,
                    )
                ),
            );
        }

        return $this->find('all', array(
                    'conditions' => $conditions,
                    'joins' => array(
                        array(
                            'table' => 'user_users',
                            'alias' => 'ProjectCoordinator',
                            'type' => 'left',
                            'conditions' => 'ProjectCoordinator.id = ClientProject.user_id',
                        ),
                        array(
                            'table' => 'profiles',
                            'alias' => 'ProjectCoordinatorsProfile',
                            'type' => 'left',
                            'conditions' => 'ProjectCoordinatorsProfile.user_id = ProjectCoordinator.id',
                        ),
                    ),
                    'fields' => array(
                        'ClientProject.id',
                        'ClientProject.project_author_id',
                        'ProjectCoordinator.id',
                        'ProjectCoordinator.email',
                        'ProjectCoordinatorsProfile.id',
                        'ProjectCoordinatorsProfile.user_id',
                        'ProjectCoordinatorsProfile.firstname',
                        'ProjectCoordinatorsProfile.surname',
                    )
        ));
    }

    /**
     * Funkcja pomocnicza dla wyszukiwarki. Szukanie frazy w użytkownikach projektu
     * 
     * @param	int	$client_project_id	id projektu
     * @return array    dane z bazy	 
     */
    public function getProjectUsers($client_project_id = null, $query = null, $user_id = null)
    {

        $this->unbindProjectModels();

        if ($user_id == null)
        {

            $conditions = array(
                'ClientProject.id' => $client_project_id,
                'OR' => array(
                    'ProjectUserUser.email LIKE ' => '%' . $query . '%',
                    'ProjectUserProfile.firstname LIKE ' => '%' . $query . '%',
                    'ProjectUserProfile.surname LIKE ' => '%' . $query . '%',
                )
            );
        } else
        {

            $conditions = array(
                array(
                    'OR' => array(
                        'ProjectUserUser.email LIKE ' => '%' . $query . '%',
                        'ProjectUserProfile.firstname LIKE ' => '%' . $query . '%',
                        'ProjectUserProfile.surname LIKE ' => '%' . $query . '%',
                    )
                ),
                array(
                    'OR' => array(
                        'ClientProject.user_id LIKE ' => $user_id,
                        'ClientProject.project_author_id LIKE ' => $user_id,
                        'ClientProject.account_manager_id LIKE ' => $user_id,
                    )
                ),
            );
        }

        return $this->find('all', array(
                    'conditions' => $conditions,
                    'joins' => array(
                        array(
                            'table' => 'client_project_users',
                            'alias' => 'ProjectUser',
                            'type' => 'left',
                            'conditions' => 'ProjectUser.client_project_id = ClientProject.id'
                        ),
                        array(
                            'table' => 'user_users',
                            'alias' => 'ProjectUserUser',
                            'type' => 'left',
                            'conditions' => 'ProjectUserUser.id = ProjectUser.user_id',
                        ),
                        array(
                            'table' => 'profiles',
                            'alias' => 'ProjectUserProfile',
                            'type' => 'left',
                            'conditions' => 'ProjectUserProfile.user_id = ProjectUserUser.id',
                        ),
                    ),
                    'fields' => array(
                        'ClientProject.id',
                        'ProjectUser.id',
                        'ProjectUser.user_id',
                        'ProjectUserUser.id',
                        'ProjectUserUser.email',
                        'ProjectUserProfile.id',
                        'ProjectUserProfile.user_id',
                        'ProjectUserProfile.firstname',
                        'ProjectUserProfile.surname'
                    )
        ));
    }

    /**
     * Funkcja pomocnicza dla wyszukiwarki. Szukanie frazy w logach projektu
     * 
     * @param	int	$client_project_id	id projektu
     * @return array    dane z bazy	 
     */
    public function getProjectLogs($client_project_id = null, $query = null, $user_id = null)
    {

        $this->unbindProjectModels();

        if ($user_id == null)
        {

            $conditions = array(
                'ClientProject.id' => $client_project_id,
                'OR' => array(
                    'Log.name LIKE ' => '%' . $query . '%',
                    'Log.subject LIKE ' => '%' . $query . '%',
                    'Log.message LIKE ' => '%' . $query . '%',
                )
            );
        } else
        {

            $conditions = array(
                array(
                    'OR' => array(
                        'Log.name LIKE ' => '%' . $query . '%',
                        'Log.subject LIKE ' => '%' . $query . '%',
                        'Log.message LIKE ' => '%' . $query . '%',
                    )
                ),
                array(
                    'OR' => array(
                        'ClientProject.user_id LIKE ' => $user_id,
                        'ClientProject.project_author_id LIKE ' => $user_id,
                        'ClientProject.account_manager_id LIKE ' => $user_id,
                    )
                ),
            );
        }

        return $this->find('all', array(
                    'conditions' => $conditions,
                    'joins' => array(
                        array(
                            'table' => 'client_project_logs',
                            'alias' => 'Log',
                            'type' => 'left',
                            'conditions' => 'Log.client_project_id = ClientProject.id',
                        ),
                    ),
                    'fields' => array(
                        'ClientProject.id',
                        'Log.id',
                        'Log.client_project_id',
                        'Log.name',
                        'Log.subject',
                        'Log.message',
                    )
        ));
    }

    /**
     * Funkcja pomocnicza dla wyszukiwarki. Szukanie frazy w notkach projektu
     * 
     * @param	int	$client_project_id	id projektu
     * @return array    dane z bazy	 
     */
    public function getProjectNotes($client_project_id = null, $query = null, $user_id = null)
    {

        $this->unbindProjectModels();

        if ($user_id == null)
        {

            $conditions = array(
                'ClientProject.id' => $client_project_id,
                'OR' => array(
                    'Note.content LIKE ' => '%' . $query . '%',
                )
            );
        } else
        {

            $conditions = array(
                array(
                    'OR' => array(
                        'Note.content LIKE ' => '%' . $query . '%',
                    )
                ),
                array(
                    'OR' => array(
                        'ClientProject.user_id LIKE ' => $user_id,
                        'ClientProject.project_author_id LIKE ' => $user_id,
                        'ClientProject.account_manager_id LIKE ' => $user_id,
                    )
                ),
            );
        }

        return $this->find('all', array(
                    'conditions' => $conditions,
                    'joins' => array(
                        array(
                            'table' => 'client_project_notes',
                            'alias' => 'Note',
                            'type' => 'left',
                            'conditions' => 'Note.project_id = ClientProject.id',
                        ),
                    ),
                    'fields' => array(
                        'ClientProject.id',
                        'Note.id',
                        'Note.project_id',
                        'Note.content',
                    )
        ));
    }

    /**
     * Funkcja łącząca wyniki wyszukiwania dla aktualnego projektu w jedną tablicę
     */
    public function mergeProjectSearcherResults($client_project_id, $actualProjects, $projectAuthors, $projectCoordinators, $projectUsers, $projectLogs, $projectNotes)
    {

        $return = array();

        foreach ($actualProjects as $actualProject)
        {
            $insert = array(
                'ClientProject' => array(
                    'client_project_id' => $actualProject['ClientProject']['id'],
                    'name' => $actualProject['ClientProject']['name'],
                )
            );

            $return[] = $insert;
        }

        // autor projektu
        foreach ($projectAuthors as $projectAuthor)
        {

            $firstname = isset($projectAuthor['ProjectAuthorProfile']['firstname']) ? $projectAuthor['ProjectAuthorProfile']['firstname'] : '';
            $surname = isset($projectAuthor['ProjectAuthorProfile']['surname']) ? $projectAuthor['ProjectAuthorProfile']['surname'] : '';

            $insert = array(
                'ClientProject' => array(
                    'client_project_id' => $projectAuthor['ClientProject']['id'],
                    'email' => isset($projectAuthor['ProjectAuthor']['email']) ? $projectAuthor['ProjectAuthor']['email'] : '',
                    'name' => $firstname . ' ' . $surname,
                )
            );

            $return[] = $insert;
        }

        //koordynator projektu
        foreach ($projectCoordinators as $projectCoordinator)
        {

            $firstname = isset($projectCoordinator['ProjectCoordinatorsProfile']['firstname']) ? $projectCoordinator['ProjectCoordinatorsProfile']['firstname'] : '';
            $surname = isset($projectCoordinator['ProjectCoordinatorsProfile']['surname']) ? $projectCoordinator['ProjectCoordinatorsProfile']['surname'] : '';

            $insert = array(
                'ClientProject' => array(
                    'client_project_id' => $projectCoordinator['ClientProject']['id'],
                    'email' => $projectCoordinator['ProjectCoordinator']['email'],
                    'name' => $firstname . ' ' . $surname,
                )
            );

            $return[] = $insert;
        }

        //użytkownicy projektu
        foreach ($projectUsers as $projectUser)
        {

            $firstname = isset($projectUser['ProjectUserProfile']['firstname']) ? $projectUser['ProjectUserProfile']['firstname'] : '';
            $surname = isset($projectUser['ProjectUserProfile']['surname']) ? $projectUser['ProjectUserProfile']['surname'] : '';

            $insert = array(
                'ClientProject' => array(
                    'client_project_id' => $projectUser['ClientProject']['id'],
                    'email' => isset($projectUser['ProjectUserUser']['email']) ? $projectUser['ProjectUserUser']['email'] : '',
                    'name' => $firstname . ' ' . $surname,
                )
            );

            $return[] = $insert;
        }

        //logi projektu
        foreach ($projectLogs as $projectLog)
        {

            $insert = array(
                'ClientProject' => array(
                    'client_project_id' => $projectLog['ClientProject']['id'],
                    'name' => isset($projectLog['Log']['name']) ? $projectLog['Log']['name'] : '',
                    'subject' => isset($projectLog['Log']['subject']) ? $projectLog['Log']['subject'] : '',
                    'message' => isset($projectLog['Log']['message']) ? $projectLog['Log']['message'] : '',
                )
            );

            $return[] = $insert;
        }

        //notki projektu
        foreach ($projectNotes as $projectNote)
        {

            $insert = array(
                'ClientProject' => array(
                    'client_project_id' => $projectNote['ClientProject']['id'],
                    'content' => isset($projectNote['Note']['content']) ? $projectNote['Note']['content'] : '',
                )
            );

            $return[] = $insert;
        }

        return $return;
    }

    /**
     * Funkcja pobierająca tablicę elementów wyszukiwania frazy w aktualnym projekcie
     * 
     * @param $query		wyszukiwana fraza
     * 
     * @return array		tablica elementów typu ClientProject
     */
    public function getActualProjectSearcher($query = null, $client_project_id = null)
    {

        if ($query == null || $client_project_id == null)
        {

            return array();
        }

        $actualProject = $this->getProjectForSearcher($client_project_id, $query);
        $projectAuthor = $this->getProjectAuthor($client_project_id, $query);
        $projectCoordinator = $this->getProjectCoordinator($client_project_id, $query);
        $projectUsers = $this->getProjectUsers($client_project_id, $query);
        $projectLogs = $this->getProjectLogs($client_project_id, $query);
        $projectNotes = $this->getProjectNotes($client_project_id, $query);

        $queryResult = $this->mergeProjectSearcherResults($client_project_id, $actualProject, $projectAuthor, $projectCoordinator, $projectUsers, $projectLogs, $projectNotes);

        for ($i = 0; $i < sizeof($queryResult); $i++)
        {

            foreach ($queryResult[$i]['ClientProject'] as $fieldName => $fieldValue)
            {

                if (stripos($fieldValue, $query) !== false && $fieldName != 'client_project_id')
                {

                    $queryResult[$i]['ClientProject']['foundIn'] = '<span>' . str_ireplace($query, '<b>' . $query . '</b>', $fieldValue) . '<span>';
                    break;
                }
            }
        }

        return $queryResult;
    }

    /**
     * Funkcja pobierająca tablicę elementów typu ClientProject dla wyszukiwarki
     * 
     * @param $query		wyszukiwana fraza
     * @param $user_id		id użytkownika z sesji
     * 
     * @return array		tablica elementów typu ClientProject
     */
    public function getMyProjectsSearcher($query = null, $user_id = null)
    {

        if ($query == null || $user_id == null)
        {

            return array();
        }

        $actualProject = $this->getProjectForSearcher(null, $query, $user_id);
        $projectAuthor = $this->getProjectAuthor(null, $query, $user_id);
        $projectCoordinator = $this->getProjectCoordinator(null, $query, $user_id);
        $projectUsers = $this->getProjectUsers(null, $query, $user_id);
        $projectLogs = $this->getProjectLogs(null, $query, $user_id);
        $projectNotes = $this->getProjectNotes(null, $query, $user_id);

        $queryResult = $this->mergeProjectSearcherResults(null, $actualProject, $projectAuthor, $projectCoordinator, $projectUsers, $projectLogs, $projectNotes);

        for ($i = 0; $i < sizeof($queryResult); $i++)
        {

            foreach ($queryResult[$i]['ClientProject'] as $fieldName => $fieldValue)
            {

                if (stripos($fieldValue, $query) !== false && $fieldName != 'client_project_id')
                {

                    $queryResult[$i]['ClientProject']['foundIn'] = '<span>' . str_ireplace($query, '<b>' . $query . '</b>', $fieldValue) . '<span>';
                    break;
                }
            }
        }

        return $queryResult;
    }

    /**
     * Funkcja pobierająca clientProjects wszystkich koordynatorów projektów
     */
    public function getClientsProjectsCoordinators()
    {

        $allProjects = $this->find('all', array(
            'fields' => array(
                'ClientProject.id',
                'ClientProject.user_id',
            ),
            'contain' => array(
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.email',
                    ),
                    'Profile' => array(
                        'fields' => array(
                            'Profile.id',
                            'Profile.user_id',
                            'Profile.name',
                        )
                    )
                )
            )
                )
        );

        $return = array();

        foreach ($allProjects as $clientProject)
        {

            $return[$clientProject['ClientProject']['user_id']] = $clientProject['User']['Profile']['name'];
        }

        return $return;
    }

}
