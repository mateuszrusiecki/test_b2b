<?php
/**
 * ProjectUserFixture
 *
 */
class ProjectUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'rate' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'project_users_type_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'color' => array('type' => 'string', 'null' => false, 'default' => '#51B749', 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'calendar' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'last_sync' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'name' => 'a.dziki',
			'rate' => '',
			'user_id' => '5110c404-ac84-4ad3-a597-693ebca57851',
			'project_users_type_id' => '1',
			'color' => '#51B749',
			'calendar' => 'http://www.google.com/calendar/feeds/o90udelgqpfncrclhujji9v120%40group.calendar.google.com/private-74115a1915dbf78941aecb7eb0f2d1bd/basic',
			'last_sync' => '2014-10-24 14:23:00'
		),
		array(
			'id' => '2',
			'name' => 'a.pelczar',
			'rate' => NULL,
			'user_id' => '53da0f25-2118-4d59-aeae-074ab2d8c80b',
			'project_users_type_id' => '1',
			'color' => '#51B749',
			'calendar' => '',
			'last_sync' => '2014-10-24 17:02:00'
		),
		array(
			'id' => '3',
			'name' => 'b.dulny',
			'rate' => NULL,
			'user_id' => '52261d2a-d428-4b62-8183-71d6bca51319',
			'project_users_type_id' => '1',
			'color' => '#51B749',
			'calendar' => '',
			'last_sync' => '2014-09-02 03:16:00'
		),
		array(
			'id' => '4',
			'name' => 'd.czyz',
			'rate' => '',
			'user_id' => '5110c424-1174-4c2e-8cf2-7d2bbca57851',
			'project_users_type_id' => '2',
			'color' => '#51B749',
			'calendar' => 'http://www.google.com/calendar/feeds/d.czyz%40feb.net.pl/private-273a79ede36315a34656fd9ee8d2ec9f/basic',
			'last_sync' => '2014-10-24 14:11:00'
		),
		array(
			'id' => '5',
			'name' => 'd.kochmanski',
			'rate' => '',
			'user_id' => '5110c44b-22b0-4adb-adca-7bf6bca57851',
			'project_users_type_id' => '1',
			'color' => '#51B749',
			'calendar' => 'http://www.google.com/calendar/feeds/d.kochmanski%40feb.net.pl/private-bd0147b188185af21677345b33b1d146/basic',
			'last_sync' => '2014-06-25 09:02:00'
		),
		array(
			'id' => '6',
			'name' => 'd.pelka',
			'rate' => NULL,
			'user_id' => '513a294a-3890-4efd-9585-7a47bca51319',
			'project_users_type_id' => '4',
			'color' => '#51B749',
			'calendar' => '',
			'last_sync' => '2014-10-23 19:32:00'
		),
		array(
			'id' => '7',
			'name' => 'd.powroznik',
			'rate' => NULL,
			'user_id' => '51f159e0-74a8-4700-84e5-760fbca51319',
			'project_users_type_id' => '2',
			'color' => '#51B749',
			'calendar' => '',
			'last_sync' => '2014-10-24 13:45:00'
		),
		array(
			'id' => '8',
			'name' => 'd.swinicki',
			'rate' => '',
			'user_id' => NULL,
			'project_users_type_id' => '3',
			'color' => '#51B749',
			'calendar' => 'http://www.google.com/calendar/feeds/d.swinicki%40feb.net.pl/private-4e3387b2567c5761c65efd46a8163a7e/basic',
			'last_sync' => '2013-08-19 08:29:00'
		),
		array(
			'id' => '9',
			'name' => 'i.solczyk',
			'rate' => '1',
			'user_id' => '5110c3b8-a80c-4344-86e8-7d2bbca57851',
			'project_users_type_id' => '1',
			'color' => '#51B749',
			'calendar' => 'http://www.google.com/calendar/feeds/i.solczyk%40feb.net.pl/private-01a91012784090394caf1a0b71b74daf/basic',
			'last_sync' => '2014-01-07 09:01:00'
		),
		array(
			'id' => '10',
			'name' => 'j.hryniuk',
			'rate' => NULL,
			'user_id' => '532833a4-782c-4728-8886-0f20b2d8c80b',
			'project_users_type_id' => '1',
			'color' => '#51B749',
			'calendar' => '',
			'last_sync' => '2014-10-24 15:42:00'
		),
	);

}
