<?php

/**
 * ModulePhotosController Test Case
 *
 */
class ModulePhotosControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.module_photo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ModulePhotos = new TestModulePhotosController();
		$this->ModulePhotos->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ModulePhotos);

		parent::tearDown();
	}

}
