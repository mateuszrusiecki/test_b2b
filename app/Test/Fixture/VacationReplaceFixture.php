<?php
/**
 * VacationReplaceFixture
 *
 */
class VacationReplaceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'vacation_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'project_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'no_project' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'bez projektu'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'id' => '28',
			'vacation_id' => '1',
			'user_id' => '54c1f918-f2d4-428c-b5e9-0aa077ecc6b3',
			'project_id' => '2',
			'no_project' => 0,
			'modified' => '2015-02-12 08:51:39',
			'created' => '2015-02-12 08:51:39'
		),
		array(
			'id' => '29',
			'vacation_id' => '88',
			'user_id' => '54c10ad6-c888-49c2-afd8-106077ecc6b3',
			'project_id' => '3',
			'no_project' => 0,
			'modified' => '2015-02-12 08:51:39',
			'created' => '2015-02-12 08:51:39'
		),
		array(
			'id' => '30',
			'vacation_id' => '88',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'project_id' => '0',
			'no_project' => 1,
			'modified' => '2015-02-12 08:51:39',
			'created' => '2015-02-12 08:51:39'
		),
		array(
			'id' => '31',
			'vacation_id' => '89',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'project_id' => '0',
			'no_project' => 1,
			'modified' => '2015-02-12 11:22:20',
			'created' => '2015-02-12 11:22:20'
		),
		array(
			'id' => '32',
			'vacation_id' => '90',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'project_id' => '0',
			'no_project' => 1,
			'modified' => '2015-02-12 11:24:04',
			'created' => '2015-02-12 11:24:04'
		),
		array(
			'id' => '33',
			'vacation_id' => '91',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'project_id' => '0',
			'no_project' => 1,
			'modified' => '2015-02-12 11:26:54',
			'created' => '2015-02-12 11:26:54'
		),
		array(
			'id' => '76',
			'vacation_id' => '93',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'project_id' => '1',
			'no_project' => 0,
			'modified' => '2015-02-12 15:04:21',
			'created' => '2015-02-12 15:04:21'
		),
		array(
			'id' => '77',
			'vacation_id' => '93',
			'user_id' => '54c10ad6-c888-49c2-afd8-106077ecc6b3',
			'project_id' => '1',
			'no_project' => 0,
			'modified' => '2015-02-12 15:04:21',
			'created' => '2015-02-12 15:04:21'
		),
		array(
			'id' => '125',
			'vacation_id' => '94',
			'user_id' => '54c1f918-f2d4-428c-b5e9-0aa077ecc6b3',
			'project_id' => '2',
			'no_project' => 0,
			'modified' => '2015-02-13 09:18:05',
			'created' => '2015-02-13 09:18:05'
		),
		array(
			'id' => '126',
			'vacation_id' => '94',
			'user_id' => '54c1f918-f2d4-428c-b5e9-0aa077ecc6b3',
			'project_id' => '1',
			'no_project' => 0,
			'modified' => '2015-02-13 09:18:05',
			'created' => '2015-02-13 09:18:05'
		),
	);

}
