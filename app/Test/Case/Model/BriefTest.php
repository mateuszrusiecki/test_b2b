<?php

/* Brief Test cases generated on: 2015-06-11 13:14:02 : 1434028442 */
App::uses('Brief', 'Model');

/**
 * Brief Test Case
 *
 */
class BriefTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array('app.brief', 
    'app.user_user', 
    'app.profile', 
    'app.client_lead', 
    'app.client', 
        //'app.client_lead', 'app.client', 'app.lead_category', 'app.lead_status', 'app.currency', 'app.client_contact', 'app.client_contact_client_lead', 'app.brief_question'
        );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Brief = ClassRegistry::init('Brief');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Brief);

        parent::tearDown();
    }

    public function testFindByClientLeadId()
    {
        $client_lead_id = 1;
        $recursive = 0;
        $return = $this->Brief->findByClientLeadId($client_lead_id,$recursive);
        $this->assertEquals(is_array($return), true, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Brief']), true, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['User']), true, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Profile']), true, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Profile']), true, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Guardian']), true, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['ClientLead']), true, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Client']), true, 'Szukanie klienta poprawne dane');
        $client_lead_id = 1;
        $recursive = -1;
        $return = $this->Brief->findByClientLeadId($client_lead_id,$recursive);
        $this->assertEquals(is_array($return), true, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Brief']), true, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['User']), false, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Profile']), false, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Profile']), false, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Guardian']), false, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['ClientLead']), false, 'Szukanie klienta poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Client']), false, 'Szukanie klienta poprawne dane');
        
        $client_lead_id = -1;
        $recursive = -1;
        $return = $this->Brief->findByClientLeadId($client_lead_id,$recursive);
        $this->assertEquals($return , false, 'Szukanie klienta poprawne dane');
    }

}
