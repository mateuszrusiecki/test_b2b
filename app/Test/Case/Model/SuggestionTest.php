<?php

/* BriefAnswer Test cases generated on: 2015-06-11 13:20:31 : 1434028831 */
App::uses('Suggestion', 'Model');

/**
 * BriefAnswer Test Case
 *
 */
class SuggestionTestCase extends CakeTestCase
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

        $this->Suggestion = ClassRegistry::init('Suggestion');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Suggestion);

        parent::tearDown();
    }

    public function testBeforeValidate()
    {
        $return = $this->Suggestion->beforeValidate();
    }

}
