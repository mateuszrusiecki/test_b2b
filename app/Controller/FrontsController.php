<?php

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
require_once '../Vendor/redmine_api/autoload.php';


/**
 * FrontBoxes Controller
 *
 * @property FrontBox $FrontBox
 */
class FrontsController extends AppController {

    /**
     * Nazwa layoutu
     */
    public $layout = 'default';

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array('Metronic');

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array('CheckAccess', 'Sms','LogMail','FebEmail'); //Slug.Slug

    /**
     * Kontroler nie wykorzystuje modelu
     */
    public $uses = false;

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'robots', 'r403', 'client','get_projects_and_leads_mails'));
        
    }

    public function r403() {
        
    }
    
//public function front(){
//   // $this->redirect('client');
//}

    public function filled_poll() {
//        $title = 'Widok modułu';
        $subtitle = 'Informacja';

        $this->set(compact('subtitle'));
    }

    public function client() {
        $title = 'Panel';
        $subtitle = 'Panel Klienta';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        //projekty
        $this->loadModel('ClientProject');
        $allProjectsQuery = $this->ClientProject->getClientProjectTable($user_id);
        $allProjects = $this->ClientProject->parse2TimelineList($allProjectsQuery);

        //dokumenty
        $this->loadModel('ProjectFile');
        $fileCategory = $this->ProjectFile->category;
        $listProjects = Set::combine($allProjectsQuery, '{n}.ClientProject.id', '{n}.ClientProject.name');

        //faktury
        $this->loadModel('Invoice');
        $invoices = $this->Invoice->getClientInvoices($user_id);

        $this->set(compact(
                        'user_id', 'title', 'subtitle', 'allProjects'
                        , 'invoices', 'fileCategory', 'listProjects'
        ));
    }

    public function m_it() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function m_kreacja() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function m_marketing() {
        
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function m_secretariat() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id, 'all');

        //dokumenty
        $this->loadModel('ProjectFile');
        $fileCategory = $this->ProjectFile->category;
        $listProjects = $this->ClientProject->find('list');
        $this->loadModel('Section');
        $sections = $this->Section->find('list');
        $userList = $this->Section->listUserGroupSection();

        //faktury
        $this->loadModel('Invoice');
        $invoices = $this->Invoice->getAllInvoices(1);
        $projectList = $this->ClientProject->find('list');
