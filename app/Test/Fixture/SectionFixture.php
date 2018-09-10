<?php
/**
 * SectionFixture
 *
 */
class SectionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'supervisor' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => 'supervisor przełożony', 'charset' => 'utf8'),
		'project_budget_costs_uneditable' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
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
			'name' => 'Zarząd',
			'supervisor' => '552cc2f7-6540-43ed-8b29-0b3077ecc6b3',
			'project_budget_costs_uneditable' => 0,
			'created' => '0000-00-00 00:00:00',
			'modified' => '2015-04-14 09:51:11'
		),
		array(
			'id' => '2',
			'name' => 'Sekretariat',
			'supervisor' => '552cc339-f7cc-404c-9f4c-0b3077ecc6b3',
			'project_budget_costs_uneditable' => 0,
			'created' => '0000-00-00 00:00:00',
			'modified' => '2015-04-14 09:51:43'
		),
		array(
			'id' => '3',
			'name' => 'Programiści - Rzeszów',
			'supervisor' => '54eecb9c-00d8-42aa-bd07-05f5904cf98e',
			'project_budget_costs_uneditable' => 1,
			'created' => '0000-00-00 00:00:00',
			'modified' => '2015-04-16 13:15:14'
		),
		array(
			'id' => '4',
			'name' => 'Programiści - Krosno',
			'supervisor' => '552cc3b6-2908-4124-84f2-0b3077ecc6b3',
			'project_budget_costs_uneditable' => 1,
			'created' => '0000-00-00 00:00:00',
			'modified' => '2015-04-14 09:52:00'
		),
		array(
			'id' => '5',
			'name' => 'Programiści - Mielec',
			'supervisor' => '552cac82-a420-4f9f-99a1-0b3077ecc6b3',
			'project_budget_costs_uneditable' => 1,
			'created' => '0000-00-00 00:00:00',
			'modified' => '2015-04-14 09:52:12'
		),
		array(
			'id' => '6',
			'name' => 'Programiści - Zewnętrzni',
			'supervisor' => '54ca02f7-5ce0-45d6-b179-173477ecc6b3',
			'project_budget_costs_uneditable' => 1,
			'created' => '0000-00-00 00:00:00',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '7',
			'name' => 'Dział kreacji',
			'supervisor' => '552cb02a-9278-48ff-90ea-0b3077ecc6b3',
			'project_budget_costs_uneditable' => 0,
			'created' => '0000-00-00 00:00:00',
			'modified' => '2015-04-14 09:52:20'
		),
		array(
			'id' => '8',
			'name' => 'Handlowcy',
			'supervisor' => '552caf49-141c-4c62-bbfc-0b3077ecc6b3',
			'project_budget_costs_uneditable' => 0,
			'created' => '0000-00-00 00:00:00',
			'modified' => '2015-04-14 09:52:30'
		),
		array(
			'id' => '9',
			'name' => 'Marketing',
			'supervisor' => '552cc495-2928-4382-ad0b-0b3077ecc6b3',
			'project_budget_costs_uneditable' => 0,
			'created' => '0000-00-00 00:00:00',
			'modified' => '2015-04-14 09:52:56'
		),
		array(
			'id' => '10',
			'name' => 'Dział techniczny',
			'supervisor' => '54ca02f7-5ce0-45d6-b179-173477ecc6b3',
			'project_budget_costs_uneditable' => 0,
			'created' => '0000-00-00 00:00:00',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '11',
			'name' => 'Ślubowisko',
			'supervisor' => '552cac82-a420-4f9f-99a1-0b3077ecc6b3',
			'project_budget_costs_uneditable' => 0,
			'created' => '0000-00-00 00:00:00',
			'modified' => '2015-03-12 15:16:29'
		),
		array(
			'id' => '15',
			'name' => 'Dział Analiz',
			'supervisor' => '552cac82-a420-4f9f-99a1-0b3077ecc6b3',
			'project_budget_costs_uneditable' => 0,
			'created' => '2015-04-13 11:22:42',
			'modified' => '2015-04-13 11:22:42'
		),
		array(
			'id' => '16',
			'name' => 'SEO/SEM',
			'supervisor' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'project_budget_costs_uneditable' => 0,
			'created' => '2015-04-13 11:24:30',
			'modified' => '2015-04-13 11:24:30'
		),
	);

}
