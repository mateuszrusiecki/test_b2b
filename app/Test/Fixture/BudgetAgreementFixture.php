<?php
/**
 * BudgetAgreementFixture
 *
 */
class BudgetAgreementFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_project_budget_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'deparment_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'id działu'),
		'department_boss' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'imię, nazwisko szefa działu', 'charset' => 'utf8'),
		'activity_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'nazwa działania', 'charset' => 'utf8'),
		'PM_link' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'link do PM'),
		'buffer_percentage' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '% buforu'),
		'buffer_value' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'wartość buforu'),
		'margin_percentage' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '% marży'),
		'margin_valy' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'wartość marży'),
		'position_cost' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 10, 'comment' => 'koszt pozycji budżetowej'),
		'position_value' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 10, 'comment' => 'wartość pozycji budżetowej'),
		'agreement_start' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'agreement_end' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'client_project_budget_id' => 1,
			'deparment_id' => 1,
			'department_boss' => 'Lorem ipsum dolor sit amet',
			'activity_name' => 'Lorem ipsum dolor sit amet',
			'PM_link' => 1,
			'buffer_percentage' => 1,
			'buffer_value' => 1,
			'margin_percentage' => 1,
			'margin_valy' => 1,
			'position_cost' => 1,
			'position_value' => 1,
			'agreement_start' => '2015-03-17 08:46:03',
			'agreement_end' => '2015-03-17 08:46:03',
			'created' => '2015-03-17 08:46:03',
			'modified' => '2015-03-17 08:46:03'
		),
	);

}
