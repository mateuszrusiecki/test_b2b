<?php

/**
 * BriefAnswer Test Case
 *
 */
class EventDefinedTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.events_defined',
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->EventDefined = ClassRegistry::init('EventDefined');
    }
    
    public function testParseEventDefined(){
        
        $result = $this->EventDefined->parseEventDefined();
        
        $this->assertEquals(is_array($result), true, 'czy wynik jest tablicą');
        $this->assertEquals(sizeof($result), 9, 'czy zgadza się liczba elementów');
        $this->assertEquals($result['1-6'], '1-6', 'czy zgadza się wartość elementu o indeksie 1-6');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventDefined);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
