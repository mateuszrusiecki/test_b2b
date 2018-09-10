<?php

/**
 * SynchronizeLog Test Case
 *
 */
class SynchronizeLogTest extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        //'app.synchronize_log'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->SynchronizeLog = ClassRegistry::init('SynchronizeLog');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SynchronizeLog);

        parent::tearDown();
    }

    public function testLog()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
