<?php

/* ClientContact Test cases generated on: 2015-02-19 14:14:17 : 1424351657 */
App::uses('ClientContact', 'Model');

/**
 * ClientContact Test Case
 *
 */
class ClientContactTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.client_contact', 
        'app.client', 
        'app.UserUser', 
        );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->ClientContact = ClassRegistry::init('ClientContact');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientContact);

        parent::tearDown();
    }

    /**
     * testGetClientContact method
     *
     * @return void
     */
    public function testGetClientContact()
    {
        $return = $this->ClientContact->getClientContact();
        $this->assertEqual($return, false, 'brak parmetru');
        
        $client_id = 5;
        $return = $this->ClientContact->getClientContact($client_id);
        $this->assertEqual(is_array($return), true, 'wyciagam dane');
        
        $client_id = -1;
        $return = $this->ClientContact->getClientContact($client_id);
        $this->assertEqual($return, false, 'nie istniejący klient');
    }

    /**
     * testAddClientContact method
     *
     * @return void
     */
    public function testAddClientContact()
    {
       
        $return = $this->ClientContact->addClientContact();
        $this->assertEqual($return, false, 'brak parametru');
        
        $contact = array(
            'firstname' => 'Mateusz',
            'surname' => 'Trześniowski',
            'email' => 'mateo@rz.pl',
            'phone' => '733411775',
            'phone2' => '17 123 45 67',
            'note' => '12312512512eqweqweq'
        );
        $return = $this->ClientContact->addClientContact($contact);
        $this->assertEqual($return, false, 'instnieje taki email w bazie');

        $contact = array(
            'firstname' => '',
            'surname' => 'Trześniowski',
            'email' => 'mateo@rz.pl',
            'phone' => '733411775',
            'phone2' => '17 123 45 67',
            'note' => '12312512512eqweqweq'
        );
        $return = $this->ClientContact->addClientContact($contact);
        $this->assertEqual($return, false, 'pusty firstname');

        $contact = array(
            'ClientContact' => array(
                'firstname' => 'test',
                'surname' => 'Trześniowski',
                'email' => 'mateo2@rz.pl',
                'phone' => '733411775',
                'phone2' => '17 123 45 67',
                'note' => '12312512512eqweqweq'
            )
        );
        $return = $this->ClientContact->addClientContact($contact);
        $this->assertEqual($return, false, 'brak client_id');

        $contact = array(
            'ClientContact' => array(
                'firstname' => 'test',
                'client_id' => 1,
                'surname' => 'Trześniowski',
                'email' => 'mateo2@rz.pl',
                'phone' => '733411775',
                'phone2' => '17 123 45 67',
                'note' => '12312512512eqweqweq'
            )
        );
        $return = $this->ClientContact->addClientContact($contact);
        $this->assertEqual(is_array($return), true, 'poprawne dane');
    }

    /**
     * testDeleteClientContact method
     *
     * @return void
     */
    public function testDeleteClientContact()
    {
        $return = $this->ClientContact->deleteClientContact();
        $this->assertEqual($return, false, 'pusty id');
        
        $contact_id = null;
        $return = $this->ClientContact->deleteClientContact($contact_id);
        $this->assertEqual($return, false, 'pusty id');
        
        $contact_id = -1;
        $return = $this->ClientContact->deleteClientContact($contact_id);
        $this->assertEqual($return, false, 'niepoprawne id');

        $contact_id = 10;
        $return = $this->ClientContact->deleteClientContact($contact_id);
        $this->assertEqual(is_array($return), true, 'poprawne usuniecie');

    }

    
      public function testGetClientContacts()
    {
        $return = $this->ClientContact->getClientContacts();
        $this->assertEqual($return, false, 'brak parmetru');
        
        $client_id = 7;
        $return = $this->ClientContact->getClientContacts($client_id);
        $this->assertEqual(is_array($return), true, 'wyciagam dane');
        
        $client_id = -1;
        $return = $this->ClientContact->getClientContacts($client_id);
        $this->assertEqual($return, false, 'nie istniejący klient');
    }
}
