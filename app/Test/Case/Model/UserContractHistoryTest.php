<?php
/* UserContractHistory Test cases generated on: 2015-03-10 09:59:46 : 1425977986*/
App::uses('UserContractHistory', 'Model');

/**
 * UserContractHistory Test Case
 *
 */
class UserContractHistoryTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.user_contract_history');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->UserContractHistory = ClassRegistry::init('UserContractHistory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserContractHistory);

		parent::tearDown();
	}
/**
  * Pobiera listę umów użytkownika
  * 
  * @param   $user_id    ID użytkownika
  * 
  * @return  mixed		array - lista umów
  *			        false - w przypadku błędu
  */ 
        public function testGetUserContractHistory(){
            
            $user_id = ''; // pusty
            $return =  $this->UserContractHistory->getUserContractHistory($user_id);
            $this->assertEquals(is_array($return), false, 'wykonuje działanie przy pustym parametrze user_Id = "" ');
            
            $user_id = null;
            $return =  $this->UserContractHistory->getUserContractHistory($user_id);
            $this->assertEquals(is_array($return), false, 'przepuszczas null');
            
            $user_id = '3a38ee92-6934-102d-9f80-579a023712b2'; // wypelnione 
            $return =  $this->UserContractHistory->getUserContractHistory($user_id);
            $this->assertEquals(is_array($return), true, 'nie znajduje umów');
            $this->assertEquals(count($return), 3 ,'zwraca złą liczbę wyników');
            
        }
        
     
/**
     * Pobiera pierwszą umówę użytkownika
     * 
     * @param   $user_id    ID użytkownika
     * 
     * @return  mixed		array - lista umów
     *						false - w przypadku błędu
     */
        public function testGetFirstUserContractHistory(){
            
            $user_id = ''; // pusty
            $return =  $this->UserContractHistory->getFirstUserContractHistory($user_id);
            $this->assertEquals(is_array($return), false, 'wykonuje działanie przy pustym parametrze user_Id = "" ');
            
            $user_id = null;
            $return =  $this->UserContractHistory->getFirstUserContractHistory($user_id);
            $this->assertEquals(is_array($return), false, 'przepuszczas null');
            
            $user_id = '3a38ee92-6934-102d-9f80-579a023712b2'; // wypelnione 
            $return =  $this->UserContractHistory->getFirstUserContractHistory($user_id);
            $this->assertEquals(is_array($return), true, 'nie znajduje najnowszej umowy');
            $this->assertEquals(count($return), 1 ,'zwraca złą liczbę wyników');
            
        }
        
