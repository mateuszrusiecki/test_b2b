<?php
/* Sections Test cases generated on: 2015-02-17 08:37:28 : 1424158648*/
App::uses('SectionsController', 'Controller');

/**
 * TestSectionsController *
 */
class TestSectionsController extends SectionsController {
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
 * SectionsController Test Case
 *
 */
class SectionsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.section', 'app.user_user', 'app.user', 'app.user_section');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Sections = new TestSectionsController();
		$this->Sections->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sections);

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
