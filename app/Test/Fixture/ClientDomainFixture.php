<?php
/**
 * ClientDomainFixture
 *
 */
class ClientDomainFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'domain' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'client_id' => array('column' => 'client_id', 'unique' => 0)
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
			'client_id' => '1',
			'domain' => 'www.cototakie.pl'
		),
		array(
			'id' => '3',
			'client_id' => '1',
			'domain' => 'www.test.pl'
		),
		array(
			'id' => '5',
			'client_id' => '1',
			'domain' => 'www.example.pl'
		),
		array(
			'id' => '48',
			'client_id' => '1',
			'domain' => 'www.artklon-materace.pl'
		),
		array(
			'id' => '49',
			'client_id' => '1',
			'domain' => 'fff3f.pl'
		),
		array(
			'id' => '50',
			'client_id' => '1',
			'domain' => 'ffff2.pl'
		),
		array(
			'id' => '51',
			'client_id' => '1',
			'domain' => 'example888.pl'
		),
		array(
			'id' => '52',
			'client_id' => '8',
			'domain' => 'reklamadron.pl'
		),
		array(
			'id' => '53',
			'client_id' => '14',
			'domain' => 'domena.pl'
		),
		array(
			'id' => '54',
			'client_id' => '1',
			'domain' => 'fffjjf.pl'
		),
	);

}
