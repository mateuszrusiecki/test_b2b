<?php
/* ClientProjectLog Test cases generated on: 2015-03-26 15:16:11 : 1427379371*/
App::uses('ClientProjectLog', 'Model');

/**
 * ClientProjectLog Test Case
 *
 */
class ClientProjectLogTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
            'app.client_project_log', 
            'app.client_project', 
            'app.client_lead', 
            'app.client', 
            'app.profile', 
            'app.userUser', 
//            'app.user_client', 
            'app.lead_category', 
            'app.lead_status', 
            'app.currency', 
            'app.client_contact', 
            'app.client_contact_client_lead', 
            'app.user_section' 
            );

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->ClientProjectLog = ClassRegistry::init('ClientProjectLog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientProjectLog);

		parent::tearDown();
	}

        
//        public function saveLog($log_type = null, $data = array())
//        
//        public function getLogList($client_project_id = null)
//                 public function getLogListSection($client_project_id = null)
//                 public function getLog($id = null)
        
        public function testSaveLog (){
            
            $log_type = '';
            $data = '';
            $return = $this->ClientProjectLog->saveLog($log_type,$data);
            $this->assertEquals($return, false,'puste parametry');
            
            
            $log_type = null;
            $data = '';
            $return = $this->ClientProjectLog->saveLog($log_type,$data);
            $this->assertEquals($return, false,'null pusty');
            
            
            $log_type = '';
            $data = null;
            $return = $this->ClientProjectLog->saveLog($log_type,$data);
            $this->assertEquals($return, false,'pusty null');
            
            
            $log_type = null;
            $data = null;
            $return = $this->ClientProjectLog->saveLog($log_type,$data);
            $this->assertEquals($return, false,'null null');
            
            for ($log_num = 1; $log_num <= 8; $log_num++){
            $_SESSION['Auth']['User']['id'] = '3a38ee92-6934-102d-9f80-579a023712b2';  // zdefiniowanie session dla testu jednostkowego 
            $log_type = $log_num;
            $data = array(
                'ClientProjectLog' =>array(
			'client_project_id' => '3',
			'type_log_id' => '2',
			'name' => 'pliczek.docx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-03-20 14:12:16',
			'modified' => '2015-03-20 14:12:16'
                ),
                'ProjectFile' => array(
                    'file'=> array(
                        'name' => 'pliczek.docx',
                    ),
                    'client_project_id' => '3',
                )
            );
            $return = $this->ClientProjectLog->saveLog($log_type,$data);
            $this->assertEquals(is_array($return), true,'prawidlowe dane do zapisu'.$log_num);
            }
            
            $_SESSION['Auth']['User']['id'] = '3a38ee92-6934-102d-9f80-579a023712b2';  // zdefiniowanie session dla testu jednostkowego 
            $log_type = '3';
            $data = array(
                 'ClientProjectLog' =>array(
                         'client_project_id' => '3',
                         'type_log_id' => '2',
                         'name' => 'pliczek.docx',
                         'subject' => NULL,
                         'message' => NULL,
                         'from' => NULL,
                         'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
                         'email_date' => NULL,
                         'created' => '2015-03-20 14:12:16',
                         'modified' => '2015-03-20 14:12:16'
                 ),
                 'ProjectFile' => array(
                     'client_project_id' => '3',
                     'file' =>''
                 )
             );
            $return = $this->ClientProjectLog->saveLog($log_type,$data);
            $this->assertEquals(is_array($return), true,'prawidlowe dane do zapisu v2 dla pokrycia');
            
            $_SESSION['Auth']['User']['id'] = '3a38ee92-6934-102d-9f80-579a023712b2';  // zdefiniowanie session dla testu jednostkowego 
            $log_type = '9';
            $data = array(
                 'ClientProjectLog' =>array(
                         'client_project_id' => '3',
                         'type_log_id' => '2',
                         'name' => 'pliczek.docx',
                         'subject' => NULL,
                         'message' => NULL,
                         'from' => NULL,
                         'user_id' => '3a38ee92-6934-133d-9f80-579a023712b2',
                         'email_date' => NULL,
                         'created' => '2015-03-20 14:12:16',
                         'modified' => '2015-03-20 14:12:16'
                 ),
                 'ProjectFile' => array(
                     'client_project_id' => '3',
                     'file' =>''
                 )
             );
            $return = $this->ClientProjectLog->saveLog($log_type,$data);
            $this->assertEquals(is_array($return), true,'prawidlowe dane do zapisu log_type po za opcjami switcha');
        }
        
        public function testGetLogList (){
            
            $client_project_id = '';
            $return = $this->ClientProjectLog->getLogList($client_project_id);
            $this->assertEquals($return,false,'parametr pusty');
            
            $client_project_id = null;
            $return = $this->ClientProjectLog->getLogList($client_project_id);
            $this->assertEquals($return,false,'parametr null');
            
            $return = $this->ClientProjectLog->getLogList();
            $this->assertEquals($return,false,'brak parametru');
                        
            $client_project_id = '3';
            $return = $this->ClientProjectLog->getLogList($client_project_id);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
        }
        
        public function testGetLogListSection (){
            
            $client_project_id = '';
            $return = $this->ClientProjectLog->getLogListSection($client_project_id);
            $this->assertEquals($return,false,'parametr pusty');
            
            $client_project_id = null;
            $return = $this->ClientProjectLog->getLogListSection($client_project_id);
            $this->assertEquals($return,false,'paramter null');
            
            
            $return = $this->ClientProjectLog->getLogListSection();
            $this->assertEquals($return,false,'brak parametru');
            
            $client_project_id = '3';
            $return = $this->ClientProjectLog->getLogListSection($client_project_id);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
            
            $client_project_id = '300';
            $return = $this->ClientProjectLog->getLogListSection($client_project_id);
            $this->assertEquals($return,false,'prawidlowe parametr, ale nie istniejacy projekt');
            
            
        }
        
        public function testGetLog (){
            $id = '';
            $return = $this->ClientProjectLog->getLog($id);
            $this->assertEquals($return, false,'parametru pusty');
            
            $id = null;
            $return = $this->ClientProjectLog->getLog($id);
            $this->assertEquals($return, false,'parament null');
            
            $return = $this->ClientProjectLog->getLog();
            $this->assertEquals($return, false,'brak parametru');
            
            $id = '422';
            $return = $this->ClientProjectLog->getLog($id);
            $this->assertEquals(is_array($return), true,'prawidlowe dane');
            
            $id = '1000';
            $return = $this->ClientProjectLog->getLog($id);
            $this->assertEquals($return, false,'zapytanie o nie istniejący wiersz w bazie');
            
        }
        
        
        public function testSaveProjectBudgetLog(){
            $data = '';
            $return = $this->ClientProjectLog->saveProjectBudgetLog($data);
            $this->assertEquals($return,false,'pusty parametr');
              
            $data = null; 
            $return = $this->ClientProjectLog->saveProjectBudgetLog($data);
            $this->assertEquals($return,false,'parametr null');
            
            $data = array(
                'ClientProjectBudget' =>array(
                    'user_id' => '3a38fg92-6934-102d-9f80-579a023712b2', 
                    'client_project_id' => '3',
                    'activity_name' => 'testowanie'
                )
            );
            $return = $this->ClientProjectLog->saveProjectBudgetLog($data);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
            
            
            $data = array(
                'ClientProjectBudget' =>array(
                    'user_id' => '3a38fg92-6934-102d-9f80-579a023712b2', 
                    'client_project_id' => '3',
                    'activity_name' => 'testowanie'
                )
            );
            $return = $this->ClientProjectLog->saveProjectBudgetLog($data,true);
            $this->assertEquals(is_array($return),true,'prawidlowe dane usuniecie pozycji budzetowej');
        }
        
        
        public function testSaveProjectBudgetCostLog(){
            $data = '';
            $return = $this->ClientProjectLog->saveProjectBudgetCostLog($data);
            $this->assertEquals($return,false,'pusty parametr');
              
            $data = null; 
            $return = $this->ClientProjectLog->saveProjectBudgetCostLog($data);
            $this->assertEquals($return,false,'parametr null');
            
            $data = array(
                'ClientProjectBudget' =>array(
                    'user_id' => '3a38fg92-6934-102d-9f80-579a023712b2', 
                    'client_project_id' => '3',
                    'activity_name' => 'testowanie'
                )
            );
            $return = $this->ClientProjectLog->saveProjectBudgetCostLog($data);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
            
            
            $data = array(
                'ClientProjectBudget' =>array(
                    'user_id' => '3a38fg92-6934-102d-9f80-579a023712b2', 
                    'client_project_id' => '3',
                    'activity_name' => 'testowanie'
                )
            );
            $return = $this->ClientProjectLog->saveProjectBudgetCostLog($data,true);
            $this->assertEquals(is_array($return),true,'prawidlowe dane usuniecie pozycji budzetowej');
        }
        
        
        
        public function testSaveFileLog(){
            $log_type = '';
            $data = ''; 
            $return = $this->ClientProjectLog->saveFileLog($log_type,$data);
            $this->assertEquals($return,false,'puste parametry'); 
            
            $log_type = '';
            $data = null; 
            $return = $this->ClientProjectLog->saveFileLog($log_type,$data);
            $this->assertEquals($return,false,'pusty null'); 
            
            $log_type = null;
            $data = null; 
            $return = $this->ClientProjectLog->saveFileLog($log_type,$data);
            $this->assertEquals($return,false,'nulle');
            
            $log_type = '1';
            $data = array(
              'ProjectFile' => array(
                  'user_id' => '3a38fg92-6934-102d-9f43-579a023712b2',
                  'client_project_id' => '4',
                  'file'=> array(
                      'name' => 'nazwawrzucanegopliku.png'
                  )
              )  
            );
            $return = $this->ClientProjectLog->saveFileLog($log_type,$data);
            $this->assertEquals(is_array($return),true,'prawidłowe dane');
            
            $log_type = '1';
            $data = array(
              'ProjectFile' => array(
                  'user_id' => '3a38fg92-6934-102d-9f43-579a023712b2',
                  'file'=> 'plik.png'
              )  
            );
            $return = $this->ClientProjectLog->saveFileLog($log_type,$data);
            $this->assertEquals(is_array($return),true,'prawidłowe dane v2');
            
            
            
            
        }
}
