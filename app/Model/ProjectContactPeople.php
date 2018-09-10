<?php
App::uses('AppModel', 'Model');
/**
 * ProjectContactPeople Model
 *
 * @property ClientProject $ClientProject
 * @property Client $Client
 */
class ProjectContactPeople extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

    public $displayField = 'client_contact_id';
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
		'ClientContact' => array(
			'className' => 'ClientContact',
			'foreignKey' => 'client_contact_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

       
/**
 * 
 *  Zapisanie wszystkich kontaktow w tabeli złączeniowej
 * 
 *  @param $project_id
 *  @param $data
 * 
 *  @return  bool    true  - jezeli prawiłowo
 *                   false - jezeli błąd
 */
        
        
        
    public function saveRows($project_id,$data){
        
    }
	
	/**
     * Pobranie osób kontaktowych danego klienta
     * 
     * @param int $client_id    ID klienta
     * @return mixed            array Lista osób kontaktowych
     *                          false w przypadku błędu
     */
    function getProjectClientContacts($client_project_id = null,$field = 'client_contact_id')
    {
        if (!$client_project_id)
        {
            return false;
        }

        $toReturn = $this->find('list', array(
            'conditions' => array(
                'ProjectContactPeople.client_project_id' => $client_project_id
            ),
			'fields'=>array('client_contact_id',$field),
            'recursive' => -1
        ));

		//die(debug($toReturn));
        return empty($toReturn) ? false : $toReturn;
    }	
	
	
	    /**
     *  usuwanie pliku o danym id 
     * 
     * @param   $id    ID pliku
     * 
     * @return  bool    true - prawidłowe usunięcie
     *                  false - w przypadku błędu
     */
    public function deleteProjectClientContact($id = null)
    {
        if (empty($id))
        {
            return false;
        }

        $this->id = $id;
        return $this->delete();
    }
}
