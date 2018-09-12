<?php

App::uses('AppController', 'Controller');

//App::import('Vendor', 'select', array('file' => 'optima' . DS . 'select.php'));
/**
 * Profiles Controller
 *
 * @property Profile $Profile
 */
class ClientsController extends AppController
{

    /**
     * Nazwa layoutu
     */
    public $layout = 'default';

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array('Metronic', 'Html');

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array('CheckAccess'); //Slug.Slug
    public $uses = array('Client', 'LeadLog', 'LeadFile');

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('profile','connect_client_to_optima'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index()
    {
        $title = 'CRM';
        $subtitle = 'Lista klientów';

        // Pobranie listy klientów
        $clients = $this->CheckAccess->getClients();

//        $endpoint = array(
//            'location' => "http://192.168.0.226/soap.php",
//            'uri' => "http://feb.optima/"
//        );
//        $client = new SoapClient(null, $endpoint);

        $this->set(compact('title', 'subtitle', 'clients'));
    }

    /**
     * Akcja wyświetlająca listę zarchiwizowanych klientów
     * 
     * @return void
     */
    public function archive()
    {
        $title = 'Klienci zarchiwizowani';
        $subtitle = 'Klienci zarchiwizowani';

        // Pobranie listy klientów
        $archive = 1;
        $clients = $this->CheckAccess->getClients($archive);

        $this->set(compact('title', 'subtitle', 'clients'));
    }

    /**
     * Wyświetlanie szczegółów danego klienta
     * 
     * @param int $client_id   ID Klienta
     */
    public function view($client_id = null)
    {
        $title = 'CRM';
        $subtitle = 'Szczegóły klienta';

        // Pobranie listy klientów
        $clients = $this->CheckAccess->getClients();

        // Pobranie szczegółów danego klienta
        $client_details = $this->Client->getClientDetails($client_id);

        // Pobranie notatek danego klienta
        $this->loadModel('ClientNote');
        $client_notes = $this->ClientNote->getClientNotes($this->Session->read('Auth.User.id'), $client_id);

        // Pobranie osób kontaktowych
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

        // Pobranie listy leadów
        $this->loadModel('ClientLead');
        $leads = $this->ClientLead->getLeads($client_id);

        // Pobranie listy leadów
        $this->loadModel('ClientProject');
        $this->loadModel('Payment');

        $clientProjectsQuery = $this->ClientProject->getDataTable($client_id);

        if ($clientProjectsQuery)
        {
            foreach ($clientProjectsQuery as $apq)
            {
                $allProjects[$apq['id']] = $apq;
                $allProjects[$apq['id']]['timeline'] = $this->ClientProject->timeline($apq['id']);
                $allProjects[$apq['id']]['timelinePayments'] = $this->Payment->parseTimeLine($apq['id']);
            }
        }
        // Pobranie płatnosci
        $this->loadModel('Payment');
        $payments = $this->Payment->getClientPayments($client_id);
        $this->set(compact('title', 'subtitle', 'allProjects', 'payments', 'clients', 'client_details', 'client_notes', 'client_contacts', 'leadCategories', 'leadStatuses', 'currencies', 'leads', 'client_id'));
    }

    /**
     * Dodawanie notatek do klienta
     */
    public function add_client_note()
    {
        if ($this->request->is('post') AND ! empty($this->request->data['ClientNote']))
        {
            $this->loadModel('ClientNote');
            if ($this->ClientNote->addClientNote($this->request->data))
            {
                $this->Session->setFlash('Notatka została dodana.', 'flash/success', array(), 'note');
            } else
            {
                $this->Session->setFlash('Notatka nie została dodana. Sprawdź formularz i spróbuj ponownie', 'flash/error', array(), 'note');
            }

            $this->redirect($this->referer());
        }
    }

    /**
     * Usuwanie notatek 
     */
    public function delete_client_note($id = null)
    {
        if (empty($id))
        {
            $this->Session->setFlash('Nie ma takiej strony.', 'flash/error', array(), 'note');
            $this->redirect($this->referer());
        }
        $this->loadModel('ClientNote');
        if ($this->ClientNote->deleteClientNote($id))
        {
            $this->Session->setFlash('Notatka została usunięta.', 'flash/success', array(), 'note');
        } else
        {
            $this->Session->setFlash('Notatka nie została usunięta.', 'flash/error', array(), 'note');
        }

        $this->redirect($this->referer());
    }

    /**
     * Dodawanie osób kontaktowych
     */
    public function add_client_contact()
    {
        if ($this->request->is('post') && !empty($this->request->data['ClientContact']))
        {

            $this->loadModel('ClientContact');
            if ($this->ClientContact->addClientContact($this->request->data))
            {
                $this->Session->setFlash('Osoba kontaktowa została dodana.', 'flash/success', array(), 'contact');
            } else
            {
                $this->Session->setFlash('Osoba kontaktowa nie została dodana. Sprawdź formularz i spróbuj ponownie', 'flash/error', array(), 'contact');
            }

            $this->redirect($this->referer());
        }
    }

    /**
     * Usuwanie osób kontaktowych
     */
    public function delete_client_contact($contact_id = null)
    {
        if (empty($contact_id))
        {
            $this->Session->setFlash('Nie ma takiej strony.', 'flash/error', array(), 'note');
            $this->redirect($this->referer());
        }
        $this->loadModel('ClientContact');
        if ($this->ClientContact->deleteClientContact($contact_id))
        {
            $this->Session->setFlash('Osoba kontaktowa została usunięta.', 'flash/success', array(), 'contact');
        } else
        {
            $this->Session->setFlash('Osoba kontaktowa nie została usunięta.', 'flash/error', array(), 'contact');
        }

        $this->redirect($this->referer());
    }

    /**
     * Dodawanie osób kontaktowych do leadu z listy
     */
    public function add_lead_contact_list($lead_id, $contact_id)
    {
        $this->loadModel('ClientLead');
        if ($this->ClientLead->addClientContactList($lead_id, $contact_id))
        {
            $this->Session->setFlash('Osoba kontaktowa została dodana.', 'flash/success', array(), 'contact');
        } else
        {
            $this->Session->setFlash('Osoba kontaktowa nie została dodana. Sprawdź formularz i spróbuj ponownie', 'flash/error', array(), 'contact');
        }

        $this->redirect($this->referer());
    }

    /**
     * Dodawanie klienta
     */
    function add_client()
    {
        // Dodanie klienta
        if ($this->Client->addClient($this->request->data))
        {
            $this->Session->setFlash('Klient został pomyślnie dodany.', 'flash/success', array(), 'client');
        } else
        {
            $this->Session->setFlash('Klient nie został dodany. Sprawdź formularz i spróbuj ponownie.', 'flash/error', array(), 'client');
        }

        $this->redirect($this->referer());
    }

    /**
     * Dodawanie klienta
     */
    function edit_client()
    {
        // Dodanie klienta
        if (empty($this->request->data['Client']['email']))
        {
            $this->Session->setFlash('Dane klienta nie zostały zmienione. Sprawdź formularz i spróbuj ponownie.', 'flash/error');
            $this->redirect($this->referer());
        }
        //die(debug($this->request->data['Client']));
        $params['conditions'] = array(
            'email' => $this->request->data['Client']['email'],
            'id != ' => $this->request->data['Client']['user_id']
        );
        $params['recursive'] = -1;
        $user = $this->User->find('all', $params); //sprawdzam czy istnieje inny użytkownik z takim samym mailem

        if (!empty($user))
        {
            $this->Session->setFlash(__d('public', 'Taki email już instnieje w bazie!'), 'flash/error');
            $this->redirect($this->referer());
        }

        if ($this->Client->editClient($this->request->data))
        {
            $this->Session->setFlash('Dane klienta zostały pomyślnie zmienione.', 'flash/success');
        } else
        {
            $this->Session->setFlash('Dane klienta nie zostały zmienione. Sprawdź formularz i spróbuj ponownie.', 'flash/error');
        }

        $this->redirect($this->referer());
    }

    /*
     * generowanie raportu
     */

    function lead_report()
    {
        $title = 'CRM';
        $subtitle = 'Raport z leadów';

        $clients = $this->CheckAccess->getClients(); // Pobranie listy klientów [potrzebne to??]

        $this->loadModel('Profile');
        $profile = $this->Profile->getProfile($this->Session->read('Auth.User.id'));
        $post = false;

        if ($this->request->is('post'))
        {
            $client_id = $this->request->data['ClientLeadReport']['client_id'];
            $client_details = $this->Client->getClientDetails($this->request->data['ClientLeadReport']['client_id']);

            $data = $this->request->data;
            if ($this->Session->read('Auth.User.id') != $data['ClientLeadReport']['user_id'])
            {
                $this->Session->setFlash('Nie możesz przeglądać raportów innych użytkowników.', 'flash/error', array(), 'report');
                $this->redirect($this->referer());
            }
            $this->loadModel('ClientLead');

            $leads_created_query = $this->ClientLead->getUserCreatedLeadsByDate($this->Session->read('Auth.User.id'), $data['ClientLeadReport']['client_id'], $data['ClientLeadReport']['date_start'], $data['ClientLeadReport']['date_end']);
            $lead_created = count($leads_created_query);
            //debug($leads_created_query);
            $leads_lost_query = $this->ClientLead->getUserLostLeadsByDate($this->Session->read('Auth.User.id'), $data['ClientLeadReport']['client_id'], $data['ClientLeadReport']['date_start'], $data['ClientLeadReport']['date_end']);
            $lead_lose = count($leads_lost_query);

            $leads_win_query = $this->ClientLead->getUserWinLeadsByDate($this->Session->read('Auth.User.id'), $data['ClientLeadReport']['client_id'], $data['ClientLeadReport']['date_start'], $data['ClientLeadReport']['date_end']);
            $lead_win = count($leads_win_query);

            if (isset($data['ClientLeadReport']['csv']))
            {  //generuje raport csv
                return $this->generateCSV($data, $profile, $leads_created_query, $leads_win_query, $leads_lost_query); //generowanie CSV
            }
            $post = true;
        }

        $this->set(compact('title', 'subtitle', 'post', 'clients', 'client_details', 'profile', 'data', 'client_id', 'leads_lost_query', 'leads_win_query', 'lead_win', 'lead_lose', 'lead_created'));
    }

    /*
     * Metoda generująca CSV
     * 
     * @param			$data
     * 					$profile
     * 					$leads_created_query
     * 					$leads_win_query
     * 					$leads_lost_query
     * 
     * @return mixed	false - jeśli nie wszystkie dane zostaną przekazanae do funkcji
     * 					csv - do pobrania
     */

    function generateCSV($data = null, $profile = null, $leads_created_query = null, $leads_win_query = null, $leads_lost_query = null)
    {
        $this->autoRender = false;

        if (empty($data) || empty($profile))
        {
            return false;
        }

        header("Content-type: application/xhtml+xml;");
        header("Content-Disposition: attachment; filename=" . $profile['Profile']['firstname'] . '_' . $profile['Profile']['surname'] . '_' . $data['ClientLeadReport']['date_start'] . '-' . $data['ClientLeadReport']['date_end'] . ".csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $lead_lose = count($leads_lost_query);
        $lead_win = count($leads_win_query);
        $lead_created = count($leads_created_query);

        $tmp[] = $profile['Profile']['firstname'] . ' ' . $profile['Profile']['surname'];
        $tmp[] = 'Klient ; ' . $data['ClientLeadReport']['client_name'];
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

    function archive_client($client_id)
    {
        if ($this->Client->archiveClient((int) $client_id))
        {
            $this->Session->setFlash('Klient został pomyślnie zarchiwizowany. Konto zostało dezaktywowane', 'flash/success', array(), 'archive');
        } else
        {
            $this->Session->setFlash('Wystąpił bląd proszę spróbować ponownie.', 'flash/error', array(), 'archive');
        }
        $this->redirect($this->referer());
    }

    function delete_client($client_id)
    {
        if ($this->Client->delete((int) $client_id))
        {
            $this->Session->setFlash('Klient został usuniety!', 'flash/success', array(), 'delete');
        } else
        {
            $this->Session->setFlash('Wystąpił bląd proszę spróbować ponownie.', 'flash/error', array(), 'delete');
        }
        $this->redirect(array('action' => 'index'));
    }

    function unarchive_client($client_id)
    {
        if ($this->Client->unarchiveClient((int) $client_id))
        {
            $this->Session->setFlash('Klient został pomyślnie przywrócony.', 'flash/success', array(), 'archive');
        } else
        {
            $this->Session->setFlash('Wystąpił bląd proszę spróbować ponownie.', 'flash/error', array(), 'archive');
        }
        $this->redirect($this->referer());
    }

    public function profile()
    {
        $title = 'Edytuj profil';
        $subtitle = 'Edytuj profil';

        $this->set(compact('title', 'subtitle'));
    }

    /*
     * metoda zapisuje klienta b2b do optimy
     */

    public function connect_client_to_optima($client_id)
    {

        $client = $this->Client->getClientDetails($client_id);
        if (empty($client))
        {
            $this->Session->setFlash(__d('public', 'Nie ma takiego klienta.'), 'flash/error');
            $this->redirect($this->referer());
        }

        $this->loadModel('Invoice');
        $soap = $this->Invoice->connectComarch(1);

        if ($client['Client']['comarch_id'])
        {
            $erpClient = $soap->pobierzKontrahentaPoId($client['Client']['comarch_id']);
            if (empty($erpClient) || empty($erpClient['id']))
            {
                $this->Session->setFlash(__d('public', 'Synchronizacja się nie powiodła'), 'flash/error');
                $this->redirect($this->referer());
            }
            $saveData = array(
                'id' => $client['Client']['id'],
                'name' => $erpClient['nazwa1'],
                'street' => $erpClient['ulica'],
                'zipcode' => $erpClient['kod_pocztowy'],
                'city' => $erpClient['miasto'],
                'country' => $erpClient['kraj'],
                'phone' => $erpClient['telefon1'],
                'email' => $erpClient['email'],
                'nip' => $erpClient['nip'],
            );
            if ($this->Client->save($saveData))
            {
                $this->Session->setFlash(__d('public', 'Synchronizacja się powiodła'), 'flash/success');
            } else
            {
                $this->Session->setFlash(__d('public', 'Nie udało sie zapisać do bazy'), 'flash/error');
            }
            $this->redirect($this->referer());
        }
        //usuwam nulle i zastpuje je pustymi wartościami(inaczej optima tego nie przyjmie)
        foreach ($client['Client'] as $key => $value)
        {
            if ($value == null)
            {
                $client['Client'][$key] = "";
            }
        }

        $typ = 0;
        $dostawca = 1;
        $odbiorca = 1;
        $eksport = 0;
        $platnik = 1;
        $ceny = "detaliczna";
        $grupa = "ODB_FIRMY";
        //dodajKontrahenta($typ, $dostawca, $odbiorca, $export, $platnik, $ceny, $grupa, $kod, $nazwa1, $nazwa2, $opis,
        //				  $kraj, $wojewodztwo, $kod_pocztowy, $miasto, $ulica, $nr_domu, $nr_lokalu, $nip, $nip_kraj_ue,
        //				  $telefon1, $telefon2, $email, $konto_bankowe, $projekt)
        $return = $soap->dodajKontrahenta($typ, $dostawca, $odbiorca, $eksport, $platnik, $ceny, $grupa, $client['Client']['id'], $client['Client']['name'], '', '', $client['Client']['country'], '', $client['Client']['zipcode'], $client['Client']['city'], $client['Client']['street'], '', '', $client['Client']['nip'], '', $client['Client']['phone'], '', $client['Client']['email'],'', 0);
        if ($return)
        {
            $this->Client->id = $client['Client']['id'];
            $this->Client->saveField('comarch_id', $return);
            $this->Session->setFlash(__d('public', 'Zsynchronizowano klienta z Optimą.'), 'flash/success');
            $this->redirect($this->referer());
        } else {
            $this->Session->setFlash(__d('public', 'Wystąpił błąd.'), 'flash/error');
            $this->redirect($this->referer());
        }
    }

}
