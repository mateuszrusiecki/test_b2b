<?php

/* ClientContactClientLead Test cases generated on: 2015-03-05 13:06:50 : 1425557210 */
App::uses('ClientContactClientLead', 'Model');

/**
 * ClientContactClientLead Test Case
 *
 */
class ClientContactClientLeadTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array('app.client_contact_client_lead');

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->ClientContactClientLead = ClassRegistry::init('ClientContactClientLead');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientContactClientLead);

        parent::tearDown();
    }

    public function testDeleteClientContactClientLead()
    {
        $lead_id = null;
        $contact_id = null;
        $return = $this->ClientContactClientLead->deleteClientContactClientLead($lead_id,$contact_id);
        $this->assertEquals($return, false, 'Brak id oraz brak contact id');
        
        $lead_id = 6;
        $contact_id = 5;
        $return = $this->ClientContactClientLead->deleteClientContactClientLead($lead_id,$contact_id);
        $this->assertEquals($return, true, 'Poprawne dane');
        
        $lead_id = 1;
        $contact_id = 1;
        $return = $this->ClientContactClientLead->deleteClientContactClientLead($lead_id,$contact_id);
        $this->assertEquals($return, false, 'Brak wpisu w cliencontactlead');
        
        $this->ClientContactClientLead->beforeValidate();
    }

}
