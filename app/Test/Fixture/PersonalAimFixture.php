<?php
/**
 * PersonalAimFixture
 *
 */
class PersonalAimFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Nazwa', 'charset' => 'utf8'),
		'start_date' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Początek realizacji', 'charset' => 'utf8'),
		'end_date' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Koniec realizacji', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 3, 'comment' => 'Stan obecny'),
		'photo' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Ilustracja', 'charset' => 'utf8'),
		'photo_url' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 511, 'collate' => 'utf8_general_ci', 'comment' => 'Link do zdjęcia', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id' => array('column' => 'user_id', 'unique' => 1)
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
			'user_id' => '54ca02f7-5ce0-45d6-b179-173477ecc6b3',
			'name' => 'Mustang moim celem',
			'start_date' => '2015-02-05',
			'end_date' => '2015-02-06',
			'status' => '50',
			'photo' => '',
			'photo_url' => 'http://www.blogcdn.com/www.autoblog.com/media/2012/11/06-retrobuilt-1969-mustang-fastback-fd.jpg',
			'created' => '2015-01-26 00:00:00',
			'modified' => '2015-01-28 15:44:16'
		),
		array(
			'id' => '5',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'name' => 'dysk ssd',
			'start_date' => '2015-04-01',
			'end_date' => '2015-04-03',
			'status' => '20',
			'photo' => NULL,
			'photo_url' => 'http://www.sferis.pl/pictures/d2/x0/279467-2342-product_original-dysk-ssd-kingston-ssdnow-v300-7mm-odczyt-zapis-450-450-mb-s-60gb-sv300s37a-60g.jpg',
			'created' => '2015-01-30 08:53:58',
			'modified' => '2015-04-27 13:31:33'
		),
	);

}
