<?php

/* BriefAnswer Test cases generated on: 2015-06-11 13:20:31 : 1434028831 */
App::uses('Event', 'Model');

/**
 * BriefAnswer Test Case
 *
 */
class EventTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array();

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Event = ClassRegistry::init('Event');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Event);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
