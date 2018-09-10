<?php
/**
 * LeadStatusFixture
 *
 */
class LeadStatusFixture extends CakeTestFixture {


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
			'name' => 'Nowy'
		),
		array(
			'id' => '2',
			'name' => 'Brief'
		),
		array(
			'id' => '3',
			'name' => 'Oferta'
		),
		array(
			'id' => '4',
			'name' => 'W toku'
		),
		array(
			'id' => '5',
			'name' => 'Negocjacje'
		),
		array(
			'id' => '6',
			'name' => 'Wygrany'
		),
		array(
			'id' => '7',
			'name' => 'Przegrany'
		),
	);

}
