<?php

/* Vacation Test cases generated on: 2015-02-03 08:11:14 : 1422947474 */
App::uses('Vacation', 'Model');

/**
 * Vacation Test Case
 *
 */
class VacationTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.vacation',
        'app.vacation_type',
        'app.vacation_status',
        'app.vacation_replace',
        'app.events_defined',
        'app.userUser',
        'app.profile',
        'app.user_contract_history',
        'app.user_section',
        'app.section'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Vacation = ClassRegistry::init('Vacation');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vacation);

        parent::tearDown();
    }

    /**
     * testSaveVacation method
     *
     * @return void
     */
    public function testSaveVacation()
    {
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, false, 'brak danych do zapisu');

        $user_id = '';
        $data = array();
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, false, 'nieprawidłowy uzytkownik');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $return = $this->Vacation->saveVacation($user_id);
        $this->assertEquals($return, false, 'brak danych do zapisu');

        $return = $this->Vacation->saveVacation();
        $this->assertEquals($return, false, 'brak parametrów funkcji');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['date_end'] = '2015-02-26';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, true, 'prwidłowe dane dni');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['date_end'] = '2015-02-26';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '-1';
        $data['Vacation']['vacation_status_id'] = '-1';
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, false, 'błedne statusy');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['date_start'] = 'test';
        $data['Vacation']['date_end'] = 'test';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, false, 'błedne datne');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['hour_start'] = 'test';
        $data['Vacation']['hour_end'] = 'test';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, false, 'błedne godzina');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['date_end'] = '2015-02-26';
        $data['Vacation']['hour_start'] = '8';
        $data['Vacation']['hour_end'] = '16';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, true, 'prawidłowe dane godziny');
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['hour_start'] = '8';
        $data['Vacation']['hour_end'] = '16';
        $data['Vacation']['vacation_type_id'] = '2';
        $data['Vacation']['is_hours'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, true, 'prawidłowe dane godziny');
        
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['hour_start'] = '8';
        $data['Vacation']['hour_end'] = '16';
        $data['Vacation']['vacation_type_id'] = '2';
        $data['Vacation']['is_hours'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $data['VacationReplaces'] = array(
            1 => array(
                'user_id'=>'54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
                'project_id'=>'155'
            ),
            2 => array(
                'user_id'=>'54e1ebbf-c17c-4eb7-b278-0a2077ecc6b3',
                'project_id'=>'0'
            ),
        );
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, true, 'błąd dodawania wnioosku z zastępstwami do projetów ');
        
        
         $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['hour_start'] = '8';
        $data['Vacation']['hour_end'] = '16';
        $data['Vacation']['vacation_type_id'] = '2';
        $data['Vacation']['is_hours'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $data['VacationReplaces'] = array(
            1 => array(
                'user_id'=>'54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
                'project_id'=>'155'
            ),
            2 => array(
                'user_id'=>'54e1ebbf-c17c-4eb7-b278-0a2077ecc6b3',
                'project_id'=>'0'
            ),
        );
        $return = $this->Vacation->saveVacation($user_id, $data);
        $this->assertEquals($return, true, 'błąd dodawania z zastępstwem ogólnym');
    }

    /**
     * testEditVacation method
     *
     * @return void
     */
    public function testEditVacation()
    {
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, false, 'brak danych do zapisu');

        $user_id = '';
        $data = array();
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, false, 'nieprawidłowy uzytkownik');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $return = $this->Vacation->editVacation($user_id);
        $this->assertEquals($return, false, 'brak danych do zapisu');

        $return = $this->Vacation->editVacation();
        $this->assertEquals($return, false, 'brak parametrów funkcji');

        $data = array();
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data['Vacation']['id'] = '1';
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['date_end'] = '2015-02-26';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, true, 'prwidłowe dane dni');

        $data = array();
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['date_end'] = '2015-02-26';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, false, 'brakuje id');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['date_end'] = '2015-02-26';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '-1';
        $data['Vacation']['vacation_status_id'] = '-1';
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, false, 'błedne statusy');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['date_start'] = 'test';
        $data['Vacation']['date_end'] = 'test';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, false, 'błedne datne');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['hour_start'] = 'test';
        $data['Vacation']['hour_end'] = 'test';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, false, 'błedna godzina');
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['hour_start'] = '8';
        $data['Vacation']['hour_end'] = '16';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '2';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, false, 'brak daty startu');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['date_end'] = '2015-02-26';
        $data['Vacation']['hour_start'] = '8';
        $data['Vacation']['hour_end'] = '16';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '2';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, true, 'prwidłowe dane godziny');
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['date_end'] = null;
        $data['Vacation']['hour_start'] = '8';
        $data['Vacation']['hour_end'] = '16';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '2';
        $data['Vacation']['vacation_status_id'] = '1';
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, true, 'wyjście prywatne - data końcowa jest taka jak początkowa');
        
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['date_start'] = '2015-02-25';
        $data['Vacation']['date_end'] = '2015-02-26';
        $data['Vacation']['is_hours'] = '0';
        $data['Vacation']['vacation_type_id'] = '1';
        $data['Vacation']['vacation_status_id'] = '1';
        $data['VacationReplaces'] = array(
            1 => array(
                'user_id'=>'54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
                'project_id'=>'155'
            ),
            2 => array(
                'user_id'=>'54e1ebbf-c17c-4eb7-b278-0a2077ecc6b3',
                'project_id'=>'0'
            ),
        );
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, true, 'błąd edycji przy wprowadzonych zastępstwach');
        
        
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['date_start'] = '2015-02-27';
        $data['Vacation']['old_time_start'] = '08:00:00';
        $data['Vacation']['old_time_end'] = '08:30:00';
        $data['Vacation']['time_start'] = '083000';
        $data['Vacation']['time_end'] = '100000';
        $data['Vacation']['is_hours'] = '1';
        $data['Vacation']['vacation_type_id'] = '2';
        $data['Vacation']['vacation_status_id'] = '1';
        $data['VacationReplaces'] = array(
            1 => array(
                'user_id'=>'54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
                'project_id'=>'155'
            ),
            2 => array(
                'user_id'=>'54e1ebbf-c17c-4eb7-b278-0a2077ecc6b3',
                'project_id'=>'0'
            ),
        );
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, true, 'błąd edycji przy wprowadzonych zastępstwach i tylko jednej dacie ');
        
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['date_start'] = '2015-02-27';
        $data['Vacation']['old_time_start'] = '08:00:00';
        $data['Vacation']['old_time_end'] = '08:30:00';
        $data['Vacation']['time_start'] = '';
        $data['Vacation']['time_end'] = '100000';
        $data['Vacation']['is_hours'] = '1';
        $data['Vacation']['vacation_type_id'] = '2';
        $data['Vacation']['vacation_status_id'] = '1';
        $data['VacationReplaces'] = array(
            1 => array(
                'user_id'=>'54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
                'project_id'=>'155'
            ),
            2 => array(
                'user_id'=>'54e1ebbf-c17c-4eb7-b278-0a2077ecc6b3',
                'project_id'=>'0'
            ),
        );
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, true, 'błąd edycji przy wprowadzonych zastępstwach i pustym time start ');
        
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $data = array();
        $data['Vacation']['id'] = '1';
        $data['Vacation']['date_start'] = '2015-02-27';
        $data['Vacation']['old_time_start'] = '08:00:00';
        $data['Vacation']['old_time_end'] = '08:30:00';
        $data['Vacation']['time_start'] = '';
        $data['Vacation']['time_end'] = '';
        $data['Vacation']['is_hours'] = '1';
        $data['Vacation']['vacation_type_id'] = '2';
        $data['Vacation']['vacation_status_id'] = '1';
        $data['VacationReplaces'] = array(
            1 => array(
                'user_id'=>'54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
                'project_id'=>'155'
            ),
            2 => array(
                'user_id'=>'54e1ebbf-c17c-4eb7-b278-0a2077ecc6b3',
                'project_id'=>'0'
            ),
        );
        $return = $this->Vacation->editVacation($user_id, $data);
        $this->assertEquals($return, true, 'błąd edycji przy wprowadzonych zastępstwach i pustymi time');
        
        
        
    }

    /**
     * testListVacation method
     *
     * @return void
     */
    public function testListVacation()
    {
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $return = $this->Vacation->listVacation($user_id);
        $this->assertEquals(is_array($return), true, 'brak roku');
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $year = '2015';
        $return = $this->Vacation->listVacation($user_id,$year);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $year = '';
        $return = $this->Vacation->listVacation($user_id,$year);
        $this->assertEquals(is_array($return), true, 'pusty rok');
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $year = 'test';
        $return = $this->Vacation->listVacation($user_id,$year);
        $this->assertEquals($return, false, 'nieprawidłowy rok');
        
        $user_id = '';
        $year = '2015';
        $return = $this->Vacation->listVacation($user_id,$year);
        $this->assertEquals($return, false, 'nieprawidłowy user');
        
        $return = $this->Vacation->listVacation();
        $this->assertEquals($return, false, 'brak parametrów');
        
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $year = '2016';
        $return = $this->Vacation->listVacation($user_id,$year);
        $this->assertEquals(is_null($return), true, 'brak wyników na dany  rok');
        
    }
    
    
