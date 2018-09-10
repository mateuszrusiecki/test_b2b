<?php
/**
 * ClientContactClientLeadFixture
 *
 */
class ClientContactClientLeadFixture extends CakeTestFixture {


/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_lead_id' => array('type' => 'integer', 'null' => false, 'default' => null),
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
			'id' => '13',
			'client_lead_id' => '6',
			'client_contact_id' => '5'
		),
		array(
			'id' => '15',
			'client_lead_id' => '7',
			'client_contact_id' => '10'
		),
		array(
			'id' => '17',
			'client_lead_id' => '1',
			'client_contact_id' => '5'
		),
	);

}
