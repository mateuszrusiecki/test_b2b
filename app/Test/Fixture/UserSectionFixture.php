<?php
/**
 * UserSectionFixture
 *
 */
class UserSectionFixture extends CakeTestFixture {


/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'section_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'id' => '15',
			'user_id' => '54ca02f7-5ce0-45d6-b179-173477ecc6b3',
			'section_id' => '3',
			'created' => '0000-00-00 00:00:00',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '16',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'section_id' => '3',
			'created' => '0000-00-00 00:00:00',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '21',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'section_id' => '11',
			'created' => '0000-00-00 00:00:00',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '22',
			'user_id' => '54e1ebbf-c17c-4eb7-b278-0a2077ecc6b3',
			'section_id' => '3',
			'created' => '0000-00-00 00:00:00',
			'modified' => '0000-00-00 00:00:00'
		),
	);

}
