<?php
/**
 * LeadCategoryFixture
 *
 */
class LeadCategoryFixture extends CakeTestFixture {


/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'name' => 'Administracja'
		),
		array(
			'id' => '2',
			'name' => 'Adwords Google'
		),
		array(
			'id' => '3',
			'name' => 'Aktualizacja'
		),
		array(
			'id' => '4',
			'name' => 'Analizy i opracowania'
		),
		array(
			'id' => '5',
			'name' => 'Aplikacja mobilna'
		),
		array(
			'id' => '6',
			'name' => 'Aplikacje FB'
		),
		array(
			'id' => '7',
			'name' => 'Buzz marketing'
		),
		array(
			'id' => '8',
			'name' => 'Copywriting'
		),
		array(
			'id' => '9',
			'name' => 'Domena'
		),
		array(
			'id' => '10',
			'name' => 'Gadżety'
		),
	);

}
