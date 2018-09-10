<?php
/**
 * SheduleAgreementPositionFixture
 *
 */
class SheduleAgreementPositionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'project_shedule_agreement_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date_start' => array('type' => 'date', 'null' => false, 'default' => null),
		'date_end' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'typ- czy etap, czy kamien milowy'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'comment' => 'zakonczony, nie '),
		'cyclic' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'comment' => 'wydarzenie cykliczne'),
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
			'id' => 1,
			'project_shedule_agreement_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'date_start' => '2015-03-17',
			'date_end' => '2015-03-17 08:55:53',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'type' => 1,
			'status' => 1,
			'cyclic' => 1,
			'created' => '2015-03-17 08:55:53',
			'modified' => '2015-03-17 08:55:53'
		),
	);

}
