<?php
/**
 * ProjectIssueEntryFixture
 *
 */
class ProjectIssueEntryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'project_issue_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'start' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'end' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_project_issue_entries_project_issues1_idx' => array('column' => 'project_issue_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MEMORY')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'project_issue_id' => '1',
			'start' => '2010-04-09 09:00:00',
			'end' => '2010-04-09 09:49:00'
		),
		array(
			'id' => '2',
			'project_issue_id' => '1',
			'start' => '2010-04-09 09:49:07',
			'end' => '2010-04-09 12:00:17'
		),
		array(
			'id' => '3',
			'project_issue_id' => '1',
			'start' => '2010-04-09 12:32:54',
			'end' => '2010-04-09 17:49:10'
		),
		array(
			'id' => '4',
			'project_issue_id' => '1',
			'start' => '2010-04-09 17:55:55',
			'end' => '2010-04-09 18:17:00'
		),
		array(
			'id' => '5',
			'project_issue_id' => '1',
			'start' => '2010-04-07 16:00:00',
			'end' => '2010-04-07 16:40:00'
		),
		array(
			'id' => '6',
			'project_issue_id' => '1',
			'start' => '2010-04-13 18:03:30',
			'end' => '2010-04-13 18:25:52'
		),
		array(
			'id' => '7',
			'project_issue_id' => '1',
			'start' => '2010-04-14 07:19:01',
			'end' => '2010-04-14 07:31:10'
		),
		array(
			'id' => '8',
			'project_issue_id' => '1',
			'start' => '2010-04-14 08:54:45',
			'end' => '2010-04-14 09:09:46'
		),
		array(
			'id' => '9',
			'project_issue_id' => '1',
			'start' => '2010-04-14 09:15:09',
			'end' => '2010-04-14 09:36:31'
		),
		array(
			'id' => '10',
			'project_issue_id' => '1',
			'start' => '2010-04-16 16:57:08',
			'end' => '2010-04-16 17:16:57'
		),
	);

}
