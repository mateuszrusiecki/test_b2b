<?php

App::uses('AppModel', 'Model');

/**
 * ClientProjectBudget Model
 *
 * @property ClientProject $ClientProject
 * @property Section $Section
 * @property ClientProjectBudgetPosition $ClientProjectBudgetPosition
 */
class ClientProjectBudget extends AppModel
{

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
        'ClientProject' => array(
            'className' => 'ClientProject',
            'foreignKey' => 'client_project_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Section' => array(
            'className' => 'Section',
            'foreignKey' => 'section_id',
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
        'ClientProjectBudgetPosition' => array(
            'className' => 'ClientProjectBudgetPosition',
            'foreignKey' => 'client_project_budget_id',
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
//        $params['conditions']['OR']["ClientProjectBudget. LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }

    /**
     * Zapis projektu(drugi krok)
     * 
     * @param int $data			array	dane do zapisu
     * @return type boolean		true	gdy zapisze poprawnie
     * 							false	w przypadku błędu
     */
    function saveProjectBudget($data = null)
    {
		if (empty($data))
        {
            return false;
        }
        if (empty($data['ClientProjectBudget']['id']))
        {
            $this->create();
        }
        return $this->save($data);
    }

    /**
     * Usuwnie projektu(drugi krok)
     * 
     * @param int $value			array	dane do zapisu
     * @return type boolean		true	gdy usunie poprawnie
     * 							false	w przypadku błędu
     */
    function deleteProjectBudget($value = null)
    {
        if (!empty($value['delete']))
        {
            if (!empty($value['section']['id']))
            {
		
                $test = $this->delete($value['section']['id'], false);
                $this->ClientProjectBudgetPosition->deleteAll(array('ClientProjectBudgetPosition.client_project_budget_id' => $value['section']['id']), false);
            }
            return true;
        }
        return false;
    }

    /**
     * Dane budżetowe konkretnego projektu
     * 
     * @param int $client_project_id
     * @return type array
     */
    function getAllProjectBudget($client_project_id = null)
    {
        if (empty($client_project_id))
        {
            return false;
        }

        $params['recusive'] = 0;
        $params['fields'] = array('id', 'client_project_id', 'section_id', 'activity_name', 'pm', 'buffer_percentage', 'margin_percentage', 'position_cost', 'position_value');
        $params['conditions']['ClientProjectBudget.client_project_id'] = $client_project_id;
        $return = $this->find('all', $params);
        return $return;
    }

    function getSections($client_project_id = null)
    {
        $this->ClientProjectUser = ClassRegistry::init('ClientProjectUser');

        $butgets = $this->getAllProjectBudget($client_project_id);
        if ($butgets == false)
        {
            return false;
        }
        $return = array();
        foreach ($butgets as $butget)
        {
            $section_id = $butget['ClientProjectBudget']['section_id'];
            $getUserBySection = $this->Section->getUserBySection($section_id);
            if (!$getUserBySection)
            {
                continue;
            }
            $return[$section_id] = $getUserBySection;
            $return[$section_id] += $butget;
            foreach ($return[$section_id]['Profile'] as &$profile)
            {
                $actieParams['conditions']['ClientProjectUser.client_project_id'] = $client_project_id;
                $actieParams['conditions']['ClientProjectUser.user_id'] = $profile['User']['id'];
                $actieParams['recursive'] = -1;
                $result = $this->ClientProjectUser->find('first', $actieParams);
                $profile['active'] = false;
                //$profile['active'] = $this->ClientProjectUser->find('count', $actieParams);
                if(!empty($result)){ 
                    $profile['active']=true; //jeśli pracownik jest przypisany do projektu to oznaczam go
                    if(!empty($result['ClientProjectUser']['replacement_till'])){ // sprawadzam czy użytkownik otrzymał dostęp do projektu w ramach zastępstwa
                        //jeśli termin zastępstwa został przekroczony(+bufor 2 dni) to uzytkownik traci dostęp
                        if(strtotime(date('Y-m-d')) > strtotime($result['ClientProjectUser']['replacement_till'])){
                            $profile['active'] = false;
                            $this->ClientProjectUser->delete($result['ClientProjectUser']['id']); //od razu usuwam dostęp do projektu
                        }
                    } 
                    //------------------------------------------------------
                }
            }
        }
        

        return $return;
    }

}
