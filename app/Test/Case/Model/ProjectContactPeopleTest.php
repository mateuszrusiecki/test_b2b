<?php

/**
 * ProjectContactPeople Test Case
 *
 */
class ProjectContactPeopleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.project_contact_people',
		'app.client_project',
		'app.client_lead',
		'app.client',
		'app.userUser',
//		'app.user_client',
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
	public function setUp() {
		parent::setUp();
		$this->ProjectContactPeople = ClassRegistry::init('ProjectContactPeople');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProjectContactPeople);

		parent::tearDown();
	}

        
        
        
        public function testGetProjectClientContacts(){
                $client_project_id = '';
                $return = $this->ProjectContactPeople->getProjectClientContacts($client_project_id);
                $this->assertEquals($return,false,'pusty parametr');
                
                $client_project_id = null;
                $return = $this->ProjectContactPeople->getProjectClientContacts($client_project_id);
                $this->assertEquals($return,false,'pusty parametr');
                
                $client_project_id = '29';
                $return = $this->ProjectContactPeople->getProjectClientContacts($client_project_id);
//                debug($return);
                $this->assertEquals(is_array($return),true,'prawidlowy paramter');
                
                $return = $this->ProjectContactPeople->getProjectClientContacts();
                $this->assertEquals($return,false,'brak parametru');
        }
        
        public function testDeleteProjectClientContact(){
               
                $id = '';
                $return = $this->ProjectContactPeople->deleteProjectClientContact($id);
                $this->assertEquals($return,false,'pusty parametr');
                
                $client_project_id = null;
                $return = $this->ProjectContactPeople->deleteProjectClientContact($id);
                $this->assertEquals($return,false,'pusty parametr');
                
                $id = '1';
                $return = $this->ProjectContactPeople->deleteProjectClientContact($id);
                $this->assertEquals($return,true,'prawidlowy paramter');
            
                $return = $this->ProjectContactPeople->deleteProjectClientContact();
                $this->assertEquals($return,false,'brak paramteru');
        }
        
        
}
