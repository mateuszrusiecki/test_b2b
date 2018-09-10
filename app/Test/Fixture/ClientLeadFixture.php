<?php
App::uses('ClientLead', 'Model');
/**
 * ClientLeadFixture
 *
 */
class ClientLeadFixture extends CakeTestFixture {


/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Nazwa leadu', 'charset' => 'utf8'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'ID klienta'),
		'lead_category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'ID kategorii'),
		'lead_status_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'ID statusu'),
		'probability' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'comment' => 'Prawdopodobieństwo'),
		'amount' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'Wartość'),
		'currency_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'ID waluty'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => 'ID handlowca', 'charset' => 'utf8'),
                'comment' => array('type' => 'text', 'null' => true, 'default' => null,'charset' => 'utf8'),
                'closing_date' => array ('type' => 'datetime', 'null' => false), 
                'created' => array ('type' => 'datetime', 'null'=> false), 
                'modified' => array ('type' => 'datetime', 'null'=> false), 
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
			'id' => '1',
			'name' => 'Przykładowa nazwa leadu',
			'client_id'         => '1',
			'lead_category_id'  => '2',
			'lead_status_id'    => '1',
			'probability'       => '40',
			'amount'            => '1000',
			'currency_id'       => '1',
			'user_id'           => '3a38ee92-6934-102d-9f80-579a023712b2',
                        'closing_date'      => '2015-03-07 00:00:00',
                        'created'           => '2015-01-04 00:00:00',
                        'modified'          => '2015-03-06 00:00:00'
                        
		),
		array(
			'id' => '3',
			'name' => 'Testowy',
			'client_id' => '1',
			'lead_category_id' => '1',
			'lead_status_id' => '1',
			'probability' => '20',
			'amount' => '123',
			'currency_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'closing_date'      => '2015-03-09 00:00:00',
			'created'           => '2015-03-01 00:00:00',
			'modified'          => '2015-03-06 00:00:00'
		),
		array(
			'id' => '4',
			'name' => 'test',
			'client_id' => '1',
			'lead_category_id' => '1',
			'lead_status_id' => '1',
			'probability' => '30',
			'amount' => '123',
			'currency_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'closing_date'      => '2015-03-06 00:00:00',
			'created'           => '2015-03-02 00:00:00',
			'modified'          => '2015-03-06 00:00:00'
		),
		array(
			'id' => '5',
			'name' => '1231',
			'client_id' => '1',
			'lead_category_id' => '1',
			'lead_status_id' => '6',
			'probability' => '30',
			'amount' => '23',
			'currency_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'closing_date'      => '2015-03-06 00:00:00',
			'created'           => '2015-03-03 00:00:00',
			'modified'          => '2015-03-06 00:00:00'
		),
		array(
			'id' => '6',
			'name' => 'Nowy testowy lead',
			'client_id' => '1',
			'lead_category_id' => '10',
			'lead_status_id' => '6',
			'probability' => '60',
			'amount' => '999',
			'currency_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'closing_date'      => 'NULL',
			'created'           => '2015-03-06 00:00:00',
			'modified'          => '2015-03-06 00:00:00'
		),
		array(
			'id' => '7',
			'name' => 'Całkiem nowy LEAD',
			'client_id' => '1',
			'lead_category_id' => '35',
			'lead_status_id' => '7',
			'probability' => '60',
			'amount' => '18751',
			'currency_id' => '2',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'closing_date'      => '2015-03-05 00:00:00',
			'created'           => '2014-12-08 00:00:00',
			'modified'          => '2015-03-05 00:00:00'
		),
	);

}
