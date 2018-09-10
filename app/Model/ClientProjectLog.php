<?php

App::uses('AppModel', 'Model');

/**
 * ClientProjectLog Model
 *
 * @property ClientProject $ClientProject
 * @property TypeLog $TypeLog
 * @property User $User
 */
class ClientProjectLog extends AppModel
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
//		'TypeLog' => array(
//			'className' => 'TypeLog',
//			'foreignKey' => 'type_log_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
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
			'conditions' => array('Profile.user_id = ClientProject.user_id'),
			'fields' => 'firstname,surname',
			'order' => ''
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
        $this->log_type = array(
            '1' => __d('public', 'Email'),
            '2' => __d('public', 'Nowy dokument'),
            '3' => __d('public', 'Usunięcie  pliku'),
            '4' => __d('public', 'Nowa wersja pliku'),
            '5' => __d('public', 'Data wydarzenia'),
            '6' => __d('public', 'Wystąpienie wydarzenia'),
            '7' => __d('public', 'Otwarcie projektu'),
            '8' => __d('public', 'Zamknięcie projektu'),
            '9' => __d('public', 'Dodanie osoby do projektu'),
            '10' => __d('public', 'Usunięcie osoby z projektu'),
            '11' => __d('public', 'Dodanie pozycji budżetowej'),
            '12' => __d('public', 'Zmiana pozycji budżetowej'),
            '13' => __d('public', 'Usunięcie pozycji budżetowej'),
            '14' => __d('public', 'Realizacja kamienia milowego'),
            '15' => __d('public', 'Wystawienie faktury'),
            '16' => __d('public', 'Oznaczenie opłacenia faktury'),
            '17' => __d('public', 'Odznaczenie realizacji kamienia milowego'),
            '18' => __d('public', 'Odznaczenie opłacenia faktury'),
            '19' => __d('public', 'Zamknięcie finansowania projektu'),
            '20' => __d('public', 'Otwarcie finansowania projektu'),
            '21' => __d('public', 'Dodanie kosztu poz. budżetowej'),
            '22' => __d('public', 'Usunięcie kosztu poz. budżetowej'),
            '23' => __d('public', 'Przypisanie faktury do projektu'),
            '24' => __d('public', 'Dodanie notatki do projektu'),
            '25' => __d('public', 'Faktura do wystawienia'),
            '26' => __d('public', 'Faktura wystawiona'),
            '27' => __d('public', 'Faktura opłacona'),
			//gdzie sa pozostałe typy logów??
            '32' => __d('public', 'Wysyłka maila z ankietą '),
            '33' => __d('public', 'Wypełnienie ankiety'),
            '34' => __d('public', 'Akceptacja protokołu odbioru kamienia milowego'),
        );
    }

    /**
     * Zapisywanie loga
     * 
     * @param		$log_type       typ zdarzenia
     * @param		$data			dane pliku
     * 
     * @return bool                 true- gdy zapisze
     *                              false - w przypadku błędu
     */
    public function saveLog($log_type = null, $data = array())
    {

        if (empty($data) || empty($log_type))
        {
            return false;
        }
        $insert['ClientProjectLog'] = $data['ClientProjectLog'];
        $insert['ClientProjectLog']['type_log_id'] = $log_type;
        $insert['ClientProjectLog']['user_id'] = $data['ClientProjectLog']['user_id'];
        if (isset($data['ClientProjectLog']['client_project_id']))
        {
            $insert['ClientProjectLog']['client_project_id'] = $data['ClientProjectLog']['client_project_id'];
        }
        if (isset($data['ClientProjectLog']['name']))
        {
            $insert['ClientProjectLog']['name'] = $data['ClientProjectLog']['name'];
        }

        $this->create();
        return $this->save($insert);
        //die(debug($this->validationErrors));
    }

    /*
     * Logowanie zapisu/usunięcia pozycji budżetowej
     * 
     * @param	array $data		tablica z danymi budzetu
     * 
     * @return mixed			tablica - gdy zapisze
     * 							false w przypadku błędu
     */

    public function saveProjectBudgetLog($data = array(),$delete = false)
    {
        if (empty($data))
        {
            return false;
        }

        $log['ClientProjectLog']['user_id'] = $data['ClientProjectBudget']['user_id'];
        $log['ClientProjectLog']['client_project_id'] = $data['ClientProjectBudget']['client_project_id'];
        $log['ClientProjectLog']['name'] = $data['ClientProjectBudget']['activity_name'];
		
		if($delete == true){
            return $this->saveLog(13, $log); // Usunięcie pozycji budżetowej
		} else {
            $this->create();
            return $this->saveLog(11, $log); // Dodanie pozycji budżetowej
        } 
    }
	
    /*
     * Logowanie zapisu/usunięcia kosztu dla pozycji budżetowej
     * 
     * @param	array $data		tablica z danymi budzetu
     * 
     * @return mixed			tablica - gdy zapisze
     * 							false w przypadku błędu
     */

    public function saveProjectBudgetCostLog($data = array(),$delete = false)
    {
        if (empty($data))
        {
            return false;
        }

        $log['ClientProjectLog']['user_id'] = $data['ClientProjectBudget']['user_id'];
        $log['ClientProjectLog']['client_project_id'] = $data['ClientProjectBudget']['client_project_id'];
        $log['ClientProjectLog']['name'] = $data['ClientProjectBudget']['activity_name'];
		
		if($delete == true){
            return $this->saveLog(22, $log); // Usunięcie kosztu z pozycji budżetowej
		} else{
            $this->create();
			return $this->saveLog(21, $log); // Dodanie kosztu do pozycji budżetowej
		}
    }

    /**
     * Zapisywanie loga operacji na plikach projektu
     * 
     * @param		$log_type       typ zdarzenia
     * @param		$data			dane pliku
     * 
     * @return bool                 true- gdy zapisze
     *                              false - w przypadku błędu
     */
    public function saveFileLog($log_type = null, $data = array())
    {
        if (empty($data) || empty($log_type))
        {
            return false;
        }

        $insert['ClientProjectLog']['type_log_id'] = $log_type;
        $insert['ClientProjectLog']['user_id'] = $data['ProjectFile']['user_id'];

        if (isset($data['ProjectFile']['client_project_id']))
        {
            $insert['ClientProjectLog']['client_project_id'] = $data['ProjectFile']['client_project_id'];
        } else
        {
            $insert['ClientProjectLog']['client_project_id'] = 0;
        }

        if (is_array($data['ProjectFile']['file']))
        {
            $insert['ClientProjectLog']['name'] = $data['ProjectFile']['file']['name'];
        } else
        {
            $insert['ClientProjectLog']['name'] = $data['ProjectFile']['file'];
        }

        $this->create();
        return $this->save($insert);
    }

    /**
     * Pobiera listę logów przypisanych do projektu
     * 
     * @param   $client_project_id    ID projektu
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getLogList($client_project_id = null)
    {
        if (empty($client_project_id))
        {
            return false;
        }

        return $this->find('all', array(
                    'conditions' => array(
                        'ClientProjectLog.client_project_id' => $client_project_id
                    ),
                    'order' => 'ClientProjectLog.modified asc',
                    'recursive' => 0
        ));
    }

    /**
     * Pobiera listę logów przypisanych do projektu oraz powiązaną sekcją
     * 
     * @param   $client_project_id    ID projektu
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getLogListSection($client_project_id = null)
    {
        if (empty($client_project_id))
        {
            return false;
        }

        if (!$this->ClientProject->exists($client_project_id))
        {
            return false;
        }
        $params = array(
            'conditions' => array(
                'ClientProjectLog.client_project_id' => $client_project_id
            ),
            'order' => 'ClientProjectLog.modified asc',
            'recursive' => 0
        );
        $params['joins'] = array(
            array('table' => 'user_sections',
                'alias' => 'UserSection',
                'type' => 'Left',
                'conditions' => array(
                    'ClientProjectLog.user_id = UserSection.user_id'
                )
            ),
            array('table' => 'profiles',
                'alias' => 'Profile',
                'type' => 'Left',
                'conditions' => array(
                    'ClientProjectLog.user_id = Profile.user_id'
                )
            )
        );
        $params['recursive'] = -1;
        $params['fields'] = array('ClientProjectLog.*','Profile.firstname','Profile.surname', 'UserSection.section_id');
        return $this->find('all', $params);
    }

    /**
     * Pobiera listę logów przypisanych do projektu
     * 
     * @param   $id    ID pliku
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getLog($id = null)
    {
        if (empty($id))
        {
            return false;
        }

        return $this->find('first', array('conditions' => array(
                        'ClientProjectLog.id' => $id
        )));
    }

}
