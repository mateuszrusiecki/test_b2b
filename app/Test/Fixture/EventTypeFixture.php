<?php
/**
 * EventTypeFixture
 *
 */
class EventTypeFixture extends CakeTestFixture {

/**
 * Import
 *
 * @var array
 */
	public $import = array('model' => 'EventType', 'records' => true);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'name' => 'Badanie'
		),
		array(
			'id' => '2',
			'name' => 'Dzień wolny'
		),
		array(
			'id' => '3',
			'name' => 'Szkolenie'
		),
	);

}
