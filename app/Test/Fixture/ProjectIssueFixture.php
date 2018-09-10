<?php
/**
 * ProjectIssueFixture
 *
 */
class ProjectIssueFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'project_users_name' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'client_project_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'project' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'alias' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'desc' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'time' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 20),
		'start' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'end' => array('type' => 'datetime', 'null' => false, 'default' => null),
                'year' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 4, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
                'month' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_project_issues_project_users1_idx' => array('column' => 'project_users_name', 'unique' => 0),
			'fk_project_issues_projects1_idx' => array('column' => 'client_project_id', 'unique' => 0)
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
			'id' => '107',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#16220 feb_b2b :: wchodze w log leada',
			'alias' => '_16220_feb_b2b_wchodze_w_log_leada',
			'desc' => NULL,
			'time' => '1918',
			'start' => '2015-03-06 12:50:51',
			'end' => '2015-03-06 13:22:49',
                        'year'=> '2015',
                        'month'=>'03'
		),
		array(
			'id' => '108',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#0 feb_b2b :: crosstesty,poprawki',
			'alias' => '_0_feb_b2b_crosstesty_poprawki',
			'desc' => NULL,
			'time' => '271009',
			'start' => '2015-03-06 13:56:52',
			'end' => '2015-05-15 07:07:06',
                        'year'=> '2015',
                        'month'=>'03'
                    
		),
		array(
			'id' => '109',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#0 feb_b2b :: testy jednostkowe',
			'alias' => '_0_feb_b2b_testy_jednostkowe',
			'desc' => NULL,
			'time' => '176641',
			'start' => '2015-03-09 10:54:21',
			'end' => '2015-05-13 14:13:13',
                        'year'=> '2015',
                        'month'=>'03'
		),
		array(
			'id' => '110',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#16218 feb_b2b :: wydajność pobierania maili z poczty',
			'alias' => '_16218_feb_b2b_wydajnosc_pobierania_maili_z_poczty',
			'desc' => NULL,
			'time' => '4180',
			'start' => '2015-03-09 12:37:01',
			'end' => '2015-03-10 09:07:34',
                        'year'=> '2015',
                        'month'=>'06'
		),
		array(
			'id' => '111',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#0 feb_b2b :: dokumentacja',
			'alias' => '_0_feb_b2b_dokumentacja',
			'desc' => NULL,
			'time' => '6124',
			'start' => '2015-03-09 13:20:15',
			'end' => '2015-03-09 15:02:19',
                        'year'=> '2015',
                        'month'=>'03'
		),
		array(
			'id' => '112',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#16357 feb_b2b :: harmonogram realizacji - widok i połączenie z baza',
			'alias' => '_16357_feb_b2b_harmonogram_realizacji_widok_i_polaczenie_z_baza',
			'desc' => NULL,
			'time' => '4506',
			'start' => '2015-03-10 07:04:47',
			'end' => '2015-03-10 09:30:42',
                        'year'=> '2015',
                        'month'=>'03',
		),
		array(
			'id' => '113',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#16379 feb_b2b :: historia poprzednich umów',
			'alias' => '_16379_feb_b2b_historia_poprzednich_umow',
			'desc' => NULL,
			'time' => '3924',
			'start' => '2015-03-10 09:30:43',
			'end' => '2015-03-19 12:12:57',
                        'year'=> '2015',
                        'month'=>'03'
		),
		array(
			'id' => '114',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#0 feb_b2b :: projektowanie bazy',
			'alias' => '_0_feb_b2b_projektowanie_bazy',
			'desc' => NULL,
			'time' => '20593',
			'start' => '2015-03-10 10:11:02',
			'end' => '2015-04-14 08:04:48',
                        'year'=> '2015',
                        'month'=>'03'
		),
		array(
			'id' => '115',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#16222 feb_b2b :: poprawki z dn. 18.02.2015',
			'alias' => '_16222_feb_b2b_poprawki_z_dn_18_02_2015',
			'desc' => NULL,
			'time' => '33644',
			'start' => '2015-03-11 07:10:22',
			'end' => '2015-03-18 07:42:45',
                        'year'=> '2015',
                        'month'=>'03'
                    
		),
		array(
			'id' => '116',
			'project_users_name' => 's.chlebek',
			'user_id' => '552cac43-398c-4e75-9a28-0b3077ecc6b3',
			'client_project_id' => '8',
			'project' => 'feb_b2b',
			'name' => '#16285 feb_b2b :: Widok oraz połączenie z bazą - zakładanie projektu',
			'alias' => '_16285_feb_b2b_widok_oraz_polaczenie_z_baza_zakladanie_projektu',
			'desc' => NULL,
			'time' => '44620',
			'start' => '2015-03-12 11:53:03',
			'end' => '2015-03-19 15:31:47',
                        'year'=> '2015',
                        'month'=>'03'
		),
	);

}
