<?php

/**
 * ProjectFilesController Test Case
 *
 */
class ProjectFilesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.project_file',
		'app.client_project',
		'app.client_lead',
		'app.client',
		'app.user',
		'app.user_client',
		'app.lead_category',
		'app.lead_status',
		'app.currency',
		'app.client_contact',
		'app.client_contact_client_lead',
		'app.client_project_shedule'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProjectFiles = new TestProjectFilesController();
		$this->ProjectFiles->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProjectFiles);

		parent::tearDown();
	}

}
