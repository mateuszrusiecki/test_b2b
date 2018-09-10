<?php
/* UserPermission Fixture generated on: 2015-01-22 10:42:06 : 1421919726 */

/**
 * UserPermissionFixture
 *
 */
class UserPermissionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 80, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'permission_group_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'name' => array('column' => 'name', 'unique' => 1),
			'permission_group_id' => array('column' => 'permission_group_id', 'unique' => 0)
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
			'id' => '4f59d387-df7c-4344-b3af-057077ecc6b3',
			'name' => 'User:admin:users:index',
			'permission_group_id' => '1',
			'created' => '2012-03-09 10:55:19',
			'modified' => '2012-03-09 10:55:19'
		),
		array(
			'id' => '4f59d38c-6d00-4a21-8b16-057077ecc6b3',
			'name' => 'User:admin:users:view',
			'permission_group_id' => '1',
			'created' => '2012-03-09 10:55:24',
			'modified' => '2012-03-09 10:55:24'
		),
		array(
			'id' => '4f59d392-bff0-4511-8e28-057077ecc6b3',
			'name' => 'User:admin:users:add',
			'permission_group_id' => '9',
			'created' => '2012-03-09 10:55:30',
			'modified' => '2012-08-16 10:13:42'
		),
		array(
			'id' => '4f59d398-8c90-4a64-a1c6-057077ecc6b3',
			'name' => 'User:admin:users:edit',
			'permission_group_id' => '1',
			'created' => '2012-03-09 10:55:36',
			'modified' => '2012-03-09 10:55:36'
		),
		array(
			'id' => '4f59d3ac-0a4c-45f6-a349-057077ecc6b3',
			'name' => 'User:admin:users:delete',
			'permission_group_id' => '2',
			'created' => '2012-03-09 10:55:56',
			'modified' => '2012-03-09 10:55:56'
		),
		array(
			'id' => '4f59d630-ce10-4d64-8e07-057077ecc6b3',
			'name' => 'Page:admin:pages:edit',
			'permission_group_id' => '6',
			'created' => '2012-03-09 11:06:40',
			'modified' => '2012-03-09 13:14:11'
		),
		array(
			'id' => '4f59d637-5974-40fa-b213-057077ecc6b3',
			'name' => 'Page:admin:pages:add',
			'permission_group_id' => '5',
			'created' => '2012-03-09 11:06:47',
			'modified' => '2012-03-09 13:22:38'
		),
		array(
			'id' => '4f59d63b-17e0-4385-9277-057077ecc6b3',
			'name' => 'Page:admin:pages:delete',
			'permission_group_id' => '7',
			'created' => '2012-03-09 11:06:51',
			'modified' => '2012-08-16 10:14:31'
		),
		array(
			'id' => '4f59d694-6ab8-44aa-bc0c-057077ecc6b3',
			'name' => 'Menu:admin:menus:index',
			'permission_group_id' => '3',
			'created' => '2012-03-09 11:08:20',
			'modified' => '2012-03-09 11:08:20'
		),
		array(
			'id' => '4f59d699-3c1c-4a5f-974a-057077ecc6b3',
			'name' => 'Menu:admin:menus:relatedindex',
			'permission_group_id' => '3',
			'created' => '2012-03-09 11:08:25',
			'modified' => '2012-03-09 11:08:25'
		),
	);
}
