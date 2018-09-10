<?php

/* ClientProject Test cases generated on: 2015-03-06 09:04:24 : 1425629064 */
App::uses('ClientProject', 'Model');

/**
 * ClientProject Test Case
 *
 */
class ClientProjectTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.project',
        'app.client_project',
        'app.client_project_budget',
        'app.client_project_user',
        'app.client_project_domain',
        'app.client_domain',
        'app.client_lead',
        'app.client',
        'app.userUser',
//        'app.user_client',
        'app.lead_category',
        'app.lead_status',
        'app.currency',
        'app.client_contact',
        'app.client_contact_client_lead',
        'app.project_contact_people',
        'app.client_project_shedule'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->ClientProject = ClassRegistry::init('ClientProject');
    }

    /**
     * tearDown method
     *
     * @return void
     */
//    public function tearDown()
//    {
//        unset($this->ClientProject);
//
//        parent::tearDown();
//    }

    /**
     * testListProject method
     *
     * @return void
     */
    public function testListProject()
    {

        $client_id = 1;
        $return = $this->ClientProject->listProject($client_id);
        $this->assertEquals(is_array($return), true, 'Czy jest to tablica?');

        $return = $this->ClientProject->listProject();
        $this->assertEquals($return, false, 'brak parametru funkcji');

        $client_id = -1;
        $return = $this->ClientProject->listProject($client_id);
        $this->assertEquals($return, false, 'niepoprawny parametr funkcji');
    }

    /**
     * testGetProject method
     *
     * @return void
     */
    public function testGetProject()
    {

        $project_id = 1;
        $return = $this->ClientProject->getProject($project_id);
        $this->assertEquals(is_array($return), true, 'Czy jest to tablica?');

        $return = $this->ClientProject->getProject();
        $this->assertEquals($return, false, 'brak parametru funkcji');

        $project_id = -1;
        $return = $this->ClientProject->getProject($project_id);
        $this->assertEquals($return, false, 'niepoprawny parametr funkcji');
    }

    public function testSaveAddRequestData()
    {


        $data = '';
        $lead_id = '';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 1, 'Puszcza puste dane wesciowe');


        $data = null;
        $lead_id = '';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 1, 'Puszcza pusty lead i null tablice');


        $data = '';
        $lead_id = null;
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 1, 'Puszcza pusta tablice i null lead_id');


        $data = null;
        $lead_id = null;
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 1, 'Puszcza nulle');

        $data = '';
        $lead_id = '1';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 1, 'Puszcza pusta tablice wypelniony lead id');

        $data = '';
        $lead_id = '3';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 1, 'powinien zwrocic blad bo nie ma leadu 3');

        // prawidlowe dane 
        $data = array(
            'ClientProject' => array(
                'name' => 'analiza_projektX',
                'alias' => 'analiza_projektX',
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
                'project_author' => 'Admin',
                'created' => '2015-04-14',
                'seo_domain' => array(
                    '1' => '1',
                    '3' => '1',
                    '48' => '0',
                    '49' => '0',
                    '5' => '0',
                    '50' => '0',
                    '51' => '0'
                ),
                'client_lead_id' => '22',
                'people' => array(
                    '0' => '0',
                    '1' => '25',
                    '2' => '0',
                    '3' => '0',
                    '4' => '5',
                    '5' => '0',
                    '6' => '0',
                    '7' => '0'
                ),
                'client_id' => '1',
                'files' => '{"1":[],"2":[],"3":[],"4":[],"5":[],"6":[],"7":[]}'
            ),
            'ClientDomain' => array(
                'new_seo_domain' => ''
            ),
            'ClientLead' => array(
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2'
            )
        );
        $lead_id = '1';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 0, 'powinno poprawnie przejść całą procedurę');



        //  numer nieistniejącego leadu 
        $data = array(
            'ClientProject' => array(
                'name' => 'analiza_projektX',
                'alias' => 'analiza_projektX',
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
                'project_author' => 'Admin',
                'created' => '2015-04-14',
                'seo_domain' => array(
                    '1' => '1',
                    '3' => '1',
                    '48' => '0',
                    '49' => '0',
                    '5' => '0',
                    '50' => '0',
                    '51' => '0'
                ),
                'client_lead_id' => '22',
                'people' => array(
                    '0' => '0',
                    '1' => '25',
                    '2' => '0',
                    '3' => '0',
                    '4' => '5',
                    '5' => '0',
                    '6' => '0',
                    '7' => '0'
                ),
                'client_id' => '1',
                'files' => '{"1":[],"2":[],"3":[],"4":[],"5":[],"6":[],"7":[]}'
            ),
            'ClientDomain' => array(
                'new_seo_domain' => ''
            ),
            'ClientLead' => array(
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2'
            )
        );
        $lead_id = '2';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 1, 'nie zwraca błędu, że taki lead nie isnieje');

        // brak plików 
        $data = array(
            'ClientProject' => array(
                'name' => 'analiza_projektX',
                'alias' => 'analiza_projektX',
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
                'project_author' => 'Admin',
                'created' => '2015-04-14',
                'seo_domain' => array(
                    '1' => '1',
                    '3' => '1',
                    '48' => '0',
                    '49' => '0',
                    '5' => '0',
                    '50' => '0',
                    '51' => '0'
                ),
                'client_lead_id' => '22',
                'people' => array(
                    '0' => '0',
                    '1' => '25',
                    '2' => '0',
                    '3' => '0',
                    '4' => '5',
                    '5' => '0',
                    '6' => '0',
                    '7' => '0'
                ),
                'client_id' => '1',
                'files' => ''
            ),
            'ClientDomain' => array(
                'new_seo_domain' => ''
            ),
            'ClientLead' => array(
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2'
            )
        );
        $lead_id = '1';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 0, 'powinien zwrocic success bo nie ma plików');

        // prawidlowe dane z nowym client project  wymuszenie create()
        $data = array(
            'ClientProject' => array(
                'name' => 'analiza_projektX',
                'alias' => 'analiza_projektX',
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
                'project_author' => 'Admin',
                'created' => '2015-04-14',
                'seo_domain' => array(
                    '1' => '1',
                    '3' => '1',
                    '48' => '0',
                    '49' => '0',
                    '5' => '0',
                    '50' => '0',
                    '51' => '0'
                ),
                'client_lead_id' => '22',
                'people' => array(
                    '0' => '0',
                    '1' => '25',
                    '2' => '0',
                    '3' => '0',
                    '4' => '5',
                    '5' => '0',
                    '6' => '0',
                    '7' => '0'
                ),
                'client_id' => '1',
                'files' => '{"1":[],"2":[],"3":[],"4":[],"5":[],"6":[],"7":[]}'
            ),
            'ClientDomain' => array(
                'new_seo_domain' => ''
            ),
            'ClientLead' => array(
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2'
            )
        );
        $lead_id = '3';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 0, 'powinien poprawnie zapisac nowy wiersz client project');

        // brak pojedynczych danych, blad zapisu danych 
        $data = array(
            'ClientProject' => array(
                'name' => '',
                'alias' => 'analiza_projektX',
                'user_id' => '',
                'project_author' => 'Admin',
                'created' => '2015-04-14',
                'seo_domain' => array(
                    '1' => '1',
                    '3' => '1',
                    '48' => '0',
                    '49' => '0',
                    '5' => '0',
                    '50' => '0',
                    '51' => '0'
                ),
                'client_lead_id' => '22',
                'people' => array(
                    '0' => '0',
                    '1' => '25',
                    '2' => '0',
                    '3' => '0',
                    '4' => '5',
                    '5' => '0',
                    '6' => '0',
                    '7' => '0'
                ),
                'client_id' => '1',
                'files' => '{"1":[],"2":[{"filename":"plik.txt"}],"3":[],"4":[],"5":[],"6":[],"7":[]}'
            ),
            'ClientDomain' => array(
                'new_seo_domain' => ''
            ),
            'ClientLead' => array(
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2'
            )
        );
        $lead_id = '3';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 1, 'powinien zwrocic blad bo user_id pusty');



        $data = array(
            'ClientProject' => array(
                'name' => '',
                'alias' => 'analiza_projektX',
                'user_id' => '',
                'project_author' => null,
                'created' => '2015-04-14',
                'seo_domain' => array(
                    '1' => '1',
                    '3' => '1',
                    '48' => '0',
                    '49' => '0',
                    '5' => '0',
                    '50' => '0',
                    '51' => '0'
                ),
                'client_lead_id' => '22',
                'people' => array(
                    '0' => '0',
                    '1' => '25',
                    '2' => '0',
                    '3' => '0',
                    '4' => '5',
                    '5' => '0',
                    '6' => '0',
                    '7' => '0'
                ),
                'client_id' => '1',
                'files' => '{"1":[],"2":[{"filename":"plik.txt"}],"3":[],"4":[],"5":[],"6":[],"7":[]}'
            ),
            'ClientDomain' => array(
                'new_seo_domain' => ''
            ),
            'ClientLead' => array(
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2'
            )
        );
        $lead_id = '3';
        $return = $this->ClientProject->saveAddRequestData($data, $lead_id);
        $this->assertEquals($return['error'], 1, 'powinien zwrocic blad bo bo project author null');
    }

    public function testSaveProject()
    {

        $data = array(
            'id' => '10',
            'active' => 0,
            'close' => 0,
            'name' => 'analiza_projektX',
            'alias' => 'analiza_projektX',
            'client_id' => '1',
            'client_lead_id' => '22',
            'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
            'project_author' => 'Admin',
            'status' => '0',
            'budget' => NULL,
            'start_project' => '2015-03-02',
            'end_project' => '2015-03-28',
            'auto_project' => 0,
            'interval_project' => NULL,
            'color' => '#3865a8',
            'notes' => '',
            'email' => NULL,
            'shedule_PDF' => NULL,
            'agreement_id' => NULL,
            'finish_confirmation' => NULL,
            'share' => NULL,
            'modified' => '2015-03-30 11:21:27',
            'created' => '2015-03-30 00:00:00'
        );
        $return = $this->ClientProject->saveProject($data);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');

        $data = array(
            'active' => 0,
            'close' => 0,
            'name' => 'analiza_projektX',
            'alias' => 'analiza_projektX',
            'client_id' => '1',
            'client_lead_id' => '22',
            'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
            'project_author' => 'Admin',
            'status' => '0',
            'budget' => NULL,
            'start_project' => '2015-03-02',
            'end_project' => '2015-03-28',
            'auto_project' => 0,
            'interval_project' => NULL,
            'color' => '#3865a8',
            'notes' => '',
            'email' => NULL,
            'shedule_PDF' => NULL,
            'agreement_id' => NULL,
            'finish_confirmation' => NULL,
            'share' => NULL,
            'modified' => '2015-03-30 11:21:27',
            'created' => '2015-03-30 00:00:00'
        );
        $return = $this->ClientProject->saveProject($data);
        $this->assertEquals(is_array($return), true, 'bez id');


        $data = array();
        $return = $this->ClientProject->saveProject($data);
        $this->assertEquals(is_array($return), false, 'pusta tablica');
    }

    public function testSaveContactRows()
    {


        $project_id = '';
        $data = '';
        $return = $this->ClientProject->saveContactRows($project_id, $data);
        $this->assertEquals(is_array($return), false, 'pusta tablica');

        $project_id = '';
        $data = null;
        $return = $this->ClientProject->saveContactRows($project_id, $data);
        $this->assertEquals(is_array($return), false, 'pusta tablica');

        $project_id = null;
        $data = null;
        $return = $this->ClientProject->saveContactRows($project_id, $data);
        $this->assertEquals(is_array($return), false, 'pusta tablica');


        // poprawne dane 
        $project_id = '5';
        $data = array(
            '1' => '25',
            '3' => '24',
            '5' => '5',
            '9' => '16'
        );
        $return = $this->ClientProject->saveContactRows($project_id, $data);
        $this->assertEquals($return, true, 'błąd przy prawidłowych danych');


        // poprawne dane 
        $project_id = '5';
        $data = array(
            '1' => '25',
            '3' => '24',
            '5' => '5',
            '9' => null
        );
        $return = $this->ClientProject->saveContactRows($project_id, $data);
        $this->assertEquals($return, true, 'błąd przy null nie wyczyscilo empty rows');
    }

    public function testGetAliasList()
    {

        $return = $this->ClientProject->getAliasList();
        $this->assertEquals(is_array($return), true, 'nie zwraca danych');
    }

    public function testTimeline()
    {

        $id = '';
        $return = $this->ClientProject->timeline($id);
        $this->assertEquals($return, false, 'pusty parametr');

        $id = null;
        $return = $this->ClientProject->timeline($id);
        $this->assertEquals($return, false, 'null parametr');


        $return = $this->ClientProject->timeline();
        $this->assertEquals($return, false, 'brak parametru');

        $id = '4';
        $return = $this->ClientProject->timeline($id);
        $this->assertEquals(is_array($return), true, 'nie zwraca danych');
    }

    public function testParseTime()
    {
        $date = '';
        $return = $this->ClientProject->parseTime($date);
        $this->assertEquals($return, false, 'pusty paramter');

        $date = null;
        $return = $this->ClientProject->parseTime($date);
        $this->assertEquals($return, false, 'null parametr');

        $return = $this->ClientProject->parseTime();
        $this->assertEquals($return, false, 'brak parametru');

        $date = '2015-11-03';
        $return = $this->ClientProject->parseTime($date);
        $this->assertEquals(is_array($return), true, 'nie zwraca przeparsowanej daty');

        $date = '04-11-2015';
        $return = $this->ClientProject->parseTime($date);
        $this->assertEquals(is_array($return), true, 'nie zwraca przeparsowanej daty');
    }

    public function testGetDataTable()
    {

        $return = $this->ClientProject->getDataTable();
        $this->assertEquals(is_array($return), true, 'nie zwraca danych');
    }

    public function testListAllProject()
    {
        $return = $this->ClientProject->listAllProject();
        $this->assertEquals(is_array($return), true, 'nie zwraca listy projetkow');
    }

    public function testGetProjectByLeadId()
    {
        $lead_id = '';
        $return = $this->ClientProject->getProjectByLeadId($lead_id);
        $this->assertEquals($return, false, 'pusty parametr');

        $lead_id = null;
        $return = $this->ClientProject->getProjectByLeadId($lead_id);
        $this->assertEquals($return, false, 'parametr null');

        $lead_id = '13';
        $return = $this->ClientProject->getProjectByLeadId($lead_id);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');
    }

    public function testCheckUserAuthorMagnager()
    {

        $project_id = '';
        $user_id = '';
        $return = $this->ClientProject->checkUserAuthorManager($project_id, $user_id);
        $this->assertEquals($return, false, 'puste dane');

        $project_id = null;
        $user_id = null;
        $return = $this->ClientProject->checkUserAuthorManager($project_id, $user_id);
        $this->assertEquals($return, false, 'null');

        $project_id = '1';
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';  // kierownik projektu 
        $return = $this->ClientProject->checkUserAuthorManager($project_id, $user_id);
        $this->assertEquals($return, true, 'nie wykrywa kierownika projektu');

        $project_id = '5';
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';  //  autor projektu
        $return = $this->ClientProject->checkUserAuthorManager($project_id, $user_id);
        $this->assertEquals($return, true, 'nie wykrywa autora projektu');

        $project_id = '3';
        $user_id = '552caf77-b0a0-4310-b757-0b3077ecc6b3';  // handlowiec projektu 
        $return = $this->ClientProject->checkUserAuthorManager($project_id, $user_id);
        $this->assertEquals($return, true, 'nie wykrywa handlowca projektu');
    }

    public function testGetUserProjectTable()
    {

        $user_id = '';
        $return = $this->ClientProject->getUserProjectTable($user_id);
        $this->assertEquals($return, false, 'puste parametry');

        $user_id = null;
        $return = $this->ClientProject->getUserProjectTable($user_id);
        $this->assertEquals($return, false, 'null');

        $user_id = '52261d2a-d428-4b62-8183-71d6bca51319';
        $return = $this->ClientProject->getUserProjectTable($user_id);
        $this->assertEquals(is_array($return), true, 'nie zwraca projektów usera ');

        $user_id = '5aaa1d2a-d428-4b62-8183-71d6bca51319';
        $return = $this->ClientProject->getUserProjectTable($user_id);
        $this->assertEquals($return, false, 'nie powinien user w tabeli znalezc');
    }

    public function testParse2TimelineList()
    {
        $allProjectsQuery = $this->ClientProject->getClientProjectTable();
        $return = $this->ClientProject->parse2TimelineList($allProjectsQuery);
        $this->assertEquals(!empty($return), false, 'Brak id');
    }

    public function testGetAllProjectTable()
    {
        $return = $this->ClientProject->getAllProjectTable();
        $this->assertEquals(is_array($return), true, 'Poprawne dane');
    }

    public function testGetManagerProjectTableBySection()
    {
        $_SESSION['Auth']['User']['id'] = '3a38ee92-6934-102d-9f80-579a023712b2';
        $return = $this->ClientProject->getManagerProjectTableBySection(4);
        $this->assertEquals(is_array($return), true, 'Poprawne dane');
    }

    public function testGetProjectsBySection()
    {
        $section_id = 4;
        $return = $this->ClientProject->getProjectsBySection($section_id);
        $this->assertEquals($return, false, 'Poprawne dane');
    }

}
