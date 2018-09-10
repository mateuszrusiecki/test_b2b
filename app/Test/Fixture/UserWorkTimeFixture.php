<?php
/**
 * UserWorkTimeFixture
 *
 */
class UserWorkTimeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'year' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6),
		'month' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6),
		'user_contract_history_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'contract_summary' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'hours_worked' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6),
		'overtime' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6),
		'total_overtime' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6),
		'vacations' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6),
		'sick_leave' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6),
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
			'id' => '3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'year' => '2015',
			'month' => '2',
			'user_contract_history_id' => NULL,
			'contract_summary' => 'etat 0.5/28 <br/>etat 1.0/132 <br/>',
			'hours_worked' => '149',
			'overtime' => '15',
			'total_overtime' => '15',
			'vacations' => '7',
			'sick_leave' => '4',
			'modified' => '2015-03-19 11:39:00',
			'created' => '2015-03-13 11:50:39'
		),
		array(
			'id' => '4',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'year' => '2015',
			'month' => '3',
			'user_contract_history_id' => NULL,
			'contract_summary' => 'etat 1.0/176 <br/>',
			'hours_worked' => '60',
			'overtime' => '-118',
			'total_overtime' => '-103',
			'vacations' => '0',
			'sick_leave' => '0',
			'modified' => '2015-03-31 15:29:50',
			'created' => '2015-03-13 11:56:37'
		),
		array(
			'id' => '5',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'year' => '2015',
			'month' => '2',
			'user_contract_history_id' => NULL,
			'contract_summary' => '',
			'hours_worked' => '117',
			'overtime' => '117',
			'total_overtime' => '117',
			'vacations' => '0',
			'sick_leave' => '0',
			'modified' => '2015-03-19 11:39:01',
			'created' => '2015-03-19 11:39:01'
		),
		array(
			'id' => '6',
			'user_id' => '54eecb9c-00d8-42aa-bd07-05f5904cf98e',
			'year' => '2015',
			'month' => '2',
			'user_contract_history_id' => NULL,
			'contract_summary' => '',
			'hours_worked' => '0',
			'overtime' => '0',
			'total_overtime' => '0',
			'vacations' => '0',
			'sick_leave' => '0',
			'modified' => '2015-03-19 11:39:01',
			'created' => '2015-03-19 11:39:01'
		),
		array(
			'id' => '7',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'year' => '2015',
			'month' => '3',
			'user_contract_history_id' => NULL,
			'contract_summary' => 'etat 1/2/176 <br/>',
			'hours_worked' => '20',
			'overtime' => '-156',
			'total_overtime' => '-39',
			'vacations' => '0',
			'sick_leave' => '0',
			'modified' => '2015-03-20 09:51:17',
			'created' => '2015-03-19 12:48:31'
		),
		array(
			'id' => '8',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'year' => '2015',
			'month' => '4',
			'user_contract_history_id' => NULL,
			'contract_summary' => 'nowy etat 3/4',
			'hours_worked' => '0',
			'overtime' => '0',
			'total_overtime' => '-103',
			'vacations' => '0',
			'sick_leave' => '0',
			'modified' => '2015-04-29 09:11:39',
			'created' => '2015-04-03 09:31:49'
		),
		array(
			'id' => '9',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'year' => '2015',
			'month' => '5',
			'user_contract_history_id' => NULL,
			'contract_summary' => 'nowy etat 3/4',
			'hours_worked' => '0',
			'overtime' => '0',
			'total_overtime' => '-103',
			'vacations' => '0',
			'sick_leave' => '0',
			'modified' => '2015-05-13 10:28:20',
			'created' => '2015-05-05 08:53:03'
		),
	);

}
