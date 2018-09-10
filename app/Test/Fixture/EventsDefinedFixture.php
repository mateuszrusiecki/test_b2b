<?php
/**
 * EventsDefinedFixture
 *
 */
class EventsDefinedFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'events_defined';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'month' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'day' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'title' => 'Nowy Rok',
			'month' => '1',
			'day' => '1'
		),
		array(
			'id' => '2',
			'title' => 'Święto Trzech Króli',
			'month' => '1',
			'day' => '6'
		),
		array(
			'id' => '3',
			'title' => 'Święto Państwowe',
			'month' => '5',
			'day' => '1'
		),
		array(
			'id' => '4',
			'title' => 'Trzeciego Maja',
			'month' => '5',
			'day' => '3'
		),
		array(
			'id' => '5',
			'title' => 'Św. Wniebowzięcia',
			'month' => '8',
			'day' => '15'
		),
		array(
			'id' => '6',
			'title' => 'Wszystkich Świętych',
			'month' => '11',
			'day' => '1'
		),
		array(
			'id' => '7',
			'title' => 'Dzień Niepodległości',
			'month' => '11',
			'day' => '11'
		),
		array(
			'id' => '8',
			'title' => 'Boże Narodzenie',
			'month' => '12',
			'day' => '25'
		),
		array(
			'id' => '9',
			'title' => 'Boże Narodzenie',
			'month' => '12',
			'day' => '26'
		),
	);

}
