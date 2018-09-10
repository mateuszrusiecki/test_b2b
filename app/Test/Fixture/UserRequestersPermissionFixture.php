<?php
/* UserRequestersPermission Fixture generated on: 2015-01-22 15:05:27 : 1421935527 */

/**
 * UserRequestersPermissionFixture
 *
 */
class UserRequestersPermissionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'permission_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'model' => array('type' => 'string', 'null' => false, 'default' => 'Group', 'length' => 40, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'row_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'requester_permission' => array('column' => array('permission_id', 'model', 'row_id'), 'unique' => 1),
			'permission_id' => array('column' => 'permission_id', 'unique' => 0),
			'model_row_id' => array('column' => array('model', 'row_id'), 'unique' => 0)
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
			'id' => '50645277-f0f0-4be8-98fb-125c77ecc6b3',
			'permission_id' => '502caaff-dd9c-407b-a2c6-127077ecc6b3',
			'model' => 'User',
			'row_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'created' => '2012-09-27 15:19:51',
			'modified' => '2012-09-27 15:19:51'
		),
		array(
			'id' => '50645283-0b7c-4bc5-908e-125c77ecc6b3',
			'permission_id' => '502ca99d-7034-4bf9-9f20-127077ecc6b3',
			'model' => 'Group',
			'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'created' => '2012-09-27 15:20:03',
			'modified' => '2012-09-27 15:20:03'
		),
		array(
			'id' => '50645283-18fc-4197-b191-125c77ecc6b3',
			'permission_id' => '502ca99c-1a48-4087-b75f-127077ecc6b3',
			'model' => 'Group',
			'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'created' => '2012-09-27 15:20:03',
			'modified' => '2012-09-27 15:20:03'
		),
		array(
			'id' => '50645283-2c18-4a05-86d3-125c77ecc6b3',
			'permission_id' => '502ca9a0-2cb0-4327-9877-127077ecc6b3',
			'model' => 'Group',
			'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'created' => '2012-09-27 15:20:03',
			'modified' => '2012-09-27 15:20:03'
		),
		array(
			'id' => '50645283-3e2c-4287-921b-125c77ecc6b3',
			'permission_id' => '4f59d637-5974-40fa-b213-057077ecc6b3',
			'model' => 'Group',
			'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'created' => '2012-09-27 15:20:03',
			'modified' => '2012-09-27 15:20:03'
		),
		array(
			'id' => '50645283-3e60-46bd-9cf7-125c77ecc6b3',
			'permission_id' => '502ca9a4-9f84-44ac-8c78-127077ecc6b3',
			'model' => 'Group',
			'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'created' => '2012-09-27 15:20:03',
			'modified' => '2012-09-27 15:20:03'
		),
		array(
			'id' => '50645283-72dc-4f14-9bc2-125c77ecc6b3',
			'permission_id' => '502ca9a1-6d18-4e2d-a8e3-127077ecc6b3',
			'model' => 'Group',
			'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'created' => '2012-09-27 15:20:03',
			'modified' => '2012-09-27 15:20:03'
		),
		array(
			'id' => '50645283-9fac-40b8-a7ad-125c77ecc6b3',
			'permission_id' => '502ca99b-cb98-4ef7-a4a8-127077ecc6b3',
			'model' => 'Group',
			'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'created' => '2012-09-27 15:20:03',
			'modified' => '2012-09-27 15:20:03'
		),
		array(
			'id' => '50645283-b858-412c-92f4-125c77ecc6b3',
			'permission_id' => '502ca9a2-4f84-46d1-8053-127077ecc6b3',
			'model' => 'Group',
			'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'created' => '2012-09-27 15:20:03',
			'modified' => '2012-09-27 15:20:03'
		),
		array(
			'id' => '50645283-bb18-4dec-82ab-125c77ecc6b3',
			'permission_id' => '502ca9bc-aa1c-43a3-993d-127077ecc6b3',
			'model' => 'Group',
			'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'created' => '2012-09-27 15:20:03',
			'modified' => '2012-09-27 15:20:03'
		),
	);
}
