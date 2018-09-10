<?php
/* UserPermissionCategory Fixture generated on: 2015-01-22 10:42:20 : 1421919740 */

/**
 * UserPermissionCategoryFixture
 *
 */
class UserPermissionCategoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'id' => '8',
			'name' => 'Zarządzanie stronami',
			'modified' => '2012-03-09 10:50:40',
			'created' => '2012-03-09 10:50:40'
		),
		array(
			'id' => '9',
			'name' => 'Zarządzanie menu',
			'modified' => '2012-03-09 10:50:46',
			'created' => '2012-03-09 10:50:46'
		),
		array(
			'id' => '10',
			'name' => 'Zarządzanie użytkownikami',
			'modified' => '2012-03-09 10:50:53',
			'created' => '2012-03-09 10:50:53'
		),
		array(
			'id' => '12',
			'name' => 'Ustawienia',
			'modified' => '2012-03-09 15:42:50',
			'created' => '2012-03-09 15:42:50'
		),
		array(
			'id' => '13',
			'name' => 'Galerie',
			'modified' => '2012-03-09 15:43:47',
			'created' => '2012-03-09 15:43:35'
		),
		array(
			'id' => '15',
			'name' => 'Dostęp do CMS',
			'modified' => '2012-09-27 15:14:51',
			'created' => '2012-09-27 15:14:51'
		),
	);
}
