<?php
/* Invoice Fixture generated on: 2015-04-28 09:14:25 : 1430212465 */

/**
 * InvoiceFixture
 *
 */
class InvoiceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'client_project_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'payment_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'klient wybrany z crm'),
		'invoice_nr' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'month' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 2, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'year' => array('type' => 'text', 'null' => false, 'default' => null, 'length' => 4),
		'type' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'faktura zakupowa, sprzedażowa etc.'),
		'account_number' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'net_price' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'kwota netto', 'charset' => 'utf8'),
		'gross_price' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'kwota brutto', 'charset' => 'utf8'),
		'vat_rate' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'Stawka VAT'),
		'vat_amount' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'kwota VAT'),
		'place' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'payment_date' => array('type' => 'date', 'null' => false, 'default' => null, 'comment' => 'data płatności'),
		'paid' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'comment' => 'faktura opłacona'),
		'file' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'notatka/opis faktury', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => 'data wystawienia'),
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
			'client_project_id' => 1,
			'payment_id' => 11,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'client_id' => 1,
			'invoice_nr' => 'Lorem ipsum dolor sit amet',
			'month' => '',
			'year' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'type' => 1,
			'account_number' => 'Lorem ipsum dolor sit amet',
			'net_price' => 'Lorem ipsum dolor ',
			'gross_price' => 'Lorem ipsum dolor ',
			'vat_rate' => 1,
			'vat_amount' => 1,
			'place' => 'Lorem ipsum dolor sit amet',
			'payment_date' => '2015-04-28',
			'paid' => 1,
			'file' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'created' => '2015-04-28 09:14:25',
			'modified' => '2015-04-28 09:14:25'
		),
	);
}
