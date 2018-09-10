<?php

/* Project Test cases generated on: 2015-03-04 09:51:25 : 1425459085 */
App::uses('Project', 'Model');

/**
 * Project Test Case
 *
 */
class ProjectTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.project',
//        'app.project_issue_entry',
        );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Project = ClassRegistry::init('Project');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Project);

        parent::tearDown();
    }

    /**
     * testGetCostByProject method
     *
     * @return void
     */
    public function testGetCostByProject()
    {
//        $return = $this->Project->getCostByProject();
//        $this->assertEquals($return, false, 'brak parmetru');
//        
//        $return = $this->Project->getCostByProject(1);
//        debug($return);
//        $this->assertEquals($return, false, 'brak parmetru');
    }

    /**
     * testCalculateTime method
     *
     * @return void
     */
    public function testCalculateTime()
    {
        $return = $this->Project->calculateTime();
        $this->assertEquals($return, false, 'brak parmetru');
        
        $times = array();
        $times['@start'] = '2015-03-04 12:00';
        $times['@end'] = '2015-03-04 15:00';
        $return = $this->Project->calculateTime($times);
         $this->assertEquals(is_array($return), true, 'poprawnie');
        $this->assertEquals($return['maxTime'] == strtotime($times['@end']), true, 'poprawnie liczba max');
        $this->assertEquals($return['minTime'] == strtotime($times['@start']), true, 'poprawnie liczba min');
        
        $times = array();
        $times[1]['@start'] = '2015-03-04 12:00';
        $times[1]['@end'] = '2015-03-04 15:00';
        $times[2]['@start'] = '2015-03-03 10:00';
        $times[2]['@end'] = '2015-03-03 12:00';
        $return = $this->Project->calculateTime($times);

        $this->assertEquals(is_array($return), true, 'poprawnie');
        $this->assertEquals($return['maxTime'] == strtotime($times[1]['@end']), true, 'poprawnie liczba max');
        $this->assertEquals($return['minTime'] == strtotime($times[2]['@start']), true, 'poprawnie liczba min');
    }

    /**
     * testFilterParam method
     *
     * @return void
     */
    public function testFilterParam()
    {
        
    }

    /**
     * testPaginateCount method
     *
     * @return void
     */
    public function testPaginateCount()
    {
        
    }

    /**
     * testListProject method
     *
     * @return void
     */
    public function testListProject()
    {
        $return = $this->Project->listProjects();
        $this->assertEquals(is_array($return), true, 'poprawnie');
    }

}