/**
  * Pobiera listę urlopów użytkownika z wybranego okresu
  * 
  * @param   $user_id    int -  ID użytkownika
  * @param   $start		date - początek miesiąca
  * @param   $end		date - koniec miesiąca
  * 
  * @return  mixed		array - lista umów
  *						false - w przypadku błędu
  */
    public function testGetVacationByDate(){
       
        $user_id = '';
        $start = '';
        $end = '';
        $return = $this->Vacation->getVacationByDate($user_id,$start,$end);
        $this->assertEquals(is_array($return), false, 'przepuszca wartosci puste');
        
        
        
        
        $user_id = null;
        $start = '';
        $end = '';
        $return = $this->Vacation->getVacationByDate($user_id,$start,$end);
        $this->assertEquals(is_array($return), false, 'przepuszca user_id null reszta puste');
      
        
        $user_id = null;
        $start = null;
        $end = '';
        $return = $this->Vacation->getVacationByDate($user_id,$start,$end);
        $this->assertEquals(is_array($return), false, 'przepuszca end puste reszta null');
        
        
        $user_id = null;
        $start = null;
        $end = null;
        $return = $this->Vacation->getVacationByDate($user_id,$start,$end);
        $this->assertEquals(is_array($return), false, 'przepuszca nulle');
        
        
        $user_id = '';
        $start = null;
        $end = null;
        $return = $this->Vacation->getVacationByDate($user_id,$start,$end);
        $this->assertEquals(is_array($return), false, 'przepuszca user_id pusty reszta nulle');
        
        
        $user_id = '';
        $start = '';
        $end = null;
        $return = $this->Vacation->getVacationByDate($user_id,$start,$end);
        $this->assertEquals(is_array($return), false, 'przepuszca end null reszta puste');
        
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $start = '2015-02-16';
        $end = '2015-02-20';
        $return = $this->Vacation->getVacationByDate($user_id,$start,$end);
        $this->assertEquals(is_array($return), true, 'niezwraca wynikow przy prawidlowych danych');
        $this->assertEquals(count($return), 1, 'zwraca złą liczbe wynikow');
        
    }
    
