<?php
/* Grindstones Test cases generated on: 2015-02-11 09:22:36 : 1423642956*/
App::uses('GrindstonesController', 'Controller');

/**
 * TestGrindstonesController *
 */
class TestGrindstonesController extends GrindstonesController {
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
 * GrindstonesController Test Case
 *
 */
class GrindstonesControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.grindstone');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Grindstones = new TestGrindstonesController();
		$this->Grindstones->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Grindstones);

		parent::tearDown();
	}

}
