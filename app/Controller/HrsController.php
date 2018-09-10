<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'redmine_api', array('file' => 'redmine_api' . DS . 'autoload.php'));
App::uses('CakePdf', 'CakePdf.Pdf');

/**
 * Hrs Controller
 *
 * @property Hr $Hr
 */
class HrsController extends AppController
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
    public $components = array('Price', 'LogMail', 'CheckAccess', 'FebEmail', 'Sms'); //Slug.Slug

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    public $documents = array(
        'informacja_dla_pracownika',
        'karta_szkole_bhp',
        'kwestonariusz_dla_osoby_ubiegajacej',
        'kwestonariusz_dla_pracownika',
        'norma_pracownicza',
        'oswiadczenie_o_odbyciu_instruktazu',
        'oswiadczenie_o_opiece',
        'oswiadczenie_o_podwyzszonych_kup',
        'oswiadczenie_o_zapoznaniu_sie_z_przepisami',
        'oswiadczenie_pracownika',
        'oswiadczenie_wynagrodzenie_przelew',
        'pit_2',
        'upowaznienie'
    );

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('check_invoices_to_pay'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index()
    {
        throw new NotFoundException(__d('cms', 'Akcja w kontrolerze fronts'));
    }

    function invoice($id = null)
    {
        if (!empty($id))
        {
            $title = 'Faktura';
            $subtitle = 'Faktura';

            $this->loadModel('Invoice');
            $invoice = $this->Invoice->getInvoice($id, 1);
            $slownie = $this->Price->slownie(intval($invoice['Invoice']['gross_price']));
            $invoice['Invoice']['slownie'] = $slownie;

            $this->set(compact('invoice', 'title', 'subtitle'));
        } else
        {
            $this->Session->setFlash('Nie ma takiej faktury.', 'flash/error');
            return $this->redirect($this->referer());
        }
    }

    function invoice_pdf($id = null, $download = false)
    {
        $this->layout = 'invoice';

        if (!empty($id))
        {
            $this->loadModel('Invoice');
            $invoice = $this->Invoice->getInvoice($id, 1);
            $slownie = $this->Price->slownie(intval($invoice['Invoice']['gross_price']));
            $invoice['Invoice']['slownie'] = $slownie;
//die(debug($invoice));
            $this->set('invoice', $invoice);
        }
        if ($download)
        {
            Configure::write('CakePdf.download', true);
        } else
        {
            Configure::write('CakePdf.download', false);
        }

        // $this->render('pdf/invoice');
    }

    function synchronize_invoice()
    {
        $this->loadModel('Invoice');
        if ($this->request->is('post'))
        {
            $id = $this->request->data['Invoice']['id'];
            $invoice_nr = $this->request->data['Invoice']['invoice_nr'];
            $client = $this->Invoice->connectComarch();

            //$return = $client->pobierzFakturePoId('FA/3/2015', false);
            $positions = $client->pobierzFakturePoId($invoice_nr, false);

            $data = $this->Invoice->parseComarchInvoice($id, $positions);
            
            if (empty($data))
            {
                $this->Session->setFlash('Błędne dane faktury.', 'flash/error');
                $this->redirect('/');
            }

            if ($this->Invoice->saveAssociated($data))
            {
                $lastId = $this->Invoice->getLastInsertID();
                $this->Invoice->id = $id;
                //type 4 to fakuta juz wystawiona w comarch
                $this->Invoice->saveField('type', 4);
                $this->Invoice->saveField('parent_id', $lastId);
                $payment_id = $this->Invoice->field('payment_id');
                $this->Invoice->Payment->id = $payment_id;
                $this->Invoice->Payment->saveField('payment_type', 2);
                $this->Session->setFlash('Faktura wystawiona poprawnie.', 'flash/success');
            } else {
                $messages = '';
                foreach ($this->Invoice->validationErrors as $mess)
                {
                    $messages .= ' ' . reset($mess);
                }
                $this->Session->setFlash('Błąd dodania faktury.' . $messages, 'flash/error');
            }
            $this->redirect('/');
        }
    }

    /*
     * metoda wystawiająca fakturę i wysyłająca powiadomienie email i sms
     * 
     * @param       $id - id faktury
     */

    function make_invoice($id)
    {
        $this->loadModel('Invoice');
        $this->loadModel('Payment');
        $this->loadModel('ClientProjectLog');
        $invoice = $this->Invoice->getInvoice($id, 0);
        if ($invoice)
        {
            $this->Invoice->id = $invoice['Invoice']['id'];
            $this->Invoice->saveField('issue_date', date('Y-m-d'));
            $this->Invoice->saveField('type', 1); //faktura sprzedażowa

            $this->Payment->id = $invoice['Invoice']['payment_id'];
            $this->Payment->saveField('payment_type', 2); //faktura wystawiona
//            $data = array();
//            $data['ClientProjectLog']['client_project_id'] = $invoice['Invoice']['client_project_id']; //klient_lead_id
//            $data['ClientProjectLog']['user_id'] = $_SESSION['Auth']['User']['id'];
//            $this->ClientProjectLog->saveLog(15, $data); //log_type - wystawienie faktury

            $invoice['Invoice']['issue_date'] = date('Y-m-d');
            //$this->FebEmail->sendMakeInvoice($invoice);
            $this->FebEmail->sendInvoiceMail($invoice, 'make_invoice', 'Wystawiono nową fakturę');

            $params['to'] = $invoice['Client']['phone'];
            $params['message'] = 'Wystawiono fakture nr ' .
                    $invoice['Invoice']['invoice_nr'] . ' kwota do zaplaty: ' .
                    $invoice['Invoice']['net_price'] . ' zl netto, ' .
                    $invoice['Invoice']['gross_price'] . ' zl brutto. Termin platnosci: ' .
                    $invoice['Invoice']['payment_date'] . ', prosimy o terminowe oplacenie faktury.';
            $this->Sms->sms_send2($params);

            $this->Session->setFlash('Faktura wystawiona poprawnie. Klient otrzymał email oraz sms', 'flash/success');
        } else
        {
            $this->Session->setFlash('Nie ma takiej faktury.', 'flash/error');
        }
        return $this->redirect($this->referer());
    }

    /*
     * metoda oznaczajaca fakturę jako opłaconą i wysyłająca powiadomienie email i sms
     * 
     * @param       $id - id faktury
     */

    function mark_invoice_as_paid($id)
    {

        $this->loadModel('Invoice');
        $this->loadModel('Payment');
        $this->loadModel('ClientProjectLog');
        $invoice = $this->Invoice->getInvoice($id, 0);
        if ($invoice)
        {
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

            $this->Session->setFlash('Faktura oznaczona poprawnie. Klient otrzymał email oraz sms', 'flash/success');
        } else
        {
            $this->Session->setFlash('Nie ma takiej faktury.', 'flash/error');
        }
        return $this->redirect($this->referer());
    }

    /*
     * metoda sprawdza które faktury sa nie opłacone i wysyła komunikaty - na 7dni przed data platności, 1 dzień przed i 2 dni po jesli platnosc nie zostala oznaczona jako zaplacona
     * 
     */

    function check_invoices_to_pay()
    {

        $this->loadModel('Invoice');
        $invoices = $this->Invoice->getAllInvoices();
        foreach ($invoices as $inv)
        {
            if ($inv['Invoice']['paid'] == false && $inv['Invoice']['type'] == 1)
            { //jesli faktura została wystawiona i nie jest opłacona
                $params['to'] = $inv['Client']['phone'];

                $date1 = $inv['Invoice']['payment_date'];
                $date2 = date('Y-m-d');
                $diff = (int) ((strtotime($date1) - strtotime($date2)) / 86400); //obliczam róźnicę daty terminu płatności i daty dzisiejszej w dniach

                if ($diff == 7)
                {
                    $template = 'seven_days_to_pay_day';
                    $subject = 'Za 7 dni upływa termin płatności faktury nr ' . $inv['Invoice']['invoice_nr'];
                    $params['message'] = 'Termin platnosci dla faktury nr ' . $inv['Invoice']['invoice_nr'] . ' uplywa za 7 dni, prosimy o terminowe oplacenie faktury.';
                }
                if ($diff == 1)
                {
                    $template = 'one_day_to_pay_day';
                    $subject = 'Jutro upływa termin płatności faktury nr ' . $inv['Invoice']['invoice_nr'];
                    $params['message'] = 'Jutro uplywa termin platnosci dla faktury nr ' . $inv['Invoice']['invoice_nr'] . ', prosimy o terminowe oplacenie faktury.';
                }
                if ($diff == -2)
                {
                    $template = 'two_days_after_pay_day';
                    $subject = 'Odnotowaliśmy przekroczenie terminu płatności faktury nr ' . $inv['Invoice']['invoice_nr'];
                    $params['message'] = '2 dni temu uplynal termin platnosci dla faktury nr ' . $inv['Invoice']['invoice_nr'] . ', prosimy o oplacenie faktury.';
                }
                if (isset($template))
                { //wysyłam tylko jeśli został spełniony jeden z powyższych warunków
                    $this->FebEmail->sendInvoiceMail($inv, $template, $subject);
                    $this->Sms->sms_send2($params);
                }
            }
        }

        $this->Session->setFlash('Wiadomości zostały wysłane', 'flash/success');
        return $this->redirect($this->referer());
    }

    function add_file()
    {
        $this->loadModel('HrFile');
        //sprawdzić czy jest ustawione file_id, jeśli tak to trzeba zapisać nowszą wersję pliku
        if ($this->request->is('post') || $this->request->is('put'))
        {
            //die($this->Session->read('Auth.User.id'));
            $this->request->data['HrFile']['user_id'] = $this->Session->read('Auth.User.id');
            if ($this->HrFile->save($this->request->data))
            {
                //$this->ClientProjectLog->saveFileLog(2, $this->data); //2 - logowanie operacji na plikach
                $this->Session->setFlash('Plik został zapisany poprawnie.', 'flash/success');
            } else
            {
                $this->Session->setFlash('Wystąpił bląd proszę spróbować ponownie.', 'flash/error');
            }
        }

        return $this->redirect($this->referer());
    }

    public function questionnaire($show_alert = false, $profile_id = null)
    {
        $title = 'Kwestionariusze';
        $subtitle = 'Formularz';

        $archive_file_name = 'dokumenty_kandydata_' . $profile_id . '.zip';

        $this->set(compact('title', 'subtitle'));
        $this->set(compact('show_alert', 'archive_file_name', 'profile_id'));


        if ($this->request->is('post'))
        {
            //die(debug($this->request->data));
            $form_ok = true;
            if (!filter_var($this->request->data['Profile']['private_email'], FILTER_VALIDATE_EMAIL))
            {
                $this->Session->setFlash('Proszę podać poprawny adres email.', 'flash/error');
                $form_ok = false;
            }

            $this->loadModel('Profile');

            if ($form_ok)
            { //zapisuje tylko jeśli formularz zozstał wypełniony poprawnie
                $this->Profile->save($this->request->data);
                $id = $this->Profile->getLastInsertId();
                //$profile = $this->Profile->getProfile($id);

                foreach ($this->documents as $doc)
                {
                    $this->cake_pdf($doc, $this->request->data);
                }

                $profile_id = $id;
                $archive_file_name = 'dokumenty_kandydata_' . $id . '.zip';

                $zip = new ZipArchive();
                //create the file and throw the error if unsuccessful
                if ($zip->open(WWW_ROOT . 'files' . DS . 'hr' . DS . $archive_file_name, ZIPARCHIVE::CREATE) !== TRUE)
                {
                    exit("cannot open <$archive_file_name>\n");
                }
                //add each files of $file_name array to archive
                $file_not_found = '';
                foreach ($this->documents as $file)
                {
                    if (file_exists(WWW_ROOT . 'files' . DS . 'pdf' . DS . $file . '.pdf'))
                    {
                        $zip->addFile(WWW_ROOT . 'files' . DS . 'pdf' . DS . $file . '.pdf', $file . '.pdf');
                    } else
                    {
                        $file_not_found .= $file . '.pdf' . '<br/>';
                    }
                }
                $zip->close();

                $this->redirect('/hrs/questionnaire/1/' . $profile_id);
            }
        }
    }

    function cake_pdf($name = null, $data = null)
    {
        if (empty($name) or empty($data))
        {
            return false;
        }
        $data['Profile']['company_name'] = 'Fabryka e-biznesu sp. z o.o.';
        $data['Profile']['company_address'] = 'ul. Trembeckiego 11A';
        $data['Profile']['company_address2'] = '35-234 Rzeszów';

        $CakePdf = new CakePdf(Configure::read('CakePdf'));
        $CakePdf->viewVars(array('name' => $name, 'profile' => $data['Profile']));
        $CakePdf->template('/Hrs/pdf/files', 'invoice');
        //get the pdf string returned
        $pdf = $CakePdf->output();
        //or write it to file directly
        if (file_exists(WWW_ROOT . 'files' . DS . 'pdf' . DS . $name . '.pdf'))
        {
            unlink(WWW_ROOT . 'files' . DS . 'pdf' . DS . $name . '.pdf'); //usuwam archiwum jeśli już takie istnieje
        }
        $pdf = $CakePdf->write(WWW_ROOT . 'files' . DS . 'pdf' . DS . $name . '.pdf');
    }

    public function files($name = null)
    {
        $title = 'Kwestionariusze';
        $subtitle = 'Pliki';
        $this->set(compact('title', 'subtitle'));
        if (!empty($name))
        {
            $this->layout = 'invoice';
            $this->set(compact('name'));
        }
    }

    public function circulation_card()
    {
        $title = 'Kartyobiegowe';
        $subtitle = 'Formularz';

        $this->set(compact('title', 'subtitle'));
    }

    /*
     * metoda odpowiada za dodanie użytkownika na podstawie profilu kandydata
     */

    public function hire_employee($id)
    {
        $title = 'Pracownicy';
        $subtitle = 'Nowy pracownik';

        $this->loadModel('Profile');
        $this->loadModel('Section');
        $this->loadModel('User');
        $this->loadModel('Group');

        $profile = $this->Profile->find('first', array(
            'conditions' => array(
                'Profile.id' => $id
            ),
            'recursive' => -1,
        ));

        $sections = $this->Section->find('list', array(
            'order' => 'id DESC'
        ));
        $perm_groups = $this->Group->find("list", array(
            'recursive' => -1,
            'order' => 'id DESC'
        ));

        $this->set(compact('title', 'subtitle', 'profile', 'sections', 'perm_groups'));

        if ($this->request->data)
        {
            $form_ok = true;

            if (!filter_var($this->request->data['Profile']['email'], FILTER_VALIDATE_EMAIL))
            {
                $this->Session->setFlash('Proszę podać poprawny adres email.', 'flash/error');
                $form_ok = false;
                //$this->redirect($this->referer());
            }
            $user_email = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $this->request->data['Profile']['email']
                ),
                'recursive' => -1,
            ));
            if ($user_email)
            {
                $this->Session->setFlash('Taki maill już istnieje w bazie.', 'flash/error');
                $form_ok = false;
                //$this->redirect($this->referer());
            }

            //$user['User']['name'] = $this->request->data['Profile']['firstname'] . ' ' . $this->request->data['Profile']['surname'];
            $user['User']['email'] = $this->request->data['Profile']['email'];
            $user['User']['section_id'] = $this->request->data['Profile']['department'];
            $user['User']['active'] = 1;
            $user['Group']['Group'][0] = $this->request->data['Profile']['group'];
            $user['Section']['Section'][0] = $this->request->data['Profile']['department'];
            //die(debug($user));

            if ($form_ok)
            {
                $this->User->create();
                $save = $this->User->save($user, false);

                if ($this->User->validationErrors)
                {
                    $this->set('error', $this->User->validationErrors);
                } else
                {
                    $profile['Profile']['place_of_work'] = $this->request->data['Profile']['place_of_work'];
                    $profile['Profile']['user_id'] = $save['User']['id'];
                    $this->Profile->save($profile);

                    $this->Session->setFlash('Pracownik został dodany pomyślnie.', 'flash/success');
                    $this->redirect('/hrs/add_contract/' . $id);
                }
            }
        }
    }

    /*
     * dodawanie umowy pracownikowki podczas jego tworzenia
     */

    public function add_contract($id)
    {
        $title = 'Umowy';
        $subtitle = 'Nowa umowa';

        $this->loadModel('Profile');
        $this->loadModel('UserContractHistory');

        $profile = $this->Profile->find('first', array(
            'conditions' => array('Profile.id' => $id),
            'fields' => 'id,user_id,firstname,surname',
            'recursive' => -1,
        ));

        $this->set(compact('title', 'subtitle', 'profile'));

        if ($this->request->data)
        {
            $uch = $this->request->data;
            $uch['UserContractHistory']['user_id'] = $profile['Profile']['user_id'];
            $this->UserContractHistory->save($uch);

            $this->Profile->id = $profile['Profile']['id'];
            $tmp['Profile']['hourly_rate'] = $uch['UserContractHistory']['hourly_rate'];
            if ($this->Profile->save($tmp))
            {
                $this->Session->setFlash('Nowa umowa została zapisana.', 'flash/success');
                $this->redirect('/hrs/send_account_credentials/' . $profile['Profile']['id']);
            }
        }
    }

    /*
     * dodawanie brakującej umowy pracownikowi z listy pracowników
     */

    public function add_employe_contract($id)
    {
        $title = 'Umowy';
        $subtitle = 'Nowa umowa';

        $this->loadModel('Profile');
        $this->loadModel('UserContractHistory');

        $profile = $this->Profile->find('first', array(
            'conditions' => array('Profile.id' => $id),
            'fields' => 'id,user_id,firstname,surname',
            'recursive' => -1,
        ));

        $this->set(compact('title', 'subtitle', 'profile'));

        if ($this->request->data)
        {
            $uch = $this->request->data;
            $uch['UserContractHistory']['user_id'] = $profile['Profile']['user_id'];
            $this->UserContractHistory->save($uch);

            $this->Profile->id = $profile['Profile']['id'];
            $tmp['Profile']['hourly_rate'] = $uch['UserContractHistory']['hourly_rate'];
            if ($this->Profile->save($tmp))
            {
                $this->Session->setFlash('Nowa umowa została zapisana.', 'flash/success');
                $this->redirect('/profiles/');
            }
        }
    }

    public function send_account_credentials($id)
    {
        $title = 'Wysyłanie pracownikowi danych do konta';
        $subtitle = 'Nowa umowa';

        $this->loadModel('Profile');

        $params['conditions']['Profile.id'] = $id;
        $params['recursive'] = 1;
        $profile = $this->Profile->User->find('first', $params);

        $this->set(compact('title', 'subtitle', 'profile'));

        if ($this->request->data)
        {
            $credentials = $this->request->data;
            //die(debug($credentials));
            $this->LogMail->sendAccountCredentials($profile['User']['email'], $credentials['User']['credentials']);
            $this->Session->setFlash('Dane zostały wysłane.', 'flash/success');
            $this->redirect('/profiles');
        }
    }

    public function edit_contract($user_contract_history_id = null)
    {
        $title = 'Umowy';
        $subtitle = 'Nowa umowa';

        $this->loadModel('UserContractHistory');
        $this->UserContractHistory->id = $user_contract_history_id;
        if (!$this->UserContractHistory->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        $user_contract_history = $this->UserContractHistory->find('first', array(
            'conditions' => array(
                'UserContractHistory.id' => $user_contract_history_id
            ),
            'recursive' => -1,
        ));

        $this->loadModel('Profile');
        $profile = $this->Profile->getProfile($user_contract_history['UserContractHistory']['user_id']);
        $session = $this->Session->read();
        $permited_user_id = $session['Auth']['User']['id']; //id użytkownika który edytuje dane umowy - potrzebne do sprawdzenia czy ma uprawnienia
        $groups = $session['Auth']['Groups'];
        $data['id'] = $user_contract_history['UserContractHistory']['id'];
        $data['netto'] = null;
        $salary = $this->UserContractHistory->read_salary($data, $groups, $permited_user_id);
        $data['netto'] = 'salary';
        $salary_net = $this->UserContractHistory->read_salary($data, $groups, $permited_user_id);
        $hourly_rate = $this->UserContractHistory->read_hourly_rate($data, $groups, $permited_user_id);

        $this->set(compact('title', 'subtitle', 'profile', 'user_contract_history', 'salary', 'salary_net', 'hourly_rate'));

        if ($this->request->data)
        {
            //die(debug($this->request->data));
            $uch = $this->request->data;
            $this->UserContractHistory->id = $user_contract_history['UserContractHistory']['id'];
            $uch['UserContractHistory']['user_id'] = $profile['Profile']['user_id'];
            $this->UserContractHistory->id = null;
            $this->UserContractHistory->create();
            $save = $this->UserContractHistory->save($uch);
            $uchOld['UserContractHistory']['id'] = $user_contract_history['UserContractHistory']['id'];
            $uchOld['UserContractHistory']['parent_id'] = $save['UserContractHistory']['id'];
            $this->UserContractHistory->save($uchOld);

            $this->Profile->id = $profile['Profile']['id'];
            $tmp['Profile']['hourly_rate'] = $uch['UserContractHistory']['hourly_rate'];
            $this->Profile->save($tmp);

            $this->Session->setFlash('Umowa została zapisana.', 'flash/success');
            $this->redirect('/profiles/');
        }
    }

    /*
     * metoda aktualizuje opis faktury
     * dane przesyłane są z funkcji updateDescription() w kontrolerze ProjectFilesCtrl.js
     */

    public function update_invoice_description()
    {
        if ($this->request->is('post'))
        {
            $data = $this->request->data;
            $tmp['Invoice'] = $data['invoice'];
            $this->loadModel('Invoice');
            $this->Invoice->id = $tmp['Invoice']['id'];
            $this->Invoice->save($tmp);

            if ($this->Invoice->validationErrors)
            {
                $data = $this->Invoice->validationErrors;
            } else
            {
                $data = true;
            }
            $this->set(compact('data'));
            $this->set('_serialize', array('data'));
        }
    }

    public function link_invoice_to_project()
    {
        if ($this->request->is('post'))
        {
            $data = $this->request->data;

            $this->loadModel('Invoice');
            $this->loadModel('ProjectFile');
            $this->loadModel('ClientProjectLog');

            $invoice = $this->Invoice->getInvoice($data['invoice'], 1);
            $slownie = $this->Price->slownie(intval($invoice['Invoice']['gross_price']));
            $invoice['Invoice']['slownie'] = $slownie;

            $CakePdf = new CakePdf(Configure::read('CakePdf'));
            $CakePdf->viewVars(array('name' => 'faktura', 'invoice' => $invoice));
            $CakePdf->template('/Hrs/pdf/files', 'invoice');
            //get the pdf string returned
            $CakePdf->output();
            //or write it to file directly
            $invoice_nr = str_replace('/', '_', $invoice['Invoice']['invoice_nr']);
            if (file_exists(WWW_ROOT . 'files' . DS . 'projectfile' . DS . 'Faktura_' . $invoice_nr . '.pdf'))
            {
                unlink(WWW_ROOT . 'files' . DS . 'projectfile' . DS . 'Faktura_' . $invoice_nr . '.pdf'); //usuwam archiwum jeśli już takie istnieje
            }
            $CakePdf->write(WWW_ROOT . 'files' . DS . 'projectfile' . DS . 'Faktura_' . $invoice_nr . '.pdf');

            $session = $this->Session->read();
            $cp['ProjectFile']['client_project_id'] = $data['project_id'];
            $cp['ProjectFile']['user_id'] = $session['Auth']['User']['id'];
            $cp['ProjectFile']['file'] = 'Faktura_' . $invoice_nr . '.pdf';
            $cp['ProjectFile']['file_category_id'] = 7; //faktura
            $cp['ProjectFile']['desc'] = $invoice['Invoice']['description'];

            if ($this->ProjectFile->save($cp)) //przypisanie faktury do projektu
            {
                $this->Invoice->id = $data['invoice'];
                $inv['Invoice']['client_project_id'] = $data['project_id'];
                $this->Invoice->save($inv); //zapisanie informacji o tym, że faktura jest przypisana do projektu

                $this->ClientProjectLog->saveFileLog(23, $cp); //2 - logowanie operacji na plikach
                $this->Session->setFlash('Plik został zapisany poprawnie.', 'flash/success');
            }

            $response = 'Faktua została przypisana do projektu';
            $this->set(compact('response'));
            $this->set('_serialize', array('response'));
        }
    }

}
