<?php
/**
 * CalendarFixture
 *
 */
class CalendarFixture extends CakeTestFixture {

/**
 * Import
 *
 * @var array
 */
	public $import = array('model' => 'Calendar', 'records' => true);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'year' => '2015',
			'name' => 'Kalendarz'
		),
	);

}
