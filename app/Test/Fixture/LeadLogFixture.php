<?php
/* LeadLog Fixture generated on: 2015-07-03 14:03:55 : 1435925035 */

/**
 * LeadLogFixture
 *
 */
class LeadLogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_lead_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'type_log_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'subject' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'message' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'from' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'client_lead_id' => '2',
			'type_log_id' => '2',
			'name' => 'good-job-team-we-rock.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '55680635-a4cc-4d31-ada1-226b904cf98e',
			'email_date' => NULL,
			'created' => '2015-06-02 11:48:02',
			'modified' => '2015-06-02 11:48:02'
		),
		array(
			'id' => '2',
			'client_lead_id' => '2',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-03 11:56:53',
			'modified' => '2015-06-03 11:56:53'
		),
		array(
			'id' => '9',
			'client_lead_id' => '2',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-03 12:26:20',
			'modified' => '2015-06-03 12:26:20'
		),
		array(
			'id' => '10',
			'client_lead_id' => '2',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-03 12:27:38',
			'modified' => '2015-06-03 12:27:38'
		),
		array(
			'id' => '11',
			'client_lead_id' => '1',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-03 12:32:48',
			'modified' => '2015-06-03 12:32:48'
		),
		array(
			'id' => '12',
			'client_lead_id' => '1',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'email_date' => NULL,
			'created' => '2015-06-03 12:33:52',
			'modified' => '2015-06-03 12:33:52'
		),
		array(
			'id' => '13',
			'client_lead_id' => '1',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-08 07:18:25',
			'modified' => '2015-06-08 07:18:25'
		),
		array(
			'id' => '14',
			'client_lead_id' => '1',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-08 09:09:40',
			'modified' => '2015-06-08 09:09:40'
		),
		array(
			'id' => '15',
			'client_lead_id' => '1',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-08 09:09:52',
			'modified' => '2015-06-08 09:09:52'
		),
		array(
			'id' => '16',
			'client_lead_id' => '4',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
			'email_date' => NULL,
			'created' => '2015-06-08 11:51:23',
			'modified' => '2015-06-08 11:51:23'
		),
		array(
			'id' => '17',
			'client_lead_id' => '6',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
			'email_date' => NULL,
			'created' => '2015-06-08 11:55:43',
			'modified' => '2015-06-08 11:55:43'
		),
		array(
			'id' => '18',
			'client_lead_id' => '6',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
			'email_date' => NULL,
			'created' => '2015-06-08 11:58:26',
			'modified' => '2015-06-08 11:58:26'
		),
		array(
			'id' => '19',
			'client_lead_id' => '3',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-08 12:03:58',
			'modified' => '2015-06-08 12:03:58'
		),
		array(
			'id' => '20',
			'client_lead_id' => '3',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-08 12:06:11',
			'modified' => '2015-06-08 12:06:11'
		),
		array(
			'id' => '21',
			'client_lead_id' => '3',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
			'email_date' => NULL,
			'created' => '2015-06-08 12:08:35',
			'modified' => '2015-06-08 12:08:35'
		),
		array(
			'id' => '22',
			'client_lead_id' => '6',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
			'email_date' => NULL,
			'created' => '2015-06-08 12:08:49',
			'modified' => '2015-06-08 12:08:49'
		),
		array(
			'id' => '23',
			'client_lead_id' => '6',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
			'email_date' => NULL,
			'created' => '2015-06-08 12:10:43',
			'modified' => '2015-06-08 12:10:43'
		),
		array(
			'id' => '24',
			'client_lead_id' => '6',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-11 08:58:17',
			'modified' => '2015-06-11 08:58:17'
		),
		array(
			'id' => '25',
			'client_lead_id' => '6',
			'type_log_id' => '2',
			'name' => '3hca4.png',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-11 09:06:27',
			'modified' => '2015-06-11 09:06:27'
		),
		array(
			'id' => '26',
			'client_lead_id' => '6',
			'type_log_id' => '2',
			'name' => 'photo.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-11 09:13:59',
			'modified' => '2015-06-11 09:13:59'
		),
		array(
			'id' => '27',
			'client_lead_id' => '6',
			'type_log_id' => '2',
			'name' => 'z06.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-11 09:14:58',
			'modified' => '2015-06-11 09:14:58'
		),
		array(
			'id' => '28',
			'client_lead_id' => '1',
			'type_log_id' => '2',
			'name' => '3hca4.png',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-16 14:18:43',
			'modified' => '2015-06-16 14:18:43'
		),
		array(
			'id' => '29',
			'client_lead_id' => '2',
			'type_log_id' => '2',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-17 06:46:44',
			'modified' => '2015-06-17 06:46:44'
		),
		array(
			'id' => '30',
			'client_lead_id' => '2',
			'type_log_id' => '2',
			'name' => 'brief_557ed2d7-e9fc-4a55-a635-00f077ecc6b32015_06_17.pdf',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-17 06:53:43',
			'modified' => '2015-06-17 06:53:43'
		),
		array(
			'id' => '31',
			'client_lead_id' => '2',
			'type_log_id' => '2',
			'name' => 'BRIEF_557ed2d7-e9fc-4a55-a635-00f077ecc6b3_2015_06_17.pdf',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-17 07:31:40',
			'modified' => '2015-06-17 07:31:40'
		),
		array(
			'id' => '32',
			'client_lead_id' => '2',
			'type_log_id' => '2',
			'name' => 'BRIEF_557ed2d7-e9fc-4a55-a635-00f077ecc6b3_2015_06_17.pdf',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-17 07:39:54',
			'modified' => '2015-06-17 07:39:54'
		),
		array(
			'id' => '33',
			'client_lead_id' => '2',
			'type_log_id' => '2',
			'name' => 'BRIEF_557ed2d7-e9fc-4a55-a635-00f077ecc6b3_2015_06_17__33_03.pdf',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-17 12:33:19',
			'modified' => '2015-06-17 12:33:19'
		),
		array(
			'id' => '34',
			'client_lead_id' => '2',
			'type_log_id' => '2',
			'name' => 'alterfun.pl(Google.pl [Świat])(2015.06.01-2015.06.30).pdf',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-25 09:49:52',
			'modified' => '2015-06-25 09:49:52'
		),
		array(
			'id' => '35',
			'client_lead_id' => '2',
			'type_log_id' => '2',
			'name' => 'IMG_8926(1) - Kopia.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-25 09:53:30',
			'modified' => '2015-06-25 09:53:30'
		),
		array(
			'id' => '36',
			'client_lead_id' => '2',
			'type_log_id' => '2',
			'name' => 'alterfun.pl(Google.pl [Świat])(2015.06.01-2015.06.30).pdf',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-06-25 09:55:59',
			'modified' => '2015-06-25 09:55:59'
		),
	);
}
