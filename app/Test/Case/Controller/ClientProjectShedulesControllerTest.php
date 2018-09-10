<?php

/**
 * ClientProjectShedulesController Test Case
 *
 */
class ClientProjectShedulesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.client_project_shedule',
		'app.client_project',
		'app.client_lead',
		'app.client',
		'app.user',
		'app.user_client',
		'app.lead_category',
		'app.lead_status',
		'app.currency',
		'app.client_contact',
		'app.client_contact_client_lead'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientProjectShedules = new TestClientProjectShedulesController();
		$this->ClientProjectShedules->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientProjectShedules);

		parent::tearDown();
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
	}

/**
 * testAdminEdit method
 *
 * @return void
 */
	public function testAdminEdit() {
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
	}

}
