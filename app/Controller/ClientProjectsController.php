<?php

App::uses('AppController', 'Controller');

//App::uses('ClientProjectBusiness', 'Model/Business');
/**
 * ClientProjects Controller
 *
 * @property ClientProject $ClientProject
 */
class ClientProjectsController extends AppController
{

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array();

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array('LogMail', 'DownloadFiles', 'CheckAccess'); //Slug.Slug
    public $uses = array('ClientProject', 'ClientProjectLog', 'ClientLead', 'LeadFile', 'ProjectFile', 'ClientProjectBudget', 'ClientProjectShedule', 'ClientProjectNote', 'ClientProjectNote');

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('sumarize_all_project_costs', 'sumarize_project_costs'));
    }

    

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index()
    {
        $title = $subtitle = 'Lista projektów';
        $this->helpers[] = 'FebTime';
        $this->loadModel('ClientProject');
        $this->loadModel('Payment');



//$allProjectsQuery = $this->ClientProject->getDataTable();
        $session = $this->Session->read();
        $user_permission = $session['user_permission']; //sprawdzam czy użytkownik należy do sekretariatu, kierowników lub zarzadu
        if ($user_permission == 'user')//projekty użytkownika
        {
            $allProjectsQuery = $this->ClientProject->getUserProjectTable($session['Auth']['User']['id']);
        }
        if ($user_permission == 'manager')//projekty do których przypisany jest dział użytkownika
        {
            $allProjectsQuery = $this->ClientProject->getManagerProjectTableBySection($session['Auth']['User']['section_id']);
        }
        if ($user_permission == 'all')//wszystkie projekty
        {
            $allProjectsQuery = $this->ClientProject->getAllProjectTable();
        }
        $allProjects = $this->ClientProject->parse2TimelineList($allProjectsQuery);

        $this->set(compact('allProjects', 'projects', 'title', 'subtitle', 'user_permission'));
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $title = $subtitle = 'Szczegóły projektu';

        $this->ClientProject->recursive = 0;

        $clientProject = $this->ClientProject->read(null, $id);
        if (!isset($clientProject['ClientProject']))
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        $this->loadModel('ClientProjectUser');
        $this->loadModel('ProjectFile');
        $this->loadModel('ProjectFileCategory');
        $this->loadModel('HrSetting');
        $this->loadModel('Profile');
        $this->loadModel('ProjectContactPeople');

        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];
        $access = $this->CheckAccess->checkUserProjectAccess($id, $user_id); // sprawdzenie czy "możesz widzieć ten projekt  

        $user_permission = $session['user_permission']; //sprawdzam czy użytkownik należy do sekretariatu, kierowników lub zarzadu
        if ($access == false)
        {
            throw new NotFoundException(__d('cms', 'Nie masz dostępu do tego zasobu.'));
        }

        $timeline = $this->ClientProject->timeline($id);

        //uprawnienia 
        $timelinePayments = array();
        if ($user_permission == 'all' || $user_permission == 'manager')
        {
            $this->loadModel('Payment');
            $timelinePayments = $this->Payment->parseTimeLine($id, $user_permission);
        } else
        {
            //uprawnienia gdy nie jest to prezes to nie checkboxów
            foreach ($timeline as &$t)
            {
                $t['readonly'] = true;
            }
        }

        $all_payments_done = true;
        if (empty($timelinePayments))
        {
            $all_payments_done = false; //jesli nie ma zdefiniowanych żadnych płatności to nie można zamknąć finansowania
        }
        foreach ($timelinePayments as $tlp)
        {
            if ($tlp['done'] == false)
            {
                $all_payments_done = false; //jeśli którakolwiek płatność nie została uregulowana to nie pozwalam na zakończenie finansowania
            }
        }
        //debug($timelinePayments);

        $sections = $this->ClientProjectBudget->getSections($id);

        $fileCategory = $this->ProjectFileCategory->getList();
        $supervisor = $this->User->Section->findSupervisorByUser($session['Auth']['User']['id']);
        $sectionList = $this->User->Section->find('list');
        $clientProjectNote = $this->ClientProjectNote->getProjectNotesSection($id);
        $hr_settings = $this->HrSetting->getHrSettings();

        /* logi proejktu */
        /*
         * @todo [TODO] Trzeba napisać w odpowiednich miejsach metody logujące zdarzeania(to już poza widokiem projektu)
         * 
         * lista zdarzeń http://pm.feb.net.pl/issues/16581
         */
        $this->loadModel('Settings');
        $params['conditions'] = array(
            'key'=>'App.CrmMailSettings'
        );

        $settings = $this->Settings->find('first',$params);
        $this->LogMail->project_and_lead_mail_log($settings);
        die('ffg99');
        $projectlogs = $this->ClientProjectLog->getLogListSection($id); //pobieram listę logów
        $projectlogs = $projectlogs ? $projectlogs : array();
        $log_type = $this->ClientProjectLog->log_type;

        foreach ($projectlogs as &$projectlog)
        {
            $projectlog['ClientProjectLog']['type_log_id'] = $log_type[$projectlog['ClientProjectLog']['type_log_id']];
            $projectlog['ClientProjectLog']['message'] = stripslashes($projectlog['ClientProjectLog']['message']);
        }
        /* KONIEC logi projektu */


        //kierownik projektu
        $leader = $this->Profile->getProfileForCard($clientProject['ClientProject']['user_id']);
        $accountManager = $this->Profile->getProfileForCard($clientProject['ClientProject']['account_manager_id']);

        //osoby kontaktowe
        $projectContactPeopleIds = $this->ProjectContactPeople->getProjectClientContacts($clientProject['ClientProject']['id']);
        $clientContacts = $this->ProjectContactPeople->ClientContact->getClientContact($projectContactPeopleIds);

        $this->loadModel('Brief');
        $brief = $this->Brief->findByClientLeadId($clientProject['ClientProject']['client_lead_id'], -1);

        $searchModes = array(
            'this_project' => 'W tym projekcie',
            'my_projects' => 'Moje projekty',
            'workers' => 'Pracownicy',
            'clients' => 'Klienci',
        );

        $actualProjectId = $id;

        $this->set(compact('searchModes', 'actualProjectId'));

        $this->set(
                compact(
                        'testlog'
                        , 'leader'
                        , 'accountManager'
                        , 'clientProject'
                        , 'clientContacts'
                        , 'title'
                        , 'subtitle'
                        , 'supervisor'
                        , 'timeline'
                        , 'timelinePayments'
                        , 'all_payments_done'
                        , 'brief'
                        , 'sections'
                        , 'sectionList'
                        , 'access'
                        , 'user_authorized'
                        , 'projectlogs'
                        , 'clientProjectNote'
                        , 'allBudget'
                        , 'user_id'
                        , 'fileCategory'
                        , 'user_permission'
                )
        );
    }

    /**
     * Akcja podglądu obiektu dla klienta
     *
     * @param string $id
     * @return void
     */
    public function view_client($id = null)
    {
        $title = $subtitle = 'Szczegóły projektu';

        $this->ClientProject->recursive = 0;
        $clientProject = $this->ClientProject->read(null, $id);
        if (!isset($clientProject['ClientProject']))
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        // sprawdzenie czy "możesz widzieć ten projekt  
        $this->loadModel('ClientProjectUser');
        $this->loadModel('ProjectFile');
        $this->loadModel('ProjectContactPeople');
        $this->loadModel('Profile');
        $this->loadModel('HrSetting');
        $this->loadModel('ProjectFileCategory');
        $this->loadModel('Brief');

        $session = $this->Session->read();

        $user_id = $session['Auth']['User']['id'];
        $access = $this->CheckAccess->checkUserProjectAccess($id, $user_id);

        $user_permission = $session['user_permission']; //sprawdzam czy użytkownik należy do sekretariatu, kierowników lub zarzadu
       
        if (($access == false && $user_permission != 'client') || ($user_permission == 'client' && $clientProject['ClientProject']['share'] == false))
        {
            throw new NotFoundException(__d('cms', 'Nie masz dostępu do tego zasobu.'));
        }

        $timeline = $this->ClientProject->timeline($id);

        //uprawnienia 
        $timelinePayments = array();
        if ($user_permission == 'all' || $user_permission == 'manager')
        {
            $this->loadModel('Payment');
            $timelinePayments = $this->Payment->parseTimeLine($id, $user_permission);
        } else
        {
            //uprawnienia gdy nie jest to prezes to nie checkboxów
            foreach ($timeline as &$t)
            {
                $t['readonly'] = true;
            }
        }

        $all_payments_done = true;
        if (empty($timelinePayments))
        {
            $all_payments_done = false; //jesli nie ma zdefiniowanych żadnych płatności to nie można zamknąć finansowania
        }
        foreach ($timelinePayments as $tlp)
        {
            if ($tlp['done'] == false)
            {
                $all_payments_done = false; //jeśli którakolwiek płatność nie została uregulowana to nie pozwalam na zakończenie finansowania
            }
        }
        //debug($timelinePayments);

        $sections = $this->ClientProjectBudget->getSections($id);
        $fileCategory = $this->ProjectFileCategory->getList();
        $supervisor = $this->User->Section->findSupervisorByUser($session['Auth']['User']['id']);
        $sectionList = $this->User->Section->find('list');

        /* logi proejktu */
        /*
         * @todo [TODO] Trzeba napisać w odpowiednich miejsach metody logujące zdarzeania(to już poza widokiem projektu)
         * 
         * lista zdarzeń http://pm.feb.net.pl/issues/16581
         */
        $this->loadModel('Settings');
        $params['conditions'] = array(
            'key'=>'App.CrmMailSettings'
        );
        $settings = $this->Settings->find('first',$params);
        $this->LogMail->project_and_lead_mail_log($settings);
        /* KONIEC logi projektu */

        $clientProjectNote = $this->ClientProjectNote->getClientProjectNotes($id);

        //kierownik projektu
        $leader = $this->Profile->getProfileForCard($clientProject['ClientProject']['user_id']);
        $accountManager = $this->Profile->getProfileForCard($clientProject['ClientProject']['account_manager_id']);

        //osoby kontaktowe
        $projectContactPeopleIds = $this->ProjectContactPeople->getProjectClientContacts($clientProject['ClientProject']['id']);
        $clientContacts = $this->ProjectContactPeople->ClientContact->getClientContact($projectContactPeopleIds);

        $brief = $this->Brief->findByClientLeadId($clientProject['ClientProject']['client_lead_id'], -1);

        $this->set(
                compact(
                        'testlog'
                        , 'leader'
                        , 'accountManager'
                        , 'clientProject'
                        , 'clientContacts'
                        , 'title'
                        , 'subtitle'
                        , 'supervisor'
                        , 'timeline'
                        , 'timelinePayments'
                        , 'all_payments_done'
                        , 'brief'
                        , 'sections'
                        , 'sectionList'
                        , 'access'
                        , 'user_authorized'
                        , 'clientProjectNote'
                        , 'allBudget'
                        , 'user_id'
                        , 'fileCategory'
                        , 'user_permission'
                )
        );
    }

    /**
     * Akcja dodająca obiekt nowy projekt
     *   
     * @param (int)$lead_id
     * @return void
     */
    public function add($lead_id = null)
    {
        if (empty($lead_id))
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if (!$this->ClientProject->ClientLead->exists($lead_id))
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $title = $subtitle = 'Nowy projekt';

        $this->loadModel('ClientContact');
        $this->loadModel('Section');
        $this->loadModel('ClientLead');
        $session = $this->Session->read();
        if (!empty($this->request->data))
        {
            $saveData = $this->ClientProject->saveAddRequestData($this->request->data, $lead_id); // wypchnąć do funkcji 
            if ($saveData['error'] == 0)
            {
                if ($saveData['project_start'])
                {
                    $data['ClientProjectLog']['user_id'] = $this->Session->read('Auth.User.id');
                    $data['ClientProjectLog']['client_project_id'] = $saveData['project_id'];
                    $this->ClientProjectLog->saveLog(7, $data); //7 - otwarcie projektu	

                    $this->ClientLead->id = $lead_id;
                    $this->ClientLead->saveField('lead_status_id', 6);
                    $this->ClientLead->saveField('closing_date', date('Y-m-d'));
                }

                if (isset($saveData['project_id']))
                {

                    $this->loadModel('NewClients.Project');
                    //$this->Project->actualizeGraphicsProjects($lead_id, $saveData['project_id']);

                    $graphicProjects = $this->Project->find('all', array(
                        'recursive' => -1,
                        'conditions' => array(
                            'lead_id' => $lead_id
                        )
                    ));

                    foreach ($graphicProjects as $graphicProject)
                    {

                        $this->Project->id = $graphicProject['Project']['id'];
                        $this->Project->saveField('client_project_id', $saveData['project_id']);
                    }
                }

                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'default', array('class' => 'note note-success'));
                $this->redirect(array('action' => 'add_budget', $saveData['project_id']));
            } else if ($saveData['error'] == 1)
            {
                $this->Session->setFlash(__d('public', $saveData['msg']), 'flash/error');
            }
        }

        $clientLead = $this->request->data = $this->ClientProject->ClientLead->getLeadDetails($lead_id);

        $clientContacts = $this->ClientContact->getClientContacts($clientLead['ClientLead']['client_id']);

