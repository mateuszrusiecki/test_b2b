<?php

/* ProjectIssue Test cases generated on: 2015-02-12 09:51:23 : 1423731083 */
App::uses('ProjectIssue', 'Model');

/**
 * ProjectIssue Test Case
 *
 */
class ProjectIssueTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.ProjectIssue',
        'app.ProjectIssueEntry'
        );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->ProjectIssue = ClassRegistry::init('ProjectIssue');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectIssue);

        parent::tearDown();
    }

    /**
     * testGetTime method
     *
     * @return void
     */
    public function testGetTime()
    {
        $username = 's.chlebek';
		$return = $this->ProjectIssue->getTime($username);
		$this->assertEquals(is_array($return), true,'Prawidłowy user name');
		
        $username = 'a.dzi9ki';
		$return = $this->ProjectIssue->getTime($username);
		$this->assertEquals(empty($return), true,'Nieprawidłowy user name');
		
        $username = '';
		$return = $this->ProjectIssue->getTime($username);
		$this->assertEquals(empty($return), true,'pusty parametr');
		
        $username = null;
		$return = $this->ProjectIssue->getTime($username);
		$this->assertEquals($return, false,'Brak user name');
    }

    
    public function testGetTimeByDate(){
        $_SESSION['Auth']['Groups']['w_it'] = 'Pracownik IT';
        $username = '';
        $year = '';
        $month = '';
        $return = $this->ProjectIssue->getTimeByDate($username,$year,$month);
        $this->assertEquals($return,false,'puste parametry');
        unset($_SESSION['Auth']['Groups']['w_it']);
        
        $username = null;
        $year = null;
        $month = null;
        $return = $this->ProjectIssue->getTimeByDate($username,$year,$month);
        $this->assertEquals($return,false,'parametry null');
        
        $return = $this->ProjectIssue->getTimeByDate();
        $this->assertEquals($return,false,'brak parametrów');
        
        $username = '552cac43-398c-4e75-9a28-0b3077ecc6b3';
        $year = '2015';
        $month = '03';
        $return = $this->ProjectIssue->getTimeByDate($username,$year,$month);
        $this->assertEquals(!empty($return),true,'nie zwraca wyników');
    }
    
    public function testListProjectIssues(){
      $return = $this->ProjectIssue->listProjectIssues();
      $this->assertEquals(is_array($return), true,'nie zwraca danych');
    }
    
    
}
