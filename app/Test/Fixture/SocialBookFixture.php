<?php
/**
 * SocialBookFixture
 *
 */
class SocialBookFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'about' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'competence' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'skype' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'website' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'facebook' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'office_room' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'user_id' => '556c37e0-ea08-4001-8b6f-3746904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-11 09:23:42',
			'created' => '2015-06-11 09:23:42'
		),
		array(
			'id' => '2',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'about' => 'test45 sdf asdf
fgdfg',
			'competence' => 'sdf daf2 ds
asdf
sdf
sdf',
			'skype' => 'skype.feb',
			'website' => 'sdf',
			'facebook' => 'rzeszów',
			'office_room' => NULL,
			'modified' => '2015-06-29 09:14:58',
			'created' => '2015-06-11 11:23:02'
		),
		array(
			'id' => '3',
			'user_id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
			'about' => 'test sdf',
			'competence' => NULL,
			'skype' => 'dfdsfdsaf',
			'website' => 'ghg',
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-16 12:39:17',
			'created' => '2015-06-16 10:14:04'
		),
		array(
			'id' => '4',
			'user_id' => '556821f0-e7d4-40f1-8245-3c4a904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-16 10:14:15',
			'created' => '2015-06-16 10:14:15'
		),
		array(
			'id' => '5',
			'user_id' => '556833c7-72ec-46b0-829e-4c4a904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-16 11:15:05',
			'created' => '2015-06-16 11:15:05'
		),
		array(
			'id' => '6',
			'user_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-16 11:30:59',
			'created' => '2015-06-16 11:30:59'
		),
		array(
			'id' => '7',
			'user_id' => '556c2c78-0c60-4129-8bb8-2b40904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-16 11:31:11',
			'created' => '2015-06-16 11:31:11'
		),
		array(
			'id' => '8',
			'user_id' => '55680635-a4cc-4d31-ada1-226b904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-16 12:59:24',
			'created' => '2015-06-16 12:59:24'
		),
		array(
			'id' => '9',
			'user_id' => '55681809-6488-46a0-a94e-337c904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => 'slawekchlebek.feb',
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-17 06:54:21',
			'created' => '2015-06-17 06:54:21'
		),
		array(
			'id' => '10',
			'user_id' => '5568106b-df48-4c88-a271-2bc5904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-17 08:56:57',
			'created' => '2015-06-17 08:56:57'
		),
		array(
			'id' => '11',
			'user_id' => '556818c0-6fdc-4800-8492-33e7904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-18 10:31:45',
			'created' => '2015-06-18 10:31:45'
		),
		array(
			'id' => '12',
			'user_id' => '55680242-25c8-4e5d-ae5b-1f54904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-06-19 10:46:50',
			'created' => '2015-06-19 10:46:50'
		),
		array(
			'id' => '13',
			'user_id' => '55682053-6b8c-4207-b15c-3a2f904cf98e',
			'about' => NULL,
			'competence' => NULL,
			'skype' => NULL,
			'website' => NULL,
			'facebook' => NULL,
			'office_room' => NULL,
			'modified' => '2015-07-06 13:15:33',
			'created' => '2015-07-06 13:15:33'
		),
	);

}
