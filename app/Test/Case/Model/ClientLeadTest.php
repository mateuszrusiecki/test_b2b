<?php

App::uses('ClientLead', 'Model');

/**
 * ClientLead Test Case
 *
 */
class ClientLeadTest extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.profile',
        'app.client_lead',
        'app.client',
        'app.userUser',
//        'app.user_client',
        'app.lead_category',
        'app.lead_status',
        'app.currency',
        'app.client_contact',
        'app.client_contact_client_lead'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->ClientLead = ClassRegistry::init('ClientLead');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientLead);

        parent::tearDown();
    }

    /**
     * Dodawanie leada
     * 
     * @param array $lead   Lead
     * @return mixed        array Zapisany lead
     *                      false w przypadku błędu
     */
    public function testAddClientLead()
    {
        $return = $this->ClientLead->addClientLead();
        $this->assertEquals($return, false, 'brak parametru');

        $lead = array();
        $return = $this->ClientLead->addClientLead($lead);
        $this->assertEquals($return, false, 'pusta tablica parametrów');

        $lead['ClientLead'] = array('id' => -1);
        $return = $this->ClientLead->addClientLead($lead);
        $this->assertEquals($return, false, 'nieprawidłowe id');

        $lead['ClientLead'] = array('id' => 1, 'name' => 'nowy');
        $return = $this->ClientLead->addClientLead($lead);
        $this->assertEquals(is_array($return), false, 'edycja leada');

        $this->assertEquals(is_array($return['ClientLead']), false, 'edycja leada niepoprawne');

        unset($lead);

        $lead['ClientLead'] = array('name' => 'testtest');
        $return = $this->ClientLead->addClientLead($lead);
        $this->assertEquals($return, false, 'zle brak wymaganych dane');

        $this->assertEquals(is_array($return['ClientLead']), false, 'zle brak wymaganych dane');

        $this->assertEquals(!empty($return['ClientLead']['name']), false, 'zle brak wymaganych dane');

        unset($lead);
        $lead['ClientLead'] = array(
            'name' => 'Przykładowa nazwa leadu',
            'client_id' => '1',
            'lead_category_id' => '2',
            'lead_status_id' => '1',
            'probability' => '40',
            'amount' => '1000',
            'currency_id' => '1',
            'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2'
        );
        $return = $this->ClientLead->addClientLead($lead);

        $this->assertEquals($return == !false, true, 'poprawne dane');

        $this->assertEquals(is_array($return['ClientLead']), true, 'poprawne dane');

        $this->assertEquals(!empty($return['ClientLead']['name']), true, 'poprawne dane');
    }

    /**
     * Pobranie leadów przypisanych do klienta
     * 
     * @param int $client_id    ID klienta  
     * @return mixed            array Lista leadów
     *                          false w przypadku błędu
     */
    public function testGetLeads()
    {
        $return = $this->ClientLead->getLeads();
        $this->assertEquals($return, false, 'brak parametru');

        $return = $this->ClientLead->getLeads(-1);
        $this->assertEquals($return, false, 'niepoprawny parametr');

        $client_id = '1';
        $return = $this->ClientLead->getLeads($client_id);
        $return = reset($return);
        $this->assertEquals(is_array($return), true, 'poprawne dane');
        $this->assertEquals(count($return) == 2, true, 'poprawne dane');

        $this->assertEquals(is_array($return['ClientLead']), true, 'poprawne dane');

        $this->assertEquals(is_array($return['Profile']), true, 'poprawne dane');
    }

    /**
     * Pobranie szczegółów leadu
     * 
     * @param int $id       ID leadu
     * @return mixed        array Szczegółów leadu
     *                      false w przypadku błędu
     */
    public function testGetLeadDetails()
    {
        $return = $this->ClientLead->getLeadDetails();
        $this->assertEquals($return, false, 'brak parametru');

        $return = $this->ClientLead->getLeadDetails(-1);
        $this->assertEquals($return, false, 'niepoprawny parametr');

        $id = '1';
        $return = $this->ClientLead->getLeadDetails($id);
        $this->assertEquals(is_array($return), true, 'poprawne dane');

        //$this->assertEquals(is_array($return), true, 'poprawne dane');
    }

    /**
     * Pobranie osób kontaktowych przypisanych do leadu
     * 
     * @param int $id       ID leadu
     * @return mixed        array Kontakty leadu
     *                      false w przypadku błędu
     */
    public function testGetLeadContacts()
    {
        $return = $this->ClientLead->getLeadContacts();
        $this->assertEquals($return, false, 'brak parametru');

        $return = $this->ClientLead->getLeadContacts(-1);
        $this->assertEquals($return, false, 'niepoprawny parametr');

        $id = '1';
        $return = $this->ClientLead->getLeadContacts($id);
        $this->assertEquals(is_array($return), true, 'poprawne dane');

        //$this->assertEquals(is_array($return), true, 'poprawne dane');
    }

    /**
     * Usuwanie osoby kontaktowej z leadu
     * 
     * @param int $lead_id      ID leadu
     * @param int $contact_id   ID osoby
     * @return boolean          true po pomyślnym usunięciu
     *                          false w przypadku błędu
     */
    public function testDeleteLeadContact()
    {
        $return = $this->ClientLead->deleteLeadContact();
        $this->assertEquals($return, false, 'niepoprawny parametr');

        $lead_id = null;
        $contact_id = null;
        $return = $this->ClientLead->deleteLeadContact($lead_id, $contact_id);
        $this->assertEquals($return, false, 'niepoprawny parametr');

        $lead_id = null;
        $contact_id = 5;
        $return = $this->ClientLead->deleteLeadContact($lead_id, $contact_id);
        $this->assertEquals($return, false, 'niepoprawny lead_id');

        $lead_id = 6;
        $contact_id = null;
        $return = $this->ClientLead->deleteLeadContact($lead_id, $contact_id);
        $this->assertEquals($return, false, 'niepoprawny contact_id');

        $lead_id = 66666;
        $contact_id = 44444;
        $return = $this->ClientLead->deleteLeadContact($lead_id, $contact_id);
        $this->assertEquals($return, false, 'nie ma takiego lead_id i  contact_id');

        $lead_id = 7;
        $contact_id = 10;
        $return = $this->ClientLead->deleteLeadContact($lead_id, $contact_id);
        $this->assertEquals($return, true, 'blad usuwania');
    }

    /**
     * Dodawanie kontaktu do leadu z listy kontaktów klienta
     * 
     * @param int $lead_id      ID leadu
     * @param int $contact_id   ID kontaktu
     * @return mixed            array Zapisane połączenie lead - kontakt
     *                          false w przypadku błędu
     */
    public function testAddClientContactList()
    {
        $return = $this->ClientLead->addClientContactList();
        $this->assertEquals($return, false, 'brak parametru');

        $lead_id = array();
        $return = $this->ClientLead->addClientContactList($lead_id);
        $this->assertEquals($return, false, 'pusta tablica parametrów');

        $lead_id = -1;
        $return = $this->ClientLead->addClientContactList($lead_id);
        $this->assertEquals($return, false, 'nieprawidłowe id');

        $lead_id = -1;
        $contact_id = -1;
        $return = $this->ClientLead->addClientContactList($lead_id, $contact_id);
        $this->assertEquals($return, false, 'nieprawidłowe id');

        $lead_id = 1;
        $contact_id = -1;
        $return = $this->ClientLead->addClientContactList($lead_id, $contact_id);
        $this->assertEquals($return, false, 'nieprawidłowe id');

        $lead_id = 1;
        $contact_id = array();
        $return = $this->ClientLead->addClientContactList($lead_id, $contact_id);
        $this->assertEquals($return, false, 'nieprawidłowe id');

        $contact_id = 24;
        $lead_id = 1;
        $return = $this->ClientLead->addClientContactList($lead_id, $contact_id);
        $this->assertEquals(is_array($return), true, 'poprawne dane');
    }

    /**
     * Pobranie leadów utworzonych w wybranym przedziale czasowym
     * 
     * @param string $user_id       ID użytkownika
     * @param string $client_id     ID klienta 
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    public function testGetUserCreatedLeadsByDate()
    {

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = '1';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserCreatedLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'nie zwraca tablicy');
        $this->assertEquals(count($return), 4, 'zwraca złą liczbę wyników w stosunku do zakresu dat');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = '';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserCreatedLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'puszcza pusty client_id');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = null;
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserCreatedLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'puszcza client_id null');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $client_id = '';
        $date_end = '';
        $return = $this->ClientLead->getUserCreatedLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_end pusty, client_id pusty');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '';
        $client_id = '1';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserCreatedLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_start pusty ');

        $user_id = '';
        $client_id = '1';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserCreatedLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza user_id pusty');
    }

    /**
     * Pobranie leadów wygranych w podanym przedziale czasowym dla wybrnego klienta
     * 
     * @param string $user_id       ID użytkownika
     * @param string $client_id     ID klienta 
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    public function testGetUserWinLeadsByDate()
    {

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = '1';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserWinLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'nie zwraca tablicy');
        $this->assertEquals(count($return), 1, 'zwraca złą liczbę wyników w stosunku do zakresu dat');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = '';
        $date_start = '2015-03-01';
        $date_end = '';
        $return = $this->ClientLead->getUserWinLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_end pusty, client_id pusty');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = null;
        $date_start = '';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserWinLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_start pusty, client_id null ');

        $user_id = '';
        $client_id = '';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserWinLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza user_id i client_id pusty');
    }

    /**
     * Pobraie leadów przegranych w podanmym przedziale czasowym
     * 
     * @param string $user_id       ID użytkownika
     * @param string $client_id     ID klienta
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    public function testGetUserLostLeadsByDate()
    {

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = '1';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserLostLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'nie zwraca tablicy');
        $this->assertEquals(count($return), 1, 'zwraca złą liczbę wyników w stosunku do zakresu dat');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = '';
        $date_start = '2015-03-01';
        $date_end = '';
        $return = $this->ClientLead->getUserLostLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_end  i client_id pusty ');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = null;
        $date_start = '';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserLostLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_start pusty i client_id null');

        $user_id = '';
        $client_id = '';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getUserLostLeadsByDate($user_id, $client_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza user_id i client_id pusty');
    }

    /**
     * Pobranie leadów utworzonych w wybranym przedziale czasowym
     * 
     * @param string $user_id       ID użytkownika
     * @param string $client_id     ID klienta 
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    public function testGetAllUserCreatedLeadsByDate()
    {

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getAllUserCreatedLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'nie zwraca tablicy');
        $this->assertEquals(count($return), 4, 'zwraca złą liczbę wyników w stosunku do zakresu dat');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '';
        $return = $this->ClientLead->getAllUserCreatedLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_end pusty,');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getAllUserCreatedLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_start pusty ');

        $user_id = '';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getAllUserCreatedLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza user_id pusty');
    }

    /**
     * Pobranie leadów wygranych w podanym przedziale czasowym dla wybrnego klienta
     * 
     * @param string $user_id       ID użytkownika
     * @param string $client_id     ID klienta 
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    public function testGetAllUserWinLeadsByDate()
    {

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getAllUserWinLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'nie zwraca tablicy');
        $this->assertEquals(count($return), 1, 'zwraca złą liczbę wyników w stosunku do zakresu dat');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '';
        $return = $this->ClientLead->getAllUserWinLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_end pusty, client_id pusty');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getAllUserWinLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_start pusty, client_id null ');

        $user_id = '';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getAllUserWinLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza user_id i client_id pusty');
    }

    /**
     * Pobraie leadów przegranych w podanmym przedziale czasowym
     * 
     * @param string $user_id       ID użytkownika
     * @param string $client_id     ID klienta
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    public function testGetAllUserLostLeadsByDate()
    {

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = '1';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getAllUserLostLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'nie zwraca tablicy');
        $this->assertEquals(count($return), 1, 'zwraca złą liczbę wyników w stosunku do zakresu dat');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '';
        $return = $this->ClientLead->getAllUserLostLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_end  i client_id pusty ');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getAllUserLostLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza date_start pusty i client_id null');

        $user_id = '';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->getAllUserLostLeadsByDate($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'przepuszcza user_id i client_id pusty');
    }

    public function testCountUserLead()
    {
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->countUserLead($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'poprawne dane');

        $return = $this->ClientLead->countUserLead(-1);
        $this->assertEquals($return, false, 'brak danych');
    }

    public function testCountUserLeadAmount()
    {
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->countUserLeadAmount($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), false, 'poprawne dane');

        $return = $this->ClientLead->countUserLeadAmount($user_id, $date_start, $date_end, 3);
        $this->assertEquals(is_array($return), false, 'poprawne dane');

        $return = $this->ClientLead->countUserLeadAmount(-1);
        $this->assertEquals($return, false, 'brak danych');
    }

    public function testAmountLeadStatus()
    {
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-08-31';
        $return = $this->ClientLead->amountLeadStatus($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'poprawne dane');

        $return = $this->ClientLead->amountLeadStatus('-1');
        $this->assertEquals($return, false, 'brak danych');
    }

    public function testPipeline()
    {
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->pipeline($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'poprawne dane');

        $return = $this->ClientLead->pipeline();
        $this->assertEquals($return, false, 'brak danych');
    }

    public function testPieCategory()
    {
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->pieCategory($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'poprawne dane');

        $return = $this->ClientLead->pieCategory();
        $this->assertEquals($return, false, 'brak danych');
    }
    public function testPieCustomerSales()
    {
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->pieCustomerSales($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'poprawne dane');

        $return = $this->ClientLead->pieCustomerSales();
        $this->assertEquals($return, false, 'brak danych');
    }
    public function testValueContracts()
    {
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->ClientLead->valueContracts($user_id, $date_start, $date_end);
        $this->assertEquals(is_array($return), true, 'poprawne dane');

        $return = $this->ClientLead->valueContracts();
        $this->assertEquals($return, false, 'brak danych');
    }

}
