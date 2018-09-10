<?php
/* AcceptanceReport Fixture generated on: 2015-07-28 14:36:17 : 1438086977 */

/**
 * AcceptanceReportFixture
 *
 */
class AcceptanceReportFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'clinet_project_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'client_project_shedule_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'task_list' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'opinion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'acceptance' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);;

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'clinet_project_id' => 1,
			'client_id' => 1,
			'client_project_shedule_id' => 1,
			'task_list' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'opinion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'acceptance' => 1
		),
	);
}
