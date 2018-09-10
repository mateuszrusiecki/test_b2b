<?php
/**
 * ClientProjectDomainFixture
 *
 */
class ClientProjectDomainFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'project_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'client_domain_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'project_id' => array('column' => 'project_id', 'unique' => 0),
			'clinet_domain_id' => array('column' => 'client_domain_id', 'unique' => 0)
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
			'id' => '4',
			'project_id' => '12',
			'client_domain_id' => '1'
		),
		array(
			'id' => '5',
			'project_id' => '12',
			'client_domain_id' => '3'
		),
		array(
			'id' => '11',
			'project_id' => '12',
			'client_domain_id' => '49'
		),
		array(
			'id' => '12',
			'project_id' => '12',
			'client_domain_id' => '50'
		),
		array(
			'id' => '14',
			'project_id' => '8',
			'client_domain_id' => '49'
		),
		array(
			'id' => '15',
			'project_id' => '12',
			'client_domain_id' => '51'
		),
		array(
			'id' => '16',
			'project_id' => '13',
			'client_domain_id' => '52'
		),
		array(
			'id' => '17',
			'project_id' => '10',
			'client_domain_id' => '50'
		),
		array(
			'id' => '18',
			'project_id' => '5',
			'client_domain_id' => '1'
		),
		array(
			'id' => '19',
			'project_id' => '16',
			'client_domain_id' => '51'
		),
	);

}
