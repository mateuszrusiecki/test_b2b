<?php
/**
 * BriefFixture
 *
 */
class BriefFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Tytuł briefa', 'charset' => 'utf8'),
		'comment' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'SKĄD DOWIEDZIELI SIĘ PAŃSTWO O NASZEJ FIRMIE?', 'charset' => 'utf8'),
		'hid' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'hid unikalne id', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => 'twórca briefa', 'charset' => 'utf8'),
		'guardian_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => 'opiekun klienta', 'charset' => 'utf8'),
		'client_lead_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'completed' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
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
			'id' => '1',
			'name' => 'Brief test',
			'comment' => 'jjjj',
			'hid' => '557ed2d7-e9fc-4a55-a635-00f077ecc6b3',
			'user_id' => '556c2c78-0c60-4129-8bb8-2b40904cf98e',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '2',
			'completed' => '0',
			'modified' => '2015-06-11 08:20:19',
			'created' => '2015-06-11 00:00:00'
		),
		array(
			'id' => '2',
			'name' => 'sdaf',
			'comment' => 'sdf',
			'hid' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '2',
			'completed' => '0',
			'modified' => '2015-06-12 13:10:08',
			'created' => '2015-06-12 13:10:08'
		),
		array(
			'id' => '3',
			'name' => 'dsf',
			'comment' => 'asfd',
			'hid' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '2',
			'completed' => '0',
			'modified' => '2015-06-12 13:11:52',
			'created' => '2015-06-12 13:11:52'
		),
		array(
			'id' => '4',
			'name' => 'dasf',
			'comment' => 'sdf',
			'hid' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '2',
			'completed' => '0',
			'modified' => '2015-06-12 13:13:17',
			'created' => '2015-06-12 13:13:17'
		),
		array(
			'id' => '8',
			'name' => 'nowy',
			'comment' => 'test',
			'hid' => '557eccd0-5154-466c-a3a3-00f077ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '1',
			'completed' => '0',
			'modified' => '2015-06-15 09:09:34',
			'created' => '2015-06-15 09:09:34'
		),
		array(
			'id' => '9',
			'name' => 'test22',
			'comment' => 'test',
			'hid' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '1',
			'completed' => '0',
			'modified' => '2015-06-15 09:12:41',
			'created' => '2015-06-15 09:12:41'
		),
		array(
			'id' => '10',
			'name' => 'test34',
			'comment' => 'sadf',
			'hid' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'client_lead_id' => '1',
			'completed' => '0',
			'modified' => '2015-06-15 09:15:08',
			'created' => '2015-06-15 09:15:08'
		),
		array(
			'id' => '20',
			'name' => 'asdf',
			'comment' => 'sadfsdf',
			'hid' => '557eafd4-469c-4df5-8581-00f077ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'client_lead_id' => '1',
			'completed' => '0',
			'modified' => '2015-06-15 10:58:28',
			'created' => '2015-06-15 10:58:28'
		),
		array(
			'id' => '21',
			'name' => 'asdf',
			'comment' => 'sadfsdf',
			'hid' => '557eb030-1674-419b-aab7-00f077ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'client_lead_id' => '1',
			'completed' => '0',
			'modified' => '2015-06-15 11:00:00',
			'created' => '2015-06-15 11:00:00'
		),
		array(
			'id' => '22',
			'name' => 'nowy',
			'comment' => 'test',
			'hid' => '557ecd1c-451c-4b0f-9150-00f077ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '1',
			'completed' => '0',
			'modified' => '2015-06-15 09:09:34',
			'created' => '2015-06-15 09:09:34'
		),
		array(
			'id' => '23',
			'name' => 'nowy',
			'comment' => 'test',
			'hid' => '557ecd28-a1b4-4d75-a18c-00f077ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '1',
			'completed' => '0',
			'modified' => '2015-06-15 09:09:34',
			'created' => '2015-06-15 09:09:34'
		),
		array(
			'id' => '24',
			'name' => 'asdf',
			'comment' => 'sadfsdf',
			'hid' => '557ecfca-1c38-46c6-93a0-00f077ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'client_lead_id' => '1',
			'completed' => '0',
			'modified' => '2015-06-15 11:00:00',
			'created' => '2015-06-15 11:00:00'
		),
		array(
			'id' => '25',
			'name' => 'dasf',
			'comment' => 'sdf',
			'hid' => '557ed19e-dc74-4421-8782-00f077ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'client_lead_id' => '2',
			'completed' => '0',
			'modified' => '2015-06-15 13:22:38',
			'created' => '2015-06-15 13:22:38'
		),
		array(
			'id' => '26',
			'name' => 'dasf',
			'comment' => 'sdf',
			'hid' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'client_lead_id' => '2',
			'completed' => '0',
			'modified' => '2015-06-15 13:27:51',
			'created' => '2015-06-15 13:27:51'
		),
		array(
			'id' => '27',
			'name' => NULL,
			'comment' => NULL,
			'hid' => '557ed534-6ff8-42fc-93e8-00f077ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => NULL,
			'client_lead_id' => NULL,
			'completed' => '0',
			'modified' => '2015-06-15 13:37:56',
			'created' => '2015-06-15 13:37:56'
		),
		array(
			'id' => '28',
			'name' => NULL,
			'comment' => NULL,
			'hid' => '557fd7c8-4c48-4c29-9232-00dc77ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => NULL,
			'client_lead_id' => NULL,
			'completed' => '0',
			'modified' => '2015-06-16 08:01:12',
			'created' => '2015-06-16 08:01:12'
		),
		array(
			'id' => '29',
			'name' => 'Brief test',
			'comment' => 'jjjj',
			'hid' => '5582657a-095c-40b8-a832-134877ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '2',
			'completed' => '1',
			'modified' => '2015-06-18 06:30:18',
			'created' => '2015-06-18 06:30:18'
		),
		array(
			'id' => '30',
			'name' => 'test',
			'comment' => NULL,
			'hid' => '558a708f-7d68-4b38-9577-1afc77ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'guardian_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'client_lead_id' => '3',
			'completed' => '0',
			'modified' => '2015-06-24 10:55:43',
			'created' => '2015-06-24 10:55:43'
		),
		array(
			'id' => '31',
			'name' => 'testowy lkalny',
			'comment' => NULL,
			'hid' => '55929c9d-9be8-4afe-9a75-107c77ecc6b3',
			'user_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'guardian_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'client_lead_id' => '7',
			'completed' => '0',
			'modified' => '2015-06-30 15:41:49',
			'created' => '2015-06-30 15:41:49'
		),
		array(
			'id' => '32',
			'name' => 'testowy lkalny',
			'comment' => NULL,
			'hid' => '55929d6c-2728-411d-91e0-107c77ecc6b3',
			'user_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'guardian_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'client_lead_id' => '7',
			'completed' => '0',
			'modified' => '2015-06-30 15:45:16',
			'created' => '2015-06-30 15:45:16'
		),
	);

}
