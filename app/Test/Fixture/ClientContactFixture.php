<?php
/**
 * ClientContactFixture
 *
 */
class ClientContactFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'ID klienta'),
		'firstname' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Imię', 'charset' => 'utf8'),
		'surname' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Nazwisko', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Email', 'charset' => 'utf8'),
		'phone' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Telefon 1', 'charset' => 'utf8'),
		'phone2' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Telefon 2', 'charset' => 'utf8'),
		'note' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Notatka', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'delete' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
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
			'id' => '5',
			'client_id' => '1',
			'firstname' => 'Janusz',
			'surname' => 'testowa',
			'email' => 'd.czyz@febdev.pl',
			'phone' => '87678687',
			'phone2' => '',
			'note' => 'lubie placki',
			'created' => '2015-02-19 14:58:23',
			'modified' => '2015-03-23 15:21:12',
			'delete' => 0
		),
		array(
			'id' => '10',
			'client_id' => '7',
			'firstname' => 'Mateusz',
			'surname' => 'dfsdfsd',
			'email' => '',
			'phone' => '',
			'phone2' => '',
			'note' => '',
			'created' => '2015-02-26 15:15:57',
			'modified' => '2015-02-26 15:15:57',
			'delete' => 0
		),
		array(
			'id' => '13',
			'client_id' => '9',
			'firstname' => 'nowa osoba kontaktowa 9999',
			'surname' => 'dousuniecia',
			'email' => 'test@example.com',
			'phone' => '',
			'phone2' => '',
			'note' => '',
			'created' => '2015-03-03 12:33:34',
			'modified' => '2015-03-03 12:33:34',
			'delete' => 0
		),
		array(
			'id' => '14',
			'client_id' => '3',
			'firstname' => 'testowaa',
			'surname' => 'kkkk',
			'email' => 'test@example.com',
			'phone' => '',
			'phone2' => '',
			'note' => '',
			'created' => '2015-03-03 13:06:21',
			'modified' => '2015-03-03 13:06:21',
			'delete' => 0
		),
		array(
			'id' => '15',
			'client_id' => '11',
			'firstname' => 'Marek',
			'surname' => 'Nowak',
			'email' => 'm.nowak@firma.pl',
			'phone' => '32 23 31 234',
			'phone2' => '321 234 232',
			'note' => 'Dzwonić z rana',
			'created' => '2015-03-12 15:32:19',
			'modified' => '2015-03-12 15:32:19',
			'delete' => 0
		),
		array(
			'id' => '18',
			'client_id' => '1',
			'firstname' => 'nowa kontaktowa 9999',
			'surname' => 'dousuniecia9',
			'email' => 'test88@example.com',
			'phone' => '87678687',
			'phone2' => '787987986',
			'note' => 'test Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin suscipit velit eget quam scelerisque tincidunt. Curabitur a sagittis massa. Curabitur eu lorem quis erat scelerisque eleifend. ',
			'created' => '2015-03-16 13:24:32',
			'modified' => '2015-03-23 15:06:48',
			'delete' => 0
		),
		array(
			'id' => '19',
			'client_id' => '12',
			'firstname' => 'nowa osoba kontaktowa 9999',
			'surname' => 'dousuniecia',
			'email' => 'test@example.com',
			'phone' => '87678687',
			'phone2' => '',
			'note' => 'hhh',
			'created' => '2015-03-19 08:32:08',
			'modified' => '2015-03-19 08:32:08',
			'delete' => 0
		),
		array(
			'id' => '20',
			'client_id' => '17',
			'firstname' => 'nowa osoba kontaktowa 9999',
			'surname' => 'kkkk',
			'email' => 'test@example.com',
			'phone' => '87678687',
			'phone2' => '97977675',
			'note' => 'jkljljkjlkjkl',
			'created' => '2015-03-19 13:59:05',
			'modified' => '2015-03-19 13:59:05',
			'delete' => 0
		),
		array(
			'id' => '23',
			'client_id' => '1',
			'firstname' => 'testowaa77',
			'surname' => 'dousuniecia',
			'email' => 'test321@example.com',
			'phone' => '87678687',
			'phone2' => '43324342',
			'note' => 'terefere kuku',
			'created' => '2015-03-20 13:36:39',
			'modified' => '2015-03-23 14:36:39',
			'delete' => 0
		),
		array(
			'id' => '24',
			'client_id' => '1',
			'firstname' => 'Marek',
			'surname' => 'Nowak',
			'email' => 'mnowak@firma.pl',
			'phone' => '34123124',
			'phone2' => '',
			'note' => 'Upierdliwy',
			'created' => '2015-03-26 09:09:28',
			'modified' => '2015-03-26 09:09:28',
			'delete' => 0
		),
	);

}
