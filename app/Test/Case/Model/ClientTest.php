<?php

/* Client Test cases generated on: 2015-02-18 13:40:08 : 1424263208 */
App::uses('Client', 'Model');

/**
 * Client Test Case
 *
 */
class ClientTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.client',
        'app.UserUser',
        'app.user_groups_user',
        'app.user_group',
        'app.Profile',
        'app.Modification',
        'app.Section',
        'app.user_section',
        'app.user_permission',
        'app.user_requesters_permission',
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Client = ClassRegistry::init('Client');
        $this->User = ClassRegistry::init('User.User');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Client);

        parent::tearDown();
    }

    /**
     * testGetClient method
     *
     * @return void
     */
    public function testGetClient()
    {
        $user_id = '55680f13-8020-4ded-8783-2a45904cf98e';
        $return = $this->Client->getClients($user_id);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');

        $user_id = '66666666-6666-6666-6666-579a023712b2';
        $return = $this->Client->getClients($user_id);
        $this->assertEquals($return, false, 'nieprawidlowy użytkownik');

        $return = $this->Client->getClients();
        $this->assertEquals($return, false, 'brak parametrów funkcji');
    }

    public function testGetAllClients()
    {
        $return = $this->Client->getAllClients();
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');
    }

    /**
     * testGetClientDetail method
     *
     * @return void
     */
    public function testGetClientDetail()
    {
        $client_id = '1';
        $return = $this->Client->getClientDetails($client_id);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');

        $client_id = '6654';
        $return = $this->Client->getClientDetails($client_id);
        $this->assertEquals($return, false, 'nieprawidlowy użytkownik');

        $client_id = null;
        $return = $this->Client->getClientDetails($client_id);
        $this->assertEquals($return, false, 'nieprawidlowy użytkownik');

        unset($client_id);
        $return = $this->Client->getClientDetails();
        $this->assertEquals($return, false, 'brak parametrów funkcji');
    }

    /**
     * testAddClient method
     *
     * @return void
     */
    public function testAddClient()
    {
        $client['Client'] = array(
            'id' => '1',
            'name' => 'Fabryka e-biznesu',
            'street' => 'Słowackiego 24',
            'zipcode' => '35-959',
            'city' => 'Rzeszów',
            'country' => 'Polska',
            'phone' => '17 123 456 789',
            'site' => 'feb.net.pl',
            'email' => 'feb@feb.net.pl',
            'user_id' => NULL,
            'comarch_id' => NULL
        );
        $return = $this->Client->addClient($client);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');


        $client = array();
        $return = $this->Client->addClient($client);
        $this->assertEquals($return, false, 'brak danych');

        $client['Client'] = array(
            'id' => '1',
            'street' => 'Słowackiego 24',
            'zipcode' => '35-959',
            'city' => 'Rzeszów',
            'country' => 'Polska',
            'phone' => '17 123 456 789',
            'site' => 'feb.net.pl',
            'email' => 'feb@feb.net.pl',
            'user_id' => NULL,
            'comarch_id' => NULL
        );
        $return = $this->Client->addClient($client);
        $this->assertEquals(is_array($return), false, 'brak nazwy klienta');
    }

    public function testEditClient()
    {
        $client['Client']['id'] = 1;
        $client['Client']['email'] = 'd.czyz+' . Rand() . '@febdev.pl';
        $return = $this->Client->editClient($client);
        $this->assertEquals(is_array($return), true, 'Poprawne dane');
        $this->assertEquals(is_array($return) && !empty($return['Client']['id']), true, 'Poprawne dane');

        $client['Client']['id'] = -1;
        $client['Client']['email'] = 'd.czyz+' . Rand() . '@febdev.pl';
        $return = $this->Client->editClient($client);
        $this->assertEquals($return, false, 'Złe dane');

        $return = $this->Client->editClient();
        $this->assertEquals($return, false, 'Złe dane');
    }

    /**
     * Szczegóły przeniesienie klienta do archiwum
     * 
     * @param int $client_id    ID Klienta
     * @return bool             true w przypadku sukcesu
     *                          false w przypadku błędu
     */
    public function testArchiveClient()
    {

        $client_id = '';
        $return = $this->Client->archiveClient($client_id);
        $this->assertEquals($return, false, 'puszcza pusty parametr');


        $client_id = null;
        $return = $this->Client->archiveClient($client_id);
        $this->assertEquals($return, false, 'puszcza null');


        $client_id = '2';
        $return = $this->Client->archiveClient($client_id);
        $this->assertEquals($return, true, 'nie wykonuje zadania przy string parametrze');

        $client_id = 2;
        $return = $this->Client->archiveClient($client_id);
        $this->assertEquals($return, true, 'nie wykonuje zadania przy int parametrze');
    }

    public function testGetClientForUser()
    {
        $user_id = '';
        $return = $this->Client->getClientForUser($user_id);
        $this->assertEquals($return, false, 'pusty paramter');

        $user_id = null;
        $return = $this->Client->getClientForUser($user_id);
        $this->assertEquals($return, false, 'pusty paramter');

        $user_id = '55680f13-8020-4ded-8783-2a45904cf98e';
        $return = $this->Client->getClientForUser($user_id);
        $this->assertEquals(is_array($return), true, 'funkcja nie zwraca danych');
    }

    public function testCountUserClient()
    {
        $user_id = '';
        $return = $this->Client->countUserClient($user_id);
        $this->assertEquals($return, false, 'pusty paramter');

        $user_id = null;
        $return = $this->Client->countUserClient($user_id);
        $this->assertEquals($return, false, 'pusty paramter');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $date_start = '2015-03-01';
        $date_end = '2015-03-31';
        $return = $this->Client->countUserClient($user_id, $date_start, $date_end);
        $this->assertEquals(is_integer($return), true, 'pusty paramter');
    }

}
