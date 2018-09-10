<?php
/* InvoicePosition Fixture generated on: 2015-05-05 12:56:25 : 1430830585 */

/**
 * InvoicePositionFixture
 *
 */
class InvoicePositionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'invoice_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'name' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'nazwa towaru lub usługi'),
		'symbol' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'symbol PKWiU'),
		'jm' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'jednostak miary', 'charset' => 'utf8'),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => null),
		'unit_price' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'comment' => 'cena jednostkowa bez podatku'),
		'net_value' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 10, 'comment' => 'wartość towaru bez podatku'),
		'tax' => array('type' => 'integer', 'null' => false, 'default' => null),
		'tax_value' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 10),
		'gross_value' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 10),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'invoice_id' => array('column' => 'invoice_id', 'unique' => 0)
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
			'id' => 1,
			'invoice_id' => 1,
			'name' => 1,
			'symbol' => 1,
			'jm' => 'Lorem ipsum dolor sit amet',
			'quantity' => 1,
			'unit_price' => 1,
			'net_value' => 1,
			'tax' => 1,
			'tax_value' => 1,
			'gross_value' => 1
		),
	);
}
