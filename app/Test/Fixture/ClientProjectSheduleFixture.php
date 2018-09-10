<?php
/**
 * ClientProjectSheduleFixture
 *
 */
class ClientProjectSheduleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_project_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date' => array('type' => 'date', 'null' => true, 'default' => null),
		'date_to' => array('type' => 'date', 'null' => true, 'default' => null),
		'desc' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'interval' => array('type' => 'integer', 'null' => true, 'default' => null),
		'payment_day' => array('type' => 'integer', 'null' => true, 'default' => null),
		'done' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'zadanie zrealizowane'),
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
			'id' => '3',
			'client_project_id' => '2',
			'type' => 'stage',
			'name' => 'Etap',
			'date' => '2015-03-12',
			'date_to' => '2015-03-18',
			'desc' => 'asdfasdfasas dsas df',
			'interval' => NULL,
			'payment_day' => NULL,
			'done' => 0,
			'created' => '2015-03-23 12:44:59',
			'modified' => '2015-03-25 11:30:02'
		),
		array(
			'id' => '4',
			'client_project_id' => '2',
			'type' => 'cycle',
			'name' => 'Wydarzenie cykliczne',
			'date' => '2015-01-01',
			'date_to' => '2015-11-17',
			'desc' => NULL,
			'interval' => '1',
			'payment_day' => '25',
			'done' => 0,
			'created' => '2015-03-23 12:44:59',
			'modified' => '2015-03-23 12:44:59'
		),
		array(
			'id' => '5',
			'client_project_id' => '4',
			'type' => 'stage',
			'name' => 'etap 1',
			'date' => '2015-03-26',
			'date_to' => '2015-04-26',
			'desc' => 'testowy etap',
			'interval' => NULL,
			'payment_day' => NULL,
			'done' => 0,
			'created' => '2015-03-25 09:29:17',
			'modified' => '2015-03-25 09:29:17'
		),
		array(
			'id' => '6',
			'client_project_id' => '4',
			'type' => 'milestone',
			'name' => 'kamień milowy po pierwszym etapie',
			'date' => '2015-04-26',
			'date_to' => NULL,
			'desc' => 'lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet',
			'interval' => NULL,
			'payment_day' => NULL,
			'done' => 0,
			'created' => '2015-03-25 09:29:17',
			'modified' => '2015-03-25 09:29:17'
		),
		array(
			'id' => '7',
			'client_project_id' => '4',
			'type' => 'stage',
			'name' => 'etap 2',
			'date' => '2015-04-27',
			'date_to' => '2015-05-20',
			'desc' => 'kolejny etap kkkkkkkkkkkkkk',
			'interval' => NULL,
			'payment_day' => NULL,
			'done' => 0,
			'created' => '2015-03-25 09:29:17',
			'modified' => '2015-03-25 09:29:17'
		),
		array(
			'id' => '8',
			'client_project_id' => '4',
			'type' => 'cycle',
			'name' => 'jakies wydarzenie ckliczne, sprint?',
			'date' => '2015-03-26',
			'date_to' => '2015-03-26',
			'desc' => NULL,
			'interval' => '3',
			'payment_day' => '1',
			'done' => 0,
			'created' => '2015-03-25 09:29:17',
			'modified' => '2015-03-25 09:29:17'
		),
		array(
			'id' => '11',
			'client_project_id' => '3',
			'type' => 'stage',
			'name' => 'etap 1',
			'date' => '2015-04-01',
			'date_to' => '2015-04-15',
			'desc' => 'terefere',
			'interval' => NULL,
			'payment_day' => NULL,
			'done' => 0,
			'created' => '2015-03-26 09:37:30',
			'modified' => '2015-03-26 09:37:30'
		),
		array(
			'id' => '12',
			'client_project_id' => '3',
			'type' => 'stage',
			'name' => 'etap 2',
			'date' => '2015-04-15',
			'date_to' => '2015-04-22',
			'desc' => 'kuku',
			'interval' => NULL,
			'payment_day' => NULL,
			'done' => 0,
			'created' => '2015-03-26 09:37:30',
			'modified' => '2015-03-26 09:37:30'
		),
		array(
			'id' => '13',
			'client_project_id' => '3',
			'type' => 'stage',
			'name' => 'etap 3',
			'date' => '2015-04-22',
			'date_to' => '2015-04-30',
			'desc' => 'koncowy',
			'interval' => NULL,
			'payment_day' => NULL,
			'done' => 0,
			'created' => '2015-03-26 09:37:31',
			'modified' => '2015-03-26 09:37:31'
		),
		array(
			'id' => '14',
			'client_project_id' => '5',
			'type' => 'stage',
			'name' => 'Etap 1',
			'date' => '2015-03-30',
			'date_to' => '2015-03-20',
			'desc' => 'Opis etapu',
			'interval' => NULL,
			'payment_day' => NULL,
			'done' => 0,
			'created' => '2015-03-26 09:44:02',
			'modified' => '2015-03-26 09:44:02'
		),
	);

}