/**
  * Zapisuje umowę użytkownika
  * 
  * @param   $user_id		ID użytkownika
  * @param   $contract_id    ID umowy
  * 
  * @return  boolean			true - po poprawnym zapisaniu
  *							false - w przypadku błędu
  */     
        
        
        public function testSaveUserContractHistory(){
            $dataToSave = array(
                array(
                'user_id' => '556818c0-6fdc-4800-8492-33e7904cf98e',
                'parent_id' => NULL,
                'state' => 'Etat próbny',
                'working_time' => '1.0',
                'position' => 'Koordynator',
                'salary' => 0x8010505e,
                'salary_net' => 0xdd072d3b, 
                'hourly_rate' => 0x5049,
                'employment_start' => '2008-01-07',
                'employment_end' => '2008-05-06',
                'vacation_days' => '26',
                'vacation_available' => NULL,
                'period_of_employment' => NULL,
                'right_to_pension' => 0,
                'unemployed' => 0,
                'created' => '2015-05-29 07:44:24',
                'modified' => '2015-05-29 07:44:24'
                ),
            );
            
            $user_id = ''; // puste
            $data =  ''; // puste
            $return = $this->UserContractHistory->saveUserContractHistory($user_id, $data);
            $this->assertEquals($return, false, 'przepuszcza puste paramtery');
            
            $user_id = ''; // puste
            $data =  null; // null
            $return = $this->UserContractHistory->saveUserContractHistory($user_id, $data);
            $this->assertEquals($return, false, 'przepuszcza pusty user_id  oraz data null ');
            
            
            $user_id = null; // null
            $data = '' ; // puste
            $return = $this->UserContractHistory->saveUserContractHistory($user_id, $data);
            $this->assertEquals($return, false, 'przepuszcza user_id  null oraz data pusty ');
            
            
            $user_id = null; //null
            $data = null ; // null 
            $return = $this->UserContractHistory->saveUserContractHistory($user_id, $data);
            $this->assertEquals($return, false, 'przepuszcza oba paremetry null');
            
            $user_id = '3a38ee92-6934-102d-9f80-579a023712b2'; // wypelnione
            $data = '';   //puste
            $return = $this->UserContractHistory->saveUserContractHistory($user_id, $data);
            $this->assertEquals($return, false, 'przepuszcza pusty data');
            
            $user_id = '3a38ee92-6934-102d-9f80-579a023712b2'; // wypelnione
            $data = null ;   //null
            $return = $this->UserContractHistory->saveUserContractHistory($user_id, $data);
            $this->assertEquals($return, false, 'przepuszcza data null');
            
            
            $user_id = ''; // puste
            $data = $dataToSave;   //wypelnione
            $return = $this->UserContractHistory->saveUserContractHistory($user_id, $data);
            $this->assertEquals($return, false, 'przepuszcza pusty user_id');
            
        
            $user_id = ''; // null
            $data = $dataToSave;   //wypelnione
            $return = $this->UserContractHistory->saveUserContractHistory($user_id, $data);
            $this->assertEquals($return, false, 'przepuszcza  user_id null');
            
            $user_id = '556818c0-6fdc-4800-8492-33e7904cf98e'; // wypelnione
            $data =  $dataToSave;   //wypelnione
            $return = $this->UserContractHistory->saveUserContractHistory($user_id, $data);
            $this->assertEquals($return, true, 'nie wykonuje działania z prawidłowymi danymi');
            
            $created = date('Y-m-d H:i:s');
            $this->UserContractHistory->afterSave($created);
            
        }
        
        
	/**
     * Pobiera listę umów użytkownika z wybranego okresu
     * 
     * @param   $user_id        int -  ID użytkownika
     * @param   $start		date - początek miesiąca
     * @param   $end		date - koniec miesiąca
     * 
     * @return  mixed		array - lista umów
     *						false - w przypadku błędu
     */
        public function testGetUserContractHistoryByDate(){
            
            
            $user_id = '';
            $start   = '';
            $end     = '';
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), false, 'puszcza puste ');
            
            $user_id = '';
            $start   = null;
            $end     = null;
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), false, 'puszca pusty user id, stat end nulle');
            
            $user_id = '';
            $start   = '';
            $end     = null;
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), false, 'puszcza end null  user_id start puste');
            
            $user_id = null;
            $start   = '';
            $end     = '';
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), false, 'puszcza user_id null start end puste');
            
            $user_id = null;
            $start   = null;
            $end     = '';
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), false, 'puszcze user_id start null  end pusty');
            
            
            $user_id = null;
            $start   = null;
            $end     = null;
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), false, 'puszcza nulle');
            
            
            $user_id = '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3'; 
            $start   = null;
            $end     = null;
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), false, 'puszcza wypelniony user_id  start end null');
            
            $user_id = '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3'; 
            $start   = '';
            $end     = '';
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), false, 'puszcza wypelniony user_id  start end puste');
            
            // wersja prawidlowa z 1 umowa
            $user_id = '556818c0-6fdc-4800-8492-33e7904cf98e'; 
            $start   = '2015-02-01'; // wypelnione 
            $end     = '2008-08-07'; // wypelnione 
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), true, 'nie wzraca wyników przy dobrych danych');
            $this->assertEquals(count($return), 1, 'zwraca złą liczbe wynikow powinno być 1 umowa');
            
            
            // wersja nie ma umow w tym przedziale
            $user_id = '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3';
            $start   = '2015-01-01'; // wypelnione 
            $end     = '2015-02-15'; // wypelnione 
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), true, 'nie wzraca wyników przy dobrych danych');
            $this->assertEquals(count($return), 0, 'zwraca złą liczbe wynikow');
            
            // wersja prawidłowa kilka umow w tym przedziale 
            $user_id = '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3'; 
            $start   = '2015-03-01'; // wypelnione 
            $end     = '2015-06-15'; // wypelnione 
            $return = $this->UserContractHistory->getUserContractHistoryByDate($user_id,$start,$end);
            $this->assertEquals(is_array($return), true, 'nie wykonuje działania z prawidłowymi danymi');
            
        }
        
        
        public function testPermissionSalary(){
            $id=38;
            $groups = array(
                'm_it' => 'Kierownik IT'
            );
            $user_id = '556818c0-6fdc-4800-8492-33e7904cf98e';
            $return = $this->UserContractHistory->permissionSalary($id, $groups, $user_id);
            $this->assertEquals($return,true,'prawidłowe dane');
            
            $id=null;
            $groups = null;
            $user_id = null;
            $return = $this->UserContractHistory->permissionSalary($id, $groups, $user_id);
            $this->assertEquals($return,false,'puste dane');
            
            $return = $this->UserContractHistory->permissionSalary();
            $this->assertEquals($return,false,'Brak danych');
            
            $id=38;
            $groups = null;
            $user_id = '556818c0-6fdc-4800-8492-33e7904cf98e';
            $return = $this->UserContractHistory->permissionSalary($id, $groups, $user_id);
            $this->assertEquals($return,false,'brak grupy');
            
            $id=null;
            $groups = array(
                'm_it' => 'Kierownik IT'
            );
            $user_id = '556818c0-6fdc-4800-8492-33e7904cf98e';
            $return = $this->UserContractHistory->permissionSalary($id, $groups, $user_id);
            $this->assertEquals($return,false,'brak id');
            
            $id=38;
            $groups = array(
                'm_it' => 'Kierownik IT'
            );
            $user_id = null;
            $return = $this->UserContractHistory->permissionSalary($id, $groups, $user_id);
            $this->assertEquals($return,false,'brak user_id');
            
            $id=38;
            $groups = array(
                'm_it' => 'Kierownik IT'
            );
            $user_id = '55681809-6488-46a0-a94e-337c904cf98e';
            $return = $this->UserContractHistory->permissionSalary($id, $groups, $user_id);
            $this->assertEquals($return,false,'niezgodny user_id');
        }
        
        //nie można przetestować przez zaszyfrowanie pensji w blobie
        public function testReadSalary(){
            
            $data['id'] = 38;
            $data['netto'] = 'salary';
            $groups = array(
                'm_it' => 'Kierownik IT'
            );
            $user_id = '556818c0-6fdc-4800-8492-33e7904cf98e';
            $return = $this->UserContractHistory->read_salary($data, $groups, $user_id);
            $this->assertEquals(is_array($return),false,'prawidłowe dane'); //nie można przetestować przez zaszyfrowanie pensji w blobie
            
            $return = $this->UserContractHistory->read_salary();
            $this->assertEquals(is_array($return),false,'brka danych'); 
            
            $data['id'] = 40;
            $data['netto'] = 'salary';
            $groups = array(
                'm_it' => 'Kierownik IT'
            );
            $user_id = '556818c0-6fdc-4800-8492-33e7904cf98e';
            $return = $this->UserContractHistory->read_salary($data, $groups, $user_id);
            $this->assertEquals(is_array($return),false,'brka uprawnien'); 
            
        }
        
        //nie można przetestować przez zaszyfrowanie pensji w blobie
        public function testReadHourlySalary(){
            
            $data['id'] = 38;
            $data['netto'] = 'salary';
            $groups = array(
                'm_it' => 'Kierownik IT'
            );
            $user_id = '556818c0-6fdc-4800-8492-33e7904cf98e';
            $return = $this->UserContractHistory->read_hourly_rate($data, $groups, $user_id);
            $this->assertEquals(is_array($return),false,'prawidłowe dane'); //nie można przetestować przez zaszyfrowanie pensji w blobie
            
            $return = $this->UserContractHistory->read_hourly_rate();
            $this->assertEquals(is_array($return),false,'brak danych'); 
            
            $data['id'] = 40;
            $data['netto'] = 'salary';
            $groups = array(
                'm_it' => 'Kierownik IT'
            );
            $user_id = '556818c0-6fdc-4800-8492-33e7904cf98e';
            $return = $this->UserContractHistory->read_hourly_rate($data, $groups, $user_id);
            $this->assertEquals(is_array($return),false,'brak uprawnien'); 
            
        }
        
        
        public function testGetCurrentContract(){

            $user_id= '';
            $return = $this->UserContractHistory->getCurrentContract($user_id);
            $this->assertEquals($return,false,'pusty parametr');
            
            $user_id= NULL;
            $return = $this->UserContractHistory->getCurrentContract($user_id);
            $this->assertEquals($return,false,'parametr null');
            
            $user_id= '3a38ee92-6934-102d-9f80-579a023712b2';
            $return = $this->UserContractHistory->getCurrentContract($user_id);
            $this->assertEquals(is_array($return),true,'nie zwraca aktualnej umowy');
        }

}
