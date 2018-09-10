<?php
/* VacationStatus Test cases generated on: 2015-02-03 08:11:53 : 1422947513*/
App::uses('VacationStatus', 'Model');

/**
 * VacationStatus Test Case
 *
 */
class VacationStatusTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
            'app.vacation_status', 
            'app.vacation', 
            'app.vacation_type', 
            'app.vacation_replace', 
            'app.userUser',
            'core.translate'
            );

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->VacationStatus = ClassRegistry::init('VacationStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->VacationStatus);

		parent::tearDown();
	}

/**
 * testListVacationStatus method
 *
 * @return void
 */
	public function testListVacationStatus() {
        $return = $this->VacationStatus->listVacationStatus();
        $this->assertEquals(is_array($return), true, 'prawidłowe id');
        
        $this->VacationStatus->beforeValidate();
	}
    

}
