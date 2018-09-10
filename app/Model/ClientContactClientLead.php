<?php
App::uses('AppModel', 'Model');
/**
 * ClientContactClientLead Model
 *
 */
class ClientContactClientLead extends AppModel {

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();
    
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
     * Logika dla globalnej wyszukiwarki w cms
     * nadpisuje metodę z AppModel
     * 
     * @param array $options
     * @param array $params
     * @return type array
     */
//    public function search($options, $params = array()) {
//        $fraz = $options['Searcher']['fraz'];
//        $params['conditions']['OR']["ClientContactClientLead. LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
	
	    /**
     * Usuwanie osoby kontaktowej
     * 
     * @param int $contact_id   ID osoby
     * @return boolean          true po pomyślnym usunięciu
     *                          false w przypadku błędu
     */
    function deleteClientContactClientLead($lead_id=null, $contact_id = null)
    {
        if (!$contact_id || !$lead_id)
        {
            return false;
        }

		$data = $this->find('first', array(
            'conditions' => array(
                'ClientContactClientLead.client_lead_id' => $lead_id,
                'ClientContactClientLead.client_contact_id' => $contact_id,
            )
        ));
		if(isset($data['ClientContactClientLead']['id'])){
			$this->id = $data['ClientContactClientLead']['id'];
			return $this->delete();	
		} else{
			return false;
		}
        
    }
}

