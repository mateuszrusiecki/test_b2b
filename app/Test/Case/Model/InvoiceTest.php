<?php

/* Invoice Test cases generated on: 2015-04-28 09:14:25 : 1430212465 */
App::uses('Invoice', 'Model');

/**
 * Invoice Test Case
 *
 */
class InvoiceTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.invoice',
        'app.client_project',
        'app.client_lead',
        'app.client',
        'app.user_users',
        'app.lead_category',
        'app.lead_status',
        'app.currency',
        'app.client_contact',
        'app.client_contact_client_lead',
        'app.client_project_shedule',
        'app.payment',
        'app.invoice_position',
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Invoice = ClassRegistry::init('Invoice');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Invoice);

        parent::tearDown();
    }

    public function testGetAllInvoices()
    {
        
        $result = $this->Invoice->getAllInvoices();
        
        $this->assertEquals(is_array($result), true, 'czy wynik jest tablicą');
        $this->assertEquals(sizeof($result), 1, 'czy zgadza się liczba elementów');
        $this->assertEquals($result[0]['Invoice']['account_number'], 'Lorem ipsum dolor sit amet', 'czy zgadza się pierwszy element');
        $this->assertEquals($result[0]['Payment']['name'], 'Płatność jednorazowa', 'czy zgadza się relacja do płatności');
        $this->assertEquals($result[0]['User']['email'], 'admin@feb.net.pl', 'czy zgadza się relacja do usera');
    }
   
    public function testGetClientInvoicesFailed()
    {
        
        $result = $this->Invoice->getClientInvoices('not_existing_user_id');
        
        $this->assertEquals($result, false, 'czy wynik == false');
    }
    
    public function testGetClientInvoicesCorrect()
    {
        
        $result = $this->Invoice->getClientInvoices('55680f13-8020-4ded-8783-2a45904cf98e');
        
        $this->assertEquals(is_array($result), true, 'czy wynik jest tablicą');
        $this->assertEquals($result[0]['Client']['name'], 'Budizol', 'czy zgadza się relacja do klienta');
        $this->assertEquals($result[0]['User']['email'], 'admin@feb.net.pl', 'czy zgadza się relacja do usera');
        $this->assertEquals($result[0]['Invoice']['account_number'], 'Lorem ipsum dolor sit amet', 'czy zgadza się model Invoice');
    }
    
    public function testGetInvoiceFailed()
    {
        
        $result = $this->Invoice->getInvoice();
        
        $this->assertEquals($result, false, 'czy wynik == false');
    }
    
    public function testGetInvoiceCorrect()
    {
        
        $result = $this->Invoice->getInvoice(1);

        $this->assertEquals(is_array($result), true, 'czy wynik jest tablicą');
        $this->assertEquals($result['Invoice']['invoice_nr'], 'Lorem ipsum dolor sit amet', 'czy zgadza się model Invoice');
    }
    
    public function testStart()
    {
        
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }
}