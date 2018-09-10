<?php

App::uses('AppController', 'Controller');

/**
 * ClientLeads Controller
 *
 * @property ClientLead $ClientLead
 */
class ClientLeadsController extends AppController
{

    public $components = array('LogMail', 'DownloadFiles', 'CheckAccess', 'PhpExcel.PhpExcel'); //Slug.Slug

    /**
     * index method
     *
     * @return void
     */

    public function index()
    {
        $title = $subtitle = 'Lista leadów';
        $this->ClientLead->recursive = 0;
        $clientLeads = $this->paginate();
        $this->set(compact('clientLeads', 'title', 'subtitle'));
    }

    /**
     * Dodawanie leadu
     */
    public function add()
    {
        $this->loadModel('ClientLead');
        //die(debug($this->request->data));
        $new = $this->ClientLead->addClientLead($this->request->data);
        if ($new)
        {
            $this->Session->setFlash('Lead został pomyślnie dodany.', 'flash/success', array(), 'contact');
        } else
        {
            $this->Session->setFlash('Lead nie został dodany. Sprawdź formularz i spróbuj ponownie.', 'flash/error', array(), 'contact');
        }

        $this->redirect(array('action' => 'view', $new['ClientLead']['client_id'], $new['ClientLead']['id']));
    }

    /**
     * Edycja leadu
     */
    public function edit()
    {
        die(debug($this->request->data['ClientLead']));
        $this->loadModel('LeadLog');
        $data = array();
        $data['LeadLog']['client_lead_id'] = $this->request->data['ClientLead']['client_lead_id']; //klient_lead_id
        $data['LeadLog']['user_id'] = $this->Session->read('Auth.User.id');
        $this->LeadLog->saveLog(7, $data); //log_type - edycja leadu

        $data = $this->request->data;
        if ($data['ClientLead']['lead_status_id'] == 6 || $data['ClientLead']['lead_status_id'] == 7)
        {
            $data['ClientLead']['closing_date'] = date('Y-m-d'); //jeśli projekt jest oznaczany jako wygrany lub przegrany to ustawiam date zamknięcia - closingdate
        }
        if ($this->ClientLead->addClientLead($data))
        {
            $this->Session->setFlash('Lead został pomyślnie wyedytowany.', 'flash/success', array(), 'note');
        } else
        {
            $this->Session->setFlash('Lead nie został zapisany. Sprawdź formularz i spróbuj ponownie.', 'flash/error', array(), 'note');
        }

        $this->redirect($this->referer());
    }

