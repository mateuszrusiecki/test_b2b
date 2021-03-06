<?php
/**
 * UserUsersFixture
 *
 */
class UserUsersFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 254, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'pass' => array('type' => 'string', 'null' => true, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'pm_user' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'pm_password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'avatar_url' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 511, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'x' => array('type' => 'integer', 'null' => true, 'default' => null),
		'y' => array('type' => 'integer', 'null' => true, 'default' => null),
		'w' => array('type' => 'integer', 'null' => true, 'default' => null),
		'h' => array('type' => 'integer', 'null' => true, 'default' => null),
		'remember' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'themed' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'permission_groups' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'role' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'email_unique' => array('column' => 'email', 'unique' => 1)
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
			'active' => 1,
			'email' => 'admin@feb.net.pl',
			'pass' => '1a6747eef12c2f0b7fc6fa326a441801fff14b1e',
			'pm_user' => 'm.rusiecki',
			'pm_password' => 'Startowe13',
			'avatar' => '',
			'avatar_url' => 'http://upload.wikimedia.org/wikipedia/commons/4/49/Koala_climbing_tree.jpg',
			'x' => '160',
			'y' => '0',
			'w' => NULL,
			'h' => NULL,
			'remember' => '8bb9a0e5ca07eefd287d4f64dbff9dd9e247e1ad',
			'themed' => NULL,
			'permission_groups' => '{"PermissionGroup":["15"]}',
			'created' => '2015-05-19 12:44:17',
			'modified' => '2015-05-20 08:13:54',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
			'active' => 1,
			'email' => 'a.zybura@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-28 13:18:48',
			'modified' => '2015-05-28 13:18:48',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '55680242-25c8-4e5d-ae5b-1f54904cf98e',
			'active' => 1,
			'email' => 'w.janowska@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 06:08:02',
			'modified' => '2015-06-01 08:18:19',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '55680635-a4cc-4d31-ada1-226b904cf98e',
			'active' => 1,
			'email' => 'm.zaborowski@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 06:24:53',
			'modified' => '2015-05-29 07:00:07',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'active' => 1,
			'email' => 'a.pieczonka@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 07:02:43',
			'modified' => '2015-05-29 07:04:14',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'active' => 1,
			'email' => 's.horoszko@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 07:08:27',
			'modified' => '2015-05-29 07:17:24',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '556816d3-f994-4840-80be-3202904cf98e',
			'active' => 1,
			'email' => 'm.rudzik@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 07:35:47',
			'modified' => '2015-05-29 07:36:57',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '55681809-6488-46a0-a94e-337c904cf98e',
			'active' => 1,
			'email' => 's.chlebek@febdev.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 07:40:57',
			'modified' => '2015-05-29 07:41:49',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '556818c0-6fdc-4800-8492-33e7904cf98e',
			'active' => 1,
			'email' => 'a.dziki@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 07:44:00',
			'modified' => '2015-06-01 11:01:21',
			'role' => 'client',
			'status' => 1
		),
		array(
			'id' => '55682053-6b8c-4207-b15c-3a2f904cf98e',
			'active' => 1,
			'email' => 'a.panczak@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 08:16:19',
			'modified' => '2015-05-29 08:18:55',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '556821f0-e7d4-40f1-8245-3c4a904cf98e',
			'active' => 1,
			'email' => 'm.zych@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 08:23:12',
			'modified' => '2015-05-29 08:30:21',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '55682f05-5770-4952-af27-472c904cf98e',
			'active' => 1,
			'email' => 'p.kazimirowicz@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 09:19:01',
			'modified' => '2015-05-29 09:22:52',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '556833c7-72ec-46b0-829e-4c4a904cf98e',
			'active' => 1,
			'email' => 'd.sadleja@feb.net.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-05-29 09:39:19',
			'modified' => '2015-05-29 10:38:18',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '556c2c78-0c60-4129-8bb8-2b40904cf98e',
			'active' => 1,
			'email' => 'm.rusiecki@febdev.pl',
			'pass' => 'b80941f452e2ffec0802c93e05920a7d9e838689',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-06-01 09:57:12',
			'modified' => '2015-06-01 10:31:46',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '556c37e0-ea08-4001-8b6f-3746904cf98e',
			'active' => 1,
			'email' => 'd.czyz@febdev.pl',
			'pass' => '',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-06-01 10:45:52',
			'modified' => '2015-06-01 10:45:52',
			'role' => 'manager',
			'status' => 1
		),
		array(
			'id' => '556c393f-6d34-42b4-9b0d-37fd904cf98e',
			'active' => 1,
			'email' => 'j.kolek@febdev.pl',
			'pass' => '',
			'pm_user' => NULL,
			'pm_password' => NULL,
			'avatar' => NULL,
			'avatar_url' => NULL,
			'x' => NULL,
			'y' => NULL,
			'w' => NULL,
			'h' => NULL,
			'remember' => NULL,
			'themed' => NULL,
			'permission_groups' => NULL,
			'created' => '2015-06-01 10:51:43',
			'modified' => '2015-06-01 11:00:42',
			'role' => 'manager',
			'status' => 1
		),
	);

}
