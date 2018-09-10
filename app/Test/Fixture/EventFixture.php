<?php
/**
 * EventFixture
 *
 */
class EventFixture extends CakeTestFixture {

/**
 * Import
 *
 * @var array
 */
	public $import = array('model' => 'Event', 'records' => true);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '5',
			'calendar_id' => '1',
			'event_type_id' => '2',
			'title' => 'Dzień wolny dla firmy',
			'date_start' => '2015-06-08',
			'date_end' => '2015-06-11',
			'profiles' => ''
		),
		array(
			'id' => '7',
			'calendar_id' => '1',
			'event_type_id' => '2',
			'title' => 'Dzień wolny dla firmy',
			'date_start' => '2015-06-02',
			'date_end' => '2015-06-03',
			'profiles' => ''
		),
		array(
			'id' => '11',
			'calendar_id' => '1',
			'event_type_id' => '0',
			'title' => 'Brak tytułu',
			'date_start' => '0000-00-00',
			'date_end' => '0000-00-00',
			'profiles' => '[]'
		),
		array(
			'id' => '12',
			'calendar_id' => '1',
			'event_type_id' => '0',
			'title' => 'Brak tytułu',
			'date_start' => '0000-00-00',
			'date_end' => '0000-00-00',
			'profiles' => '[]'
		),
		array(
			'id' => '15',
			'calendar_id' => '1',
			'event_type_id' => '2',
			'title' => 'Dzień wolny dla firmy',
			'date_start' => '2015-06-23',
			'date_end' => '2015-06-26',
			'profiles' => ''
		),
	);

}