// pobranie osób z zarządu  poprawic 
        $this->Section->id = 1;
        $bossList = $this->Section->getSectionsBoss();

        $supervisor = $this->User->Section->findSupervisorByUser($session['Auth']['User']['id']);

// lita domen SEO
        $this->loadModel('ClientDomain');
        $seoList = $this->ClientDomain->getSeoList($clientLead['ClientLead']['client_id']);

        $aliasList = $this->ClientProject->getAliasList();

// lista hadlowcow do wyboru account managera 
        $managers = $this->Section->getMerchants();

        $paramsClientProject['conditions']['ClientProject.client_lead_id'] = $lead_id;
        $paramsClientProject['recursive'] = -1;
        $project = $this->ClientProject->find('first', $paramsClientProject);
        if (!empty($project))
        {
            $this->request->data += $project;
// pobranie dokumentów odpowiednio kategoriami do osobnych zmiennych
            $this->loadModel('ProjectContactPeople');
            $clientContactsList = $this->ProjectContactPeople->getProjectClientContacts($project['ClientProject']['id']);

            $this->loadModel('ClientProjectDomain');
            $projectDomainList = $this->ClientProjectDomain->getProjectDomains($project['ClientProject']['id']);
        }

        $this->loadModel('ProjectFileCategory');
        $fileCategory = $this->ProjectFileCategory->getList();
        $project_id = empty($project['ClientProject']['id']) ? null : $project['ClientProject']['id'];
        $files = $this->ProjectFile->getFileLeadProjectList($project_id, $lead_id, 1);
        if (empty($this->request->data['ClientProject']['project_author_id']))
        {
            $this->request->data['ClientProject']['project_author_id'] = $session['Auth']['User']['id'];
        }
        $profielParams['conditions']['Profile.user_id'] = $this->request->data['ClientProject']['project_author_id'];
        $projectAuthor = $this->ClientProject->User->Profile->find('first', $profielParams);

        foreach ($seoList as $id => $seo)
        {
            $seoLists[$id]['domain'] = $seo;
            $seoLists[$id]['id'] = $id;

            if (!empty($projectDomainList) && in_array($id, $projectDomainList))
            {
                $seoLists[$id]['checked'] = true;
            } else
            {
                $seoLists[$id]['checked'] = false;
            }
        }

        $this->set(compact('project', 'session', 'projectAuthor', 'managers', 'clientLead', 'title', 'subtitle', 'optiontradefiles', 'optionagreementfiles', 'optioninvoicefiles', 'optionpublicfiles', 'supervisor', 'clientContacts', 'clientContactsList', 'bossList', 'seoLists', 'files', 'fileCategory', 'aliasList'));
    }

    function add_domain()
    {

        $domain = $this->data['domain'];
        $client_id = (int) $this->data['client_id'];

        $this->loadModel('ClientDomain');

        $result = $this->ClientDomain->getClientDomainByName($client_id, $domain);
        if (isset($result['ClientDomain']))
        {
            $return['error'] = 'Taka domena już istnieje w bazie';
        } else
        {
            $data['ClientDomain']['client_id'] = $client_id;
            $data['ClientDomain']['domain'] = $domain;

            if ($this->ClientDomain->addClientDomain($data))
            {
                $return['id'] = $this->ClientDomain->getLastInsertId();
                $return['domain'] = $domain;
            } else
            {
                $return['error'] = 'Wystąpił błąd proszę spróbować ponownie.';
            }
        }
        $this->set(compact('return'));
        $this->set('_serialize', 'return');
    }

    /*
     * metoda powoduje pobranie pliku
     * 
     * @param $id				id pliku
     * @param $project_or_lead	flaga - oznacza czy pobierany jest plik projketu czy leadu(domyślnie proejtku)
     */

    function file_save($id = null, $project_or_lead = 'projectfile')
    {
        $this->render(false);

        if (empty($id))
        {
            return false;
        }

        $this->loadModel('ProjectFile');
        $file = $this->ProjectFile->getFile($id);
//downloadFiles component
        $this->DownloadFiles->download($file['ProjectFile'], $project_or_lead);
    }

    function files_download()
    {
        if (isset($this->data['file_id']))
        {
            $files = json_decode($this->data['file_id'], 1);
            $archive_file_name = 'dokumenty.zip';
            if (file_exists(WWW_ROOT . 'files' . DS . 'clientproject' . DS . 'dokumenty.zip'))
            {
                unlink(WWW_ROOT . 'files' . DS . 'clientproject' . DS . 'dokumenty.zip'); //usuwam archiwum jeśli już takie istnieje
            }

            $zip = new ZipArchive();
//create the file and throw the error if unsuccessful
            if ($zip->open(WWW_ROOT . 'files' . DS . 'clientproject' . DS . $archive_file_name, ZIPARCHIVE::CREATE) !== TRUE)
            {
                exit("cannot open <$archive_file_name>\n");
            }
//add each files of $file_name array to archive
            foreach ($files as $file)
            {
                if (file_exists(WWW_ROOT . 'files' . DS . 'projectfile' . DS . $file['ProjectFile']['file']) and isset($file['ProjectFile']['selected']) and $file['ProjectFile']['selected'] == true)
                {
                    $zip->addFile(WWW_ROOT . 'files' . DS . 'projectfile' . DS . $file['ProjectFile']['file'], $file['ProjectFile']['file']);
                }
            }

            $zip->close();

            return $this->redirect('/files/clientproject/' . $archive_file_name);
        }
        return $this->redirect($this->referer() . '#project_documents');
    }

    /**
     * Akcja dodająca obiekt wprowadzenie budżetu projektu
     * 
     * @param (int)$project_id
     * @return void
     */
    public function add_budget($project_id = null)
    {
        $title = $subtitle = 'Budżet';

        if (empty($project_id))
        {
            throw new NotFoundException(__d('public', 'Dany projekt nie jest skonfigurowany.')); //nie można dodać budrzetu jesli projekt nie istnieje
        }
        $this->ClientProject->id = $project_id;

        if (!$this->ClientProject->exists())
        {
            throw new NotFoundException(__d('public', 'Dany projekt nie jest skonfigurowany.')); //nie można dodać budrzetu jesli projekt nie istnieje
        }

        $paramsP['conditions']['ClientProject.id'] = $project_id;
        $paramsP['recursive'] = -1;
        $project = $this->ClientProject->find('first', $paramsP);

        $this->loadModel('ClientProjectBudget');
        $this->loadModel('ClientProjectBudgetPosition');

        if (!empty($this->data))
        {
            $this->save_project_data($project_id, $this->request->data);

            $this->add_budget_positions($this->request->data['ClientProject']['teams'], $project_id); //zapis pozycji budżetowych

            $this->save_project_totals($this->request->data['ClientProject']['teams'], $project_id); // zapis budżetu, kosztów projektowych i buforu dla projektu
// KONIEC zapisu budżetu, kosztów projektowych i buforu dla projektu

            if (isset($this->data['back_to_start']))
            {
                $this->redirect(array('action' => 'add', $project['ClientProject']['client_lead_id']));
            }
            $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'default', array('class' => 'note note-success'));
            $this->redirect(array('action' => 'add_payment', $project_id));
        }

        $sections = $this->User->Section->findWithoutUserList();

        $uneditableSectionsList = $this->User->Section->getProjectBudgetCostsUneditableSectionList(); // dokumentacja str.37 -> "Dla działów IT zdefiniowane są podstawowe grupy kosztów wraz ze stawką za roboczogodzinę. Wartości te są nieedytowalne

        $clientProjectBudget = $this->prepare_project_budget($project_id);
        //$clientProjectBudget = $this->ClientProjectBusiness->prepare_project_budget($project_id);

        $this->loadModel('HrSetting');
        $hr_settings = $this->HrSetting->getHrSettings();

        $this->set(compact('project', 'title', 'subtitle', 'sections', 'uneditableSectionsList', 'clientProjectBudget', 'hr_settings'));
    }

    public function save_project_data($project_id = null, $request_data = null)
    {

        if (empty($project_id) || empty($request_data))
        {
            return false;
        }

        $data['ClientProject']['id'] = (int) $project_id;
        $data['ClientProject']['status'] = $request_data['ClientProject']['status'];
        $data['ClientProject']['start_project'] = $request_data['ClientProject']['start_project'];
        $data['ClientProject']['end_project'] = $request_data['ClientProject']['end_project'];
        $data['ClientProject']['warranty'] = $request_data['ClientProject']['warranty'];
        $data['ClientProject']['color'] = $request_data['ClientProject']['color'];
        $data['ClientProject']['notes'] = $request_data['ClientProject']['notes'];
        return $this->ClientProject->saveProject($data); //zapsuje dodatkowe dane projektu: daty początku i końca, kolor, info, statis
    }

    /*
     * Subakcja do add_budget() obsługująca pozycje budżetowe
     * 
     * @param (json)$data	dane do zapisu w formacie json
     * @return boolean		true - wprzypadku powodzenia
     * 						false - w przypadku błędu
     */

    public function add_budget_positions($data = null, $project_id = null)
    {
        if (empty($data) || empty($project_id))
        {
            return false;
        }

        $tmp = json_decode($data, 1); //dekodowanie obiektu json z danymi z budżetowania
//die(debug($tmp));
        foreach ($tmp as $value)
        {
            $tmpProjectBudget = array();
            $tmpProjectBudget['ClientProjectBudget'] = $value['section'];
            $tmpProjectBudget['ClientProjectBudget']['client_project_id'] = (int) $project_id;
            $tmpProjectBudget['ClientProjectBudget']['user_id'] = $this->Session->read('Auth.User.id');

            if ($this->ClientProjectBudget->deleteProjectBudget($value))
            {
                $this->ClientProjectLog->saveProjectBudgetLog($tmpProjectBudget, true); //logowanie usunięcia pozycji budżetowej
                continue;
            }

            if (!isset($tmpProjectBudget['ClientProjectBudget']['id']))
            {
                $this->ClientProjectLog->saveProjectBudgetLog($tmpProjectBudget); //logowanie dodania pozycji budżetowej
            }
            $tmpProjectBudget = $this->ClientProjectBudget->saveProjectBudget($tmpProjectBudget);

            $value['payments'] = empty($value['payments']) ? array() : $value['payments'];

            foreach ($value['payments'] as $payment) //pozycje budżetowe
            {
                if ($this->ClientProjectBudget->ClientProjectBudgetPosition->deleteProjectBudgetPayment($payment))
                {
                    $this->ClientProjectLog->saveProjectBudgetCostLog($tmpProjectBudget, true); //logowanie usunięcia kosztu z pozycji budżetowej
                    continue;
                }
                $tmpProjectBudgetPosition = array();
                $tmpProjectBudgetPosition['ClientProjectBudgetPosition'] = $payment;
                $tmpProjectBudgetPosition['ClientProjectBudgetPosition']['client_project_budget_id'] = $tmpProjectBudget['ClientProjectBudget']['id'];
                unset($tmpProjectBudgetPosition['ClientProjectBudgetPosition']['created']);
                unset($tmpProjectBudgetPosition['ClientProjectBudgetPosition']['modified']);
                
                $this->ClientProjectBudgetPosition->saveProjectBudgetPosition($tmpProjectBudgetPosition);
                if (!isset($tmpProjectBudgetPosition['ClientProjectBudgetPosition']['id']))
                {
                    $this->ClientProjectLog->saveProjectBudgetCostLog($tmpProjectBudget, false); //logowanie dodania kosztu do pozycji budżetowej
                }
            }
        }
    }

    /*
     * Subakcja do add_budget() zapisująca sumy budetu, buforu i kosztów projektowych
     * 
     * @param (json)$teams	dane zsumowania w formacie json
     * @return boolean		true - wprzypadku powodzenia
     * 						false - w przypadku błędu
     */

    public function save_project_totals($teams = null, $project_id = null)
    {
        if (empty($teams) || empty($project_id))
        {
            return false;
        }
        $tmp = json_decode($teams, 1); //dekodowanie obiektu json z danymi z budżetowania

        $data['ClientProject']['total_budget'] = 0;
        $data['ClientProject']['total_development_costs'] = 0;
        $data['ClientProject']['total_buffer'] = 0;
        foreach ($tmp as $value)
        {
            $data['ClientProject']['total_budget'] += $value['section']['position_value'];
            $data['ClientProject']['total_development_costs'] += $value['section']['position_cost'];
            $data['ClientProject']['total_buffer'] += $value['section']['position_cost'] * $value['section']['buffer_percentage'] / 100;
        }
        $data['ClientProject']['id'] = (int) $project_id;
//die(debug($data));
        return $this->ClientProject->saveProject($data);
    }

    /*
     * metoda przygotosuje tablicę budżetów i pozycji budżetowych dla projektu
     * 
     * @param int $project_id		id projektu
     */

    public function prepare_project_budget($project_id = null)
    {
        if (empty($project_id))
        {
            return array();
        }

        $clientProjectBudget_query = $this->ClientProjectBudget->getAllProjectBudget($project_id);

        $clientProjectBudget = array();
        if ($clientProjectBudget_query)
        {
            foreach ($clientProjectBudget_query as $key => $pb)
            { //dostosowuję tablicę do tej w widoku
                $clientProjectBudget[$pb['ClientProjectBudget']['section_id']]['section'] = $pb['ClientProjectBudget'];
                $clientProjectBudget[$pb['ClientProjectBudget']['section_id']]['payments'] = $pb['ClientProjectBudgetPosition'];
            }
        }

        return $clientProjectBudget;
    }

    /**
     * Akcja krok 3 Harmonogram płatności
     *
     * @param (int)$project_id
     * @return void
     */
    public function add_payment($project_id = null)
    {
        $title = $subtitle = 'Harmonogram płatności';
        $this->ClientProject->id = $project_id;
        if (!$this->ClientProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Nie ma takiego projektu'));
        }
        $this->loadModel('Payment');
        if (!empty($this->data))
        {
//$this->request->data['ClientProject']['id'] = ;
            $project_data = json_decode($this->data['ClientProject']['project']);
//die(debug($project_data));
            $tmp['ClientProject']['id'] = $project_id;
            $tmp['ClientProject']['interval_project'] = $project_data->interval_project;
            $tmp['ClientProject']['auto_project'] = $project_data->auto_project;
            $this->ClientProject->save($tmp);

            $paymentsJson = json_decode($this->data['ClientProject']['payments'], true);
            
            foreach ($paymentsJson as &$payment)
            {
                if (!empty($payment['delete']))
                {
                    if ($payment['id'])
                    {
                        $this->Payment->delete($payment['id']);
                    }
                    continue;
                }
                $payment['client_project_id'] = $project_id;
                if (empty($payment['id']))
                {
                    $this->Payment->create();
                }
                $payment['price'] = str_replace(',', '.', $payment['price']);
                $this->Payment->save($payment);
            }
            if (isset($this->data['back_to_budget']))
            {
                $this->redirect(array('action' => 'add_budget', $project_id));
            }
            $this->redirect(array('action' => 'add_realization', $project_id));
        }
        $project = array();
        $payments = $this->Payment->getPayments($project_id);
        $this->loadModel('Payment');
        $interval = $this->Payment->interval();
        $payment_day = $this->Payment->paymentDay();
        $this->ClientProject->recursive = -1;
        $this->request->data = $project = $this->ClientProject->read(null, $project_id);

        $this->set(compact('project', 'title', 'subtitle', 'payments', 'interval', 'payment_day'));
    }

    /**
     * Akcja krok 4 Harmonogram realizacji
     *
     * @param (int)$project_id
     * @return void
     */
    public function add_realization($project_id = null)
    {
        $title = $subtitle = 'Harmonogram realizacji';

        $this->ClientProject->id = $project_id;
        if (!$this->ClientProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Nie ma takiego projektu'));
        }

        $session = $this->Session->read();
        $agreement = $this->ProjectFile->checkAgreement($project_id);
        $supervisor = $this->User->Section->findSupervisorByUser($session['Auth']['User']['id']);

        if (!empty($this->data))
        {
            $paymentsJson = json_decode($this->data['ClientProject']['payments'], true);
            foreach ($paymentsJson as $payment)
            {

                $payment['client_project_id'] = $project_id;

                if (!empty($payment['delete']))
                {
                    if (!empty($payment['id']))
                    {
                        $this->ClientProjectShedule->delete($payment['id']);
                    }
                    continue;
                }
                if (empty($payment['id']))
                {
                    $this->ClientProjectShedule->create();
                }
                $this->ClientProjectShedule->saveShedule($payment);
            }

//zatwierdza lead jako wygrany
            $this->ClientProject->ClientLead->id = $this->ClientProject->field('client_lead_id');
            $this->ClientProject->ClientLead->saveField('lead_status_id', '6');

            if (isset($this->data['back_to_payment']))
            {
                $this->redirect(array('action' => 'add_payment', $project_id)); // powrót do płatności - w przypadku kliknięcia powrót
            }

            if (!$agreement && isset($supervisor['Section']['email']))
            { //jeśli projekt nie zawier umowy i nie jest aktywny to wysyłam maila przełożonemu(przy ponownej edycji mail nie zostanie wysłany - projekt bedzie już aktywny)
                $project = $this->ClientProject->getProject($project_id, -1);

                if ($project['ClientProject']['active'] == false)
                {
                    $this->LogMail->sendNotifyEmailForProjectStartedWithoutAgreement($this->ClientProject->field('client_lead_id'), $project_id, $supervisor['Section']['email']);
                }
            } else
            {
//zakonczony proces zmiany leada na projekt
                $this->ClientProject->saveField('agreement', 1);
            }
            $this->ClientProject->saveField('active', 1);
            $this->redirect(array('action' => 'view', $project_id));
        }
        $shedules = $this->ClientProjectShedule->getShedules($project_id);
//echo $this->ClientProject->field('seo_domain');


        $this->loadModel('Payment');
        $interval = $this->Payment->interval();
        $payment_day = $this->Payment->paymentDay();
        $project = $this->ClientProject->find('first', array('conditions' => array('id' => $project_id), 'recursive' => -1));
        $this->set(compact('title', 'subtitle', 'supervisor', 'shedules', 'payment_day', 'interval', 'project_id', 'agreement', 'project'));
    }

    /*
     * dodawanie plików do projektu
     */

    function add_project_file()
    {
//sprawdzić czy jest ustawione file_id, jeśli tak to trzeba zapisać nowszą wersję pliku
        if ($this->request->is('post') || $this->request->is('put'))
        {

            $data['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['ProjectFile'] = $data;
            if ($this->ProjectFile->save($this->request->data))
            {
                $this->ClientProjectLog->saveFileLog(2, $this->data); //2 - logowanie operacji na plikach
                $this->Session->setFlash('Plik został zapisany poprawnie.', 'flash/success');
            } else
            {
                $this->Session->setFlash('Wystąpił bląd proszę spróbować ponownie.', 'flash/error');
            }
        }

        return $this->redirect($this->referer() . '#project_documents');
    }

    /*
     * dodawanie zescanowanych plików do projektu
     */

    function scan_project_file_ajax()
    {
        $this->loadModel('ProjectFile');
        $session = $this->Session->read();
        foreach ($this->data['files'] as $file)
        {
            $this->request->data['file'] = $this->ProjectFile->base2file($file);
            break;
        }
        if (!empty($this->request->data['file']))
        {
            $this->request->data['user_id'] = $session['Auth']['User']['id'];
            $this->ProjectFile->Behaviors->detach('Image.Upload');
            $this->ProjectFile->create();
            $return = $this->ProjectFile->save($this->data);
        } else
        {
            $return = false;
        }
        $this->set('return', $return);
        $this->set('_serialize', array('return'));
    }

    /*
     * dodawanie plików do projektu
     */

    function add_project_file_ajax()
    {
        if (is_string($this->request->data))
        {
            $data = json_decode($this->request->data, 1);
            $this->request->data = array();
        } else
        {
            $data = $this->request->data;
        }
        $data['user_id'] = $this->Session->read('Auth.User.id');
        if (!empty($_FILES['file']))
        {
            $data['file'] = $_FILES['file'];
        }
        if (!empty($data['id']))
        {
            $data['tmp_id'] = $data['id'];
            unset($data['id']);
        }
        $this->loadModel('ProjectFile');
        $return = $this->ProjectFile->rev_save_file(array('ProjectFile' => $data));

        $this->set('return', $return);
        $this->set('_serialize', array('return'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->ClientProject->id = $id;
        if (!$this->ClientProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $client_lead_id = $this->ClientProject->field('client_lead_id');

        $this->redirect(array('action' => 'add', $client_lead_id));
    }

    /*
     * Dodawanie notatni do projektu
     */

    public function add_project_note()
    {
        if (!empty($this->request->data))
        {
            $this->request->data['ClientProjectNote']['user_id'] = $this->Session->read('Auth.User.id');

            $this->ClientProjectNote->addClientProjectNote($this->request->data);

            $data['ClientProjectLog']['user_id'] = $this->Session->read('Auth.User.id');
            $data['ClientProjectLog']['client_project_id'] = $this->request->data['ClientProjectNote']['project_id'];
            $this->ClientProjectLog->saveLog(24, $data); //log_type - dodanie notatki do projektu
        }

        $this->redirect($this->referer() . '#project_notes');
    }

    public function project_note_access_for_client()
    {
        $this->layout = false;
        $this->render(false);

        if(empty($this->request->data['note_id']) || !isset($this->request->data['access'])){
            return false;
        }
        $note_id = (int) $this->request->data['note_id'];
        $access = $this->request->data['access'];

        return $this->ClientProjectNote->changeClientAccesToNote($note_id, $access);
    }

    /*
     *
     * 
     * 	Struktura przesyłanych danych:
     * 	$this->data['file_id'] = Array([id] => Array(    
     * 		[2015-03-31_11-26_faktura.docx] => Array        
     * 		(            
     * 			[faktura.docx] => true        
     * 		)
     * 	))
     *  
     */

    /*
     * metoda usuwa zaznaczone pliki i zwraca json
     */

    public function project_files_delete()
    {
        $return = false;
        if (!empty($this->data['files']))
        {
            foreach ($this->data['files'] as $projectFile)
            {
                if (!empty($projectFile['ProjectFile']['selected'])) //usuwam tylko zaznaczone pliki
                {
                    $return = $this->ProjectFile->deleteFile($projectFile['ProjectFile']['id'], 'project');
                }
            }
        }

        $this->set(compact('return'));
        $this->set('_serialize', 'return');
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->ClientProject->id = $id;
        if (!$this->ClientProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->ClientProject->delete())
        {
            $this->Session->setFlash(__d('public', 'Poprawnie usunięto.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('public', 'Nie można usunąć.'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index()
    {
        $this->helpers[] = 'FebTime';
        $this->ClientProject->recursive = 0;
        $this->set('clientProjects', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        $this->ClientProject->id = $id;
        if (!$this->ClientProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('clientProject', $this->ClientProject->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post'))
        {
            $this->ClientProject->create();
            if ($this->ClientProject->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $clientLeads = $this->ClientProject->ClientLead->find('list');
        $users = $this->ClientProject->User->find('list');
        $this->set(compact('clientLeads', 'users'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->ClientProject->id = $id;
        if (!$this->ClientProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->ClientProject->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->ClientProject->read(null, $id);
        }
        $clientLeads = $this->ClientProject->ClientLead->find('list');
        $users = $this->ClientProject->User->find('list');
        $this->set(compact('clientLeads', 'users'));
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->ClientProject->id = $id;
        if (!$this->ClientProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->ClientProject->delete())
        {
            $this->Session->setFlash(__d('cms', 'Poprawnie usunięto.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('cms', 'Nie można usunąć.'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Akcja do podpowiadaina danych z formularza
     * 
     * @param type $term
     * @throws MethodNotAllowedException 
     */
    function admin_autocomplete($term = null)
    {
        $this->layout = 'ajax';
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $params = array();
        $params['fields'] = array('name');

//Dodatkowe dane przekazywane z FebFormHelper-a
//if (!empty($this->request->data['fields']['field_name'])) {
//    $params['conditions']['ClientProject.field_name'] = $_POST['fields']['field_name'];
//}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->getProject->recursive = -1;
        $params['conditions']["ClientProject.name LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->ClientProject->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

    function get()
    {
        $data = $this->ClientProject->getDataTable();
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    function close_realization($type = null)
    {

        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        if (!($type == 0 or $type == 1 or ! isset($this->data['ClientProject']['acceptance_report'])))
        {
            throw new MethodNotAllowedException();
        }
        $this->ClientProject->id = $this->data['ClientProject']['id'];

        if (!$this->ClientProject->exists())
        {
            throw new MethodNotAllowedException();
        }

        if ($this->data['ClientProject']['acceptance_report'] == false AND $type == 1)
        { //wysyłam maila przy zamykaniu projektu
            $this->LogMail->sendNotifyEmailAboutProjectWithoutConfirmReport($this->data['ClientProject']['id'], $this->data['ClientProject']['name'], $this->data['ClientProject']['supervisor_email']);
        }
        $this->loadModel('Poll.Poll');
        $this->Poll->createPoll($this->ClientProject->id);
        $this->Poll->sendPoll($this->ClientProject->id);
        $this->ClientProject->saveField('close_realization', $type);
        $this->ClientProject->saveField('acceptance_report', (int) $this->data['ClientProject']['acceptance_report']);
        

        $data['ClientProjectLog']['user_id'] = $this->Session->read('Auth.User.id');
        $data['ClientProjectLog']['client_project_id'] = $this->data['ClientProject']['id'];
        if ($type == 1)
        {
            $this->ClientProjectLog->saveLog(8, $data); // zamknięcie rezalizacji projektu
        } else
        {
            $this->ClientProjectLog->saveLog(7, $data); // otwarcie realizacji projektu
        }


        $this->redirect(array('action' => 'view', $this->data['ClientProject']['id']));
    }

    function close_financing($type = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        if (!($type == 0 or $type == 1 or $type == 2))
        {
            throw new MethodNotAllowedException();
        }
        $this->ClientProject->id = $this->data['ClientProject']['id'];

        if (!$this->ClientProject->exists())
        {
            throw new MethodNotAllowedException();
        }

        //sprawdzanie czy wszystkie płatności zostałyoznaczone jako wykonane
        $this->loadModel('Payment');
        $timelinePayments = $this->Payment->parseTimeLine($this->data['ClientProject']['id'], 'all');
        $all_payments_done = true;
        if (empty($timelinePayments))
        {
            $all_payments_done = false; //jesli nie ma zdefiniowanych żadnych płatności to nie można zamknąć finansowania
        }
        foreach ($timelinePayments as $tlp)
        {
            if ($tlp['done'] == false)
            {
                $all_payments_done = false; //jeśli którakolwiek płatność nie została uregulowana to nie pozwalam na zakończenie finansowania
            }
        }

        if ($all_payments_done)
        {
            $this->ClientProject->saveField('close_financing', $type);

            $data['ClientProjectLog']['user_id'] = $this->Session->read('Auth.User.id');
            $data['ClientProjectLog']['client_project_id'] = $this->data['ClientProject']['id'];
            if ($type == 1)
            {
                $this->ClientProjectLog->saveLog(19, $data); // zamknięcia finansowania projektu
            } else
            {
                $this->ClientProjectLog->saveLog(20, $data); // otwarcie finansowania projektu
            }
        } else
        {
            $this->Session->setFlash(__d('public', 'Nie  można zamknąć finansowania projektu - nie wszystkie płatności zostały oznaczone jako wykonane'), 'flash/error');
        }

        $this->redirect(array('action' => 'view', $this->data['ClientProject']['id']));
    }

    /*
     * Jakiś komentarz do kodu może ktoś coś...?
     */

    function user2project()
    {
        if (empty($this->request->data['user_id']) ||
                !$this->ClientProject->User->exists($this->request->data['user_id'])
        )
        {
            $this->set('success', false);
            $this->set('error', 'user_id');
            $this->set('_serialize', array('success', 'error'));
            return false;
        }
        if (empty($this->request->data['client_project_id']) ||
                !$this->ClientProject->exists($this->request->data['client_project_id'])
        )
        {
            $this->set('success', false);
            $this->set('error', 'client_project_id');
            $this->set('_serialize', array('success', 'error'));
            return false;
        }

        $this->loadModel('ClientProjectUser');
        $this->loadModel('ClientProjectLog');
        $this->loadModel('Profile');
        $this->loadModel('Message');

        $params['fields'] = array('id', 'id');
        $params['limit'] = 1;
        $params['conditions']['ClientProjectUser.user_id'] = $this->request->data['user_id'];
        $params['conditions']['ClientProjectUser.client_project_id'] = $this->request->data['client_project_id'];

        $id = $this->ClientProjectUser->find('list', $params);
        $profile = $this->Profile->getProfile($this->request->data['user_id']);

        $data['ClientProjectLog']['user_id'] = $this->Session->read('Auth.User.id');
        $success = false;
        if (!empty($this->request->data['status']) && $id)
        {
// wygenerowanie powiadomienia 
            $projectName = $this->ClientProject->read('name', $this->request->data['client_project_id']);
            $projectName = $projectName['ClientProject']['name'];
            $this->Message->sendMessage($this->request->data['user_id'], 1, 'Usunięto dostęp do projektu: ' . $projectName);


            $this->ClientProjectUser->delete(reset($id));
            $success = 'delete';

            $data['ClientProjectLog']['client_project_id'] = $this->request->data['client_project_id'];
            $data['ClientProjectLog']['name'] = $profile['Profile']['firstname'] . ' ' . $profile['Profile']['surname'];
            $this->ClientProjectLog->saveLog(10, $data); //usunięcie osoby z projektu
        }

        if (empty($this->request->data['status']) && !$id)
        {
// wygenerowanie powiadomienia 
            $projectName = $this->ClientProject->read('name', $this->request->data['client_project_id']);
            $projectName = $projectName['ClientProject']['name'];
            $this->Message->sendMessage($this->request->data['user_id'], 1, 'Dodano dostęp do projektu: ' . $projectName);

            $this->ClientProjectUser->create();
            $tmp = $this->ClientProjectUser->save($this->request->data);
            $success = !empty($tmp) ? 'save' : false;

            $data['ClientProjectLog']['client_project_id'] = $this->request->data['client_project_id'];
            $data['ClientProjectLog']['name'] = $profile['Profile']['firstname'] . ' ' . $profile['Profile']['surname'];
            $this->ClientProjectLog->saveLog(9, $data); //dodanie osoby do projektu
        }

        $this->set('success', $success);
        $this->set('_serialize', array('success'));
    }

    /*
     * metoda sumuje koszty dla każdego projektu
     */

    function sumarize_all_project_costs()
    {
        $params['recursive'] = -1;
        $projects = $this->ClientProject->find('all', $params);

        foreach ($projects as $pro)
        {
            //debug('licze koszty dla '.$pro['ClientProject']['alias']);
            $this->sumarize_project_costs($pro['ClientProject']['id']);
        }
    }

    /*
     * co robi metoda:
     * - najpierw synchronizuje użytkowników z zadaniami z grindstona
     * - wyszukuje project_issues po danym id projektu
     * - smuje czasy dla poszczególnych użytkowników
     * - wyszukuje stawkę dla każdego uzytkownika(biorę ją z profilu)
     * 
     * @param id	id projektu
     */
    function sumarize_project_costs($id = null)
    {
        if (empty($id))
        {
            return false;
        }

        $this->loadModel('Profile');
        $this->loadModel('ProjectIssue');
        $this->loadModel('Grindstone');

        $params['conditions']['ProjectIssue.client_project_id'] = $id;
        $params['recursive'] = -1;
        $params['fields'] = 'id,project_users_name,user_id,project,time';
        $issues = $this->ProjectIssue->find('all', $params);


        $time = array();
        $tmp = '';
        if ($issues)
        {
            foreach ($issues as $value)
            {
                if (!isset($time[$value['ProjectIssue']['project_users_name']]))
                    $time[$value['ProjectIssue']['project_users_name']] = array();
                if (!isset($time[$value['ProjectIssue']['project_users_name']]['time']))
                    $time[$value['ProjectIssue']['project_users_name']]['time'] = 0;
                $time[$value['ProjectIssue']['project_users_name']]['time'] += $value['ProjectIssue']['time']; //sumuje czasy dla użytkowników
                $time[$value['ProjectIssue']['project_users_name']]['user_id'] = $value['ProjectIssue']['user_id'];
                if ($tmp != $value['ProjectIssue']['project_users_name'])
                {
                    $tmp = $value['ProjectIssue']['project_users_name'];
                }
            }

            //@todo [TODO] zapisywanie czasu każdego pracownika do tabeli client_project_users - dzięki temu możliwe było by wyświetlenie ile czasu kazdy pracownik spędził nad projektem w widoku projektu

            $total_cost = 0;
            $total_time = 0;
            foreach ($time as $value)
            {
                $params = array();
                $params['conditions']['Profile.user_id'] = $value['user_id'];
                $params['recursive'] = -1;
                $params['fields'] = 'id,user_id,hourly_rate';
                $prof = $this->Profile->find('first', $params);

                $total_time += round($value['time'] / 3600, 2);
                $total_cost += round($value['time'] / 3600, 2) * $prof['Profile']['hourly_rate']; //przeliczam czas na godziny i mnoże przez stawke pracownika
            }

            $this->ClientProject->id = (int) $id;
            $this->ClientProject->saveField('total_costs_sum', $total_cost); //zapisuję aktualną sumę wydatków poniesionych w projekcie
            $this->ClientProject->saveField('total_time_spent', $total_time); //zapisuję aktualną sumę wydatków poniesionych w projekcie

            debug('Koszty zostały policzone.');
        } else {
            debug('Brak zadań przypisanych do tego projektu.');
        }
    }

    public function share($project_id = null)
    {
        $this->ClientProject->id = (int) $project_id;
        if (!$this->ClientProject->exists())
        {
            $this->Session->setFlash(__d('public', 'Brak projektu'), 'flash/error');
            $this->redirect($this->referer());
        }
        
        $share = $this->ClientProject->field('share');
        $this->ClientProject->saveField('share', (int) !$share);
        
        if ($share) //jeśli klient ma dostęp do jest blokowany
        {
            $this->Session->setFlash(__d('public', 'Zablokowano dostep klientowi'), 'flash/success');
        } else { //jeśli kinet nie ma dostępu to zostaje mu on przyznany
            $this->share_send(!$share, $project_id);
            $this->Session->setFlash(__d('public', 'Udostępniono projekt klientowi'), 'flash/success');
        }
        $this->redirect($this->referer());
    }

    private function share_send($share = 0, $project_id = null)
    {
        $project = $this->ClientProject->getProject($project_id);
        App::uses('FebEmail', 'Lib');
        $email = new FebEmail('smtp');
        if ($share > 0)
        {
            $subject = 'Dane dostępowe do projektu';
            $value['feb_address'] = $_SERVER['SERVER_NAME'];
            $email->viewVars(
                    array(
                        'value' => $value,
                        'project' => $project,
                    )
            );

            $to[] = $project['Client']['email'];

            $email->template('share')
                    ->emailFormat('html')
                    ->to($to)
                    ->bcc("test_dev@febdev.pl")
                    ->from(array('crm@febdev.pl' => 'Fabryka e-biznesu'))
                    ->subject($subject);
            $email->send();
            $email->reset();
        }
    }

    function acceptance_report($project_id = null)
    {
        $return = false;
        $this->ClientProject->id = $project_id;
        if ($this->ClientProject->exists())
        {
            $return = $this->ClientProject->field('acceptance_report');
        }

        $this->set(compact('return'));
        $this->set('_serialize', 'return');
    }

    /*
     * metoda pobiera dane budzetowe do POPUPu
     */

    function get_budget($project_id = null)
    {
        if (empty($project_id))
        {
            return false;
        }

        $return = $this->prepare_project_budget($project_id);

        $this->set(compact('return'));
        $this->set('_serialize', 'return');
    }

    /*
     * metoda pobiera dane harmonogramu realizacji do POPUPu
     */

    function get_realization($project_id = null)
    {
        if (empty($project_id))
        {
            return false;
        }

        $return = $this->ClientProjectShedule->getShedules($project_id);

        $this->set(compact('return'));
        $this->set('_serialize', 'return');
    }

    /*
     * metoda pobiera dane harmonogramu płatności do POPUPu
     */

    function get_payment($project_id = null)
    {
        if (empty($project_id))
        {
            return false;
        }

        $this->loadModel("Payment");
        $return = $this->Payment->getPayments($project_id);

        $this->set(compact('return'));
        $this->set('_serialize', 'return');
    }

}
