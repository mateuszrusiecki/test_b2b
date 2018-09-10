<?php

/**
 * Message Test Case
 *
 */
class MessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.message',
		'app.message_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Message = ClassRegistry::init('Message');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Message);

		parent::tearDown();
	}

/**
 * testSendMessage method
 *
 * @return void
 */
	public function testSendMessage() {
	}

/**
 * testGetMessages method
 *
 * @return void
 */
	public function testGetMessages() {
	}

/**
 * testGetMessagesInfo method
 *
 * @return void
 */
	public function testGetMessagesInfo() {
	}

}
