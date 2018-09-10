<?php
/* WorkTime Test cases generated on: 2015-03-12 13:35:34 : 1426163734*/
App::uses('WorkTime', 'Model');

/**
 * WorkTime Test Case
 *
 */
class WorkTimeTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.work_time','app.event','app.events_defined');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->WorkTime = ClassRegistry::init('WorkTime');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WorkTime);

		parent::tearDown();
	}

        
   /**
     * Pobiera liczbę godzin pracujących w danym miesiącu
     * 
     * @param   $year		int - rok
     * @param   $month		int - miesiąc
     * 
     * @return  mixed		array - rekord zawierający liczbę godzin
     *						false - w przypadku błędu
     */
        function testGetWorkTime(){
            
            $year  = '';
            $month = '';
            $return = $this->WorkTime->getWorkTime($year,$month);
            $this->assertEquals(is_array($return), false, 'puszcza puste parametry');
            
            $year  = '';
            $month = null;
            $return = $this->WorkTime->getWorkTime($year,$month);
            $this->assertEquals(is_array($return), false, 'puszcza pusty rok miesiac null');
            
            $year  = null;
            $month = '';
            $return = $this->WorkTime->getWorkTime($year,$month);
            $this->assertEquals(is_array($return), false, 'puszcza rok null pusty miesiac');
            
            $year  = null;
            $month = null;
            $return = $this->WorkTime->getWorkTime($year,$month);
            $this->assertEquals(is_array($return), false, 'puszcza nulle');
            
            $year  = '2015';
            $month = '1';
            $return = $this->WorkTime->getWorkTime($year,$month);
            $this->assertEquals(is_array($return), true, 'nie zwraca wyniku, przy dobrych danych wejsciowych');
            
            $year  = '2000';
            $month = '1';
            $return = $this->WorkTime->getWorkTime($year,$month);
            $this->assertEquals(is_array($return), false, 'zwraca wyniki gdzie w bazie nie powinno tego znalesc');
            
        }       
        
/**
 * Zapisuje liczbę godzin pracujących w danym miesiącu
 * 
 * @param   $data		array - tablica z danymi do zapisu
 * @param   $month		int - miesiąc
 * 
 * @return  boolean		true - w przypadku poprawnego zapisu
 *						false - w przypadku błędu
 */

        
        public function testSaveWorkTimes(){
            $this->WorkTime->beforeValidate();
            
            $year = '2015';
            $return = $this->WorkTime->saveWorkTimes($year);
            $this->assertEquals(is_array($return), true,'poprawne dane');
            
            $year = '2012';
            $return = $this->WorkTime->saveWorkTimes($year);
            $this->assertEquals(is_array($return), true,'poprawne dane');
            
            $return = $this->WorkTime->saveWorkTimes();
            $this->assertEquals($return, false,'brak danych');
            
            $year = 'kuku';
            $return = $this->WorkTime->saveWorkTimes();
            $this->assertEquals($return, false,'niepoprawny rok');
            
            $year = '1234';
            $return = $this->WorkTime->saveWorkTimes();
            $this->assertEquals($return, false,'niepoprawny rok');
            
            
        }
        
}
