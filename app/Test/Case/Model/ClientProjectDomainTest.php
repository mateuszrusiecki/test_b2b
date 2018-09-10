<?php
/* ClientDomain Test cases generated on: 2015-04-01 14:06:26 : 1427889986*/
App::uses('ClientProjectDomain', 'Model');

/**
 * ClientProjectDomain Test Case
 *
 */
class ClientProjectDomainTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
            'app.client_domain', 
            'app.client_project_domain', 
            'app.client', 
            'app.userUser',
//            'app.user_client',
            'app.project'
            );

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->ClientProjectDomain = ClassRegistry::init('ClientProjectDomain');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientProjectDomain);

		parent::tearDown();
	}

  
// function getProjectDomains($project_id = null)       
//    public function saveProjectDomain($project_id = null,$client_domain_id = null ){    
//        
//      public function deleteProjectDomain($project_id = null,$client_domain_id = null )   
        
    public function testGetProjectDomains(){
        
        $project_id= '';
        $return = $this->ClientProjectDomain->getProjectDomains($project_id);
        $this->assertEquals($return, false,'pusty parametr');
        
        $project_id= null;
        $return = $this->ClientProjectDomain->getProjectDomains($project_id);
        $this->assertEquals($return, false,'parametr null');
        
        $return = $this->ClientProjectDomain->getProjectDomains();
        $this->assertEquals($return, false, 'brak parametru');
        
        $project_id= '12';
        $return = $this->ClientProjectDomain->getProjectDomains($project_id);
        $this->assertEquals(is_array($return), true,'pusty parametr');
    }    

    public function testSaveProjectDomain(){
      
        $project_id = '';
        $client_domain_id = '';
        $return = $this->ClientProjectDomain->saveProjectDomain($project_id,$client_domain_id);
        $this->assertEquals($return, false,'puste parametry');
        
        $project_id = '';
        $client_domain_id = null;
        $return = $this->ClientProjectDomain->saveProjectDomain($project_id,$client_domain_id);
        $this->assertEquals($return, false,'pusty null');
        
        $project_id = null;
        $client_domain_id = '';
        $return = $this->ClientProjectDomain->saveProjectDomain($project_id,$client_domain_id);
        $this->assertEquals($return, false,'null pusty');
        
        $project_id = null;
        $client_domain_id = null;
        $return = $this->ClientProjectDomain->saveProjectDomain($project_id,$client_domain_id);
        $this->assertEquals($return, false,'null null');
			
        $project_id = '12';
        $client_domain_id = '50';
        $return = $this->ClientProjectDomain->saveProjectDomain($project_id,$client_domain_id);
        $this->assertEquals(is_array($return), true,'prawidłowe dane');
        
        $project_id = '12';
        $client_domain_id = '53';
        $return = $this->ClientProjectDomain->saveProjectDomain($project_id,$client_domain_id);
        $this->assertEquals(is_array($return), true,'prawidłowe dane v2');
    }
        
 
    public function testDeleteProjectDomain(){
    
    $project_id = '';
    $client_domain_id = '';
    $return = $this->ClientProjectDomain->deleteProjectDomain($project_id,$client_domain_id);   
    $this->assertEquals($return, false,'puste paremetry');
    
    $project_id = null;
    $client_domain_id = '';
    $return = $this->ClientProjectDomain->deleteProjectDomain($project_id,$client_domain_id);   
    $this->assertEquals($return, false,'null pusty');
    
    $project_id = '';
    $client_domain_id = null;
    $return = $this->ClientProjectDomain->deleteProjectDomain($project_id,$client_domain_id);   
    $this->assertEquals($return, false,'pusty null');
    
    $project_id = null;
    $client_domain_id = null;
    $return = $this->ClientProjectDomain->deleteProjectDomain($project_id,$client_domain_id);   
    $this->assertEquals($return, false,'null null');
    
    $project_id = '';
    $client_domain_id = '';
    $return = $this->ClientProjectDomain->deleteProjectDomain($project_id,$client_domain_id);   
    $this->assertEquals($return, false,'puste paremetry');
    
    $project_id = '12';
    $client_domain_id = '50';
    $return = $this->ClientProjectDomain->deleteProjectDomain($project_id,$client_domain_id);   
    $this->assertEquals($return, true,'prawidlowe usuniecie');
    
    }
    
    
}
