<?php
/**
 * HrSettingFixture
 *
 */
class HrSettingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'margin' => array('type' => 'integer', 'null' => true, 'default' => null),
		'buffer' => array('type' => 'integer', 'null' => true, 'default' => null),
		'it_rate' => array('type' => 'integer', 'null' => true, 'default' => null),
		'hostname' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'username' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'id' => '3',
			'margin' => '35',
			'buffer' => '15',
			'it_rate' => '49',
			'hostname' => '{smtp.gmail.com:110/pop3/novalidate-cert}INBOX',
			'username' => 'b2b@feb.net.pl',
			'password' => 'i2aWQsj0'
		),
	);

}
