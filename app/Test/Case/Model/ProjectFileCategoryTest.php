<?php

/**
 * ProjectFileCategory Test Case
 *
 */
class ProjectFileCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.project_file_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProjectFileCategory = ClassRegistry::init('ProjectFileCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProjectFileCategory);

		parent::tearDown();
	}

/**
 * testGetAll method
 *
 * @return void
 */
	public function testGetAll() {
        $return = $this->ProjectFileCategory->getAll();
        $this->assertEquals(is_array($return),true,'prawidłowe dane');
	}

/**
 * testGetList method
 *
 * @return void
 */
	public function testGetList() {
        $return = $this->ProjectFileCategory->getList();
        $this->assertEquals(is_array($return),true,'prawidłowe dane');
	}

}
