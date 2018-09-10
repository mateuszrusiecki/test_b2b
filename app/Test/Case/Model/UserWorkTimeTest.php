<?php

/* UserWorkTime Test cases generated on: 2015-03-11 09:51:52 : 1426063912 */
App::uses('UserWorkTime', 'Model');

/**
 * UserWorkTime Test Case
 *
 */
class UserWorkTimeTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array('app.user_work_time');

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->UserWorkTime = ClassRegistry::init('UserWorkTime');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserWorkTime);

        parent::tearDown();
    }

    public function testGetUserWorkTime()
    {
        $year = '';
        $user = '';
        $return = $this->UserWorkTime->getUserWorkTime($year, $user);
        $this->assertEquals($return, false, 'pusty parametry');

        $year = null;
        $user = null;
        $return = $this->UserWorkTime->getUserWorkTime($year, $user);
        $this->assertEquals($return, false, 'parametry null');

        $year = '2015';
        $user = '3a38ee92-6934-102d-9f80-579a023712b2';
        $return = $this->UserWorkTime->getUserWorkTime($year, $user);
        $this->assertEquals(is_array($return), true, 'nie zwraca danych');
    }

    public function testGetLastUserWorkTime()
    {
        $year = '';
        $user = '';
        $return = $this->UserWorkTime->getLastUserWorkTime($year, $user);
        $this->assertEquals($return, false, 'pusty parametry');

        $year = null;
        $user = null;
        $return = $this->UserWorkTime->getLastUserWorkTime($year, $user);
        $this->assertEquals($return, false, 'parametry null');

        $year = '2015';
        $user = '3a38ee92-6934-102d-9f80-579a023712b2';
        $month = 5;
        $return = $this->UserWorkTime->getLastUserWorkTime($year, $user, $month);
        $this->assertEquals(is_array($return), true, 'nie zwraca danych');
    }

    public function testSaveUserWorkTime()
    {
        
        $return = $this->UserWorkTime->saveUserWorkTime();
        $this->assertEquals($return, false, 'pusty parametry');

        $data['user_id'] = '3a38ee92-6934-102d-9f80-579a023712b2';
        $data['year'] = '2015';
        $data['month'] = '05';
        $return = $this->UserWorkTime->saveUserWorkTime($data);
        $this->assertEquals($return, false, 'nieprawidłowy miesiać parametry');

        $data['user_id'] = '3a38ee92-6934-102d-9f80-579a023712b2';
        $data['year'] = '2015';
        $data['month'] = '2';
        $return = $this->UserWorkTime->saveUserWorkTime($data);
        $this->assertEquals($return, false, 'poprawne dane');
    }

}
