<?php
/**
 * ProjectContactPeopleFixture
 *
 */
class ProjectContactPeopleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_project_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'client_contact_id' => array('type' => 'integer', 'null' => false, 'default' => null),
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
			'client_project_id' => '29',
			'client_contact_id' => '5'
		),
		array(
			'id' => '2',
			'client_project_id' => '29',
			'client_contact_id' => '1'
		),
		array(
			'id' => '3',
			'client_project_id' => '30',
			'client_contact_id' => '5'
		),
		array(
			'id' => '4',
			'client_project_id' => '30',
			'client_contact_id' => '1'
		),
		array(
			'id' => '6',
			'client_project_id' => '32',
			'client_contact_id' => '1'
		),
		array(
			'id' => '7',
			'client_project_id' => '45',
			'client_contact_id' => '5'
		),
		array(
			'id' => '8',
			'client_project_id' => '45',
			'client_contact_id' => '1'
		),
		array(
			'id' => '9',
			'client_project_id' => '46',
			'client_contact_id' => '5'
		),
		array(
			'id' => '10',
			'client_project_id' => '46',
			'client_contact_id' => '1'
		),
		array(
			'id' => '11',
			'client_project_id' => '47',
			'client_contact_id' => '1'
		),
	);

}
