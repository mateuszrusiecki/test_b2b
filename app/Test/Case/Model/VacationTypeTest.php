<?php

/* VacationType Test cases generated on: 2015-02-03 08:16:11 : 1422947771 */
App::uses('VacationType', 'Model');

/**
 * VacationType Test Case
 *
 */
class VacationTypeTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.vacation_type',
        'app.vacation',
        'app.vacation_status',
        'app.vacation_replace',
        'app.userUser'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->VacationType = ClassRegistry::init('VacationType');
        $this->VacationStatus = ClassRegistry::init('VacationStatus');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VacationType);

        parent::tearDown();
    }

    public function testListTypes()
    {
        $return = $this->VacationType->listTypes();
        $this->assertEquals(is_array($return), true, 'jest ok');

        $return = $this->VacationType->listTypes();
        $return2 = reset($return);
        $this->assertEquals(is_string($return2), true, 'jest ok');
    }
    
    public function testGetType() {
        $typeID = 1;
        $return = $this->VacationType->getType($typeID);
        $this->assertEquals(is_array($return), true, 'Prawidłowe ID typu');
        
        $typeID = 'blad';
        $return = $this->VacationType->getType($typeID);
        $this->assertEquals($return, false, 'Nieprawidłowe ID typu');
        
        $typeID = null;
        $return = $this->VacationType->getType($typeID);
        $this->assertEquals($return, false, 'Puste ID typu');
        
        $typeID = array();
        $return = $this->VacationType->getType($typeID);
        $this->assertEquals($return, false, 'ID typu to pusta tablica');
        
        $this->VacationType->beforeValidate();
    }

}
