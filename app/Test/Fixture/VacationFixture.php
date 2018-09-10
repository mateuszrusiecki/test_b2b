<?php
/**
 * VacationFixture
 *
 */
class VacationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'vacation_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'rodzaj urlopu'),
		'time_start' => array('type' => 'time', 'null' => true, 'default' => null),
		'time_end' => array('type' => 'time', 'null' => true, 'default' => null),
		'private_time' => array('type' => 'time', 'null' => true, 'default' => null),
		'date_start' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'dzień od'),
		'date_end' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'dzień do'),
		'hour_start' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'godzina od'),
		'hour_end' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'godzina do'),
		'vacation_status_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'status urlopu'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'test' => array('type' => 'time', 'null' => true, 'default' => null),
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
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'vacation_type_id' => '1',
			'time_start' => '08:00:00',
			'time_end' => '10:30:00',
			'private_time' => NULL,
			'date_start' => '2015-02-25',
			'date_end' => '2015-02-26',
			'hour_start' => '8',
			'hour_end' => '16',
			'vacation_status_id' => '1',
			'modified' => '2015-02-04 16:02:25',
			'created' => '2015-02-02 00:00:00',
			'test' => NULL
		),
		array(
			'id' => '2',
			'user_id' => '54c10ad6-c888-49c2-afd8-106077ecc6b3',
			'vacation_type_id' => '1',
			'time_start' => NULL,
			'time_end' => NULL,
			'private_time' => NULL,
			'date_start' => '2014-11-25',
			'date_end' => '2014-12-05',
			'hour_start' => '8',
			'hour_end' => '16',
			'vacation_status_id' => '1',
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00',
			'test' => NULL
		),
		array(
			'id' => '3',
			'user_id' => '54c10ad6-c888-49c2-afd8-106077ecc6b3',
			'vacation_type_id' => '2',
			'time_start' => NULL,
			'time_end' => NULL,
			'private_time' => NULL,
			'date_start' => '2015-02-25',
			'date_end' => '2015-02-25',
			'hour_start' => '9',
			'hour_end' => '12',
			'vacation_status_id' => '1',
			'modified' => '2015-02-02 00:00:00',
			'created' => '2015-02-02 00:00:00',
			'test' => NULL
		),
		array(
			'id' => '23',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'vacation_type_id' => '1',
			'time_start' => NULL,
			'time_end' => NULL,
			'private_time' => NULL,
			'date_start' => '2015-02-11',
			'date_end' => '2015-02-13',
			'hour_start' => '9',
			'hour_end' => '12',
			'vacation_status_id' => '1',
			'modified' => '2015-02-05 10:23:27',
			'created' => '2015-02-04 09:55:18',
			'test' => NULL
		),
		array(
			'id' => '27',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'vacation_type_id' => '2',
			'time_start' => NULL,
			'time_end' => NULL,
			'private_time' => NULL,
			'date_start' => '2015-02-23',
			'date_end' => '2015-02-23',
			'hour_start' => '10',
			'hour_end' => '13',
			'vacation_status_id' => '4',
			'modified' => '2015-02-04 14:57:32',
			'created' => '2015-02-04 14:57:32',
			'test' => NULL
		),
		array(
			'id' => '92',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'vacation_type_id' => '6',
			'time_start' => NULL,
			'time_end' => NULL,
			'private_time' => NULL,
			'date_start' => '2015-02-17',
			'date_end' => '2015-02-20',
			'hour_start' => '8',
			'hour_end' => '16',
			'vacation_status_id' => '1',
			'modified' => '2015-02-27 14:15:11',
			'created' => '2015-02-12 12:45:13',
			'test' => NULL
		),
		array(
			'id' => '104',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'vacation_type_id' => '5',
			'time_start' => NULL,
			'time_end' => NULL,
			'private_time' => '00:00:00',
			'date_start' => '2015-02-24',
			'date_end' => '2015-02-27',
			'hour_start' => '8',
			'hour_end' => '16',
			'vacation_status_id' => '4',
			'modified' => '2015-03-20 09:00:35',
			'created' => '2015-02-16 15:42:33',
			'test' => NULL
		),
		array(
			'id' => '106',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'vacation_type_id' => '2',
			'time_start' => NULL,
			'time_end' => NULL,
			'private_time' => NULL,
			'date_start' => '2015-02-20',
			'date_end' => '2015-02-20',
			'hour_start' => '8',
			'hour_end' => '10',
			'vacation_status_id' => '4',
			'modified' => '2015-02-24 15:06:33',
			'created' => '2015-02-24 15:06:33',
			'test' => NULL
		),
		array(
			'id' => '107',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'vacation_type_id' => '6',
			'time_start' => '08:30:00',
			'time_end' => '10:30:00',
			'private_time' => NULL,
			'date_start' => '2015-07-08',
			'date_end' => '2015-07-09',
			'hour_start' => '8',
			'hour_end' => '16',
			'vacation_status_id' => '4',
			'modified' => '2015-02-25 15:29:14',
			'created' => '2015-02-25 15:01:58',
			'test' => NULL
		),
		array(
			'id' => '108',
			'user_id' => '552cc378-f53c-4f26-b2b5-0b3077ecc6b3',
			'vacation_type_id' => '9',
			'time_start' => NULL,
			'time_end' => NULL,
			'private_time' => NULL,
			'date_start' => '2015-07-26',
			'date_end' => '2015-07-28',
			'hour_start' => '8',
			'hour_end' => '16',
			'vacation_status_id' => '4',
			'modified' => '2015-02-25 15:11:13',
			'created' => '2015-02-25 15:11:13',
			'test' => NULL
		),
            
                array(
			'id' => '112',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'vacation_type_id' => '9',
			'time_start' => NULL,
			'time_end' => NULL,
			'private_time' => NULL,
			'date_start' => '2015-07-26',
			'date_end' => '2015-07-28',
			'hour_start' => '8',
			'hour_end' => '16',
			'vacation_status_id' => '4',
			'modified' => '2015-02-25 15:11:13',
			'created' => '2015-02-25 15:11:13',
			'test' => NULL
		),
	);

}
