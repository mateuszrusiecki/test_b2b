<?php
/**
 * AgreementPositionFixture
 *
 */
class AgreementPositionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'budget_agreement_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'position_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'position_quantity' => array('type' => 'integer', 'null' => false, 'default' => null),
		'position_cost' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 10),
		'total_cost' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'id' => 1,
			'budget_agreement_id' => 1,
			'position_name' => 'Lorem ipsum dolor sit amet',
			'position_quantity' => 1,
			'position_cost' => 1,
			'total_cost' => 1,
			'created' => '2015-03-17 08:48:39',
			'modified' => '2015-03-17 08:48:39'
		),
	);

}
