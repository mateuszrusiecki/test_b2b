<?php

/* BriefAnswer Test cases generated on: 2015-06-11 13:20:31 : 1434028831 */
App::uses('BriefAnswer', 'Model');

/**
 * BriefAnswer Test Case
 *
 */
class BriefAnswerTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array('app.brief_answer', //'app.user', 
        'app.brief_question', 'app.brief', 'app.client_lead', 'app.client', 'app.lead_category', 'app.lead_status', 'app.currency', 'app.client_contact', 'app.client_contact_client_lead');

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->BriefAnswer = ClassRegistry::init('BriefAnswer');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BriefAnswer);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
