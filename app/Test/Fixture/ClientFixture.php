<?php

/**
 * ClientFixture
 *
 */
class ClientFixture extends CakeTestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Nazwa firmy', 'charset' => 'utf8'),
        'street' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Ulica', 'charset' => 'utf8'),
        'zipcode' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Kod pocztowy', 'charset' => 'utf8'),
        'city' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Miasto', 'charset' => 'utf8'),
        'country' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Kraj', 'charset' => 'utf8'),
        'phone' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Telefon', 'charset' => 'utf8'),
        'site' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Adres strony WWW', 'charset' => 'utf8'),
        'email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Email', 'charset' => 'utf8'),
        'nip' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 16, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => 'Id user_user', 'charset' => 'utf8'),
        'account_manager_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => 'ID Handlowca FEB odpowiedzialnego za klienta', 'charset' => 'utf8'),
        'comarch_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'ID kontrahenta w Comarch Optima'),
        'archive' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
            'name' => 'Budizol',
            'street' => 'Testowa',
            'zipcode' => NULL,
            'city' => 'Warszawa',
            'country' => 'Polska',
            'phone' => '344234323',
            'site' => 'www.budizol-beton.pl',
            'email' => 'test_dev@febdev.pl',
            'nip' => NULL,
            'user_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
            'account_manager_id' => '55680f13-8020-4ded-8783-2a45904cf98e',
            'comarch_id' => NULL,
            'archive' => 0,
            'modified' => NULL,
            'created' => NULL
        ),
        array(
            'id' => '2',
            'name' => 'nowy',
            'street' => 'tes',
            'zipcode' => NULL,
            'city' => 'tes',
            'country' => 'tes',
            'phone' => '123456789',
            'site' => 'www.feb.net.pl',
            'email' => 'd.czyz+1@feb.net.pl',
            'nip' => NULL,
            'user_id' => NULL,
            'account_manager_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
            'comarch_id' => NULL,
            'archive' => 0,
            'modified' => NULL,
            'created' => NULL
        ),
        array(
            'id' => '3',
            'name' => 'Testowy klient Mati',
            'street' => 'Kopytkowa',
            'zipcode' => '',
            'city' => 'Jurkowo',
            'country' => 'Pl',
            'phone' => '799256536',
            'site' => 'test.example.com',
            'email' => 'test_dev@febdev.pl',
            'nip' => NULL,
            'user_id' => '557560c2-1e00-4fdf-ac0f-13b877ecc6b3',
            'account_manager_id' => '556715b8-bbd8-4641-85f6-1adc904cf98e',
            'comarch_id' => NULL,
            'archive' => 0,
            'modified' => NULL,
            'created' => NULL
        ),
        array(
            'id' => '4',
            'name' => 'MK',
            'street' => '',
            'zipcode' => NULL,
            'city' => '',
            'country' => '',
            'phone' => '123123123',
            'site' => 'www.onet.pl',
            'email' => 'mkustra0@gmail.com',
            'nip' => NULL,
            'user_id' => '55798368-b494-4063-97c5-163c77ecc6b3',
            'account_manager_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
            'comarch_id' => NULL,
            'archive' => 0,
            'modified' => NULL,
            'created' => NULL
        ),
        array(
            'id' => '6',
            'name' => 'Nowy klient44',
            'street' => 'tet',
            'zipcode' => '33-333',
            'city' => 'rzeszow',
            'country' => 'polska',
            'phone' => '123456789',
            'site' => 'www.feb.net.pl',
            'email' => 'client33@feb.net.pl',
            'nip' => NULL,
            'user_id' => '5587af7a-e7ec-4ae9-b671-1ef477ecc6b3',
            'account_manager_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
            'comarch_id' => NULL,
            'archive' => 0,
            'modified' => NULL,
            'created' => NULL
        ),
    );

}
