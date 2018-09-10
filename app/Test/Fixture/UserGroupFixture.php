<?php
/**
 * UserGroupFixture
 *
 */
class UserGroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'order' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 3),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'alias' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 15, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'permission_groups' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
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
			'id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3',
			'order' => '0',
			'name' => 'Redaktorzy',
			'alias' => 'editors',
			'permission_groups' => '{"PermissionGroup":["21","6","5","13","12"]}',
			'created' => '2011-02-09 22:31:05',
			'modified' => '2015-05-27 11:32:52'
		),
		array(
			'id' => '4e76b6f4-6cea-102d-9f80-579a023712b2',
			'order' => '1',
			'name' => 'Administratorzy',
			'alias' => 'admins',
			'permission_groups' => '{"PermissionGroup":["21","20","7","6","5","15","13","12","9","2","1","3"]}',
			'created' => '2010-02-17 00:00:00',
			'modified' => '2015-06-02 08:15:05'
		),
		array(
			'id' => '4e7eaa5d-6cea-102d-9f80-579a023712b2',
			'order' => '2',
			'name' => 'Użytkownicy',
			'alias' => 'users',
			'permission_groups' => '{"PermissionGroup":["22"]}',
			'created' => '2010-02-17 00:00:00',
			'modified' => '2015-01-23 08:32:07'
		),
		array(
			'id' => '4f59cfd8-139c-4614-bcc7-057077ecc6b3',
			'order' => '0',
			'name' => 'Super Admin',
			'alias' => 'superAdmins',
			'permission_groups' => '{"PermissionGroup":["38","36","33","32","37","29","28","35","34","31","30","27","26","23","22","21","20","7","6","5","15","13","12","9","2","1","3"]}',
			'created' => '2012-03-09 10:39:36',
			'modified' => '2015-05-29 12:30:20'
		),
		array(
			'id' => '54d32eb2-3528-43ff-9dc3-0cc877ecc6b3',
			'order' => '0',
			'name' => 'Sekretariat',
			'alias' => 'secretariat',
			'permission_groups' => '{"PermissionGroup":["22","21"]}',
			'created' => '2015-02-05 09:49:54',
			'modified' => '2015-02-05 09:49:54'
		),
		array(
			'id' => '54e1d98e-9e64-481f-a918-0a2077ecc6b3',
			'order' => '0',
			'name' => 'Zarząd',
			'alias' => 'management',
			'permission_groups' => '{"PermissionGroup":["38","36","33","32","37","29","28","35","34","31","30","27","26","23","22"]}',
			'created' => '2015-02-16 12:50:38',
			'modified' => '2015-05-29 08:32:58'
		),
		array(
			'id' => '54e1da95-eb28-4942-8705-0a2077ecc6b3',
			'order' => '0',
			'name' => 'Kierownik Sekretariatu',
			'alias' => 'm_secretariat',
			'permission_groups' => '{"PermissionGroup":["37","29","28","36","33","32","35","34","31","30","23"]}',
			'created' => '2015-02-16 12:55:01',
			'modified' => '2015-05-29 06:10:30'
		),
		array(
			'id' => '54e1dab4-88f0-4382-a692-0a2077ecc6b3',
			'order' => '0',
			'name' => 'Pracownik Sekretariatu',
			'alias' => 'w_secretariat',
			'permission_groups' => '{"PermissionGroup":["28","32","34","30","23","22"]}',
			'created' => '2015-02-16 12:55:32',
			'modified' => '2015-05-25 12:05:00'
		),
		array(
			'id' => '54e1dac8-5840-4c9d-a73a-0a2077ecc6b3',
			'order' => '0',
			'name' => 'Kierownik IT',
			'alias' => 'm_it',
			'permission_groups' => '{"PermissionGroup":["36","33","32","31","30","23","22"]}',
			'created' => '2015-02-16 12:55:52',
			'modified' => '2015-05-29 08:00:56'
		),
		array(
			'id' => '54e1dad1-ca6c-4c85-9c50-0a2077ecc6b3',
			'order' => '0',
			'name' => 'Pracownik IT',
			'alias' => 'w_it',
			'permission_groups' => '{"PermissionGroup":["33","32","30"]}',
			'created' => '2015-02-16 12:56:01',
			'modified' => '2015-06-02 07:50:42'
		),
	);

}
