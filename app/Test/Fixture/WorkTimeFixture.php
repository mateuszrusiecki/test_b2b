<?php
/**
 * WorkTimeFixture
 *
 */
class WorkTimeFixture extends CakeTestFixture {


/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'year' => array('type' => 'integer', 'null' => false, 'default' => null),
		'month' => array('type' => 'integer', 'null' => false, 'default' => null),
		'work_hours' => array('type' => 'integer', 'null' => false, 'default' => null),
		'work_days' => array('type' => 'integer', 'null' => true, 'default' => null),
		'days_off' => array('type' => 'integer', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'year' => '2015',
			'month' => '1',
			'work_hours' => '160',
			'work_days' => '20',
			'days_off' => NULL
		),
		array(
			'id' => '2',
			'year' => '2015',
			'month' => '2',
			'work_hours' => '160',
			'work_days' => '20',
			'days_off' => NULL
		),
		array(
			'id' => '3',
			'year' => '2015',
			'month' => '3',
			'work_hours' => '176',
			'work_days' => '22',
			'days_off' => NULL
		),
	);

}