//debug($invoices);
        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
                        , 'fileCategory', 'listProjects', 'sections', 'userList'
                        , 'invoices', 'projectList'
        ));
        
        //$this->import_optim_invoices();

        $this->render('front');
    }
    
    public function synchronize_optima_invoices() {
        $this->loadModel('Invoice');
        $client = $this->Invoice->connectComarch();
        
        $invoices = $this->Invoice->getAllInvoices(0); 
        //die(debug($invoices));
        $this->loadModel('Invoice');
        $this->loadModel('Payment');
        $this->loadModel('ClientProjectLog');
        
        foreach ($invoices as $inv) {
            if(empty($inv['Invoice']['invoice_nr'])){
                continue;
            }
            $positions = $client->pobierzFakturePoId($inv['Invoice']['invoice_nr'], false);
            $data = $this->Invoice->checkPayment($positions);
            //debug($data);
            if (!empty($data) && $inv['Invoice']['paid_amount'] != $data['Invoice']['paid_amount'] && $data['Invoice']['paid'] == false){ //jesli wykonano wpłatę ale nie opłacono całej faktury
                $this->Invoice->id = $data['Invoice']['id'] = $inv['Invoice']['id'];
                $this->Invoice->saveField('paid_amount', $data['Invoice']['paid_amount']);
            }      
            if(!empty($data) && $data['Invoice']['paid']){ //jeśli opłacono całą fakturę
                $this->mark_invoice_as_paid($inv);
            }
            
        }
        $this->Session->setFlash(__d('public', 'Zsynchronizowano faktury sprzedażowe.'), 'flash/success');
        $this->redirect($this->referer()); 
    }
    
    private function mark_invoice_as_paid($invoice=null)
    {
        if(empty($invoice)){
            return false;
        }
        //wykonuję to metodę w foreachu więc żeby nie ładować modeli za każdym razem ładuje je przed foreachem
//        $this->loadModel('Invoice');
//        $this->loadModel('Payment');
//        $this->loadModel('ClientProjectLog');

        $this->Invoice->id = $invoice['Invoice']['id'];
        $this->Invoice->saveField('paid_amount', $invoice['Invoice']['gross_price']);
        $this->Invoice->saveField('paid', 1); //faktura opłacona

        $this->Payment->id = $invoice['Invoice']['payment_id'];
        $this->Payment->saveField('payment_type', 3); //faktura opłacona

        $data = array();
        $data['ClientProjectLog']['client_project_id'] = $invoice['Invoice']['client_project_id']; //klient_lead_id
        $data['ClientProjectLog']['user_id'] = $_SESSION['Auth']['User']['id'];
        $this->ClientProjectLog->saveLog(16, $data); //log_type - oznaczenie opłacenia faktury
        //$this->FebEmail->sendMarkInvoiceAsPaid($invoice);
        $this->FebEmail->sendInvoiceMail($invoice, 'mark_invoice_as_paid', 'Dziękujemy za opłacenie faktury');

        $params['to'] = $invoice['Client']['phone'];
        $params['message'] = 'Informujemy, ze otrzymaliśmy płatność za fakture nr ' . $invoice['Invoice']['invoice_nr'] . '. Dziękujemy!';
        $this->Sms->sms_send2($params);

    }
    
    public function import_optim_invoices(){
        $this->loadModel('Invoice');
        $client = $this->Invoice->connectComarch();
        $od = "2015-01-01 00:00:00";
        $do = "2015-12-31 23:59:59";
        //$od = date('Y-m-01 00:00:00', strtotime('-1 month')); //miesiąc do tyłu
        //$do = date('Y-m-d H:i:s') //data aktualna

        // wszystkie faktury sprzedaży z podanego okresu
        $return = $client->pobierzFakturySprzedazy($od, $do, false);
        //$return = $client->pobierzWszystkichKontrahentow();
        //debug($return);
        $tmp = array();
        foreach ($return as $inv){
            $tmp[$inv['numer_faktury']][] = $inv; //muszę przekształcić tablicę tab aby pozycje dla jednej faktury były w sub tablicy
        }
        
        foreach ($tmp as $list){
            //$save['']
            $gross_value = 0;
            $net_value = 0;
            $tax_value = 0;
            foreach($list as $inv){
            
                //$invoice = $this->Invoice->save($inv_save);
                $position_save = array('InvoicePosition' => array(
                    //'invoice_id' => $invoice['Invoice']['id'],
                    'name' => $inv['nazwa_towaru'], //
                    //'symbol' => $inv[''],
                    //'jm' => $inv[''],
                    'quantity' => $inv['ilosc'], //$inv['forma_platnosci']
                    'unit_price' => $inv['wartosc_netto']*$inv['ilosc'],
                    'net_value' => $inv['wartosc_netto'],
                    'gross_value' => $inv['wartosc_brutto'],
                    'tax' => $inv['stawka_vat'],
                    'tax_value' => $inv['kwota_vat'],
                ));
                $gross_value +=$inv['wartosc_brutto'];
                $net_value +=$inv['wartosc_netto'];
                $tax_value +=$inv['stawka_vat'];
            }
            
            $inv_save = array('Invoice' => array(
                //'id' => '1',
                'client_project_id' => $inv['atrybut_projekt'], //
                'client_id' => $inv['kod_kontrahenta'],
                //'user_id' => '552cc3b6-2908-4124-84f2-0b3077ecc6b3',
                'payment_id' => null,
                'invoice_nr' => $inv['numer_faktury'],
                'month' => '6',
                'year' => '2015',
                'type' => '1',
                'payment_type' => 'cash', //$inv['forma_platnosci']
                'account_number' => $inv['bank_rachunek'],
                'net_price' => '1500.00',
                'gross_price' => $inv['wartosc_brutto'],
                'vat_rate' => '25',
                'vat_amount' => $tax_value,
                'place' => null,
                'payment_date' => '2015-07-10',
                'issue_date' => null,
                'paid' => '0',
                'paid_amount' => '2000.00',
                //'file' => null,
                'description' => $inv['opis_faktury'],
            ));
        }
        debug($tmp);
    }

    public function m_seo() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function m_slubowisko() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function m_technical() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function m_trader() {
        $title = 'Panel';
        $subtitle = 'Panel handlowca';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function management() {
        $title = 'Panel';
        $subtitle = 'Panel zarządu';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team(1);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id, 'all');

        //dokumenty
        $this->loadModel('ProjectFile');
        $fileCategory = $this->ProjectFile->category;
        $listProjects = $this->ClientProject->find('list');
        $this->loadModel('Section');
        $sections = $this->Section->find('list');
        $userList = $this->Section->listUserGroupSection();

        //faktury
        $this->loadModel('Invoice');
        $invoices = $this->Invoice->getAllInvoices(1);
        $projectList = $this->ClientProject->find('list');

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
                        , 'fileCategory', 'listProjects', 'sections', 'userList'
                        , 'invoices', 'projectList'
        ));
        $this->render('front');
    }

    public function superAdmins() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id, 'all');

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function w_it() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function w_kreacja() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function w_marketing() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function w_secretariat() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id, 'all');

        //dokumenty
        $this->loadModel('ProjectFile');
        $fileCategory = $this->ProjectFile->category;
        $listProjects = $this->ClientProject->find('list');
        $this->loadModel('Section');
        $sections = $this->Section->find('list');
        $userList = $this->Section->listUserGroupSection();

        //faktury
        $this->loadModel('Invoice');
        $invoices = $this->Invoice->getAllInvoices(1);
        $projectList = $this->ClientProject->find('list');

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
                        , 'fileCategory', 'listProjects', 'sections', 'userList'
                        , 'invoices', 'projectList'
        ));
        $this->render('front');
    }

    public function w_seo() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function w_slubowisko() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function w_technical() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    public function w_trader() {
        $title = 'Panel';
        $subtitle = 'Panel użytkownika';
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $myTeam = $this->my_team($session['Auth']['User']['section_id']);
        $aim = $this->my_target($user_id);
        $allProjects = $this->projects_list($user_id);

        $this->set(compact(
                        'myTeam', 'aim', 'title', 'subtitle', 'allProjects'
        ));
        $this->render('front');
    }

    /**
     * Brak indexowania na domenach feb.net.pl
     */
    public function robots() {
        $this->layout = false;

        $this->response->headers = array(
            'content-Type' => 'text/plain'
        );

        if (strpos($this->request->domain(), '.feb.net.pl') === true) {
            $this->render('robots_dev');
        }
    }

    private function my_team($section_id = null) {
        if (empty($section_id)) {
            return false;
        }
        $this->loadModel('Section');
        $myTeam = $this->Section->getTileBySection($section_id);
        return $myTeam;
    }

    private function projects_list($user_id = null) {
        if (empty($user_id)) {
            return false;
        }

        $allProjectsQuery = array();
        $this->loadModel('ClientProject');
        if ($_SESSION['user_permission'] == 'user') { //projekty użytkownika
            $allProjectsQuery = $this->ClientProject->getUserProjectTable($user_id);
        }
        if ($_SESSION['user_permission'] == 'manager' || $_SESSION['user_permission'] == 'trader') { //projekty do których przypisany jest dział użytkownika
            $allProjectsQuery = $this->ClientProject->getManagerProjectTableBySection($_SESSION['Auth']['User']['section_id']);
        }
        if ($_SESSION['user_permission'] == 'all') { //wszystkie projekty
            $allProjectsQuery = $this->ClientProject->getAllProjectTable();
        }
        $allProjects = $this->ClientProject->parse2TimelineList($allProjectsQuery);
        return $allProjects;
    }

    private function my_target($user_id = null) {
        if (empty($user_id)) {
            return false;
        }
        $this->loadModel('PersonalAim');
        $aim = $this->PersonalAim->getPersonalAim($user_id);
        return $aim;
    }

    public function ajaxfilemanager() {
        $this->layout = false;
        $this->autoRender = false;
    }

    public function base_project_list() {
        $title = 'Baza projektów';
        $subtitle = 'baza projektów - lista';

        $this->set(compact('title', 'subtitle'));
    }

    public function base_project_add() {
        $title = 'Baza projektów';
        $subtitle = 'baza projektów - formularz';

        $this->set(compact('title', 'subtitle'));
    }

    public function base_project_view() {
        $title = 'Widok projektu';
        $subtitle = 'Widok projektu';

        $this->set(compact('title', 'subtitle'));
    }

    public function base_modules_list() {
        $title = 'Baza modułów';
        $subtitle = 'baza modułów - formularz';

        $this->set(compact('title', 'subtitle'));
    }

    public function base_modules_add() {
        $title = 'Baza modułów';
        $subtitle = 'baza modułów - formularz';

        $this->set(compact('title', 'subtitle'));
    }

    public function base_modules_view() {
        $title = 'Widok modułu';
        $subtitle = 'Widok modułu';

        $this->set(compact('title', 'subtitle'));
    }


    public function sms() {

        $title = 'Panel sms';
        $subtitle = 'Panel sms';
        
        $this->set(compact('title', 'subtitle'));

        if ($this->request->is('post')) {
            $params['to'] = $this->request->data['sms']['to']; //dodaje kierunkowy
            $params['message'] = $this->request->data['sms']['message'];
            $this->Sms->sms_send2($params);
            $this->Session->setFlash(__d('public', 'SMS został wysłany.'), 'default', array('class' => 'note note-success'));
			return $this->redirect($this->referer());
        }
    }
    
    /*
     * fronts/backup_db
     * metoda tworzy bakup bazy danych do folderu /app/webroot/backup
     */
    public function backup_db(){
         
        $title = 'Kopie bezpieczeństwa';
        $subtitle = 'Kopie bezpieczeństwa';
        
        if ($this->request->is('post')){
            $current = date('Y-m-d_H-i');
            $filePath = WWW_ROOT . DS .'backup' . DS . 'febb2b.database.backup.sql';
            if(file_exists($filePath)) {
                unlink($filePath);
            }
            $file = new File($filePath);
            
            $this->loadModel('Client');
            $tables = $this->Client->query('show tables');
            //debug($tables);
            foreach ($tables as $table){
                $sql='';
                if(isset($table['TABLE_NAMES']['Tables_in_febdev_b2b-test'])){
                    $table_name = $table['TABLE_NAMES']['Tables_in_febdev_b2b-test'];
                    $table_shema = 'febdev_b2b-test';
                }
                if(isset($table['TABLE_NAMES']['Tables_in_feb_b2b'])){
                    $table_name = $table['TABLE_NAMES']['Tables_in_feb_b2b'];
                    $table_shema = 'feb_b2b';
                }
                if(isset($table['TABLE_NAMES']['Tables_in_febdev_b2b'])){
                    $table_name = $table['TABLE_NAMES']['Tables_in_febdev_b2b'];
                    $table_shema = 'febdev_b2b';
                }
                if(isset($table['TABLE_NAMES']['Tables_in_febb2b'])){
                    $table_name = $table['TABLE_NAMES']['Tables_in_febb2b'];
                    $table_shema = 'febb2b';
                }
                
                $single_table_create_script = $this->Client->query('show create table '.$table_name); //zapisuje polecenie stworzenia struktury w sql do zmiennej

                $records = $this->Client->query('SELECT * FROM '.$table_name); //pobieram dane z tabeli
                $columnt_names = $this->Client->query('SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="'.$table_shema.'" AND `TABLE_NAME`="'.$table_name.'"'); //pobieram nazwy kolumn
//debug($columnt_names).'<br/>';
                //sprawdzam czy polecenie istnieje i zaisuje je do zmiennej
                if(!empty($single_table_create_script[0][0])){
                    $backup[] = $single_table_create_script[0][0];
                    $sql.=$single_table_create_script[0][0]['Create Table'].'
;';
                }

                //pomijam zawartość tych dwóch tabel - ich zawartość to w zasadzie logi i zajmują bardzo dużo miejsca przez co skrypt obrabia je zbyt długo i dostaje 'Maximum execution time of 30 seconds exceeded' 
                if($table_name == 'code_errors' || $table_name == 'user_requesters_permissions'){
                    continue;
                }

                //zapis insertów
                if(!empty($records)){
                    $sql.='

INSERT INTO '.$table_name.' VALUES';
                
                    foreach ($records as $record){
                        //$sql.='INSERT INTO '.$table_name.' VALUES(';
                        $sql.="(";
                        foreach ($columnt_names as $c_n){
                            if(is_numeric($record[$table_name][$c_n['COLUMNS']['COLUMN_NAME']])){
                                $sql.=$record[$table_name][$c_n['COLUMNS']['COLUMN_NAME']].',';
                            } else {
                                $sql.='\''.$record[$table_name][$c_n['COLUMNS']['COLUMN_NAME']].'\',';
                            }
                        } 
                        $sql = rtrim($sql, ',');
                        $sql.='),
';
                    }
               // $sql = rtrim($sql, ',');
                    $sql = substr($sql,0,-3);
                    $sql.=';

';
                    $file->append($sql);
                }
            }

            $file->close();
            $this->Session->setFlash(__d('public', 'Backup bazy został zapisany.'), 'default', array('class' => 'note note-success'));
        }
        

        if(file_exists('backup/febb2b.database.backup.sql')){
            $sql_to_download = 'febb2b.database.backup.sql';
            $sql_created_date = date('Y-m-d H:i',filectime('backup/febb2b.database.backup.sql'));
        }
        if(file_exists('../../backup.febdev.tar.gz')){
            $files_to_download = 'backup.febdev.tar.gz';
            $files_created_date = date('Y-m-d H:i',filectime('../../backup.febdev.tar.gz'));
        }
        if(file_exists('backup/backup.febdev.tar.gz')){
            $files_to_download = 'backup.febdev.tar.gz';
            $files_created_date = date('Y-m-d H:i',filectime('/home/febdev/domains/b2b-test.febdev.pl/public_html/backup.febdev.tar.gz'));
        }

        $this->set(compact('files_to_download','sql_to_download','sql_created_date','files_created_date','title','subtitle'));

        //$current = date('Y-m-d_H-i');
         //exec("tar -czf css/backup.aec70eb3419305246f4782f06c58ec8a.tar.gz -C ../../app/webroot/css .");
         //exec("tar -czf folder.tar.gz -C /domains/b2b-test.febdev.pl/public_html/app/webroot/css .");
    }
    
    /*
     * metoda pobiera pliki backup - bazy danych lub plików
     */
    public function download_backup($file){

        if($file == 'febb2b.database.backup.sql'){
            $path = 'backup/febb2b.database.backup.sql';
        }
        if($file == 'backup.febdev.tar.gz'){
            $path = '/home/febdev/domains/b2b-test.febdev.pl/public_html/backup.febdev.tar.gz';
        }
        $this->response->file($path, array(
            'download' => true,
            'name' => $file,
        ));
        
        return $this->response;
    }
    
    
    /*
     * metoda do crona - pobiera maile do projektu i leada
     */
    function get_projects_and_leads_mails(){
        $this->LogMail->project_and_lead_mail_log();
    }
    
}
