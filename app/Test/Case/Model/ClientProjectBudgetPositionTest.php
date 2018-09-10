<?php
/* ClientProjectBudgetPosition Test cases generated on: 2015-03-17 11:17:50 : 1426587470*/
App::uses('ClientProjectBudgetPosition', 'Model');

/**
 * ClientProjectBudgetPosition Test Case
 *
 */
class ClientProjectBudgetPositionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
            'app.client_project_budget_position', 
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
            'app.section', 
            'app.user_section');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->ClientProjectBudgetPosition = ClassRegistry::init('ClientProjectBudgetPosition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientProjectBudgetPosition);

		parent::tearDown();
	}

        
      /**
       * 
       * 
       * 
       * 
       * 
       * 
       */  
        
        
        
        
        public function testSaveProjectBudgetPosition(){
            $data='';
            $return= $this->ClientProjectBudgetPosition->saveProjectBudgetPosition($data);
            $this->assertEquals($return, false, 'pusty parametr');
            
            $data= array(
                
            );
            $return= $this->ClientProjectBudgetPosition->saveProjectBudgetPosition($data);
            $this->assertEquals($return, false, 'pusta tablica');
            
            $data= null;
            $return= $this->ClientProjectBudgetPosition->saveProjectBudgetPosition($data);
            $this->assertEquals($return, false, 'parametr null');
            
            $data= array(
                'ClientProjectBudgetPosition' => array(
                    'client_project_budget_id' => 1,
                    'name' => 'Lorem ipsum dolor sit amet',
                    'hours' => 1,
                    'price' => 1,
                    'created' => '2015-03-17 11:17:46',
                    'modified' => '2015-03-17 11:17:46'
                )
            );
            $return= $this->ClientProjectBudgetPosition->saveProjectBudgetPosition($data);
            $this->assertEquals(is_array($return), true, 'prawidłowe dane nowa pozycja');
            
            $data= array(
                'ClientProjectBudgetPosition' => array(
                    'id' => 5,
                    'client_project_budget_id' => 1,
                    'name' => 'Lorem ipsum dolor sit amet',
                    'hours' => 1,
                    'price' => 1,
                    'created' => '2015-03-17 11:17:46',
                    'modified' => '2015-03-17 11:17:46'
                )
            );
            $return= $this->ClientProjectBudgetPosition->saveProjectBudgetPosition($data);
            $this->assertEquals(is_array($return), true, 'prawidłowe dane');
            
        }
  /**
    * Wszystkie pozycje budżetowe wybranej sekcji budżetu projektu
    * 
    * @param int $client_project_budget_id		id budżetu
    * @return type mixed				array jeśli znajdzie
    *							false w przypadku błędu
    */ 
        public function testGetAllProjectBudgetPositions(){

            $client_project_budget_id='';
            $return= $this->ClientProjectBudgetPosition->getAllProjectBudgetPositions($client_project_budget_id);
            $this->assertEquals($return, false, 'pusty parametr');
            
            $client_project_budget_id= null;
            $return= $this->ClientProjectBudgetPosition->getAllProjectBudgetPositions($client_project_budget_id);
            $this->assertEquals($return, false, 'parametr null');
            
            $client_project_budget_id='1';
            $return= $this->ClientProjectBudgetPosition->getAllProjectBudgetPositions($client_project_budget_id);
            $this->assertEquals(is_array($return), true, 'prawidłowe dane');
            
        }
        
  /**
    * Usuwanie pozycji budżetowej
    * 
    * @param int $id			ID pozycji budżetowej
    * @return boolean          true po pomyślnym usunięciu
    *                          false w przypadku błędu
    */
        public function testDeleteProjectBudgetPosition(){
            
            $id ='';
            $return= $this->ClientProjectBudgetPosition->deleteProjectBudgetPosition($id);
            $this->assertEquals($return, false, 'pusty parametr');
            
            $id = null;
            $return= $this->ClientProjectBudgetPosition->deleteProjectBudgetPosition($id);
            $this->assertEquals($return, false, 'parametr null');
            
            $id ='1';
            $return= $this->ClientProjectBudgetPosition->deleteProjectBudgetPosition($id);
            $this->assertEquals($return, true, 'prawidłowe usunięcie');
        }
        
        
        public function testDeleteProjectBudgetPayment(){
            $value  = '';
            $return = $this->ClientProjectBudgetPosition->deleteProjectBudgetPayment($value);
            $this->assertEquals($return, false, 'pusty parametr');

            $value  = null;
            $return = $this->ClientProjectBudgetPosition->deleteProjectBudgetPayment($value);
            $this->assertEquals($return, false, 'null');
            
            $value  = '1';
            $return = $this->ClientProjectBudgetPosition->deleteProjectBudgetPayment($value);
            $this->assertEquals($return, true, 'nie wykonal usuniecia');
        }
        
}
