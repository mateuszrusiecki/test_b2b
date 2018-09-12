<?php

App::uses('AppModel', 'Model');

/**
 * ProjectFile Model
 *
 * @property ClientProject $ClientProject
 * @property FileCategory $FileCategory
 */
class ProjectFile extends AppModel
{
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array(
        'Image.Upload',
            //'Slug.Slug'
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
        'ClientLead' => array(
            'className' => 'ClientLead',
            'foreignKey' => 'client_lead_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => '',
            'conditions' => array('Profile.user_id = ClientProject.user_id'),
            'fields' => '',
            'order' => ''
        ),
        'ProjectFileCategory' => array(
            'className' => 'ProjectFileCategory',
            'foreignKey' => 'project_file_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function beforeValidate($options = array())
    {
        $this->validate = array(
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
            'file_name' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'project_file_category_id' => array(
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

    function afterSave($created, $options=array())
    {
        //portokół odbioru id8 sprawdzić z bazą :)
        if (
                !empty($this->data['ProjectFile']['client_project_id']) &&
                !empty($this->data['ProjectFile']['project_file_category_id']) &&
                $this->data['ProjectFile']['project_file_category_id'] == 8
        )
        {
            $project_id = $this->data['ProjectFile']['client_project_id'];
            $this->ClientProject->id = $project_id;
            $acceptance_report = $this->ClientProject->field('acceptance_report');
            if (empty($acceptance_report))
            {
                $this->ClientProject->saveField('acceptance_report', 1, false);
            }
        }
        
        // Mockup
        if (!empty($this->data['ProjectFile']['client_project_id']) &&
            !empty($this->data['ProjectFile']['project_file_category_id']) &&
            $this->data['ProjectFile']['project_file_category_id'] == 9)
        {
            // Unzip and validate mockup
            $this->ProjectMockup = ClassRegistry::init('ProjectMockups.ProjectMockup');
            $this->ProjectMockup->unpackMockup($this->data);
        }
        
        
        parent::afterSave($created);
    }

    function beforeDelete($cascade = true)
    {
        $this->deleteAcceptanceReport($this->id);
        parent::beforeDelete($cascade);
        return true;
    }

    function deleteAcceptanceReport($id = null)
    {
        $this->id = $id;
        if (!$this->exists())
        {
            return false;
        }
        $client_project_id = $this->field('client_project_id');
        if (empty($client_project_id))
        {
            return false;
        }
        $params['conditions']['ProjectFile.client_project_id'] = $client_project_id;
        $params['conditions']['ProjectFile.project_file_category_id'] = 8;
        $acceptance_report = $this->find('count', $params);
        if (empty($acceptance_report) || $acceptance_report == 1)
        {
            //$this->ClientProject->id = $client_project_id;
            //$this->ClientProject->saveField('acceptance_report', 0, false);
        }
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
        $this->category = array(
            '1' => __d('public', 'Inne'),
            '2' => __d('public', 'Inne hand.'),
            '3' => __d('public', 'Brief'),
            '4' => __d('public', 'Wycena'),
            '5' => __d('public', 'Oferta'),
            '6' => __d('public', 'Umowa'),
            '7' => __d('public', 'FV'),
            '8' => __d('public', 'Protokół odbioru'),
            '9' => __d('public', 'Makieta'),
        );
    }

    /**
     * funkcja zapisujaca 
     * 
     *  @param $project_id    id projektu
     *  @param $data          tablica plikow do zapisania
     * 
     * 
     *  @return  bool     true  - poprawnie zapisało dane 
     *                    false - niepoprawnie 
     */
    public function saveRows()
    {
        
    }

    /**
     * funkcja sprawdza czy w danym projekcie jest umowa 
     * 
     *  @param $project_id    id projektu
     * 
     * 
     *  @return  bool     true  - jest umowa 
     *                    false - brak umowy 
     */
    public function checkAgreement($project_id = null)
    {
        if (empty($project_id))
        {
            return false;
        }
        if (!$this->ClientProject->exists($project_id))
        {
            return false;
        }
        $params['conditions']['project_file_category_id'] = 6;
        $params['conditions']['client_project_id'] = $project_id;
        $params['recursive'] = -1;
        $return = $this->find('count', $params);
        return !empty($return);
    }

    /**
     * Pobiera listę plików przypisanych do projektu
     * 
     * @param   $client_project_id    ID projektu
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getFileList($client_project_id = null, $recursive = 0)
    {
        if (empty($client_project_id) || !$this->ClientProject->exists($client_project_id))
        {
            return false;
        }

        $userParms['recursive'] = $recursive;
        $userParms['conditions'] = array('ProjectFile.client_project_id' => $client_project_id);
        $userParms['order'] = 'ProjectFile.parent_id';
        $userParms['fields'][] = 'Profile.firstname';
        $userParms['fields'][] = 'Profile.surname';
        $userParms['fields'][] = 'ProjectFile.*';
        $userParms['fields'][] = 'ProjectFileCategory.*';
        return $this->find('all', $userParms);
    }

    /**
     * Pobiera listę plików przypisanych do leadu
     * 
     * @param   $client_project_id    ID projektu
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getLeadFileList($client_lead_id = null, $recursive = 0)
    {
        if (empty($client_lead_id) || !$this->ClientLead->exists($client_lead_id))
        {
            return false;
        }
        
        $userParms['recursive'] = $recursive;
        $userParms['conditions'] = array('ProjectFile.client_lead_id' => $client_lead_id);
        $userParms['order'] = 'ProjectFile.parent_id';
        $userParms['fields'][] = 'Profile.firstname';
        $userParms['fields'][] = 'Profile.surname';
        $userParms['fields'][] = 'ProjectFile.*';
        $userParms['fields'][] = 'ProjectFileCategory.*';
        return $this->find('all', $userParms);
    }

    /**
     * Pobiera listę plików przypisanych do leadu i projektu 
     * z flagą czy jest w projecie
     * 
     * @param   $client_project_id    ID projektu
     * @param   $client_lead_id    ID projektu
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getFileLeadProjectList($client_project_id = null, $client_lead_id = null)
    {
        if (empty($client_project_id) && empty($client_lead_id))
        {
            return false;
        }
        
        if(!$this->ClientProject->exists($client_project_id) && !$this->ClientLead->exists($client_lead_id)){
            return false; //jeśli projekt i lead nie istnieją w bazie to zwracam false, nie robie OR bo można nie podawać jednego albo drugiego
        }

        if (!empty($client_project_id))
        {
            $userParms['conditions']['OR'][]['ProjectFile.client_project_id'] = $client_project_id;
        }
        if (!empty($client_lead_id))
        {
            $userParms['conditions']['OR'][]['ProjectFile.client_lead_id'] = $client_lead_id;
        }

        $userParms['recursive'] = -1;
        $filesArray = $this->find('all', $userParms);
        $files = array();
        if ($filesArray)
        {
            $files = array();
            foreach ($filesArray as $file)
            {
                if (empty($file['ProjectFile']['client_project_id']))
                {
                    $file['ProjectFile']['delete'] = true;
                }
                $files[$file['ProjectFile']['project_file_category_id']][] = $file['ProjectFile'];
            }
        }
        return $files;
    }

    /**
     * funkcja przenoszącza dane plikow z leada do projektu wg tego co zostało "przeciągnięte"
     * 
     * 
     * @param int $project_id  int - numer  projektu
     * @param int $user_id        id użytkownika
     * @param array $files			tablica z plikami zdekodowana z jsona(stdClass)
     */
    public function saveFileRows($project_id = null, $user_id = null, $files = null)
    {
        if (empty($project_id) or empty($user_id) or empty($files))
        {
            return false;
        }
        //$files = json_decode($data);
        if (!is_array($files))
        {
            return false;
        }
        $return = array();
        foreach ($files as $project_file_category_id => $filesCat)
        {
            foreach ($filesCat as $file)
            {
                $file['project_file_category_id'] = $project_file_category_id;
                $file['client_project_id'] = (empty($file['delete'])) ? $project_id : null;
                if (empty($file['client_project_id']) && empty($file['client_lead_id']))
                {
                    //usuwamy plik bo nie nelezy anie do projektu anie do leadu
                    if (!empty($file['id']))
                    {
                        $this->deleteFile($file['id'], 'force');
                    }
                    continue;
                }
                $this->data['ProjectFile'] = $file;
                $return[] = $this->save($this->data, false);
            }
        }
        return $return;
    }

    /**
     * Pobiera plik o danym ID 
     * 
     * @param   $id    ID pliku
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getFile($id = null)
    {
        if (empty($id) || !$this->exists($id))
        {
            return false;
        }

        return $this->find('first', array('conditions' => array('ProjectFile.id' => $id)));
    }

    /**
     * Pobiera plik o danym ID 
     * 
     * @param   $id    ID pliku
     * 
     * @return  mixed    array - plik i jego wersje
     *                  false - w przypadku błędu
     */
    public function getFilesById($id = null)
    {
        if (empty($id) || !$this->exists($id))
        {
            return false;
        }
        
        return $this->find('all', array('recursive' => -1, 'conditions' => array(
                        'OR' => array('ProjectFile.id' => $id, 'ProjectFile.parent_id' => $id),
        )));
    }

   
    /**
     *  usuwanie pliku o danym id 
     * 
     * @param   $id		ID pliku
     * @param   $name   nazwa pliku
     * 
     * @return  bool    true - prawidłowe usunięcie
     *                  false - w przypadku błędu
     */
    public function deleteFile($id = null, $type = null)
    {
        if (empty($id))
        {
            return false;
        }
        if (empty($type))
        {
            return false;
        }


        $params['conditions']['ProjectFile.id'] = $id;
        $params['recursive'] = -1;

        $projectFile = $this->find('first', $params);
        if (empty($projectFile))
        {
            return false;
        }

        //usuwamy cały wpis
        if (
                (empty($projectFile['ProjectFile']['client_project_id']) &&  $type == 'lead') ||
                (empty($projectFile['ProjectFile']['client_lead_id']) && $type == 'project') ||
                $type == 'force'
        )
        {
            $this->ClientProjectLog = ClassRegistry::init('ClientProjectLog');
            $paramsChildren['conditions']['ProjectFile.parent_id'] = $id;
            $paramsChildren['recursive'] = -1;
            $projectFileChildrens = $this->find('all', $paramsChildren);
            if (!empty($projectFileChildrens))
            {

                foreach ($projectFileChildrens as $children)
                {
                    $this->id = $children['ProjectFile']['id'];
                    $this->delete($children['ProjectFile']['id'], false);
                    $this->ClientProjectLog->saveFileLog(3, $projectFile); //logowanie operacji na plikach
                }
            }
            $this->id = $id;
            $return = $this->delete($id, false);
            $this->ClientProjectLog->saveFileLog(3, $projectFile); //logowanie operacji na plikach
            return $return;
        }
        //usuwamy powiązanie client_lead_id
        if ($type == 'lead')
        {
            $this->id = $id;
            $return = $this->saveField('client_lead_id', null);
            return $return;
        }
        //usuwamy powiązanie client_project_id
        if ($type == 'project')
        {
            $this->id = $id;
            $return = $this->saveField('client_project_id', null);
            return $return;
        }
    }

    /**
     * Pobranie wszystkich plików wraz z iminami i nazwiskami kto dodał
     * 
     * @return array
     */
    public function listProjectFile()
    {
        $userParms['recursive'] = -1;
        $userParms['joins'] = array(
            array('table' => 'profiles',
                'alias' => 'Profile',
                'type' => 'LEFT',
                'conditions' => array(
                    'Profile.user_id = ProjectFile.user_id',
                )
            )
        );
        $userParms['fields'][] = 'Profile.firstname';
        $userParms['fields'][] = 'Profile.surname';
        $userParms['fields'][] = 'ProjectFile.*';
        $return = $this->find('all', $userParms);
        return $return;
    }

    public function listClientProjectFile($user_id = null)
    {
        if (empty($user_id) || !$this->Profile->User->exists($user_id))
        {
            return false;
        }
        $userParms['recursive'] = -1;
        $userParms['joins'][] = array('table' => 'profiles',
            'alias' => 'Profile',
            'type' => 'LEFT',
            'conditions' => array(
                'Profile.user_id = ProjectFile.user_id',
            )
        );
        $userParms['joins'][] = array('table' => 'client_projects',
            'alias' => 'ClientProject',
            'type' => 'INNER',
            'conditions' => array(
                'ProjectFile.project_file_category_id = ClientProject.id',
            )
        );
        $userParms['joins'][] = array('table' => 'clients',
            'alias' => 'Client',
            'type' => 'INNER',
            'conditions' => array(
                'Client.id = ClientProject.client_id',
                'Client.user_id' => $user_id
            )
        );
        $userParms['fields'][] = 'Profile.firstname';
        $userParms['fields'][] = 'Profile.surname';
        $userParms['fields'][] = 'ProjectFile.*';
        $userParms['fields'][] = 'ClientProject.client_id';
        $userParms['fields'][] = 'Client.user_id';
        $return = $this->find('all', $userParms);
        return $return;
    }

    /*
     * return mixed     string - nazwa pliku
     *                  false w rzypadku błedu
     */
    function base2file($file = array())
    {
        $uploadDir = 'files' . DS . 'projectfile' . DS;
        if (empty($file) || !$file)
        {
            return false;
        }

        $data = base64_decode($file['data']);
        $ext = explode('/', $file['mimetype']);
        $filename = 'scan_' . uniqid() . '.' . $ext['1'];
        $file_dir = $uploadDir . $filename;


        if (file_put_contents($file_dir, $data))
        {
            return $filename;
        }
        return false;
    }

    public function rev_save_file($data = null)
    {
        $this->LeadLog = ClassRegistry::init('LeadLog');
        $this->ClientProjectLog = ClassRegistry::init('ClientProjectLog');

        if (!empty($data) && $tmp = $this->save($data))
        {
            $last_id = $this->getLastInsertId();
            if (!empty($data['ProjectFile']['tmp_id']))
            { //zapis nowej wersji pliku(dodanie parent id)
                $update_files = $this->getFilesById($data['ProjectFile']['tmp_id']);
                foreach ($update_files as $u_file)
                {
                    $u_file['ProjectFile']['parent_id'] = $last_id;
                    $this->save($u_file);
                }
                if (!empty($data['ProjectFile']['client_lead_id']))
                {
                    $tmp['LeadFile'] = $data['ProjectFile'];
                    $this->LeadLog->saveFileLog(4, $tmp); //nowa wersja pliku
                } else {
                    $this->ClientProjectLog->saveFileLog(4, $data); //4 - logowanie operacji dodania nowej wersji pliku
                }
            } else {
                if (!empty($data['ProjectFile']['client_lead_id']))
                {
                    $tmp['LeadFile'] = $data['ProjectFile'];
                    $this->LeadLog->saveFileLog(2, $tmp); //nowy plik
                } else {
                    $this->ClientProjectLog->saveFileLog(2, $data); //4 - logowanie operacji dodania nowej wersji pliku
                }
            }
            $return['success'] = true;
            $return['data'] = $tmp['ProjectFile'];
        } else {
            $return['success'] = false;
        }
        return $return;
    }
	
	
	
    function changeClientAccesToFile($file_id = null, $client_available = null)
    {
        if (empty($file_id) || !$this->exists($file_id))
        {
            return false;
        }
		if(empty($client_available)){
			$client_available = 0;
		}

        $this->id = $file_id;
        $file['ProjectFile']['id'] = $file_id;
        $file['ProjectFile']['client_available'] = $client_available;
        return $this->save($file);
    }

}
