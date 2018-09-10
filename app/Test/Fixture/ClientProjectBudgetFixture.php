<?php
/**
 * ClientProjectBudgetFixture
 *
 */
class ClientProjectBudgetFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_project_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'section_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'id działu'),
		'section_boss' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'imię, nazwisko szefa działu', 'charset' => 'utf8'),
		'activity_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'nazwa działania', 'charset' => 'utf8'),
		'pm' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'link do PM', 'charset' => 'utf8'),
		'buffer_percentage' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '% buforu'),
		'buffer_value' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'wartość buforu'),
		'margin_percentage' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '% marży'),
		'margin_value' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'wartość marży'),
		'position_cost' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'comment' => 'koszt pozycji budżetowej'),
		'position_value' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'comment' => 'wartość pozycji budżetowej'),
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
			'id' => '1',
			'client_project_id' => '1',
			'section_id' => '3',
			'section_boss' => NULL,
			'activity_name' => 'Programiści - Rzeszów, Marcin Rudzik',
			'pm' => NULL,
			'buffer_percentage' => '15',
			'buffer_value' => NULL,
			'margin_percentage' => '35',
			'margin_value' => NULL,
			'position_cost' => '2744.00',
			'position_value' => '4633.14',
			'created' => '2015-06-01 10:05:46',
			'modified' => '2015-06-30 12:59:31'
		),
		array(
			'id' => '2',
			'client_project_id' => '3',
			'section_id' => '3',
			'section_boss' => NULL,
			'activity_name' => 'Programiści - Rzeszów, Marcin Rudzik',
			'pm' => NULL,
			'buffer_percentage' => '15',
			'buffer_value' => NULL,
			'margin_percentage' => '35',
			'margin_value' => NULL,
			'position_cost' => '1715.00',
			'position_value' => '2895.71',
			'created' => '2015-06-10 06:52:32',
			'modified' => '2015-07-01 14:34:08'
		),
		array(
			'id' => '3',
			'client_project_id' => '1',
			'section_id' => '9',
			'section_boss' => NULL,
			'activity_name' => 'Marketing, Marcin Zaborowski',
			'pm' => NULL,
			'buffer_percentage' => '15',
			'buffer_value' => NULL,
			'margin_percentage' => '35',
			'margin_value' => NULL,
			'position_cost' => '600.00',
			'position_value' => '1013.08',
			'created' => '2015-06-10 12:55:13',
			'modified' => '2015-06-30 12:59:31'
		),
		array(
			'id' => '4',
			'client_project_id' => '1',
			'section_id' => '16',
			'section_boss' => NULL,
			'activity_name' => 'SEO/SEM, Paweł Kazimirowicz',
			'pm' => NULL,
			'buffer_percentage' => '15',
			'buffer_value' => NULL,
			'margin_percentage' => '35',
			'margin_value' => NULL,
			'position_cost' => '375.00',
			'position_value' => '633.17',
			'created' => '2015-06-10 12:55:13',
			'modified' => '2015-06-30 12:59:31'
		),
	);

}