    /**
     * Szczegóły leadu
     */
    public function view($client_id, $id = null)
    {
        $title = 'CRM';
        $subtitle = 'Szczegóły leadu';
        $this->loadModel('Client');
        // Pobranie listy klientów
        //$clients = $this->Client->getClients($this->Session->read('Auth.User.id'));
        $clients = $this->CheckAccess->getClients();

        // Pobranie szczegółów danego klienta
        $client_details = $this->Client->getClientDetails($client_id);
        // Pobranie szczegółów leadu
        $lead = $this->ClientLead->getLeadDetails($id);

        // Pobranie osób kontaktowych powiązanych z leadem
        $lead_contacts = $this->ClientLead->getLeadContacts($id);

        // Pobranie osób kontaktowych powiązanych z klientem
        $this->loadModel('ClientContact');
        $client_contacts = $this->ClientContact->getClientContacts($client_id);

        // Pobranie kategorii leadów
        $this->loadModel('LeadCategory');
        $leadCategories = $this->LeadCategory->find('list');

        // Pobranie statusów leadów
        $this->loadModel('LeadStatus');
        $leadStatuses = $this->LeadStatus->find('list');

        // Pobranie walut
        $this->loadModel('Currency');
        $currencies = $this->Currency->find('list');

        $this->loadModel('HrSetting');
        $hr_settings = $this->HrSetting->getHrSettings();

        $this->loadModel('Settings');
        $params['conditions'] = array(
            'key'=>'App.CrmMailSettings'
        );
        $settings = $this->Settings->find('first',$params);
        
        $this->loadModel('LeadLog');
        $this->LogMail->project_and_lead_mail_log($settings);

        $this->loadModel('ClientProject');
        $client_project = $this->ClientProject->getProjectByLeadId($id, -1);

        $this->loadModel('Brief');
        $brief = $this->Brief->findByClientLeadId($id, -1);

        //	Pobranie logów leadu
        $leadlogs = $this->LeadLog->getLogList($id); //pobieram listę logów
        $log_type = $this->LeadLog->log_type;
        //debug($leadFileCategory);
        if ($leadlogs)
        {
            foreach ($leadlogs as &$leadlog)
            {
                $leadlog['LeadLog']['type_log_id'] = $log_type[$leadlog['LeadLog']['type_log_id']];
                $leadlog['LeadLog']['message'] = stripslashes($leadlog['LeadLog']['message']);
            }
        }
        //$leadlogs = $leadlogs ? $leadlogs : array();

        $this->request->data['ClientLead'] = $lead['ClientLead'];

        //pobieranie listy kategori do popupa
        $this->loadModel('ProjectFileCategory');
        $fileCategory = $this->ProjectFileCategory->getList();

        //pobieranie listy sekcji do popupa
        $this->loadModel('Section');
        $sections = $this->Section->find('list');

        $this->set(compact('title', 'subtitle', 'leadfiles', 'leadlogs', 'log_type', 'client_project', 'fileCategory', 'sections', 'clients', 'lead', 'brief', 'lead_contacts', 'leadCategories', 'client_contacts', 'client_id', 'client_details', 'leadCategories', 'leadStatuses', 'currencies', 'emails_list'));
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->ClientLead->id = $id;
        if (!$this->ClientLead->exists())
        {
            throw new NotFoundException(__('Invalid client lead'));
        }
        if ($this->ClientLead->delete())
        {
            $this->Session->setFlash(__('Client lead deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Client lead was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Usuwanie osób kontaktowych
     */
    public function delete_lead_contact($lead_id = null, $contact_id = null)
    {
        $this->loadModel('ClientContactClientLead');
        if ($this->ClientContactClientLead->deleteClientContactClientLead($lead_id, $contact_id))
        {
            $this->Session->setFlash('Osoba kontaktowa została usunięta.', 'flash/success', array(), 'contact');
        } else
        {
            $this->Session->setFlash('Osoba kontaktowa nie została usunięta.', 'flash/error', array(), 'contact');
        }

        $this->redirect($this->referer());
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->ClientLead->recursive = 0;
        $this->set('clientLeads', $this->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->ClientLead->id = $id;
        if (!$this->ClientLead->exists())
        {
            throw new NotFoundException(__('Invalid client lead'));
        }
        $this->set('clientLead', $this->ClientLead->read(null, $id));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post'))
        {
            $this->ClientLead->create();
            if ($this->ClientLead->save($this->request->data))
            {
                $this->Session->setFlash(__('The client lead has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The client lead could not be saved. Please, try again.'));
            }
        }
        $clients = $this->ClientLead->Client->find('list');
        $leadCategories = $this->ClientLead->LeadCategory->find('list');
        $leadStatuses = $this->ClientLead->LeadStatus->find('list');
        $currencies = $this->ClientLead->Currency->find('list');
        $users = $this->ClientLead->User->find('list');
        $clientContacts = $this->ClientLead->ClientContact->find('list');
        $this->set(compact('clients', 'leadCategories', 'leadStatuses', 'currencies', 'users', 'clientContacts'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->ClientLead->id = $id;
        if (!$this->ClientLead->exists())
        {
            throw new NotFoundException(__('Invalid client lead'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->ClientLead->save($this->request->data))
            {
                $this->Session->setFlash(__('The client lead has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The client lead could not be saved. Please, try again.'));
            }
        } else
        {
            $this->request->data = $this->ClientLead->read(null, $id);
        }
        $clients = $this->ClientLead->Client->find('list');
        $leadCategories = $this->ClientLead->LeadCategory->find('list');
        $leadStatuses = $this->ClientLead->LeadStatus->find('list');
        $currencies = $this->ClientLead->Currency->find('list');
        $users = $this->ClientLead->User->find('list');
        $clientContacts = $this->ClientLead->ClientContact->find('list');
        $this->set(compact('clients', 'leadCategories', 'leadStatuses', 'currencies', 'users', 'clientContacts'));
    }

    /**
     * admin_delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->ClientLead->id = $id;
        if (!$this->ClientLead->exists())
        {
            throw new NotFoundException(__('Invalid client lead'));
        }
        if ($this->ClientLead->delete())
        {
            $this->Session->setFlash(__('Client lead deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Client lead was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function file_save($id = null)
    {
        if (empty($id))
        {
            return false;
        }

        $this->loadModel('LeadFile');
        $file = $this->LeadFile->getFile($id);

        //downloadFiles component
        $this->DownloadFiles->download($file['LeadFile'], 'leadfile');
    }

    function lead_report_all()
    {
        $title = 'CRM';
        $subtitle = 'Raport z leadów';

        // Pobranie listy klientów
        $this->loadModel('Client');
        //$clients = $this->Client->getClients($this->Session->read('Auth.User.id'));
        $clients = $this->CheckAccess->getClients();
        $this->loadModel('Profile');
        $profile = $this->Profile->getProfile($this->Session->read('Auth.User.id'));

        if ($this->request->is('post') || $this->request->is('put'))
        {
            $data = $this->request->data;
            $this->loadModel('ClientLead');
            //die(debug($data));
            $leads_created_query = $this->ClientLead->getAllUserCreatedLeadsByDate($this->Session->read('Auth.User.id'), $data['ClientLeadReport']['date_start'], $data['ClientLeadReport']['date_end']);
            $lead_created = count($leads_created_query);

            $leads_lost_query = $this->ClientLead->getAllUserLostLeadsByDate($this->Session->read('Auth.User.id'), $data['ClientLeadReport']['date_start'], $data['ClientLeadReport']['date_end']);
            $lead_lose = count($leads_lost_query);

            $leads_win_query = $this->ClientLead->getAllUserWinLeadsByDate($this->Session->read('Auth.User.id'), $data['ClientLeadReport']['date_start'], $data['ClientLeadReport']['date_end']);
            $lead_win = count($leads_win_query);

            if (isset($data['ClientLeadReport']['csv']))
            {  //generuje raport csv
                $this->autoRender = false;

                header("Content-type: application/xhtml+xml;");
                header("Content-Disposition: attachment; filename=" . $profile['Profile']['firstname'] . '_' . $profile['Profile']['surname'] . '_' . $data['ClientLeadReport']['date_start'] . '-' . $data['ClientLeadReport']['date_end'] . ".csv");
                header("Pragma: no-cache");
                header("Expires: 0");

                $tmp[] = $profile['Profile']['firstname'] . ' ' . $profile['Profile']['surname'];
                $tmp[] = 'Zakres raportu ; ' . $data['ClientLeadReport']['date_start'] . ' ; ' . $data['ClientLeadReport']['date_end'];
                $tmp[] = 'Leady utworzone ; ' . $lead_created;
                $tmp[] = 'Leady wygrane ; ' . $lead_win;
                $tmp[] = 'Leady przegrane ; ' . $lead_lose;
                if (count($leads_win_query) > 0)
                {
                    $tmp[] = ' ; ';
                    $tmp[] = 'Leady wygrane ;';
                    foreach ($leads_win_query as $llq)
                    {
                        $tmp[] = $llq['ClientLead']['name'];
                    }
                }
                if (count($leads_lost_query) > 0)
                {
                    $tmp[] = ' ; ';
                    $tmp[] = 'Leady przegrane ; Komentarz ';
                    foreach ($leads_lost_query as $llq)
                    {
                        $tmp[] = $llq['ClientLead']['name'] . ' ; ' . $llq['ClientLead']['comment'];
                    }
                }

                $string = implode('
				', $tmp);
                $string = iconv("UTF-8", "Windows-1250", $string); //zmiana kodowania dla retarded excel

                return $string;
            }
        }

        $this->set(compact('title', 'subtitle', 'clients', 'profile', 'data', 'leads_lost_query', 'leads_win_query', 'lead_win', 'lead_lose', 'lead_created'));
    }

    public function crm_report()
    {
        $title = 'Raporty';
        $subtitle = 'Raporty';
        $this->set(compact('title', 'subtitle'));
        $workers = array();

        $this->loadModel('Section');
        $workers = $this->Section->listUserBySectionId(8);

        $this->set(compact('workers', 'user_id'));
    }

    public function crm_report_trader()
    {
        $title = 'Raporty';
        $subtitle = 'Raporty';
        $this->set(compact('title', 'subtitle'));
        $workers = array();

        $user_id = $this->Session->read('Auth.User.id');

        $this->set(compact('workers', 'user_id'));
        $this->render('crm_report');
    }

    public function worker_report()
    {
        $user_id = $this->data['workers'];
        $date_from = $this->data['date_from'];
        $date_to = $this->data['date_to'];
        $date_from = date('Y-m-d', strtotime($date_from));
        $date_to = date('Y-m-d', strtotime($date_to));
        //nowe leady
        $report['count_lead'] = $this->ClientLead->countUserLead($user_id, $date_from, $date_to);
        // Wartość wygranych interesów 
        $report['count_lead_status_new'] = $this->ClientLead->countUserLeadAmount($user_id, $date_from, $date_to, 6);
        // Wartość przegranych interesów 
        $report['count_lead_status_close'] = $this->ClientLead->countUserLeadAmount($user_id, $date_from, $date_to, 7);
        //wartosc otwartych interesów
        $report['count_amount'] = $this->ClientLead->countUserLeadAmount($user_id, null, null, array(2, 3, 4, 5));
        //nowi klienci
        $report['count_client'] = $this->ClientLead->Client->countUserClient($user_id, $date_from, $date_to);
        //lejek sprzedaży
        $report['pipeline'] = $this->ClientLead->pipeline($user_id, $date_from, $date_to);
        //Kategorie leadów wykres kołowy
        $report['pie_category'] = $this->ClientLead->pieCategory($user_id, $date_from, $date_to);
        //Kategorie leadów otwartych wykres kołowy
        $report['pie_category_open'] = $this->ClientLead->pieCategory($user_id, $date_from, $date_to, array(2, 3, 4, 5));
        //Kategorie leadów zamkniętych wykres kołowy
        $report['pie_category_close'] = $this->ClientLead->pieCategory($user_id, $date_from, $date_to, array(6, 7));
        //Szpedaż kienta
        $report['pie_customer_sales'] = $this->ClientLead->pieCustomerSales($user_id, $date_from, $date_to, array(6, 7));
        //wartosć podpisanych umów
        $report['value_contracts'] = $this->ClientLead->valueContracts($user_id, $date_from, $date_to);
        $this->set('report', $report);
        $this->set('_serialize', 'report');
    }

    public function raport_xls($user_id = null, $date_from = null, $date_to = null)
    {
        $user_id = explode(',', $this->data['user_id']);
        $date_from = $this->data['date_from'];
        $date_to = $this->data['date_to'];
        ////https://github.com/segy/PhpExcel
        // create new empty worksheet and set default font
        $this->PhpExcel->createWorksheet()
                ->setDefaultFont('Calibri', 12);
        $this->PhpExcel->setSheetName('Ogólnie');
// define table cells
        $table = array(
            array('label' => __('Nazwa'), 'width' => 50, 'filter' => true),
            array('label' => __('Wynik'), 'width' => 50, 'wrap' => true),
        );

// add heading with different font and bold text
        $this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));
//nowi klienci
        $report['count_client'][] = 'nowi klienci';
        $report['count_client'][] = $this->ClientLead->Client->countUserClient($user_id, $date_from, $date_to);
        //nowe leady
        $report['count_lead'][] = 'nowe leady';
        $report['count_lead'][] = $this->ClientLead->countUserLead($user_id, $date_from, $date_to);
        // Wartość wygranych interesów 
        $report['count_lead_status_new'][] = 'Wartość wygranych interesów';
        $report['count_lead_status_new'][] = $this->ClientLead->countUserLeadAmount($user_id, $date_from, $date_to, 6);
        // Wartość przegranych interesów 
        $report['count_lead_status_close'][] = 'Wartość przegranych interesów';
        $report['count_lead_status_close'][] = $this->ClientLead->countUserLeadAmount($user_id, $date_from, $date_to, 7);
        //wartosc otwartych interesów
        $report['count_amount'][] = 'wartość otwartych interesów';
        $report['count_amount'][] = $this->ClientLead->countUserLeadAmount($user_id, null, null, array(2, 3, 4, 5));

// add data
        foreach ($report as $r)
        {
            $this->PhpExcel->addTableRow($r);
        }
        $this->PhpExcel->addSheet('Lejek sprzedaży');
        $table = array(
            array('label' => __('Nazwa'), 'filter' => true),
            array('label' => __('Wynik'), 'width' => 50, 'wrap' => true),
        );

// add heading with different font and bold text
        $this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));
//lejek sprzedaży
        $report = $this->ClientLead->pipeline($user_id, $date_from, $date_to);
        foreach ($report as $r)
        {
            $this->PhpExcel->addTableRow(array($r['name'], $r['count']));
        }

        //Kategorie leadów wykres kołowy
        $pie['kategorie_leadów'] = $this->ClientLead->pieCategory($user_id, $date_from, $date_to);
        //Kategorie leadów otwartych wykres kołowy
        $pie['kategorie_leadów_otwarych'] = $this->ClientLead->pieCategory($user_id, $date_from, $date_to, array(2, 3, 4, 5));
        //Kategorie leadów zamkniętych wykres kołowy
        $pie['kategorie_leadów_zamkniętych'] = $this->ClientLead->pieCategory($user_id, $date_from, $date_to, array(6, 7));
        //Szpedaż kienta
        $pie['sprzedaż_klienta'] = $this->ClientLead->pieCustomerSales($user_id, $date_from, $date_to, array(6, 7));
        foreach ($pie as $name => $p)
        {
            $this->PhpExcel->addSheet(Inflector::humanize($name));
            $table = array(
                array('label' => __('Nazwa'), 'width' => 20, 'filter' => true),
                array('label' => __('Ilość'), 'width' => 50, 'wrap' => true),
                array('label' => __('Procent'), 'width' => 50, 'wrap' => true),
            );
            $this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));
            $foreachtable = array();
            if (isset($p['leadCategories']))
            {
                $foreachtable = ($p['leadCategories']);
            }
            if (isset($p['clients']))
            {
                $foreachtable = ($p['clients']);
            }
            foreach ($foreachtable as $r)
            {
                $this->PhpExcel->addTableRow($r);
            }
        }
//Wartość podpisanych umów
        $this->PhpExcel->addSheet('Wartość podpisanych umów');
        $table = array(
            array('label' => __('Nazwa'), 'filter' => true),
            array('label' => __('Wartość'), 'width' => 50, 'wrap' => true),
            array('label' => __('data'), 'filter' => true),
        );

// add heading with different font and bold text
        $this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));
//lejek sprzedaży
        $report = $this->ClientLead->valueContracts($user_id, $date_from, $date_to);
        foreach ($report['data'] as $r)
        {
            $this->PhpExcel->addTableRow(array($r['name'], $r['amount'], $r['created']));
        }


// close table and output
        $this->PhpExcel->addTableFooter();
        $this->PhpExcel->output();
    }

    /*
     * Widok aktywności użytkowników w panelu CRM przedstawia listę ostatnio
     * wykonanych czynności w leadach.  Lista jest posortowana chronologicznie,
     * domyślnie przedstawia wszystkie działania wszystkich użytkowników we
     * wszystkich leadach. Kliknięcie w użytkownika powoduje pokazanie listy
     * przefiltrowanej do wszystkich czynności danego użytkownika we wszystkich
     * projektach. Kliknięcie w nazwę projektu powoduje analogiczne zachowanie
     * dla projektu.
     */

    public function crm_activity()
    {
        $title = 'Panel aktywnosci';
        $subtitle = 'Panel aktywnosci';

        $this->set(compact('title', 'subtitle'));

        $this->loadModel('LeadLog');
        $param['recursive'] = 1;
        $param['order'] = 'LeadLog.created DESC';

        $user_permission = $this->Session->read('user_permission');
        if ($user_permission == 'trader') //pracownik handlowy może widzieć tylko swoje logi, pozostali mający dostęp widzą wszystkie
        {
            $param['conditions'][] = array(
                'LeadLog.user_id' => $this->Session->read('Auth.User.id')
            );
        }

        $show_all = false;
        if (!empty($this->params['pass'][0]) && !empty($this->params['pass'][1])) //kliknięcie w nazwe urzytkownika lub nazwę leada powoduje przefiltrowanie aktywnosci według tych parametrów
        {
            if ($this->params['pass'][0] == 'lead') //jeśli kliknięto nazwę leada
            {
                $lead_id = $this->params['pass'][1];
                $param['conditions'][] = array(
                    'client_lead_id' => $lead_id
                );
                $show_all = true;
            }
            if ($this->params['pass'][0] == 'user' && $user_permission != 'trader') //jeśli kliknięto nazwę urzytkownika (pracownik handlowy może widzieć tylko swoje logi)
            {
                $user_id = $this->params['pass'][1];
                $param['conditions'][] = array(
                    'LeadLog.user_id' => $user_id
                );
                $show_all = true;
            }
        }

        $this->paginate = $param;
        $lead_logs = $this->paginate('LeadLog', 10); //paginacja
        $log_type = $this->LeadLog->log_type; //typy zdarzeń

        $colors = array('', 'yellow', 'blue', 'green', 'purple', 'yellow-gold', 'blue-steel', 'green-seagreen'); //kolory do teł zdarzeń, pierwsze puste bo zdarzenia numerowane są od 1
        $icons = array(//ikony do typów zdarzeń, pierwsza pusta bo zdarzenia numerowane są od 1
            '',
            'fa-envelope-o', //email
            'fa-file-o', //nowy plik
            'fa-times', //usunięcie pliku
            'fa-copy', //nowa wersja pliku
            'fa-conf', //Data wydarzenia
            'fa-conf', //Wystąpienie wydarzenia
            'fa-edit' //Edycja leadu
        );

        $this->set(compact('lead_logs', 'colors', 'log_type', 'icons', 'user_permission', 'show_all'));
    }

}
