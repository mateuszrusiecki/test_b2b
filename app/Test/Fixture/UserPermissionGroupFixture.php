<?php
/* UserPermissionGroup Fixture generated on: 2015-01-22 10:42:31 : 1421919751 */

/**
 * UserPermissionGroupFixture
 *
 */
class UserPermissionGroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'permission_category_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'permission_category_id' => array('column' => 'permission_category_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'name' => 'Administracja użytkownikiem',
			'permission_category_id' => '10',
			'modified' => '2012-03-09 10:52:05',
			'created' => '2012-03-09 10:51:10'
		),
		array(
			'id' => '2',
			'name' => 'Usuwanie użytkowników',
			'permission_category_id' => '10',
			'modified' => '2012-03-09 10:51:20',
			'created' => '2012-03-09 10:51:20'
		),
		array(
			'id' => '3',
			'name' => 'Administracja menu',
			'permission_category_id' => '9',
			'modified' => '2012-03-09 10:52:19',
			'created' => '2012-03-09 10:52:19'
		),
		array(
			'id' => '5',
			'name' => 'Dodawanie podstron',
			'permission_category_id' => '8',
			'modified' => '2012-03-09 10:54:48',
			'created' => '2012-03-09 10:52:47'
		),
		array(
			'id' => '6',
			'name' => 'Edycja podstron',
			'permission_category_id' => '8',
			'modified' => '2012-03-09 10:54:41',
			'created' => '2012-03-09 10:52:53'
		),
		array(
			'id' => '7',
			'name' => 'Usuwanie podstron',
			'permission_category_id' => '8',
			'modified' => '2012-03-09 10:53:02',
			'created' => '2012-03-09 10:53:02'
		),
		array(
			'id' => '9',
			'name' => 'Dodawanie użytkowników',
			'permission_category_id' => '10',
			'modified' => '2012-03-09 15:41:19',
			'created' => '2012-03-09 15:41:19'
		),
		array(
			'id' => '20',
			'name' => 'Administracja podstronami',
			'permission_category_id' => '8',
			'modified' => '2012-08-16 10:22:48',
			'created' => '2012-08-16 10:22:48'
		),
		array(
			'id' => '15',
			'name' => 'Edycja uprawnień',
			'permission_category_id' => '12',
			'modified' => '2012-03-09 15:51:02',
			'created' => '2012-03-09 15:51:02'
		),
		array(
			'id' => '12',
			'name' => 'Usuwanie zdjęć z galerii',
			'permission_category_id' => '13',
			'modified' => '2012-03-09 15:44:28',
			'created' => '2012-03-09 15:44:28'
		),
	);
}
