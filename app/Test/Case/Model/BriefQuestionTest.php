<?php

/* BriefQuestion Test cases generated on: 2015-06-11 13:16:28 : 1434028588 */
App::uses('BriefQuestion', 'Model');

/**
 * BriefQuestion Test Case
 *
 */
class BriefQuestionTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array('app.brief_question', 
        //'app.brief', 'app.user', 'app.client_lead', 'app.client', 'app.lead_category', 'app.lead_status', 'app.currency', 'app.client_contact', 'app.client_contact_client_lead', 'app.brief_answer'
        );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->BriefQuestion = ClassRegistry::init('BriefQuestion');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BriefQuestion);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
