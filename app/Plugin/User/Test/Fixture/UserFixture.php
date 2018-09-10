<?php
/* UserUser Fixture generated on: 2015-01-22 10:40:41 : 1421919641 */

/**
 * UserUserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'facebook_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 13),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 254, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'login' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'pass' => array('type' => 'string', 'null' => false, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'section_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 3),
		'pm_user' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'pm_password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'avatar_url' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 511, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'x' => array('type' => 'integer', 'null' => true, 'default' => null),
		'y' => array('type' => 'integer', 'null' => true, 'default' => null),
		'w' => array('type' => 'integer', 'null' => true, 'default' => null),
		'h' => array('type' => 'integer', 'null' => true, 'default' => null),
		'remember' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'menu' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'themed' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'permission_groups' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'failed_loginss' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'date_locked' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'email_unique' => array('column' => 'email', 'unique' => 1),
			'login_unique' => array('column' => 'login', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'facebook_id' => '0',
			'active' => 1,
			'email' => 'admin@feb.net.pl',
			'login' => 'admin',
			'pass' => '1a6747eef12c2f0b7fc6fa326a441801fff14b1e',
			'name' => 'Admin',
			'section_id' => NULL,
			'pm_user' => 'd.czyz',
			'pm_password' => 'Startowe13',
			'avatar' => 'koala_1.jpg',
			'avatar_url' => NULL,
			'x' => '160',
			'y' => '0',
			'w' => NULL,
			'h' => NULL,
			'remember' => '8bb9a0e5ca07eefd287d4f64dbff9dd9e247e1ad',
			'menu' => 1,
			'themed' => NULL,
			'permission_groups' => '{"PermissionGroup":["15"]}',
			'created' => '2009-10-30 14:09:30',
			'modified' => '2015-02-13 12:25:49',
			'failed_loginss' => '0',
			'date_locked' => NULL
		),
		array(
			'id' => '54c1f918-f2d4-428c-b5e9-0aa077ecc6b3',
			'facebook_id' => NULL,
			'active' => 1,
			'email' => 'd.czyz@febdev.pl',
			'login' => NULL,
			'pass' => '28c6fe234e0a9f685787282d499cb8ecbc00eca9',
			'name' => 'Damian',
			'section_id' => 3,
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'menu' => 1,
			'themed' => NULL,
			'permission_groups' => '{"PermissionGroup":""}',
			'created' => '2015-01-23 08:32:40',
			'modified' => '2015-01-23 08:32:40',
			'failed_loginss' => '0',
			'date_locked' => NULL
		),
		array(
			'id' => '54ca02f7-5ce0-45d6-b179-173477ecc6b3',
			'facebook_id' => NULL,
			'active' => 1,
			'email' => 'd.czyz@feb.net.pl',
			'login' => NULL,
			'pass' => '28c6fe234e0a9f685787282d499cb8ecbc00eca9',
			'name' => 'testt',
			'section_id' => NULL,
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'menu' => 1,
			'themed' => NULL,
			'permission_groups' => '{"PermissionGroup":""}',
			'created' => '2015-01-29 10:52:55',
			'modified' => '2015-01-30 13:23:01',
			'failed_loginss' => '0',
			'date_locked' => NULL
		),
		array(
			'id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'facebook_id' => NULL,
			'active' => 1,
			'email' => 'mati@feb.net.pl',
			'login' => NULL,
			'pass' => '2a80bde97875971edb9d3a83583d583171658ace',
			'name' => 'Mateusz',
			'section_id' => NULL,
			'pm_user' => 'm.rusiecki',
			'pm_password' => 'Startowe13',
			'avatar' => 'penguins.jpg',
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'menu' => 1,
			'themed' => NULL,
			'permission_groups' => '{"PermissionGroup":""}',
			'created' => '2015-02-05 09:50:58',
			'modified' => '2015-02-16 13:09:41',
			'failed_loginss' => '0',
			'date_locked' => NULL
		),
		array(
			'id' => '54d32f2a-9cb0-438e-af18-0cc877ecc6b3',
			'facebook_id' => NULL,
			'active' => 1,
			'email' => 'sekretariat@feb.net.pl',
			'login' => NULL,
			'pass' => '2a80bde97875971edb9d3a83583d583171658ace',
			'name' => 'Sekretariat',
			'section_id' => NULL,
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'menu' => 1,
			'themed' => NULL,
			'permission_groups' => '{"PermissionGroup":""}',
			'created' => '2015-02-05 09:51:54',
			'modified' => '2015-02-05 10:21:03',
			'failed_loginss' => '0',
			'date_locked' => NULL
		),
		array(
			'id' => '54e1ebbf-c17c-4eb7-b278-0a2077ecc6b3',
			'facebook_id' => NULL,
			'active' => 1,
			'email' => 'm.trzesniowski@febdev.pl',
			'login' => NULL,
			'pass' => '04acdf2b1d0984a9b3c002fdf63a68ef570d5f6c',
			'name' => 'Mateusz',
			'section_id' => NULL,
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'menu' => 1,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-02-16 14:08:15',
			'modified' => '2015-02-16 14:08:15',
			'failed_loginss' => '0',
			'date_locked' => NULL
		),
	);
}
