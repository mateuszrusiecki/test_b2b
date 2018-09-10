<?php
/**
 * VacationTypeFixture
 *
 */
class VacationTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_hours' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'name' => 'Urlop wypoczynkowy',
			'is_hours' => 0,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '2',
			'name' => 'Wyjście prywatne',
			'is_hours' => 1,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '3',
			'name' => 'Urlop na żądanie',
			'is_hours' => 0,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '4',
			'name' => 'Urlop okolicznościowy',
			'is_hours' => 0,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '5',
			'name' => 'Rozliczenie nadgodzin',
			'is_hours' => 1,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '6',
			'name' => 'Zwolnienie lekarskie',
			'is_hours' => 0,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '7',
			'name' => 'Opieka nad zdrowym dzieckiem',
			'is_hours' => 0,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '8',
			'name' => 'Urlop macierzyński',
			'is_hours' => 0,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '9',
			'name' => 'Urlop rodzicielski',
			'is_hours' => 0,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '10',
			'name' => 'Urlop bezpłatny',
			'is_hours' => 0,
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
	);

}
