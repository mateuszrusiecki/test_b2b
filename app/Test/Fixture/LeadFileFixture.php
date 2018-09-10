<?php
/* LeadFile Fixture generated on: 2015-03-04 14:22:15 : 1425475335 */

/**
 * LeadFileFixture
 *
 */
class LeadFileFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_lead_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'file' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'size' => array('type' => 'integer', 'null' => false, 'default' => null),
		'file_category_id' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
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
			'id' => 1,
			'client_lead_id' => 3,
			'file' => 'Lorem ipsum dolor sit amet',
			'slug' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ip',
			'size' => 1,
			'file_category_id' => 2,
			'created' => '2015-03-04 14:22:15',
			'modified' => '2015-03-04 14:22:15'
		),
            array(
			'id' => 2,
			'client_lead_id' => 3,
			'file' => 'plik 2',
			'slug' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ip',
			'size' => 1,
			'file_category_id' => 3,
			'created' => '2015-03-04 14:22:15',
			'modified' => '2015-03-04 14:22:15'
		),
	);
}
