<?php
/**
 * ProjectFileCategoryFixture
 *
 */
class ProjectFileCategoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_accessible' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
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
			'id' => '1',
			'name' => 'Inne',
			'slug' => 'inne',
			'user_accessible' => '1'
		),
		array(
			'id' => '2',
			'name' => 'Inne hand.',
			'slug' => 'inne_hand',
			'user_accessible' => '0'
		),
		array(
			'id' => '3',
			'name' => 'Brief',
			'slug' => 'brief',
			'user_accessible' => '1'
		),
		array(
			'id' => '4',
			'name' => 'Wycena',
			'slug' => 'wycena',
			'user_accessible' => '0'
		),
		array(
			'id' => '5',
			'name' => 'Oferta',
			'slug' => 'oferta',
			'user_accessible' => '1'
		),
		array(
			'id' => '6',
			'name' => 'Umowa',
			'slug' => 'umowa',
			'user_accessible' => '0'
		),
		array(
			'id' => '7',
			'name' => 'FV',
			'slug' => 'fv',
			'user_accessible' => '0'
		),
		array(
			'id' => '8',
			'name' => 'Protokół odbioru',
			'slug' => 'protokol_odbioru',
			'user_accessible' => '0'
		),
		array(
			'id' => '9',
			'name' => 'Makieta',
			'slug' => 'makieta',
			'user_accessible' => '1'
		),
		array(
			'id' => '10',
			'name' => 'Makieta',
			'slug' => 'makieta',
			'user_accessible' => '1'
		),
	);

}
