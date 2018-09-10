<?php
/**
 * WorkHolidayFixture
 *
 */
class WorkHolidayFixture extends CakeTestFixture {


/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'year' => array('type' => 'integer', 'null' => false, 'default' => null),
		'month' => array('type' => 'integer', 'null' => true, 'default' => null),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'nazwa święta(opcjonalne)', 'charset' => 'utf8'),
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
			'month' => '2',
			'date' => '2015-02-09',
			'name' => NULL
		),
	);

}
