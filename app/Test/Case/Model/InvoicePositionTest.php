<?php
/* InvoicePosition Test cases generated on: 2015-05-05 12:56:25 : 1430830585*/
App::uses('InvoicePosition', 'Model');

/**
 * InvoicePosition Test Case
 *
 */
class InvoicePositionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
            'app.invoice_position', 
            'app.invoice', 
            'app.client_project', 
            'app.client_lead', 
            'app.client', 
            //'app.user', 
//            'app.user_client', 
            'app.lead_category', 
            'app.lead_status', 
            'app.currency', 
            'app.client_contact', 
            'app.client_contact_client_lead', 
            'app.client_project_shedule');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->InvoicePosition = ClassRegistry::init('InvoicePosition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InvoicePosition);

		parent::tearDown();
	}
        public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
