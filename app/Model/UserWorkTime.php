<?php
App::uses('AppModel', 'Model');
/**
 * UserWorkTime Model
 *
 */
class UserWorkTime extends AppModel {

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
//        $params['conditions']['OR']["UserWorkTime. LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
	
	/*
	 * Pobieram listy czasu pracy użytkownika w danym roku
	 * 
     * @param   $year		rok
     * @param   $user_id    ID użytkownika
     * 
     * @return  mixed		array - lista czasów pracy
     *						false - w przypadku błędu
	 */
	public function getUserWorkTime($year=null,$user_id=null){
		if(empty($user_id) || empty($year)){
			return false;
		}
		
		return $this->find('all',array(
			'conditions'=>array(
					'UserWorkTime.user_id' => $user_id,
					'UserWorkTime.year' => $year
				),
			'order' => 'UserWorkTime.month DESC'
		));
	}
	
	
	/*
	 * Pobieram wpis czasu pracy użytkownika z poprzedniego miesiąca
	 * 
     * @param   $year		rok
     * @param   $user_id    ID użytkownika
	 * @param	$month_back liczba miesiący wstecz
     * 
     * @return  mixed		array - szczegóły czasu pracy
     *						false - w przypadku błędu
	 */
	public function getLastUserWorkTime($year=null,$user_id=null,$month=0){
		if(empty($user_id) || empty($year)){
			return false;
		}
		if($month == 0) $month = date('m'); //miesiąc aktualny
		return $this->find('first',array(
				'conditions'=>array(
					'UserWorkTime.user_id' => $user_id,
					'UserWorkTime.year' => $year,
					'UserWorkTime.month' => $month,
				)
		));
	}
	
	/*
	 * Funkcja sumuje i zapisuje czas pracy użytkownika za poprzedni miesiąc
	 * 
     * @param   $data			array - dane do zapisu
     * 
     * @return  boolean			true - po poprawnym zapisaniu
     *							false - w przypadku błędu
	 */
	public function saveUserWorkTime($data){
		
		if(empty($data)){
			return false;
		}
      
		$result = $this->find('first',array(
				'conditions'=>array(
					'UserWorkTime.user_id' => $data['user_id'],
					'UserWorkTime.year' => $data['year'],
					'UserWorkTime.month' => $data['month']
				)
		));
		if(isset($result['UserWorkTime']['id'])){
			$this->id = $result['UserWorkTime']['id']; //edytuje jesli taki wpis już jest
		}else{
			$this->create(); //zapisuje jeśli nie ma
		} 
	//die(debug($data));
		return $this->save($data);
        
	}
	
	
	/*
	 * Funkcja zapisuje czas pracy użytkownika w aktualnym miesiącu
	 * 
     * @param   $user_id		ID użytkownika
     * 
     * @return  boolean			true - po poprawnym zapisaniu
     *							false - w przypadku błędu
	 */
	public function saveUserCurrentWorkTime(){
		
		
		return false;
	}
	
	/*
	 * Zapisuję listę czasu pracy wszystkich użytkowników w danym miesiącu
	 *
     * @return  boolean			true - po poprawnym zapisaniu
     *							false - w przypadku błędu
	 */
	public function saveAllUserWorkTime(){

		
		return false;
        
		
	}
}

