<?php

App::uses('AppModel', 'Model');

/**
 * UserContractHistory Model
 *
 */
class UserContractHistory extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();

    /**
     * wyznaczona osoba przez zarząd do przegladania płatnosci
     *
     * @var char 36
     */
    public $userAllowViewSalary = '';

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
    }

    function afterSave($created, $options = array())
    {
        //UPDATE `user_contract_histories` SET `salary`=DECODE('2000','kl*&())!@#$%IOPKLKJHUIłłóęśłłł€r8dfklvfdklh65') WHERE `id` = 4;
        $salt = Configure::read('SalarySalt');
        if (!empty($this->data['UserContractHistory']['salary']))
        {
            $data = $this->data['UserContractHistory'];
            $this->query("UPDATE `user_contract_histories` SET `salary`=DECODE('{$data['salary']}','{$salt}') WHERE `id` = '{$data['id']}';");
        }
        if (!empty($this->data['UserContractHistory']['salary_net']))
        {
            $data = $this->data['UserContractHistory'];
            $this->query("UPDATE `user_contract_histories` SET `salary_net`=DECODE('{$data['salary_net']}','{$salt}') WHERE `id` = '{$data['id']}';");
        }
        if (!empty($this->data['UserContractHistory']['hourly_rate']))
        {
            $data = $this->data['UserContractHistory'];
            $this->query("UPDATE `user_contract_histories` SET `hourly_rate`=DECODE('{$data['hourly_rate']}','{$salt}') WHERE `id` = '{$data['id']}';");
        }
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
//        $params['conditions']['OR']["UserContractHistory. LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }

    /**
     * Zapisuje umowę użytkownika
     * 
     * @param   $user_id		ID użytkownika
     * @param   $contract_id    ID umowy
     * 
     * @return  boolean			true - po poprawnym zapisaniu
     * 							false - w przypadku błędu
     */
    public function saveUserContractHistory($user_id = null, $data = null)
    {
        if (empty($user_id) || empty($data))
        {
            return false;
        }


        $this->create();
        return $this->save($data);
    }

    /**
     * Pobiera listę umów użytkownika
     * 
     * @param   $user_id    ID użytkownika
     * 
     * @return  mixed		array - lista umów
     * 						false - w przypadku błędu
     */
    public function getUserContractHistory($user_id = null)
    {
        if (empty($user_id))
        {
            return false;
        }

        return $this->find('all', array(
                    'conditions' => array(
                        'UserContractHistory.user_id' => $user_id
                    ),
                    'order' => 'UserContractHistory.employment_start desc'
        ));
    }

    /**
     * Pobiera listę umów użytkownika z wybranego okresu
     * 
     * @param   $user_id        int -  ID użytkownika
     * @param   $start		date - początek miesiąca
     * @param   $end		date - koniec miesiąca
     * 
     * @return  mixed		array - lista umów
     * 						false - w przypadku błędu
     */
    public function getUserContractHistoryByDate($user_id = null, $start = null, $end = null)
    {
        if (empty($user_id) || empty($start))
        {
            return false;
        }

        return $this->find('all', array(
                    'conditions' => array(
                        'UserContractHistory.user_id' => $user_id,
                        'OR' => array(
                            array('AND' => array(
                                    //umowa która zaczyna się w danym miesiącu
                                    array('UserContractHistory.employment_start >=' => $start),
                                    array('UserContractHistory.employment_start <=' => $end)
                                )),
                            array('AND' => array(
                                    //umowa która kończy się wdanym miesiącu
                                    array('UserContractHistory.employment_end >=' => $start),
                                    array('UserContractHistory.employment_end <=' => $end)
                                )),
                            array('AND' => array(
                                    //umowa która kończy się i zaczyna w danym miesiącu
                                    array('UserContractHistory.employment_start >=' => $start),
                                    array('UserContractHistory.employment_end <=' => $end)
                                )),
                            array('AND' => array(
                                    //umowa która zaczyna się wcześniej i kończy później
                                    array('UserContractHistory.employment_start <=' => $start),
                                    array('UserContractHistory.employment_end >=' => $end)
                                )),
                            array('AND' => array(
                                    //umowa która zaczyna się wcześniej i jest na czas nieokreślony
                                    array('UserContractHistory.employment_start <=' => $start),
                                    array('UserContractHistory.employment_end =' => null)
                                )),
                        )
                    ),
                    'order' => 'UserContractHistory.id desc'
        ));
    }

    /**
     * Pobiera pierwszą umówę użytkownika
     * 
     * @param   $user_id    ID użytkownika
     * 
     * @return  mixed		array - lista umów
     * 						false - w przypadku błędu
     */
    public function getFirstUserContractHistory($user_id = null, $order = 'desc')
    {
        if (empty($user_id))
        {
            return false;
        }

        return $this->find('first', array(
                    'conditions' => array(
                        'UserContractHistory.user_id' => $user_id
                    ),
                    'order' => 'UserContractHistory.employment_start ' . $order
        ));
    }

    /**
     * Sprawdzenie uprawnien czy dana osoba moze zobaczyc pensje
     * 
     * @param type $id              id umowy 
     * @param type $groups          tablica z grupą uprwnień
     * @param type $user_id         id uzytkownika 
     * 
     * @return bool                 false w wypadku błedu
     *                          
     */
    public function permissionSalary($id = null, $groups = null, $user_id = null)
    {
        if (empty($groups) || empty($id) || empty($user_id))
        {
            return false;
        }
        //wyznaczona osoba przez zarząd do przegladania płatnosci
        if ($this->userAllowViewSalary == $user_id)
        {
            return true;
        }

        //szukam zarządu
        $this->UserSection = ClassRegistry::init('UserSection');
        $sp['conditions']['UserSection.section_id'] = 1;
        $sp['fields'] = array('id', 'user_id');
        $managment = $this->UserSection->find('list', $sp);

        $groups = array_keys($groups);
        if ((in_array('management', $groups) && in_array($user_id, $managment)) || in_array('m_secretariat', $groups)) //dostęp ma zarząd i kierownik sekretariatu
        {
            return true;
        }

        $paramsUserContractHistory['conditions']['UserContractHistory.user_id'] = $user_id;
        $paramsUserContractHistory['conditions']['UserContractHistory.id'] = $id;
        $myProfile = $this->find('count', $paramsUserContractHistory);

//        $paramsTeam['Section.id'] = false;
//        $myTeam = $this->find('count', $paramsTeam);
//        $myTeam = false;
        if ($myProfile)
        {
            return true;
        }
        return false;
    }

    /**
     * Oczytanie i deszyfrowanie wynagrodzenia
     * 
     * @param type $data            tablica z id oraz netto
     * @param type $groups          tablica z grupą uprwnień
     * @param type $user_id         id uzytkonika
     * 
     * @return mixed                array z danym wynagrodzeniem
     *                              false w wypadku błedu
     */
    public function read_salary($data = null, $groups = null, $user_id = null)
    {
        if (empty($user_id) || empty($data) || empty($groups))
        {
            return false;
        }
        if (!$this->permissionSalary($data['id'], $groups, $user_id))
        {
            return false;
        }
        $column = empty($data['netto']) ? 'salary' : 'salary_net';
        $salt = Configure::read('SalarySalt');
        //UPDATE `user_contract_histories` SET `salary`=DECODE('2000','kl*&())!@#$%IOPKLKJHUIłłóęśłłł€r8dfklvfdklh65') WHERE `id` = 4;
        $this->virtualFields['salary_unsafe'] = "ENCODE({$column},'{$salt}')";

        $params = array();
        $params['conditions']['UserContractHistory.id'] = $data['id'];
        //$params['conditions']['UserContractHistory.user_id'] = $user_id;

        $params['recursive'] = '-1';
        $params['order'] = 'UserContractHistory.id DESC';
        $params['fields'] = array('id', 'salary_unsafe');
        $return = $this->find('list', $params);

        if (count($return) !== 1)
        {
            return false;
        }
        return reset($return);
    }

    /**
     * Oczytanie i deszyfrowanie stawki godzinowej
     * 
     * @param type $data            tablica z id oraz netto
     * @param type $groups          tablica z grupą uprwnień
     * @param type $user_id         id uzytkonika
     * 
     * @return mixed                array z danym wynagrodzeniem
     *                              false w wypadku błedu
     */
    public function read_hourly_rate($data = null, $groups = null, $user_id = null)
    {
        if (empty($user_id) || empty($data) || empty($groups))
        {
            return false;
        }
        if (!$this->permissionSalary($data['id'], $groups, $user_id))
        {
            return false;
        }
        $salt = Configure::read('SalarySalt');
        $data['column'] = 'hourly_rate';
        //UPDATE `user_contract_histories` SET `salary`=DECODE('2000','kl*&())!@#$%IOPKLKJHUIłłóęśłłł€r8dfklvfdklh65') WHERE `id` = 4;
        $this->virtualFields['salary_unsafe'] = "ENCODE({$data['column']},'{$salt}')";

        $params = array();
        $params['conditions']['UserContractHistory.id'] = $data['id'];
        //$params['conditions']['UserContractHistory.user_id'] = $user_id;

        $params['recursive'] = '-1';
        $params['order'] = 'UserContractHistory.id DESC';
        $params['fields'] = array('id', 'salary_unsafe');
        $return = $this->find('list', $params);
        if (count($return) !== 1)
        {
            return false;
        }
        return reset($return);
    }

    /**
     * Pobieranie njnowszej umowy
     * 
     * @param type $user_id        id uzytkownika
     * 
     * @return mixed            array z id umowy
     *                          false w wypadku błedu
     */
    public function getCurrentContract($user_id = null)
    {
        if (empty($user_id))
        {
            return false;
        }

        $todayDate = date('Y-m-d');

        $params = array(
            'conditions' => array(
                'UserContractHistory.user_id' => $user_id,
                'UserContractHistory.employment_start <=' => $todayDate,
            //'UserContractHistory.employment_end >=' => $todayDate,
            ),
            'order' => 'UserContractHistory.employment_start DESC',
            'fields' => array(
                'id',
                'employment_start',
                'employment_end',
                'state',
                'working_time',
                'position',
                'vacation_days',
                'vacation_available',
            ),
        );

        $uch = $this->find('first', $params);
        return $uch;
    }

}
