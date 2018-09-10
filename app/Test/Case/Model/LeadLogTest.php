<?php
/* LeadLog Test cases generated on: 2015-03-05 15:08:07 : 1425564487*/
App::uses('LeadLog', 'Model');

/**
 * LeadLog Test Case
 *
 */
class LeadLogTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
            'app.lead_log',
            'app.client_lead',
            'app.userUser',
            'app.Profile',
            );

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->LeadLog = ClassRegistry::init('LeadLog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LeadLog);

		parent::tearDown();
	}
        
        
        
        
        
        
//        public function saveLog($log_type=null,$data = array()){
//            ublic function getLogList($client_lead_id = null)
//                    public function getLog($id = null)
        
        
        public function testSaveLog(){
            $log_type  ='';
            $data      = '';
            $return    = $this->LeadLog->saveLog($log_type,$data);
            $this->assertEquals($return,false,'puste parametry');
            
            $log_type  ='';
            $data      = null;
            $return    = $this->LeadLog->saveLog($log_type,$data);
            $this->assertEquals($return,false,'pusty null');
            
            $log_type  = null;
            $data      = '';
            $return    = $this->LeadLog->saveLog($log_type,$data);
            $this->assertEquals($return,false,'null pusty');
            
            $log_type  ='2';
            $data      = '';
            $return    = $this->LeadLog->saveLog($log_type,$data);
            $this->assertEquals($return,false,'data pust');
            
            
            $log_type  ='2';
            $data      = 'asdasdasdasdasdasdasd';
            $return    = $this->LeadLog->saveLog($log_type,$data);
            $this->assertEquals($return,false,'$data typu string');
            
            $log_type  ='2';
            $data      = array(
                'LeadLog' => array(
                        'client_lead_id' => '3',
			'type_log_id' => '2',
			'name' => 'dataTables.bootstrap.css',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-03-05 15:55:05',
			'modified' => '2015-03-05 15:55:05'         
                )
            );
            $return    = $this->LeadLog->saveLog($log_type,$data);
            $this->assertEquals(is_array($return),true,'pawidlowe dane');
            
        }
        
        public function testGetLogList(){
            
            $client_lead_id = '';
            $return = $this->LeadLog->getLogList($client_lead_id);
            $this->assertEquals($return,false,'pusty parametr');
            
            $client_lead_id = null;
            $return = $this->LeadLog->getLogList($client_lead_id);
            $this->assertEquals($return,false,'parametru null');
            
            $return = $this->LeadLog->getLogList();
            $this->assertEquals($return,false,'brak parametru');
            
            $client_lead_id = '3';
            $return = $this->LeadLog->getLogList($client_lead_id);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
            
        }
        
        public function testGetLog(){
            
            $id = '';
            $return = $this->LeadLog->getLog($id);
            $this->assertEquals($return,false,'pusty parametr');
            
            $id = null;
            $return = $this->LeadLog->getLog($id);
            $this->assertEquals($return,false,'parametru null');
            
            $return = $this->LeadLog->getLog();
            $this->assertEquals($return,false,'brak parametru');
            
            $id = '1';
            $return = $this->LeadLog->getLog($id);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
        }
        
        public function testSaveFileLog(){
//            typy logów:
//            $this->log_type = array(
//                '1'=>__d('public','Email'),
//                '2'=>__d('public','Nowy plik'),
//                '3'=>__d('public','Usunięcie pliku'),
//                '4'=>__d('public','Nowa wersja pliku'),
//                '5'=>__d('public','Data wydarzenia'),
//                '6'=>__d('public','Wystąpienie wydarzenia'),
//                '7'=>__d('public','Edycja leadu'),
//            );
            $return = $this->LeadLog->saveFileLog();
            $this->assertEquals($return,false,'brak danych');
            
            $log_type = null;
            $data = array();
            $return = $this->LeadLog->saveFileLog($log_type,$data);
            $this->assertEquals($return,false,'puste parametry');
            
            
            $log_type = 4;
            $data['LeadFile']['client_lead_id'] = 7;
            $data['LeadFile']['file']['name'] = 'img_0280.jpg';
            $data['LeadLog']['user_id'] = '3a38ee92-6934-102d-9f80-579a023712b2';
            $return = $this->LeadLog->saveFileLog($log_type,$data);
            $this->assertEquals(is_array($return),true,'dodanie nowej wersji pliku');
		
            $log_type = 2;
            $data['LeadFile']['client_lead_id'] = 7;
            $data['LeadFile']['file'] = 'img_0280.jpg';
            $data['LeadLog']['user_id'] = '3a38ee92-6934-102d-9f80-579a023712b2';
            $return = $this->LeadLog->saveFileLog($log_type,$data);
            $this->assertEquals(is_array($return),true,'nowy plik');
            
            
        }
}
