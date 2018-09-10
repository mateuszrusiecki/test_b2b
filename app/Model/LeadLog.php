<?php
App::uses('AppModel', 'Model');
/**
 * LeadLog Model
 *
 */
class LeadLog extends AppModel {

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
            'fields' => 'id,email,avatar,avatar_url',
            'order' => ''
        ),
        'Profile' => array(
			'className' => 'Profile',
			'foreignKey' => '',
			'conditions' => array('Profile.user_id = LeadLog.user_id'),
			'fields' => 'firstname,surname',
			'order' => ''
        ),
    );
	
    /**
    * Display field
    *
    * @var string
    */
	public $displayField = 'name';
    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array()) {
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
		$this->log_type = array(
			'1'=>__d('public','Email'),
			'2'=>__d('public','Nowy plik'),
			'3'=>__d('public','Usunięcie pliku'),
			'4'=>__d('public','Nowa wersja pliku'),
			'5'=>__d('public','Data wydarzenia'),
			'6'=>__d('public','Wystąpienie wydarzenia'),
			'7'=>__d('public','Edycja leadu'),
		);
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
//        $params['conditions']['OR']["LeadLog.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
	
	/**
     * Zapisywanie loga
     * 
     * @param		$log_type       typ zdarzenia
     * @param		$data			dane pliku
     * 
     * @return bool                 true- gdy zapisze
     *                              false - w przypadku błędu
     */
    public function saveLog($log_type=null,$data = array()){
		if(empty($data) || empty($log_type) || !is_array($data)){
			return false;
		}
		
		$data['LeadLog']['type_log_id'] = $log_type;
		
		$this->create();
		return $this->save($data);
		//die(debug($this->validationErrors));
	}
	    
	/**
     * Zapisywanie loga operacji na plikach leada
     * 
     * @param		$log_type       typ zdarzenia
     * @param		$data			dane pliku
     * 
     * @return bool                 true- gdy zapisze
     *                              false - w przypadku błędu
     */
    public function saveFileLog($log_type=null,$data = array()){
		if(empty($data) || empty($log_type) || !is_array($data)){
			return false;
		}
		
		$insert = $data;
		$insert['LeadLog']['type_log_id'] = $log_type;
		
		$insert['LeadLog']['client_lead_id'] = $data['LeadFile']['client_lead_id'];
		if(is_array($data['LeadFile']['file'])){ //przy dowaniaiu pliku i dodaniu nowej wersji ten element raz jest tablicą a raz tylko stringiem
			$insert['LeadLog']['name'] = $data['LeadFile']['file']['name'];
		}else{
			$insert['LeadLog']['name'] = $data['LeadFile']['file'];
		}
        if($data['LeadLog']['user_id']){ //warunek i zawartośc potrzebne do testów
            $insert['LeadLog']['user_id'] = $data['LeadLog']['user_id'];
        }
        if(isset($_SESSION['Auth']['User']['id'])){ //warunek potrzebny do testów
            $insert['LeadLog']['user_id'] = $_SESSION['Auth']['User']['id'];
        }
		
		$this->create();
		return $this->save($insert);
		//die(debug($this->validationErrors));
	}

    /**
     * Pobiera listę logów przypisanych do leadu
     * 
     * @param   $client_lead_id    ID leadu
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getLogList($client_lead_id = null)
    {
		if(empty($client_lead_id)){
			return false;
		}
		
		return $this->find('all',array(
			'conditions' => array(
				'LeadLog.client_lead_id' => $client_lead_id
			),
			'order' => 'LeadLog.modified asc'
		));
        
    }
	
    /**
     * Pobiera listę logów przypisanych do leadu
     * 
     * @param   $id    ID pliku
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getLog($id = null)
    {
		if(empty($id)){
			return false;
		}
		
		return $this->find('first',array('conditions' => array(
			'LeadLog.id' => $id
		)));
        
    }
}

