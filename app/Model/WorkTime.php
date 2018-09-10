<?php
App::uses('AppModel', 'Model');
/**
 * WorkTime Model
 *
 */
class WorkTime extends AppModel {

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
//        $params['conditions']['OR']["WorkTime. LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
	
	
    /**
     * Pobiera liczbę godzin pracujących w danym miesiącu
     * 
     * @param   $year		int - rok
     * @param   $month		int - miesiąc
     * 
     * @return  mixed		array - rekord zawierający liczbę godzin
     *						false - w przypadku błędu
     */
	function getWorkTime($year=null,$month=null){
		if(empty($year) || empty($month)){
			return false;
		}
		
		return $this->find('first',array(
			'conditions' => array(
				'WorkTime.year' => $year,
				'WorkTime.month' => $month,
			)
		));
	}
	
/**
 * Nieużywana
 * Zapisuje liczbę godzin pracujących w danym miesiącu
 * 
 * @param   $data		array - tablica z danymi do zapisu
 * @param   $month		int - miesiąc
 * 
 * @return  boolean		true - w przypadku poprawnego zapisu
 *						false - w przypadku błędu
 */
//	function saveWorkTime($data=null){
//		if(empty($data) || !is_array($data)){
//			return false;
//		}
//		
//		$this->create();
//                if($this->save($data)){
//                    return true;
//                }else{
//                    return false;
//                }
//	}
        
        /*
         * Pobiera z bazy rekord na podstawie roku i miesiąca
         * 
         * @param int $year            rok
         * @param int $month           miesiąc
         * 
         * @return array               workTime
         */
        public function getWorkTimeByYearAndMonth($year, $month){
            
            return $this->find('first', array(
                'conditions' => array(
                    'year' => $year,
                    'month' => $month
                )
            ));
        }
        
    /*
     * Zapisuje w bazie liczby dni i godzin pracujących na podstawie kalendarza
     * 
     * @param $year           rok
     */
    public function saveWorkTimes($year = null){
        if(empty($year) || $year < 2000 || $year > 2100){
            return false;
        }
        
        $event = ClassRegistry::init('Event');
        
        for($i = 1; $i <= 12; $i++){
            
            $workTime = $this->getWorkTimeByYearAndMonth($year, $i);
            $workDays = $event->getMonthWorkingDays($i, $year);
            
            if($workTime){
       
                $workTime['WorkTime']['work_days'] = $workDays;
                $workTime['WorkTime']['work_hours'] = $workDays * 8;
                
                return $this->save($workTime ,false);
            } else {
                
                $this->create();         
                $workTime['WorkTime']['year'] = $year;
                $workTime['WorkTime']['month'] = $i;
                $workTime['WorkTime']['work_days'] = $workDays;
                $workTime['WorkTime']['work_hours'] = $workDays * 8;

                return $this->save($workTime ,false);
            }
        }
        
        //$this->autoRender = false;
    }
}

