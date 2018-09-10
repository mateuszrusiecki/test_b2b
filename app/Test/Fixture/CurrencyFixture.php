<?php
/**
 * CurrencyFixture
 *
 */
class CurrencyFixture extends CakeTestFixture {


/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 3, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'idx_code' => array('column' => 'code', 'unique' => 0)
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
			'name' => 'Złoty',
			'code' => 'PLN'
		),
		array(
			'id' => '2',
			'name' => 'Euro',
			'code' => 'EUR'
		),
		array(
			'id' => '3',
			'name' => 'Dolar',
			'code' => 'USD'
		),
		array(
			'id' => '4',
			'name' => 'Funt',
			'code' => 'GBP'
		),
	);

}