/**
 * Pobieranie szczegółów  urlopu.
 * 
 * @params string       $id    ID urlopu
 * @return array|bool               Jeśli urlop istnieje to dane urlopu, jeśli nie - false
 */
    public function testGetVacation(){
        $id = ''; 
        $return = $this->Vacation->getVacation($id);
        $this->assertEquals(is_array($return), false, 'puszcza pusty parametr');
        
        $id = null; 
        $return = $this->Vacation->getVacation($id);
        $this->assertEquals(is_array($return), false, 'puszcza id null');
        
        $id = '23'; 
        $return = $this->Vacation->getVacation($id);
        $this->assertEquals(is_array($return), true, 'nie zwraca wyników przy prawidłowych danych');
        $this->assertEquals(count($return), 1 , 'nie zwraca wyników przy prawidłowych danych');
    }
    

    
    public function testGetVacations(){
        $return = $this->Vacation->getVacations();
        $this->assertEquals(is_array($return), true, 'funkcja nie zwraca danych z urlopami');
    }
    
    
    public function testGetUpcomingVacations(){
        
        $user_id = ''; 
        $return  = $this->Vacation->getUpcomingVacations($user_id);
        $this-> assertEquals($return, false,'pusty parametr');
        
        $user_id = null; 
        $return  = $this->Vacation->getUpcomingVacations($user_id);
        $this-> assertEquals($return, false,'parametr null');
        
        $user_id = '55681809-6488-46a0-a94e-337c904cf98e'; 
        $return  = $this->Vacation->getUpcomingVacations($user_id);
        $this-> assertEquals(is_array($return), true,'funkcja nie zwraca urlopów danego użytkownika');
        
        
        
    }
    
    
    public function testAttendance(){
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_from = '2015-01-01';
        $date_to = '2015-05-30';
        $return = $this->Vacation->attendance($user_id,$date_from,$date_to);
        $this->assertEquals(is_numeric($return),true, 'poprawne dane, zwraca frekfencje');
        
        $return = $this->Vacation->attendance();
        $this->assertEquals($return,false, 'brak danych');
        
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_from = null;
        $date_to = null;
        $return = $this->Vacation->attendance($user_id,$date_from,$date_to);
        $this->assertEquals($return,false, 'nie podany zakres dat');
        
        $user_id = null;
        $date_from = '2015-01-01';
        $date_to = '2015-05-30';
        $return = $this->Vacation->attendance($user_id,$date_from,$date_to);
        $this->assertEquals($return,false, 'brak user_id');
        
        
    }
    
    public function testParseToWorkDay(){
        
        $user_id = '';
        $date_from = '';
        $date_to = '';
        $return = $this->Vacation->parseToWorkDay($user_id,$date_from,$date_to);
        $this->assertEquals($return, false, 'puste parametry');
        
        $user_id = null;
        $date_from = null;
        $date_to = null;
        $return = $this->Vacation->parseToWorkDay($user_id,$date_from,$date_to);
        $this->assertEquals($return, false, 'nulle');
        
//        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
//        $date_from = '2015-01-01';
//        $date_to = '';
//        $return = $this->Vacation->parstToWorkDay($user_id,$date_from,$date_to);
//        $this->assertEquals($return, false, 'puste parametry');
        
        
        
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_from = '2015-01-01';
        $date_to = '2015-05-30';
        $return = $this->Vacation->parseToWorkDay($user_id,$date_from,$date_to);
        $this->assertEquals(is_array($return), true, 'funkcja nie zwraca frenkwencji');
    }
    
}
