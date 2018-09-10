<?php

/**
 * ClientProjectShedule Test Case
 *
 */
class ClientProjectSheduleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.client_project_shedule',
		'app.client_project',
		'app.client_lead',
		'app.client',
		'app.userUser',
//		'app.user_client',
		'app.lead_category',
		'app.lead_status',
		'app.currency',
		'app.client_contact',
		'app.client_contact_client_lead',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientProjectShedule = ClassRegistry::init('ClientProjectShedule');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientProjectShedule);

		parent::tearDown();
	}
        
        
        
        public function  testGetShedules(){
            
            $project_id= '';
            $return = $this->ClientProjectShedule->getShedules($project_id);
            $this->assertEquals($return,false,'pusty parametr');
            
            $project_id= null;
            $return = $this->ClientProjectShedule->getShedules($project_id);
            $this->assertEquals($return,false,'parametr null');
            
            
            $return = $this->ClientProjectShedule->getShedules();
            $this->assertEquals($return,false,'brak parametru');
            
            $project_id= '4';
            $return = $this->ClientProjectShedule->getShedules($project_id);
            $this->assertEquals(is_array($return),true,'poprawny parametr');
            
            $project_id= '7';
            $return = $this->ClientProjectShedule->getShedules($project_id);
            $this->assertEquals(is_array($return),true,'jest projekt nie ma shedule');
            $this->assertEquals(empty($return),true,'jest projekt nie ma shedule');
  
            
            $project_id= '444';
            $return = $this->ClientProjectShedule->getShedules($project_id);
            $this->assertEquals($return,false,'zapytanie o nie istniejacy projekt w bazie');
        }
        
        public function testParseTimeLine(){
            
            $project_id= '';
            $return = $this->ClientProjectShedule->parseTimeLine($project_id);
            $this->assertEquals($return,false,'pusty parametr');
            
            $project_id= null;
            $return = $this->ClientProjectShedule->parseTimeLine($project_id);
            $this->assertEquals($return,false,'parametr null');
            
            
            $return = $this->ClientProjectShedule->parseTimeLine();
            $this->assertEquals($return,false,'brak parametru');
            
            $project_id= '4';
            $return = $this->ClientProjectShedule->parseTimeLine($project_id);
            $this->assertEquals(is_array($return),true,'poprawny parametr');
            
            $project_id= '2';
            $return = $this->ClientProjectShedule->parseTimeLine($project_id);
            $this->assertEquals(is_array($return),true,'poprawny parametr');
  
        }
        
        
        public function testDeleteShedule(){
            
            
            $id = '';
            $return = $this->ClientProjectShedule->deleteShedule($id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $id = null;
            $return = $this->ClientProjectShedule->deleteShedule($id);
            $this->assertEquals($return,false,'parametr null');
            
            $return = $this->ClientProjectShedule->deleteShedule();
            $this->assertEquals($return,false,'brak parametru');
            
            $id = '3';
            $return = $this->ClientProjectShedule->deleteShedule($id);
            $this->assertEquals($return,true,'prawidlowy parametr');
            
        }
        
        public function testSaveShedule(){
            
            $shedule = '';
            $return = $this->ClientProjectShedule->saveShedule($shedule);
            $this->assertEquals($return,false,'pusty paramter');
            
            $shedule = null;
            $return = $this->ClientProjectShedule->saveShedule($shedule);
            $this->assertEquals($return,false,'parametr null');
            
            $return = $this->ClientProjectShedule->saveShedule();
            $this->assertEquals($return,false,'brak parametru');
            
            
            $shedule = array(
                'ClienProjectShedule' => array(
			'client_project_id' => '2',
			'type' => 'stage',
			'name' => 'Etap',
			'date' => '2015-03-12',
			'date_to' => '2015-03-18',
			'desc' => 'asdfasdfasas dsas df',
			'interval' => NULL,
			'payment_day' => NULL,
			'done' => 0,
			'created' => '2015-03-23 12:44:59',
			'modified' => '2015-03-25 11:30:02'
                )
            );
            $return = $this->ClientProjectShedule->saveShedule($shedule);
            $this->assertEquals(is_array($return),true,'brak parametru');
            
        }
                
}
