<?php
/**
 * PaymentFixture
 *
 */
class PaymentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_project_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'nazwa platnosci', 'charset' => 'utf8'),
		'date' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'data platnosci'),
		'date_to' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'data do - gdy cykliczna'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'comment' => 'czy cykliczna', 'charset' => 'utf8'),
		'price' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10, 'comment' => 'wartość'),
		'currency' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'waluta'),
		'interval' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'okres'),
		'payment_day' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'dzien platnosci, przy cyklicznym'),
		'payment_done' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => 'czy platnosc zrealizowana'),
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
			'id' => '11',
			'client_project_id' => '2',
			'name' => 'Płatność jednorazowa',
			'date' => '2015-03-25',
			'date_to' => NULL,
			'type' => 'payment',
			'price' => '343',
			'currency' => NULL,
			'interval' => NULL,
			'payment_day' => NULL,
			'payment_done' => 0,
			'created' => '2015-03-18 09:51:17',
			'modified' => '2015-03-18 09:51:17'
		),
		array(
			'id' => '13',
			'client_project_id' => '31',
			'name' => 'Płatność za projekt',
			'date' => NULL,
			'date_to' => NULL,
			'type' => 'payment',
			'price' => '24300',
			'currency' => NULL,
			'interval' => NULL,
			'payment_day' => NULL,
			'payment_done' => 0,
			'created' => '2015-03-19 09:03:52',
			'modified' => '2015-03-19 09:03:52'
		),
		array(
			'id' => '14',
			'client_project_id' => '1',
			'name' => 'test',
			'date' => '2015-03-09',
			'date_to' => NULL,
			'type' => 'payment',
			'price' => '100',
			'currency' => NULL,
			'interval' => NULL,
			'payment_day' => NULL,
			'payment_done' => 0,
			'created' => '2015-03-20 13:30:36',
			'modified' => '2015-03-20 13:30:36'
		),
		array(
			'id' => '15',
			'client_project_id' => '1',
			'name' => 'test',
			'date' => '2015-03-09',
			'date_to' => '2015-03-31',
			'type' => 'cycle',
			'price' => '100',
			'currency' => NULL,
			'interval' => '0',
			'payment_day' => '0',
			'payment_done' => 0,
			'created' => '2015-03-20 13:30:36',
			'modified' => '2015-03-20 13:30:36'
		),
		array(
			'id' => '16',
			'client_project_id' => '4',
			'name' => 'testowy1',
			'date' => '2015-03-26',
			'date_to' => NULL,
			'type' => 'payment',
			'price' => '200',
			'currency' => NULL,
			'interval' => NULL,
			'payment_day' => NULL,
			'payment_done' => 0,
			'created' => '2015-03-25 08:40:52',
			'modified' => '2015-03-25 08:40:52'
		),
		array(
			'id' => '17',
			'client_project_id' => '4',
			'name' => 'nowa przykładowa platność okresowa',
			'date' => '2015-03-25',
			'date_to' => '2015-06-25',
			'type' => 'cycle',
			'price' => '350',
			'currency' => NULL,
			'interval' => '3',
			'payment_day' => '25',
			'payment_done' => 0,
			'created' => '2015-03-25 08:40:52',
			'modified' => '2015-03-25 08:40:52'
		),
		array(
			'id' => '19',
			'client_project_id' => '5',
			'name' => 'Platnosc 1',
			'date' => '2015-03-30',
			'date_to' => NULL,
			'type' => 'payment',
			'price' => '1000',
			'currency' => NULL,
			'interval' => NULL,
			'payment_day' => NULL,
			'payment_done' => 0,
			'created' => '2015-03-26 09:34:06',
			'modified' => '2015-03-26 09:34:06'
		),
		array(
			'id' => '20',
			'client_project_id' => '5',
			'name' => 'Platnosc 2',
			'date' => '2015-04-15',
			'date_to' => NULL,
			'type' => 'payment',
			'price' => '2000',
			'currency' => NULL,
			'interval' => NULL,
			'payment_day' => NULL,
			'payment_done' => 0,
			'created' => '2015-03-26 09:34:06',
			'modified' => '2015-03-26 09:34:06'
		),
		array(
			'id' => '21',
			'client_project_id' => '5',
			'name' => 'Platnosc 3',
			'date' => '2015-04-30',
			'date_to' => NULL,
			'type' => 'payment',
			'price' => '1672',
			'currency' => NULL,
			'interval' => NULL,
			'payment_day' => NULL,
			'payment_done' => 0,
			'created' => '2015-03-26 09:34:06',
			'modified' => '2015-03-26 09:34:06'
		),
		array(
			'id' => '22',
			'client_project_id' => '3',
			'name' => 'full za wszystko',
			'date' => '2015-03-26',
			'date_to' => NULL,
			'type' => 'payment',
			'price' => '3650',
			'currency' => NULL,
			'interval' => NULL,
			'payment_day' => NULL,
			'payment_done' => 0,
			'created' => '2015-03-26 09:35:49',
			'modified' => '2015-03-26 09:35:49'
		),
	);

}
