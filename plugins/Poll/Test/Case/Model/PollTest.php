<?php

/* BriefAnswer Test cases generated on: 2015-06-11 13:20:31 : 1434028831 */
App::uses('Poll', 'Model');

/**
 * BriefAnswer Test Case
 *
 */
class PollTestCase extends CakeTestCase
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

        $this->Poll = ClassRegistry::init('Poll');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Poll);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
