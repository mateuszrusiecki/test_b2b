<?php

/* Grindstone Test cases generated on: 2015-02-11 09:19:08 : 1423642748 */
App::uses('Grindstone', 'Model');

/**
 * Grindstone Test Case
 *
 */
class GrindstoneTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array('app.grindstone');

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Grindstone = ClassRegistry::init('Grindstone');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Grindstone);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
