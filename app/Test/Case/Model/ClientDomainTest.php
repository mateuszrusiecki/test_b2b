<?php

/* ClientDomain Test cases generated on: 2015-04-01 14:06:26 : 1427889986 */
App::uses('ClientDomain', 'Model');

/**
 * ClientDomain Test Case
 *
 */
class ClientDomainTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.client_domain',
        'app.client',
        'app.project_file',
        'app.client_project',
        'app.client_project_domain',
        'app.client_lead',
        'app.profile',
        'app.project_file_category',
        'app.client_project_log',
        'app.userUser',
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->ClientDomain = ClassRegistry::init('ClientDomain');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientDomain);

        parent::tearDown();
    }

    /**
     * Pobranie domen przypisanych do danego klienta
     * 
     * @param int $client_id    ID klienta
     * 
     * @return mixed            array domeny
     *                          false w przypadku błędu
     */
    public function testGetClientDomains()
    {
//     getClientDomains($client_id = null)


        $client_id = '';
        $return = $this->ClientDomain->getClientDomains($client_id);
        $this->assertEquals($return, false, 'pusty parametr');

        $client_id = null;
        $return = $this->ClientDomain->getClientDomains($client_id);
        $this->assertEquals($return, false, 'null');


        $return = $this->ClientDomain->getClientDomains();
        $this->assertEquals($return, false, 'brak parametru');

        // prawidlowe dane 
        $client_id = '1';
        $return = $this->ClientDomain->getClientDomains($client_id);
        $this->assertEquals(is_array($return), true, 'prawidlowe dane');
    }

    /**
     * wyszukiwanie domeny klinta po nazwie
     * 
     * @param int $client_id    ID klienta
     * @param int $domain		domena
     * 
     * @return mixed            array domena
     *                          false w przypadku błędu
     */
    public function testGetClientDomainByName()
    {

        $client_id = '';
        $domain = '';
        $return = $this->ClientDomain->getClientDomainByName($client_id, $domain);
        $this->assertEquals(is_array($return), false, 'puste dane');

        $client_id = null;
        $domain = '';
        $return = $this->ClientDomain->getClientDomainByName($client_id, $domain);
        $this->assertEquals(is_array($return), false, 'null pusty');

        $client_id = '';
        $domain = null;
        $return = $this->ClientDomain->getClientDomainByName($client_id, $domain);
        $this->assertEquals(is_array($return), false, 'pusty null');

        $client_id = null;
        $domain = null;
        $return = $this->ClientDomain->getClientDomainByName($client_id, $domain);
        $this->assertEquals(is_array($return), false, 'null null');

        $domain = 'fff3f.pl';
        $return = $this->ClientDomain->getClientDomainByName($domain);
        $this->assertEquals(is_array($return), false, 'brak client_id');

        $client_id = '1';
        $return = $this->ClientDomain->getClientDomainByName($client_id);
        $this->assertEquals(is_array($return), false, 'brak domain');

        // prawidlowe dane 
        $client_id = '1';
        $domain = 'fff3f.pl';
        $return = $this->ClientDomain->getClientDomainByName($client_id, $domain);
        $this->assertEquals(is_array($return), true, 'prawidlowe dane');
    }

    /**
     *  funkcja zwracająca listę wszystkich domen klienta
     * 
     */
    public function testGetSeoList()
    {

        $client_id = '';
        $return = $this->ClientDomain->getSeoList($client_id);
        $this->assertEquals(is_array($return), false, 'pusty parametr');

        $client_id = null;
        $return = $this->ClientDomain->getSeoList($client_id);
        $this->assertEquals(is_array($return), false, 'parametr null');


        $return = $this->ClientDomain->getSeoList();
        $this->assertEquals(is_array($return), false, 'brak paramtru');

        // prawidlowe dane 
        $client_id = '1';
        $return = $this->ClientDomain->getSeoList($client_id);
        $this->assertEquals(is_array($return), true, 'prawidlowe dane');
    }

    public function testAddClientDomain()
    {
//     addClientDomain($data = array())
        $data = '';
        $return = $this->ClientDomain->addClientDomain($data);
        $this->assertEquals(is_array($return), false, 'pusty parametr');

        $data = array(
            'client_id' => '',
            'domain' => ''
        );
        $return = $this->ClientDomain->addClientDomain($data);
        $this->assertEquals(is_array($return), false, 'pusta tablica');

        $data = null;
        $return = $this->ClientDomain->addClientDomain($data);
        $this->assertEquals(is_array($return), false, 'parametr null');

        $data = array(
            'ClientDomain' => array(
                'client_id' => '1',
                'domain' => 'www.domenajakastam.pl'
            )
        );
        $return = $this->ClientDomain->addClientDomain($data);
        $this->assertEquals(is_array($return), true, 'prawidlowe dane');
    }

    /**
     * Usuwanie domeny
     * 
     * @param int $id   ID domeny
     * @return boolean  true po pomyślnym usunięciu
     *                  false w przypadku błędu
     */
    public function testDeleteClientDomain()
    {
//     deleteClientDomain($id = null)
        $id = '';
        $return = $this->ClientDomain->deleteClientDomain($id);
        $this->assertEquals($return, false, 'pusty parametr');

        $id = null;
        $return = $this->ClientDomain->deleteClientDomain($id);
        $this->assertEquals($return, false, 'parametr null');


        $return = $this->ClientDomain->deleteClientDomain();
        $this->assertEquals($return, false, 'brak pramateru');


        $id = '5';
        $return = $this->ClientDomain->deleteClientDomain($id);
        $this->assertEquals($return, true, 'prawidlowe dane');
    }

    public function testClient2site()
    {
        $return = $this->ClientDomain->client2site(48);
        $this->assertEquals($return, 4, 'poprawne dane');

        $return = $this->ClientDomain->client2site(-1);
        $this->assertEquals($return, false, 'niepoprawne id');

        $return = $this->ClientDomain->client2site(1);
        $this->assertEquals($return, false, 'domena której nie ma systemie stat4seo.pl');
    }

    public function testBindFile()
    {
        $this->ClientDomain->bindFile();
        $return = $this->ClientDomain->find('first');
        $this->assertEquals(isset($return['ProjectFile']), true, 'Poprawnie zbindowało');
    }

    public function testBindProject()
    {
        $this->ClientDomain->bindProject();
        $return = $this->ClientDomain->find('first');
        $this->assertEquals(isset($return['ClientProject']), true, 'Poprawnie zbindowało');
    }

    public function testParseFile()
    {
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $file_name = 'tet.jpg';
        $project_id = 1;
        $client_domain_id = null;
        $return = $this->ClientDomain->parseFile($user_id, $file_name, $project_id, $client_domain_id);
        $this->assertEquals($return['success'], true, 'Poprawnie dane');
        $this->assertEquals(is_array($return['data']), true, 'Poprawnie dane');

        $user_id = null;
        $file_name = 'tet.jpg';
        $project_id = 1;
        $client_domain_id = null;
        $return = $this->ClientDomain->parseFile($user_id, $file_name, $project_id, $client_domain_id);
        $this->assertEquals($return['success'], false, 'Brak user id');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $file_name = null;
        $project_id = 1;
        $client_domain_id = null;
        $return = $this->ClientDomain->parseFile($user_id, $file_name, $project_id, $client_domain_id);
        $this->assertEquals($return['success'], false, 'Brak nazwy pliku');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $file_name = 'tet.jpg';
        $project_id = null;
        $client_domain_id = null;
        $return = $this->ClientDomain->parseFile($user_id, $file_name, $project_id, $client_domain_id);
        $this->assertEquals((bool) $return['success'], true, 'Brak project id');
        $this->assertEquals(is_array($return['data']), true, 'Brak project id');
    }

    public function testListDomainsByProject()
    {
        $project_id = 1;
        $return = $this->ClientDomain->listDomainsByProject($project_id);
        $this->assertEquals(is_array($return), true, 'Poprawnie dane');
        
        $project_id = 6346586345;
        $return = $this->ClientDomain->listDomainsByProject($project_id);
        $this->assertEquals($return, false, 'Złe id');
    }

}
