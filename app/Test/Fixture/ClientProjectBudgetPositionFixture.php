<?php
/**
 * ClientProjectBudgetPositionFixture
 *
 */
class ClientProjectBudgetPositionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_project_budget_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'time' => array('type' => 'float', 'null' => true, 'default' => null),
		'price' => array('type' => 'float', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_polish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'client_project_budget_id' => '1',
			'name' => 'Programowanie',
			'time' => '30',
			'price' => '49',
			'created' => '2015-06-01 10:05:46',
			'modified' => '2015-06-30 12:59:31'
		),
		array(
			'id' => '2',
			'client_project_budget_id' => '1',
			'name' => 'Grafika',
			'time' => '16',
			'price' => '49',
			'created' => '2015-06-01 10:05:46',
			'modified' => '2015-06-30 12:59:31'
		),
		array(
			'id' => '3',
			'client_project_budget_id' => '1',
			'name' => 'Inne',
			'time' => '10',
			'price' => '49',
			'created' => '2015-06-01 10:05:46',
			'modified' => '2015-06-30 12:59:31'
		),
		array(
			'id' => '4',
			'client_project_budget_id' => '2',
			'name' => 'Programowanie',
			'time' => '20',
			'price' => '49',
			'created' => '2015-06-10 06:52:32',
			'modified' => '2015-07-01 14:34:08'
		),
		array(
			'id' => '5',
			'client_project_budget_id' => '2',
			'name' => 'Grafika',
			'time' => '10',
			'price' => '49',
			'created' => '2015-06-10 06:52:32',
			'modified' => '2015-07-01 14:34:08'
		),
		array(
			'id' => '6',
			'client_project_budget_id' => '2',
			'name' => 'Inne',
			'time' => '5',
			'price' => '49',
			'created' => '2015-06-10 06:52:32',
			'modified' => '2015-07-01 14:34:08'
		),
		array(
			'id' => '7',
			'client_project_budget_id' => '3',
			'name' => 'Promowanie strony',
			'time' => '20',
			'price' => '30',
			'created' => '2015-06-10 12:55:13',
			'modified' => '2015-06-30 12:59:31'
		),
		array(
			'id' => '8',
			'client_project_budget_id' => '4',
			'name' => 'pozycjonowanie, seo',
			'time' => '15',
			'price' => '25',
			'created' => '2015-06-10 12:55:14',
			'modified' => '2015-06-30 12:59:31'
		),
	);

}
