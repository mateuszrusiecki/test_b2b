<?php

/* ProjectIssueEntry Test cases generated on: 2015-02-12 09:48:00 : 1423730880 */
App::uses('ProjectIssueEntry', 'Model');

/**
 * ProjectIssueEntry Test Case
 *
 */
class ProjectIssueEntryTestCase extends CakeTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array(
            'app.project_issue_entry',
            'app.project_issue',
            'app.project_user',
            //'app.project_users_types',
           
            );

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->ProjectIssueEntry = ClassRegistry::init('ProjectIssueEntry');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->ProjectIssueEntry);

		parent::tearDown();
	}

        public function testGetCostByProject(){
         
         $pid = '';
         $return = $this->ProjectIssueEntry->getCostByProject($pid);
         $this->assertEquals($return,false,'pusty paramter');
                 
         $pid = null;
         $return = $this->ProjectIssueEntry->getCostByProject($pid);
         $this->assertEquals($return,false,'parametr null');
                 
         $pid = '1';
         $return = $this->ProjectIssueEntry->getCostByProject($pid);
         $this->assertEquals(is_array($return),true,'prawidlowy parametr');
                 
                 
                 
	}

}
