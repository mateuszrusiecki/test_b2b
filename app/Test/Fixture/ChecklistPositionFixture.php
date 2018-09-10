<?php
/**
 * ChecklistPositionFixture
 *
 */
class ChecklistPositionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'name' => 'Klucze',
			'modified' => '2015-06-01 13:41:51',
			'created' => '2015-06-01 13:41:51'
		),
		array(
			'id' => '2',
			'name' => 'Dostęp do komputera',
			'modified' => '2015-06-01 13:44:02',
			'created' => '2015-06-01 13:44:02'
		),
		array(
			'id' => '3',
			'name' => 'Dostęp do komputera',
			'modified' => '2015-06-02 07:33:57',
			'created' => '2015-06-02 07:33:57'
		),
		array(
			'id' => '4',
			'name' => 'Dostęp do SVN',
			'modified' => '2015-06-02 07:40:12',
			'created' => '2015-06-02 07:40:12'
		),
		array(
			'id' => '5',
			'name' => 'Klucze',
			'modified' => '2015-06-02 07:41:11',
			'created' => '2015-06-02 07:41:11'
		),
		array(
			'id' => '6',
			'name' => 'Dostępy do serwerów',
			'modified' => '2015-06-02 07:49:24',
			'created' => '2015-06-02 07:49:24'
		),
		array(
			'id' => '7',
			'name' => 'Telefon',
			'modified' => '2015-06-02 07:50:19',
			'created' => '2015-06-02 07:50:19'
		),
		array(
			'id' => '8',
			'name' => 'test 3',
			'modified' => '2015-06-02 10:40:41',
			'created' => '2015-06-02 10:40:41'
		),
		array(
			'id' => '9',
			'name' => 'Akcesoria (Słuchawka, Ładowarka, Karta SIM)',
			'modified' => '2015-06-02 10:41:35',
			'created' => '2015-06-02 10:41:35'
		),
		array(
			'id' => '10',
			'name' => 'Telefon',
			'modified' => '2015-06-02 10:41:41',
			'created' => '2015-06-02 10:41:41'
		),
		array(
			'id' => '11',
			'name' => 'test',
			'modified' => '2015-06-11 05:55:09',
			'created' => '2015-06-11 05:55:09'
		),
		array(
			'id' => '12',
			'name' => 'tte',
			'modified' => '2015-06-11 05:55:30',
			'created' => '2015-06-11 05:55:30'
		),
		array(
			'id' => '13',
			'name' => 'gh',
			'modified' => '2015-06-11 05:56:12',
			'created' => '2015-06-11 05:56:12'
		),
		array(
			'id' => '14',
			'name' => 'gh',
			'modified' => '2015-06-11 05:56:22',
			'created' => '2015-06-11 05:56:22'
		),
		array(
			'id' => '15',
			'name' => 'gh',
			'modified' => '2015-06-11 05:56:28',
			'created' => '2015-06-11 05:56:28'
		),
	);

}
