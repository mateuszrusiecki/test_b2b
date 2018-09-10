<?php
/**
 * I18nMessageFixture
 *
 */
class I18nMessageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'msgctxt' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'msgid' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'msgstr' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'domain' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'lang' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 3, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'id' => '1',
			'msgctxt' => '',
			'msgid' => '',
			'msgstr' => 'Plural-Forms: nplurals=3; plural=n==1 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2;',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '2',
			'msgctxt' => '',
			'msgid' => 'January',
			'msgstr' => 'Styczeń',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '3',
			'msgctxt' => '',
			'msgid' => 'February',
			'msgstr' => 'Luty',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '4',
			'msgctxt' => '',
			'msgid' => 'March',
			'msgstr' => 'Marzec',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '5',
			'msgctxt' => '',
			'msgid' => 'April',
			'msgstr' => 'Kwiecień',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '6',
			'msgctxt' => '',
			'msgid' => 'May',
			'msgstr' => 'Maj',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '7',
			'msgctxt' => '',
			'msgid' => 'June',
			'msgstr' => 'Czerwiec',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '8',
			'msgctxt' => '',
			'msgid' => 'July',
			'msgstr' => 'Lipiec',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '9',
			'msgctxt' => '',
			'msgid' => 'August',
			'msgstr' => 'Sierpień',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '10',
			'msgctxt' => '',
			'msgid' => 'September',
			'msgstr' => 'Wrzesień',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '11',
			'msgctxt' => '',
			'msgid' => 'October',
			'msgstr' => 'Październik',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '12',
			'msgctxt' => '',
			'msgid' => 'November',
			'msgstr' => 'Listopad',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '13',
			'msgctxt' => '',
			'msgid' => 'December',
			'msgstr' => 'Grudzień',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '14',
			'msgctxt' => '',
			'msgid' => '1 punkt',
			'msgstr' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '15',
			'msgctxt' => '',
			'msgid' => 'Actions',
			'msgstr' => 'Opcje',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '16',
			'msgctxt' => '',
			'msgid' => 'Delete',
			'msgstr' => 'Usuń',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '17',
			'msgctxt' => '',
			'msgid' => 'Delete %s',
			'msgstr' => 'Usuń %s',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '18',
			'msgctxt' => '',
			'msgid' => 'New',
			'msgstr' => 'Dodaj',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '19',
			'msgctxt' => '',
			'msgid' => 'New %s',
			'msgstr' => 'Dodaj %s',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '20',
			'msgctxt' => '',
			'msgid' => 'View',
			'msgstr' => 'Szczegóły',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '21',
			'msgctxt' => '',
			'msgid' => 'Edit',
			'msgstr' => 'Edytuj',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '22',
			'msgctxt' => '',
			'msgid' => 'Edit %s',
			'msgstr' => 'Edytuj %s',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '23',
			'msgctxt' => '',
			'msgid' => 'List %s',
			'msgstr' => 'Lista %s',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '24',
			'msgctxt' => '',
			'msgid' => 'Submit',
			'msgstr' => 'Wyślij',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '25',
			'msgctxt' => '',
			'msgid' => 'Are you sure you want to delete # %s?',
			'msgstr' => 'Czy napewno chcesz usunąc bezpowrotnie: %s?',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '26',
			'msgctxt' => '',
			'msgid' => 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%',
			'msgstr' => 'Strona %page% z %pages%, pokazano %current% rekordów z %count% wszystkich, zaczynając od %start%, a kończąc na %end%',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '27',
			'msgctxt' => '',
			'msgid' => 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}',
			'msgstr' => 'Strona {:page} z {:pages}, pokazano {:current} rekordów z {:count} wszystkich, zaczynając od {:start}, a kończąc na {:end}',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '28',
			'msgctxt' => '',
			'msgid' => 'previous',
			'msgstr' => 'poprzednia',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '29',
			'msgctxt' => '',
			'msgid' => 'next',
			'msgstr' => 'następna',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '30',
			'msgctxt' => '',
			'msgid' => 'Modified',
			'msgstr' => 'Zmodyfikowano',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '31',
			'msgctxt' => '',
			'msgid' => 'Created',
			'msgstr' => 'Utworzono',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '32',
			'msgctxt' => '',
			'msgid' => 'Deleted',
			'msgstr' => 'Usunięto',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '33',
			'msgctxt' => '',
			'msgid' => 'Name',
			'msgstr' => 'Nazwa',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '34',
			'msgctxt' => '',
			'msgid' => 'Title',
			'msgstr' => 'Tytuł',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '35',
			'msgctxt' => '',
			'msgid' => 'Desc',
			'msgstr' => 'Opis',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '36',
			'msgctxt' => '',
			'msgid' => 'Image',
			'msgstr' => 'Obraz',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '37',
			'msgctxt' => '',
			'msgid' => 'Value',
			'msgstr' => 'Wartość',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '38',
			'msgctxt' => '',
			'msgid' => 'Puncts',
			'msgstr' => 'Punkty',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '39',
			'msgctxt' => '',
			'msgid' => 'User',
			'msgstr' => 'Użytkownik',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '40',
			'msgctxt' => '',
			'msgid' => 'The %s has been saved',
			'msgstr' => 'Zapisano poprawnie',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '41',
			'msgctxt' => '',
			'msgid' => 'The %s could not be saved. Please, try again.',
			'msgstr' => 'Nie udało sie zapisać. Proszę, sprawdź formularz i spróbuj ponownie.',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '42',
			'msgctxt' => '',
			'msgid' => 'Invalid %s',
			'msgstr' => 'Nieprawidłowe %s',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '43',
			'msgctxt' => '',
			'msgid' => 'Invalid id for %s',
			'msgstr' => 'Nieprawidłowe id dla %s',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '44',
			'msgctxt' => '',
			'msgid' => '%s deleted',
			'msgstr' => 'Usunięto',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '45',
			'msgctxt' => '',
			'msgid' => '%s was not deleted',
			'msgstr' => 'false',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
		array(
			'id' => '46',
			'msgctxt' => '',
			'msgid' => 'News',
			'msgstr' => 'Aktualności',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'domain' => 'default.po',
			'lang' => 'pol',
			'created' => '2015-07-21 12:21:14',
			'modified' => '2015-07-22 10:07:44'
		),
	);

}
