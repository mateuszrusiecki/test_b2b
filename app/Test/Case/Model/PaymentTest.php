<?php

/**
 * Payment Test Case
 *
 */
class PaymentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.payment',
		'app.clientProject'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Payment = ClassRegistry::init('Payment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Payment);

		parent::tearDown();
	}

        
        
        public function testGetPayments(){
            
            $project_id = '';
            $return = $this->Payment->getPayments($project_id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $project_id = null;
            $return = $this->Payment->getPayments($project_id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $project_id = '1';
            $return = $this->Payment->getPayments($project_id);
            $this->assertEquals(is_array($return),true,'prawidłowe dane');
            
            $project_id = '1000';
            $return = $this->Payment->getPayments($project_id);
            $this->assertEquals($return,false,'prawidłowe dane, nie istniejacy projekt');
            
            $project_id = '12';
            $return = $this->Payment->getPayments($project_id);
            $this->assertEquals(empty($return),true,'prawidłowe dane, brak platnosci w tym projekcie');
            
        }
        
        public function testInterval(){
           
            $return = $this->Payment->interval();
            $this->assertEquals(is_array($return),true,'nie zwraca danych');
            
        }
        
        public function testPaymentDay(){
            
            $return = $this->Payment->paymentDay();
            $this->assertEquals(is_array($return),true,'nie zwraca danych');
        }
        
        public function testparseTimeLine(){
            $project_id = '';
            $return = $this->Payment->parseTimeLine($project_id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $project_id = null;
            $return = $this->Payment->parseTimeLine($project_id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $project_id = '1';
            $return = $this->Payment->parseTimeLine($project_id);
            $this->assertEquals(is_array($return),true,'prawidłowe dane');
            
            $project_id = '1000';
            $return = $this->Payment->parseTimeLine($project_id);
            $this->assertEquals($return,false,'prawidłowe dane, nie istniejacy projekt');
            
            $project_id = '12';
            $return = $this->Payment->parseTimeLine($project_id);
            $this->assertEquals(empty($return),true,'prawidłowe dane, brak platnosci w tym projekcie');
            
        }
}
