<?php
App::uses('AppModel', 'Model');
/**
 * ClientProjectBudgetPosition Model
 *
 * @property ClientProjectBudget $ClientProjectBudget
 */
class ClientProjectBudgetPosition extends AppModel {

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
		'ClientProjectBudget' => array(
			'className' => 'ClientProjectBudget',
			'foreignKey' => 'client_project_budget_id',
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
     * Logika dla globalnej wyszukiwarki w cms
     * nadpisuje metodę z AppModel
     * 
     * @param array $options
     * @param array $params
     * @return type array
     */
//    public function search($options, $params = array()) {
//        $fraz = $options['Searcher']['fraz'];
//        $params['conditions']['OR']["ClientProjectBudgetPosition.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
	
	function saveProjectBudgetPosition($data = null){
		if(empty($data)){
                    return false;
                }
		
		if(!isset($data['ClientProjectBudgetPosition']['id'])){
			$this->create();
		}
		return $this->save($data);
	}
	
	/**
     * Wszystkie pozycje budżetowe wybranej sekcji budżetu projektu
     * 
     * @param int $client_project_budget_id		id budżetu
     * @return type mixed						array jeśli znajdzie
	 *											false w przypadku błędu
     */
    function getAllProjectBudgetPositions($client_project_budget_id = null)
    {
        if (empty($client_project_budget_id))
        {
            return false;
        }
		
        $params['recusive'] = 0;
		//$params['fields'] = array('id','client_project_id','section_id','activity_name','pm','buffer_percentage','margin_percentage','position_cost','position_value');
        $params['conditions']['ClientProjectBudgetPosition.client_project_budget_id'] = $client_project_budget_id;
        $return = $this->find('all', $params);
        return $return;
    }
	
    /**
     * Usuwanie pozycji budżetowej
     * 
     * @param int $id			ID pozycji budżetowej
     * @return boolean          true po pomyślnym usunięciu
     *                          false w przypadku błędu
     */
	function deleteProjectBudgetPosition($id){
        if (!$id)
        {
            return false;
        }
		
        $this->id = $id;
        return $this->delete();
	}
        /**
     * Usuwnie płatnosci projektów (drugi krok)
     * 
     * @param int $value			array	dane do zapisu
     * @return type boolean		true	gdy usunie poprawnie
     * 							false	w przypadku błędu
     */
    function deleteProjectBudgetPayment($value = null)
    {
        if (!empty($value['delete']))
        {
            if (!empty($value['id']))
            {
                $this->delete($value['id'], false);
            }
            return true;
        }
        return false;
    }
}

