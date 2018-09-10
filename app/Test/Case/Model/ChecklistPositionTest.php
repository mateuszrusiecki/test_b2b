<?php

/* BriefAnswer Test cases generated on: 2015-06-11 13:20:31 : 1434028831 */
App::uses('ChecklistPosition', 'Model');

/**
 * BriefAnswer Test Case
 *
 */
class ChecklistPositionTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.checklist_position',
        'app.checklist_position_group',
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->ChecklistPosition = ClassRegistry::init('ChecklistPosition');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChecklistPosition);

        parent::tearDown();
    }

    public function testPositionsFromGroup()
    {
        $group_id = '54e1dad1-ca6c-4c85-9c50-0a2077ecc6b3';
        $return = $this->ChecklistPosition->positionsFromGroup($group_id);
        $this->assertEquals(is_array($return), true, 'Poprawne dane');
        $reset = reset($return);
        $this->assertEquals(is_array($reset), true, 'Poprawne dane');
        $this->assertEquals(is_array($reset) && !empty($reset['ChecklistPosition']), true, 'Poprawne dane');

        $group_id = -1;
        $return = $this->ChecklistPosition->positionsFromGroup($group_id);
        $this->assertEquals(!empty($return), false, 'Błedne dane');
    }

}
