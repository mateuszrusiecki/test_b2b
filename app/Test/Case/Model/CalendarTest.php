<?php

/**
 * Calendar Test Case
 *
 */
class CalendarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.calendar',
		'app.event',
		'app.event_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Calendar = ClassRegistry::init('Calendar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Calendar);

		parent::tearDown();
	}

/**
 * testGetProfilesCalendar method
 *
 * @return void
 */
	public function testGetProfilesCalendar() {
	}

/**
 * testGetEventsWithEmptyProfiles method
 *
 * @return void
 */
	public function testGetEventsWithEmptyProfiles() {
	}

/**
 * testGetCalendars method
 *
 * @return void
 */
	public function testGetCalendars() {
	}

/**
 * testGetApprovedVacations method
 *
 * @return void
 */
	public function testGetApprovedVacations() {
	}

}
