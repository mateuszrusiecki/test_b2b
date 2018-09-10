<?php
/* ClientProjectBudget Test cases generated on: 2015-03-17 11:14:54 : 1426587294*/
App::uses('ClientProjectBudget', 'Model');

/**
 * ClientProjectBudget Test Case
 *
 */
class ClientProjectBudgetTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
            'app.client_project_budget', 
            'app.client_project', 
            'app.client_lead', 
            'app.client', 
            'app.userUser', 
//            'app.user_client', 
            'app.lead_category', 
            'app.lead_status', 
            'app.currency', 
            'app.client_contact', 
            'app.client_contact_client_lead', 
            'app.section', 'app.user_section', 
            'app.client_project_budget_position',
            'app.client_project_user',
            'app.profile'
            
            
            );

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->ClientProjectBudget = ClassRegistry::init('ClientProjectBudget');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientProjectBudget);

		parent::tearDown();
	}
        
    /**
     * Zapis projektu(drugi krok)
     * 
     * @param int $data			array	dane do zapisu
     * @return type boolean		true	gdy zapisze poprawnie
     * 							false	w przypadku błędu
     */  
        public function testSaveProjectBudget(){
            
            $data = '';
            $return = $this->ClientProjectBudget->saveProjectBudget($data);
            $this->assertEquals($return, false, 'pusty parametr');
            
            $data = array(
            );
            $return = $this->ClientProjectBudget->saveProjectBudget($data);
            $this->assertEquals($return, false, 'pusta tabela');
            
            $data = null;
            $return = $this->ClientProjectBudget->saveProjectBudget($data);
            $this->assertEquals($return, false, 'parametr null');
            
            
            $return = $this->ClientProjectBudget->saveProjectBudget();
            $this->assertEquals($return, false, 'brak parametru');
            
            
            
            $data = array(
                'ClientProjectBudget' => array(
			'client_project_id' => 1,
			'section_id' => 1,
			'section_boss' => 'Lorem ipsum dolor sit amet',
			'activity_name' => 'Lorem ipsum dolor sit amet',
			'pm' => 1,
			'buffer_percentage' => 10,
			'buffer_value' => 100,
			'margin_percentage' => 10,
			'margin_value' => 100,
			'position_cost' => 1,
			'position_value' => 1,
			'created' => '2015-03-15 11:14:48',
			'modified' => '2015-03-16 11:30:48'
                )
            );
            $return = $this->ClientProjectBudget->saveProjectBudget($data);
            $this->assertEquals(is_array($return), true, 'prawidłowe dane');
            
             $data = array(
                'ClientProjectBudget' => array(
                        'id'=>3,
			'client_project_id' => 1,
			'section_id' => 1,
			'section_boss' => 'Lorem ipsum dolor sit amet',
			'activity_name' => 'Lorem ipsum dolor sit amet',
			'pm' => 1,
			'buffer_percentage' => 10,
			'buffer_value' => 100,
			'margin_percentage' => 10,
			'margin_value' => 100,
			'position_cost' => 1,
			'position_value' => 1,
			'created' => '2015-03-15 11:14:48',
			'modified' => '2015-03-16 11:30:48'
                )
            );
            $return = $this->ClientProjectBudget->saveProjectBudget($data);
            $this->assertEquals(is_array($return), true, 'prawidłowe dane nowa pozycja');
            
        }
        
         public function testGetAllProjectBudget(){
            
            $client_project_id = ''; 
            $return = $this->ClientProjectBudget->getAllProjectBudget($client_project_id);
            $this->assertEquals($return, false,'parametr pusty');
             
            $client_project_id = null; 
            $return = $this->ClientProjectBudget->getAllProjectBudget($client_project_id);
            $this->assertEquals($return, false,'parametr null');
             
            
            $return = $this->ClientProjectBudget->getAllProjectBudget();
            $this->assertEquals($return, false,'brak parametru');
             
            // prawidlowe dane 
            $client_project_id = '1'; 
            $return = $this->ClientProjectBudget->getAllProjectBudget($client_project_id);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
             
         }
         
         public function testGetSections(){
          
            $client_project_id = ''; 
            $return = $this->ClientProjectBudget->getSections($client_project_id);
            $this->assertEquals(is_array($return),false,'pusty parametr');
             
            $client_project_id = null; 
            $return = $this->ClientProjectBudget->getSections($client_project_id);
            $this->assertEquals(is_array($return),false,'parametr null');
             
            $return = $this->ClientProjectBudget->getSections();
            $this->assertEquals(is_array($return),false,'brak parametru');
             
            $client_project_id = '1'; 
            $return = $this->ClientProjectBudget->getSections($client_project_id);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
             
            $client_project_id = '2'; 
            $return = $this->ClientProjectBudget->getSections($client_project_id);
            $this->assertEquals($return,false,'prawidlowe dane');
             
            $client_project_id = '2563453565'; 
            $return = $this->ClientProjectBudget->getSections($client_project_id);
            $this->assertEquals($return,false,'złe id');
             
             
         }
         
         public function testDeleteProjectBudget(){
            $budgetId ='';
            $return = $this->ClientProjectBudget->deleteProjectBudget($budgetId);
            $this->assertEquals($return,false,'pusty paramter');
             
            $budgetId =null;
            $return = $this->ClientProjectBudget->deleteProjectBudget($budgetId);
            $this->assertEquals($return,false,'parametr null');
             
            $budgetId;
            $return = $this->ClientProjectBudget->deleteProjectBudget($budgetId);
            $this->assertEquals($return,false,'');
             
            $budgetId ='1';
            $return = $this->ClientProjectBudget->deleteProjectBudget($budgetId);
            $this->assertEquals($return,true,'nie istnieje taki, nie da sie usunac');
             
            $value['delete'] ='1';
            $value['section']['id'] ='1';
            $return = $this->ClientProjectBudget->deleteProjectBudget($value);
            $this->assertEquals($return,true,'poprawwnie usunięto');
            
            $params['conditions']['ClientProjectBudgetPosition.client_project_budget_id'] = $value['section']['id'];
            $return = $this->ClientProjectBudget->ClientProjectBudgetPosition->find('all',$params);
            $this->assertEquals(empty($return),true,'sprawdzam czy na pewno usunięto z bazy');
             
         }
        

}
