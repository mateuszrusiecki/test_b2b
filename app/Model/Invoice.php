<?php

App::uses('AppModel', 'Model');

/**
 * Invoice Model
 *
 * @property ClientProject $ClientProject
 * @property Client $Client
 */
class Invoice extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'invoice_nr';

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'ClientProject' => array(
            'className' => 'ClientProject',
            'foreignKey' => 'client_project_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Payment' => array(
            'className' => 'Payment',
            'foreignKey' => 'payment_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'fields' => '',
            'order' => '',
        )
    );
    public $hasMany = array(
        'InvoicePosition' => array(
            'className' => 'InvoicePosition',
            'foreignKey' => 'invoice_id',
            'dependent' => false
        )
    );

    /**
     * Konstruktor klasy modelu
     * 
     * @param int $id
     * @param array $table
     * @param bool $ds 
     */
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        //$this->virtualFields = array('fullname' => "CONCAT({$this->alias}.field_1, ' ', {$this->alias}.field_2)");
    }

    /*
     * Metoda pobiera wszystkie faktury
     */

    function getAllInvoices($recursive = 0)
    {
        $params['recursive'] = $recursive;
        return $this->find('all', $params);
    }

    /*
     * Metoda pobiera wszystkie faktury dla klienta
     */

    function getClientInvoices($user_id = null)
    {
        if (!$this->User->exists($user_id))
        {
            return false;
        }
        $params['recursive'] = 1;
        $params['conditions']['Client.user_id'] = $user_id;
        return $this->find('all', $params);
    }

    /*
     * Metoda pobiera wszystkie faktury
     */

    function getInvoice($id = null, $recursive = 0)
    {
        if (empty($id))
        {
            return false;
        }
        $params['conditions']['Invoice.id'] = (int) $id;
        $params['recursive'] = $recursive;
        return $this->find('first', $params);
    }

    /*
     * Metoda do połaczenia sie z serwerem sopa do comarcha
     */

    function connectComarch($trace = null)
    {
        ini_set("soap.wsdl_cache_enabled", "0");
        $endpoint = array(
            //'location' => "http://192.168.0.226/soap.php",
            'location' => "http://biuro.feb.net.pl:8008/soap.php",
            'uri' => "http://feb.optima/"
        );
        if (!empty($trace))
        {
            $endpoint['trace'] = $trace;
        }
        $client = new SoapClient(null, $endpoint);
        return $client;
    }

    /*
     * Metoda przygotowuje dane do zapisu
     */

    function parseComarchInvoice($id = null, $comarch_positions = array())
    {
        //forma płatnosci roznica miedzy bazą a comarchem
        $payment_types['gotówka'] = 'cash';
        $payment_types['przelew'] = 'trasfer';

        if (empty($id))
        {
            return false;
        }
        if (empty($comarch_positions) || !is_array($comarch_positions))
        {
            return false;
        }
        if (!$this->exists($id))
        {
            return false;
        }
        $paramsInv['recursive'] = -1;
        $paramsInv['conditions']['Invoice.id'] = $id;
        $data = $this->find('first', $paramsInv);

        $data['Invoice']['net_price'] = 0;
        $data['Invoice']['gross_price'] = 0;

        foreach ($comarch_positions as $position)
        {
            $data['InvoicePosition'][] = array(
                'name' => $position['nazwa_towaru'],
                'quantity' => $position['ilosc'],
                'unit_price' => $position['wartosc_netto'] / $position['ilosc'],
                'net_value' => $position['wartosc_netto'],
                'tax' => $position['stawka_vat'],
                'tax_value' => $position['kwota_vat'],
                'gross_value' => $position['wartosc_brutto']
            );

            $data['Invoice']['net_price'] += $position['wartosc_netto'];
            $data['Invoice']['gross_price'] += $position['wartosc_brutto'];
        }

        //przesuniete z foreacha zeby nie nadpisywało za każdym razem jeśli faktura ma kilka pozycji
        $data['Invoice']['invoice_nr'] = $position['numer_faktury'];
        $data['Invoice']['paid_amount'] = $data['Invoice']['gross_price'] - $position['pozostalo_do_zaplaty'];
        $data['Invoice']['payment_date'] = $position['termin_platnosci'];
        $data['Invoice']['issue_date'] = $position['data_dokumentu'];
        $data['Invoice']['description'] = $position['opis_faktury'];
        $data['Invoice']['vat_rate'] = $position['stawka_vat'];

        if($position['pozostalo_do_zaplaty'] == '0.00'){
            $data['Invoice']['paid'] = 1;
        } else{
            $data['Invoice']['paid'] = '0';
        }

        $payment_type = $time = strtotime($data['Invoice']['created']);
        $data['Invoice']['month'] = date('m', $time);
        $data['Invoice']['year'] = date('Y', $time);
        unset($data['Invoice']['id']);
        unset($data['Invoice']['created']);
        unset($data['Invoice']['modified']);

        $paramClient['conditions']['comarch_id'] = $position['id_kontrahenta'];
        $paramClient['recursive'] = -1;
        $paramClient['fields'] = array('id', 'id');
        $client = $this->Client->find('list', $paramClient);
        if (empty($client))
        {
            return false;
        }
        $data['Invoice']['client_id'] = reset($client);

        $data['Invoice']['type'] = '1';

        $payment_type = empty($payment_types[$position['forma_platnosci']]) ? '' : $payment_types[$position['forma_platnosci']];
        $data['Invoice']['payment_type'] = $payment_type;
        $data['Invoice']['vat_amount'] = $data['Invoice']['gross_price'] - $data['Invoice']['net_price'];

        return $data;
    }
    
    /*
     * metoda sprawdza czy faktura została opłacona
     */
    function checkPayment($comarch_positions = array())
    {
        if (empty($comarch_positions) || !is_array($comarch_positions))
        {
            return false;
        }
        
        $data['Invoice']['gross_price'] = 0;
        foreach ($comarch_positions as $position)
        {
            $data['Invoice']['gross_price'] += $position['wartosc_brutto'];
        }

        //przesuniete z foreacha zeby nie nadpisywało za każdym razem jeśli faktura ma kilka pozycji
        $data['Invoice']['paid_amount'] = $data['Invoice']['gross_price'] - $position['pozostalo_do_zaplaty'];
        $data['Invoice']['paid'] = 0;
        if($position['pozostalo_do_zaplaty'] == '0.00' || $position['pozostalo_do_zaplaty'] == 0){
            $data['Invoice']['paid'] = 1;
        }

        return $data;
    }

}
