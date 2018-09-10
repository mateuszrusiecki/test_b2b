<?php
/* Country Test cases generated on: 2015-06-11 13:20:31 : 1434028831 */

/**
 * Country Test Case
 *
 */
class CountryTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.country'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Country = ClassRegistry::init('Country');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Country);

        parent::tearDown();
    }

    public function testStart()
    {
        
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
