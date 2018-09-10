<?php
/* Briefs Test cases generated on: 2015-06-11 13:28:49 : 1434029329*/
App::uses('BriefsController', 'Controller');

/**
 * TestBriefsController *
 */
class TestBriefsController extends BriefsController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * BriefsController Test Case
 *
 */
class BriefsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.brief', 'app.user', 'app.client_lead', 'app.client', 'app.lead_category', 'app.lead_status', 'app.currency', 'app.client_contact', 'app.client_contact_client_lead', 'app.brief_question', 'app.brief_answer');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Briefs = new TestBriefsController();
		$this->Briefs->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Briefs);

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

/**
 * testAdminAutocomplete method
 *
 * @return void
 */
	public function testAdminAutocomplete() {

	}

}
