<?php
/* BriefQuestion Fixture generated on: 2015-06-11 13:16:28 : 1434028588 */

/**
 * BriefQuestionFixture
 *
 */
class BriefQuestionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'brief_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'group_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'category_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'kategoria pytania - należy do grupy', 'charset' => 'utf8'),
		'default' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'może to sie przyda'),
		'content' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'id' => 1,
			'brief_id' => 1,
			'group_name' => 'Lorem ipsum dolor sit amet',
			'category_name' => 'Lorem ipsum dolor sit amet',
			'default' => 1,
			'content' => 'Lorem ipsum dolor sit amet',
			'created' => '2015-06-11 13:16:28',
			'modified' => '2015-06-11 13:16:28'
		),
	);
}
