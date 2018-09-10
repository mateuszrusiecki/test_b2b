<?php
/* UserGroupsUser Fixture generated on: 2015-01-22 14:58:00 : 1421935080 */

/**
 * UserGroupsUserFixture
 *
 */
class UserGroupsUserFixture extends CakeTestFixture {

    public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'group_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 13),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => null),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);


/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 'af394f22-7342-11e1-aba5-6cf049176608',
			'group_id' => '4f59cfd8-139c-4614-bcc7-057077ecc6b3',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2'
		),
	);
}
