<?php
/**
 * ClientNoteFixture
 *
 */
class ClientNoteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'id' => '6',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'title' => 'Testowa nowa notatka',
			'content' => 'TEST',
			'created' => '2015-02-27 09:32:43',
			'modified' => '2015-02-27 09:32:43'
		),
		array(
			'id' => '12',
			'client_id' => '9',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'title' => 'test77777777',
			'content' => '<p>llllll</p>',
			'created' => '2015-03-03 12:35:23',
			'modified' => '2015-03-03 12:35:23'
		),
		array(
			'id' => '13',
			'client_id' => '9',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'title' => 'kuku',
			'content' => '<p>iiiji</p>',
			'created' => '2015-03-03 14:36:24',
			'modified' => '2015-03-03 14:36:24'
		),
		array(
			'id' => '14',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'title' => 'test',
			'content' => 'jtest

enter test


2 entery test',
			'created' => '2015-03-16 11:58:57',
			'modified' => '2015-03-16 11:58:57'
		),
		array(
			'id' => '15',
			'client_id' => '17',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'title' => 'hhk',
			'content' => 'hihh',
			'created' => '2015-03-19 13:59:20',
			'modified' => '2015-03-19 13:59:20'
		),
	);

}
