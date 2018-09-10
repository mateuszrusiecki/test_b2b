<?php

App::uses('AppModel', 'Model');

/**
 * Vacation Model
 *
 * @package b2b
 * @property VacationType $VacationType
 * @property VacationStatus $VacationStatus
 * @property VacationReplace $VacationReplace
 */
class Vacation extends AppModel
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
    public $displayField = 'vacation_type_id';

    /**
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'Vacation.created DESC';

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'VacationType' => array(
            'className' => 'VacationType',
            'foreignKey' => 'vacation_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'VacationStatus' => array(
            'className' => 'VacationStatus',
            'foreignKey' => 'vacation_status_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => 'id,email',
            'order' => ''
        ),
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => '',
            'conditions' => array('Profile.user_id = Vacation.user_id'),
            'fields' => 'firstname,surname,work_phone',
            'order' => ''
        ),
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'VacationReplace' => array(
            'className' => 'VacationReplace',
            'foreignKey' => 'vacation_id',
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
    public $months_names = array(
        '1' => 'Styczeń',
        '2' => 'Luty',
        '3' => 'Marzec',
        '4' => 'Kwiecień',
        '5' => 'Maj',
        '6' => 'Czerwiec',
        '7' => 'Lipiec',
        '8' => 'Sierpień',
        '9' => 'Wrzesień',
        '10' => 'Październik',
        '11' => 'Listopad',
        '12' => 'Grudzień',
    );

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array())
    {
        $this->validate = array(
            'vacation_type_id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
                'comparison' => array(
                    'rule' => array('comparison', '>', 0),
                    'allowEmpty' => false,
                )
            ),
            'vacation_status_id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
                'comparison' => array(
                    'rule' => array('comparison', '>', 0),
                    'allowEmpty' => false,
                )
            ),
            'date_start' => array(
                'rule' => array('date', 'ymd'),
                'message' => __d('validate', 'Podaj poprawną datę'),
                'allowEmpty' => false,
                'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'date_end' => array(
                'date' => array(
                    'rule' => array('date', 'ymd'),
                    'message' => __d('validate', 'Podaj poprawną datę'),
                    'allowEmpty' => false,
//                    'required' => true,
                ),
                'date_end' => array(
                    'rule' => array('validate_date'),
                    'message' => __d('validate', 'Data początkowa musi być wcześniejsza lub równa końcowej'),
                )
            ),
            'hour_start' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Podaj poprawną godzinę(8-16)'),
                    'allowEmpty' => false,
                //'required' => true,
                ),
                'eight' => array(
                    'rule' => array('comparison', '>=', 8),
                    'message' => __d('validate', 'Podaj poprawną godzinę większą od 8')
                ),
                'sixteen' => array(
                    'rule' => array('comparison', '<=', 16),
                    'message' => __d('validate', 'Podaj poprawną godzinę mniejszą od 16')
                ),
            ),
            'hour_end' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Podaj poprawną godzinę(8-16)'),
                    'allowEmpty' => false,
                //'required' => true,
                ),
                'eight' => array(
                    'rule' => array('comparison', '>=', 8),
                    'message' => __d('validate', 'Podaj poprawną godzinę większą od 8')
                ),
                'sixteen' => array(
                    'rule' => array('comparison', '<=', 16),
                    'message' => __d('validate', 'Podaj poprawną godzinę mniejszą od 16')
                ),
                'hour_end' => array(
                    'rule' => array('validate_hour'),
                    'message' => __d('validate', 'Godzina początkowa musi być mniejsza od końcowej'),
                )
            ),
        );
    }

    public function validate_hour()
    {
        return $this->data['Vacation']['hour_end'] > $this->data['Vacation']['hour_start'];
    }

    public function validate_date()
    {
        return strtotime($this->data['Vacation']['date_end']) >= strtotime($this->data['Vacation']['date_start']);
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
//        $params['conditions']['OR']["Vacation.vacation_type_id LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }

    /**
     * Dodawanie urlopu
     * 
     * @param int $user_id     ID użytkownika
     * @param array $data        tablica array(
     *                                 vacation_type_id,
     *                                 date_start,
     *                                 date_end,
     *                                 hour_start,
     *                                 hour_end,
     *                                 vacation_status_id
     *                                 )
     * 
     * @return bool            true jeśli zapisano
     *                          false w przeciwnym wypadku
     */
    public function saveVacation($user_id = null, $data = array())
    {
        if (empty($user_id) || empty($data))
        {
            return false;
        } else
        {
            $data['Vacation']['user_id'] = $user_id;
            if (isset($data['Vacation']['is_hours']) && $data['Vacation']['is_hours'] > 0)
            {
                $data['Vacation']['date_end'] = $data['Vacation']['date_start'];
            }
        }

        $this->create();
        if ($this->save($data))
        {
            /*
             * [TODO]
             * 
             * informację o zastępstwie dostaje osoba która została do tego wyznaczona
             * sekretariat widzi zastępstwa we wniosku
             */
            if (!empty($data['VacationReplaces']))
            {
                $this->VacationReplace->create();

                foreach ($data['VacationReplaces'] as $key => $val)
                {
                    if (is_array($val))
                    { //zapis zastępstwa do wybranego projektu
                        $val['vacation_id'] = $this->id;
                        $this->VacationReplace->saveVacationReplace($val['user_id'], $val);
                    }
                }
            }
            return true;
        } else
        {
            return false;
        }
    }

    /**
     * Edycja urlopu
     * 
     * @param type $user_id         ID użytkownika
     * @param type $data            tablica array(
     * 									id
     *                                 vacation_type_id,
     *                                 date_start,
     *                                 date_end,
     *                                 hour_start,
     *                                 hour_end,
     *                                 vacation_status_id
     *                                 )
     * 
     * @return mixed                true jeśli zapisano
     *                              false w przeciwnym wypadku
     */
    public function editVacation($user_id = null, $data = array())
    {

        if (empty($user_id) || !is_array($data))
        {
            return false;
        } else
        {
            $data['Vacation']['user_id'] = $user_id;
        }

        if (!empty($data['Vacation']['id']))
        {
            $this->id = $data['Vacation']['id'];
        } else
        {
            return false;
        }
        
        if(empty($data['Vacation']['date_start'])){
            return false; //data statru jest zawsze wymagana
        }

        if ($data['Vacation']['is_hours'] == 1)
        {

            if (empty($data['Vacation']['time_start']))
            {
                $data['Vacation']['time_start'] = str_replace(':', '', $data['Vacation']['old_time_start']);
            }
            if (empty($data['Vacation']['time_end']))
            {
                $data['Vacation']['time_end'] = str_replace(':', '', $data['Vacation']['old_time_end']);
            }
            $start = strtotime($data['Vacation']['time_start']);
            $end = strtotime($data['Vacation']['time_end']);
            $difference = $end - $start;
            $difference = gmdate('H:i', $difference);
            $data['Vacation']['private_time'] = $difference;

            $data['Vacation']['date_end'] = $data['Vacation']['date_start'];
        }

        
        if (empty($data['Vacation']['date_end']) && $data['Vacation']['vacation_type_id'] == 2)
        {
            $data['Vacation']['date_end'] = $data['Vacation']['date_start'];
        }

        if ($this->save($data))
        {

            if (!empty($data['VacationReplaces']))
            {
                $this->VacationReplace->deleteAll(array('VacationReplace.vacation_id' => $data['Vacation']['id']), false); //usuwam wszystkie zastępstwa dla danego urlopu żeby nie sprawdzać które są nowe a które nie

                $this->VacationReplace->create();
                //debug($data['VacationReplaces']);
                foreach ($data['VacationReplaces'] as $key => $val)
                {
                    if (is_array($val))
                    { //zapis zastępstwa do wybranego projektu 
                        $val['vacation_id'] = $this->id;
                        $this->VacationReplace->saveVacationReplace($val['user_id'], $val);
//                    } else { //zapis zastępstwa ogólnego  //teraz zastępstwo jest wymagane więc sprawdzenie nie jest porzebne
//                        $tmp['vacation_id'] = $this->id;
//                        $this->VacationReplace->saveVacationReplace($val, $tmp);
                    }
                }
            }
            return true;
        } else
        {
            return false;
        }
    }

    /**
     * Lista urlopów danego uzykownik w danycm roku
     * 
     * @param type $user_id     ID użytkownika
     * @param type $year        dany rok
     * 
     * @return mixed            array z dniami urlopu
     *                          false w przypładku błedów
     *                          NULL w przypładku braków rekordow
     */
    public function listVacation($user_id = null, $year = null)
    {
        if (empty($user_id))
        {
            return false;
        }

        if (empty($year))
        {
            $year = date('Y'); //jeśli zmienna pusta to daje aktualny rok
        }
        $params = array();
        $params['conditions'] = array(
            'Vacation.user_id' => $user_id,
            //$date => date('Y-m-d', strtotime($year.'/01/01')),
            'DATE_FORMAT(Vacation.date_start,"%Y")' => $year,
            'DATE_FORMAT(Vacation.date_end,"%Y")' => $year,
        );
        $params['order'] = array(
            'date_start asc',
        );
        $vacations = $this->find('all', $params);

        return !empty($vacations) ? $vacations : null;
    }

    /**
     * Pobieranie szczegółów urlopu.
     * 
     * @params string       $id    ID urlopu
     * @return array|bool               Jeśli urlop istnieje to dane urlopu, jeśli nie - false
     */
    public function getVacation($id = null)
    {
        if (empty($id))
        {
            return false;
        }

        $params['conditions'] = array(
            'Vacation.id' => $id
        );
        $params['recursive'] = -1;
        $params['fields'] = $this->fields;

        $vacation = $this->find('first', $params);

        return !empty($vacation) ? $vacation : false;
    }

    /**
     * Pobiera listę urlopów użytkownika z wybranego okresu
     * 
     * @param   $user_id    int -  ID użytkownika
     * @param   $start		date - początek miesiąca
     * @param   $end		date - koniec miesiąca
     * @param   $STATUS     boolean - status urlopu
     * 
     * @return  mixed		array - lista umów
     * 						false - w przypadku błędu
     */
    public function getVacationByDate($user_id = null, $start = null, $end = null, $status=null)
    {
        if (empty($user_id) || empty($start) || empty($end))
        {
            return false;
        }
        
        $conditions = array(
            'Vacation.user_id' => $user_id,
            'OR' => array(
                array('AND' => array(//urlop która zaczyna się w danym miesiącu
                        array('Vacation.date_start >=' => $start),
                        array('Vacation.date_start <=' => $end)
                    )),
                array('AND' => array(//urlop która kończy się wdanym miesiącu
                        array('Vacation.date_end >=' => $start),
                        array('Vacation.date_end <=' => $end)
                    )),
                array('AND' => array(//urlop która kończy się i zaczyna w danym miesiącu
                        array('Vacation.date_start >=' => $start),
                        array('Vacation.date_end <=' => $end)
                    )),
                array('AND' => array(//urlop która zaczyna się wcześniej i kończy później
                        array('Vacation.date_start <=' => $start),
                        array('Vacation.date_end >=' => $end)
                    )),
//						array('AND' => array(
//							//urlop która zaczyna się wcześniej i jest na czas nieokreślony(macieżyński???)
//							   array('Vacation.date_start <=' => $start),
//							   array('Vacation.date_end =' => null)
//						 )),
            )
        );
        
        if($status){
            $conditions['Vacation.vacation_status_id'] = $status;
        }

        return $this->find('all', array(
                    'conditions' => $conditions,
                    'order' => 'Vacation.id desc'
        ));
    }
    
 

    
    /**
     * Lista wszystkich wniosków urlopowych
     * 
     * @return array        lista wniosków urlopowych
     */
    public function getVacations()
    {

        $todayDate = date('Y-m-d');

        return $this->find('all', array(
                    'joins' => array(
//                        array(
//                            'table' => 'profiles',
//                            'alias' => 'Profile',
//                            'type' => 'LEFT',
//                            'conditions' => array(
//                                'Profile.user_id = Vacation.user_id',
//                            )
//                        ),
                        array(
                            'table' => 'user_contract_histories',
                            'alias' => 'UserContractHistories',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Profile.user_id = UserContractHistories.user_id',
                                "UserContractHistories.id = (SELECT max(id) FROM user_contract_histories WHERE user_id = Profile.user_id AND employment_start <= '{$todayDate}' ORDER BY employment_start DESC)"
                            )
                        ),
                        array(
                            'table' => 'user_sections',
                            'alias' => 'UserSection',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'UserSection.user_id = Vacation.user_id',
                            )
                        ),
                        array(
                            'table' => 'sections',
                            'alias' => 'Section',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Section.id = UserSection.section_id',
                            )
                        ),
                    ),
                    'fields' => array(
                        'Vacation.id',
                        'Vacation.date_start',
                        'Vacation.date_end',
                        'Vacation.time_start',
                        'Vacation.time_end',
                        'Vacation.private_time',
                        'VacationType.name',
                        'VacationType.is_hours',
                        'Vacation.vacation_status_id',
                        'Profile.id',
                        'Profile.firstname',
                        'Profile.surname',
                        'Profile.vacation_days',
                        'Profile.vacation_available',
                        'Section.name',
                        'UserContractHistories.vacation_days',
                        'UserContractHistories.vacation_available',
                    ),
                    'order' => 'Vacation.id',
        ));
    }

    /**
     * Lista wszystkich nadchodzących urlopów dla danej osoby
     * 
     * @param   $user_id		id użykownika
     * 
     * @return array        lista zatwierdzonych wniosków urlopowych
     */
    function getUpcomingVacations($user_id = null)
    {
        if (empty($user_id))
        {
            return false;
        }
        $today = date('Y-m-d');
        $params['fields'] = array('Vacation.*', 'VacationType.*', 'VacationStatus.*', 'User.*', 'Profile.firstname', 'Profile.surname');
        $params['conditions']['Vacation.user_id'] = $user_id;
        $params['conditions']['Vacation.vacation_status_id'] = 4;
//        $params['joins'] = array(
//            array(
//                'table' => 'profiles',
//                'alias' => 'Profile',
//                'type' => 'LEFT',
//                'conditions' => array(
//                    'Profile.user_id = Vacation.user_id',
//                )
//            ),
//        );
        $params['conditions']['or'][]['Vacation.date_start >='] = $today;
        $params['conditions']['or'][]['Vacation.date_end >='] = $today;
        $data = $this->find('all', $params);
        return $data;
    }

    /**
     * Obliczenie frekwecji w procenach
     * 
     * @param   $user_id		id użykownika
     * @param   $date_form		data od kiedy liczyć ferkwencje
     * @param   $date_to		data do kiedy liczyć ferkwencje
     * 
     * @return int        frekwecja w liczbie (procenty)
     */
    function attendance($user_id = null, $date_form = null, $date_to = null)
    {
		if(empty($user_id) || empty($date_form) || empty($date_to)){
			return false;
		}
        //święta 
        $this->EventDefined = ClassRegistry::init('EventDefined');
        $eventsDefinedList = $this->EventDefined->parseEventDefined();

        $workDay = $this->parseToWorkDay($date_form, $date_to, $eventsDefinedList);
        $vacations = $this->getVacationByDate($user_id, $date_form, $date_to);
        $vacationDay = array();
        foreach ($vacations as $vacation)
        {
            $vacationDay = am($vacationDay, $this->parseToWorkDay($vacation['Vacation']['date_start'], $vacation['Vacation']['date_end'], $eventsDefinedList));
        }
        $vacationDay = array_unique($vacationDay);
        $countVacationDay = (count($vacationDay));
        $countworkDay = (count($workDay));
        return number_format((($countworkDay - $countVacationDay) / $countworkDay) * 100, 0);
    }

    /**
     * Parsowanie zakresu dat do pracujących dni
     * 
     * @param   $date_form		data od kiedy liczyć 
     * @param   $date_to		data do kiedy liczyć 
     * 
     * @return array        tablica dni pracujących
     */
    function parseToWorkDay($date_form = null, $date_to = null, $eventsDefinedList = null, $eventsList = null)
    {
		if(empty($date_form) || empty($date_to)){ //$eventsDefinedList i $eventsList mogą być puste
			return false;
		}
        $start = strtotime($date_form);
        $end = strtotime($date_to);

        $count = 0;
        $work = array();
        while (date('Y-m-d', $start) <= date('Y-m-d', $end))
        {
            //stałe wydarzenia w roku
            $holiday = true;
            if (!empty($eventsDefinedList))
            {
                $holiday = empty($eventsDefinedList[date('n-j', $start)]);
            }
            //wydarzenia przypisane do uzytkownika
            //tzw urpopy specjalene
            $event = true;
            if (!empty($eventsList))
            {
                $event = empty($eventsList[date('Y-m-d', $start)]);
            }
            if (date('N', $start) < 6 and $holiday and $event)
            {
                $work[] = date('Y-m-d', $start);
            }
            $start = strtotime("+1 day", $start);
        }
        return $work;
    }

}
