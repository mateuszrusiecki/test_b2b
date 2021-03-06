<?php
/**
 * UserContractHistoryFixture
 *
 */
class UserContractHistoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'state' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Etat', 'charset' => 'utf8'),
		'working_time' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 8, 'collate' => 'utf8_general_ci', 'comment' => 'wymiar czasu pracy', 'charset' => 'utf8'),
		'position' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Stanowisko', 'charset' => 'utf8'),
		'salary' => array('type' => 'binary', 'null' => true, 'default' => null, 'comment' => 'Wynagrodzenie'),
		'salary_net' => array('type' => 'binary', 'null' => true, 'default' => null, 'comment' => 'wynagrodzenie netto'),
		'hourly_rate' => array('type' => 'binary', 'null' => false, 'default' => null),
		'employment_start' => array('type' => 'date', 'null' => false, 'default' => null, 'comment' => 'czas trwania umowy od'),
		'employment_end' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'czas trwania umowy do'),
		'vacation_days' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6, 'comment' => 'dni urlopu rocznie'),
		'vacation_available' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6),
		'period_of_employment' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Okres zatrudnienia', 'charset' => 'utf8'),
		'right_to_pension' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => 'Prawo do renty / emerytury'),
		'unemployed' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => 'Bezrobotny / student'),
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
			'id' => '32',
			'user_id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Prac. marketingu',
			'salary' => NULL, //�-;',
			'salary_net' => NULL, //P��m',
			'hourly_rate' => 'ɬ',
			'employment_start' => '2015-01-01',
			'employment_end' => '2015-09-03',
			'vacation_days' => '24',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-05-28 13:19:28',
			'modified' => '2015-05-28 13:19:28'
		),
		array(
			'id' => '33',
			'user_id' => '55680635-a4cc-4d31-ada1-226b904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Kierownik Marketingu',
			'salary' => NULL, //�P^',
			'salary_net' => NULL, //�@' . "\0" . '�',
			'hourly_rate' => 'PI',
			'employment_start' => '2015-01-01',
			'employment_end' => NULL,
			'vacation_days' => '26',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-05-29 06:25:32',
			'modified' => '2015-05-29 06:25:32'
		),
		array(
			'id' => '34',
			'user_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Kierownik Handlowców',
			'salary' => NULL, //�P^',
			'salary_net' => NULL, //�~1�',
			'hourly_rate' => 'PI',
			'employment_start' => '2015-01-01',
			'employment_end' => NULL,
			'vacation_days' => '26',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-05-29 07:03:26',
			'modified' => '2015-05-29 07:03:26'
		),
		array(
			'id' => '35',
			'user_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Handlowiec',
			'salary' => NULL, //ݕK*',
			'salary_net' => NULL, //P�',
			'hourly_rate' => '�7',
			'employment_start' => '2015-01-01',
			'employment_end' => NULL,
			'vacation_days' => '26',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-05-29 07:08:59',
			'modified' => '2015-05-29 07:08:59'
		),
		array(
			'id' => '36',
			'user_id' => '556816d3-f994-4840-80be-3202904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Koordynator ',
			'salary' => NULL, //��g�',
			'salary_net' => NULL, //�-;',
			'hourly_rate' => '�f',
			'employment_start' => '2015-01-01',
			'employment_end' => NULL,
			'vacation_days' => '26',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-05-29 07:36:34',
			'modified' => '2015-05-29 07:36:34'
		),
		array(
			'id' => '37',
			'user_id' => '55681809-6488-46a0-a94e-337c904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Programista',
			'salary' => NULL, //�-;',
			'salary_net' => NULL, //PI�Y',
			'hourly_rate' => 'ɬ',
			'employment_start' => '2015-03-01',
			'employment_end' => '2015-05-29',
			'vacation_days' => '26',
			'vacation_available' => '-1',
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-05-29 07:41:34',
			'modified' => '2015-06-01 09:57:48'
		),
		array(
			'id' => '38',
			'user_id' => '556818c0-6fdc-4800-8492-33e7904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Koordynator',
			'salary' => 0x8010505e,
			'salary_net' => 0xdd072d3b, 
			'hourly_rate' => 0x5049,
			'employment_start' => '2008-05-07',
			'employment_end' => NULL,
			'vacation_days' => '26',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-05-29 07:44:24',
			'modified' => '2015-05-29 07:44:24'
		),
		array(
			'id' => '39',
			'user_id' => '556c37e0-ea08-4001-8b6f-3746904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Programista',
			'salary' => NULL, //�-;',
			'salary_net' => NULL, //P�',
			'hourly_rate' => 'ɬ',
			'employment_start' => '2009-03-18',
			'employment_end' => NULL,
			'vacation_days' => '20',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-06-01 10:48:23',
			'modified' => '2015-06-01 10:48:23'
		),
		array(
			'id' => '40',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'prog',
			'salary' => NULL, //ɬ+ ',
			'salary_net' => NULL, //ɬ+ ',
			'hourly_rate' => '�',
			'employment_start' => '2015-02-28',
			'employment_end' => '2015-06-30',
			'vacation_days' => '26',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-06-02 12:35:38',
			'modified' => '2015-06-02 13:07:39'
		),
		array(
			'id' => '41',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'parent_id' => '42',
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'prog3',
			'salary' => NULL, //��V',
			'salary_net' => NULL, //��V',
			'hourly_rate' => '�',
			'employment_start' => '2015-01-31',
			'employment_end' => '2015-02-28',
			'vacation_days' => '26',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-06-02 13:05:55',
			'modified' => '2015-06-02 13:05:55'
		),
		array(
			'id' => '42',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'prog5',
			'salary' => NULL, //��V',
			'salary_net' => NULL, //��V',
			'hourly_rate' => '�',
			'employment_start' => '2015-01-01',
			'employment_end' => '2015-01-31',
			'vacation_days' => '26',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-06-02 13:07:39',
			'modified' => '2015-06-02 13:07:39'
		),
		array(
			'id' => '43',
			'user_id' => '55680242-25c8-4e5d-ae5b-1f54904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Sekretariat',
			'salary' => NULL, //��V',
			'salary_net' => NULL, //��V',
			'hourly_rate' => '�',
			'employment_start' => '2015-01-01',
			'employment_end' => '2015-07-31',
			'vacation_days' => '26',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-06-03 06:08:23',
			'modified' => '2015-06-03 06:08:23'
		),
		array(
			'id' => '44',
			'user_id' => '556c2c78-0c60-4129-8bb8-2b40904cf98e',
			'parent_id' => '46',
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Programista woland',
			'salary' => NULL, //ݕK*',
			'salary_net' => NULL, //P��m',
			'hourly_rate' => '�',
			'employment_start' => '2015-02-01',
			'employment_end' => '2015-12-31',
			'vacation_days' => '24',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-06-09 10:41:29',
			'modified' => '2015-06-11 13:34:56'
		),
		array(
			'id' => '45',
			'user_id' => '5576e92d-909c-438c-b19f-11b077ecc6b3',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Programista ',
			'salary' => NULL, //�P^',
			'salary_net' => NULL, //�j#�',
			'hourly_rate' => '�',
			'employment_start' => '2015-05-04',
			'employment_end' => '2015-08-31',
			'vacation_days' => '20',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-06-09 13:25:27',
			'modified' => '2015-06-09 13:25:27'
		),
		array(
			'id' => '46',
			'user_id' => '556c2c78-0c60-4129-8bb8-2b40904cf98e',
			'parent_id' => NULL,
			'state' => 'Etat',
			'working_time' => '1.0',
			'position' => 'Programista woland',
			'salary' => NULL, //ݕK*',
			'salary_net' => NULL, //P��m',
			'hourly_rate' => '�',
			'employment_start' => '2015-02-01',
			'employment_end' => '2015-12-31',
			'vacation_days' => '24',
			'vacation_available' => NULL,
			'period_of_employment' => NULL,
			'right_to_pension' => 0,
			'unemployed' => 0,
			'created' => '2015-06-11 13:34:55',
			'modified' => '2015-06-11 13:34:55'
		),
	);

}
