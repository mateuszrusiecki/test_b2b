<?php
/**
 * VacationStatusFixture
 *
 */
class VacationStatusFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'name' => 'Wniosek złożony',
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '2',
			'name' => 'Wniosek wydrukowany',
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00'
		),
		array(
			'id' => '3',
			'name' => 'Wniosek przyjęty',
			'modified' => '2015-02-04 00:00:00',
			'created' => '2015-02-04 00:00:00'
		),
		array(
			'id' => '4',
			'name' => 'Wniosek zaakceptowany',
			'modified' => '2015-02-04 00:00:00',
			'created' => '2015-02-04 00:00:00'
		),
		array(
			'id' => '5',
			'name' => 'Wniosek odrzucony',
			'modified' => '2015-02-04 00:00:00',
			'created' => '2015-02-04 00:00:00'
		),
	);

}
