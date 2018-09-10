<?php

/**
 * BriefDefaultQuestion Test Case
 *
 */
class BriefDefaultQuestionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.brief_default_question'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BriefDefaultQuestion = ClassRegistry::init('BriefDefaultQuestion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BriefDefaultQuestion);

		parent::tearDown();
	}

/**
 * testAllParse method
 *
 * @return void
 */
	public function testAllParse() {
            $return =  $this->BriefDefaultQuestion->allParse();
            $this->assertEquals(is_array($return), true, 'Poprawne dane');
            $reset = reset($return);
            $this->assertEquals(!empty($reset['category']), true, 'Poprawne dane');
            $this->assertEquals(!empty($reset['group']), true, 'Poprawne dane');
            $this->assertEquals(!empty($reset['questions']), true, 'Poprawne dane');
	}

}
