<?php
/**
 * CountryFixture
 *
 */
class CountryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 2, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'comment' => 'iso', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 80, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'printable_name_en' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 80, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'printable_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 80, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'iso3' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 3, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'numcode' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6),
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
			'id' => 'AD',
			'name' => 'ANDORRA',
			'printable_name_en' => 'Andorra',
			'printable_name' => 'Andora',
			'iso3' => 'AND',
			'numcode' => '20'
		),
		array(
			'id' => 'AE',
			'name' => 'UNITED ARAB EMIRATES',
			'printable_name_en' => 'United Arab 
Emirates',
			'printable_name' => 'Zjedn.Emiraty Arabskie',
			'iso3' => 'ARE',
			'numcode' => '784'
		),
		array(
			'id' => 'AF',
			'name' => 'AFGHANISTAN',
			'printable_name_en' => 'Afghanistan',
			'printable_name' => 'Afganistan',
			'iso3' => 'AFG',
			'numcode' => '4'
		),
		array(
			'id' => 'AG',
			'name' => 'ANTIGUA AND BARBUDA',
			'printable_name_en' => 'Antigua and Barbuda',
			'printable_name' => 'Antigua i Barbuda',
			'iso3' => 'ATG',
			'numcode' => '28'
		),
		array(
			'id' => 'AI',
			'name' => 'ANGUILLA',
			'printable_name_en' => 'Anguilla',
			'printable_name' => 'Anguilla',
			'iso3' => 'AIA',
			'numcode' => '660'
		),
		array(
			'id' => 'AL',
			'name' => 'ALBANIA',
			'printable_name_en' => 'Albania',
			'printable_name' => 'Albania',
			'iso3' => 'ALB',
			'numcode' => '8'
		),
		array(
			'id' => 'AM',
			'name' => 'ARMENIA',
			'printable_name_en' => 'Armenia',
			'printable_name' => 'Armenia',
			'iso3' => 'ARM',
			'numcode' => '51'
		),
		array(
			'id' => 'AN',
			'name' => 'NETHERLANDS ANTILLES',
			'printable_name_en' => 'Netherlands 
Antilles',
			'printable_name' => 'Antyle Holenderskie',
			'iso3' => 'ANT',
			'numcode' => '530'
		),
		array(
			'id' => 'AO',
			'name' => 'ANGOLA',
			'printable_name_en' => 'Angola',
			'printable_name' => 'Angola',
			'iso3' => 'AGO',
			'numcode' => '24'
		),
		array(
			'id' => 'AQ',
			'name' => 'ANTARCTICA',
			'printable_name_en' => 'Antarctica',
			'printable_name' => 'Antarktyda',
			'iso3' => NULL,
			'numcode' => NULL
		),
	);

}
