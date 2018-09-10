<?php

/* BriefAnswer Test cases generated on: 2015-06-11 13:20:31 : 1434028831 */
App::uses('Version', 'Model');

/**
 * BriefAnswer Test Case
 *
 */
class VersionTestCase extends CakeTestCase
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

        $this->Version = ClassRegistry::init('Version');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Version);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
