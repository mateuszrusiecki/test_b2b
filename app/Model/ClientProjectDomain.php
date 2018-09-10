<?php
App::uses('AppModel', 'Model');
/**
 * ClientProjectDomain Model
 *
 * @property Project $Project
 * @property ClientDomain $ClientDomain
 */
class ClientProjectDomain extends AppModel {

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
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ClientDomain' => array(
			'className' => 'ClientDomain',
			'foreignKey' => 'client_domain_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
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
    }
    
	
		
/**
     * Pobranie domen przypisanych do danego klienta
     * 
     * @param int $client_id    ID klienta
     * 
     * @return mixed            array domeny
     *                          false w przypadku błędu
     */
    function getProjectDomains($project_id = null)
    {
        if (empty($project_id))
        {
            return false;
        }

        $toReturn = $this->find('list', array(
            'conditions' => array(
                'ClientProjectDomain.project_id' => $project_id
            ),
            'recursive' => -1,
			'fields' => array('client_domain_id','client_domain_id')
        ));

        return empty($toReturn) ? false : $toReturn;
    }
	

	
	
	
    /**
     * Dodawanie domeny do projektu
     * 
     * @param   $project_id    ID projektu
     * @param   $client_domain_id    ID domeny
     * 
     * @return mixed        array Zapisana domena
     *                      false w przypadku błędu
     */
	public function saveProjectDomain($project_id = null,$client_domain_id = null ){
		if (empty($project_id) || empty($client_domain_id))
        {
            return false;
        }
		
        $params = array();
        $params['conditions'] = array(
            'ClientProjectDomain.project_id' => $project_id,
            'ClientProjectDomain.client_domain_id' => $client_domain_id,
        );
		$return = $this->find('first',$params);
		if($return){
			return $return; //jeśli domena jest przypisana do projektu to ją zwracam i nie zapisuje
		} else {
			$data['ClientProjectDomain']['project_id'] = $project_id;
			$data['ClientProjectDomain']['client_domain_id'] = $client_domain_id;

			return $this->save($data);
		}
		
	}
	    
	/**
     *  usuwanie domeny z projektu 
     * 
     * @param   $project_id    ID projektu
     * @param   $client_domain_id    ID domeny
     * 
     * @return  bool    true - prawidłowe usunięcie
     *                  false - w przypadku błędu
     */
    public function deleteProjectDomain($project_id = null,$client_domain_id = null )
    {
        if (empty($project_id) || empty($client_domain_id))
        {
            return false;
        }
		
		$params = array();
        $params['conditions'] = array(
            'ClientProjectDomain.project_id' => $project_id,
            'ClientProjectDomain.client_domain_id' => $client_domain_id,
        );
		$return = $this->find('first',$params);
		
        if(!empty($return['ClientProjectDomain']['id'])){ 
            $this->id = $return['ClientProjectDomain']['id'];
            return $this->delete();
        } else{
            return true;
        }
        
    }
}

