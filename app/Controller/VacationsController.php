<?php

/*
 * @todo [TODO] dodanie zadania cron uruchamiającego na początku każdego miesiąca funkcję $this->workTimeForAllUsers(0); aby zliczyć czas pracy wszystkich pracowników w poprzednim miesiącu
 */

App::uses('AppController', 'Controller');
App::import('Vendor', 'redmine_api', array('file' => 'redmine_api' . DS . 'autoload.php'));

/**
 * Vacations Controller
 *
 * @property Vacation $Vacation
 */
class VacationsController extends AppController
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
    public $components = array('RequestHandler', 'CheckAccess', 'Sms'); //Slug.Slug

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('workTime', 'workTimeForAllUsers', 'summaryUserWorkingHoursAndContractDetails','get_section_vacations_by_date'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @param int $year
     * @return void
     */
    public function index($year = null)
    {
        $session = $this->Session->read();
        //phpinfo();
        $user_id = isset($this->params['named']['user']) ? $this->params['named']['user'] : null;
        $calendar_user_id = $user_id == null ? $session['Auth']['User']['id'] : $user_id;

        $this->loadModel('Profile');
        $profile = $this->Profile->find('first', array(
            'conditions' => array(
                'Profile.user_id' => $calendar_user_id
            ),
            'fields' => 'Profile.id',
            'recursive' => 1
        ));

        $this->loadModel('Calendar');
        $calendar = $this->Calendar->find('first', array(
            'conditions' => array(
                'Calendar.year' => date('Y')
            ),
            'fields' => 'Calendar.id',
            'recursive' => -1
        ));

        $title = "Zatrudnienie";
        $subtitle = "Zatrudnienie";
        
        $this->loadModel('UserContractHistory');
        $user_contract = $this->UserContractHistory->getCurrentContract($calendar_user_id);
      
        //sprawdzam czy użytkownik przeglądający wybrany profil ma na to uprawnienia(czy może zobaczyć zarobki)
        $user_authorized = $this->CheckAccess->checkIfUserIsAuthorized($session); //sprawdzam czy użytkownik należy do sekretariatu lub zarzadu

        $this->set($vacationData = $this->getVacationData($year, $title, $subtitle, $user_id));
        
        $this->set('calendar_id', $calendar['Calendar']['id']);
        $this->set('profile_id', $profile['Profile']['id']);
        $this->set('user_authorized', $user_authorized);
        $this->set('user_contract', $user_contract);
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @param int section_id
     * @return void
     */
    public function team($section_id = null)
    {

        $title = "Mój profil";
        $subtitle = "Mój team";
        $session = $this->Session->read();
        if (empty($section_id))
        {
            $section_id = $session['Auth']['User']['section_id'];
        }
        $this->loadModel('Section');
        if (!$this->Section->exists($section_id))
        {
            throw new NotFoundException(__d('cms', 'Brak teamu'));
        }
        $this->loadModel('UserSection');
        //user section params
        $usp['recursive'] = -1;
        $usp['fields'] = array('user_id', 'user_id');
        $usp['conditions']['UserSection.section_id'] = $section_id;
        $usersIds = $this->UserSection->find('list', $usp);
        $this->loadModel('UserContractHistory');
        $this->loadModel('PersonalAim');
        $this->loadModel('User.User');
        $this->loadModel('User.UsersLog');
        //user params
        $up['recursive'] = 0;
        $up['fields'] = array('User.id',
            'User.profile_name',
            'User.avatar',
            'User.avatar_url',
            'User.email',
            'Profile.id',
            'Profile.firstname',
            'Profile.surname');
        $up['conditions']['User.id'] = $usersIds;
        $this->User->virtualFields['profile_name'] = 'concat(`Profile`.`firstname`," ",`Profile`.`surname`)';
        $users = $this->User->find('all', $up);
        $this->User->virtualFields = array();
        $user_ids = array();
        $last6month = date('Y-m-d', strtotime('-6 month'));
        $attendance = 0;
        $profiles = array();
        foreach ($users as $user)
        {
            $user_id = $user['User']['id'];
            $user_ids[] = $user['User']['id'];
            $profiles[$user_id]['user_contract_history'] = $this->UserContractHistory->getUserContractHistory($user_id);
            $profiles[$user_id]['current_contract_history'] = $this->UserContractHistory->getCurrentContract($user_id);
            $personalAim = $this->PersonalAim->getPersonalAim($user_id);
            $profiles[$user_id]['PersonalAim'] = empty($personalAim) ? false : $personalAim['PersonalAim'];
            $profiles[$user_id]['User'] = $user['User'];
            $profiles[$user_id]['Profile'] = $user['Profile'];
            $attendance = $attendance + $profiles[$user_id]['attendance'] = $this->Vacation->attendance($user_id, $last6month, date('Y-m-d'));
            $profiles[$user_id]['last_login'] = $this->UsersLog->last_login($user_id);
            ;
        }
        $attendance = empty($users) ? 0 : number_format($attendance / count($users), 0);
        $sectionName = $this->Section->findWithoutUserList(array('conditions' => array('Section.id' => $section_id)));
        $upcomingVacations = $this->Vacation->getUpcomingVacations($user_ids);
        $this->set(compact('title', 'subtitle', 'profiles', 'sectionName', 'upcomingVacations', 'attendance'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @param int $year
     * @return void
     */
    public function calendar($year = null)
    {

        $title = "Zatrudnienie";
        $subtitle = "Zatrudnienie";
        $this->set($compact = $this->getVacationData($year, $title, $subtitle));

        $vacation_events = '';
        if ($compact['vacations'])
        {
            foreach ($compact['vacations'] as $vac)
            {
                if ($vac['Vacation']['vacation_status_id'] != 5)
                { //nie wyświetlam urlopów niezaakceptowanych
                    if ($vac['Vacation']['hour_start'] && $vac['VacationType']['is_hours'])
                    {
                        if ($vac['Vacation']['hour_start'] < 10)
                            $vac['Vacation']['hour_start'] = '0' . $vac['Vacation']['hour_start'];
                        $hour_start = 'T' . $vac['Vacation']['time_start'];
                    } else
                    {
                        $hour_start = 'T' . $vac['Vacation']['time_start'];
                    }
                    if ($vac['Vacation']['hour_end'] && $vac['VacationType']['is_hours'])
                    {
                        if ($vac['Vacation']['hour_end'] < 10)
                            $vac['Vacation']['hour_end'] = '0' . $vac['Vacation']['hour_end'];
                        $hour_end = 'T' . $vac['Vacation']['time_end'];
                    } else
                    {
                        $hour_end = 'T' . $vac['Vacation']['time_end'];
                    }
                    $vacation_events .= '{';

                    $user = '\n Zastępstwa: ';
                    foreach ($vac['VacationReplace'] as $replace)
                    {
                        if (isset($compact['users'][$replace['user_id']]))
                        {
                            if (isset($compact['users'][$replace['user_id']]) and isset($compact['projects'][$replace['project_id']]) and $compact['users'][$replace['user_id']] and $compact['projects'][$replace['project_id']])
                            {
                                $user .= '\n ' . $compact['users'][$replace['user_id']] . ' - ' . $compact['projects'][$replace['project_id']];
                            }
                        }
                    }
                    $vacation_events .= 'id: ' . $vac['Vacation']['id'] . ',';
                    $vacation_events .= 'title: "' . $vac['VacationType']['name'] . $user . '",';
                    $vacation_events .= 'start: "' . $vac['Vacation']['date_start'] . $hour_start . '",';
                    if ($vac['Vacation']['date_start'] != $vac['Vacation']['date_end'])
                    {
                        $vacation_events .= 'end: "' . date('Y-m-d', strtotime($vac['Vacation']['date_end'] . ' + 1 days')) . $hour_end . '",'; //muszę dodać jeden dzień do daty końcowej poniważ full calendar wyłącza datę końcową z zakresu
                    } else
                    {
                        $vacation_events .= 'end: "' . date('Y-m-d', strtotime($vac['Vacation']['date_end'])) . $hour_end . '",'; //nie dodaje jeśli urlop zaczyna się i kończy w ten sam dzień
                    }

                    if ($vac['VacationType']['is_hours'])
                        $vacation_events .= 'allDay: false,';
                    else
                        $vacation_events .= 'allDay: true,';

                    $vacation_events .= '}, 
							';
                }
            }
        } else
        {
            $vacation_events = '';
        }

        $this->set('vacation_events', $vacation_events);
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $vacation =  $this->Vacation->read(null, $id);
        $this->set('vacation', $vacation);

        $this->Vacation->id = $id;
        //$vacation = $this->Vacation->getVacation($id);
        $vacationType = $this->Vacation->VacationType->getType($vacation['Vacation']['vacation_type_id']);
        $this->set('vacationType', $vacationType);


        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];
        $this->loadModel('Profile');
        $profile = $this->Profile->getProfile($user_id); //$vacation['Vacation']['user_id']
        //die(debug($profile));
        $this->set('profile', $profile);

        if ($session['Auth']['User']['id'] == $vacation['Vacation']['user_id'])
        {
            //$this->set(compact('vacationType','profile'));
            $this->pdfConfig = array(
                'orientation' => 'portrait',
                'download' => false,
                'filename' => 'wniosek.pdf'
            );
        } else
        {
            $this->Session->setFlash(__d('public', 'Niepoprawny numer wniosku.'), 'default', array('class' => 'note note-danger'));
            $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * Akcja dodająca obiekt
     *
     * @param int $year
     * @return void
     */
    public function add($year = null)
    {

        $title = "Zatrudnienie";
        $subtitle = "Zatrudnienie";
        $this->set($this->getVacationData($year, $title, $subtitle));

        if ($this->request->is('post'))
        {
            // przeliczanie  dlugosci wyjscia prywatnego  na razie w wersji  TIME, można zostawić ilosć sekund, albo int np. 2,16 godziny
            if ($this->request->data['Vacation']['is_hours'] == 1)
            {
                if (empty($this->request->data['Vacation']['time_start']))
                {
                    $this->request->data['Vacation']['time_start'] = '080000';
                }
                if (empty($this->request->data['Vacation']['time_end']))
                {
                    $this->request->data['Vacation']['time_end'] = '100000';
                }
                $start = strtotime($this->request->data['Vacation']['time_start']);
                $end = strtotime($this->request->data['Vacation']['time_end']);
                $difference = $end - $start;
                $difference = gmdate('H:i', $difference);
                $this->request->data['Vacation']['private_time'] = $difference;
            }

            $session = $this->Session->read();
            
            $user_id = $session['Auth']['User']['id'];
            $this->request->data['Vacation']['vacation_status_id'] = 1;

                
            if ($this->Vacation->saveVacation($user_id, $this->request->data))
            {
                $this->loadModel('UserUser');
                $w_secretariat = $this->UserUser->getSecretariat();
                if(!empty($w_secretariat)){
                    $this->loadModel('Message');
                    foreach ($w_secretariat as $ws){
                        $url = Router::url(array('controller' => 'vacations', 'action' => 'vacation_applications'), true);
                        $this->Message->sendMessage($ws['user_users']['id'], 1, 'Złożono nowy wniosek urlopowy', $url); //powiadomienie do pracowników sekretariatu
                    }
                }
                
                $this->Session->setFlash(__d('public', 'Wniosek został złożony.'), 'default', array('class' => 'note note-success'));
                $this->redirect(array('action' => 'index#vacations'));
            } else {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error', array('class' => 'note note-danger'));
                //echo $errors = $this->Vacation->validationErrors;
            }
        }
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @param int $year
     * @return void
     */
    public function edit($id = null, $year = null)
    {

        $title = "Zatrudnienie";
        $subtitle = "Zatrudnienie";
        $this->set($vacationData = $this->getVacationData($year, $title, $subtitle));

        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $this->Vacation->id = $id;
        $vacation = $this->Vacation->getVacation($id);

        //nie można edytować zaakceptowanyhc lub odrzuconych wniosków, oraz wniosku nieprzypisanego do zalogowanego użytkownika
        if ($vacation['Vacation']['vacation_status_id'] == 4 || $vacation['Vacation']['vacation_status_id'] == 5 || $vacation['Vacation']['user_id'] != $user_id)
        {
            $this->Session->setFlash(__d('public', 'Nie możesz edytować tego wniosku.'), 'default', array('class' => 'note note-danger'));
            $this->redirect(array('action' => 'index#vacations'));
        }
        $vacationType = $this->Vacation->VacationType->getType($vacation['Vacation']['vacation_type_id']);

        $replaces = $this->Vacation->VacationReplace->listVacationProfile($id);

        $this->set('replaces', $replaces);

        $this->set(compact('vacationType', 'vacation'));

        if (!$this->Vacation->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {

            $this->request->data['Vacation']['id'] = $id;
            if ($this->Vacation->editVacation($user_id, $this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Wniosek został zapisany.'), 'default', array('class' => 'note note-success'));
                $this->redirect(array('action' => 'index#vacations'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error', array('class' => 'note note-danger'));
                //echo $errors = $this->Vacation->validationErrors;
            }
        } else
        {
            $this->request->data = $this->Vacation->read(null, $id);
        }
    }

    /**
     * Akcja obsługująca dane wspólne dla akcji index, edit i add
     *
     * @param int $year
     * @return void
     */
    public function getVacationData($year = null, $title = null, $subtitle = null, $user_id = null)
    {

        if ($user_id === null)
        {
            $session = $this->Session->read();
            $user_id = $session['Auth']['User']['id'];
        }


        $this->helpers[] = 'FebTime';
        $vacations = $this->Vacation->listVacation($user_id, $year);
        $vacationTypes = $this->Vacation->VacationType->listTypes();
        $vacationStatuses = $this->Vacation->VacationStatus->listVacationStatus();


        $params['recursive'] = -1;
        $vacationReplace = $this->Vacation->VacationReplace->find('all', $params);

        $this->loadModel('Profile');
        $profile = $this->Profile->getProfile($user_id);
        $tmp_profile = $this->Profile->checkTmpProfile($user_id);

        $users = $this->Profile->listProfiles();

        $this->loadModel('ProjectIssue');
        $pm_user = $this->Session->read('Auth.User.pm_user');

        $user = $this->Profile->User->getUser($user_id);

        $this->loadModel('UserContractHistory');
        $first_user_contract_history = $this->UserContractHistory->getFirstUserContractHistory($user_id); //aktualna umowa
        $user_contract_history = $this->UserContractHistory->getUserContractHistory($user_id);
        $first_user_contract_history = $this->UserContractHistory->getCurrentContract($user_id);


        $this->loadModel('UserWorkTime');
        $lastUserWorkTime = $this->UserWorkTime->getLastUserWorkTime(date('Y'), $user_id, 0); //wyszukuję wpis czasu pracy z poprzedniego miesiąca(żeby dodać całkowitą liczbę nadgodzin do aktualnego)


        $this->workTime(0); //zapisuję sumę czasu pracy użytkownika w aktualnym miesiącu

        /*
         * wyszukuje wszystkie projekty do których pracownik jest przypisany
         */
        $this->loadModel('ClientProjectUser');
        $client_project_user = $this->ClientProjectUser->getUserProjects($user_id);
      
        $projects = array();
        foreach ($client_project_user as $value){
            $projects[$value['ClientProject']['id']] = $value['ClientProject']['name'];
        }
        $projects[0] = 'Zastępstwo ogólne, wszystkie projekty';
        /*
         * ---------------------------------------------------------------
         */

        $userVacations = $this->summaryUserVacations($user_id, date('Y-m-01'), date('Y-m-t'));

        $months_names = $this->Vacation->months_names;

        $days = 0;
        $hours = 0;
        if ($vacations)
        {
            foreach ($vacations as $vac):
                if ($vac['VacationType']['is_hours'])
                {
                    if ($vac['Vacation']['vacation_status_id'] == 4)
                    { //liczę tylko urlopy zaakceptowane
                        $hours += $vac['Vacation']['hour_end'] - $vac['Vacation']['hour_start'];
                    }
                } else
                {
                    $secs = strtotime($vac['Vacation']['date_end']) - strtotime($vac['Vacation']['date_start']);
                    if ($vac['Vacation']['vacation_status_id'] == 4)
                    { //liczę tylko urlopy zaakceptowane
                        $days += ($secs / 86400) + 1; //+1 ponieważ urlop liczy się razem z datą początkową, np. od 2015-03-08 do 2015-03-08 
                    }
                }
            endforeach;
        }

        if (!empty($pm_user))
        {
            $work_time = $this->ProjectIssue->getTime($pm_user);
        } else
        {
            $work_time = 0;
        }


        $this->loadModel('UserWorkTime');
        $user_work_time = $this->UserWorkTime->getUserWorkTime(date('Y'), $user_id);

        return compact('vacations', 'title', 'subtitle', 'user_contract_history', 'userVacations', 'lastUserWorkTime', 'first_user_contract_history', 'profile', 'projects', 'work_time', 'user_work_time', 'days', 'hours', 'overtime', 'work_hours', 'months_names', 'tmp_profile', 'year', 'vacationTypes', 'vacationStatuses', 'vacationReplace', 'users');
    }

    /*
     * Zapisuję sumę czasu pracy pracownika
     * 
     * @param	$current_month	int definjuje obliczany miesiąc - 1 to miesiąc aktualny, 0 lub inna wartość to miesiąc poprzedni
     */

    public function workTime__($current_month = 0, $user_id = null)
    {
        $session = $this->Session->read();
        if (empty($user_id))
        {
            $user_id = $session['Auth']['User']['id'];
        }


        $this->summaryUserMonthWorkTime($user_id, $current_month);
    }

    /*
     * Zapisuję sumę czasu pracy pracownika
     * 
     * @param	$current_month	int definjuje obliczany miesiąc - 1 to miesiąc aktualny, 0 lub inna wartość to miesiąc poprzedni
     */
    public function workTime($month = 0, $user_id = null)
    {
        $session = $this->Session->read();
        if (empty($user_id))
        {
            $user_id = $session['Auth']['User']['id'];
        }


        $this->userContracts($user_id, date('Y'), $month);
    }

    /*
     * Zapisuję sumę czasu pracy każdego pracownika
     * 
     * @param	$current_month	int definjuje obliczany miesiąc - 1 to miesiąc aktualny, 0 lub inna wartość to miesiąc poprzedni
     */
    public function workTimeForAllUsers($month = 0)
    {

        $title = "Sumowanie czasu pracy";
        $subtitle = "Sumowanie czasu pracy";

        $this->set(compact('title', 'subtitle'));

        $this->loadModel('Profile');
        $users = $this->Profile->User->getAllUsers();
        //die(debug($users));
        foreach ($users as $user)
        {
            //$this->summaryUserMonthWorkTime($user['User']['id'],$current_month);

            $this->loadModel('Grindstone');
            $grindstone = $this->Grindstone->find('first', array(// 3
                'recursive' => -1,
                'fields' => 'id,project_user_name,user_id,modified,name,synchronized',
                'conditions' => array(
                    'Grindstone.user_id' => $user['User']['id'],
                )
            ));

            if ($grindstone)
            {
                $this->userContracts($user['User']['id'], date('Y'), $month);
                debug('liczę czas dla ' . $user['User']['email']);
            }
        }
    }

    /*
     * Obliczanie wymiaru czasu pracy pracownika na podstawie jego umów
     */
    public function userContracts($user_id = null, $year = null, $selected_month = 0)
    {
        if (empty($user_id))
        {
            return false;
        }

        if ($selected_month == 0)
        { //miesiąc aktualny
            $month_start = date('Y-m-01');
            $month_end = date('Y-m-t');
        } else
        { //wybrany miesiąc
            $month_start = date('Y-' . $selected_month . '-01');
            $month_end = date('Y-' . $selected_month . '-t');
            if ($selected_month < 10)
                $selected_month = '0' . $selected_month;
        }

        $this->loadModel('UserContractHistory');
        //wyszukuje wszystkie umowy pracownika w danym miesiącu(teoretycznie max to 2)
        $user_contract_history_by_date = $this->UserContractHistory->getUserContractHistoryByDate($user_id, $month_start, $month_end); //wyszukuję aktualną umowę

        if ($user_contract_history_by_date)
        {
            foreach ($user_contract_history_by_date as $uch)
            {
                $contract['id'] = $uch['UserContractHistory']['id'];
                $contract['summary'] = $uch['UserContractHistory']['state'] . ' ' . $uch['UserContractHistory']['working_time'];
                $contract['working_time'] = $uch['UserContractHistory']['working_time']; //wymiar czasu pracy np. 1.0 etat

                /*
                 * @todo jeśli umowa zaczyna się lub kończy w terminie innym niż pocątek lub koniec miesiąca to trzeba to uwzględnić i odpowiednio odjąc różnicę
                 * w godzinach do przepracowania(trzeba obliczyć ją na nowo - liczbę dni pracujących w tym czasie minus święta
                 */
//				if(strtotime($uch['UserContractHistory']['employment_start']) > strtotime($month_start)){
//					$month_start = $uch['UserContractHistory']['employment_start']; //liczę od początku umowy
//				} 
//				if(strtotime($uch['UserContractHistory']['employment_end']) < strtotime($month_end)){
//					$month_end = $uch['UserContractHistory']['employment_end']; //liczę do końca umowy
//				} 

                $this->summaryUserMonthWorkTime($user_id, $month_start, $month_end, $contract, $year, $selected_month);
            }
        }
    }

    /*
     * @param $month_start		data - początek miesiąca
     * @param $month_end		data - koniec miesiąca
     * @param $contract			array - zawiera trzy pola: working_time(wymiar etatu), history_id(id umowy), summary(info. o umowie)
     * 
     *
     * Metoda wylicza i zapisuje dane związane z czasem pracy pracownika
     * 
     * Obliczane są:
     *  godziny przepracowane w tym miesiącu, 
     *  liczba godzin pracujących
     *  liczba godzin urlopu
     *  godziny do przepracowania(godziny pracujące minus urlop)
     *  liczba nadgodzin - różnica godzin do przepracowania i przepracowanych(może być ujemna)
     */
    public function summaryUserMonthWorkTime($user_id = null, $month_start = null, $month_end = null, $contract = null, $year = null, $selected_month = 0)
    {
        if (empty($user_id) || empty($month_start) || empty($month_end) || empty($contract))
        {
            return false;
        }

        /*
         * godziny przepracowane w tym miesiącu
         */
        if ($selected_month == 0)
            $selected_month = date('m');
        if (empty($year))
            $year = date('Y');
        $this->loadModel('ProjectIssue');
        $user_worked_hours = $this->ProjectIssue->getTimeByDate($user_id, $year, $selected_month);

        //----------------------------

        /*
         * liczba godzin pracujących w danym miesiącu
         */
        $this->EventDefined = ClassRegistry::init('EventDefined');
        $eventsDefinedList = $this->EventDefined->parseEventDefined();

        $workDay = $this->Vacation->parseToWorkDay($month_start, $month_end, $eventsDefinedList);
        $work_time['WorkTime']['work_hours'] = count($workDay) * (8 * (float) $contract['working_time']); //mnoże godziny razy wymiar czasu pracy - jeśli pół etatu to 8 * 0.5
//        $this->loadModel('WorkTime');
//        $work_time = $this->WorkTime->getWorkTime(date('Y'), date('m', strtotime($month_start))); //Pobiera liczbę godzin pracujących w danym miesiącu
//        if (!$work_time)
//        {
//            throw new NotFoundException(__d('cms', 'Uzupełnij liczbę godzin praujących w ustawieniach hr '));
//        }
        //-------------------------

        /*
         * $userVacations - zawiera trzy pola: vacation_days(liczba dni urlopu), sick_leave(liczba dni na zwolnieniu lekarskim), overtime_settlement(odpracowane godziny)
         */
        $userVacations = $this->summaryUserVacations($user_id, $month_start, $month_end); //Obliczanie sumy urlopów pracownika

        $hours_to_work = $work_time['WorkTime']['work_hours'] - $userVacations['vacation_days'] * 8; //godziny do przepracowania - godziny pracujące w danym miesiącu minus urlopy pracownika

        /*
         * jeśli umowa jest na niepełny etat to trzeba policzyć dni w danym miesiącu, ręcznie odjąc święta i dni wolne a na koniec przeliczyć to na godziny
         */
//        if ((int) $contract['working_time'] != 1)
//        {
//            $hours_to_work = $work_time['WorkTime']['work_hours'] * (float) $contract['working_time'] - $userVacations['vacation_days'] * 8; //godziny do przepracowania - godziny pracujące w danym miesiącu pomnożone przez wymiar etatu minus urlopy pracownika
//        }
        //-------------------

        $worked_hours_summary = $user_worked_hours - 3600 * $hours_to_work - $userVacations['overtime_settlement']; //czas przepracowany minus czas do przepracowania minus odpracowane godziny - na plusie to nadgodziny, na minusie - nie wyrobione godziny

        /*
         * sumowanie nadgodzin
         */
        $this->loadModel('UserWorkTime');
        $lastUserWorkTime = $this->UserWorkTime->getLastUserWorkTime(date('Y'), $user_id, $selected_month); //wyszukuję wpis czasu pracy z poprzedniego miesiąca(żeby dodać całkowitą liczbę nadgodzin do aktualnego)

        if (isset($lastUserWorkTime['UserWorkTime']))
        {
            $overhours_all = $lastUserWorkTime['UserWorkTime']['total_overtime'] + $worked_hours_summary;
        } else
        {
            $overhours_all = $worked_hours_summary;
        }
        //-------------------


        $data['user_id'] = $user_id;
        $data['year'] = date('Y');
        $data['month'] = $selected_month;
        $data['hours_to_work'] = $work_time['WorkTime']['work_hours'];
        $data['hours_worked'] = round($user_worked_hours / 3600, 2);
        $data['user_contract_history_id'] = $contract['id'];
        $data['contract_summary'] = $contract['summary'];
        $data['overtime'] = round($worked_hours_summary / 3600, 2);
        $data['total_overtime'] = round($overhours_all / 3600, 2);
        $data['vacations'] = $userVacations['vacation_days'];
        $data['sick_leave'] = $userVacations['sick_leave'];

        $this->UserWorkTime->saveUserWorkTime($data);
    }

    /*
     * Obliczanie wymiaru czasu pracy pracownika na podstawie jego umów
     */
    public function summaryUserWorkingHoursAndContractDetails($user_id = null, $month_start = null, $month_end = null)
    {
        if (empty($user_id) || empty($month_start) || empty($month_end))
        {
            $counting_hours = 0;
            $state = '';
            return compact('counting_hours', 'state');
        }

        $this->loadModel('UserContractHistory');
        //wyszukuje wszystkie umowy pracownika w danym miesiącu(teoretycznie max to 2)
        $user_contract_history_by_date = $this->UserContractHistory->getUserContractHistoryByDate($user_id, $month_start, $month_end); //wyszukuję aktualną umowę

        $this->loadModel('WorkTime');
        $WorkTime = $this->WorkTime->getWorkTime(date('Y'), date('m', strtotime($month_start))); //Pobiera liczbę godzin pracujących w danym miesiącu
        if (!$WorkTime)
        {
            throw new NotFoundException(__d('cms', 'Uzupełnij liczbę godzin praujących w ustawieniach hr '));
        }

        $counting_hours = 0; // godziny wyliczone do przepracowania w danym miesący
        $contract_summary = ''; // rodzaj umowy + wymiar czasu pracy + godziny do przepracowania
        if ($user_contract_history_by_date)
        {

            foreach ($user_contract_history_by_date as $uch)
            {
                $contract_history_id[] = $uch['UserContractHistory']['id'];
                $contract_summary .= $uch['UserContractHistory']['state'] . ' ' . $uch['UserContractHistory']['working_time'];
                /*
                 * obliczanie wymiaru czacu pracy w zależności od mumowy
                 */
                if ($uch['UserContractHistory']['employment_start'] > $month_start)
                {
                    $counting_date_start = $uch['UserContractHistory']['employment_start']; //liczę od początku umowy
                } else
                {
                    $counting_date_start = $month_start; //liczę od początku miesiąca
                }

                if ($uch['UserContractHistory']['employment_end'] > $month_end)
                {
                    $counting_date_end = $month_end; //liczę do końca miesiąca
                } else
                {
                    $counting_date_end = $uch['UserContractHistory']['employment_end']; //liczę końca umowy
                }

                if (($uch['UserContractHistory']['employment_start'] <= $month_start) && ($uch['UserContractHistory']['employment_end'] >= $month_end))
                {
                    //umowa w trakcie trwanie, nie potrzeba specjalnych obliczeń, używam tylko wymiar czasu pracy dla danego miesiąca 
                    if ($WorkTime)
                    {
                        $counting_hours += $WorkTime['WorkTime']['work_hours'] * $uch['UserContractHistory']['working_time'];
                        $contract_summary .= '/' . $counting_hours . ' <br/>';
                    }
                } else
                {
                    //umowa jest krótsza niż dany miesiąc, potrzebne obliczenia
                    $working_days = 0; //liczba dni pracujących
                    $counter = strtotime($counting_date_start);
                    while (date("Y-m-d", $counter) <= $counting_date_end)
                    { //zliczam dni 
                        if (in_array(date("w", $counter), array(0, 6)) == false)
                        { //jeśli dany dzień nie jest sobotą lub niedzielą dodaje go do sumy dni pracujących
                            $working_days++;
                        }
                        $counter = strtotime("+1 day", $counter); //dodaje 1 dzień do licznika
                    }
                    $counting_hours += ($working_days * 8 * $uch['UserContractHistory']['working_time']); //liczba godzin pracujących * wymiar etatu	
                    $contract_summary .= '/' . $counting_hours . ' <br/>';
                }
                /*
                 * koniec obliczania wymiaru czacu pracy w zależności od mumowy
                 */
            }
        } else
        {
            $contract_history_id[] = 0;
            $contract_summary = 'Brak danych';
        }

        return compact('counting_hours', 'contract_summary', 'contract_history_id');
    }

    /*
     * Obliczanie sumy urlopów pracownika
     */
    public function summaryUserVacations($user_id = null, $last_month_start = null, $last_month_end = null)
    {
        if (empty($user_id) || empty($last_month_start) || empty($last_month_end))
        {
            $vacation_days = 0;
            $sick_leave = 0;
            $overtime_settlement = 0;
            return compact('vacation_days', 'sick_leave', 'overtime_settlement');
        }
        $vacation_by_date = $this->Vacation->getVacationByDate($user_id, $last_month_start, $last_month_end); //wyszukuję urlopy w danym zakresie

        $vacation_days = 0; //suma dni urlopu
        $overtime_settlement = 0; //suma rozliczenia nadgodzin(pracownik odbiera nadgodziny w formie urlopu godzinowego, np. może wcześniej wyjść z pracy
        $sick_leave = 0; //suma zwolnień lekarskich
        foreach ($vacation_by_date as $vbd)
        {
            if (($vbd['Vacation']['vacation_status_id'] == 4) && $vbd['VacationType']['is_hours'] == false)
            { //liczę tylko jeśli wniosek jest zaakceptowany i nie jest godzinowy
                if ($vbd['Vacation']['date_start'] > $last_month_start)
                {
                    $counting_date_start = $vbd['Vacation']['date_start']; //liczę od początku urlopu
                } else
                {
                    $counting_date_start = $last_month_start; //liczę od początku miesiąca
                }

                if ($vbd['Vacation']['date_end'] > $last_month_end)
                {
                    $counting_date_end = $last_month_end; //liczę do końca miesiąca
                } else
                {
                    $counting_date_end = $vbd['Vacation']['date_end']; //liczę do końca urlopu
                }
                if (($vbd['Vacation']['date_start'] <= $last_month_start) && ($vbd['Vacation']['date_end'] >= $last_month_end))
                {
                    //urlop w trakcie trwanie, nie potrzeba specjalnych obliczeń, używam tylko wymiar czasu pracy dla danego miesiąca 
                    $vacation_days = $counting_hours / 24;
                } else
                {
                    $counter = strtotime($counting_date_start);
                    while (date("Y-m-d", $counter) <= $counting_date_end)
                    { //zliczam dni 
                        if (in_array(date("w", $counter), array(0, 6)) == false)
                        { //jeśli dany dzień nie jest sobotą lub niedzielą dodaje go do sumy dni pracujących
                            $vacation_days++;
                        }
                        $counter = strtotime("+1 day", $counter); //dodaje 1 dzień do licznika
                    }
                }
                if ($vbd['Vacation']['vacation_type_id'] == 6)
                {
                    $sick_leave += $vacation_days; ///sumuje dni zwolnienia lekarskiego
                }
            }
            if (($vbd['Vacation']['vacation_status_id'] == 4) && $vbd['Vacation']['vacation_type_id'] == 5)
            { //tylko zatwierdzone wnioski rozliczenia nadgodzin
                $overtime_settlement += $vbd['Vacation']['time_end'] - $vbd['Vacation']['time_start'];
            }
        }

        return compact('vacation_days', 'sick_leave', 'overtime_settlement');
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
        $this->Vacation->id = $id;

        $vacation = $this->Vacation->getVacation($id);
        if ($vacation['Vacation']['vacation_status_id'] == 4 || $vacation['Vacation']['vacation_status_id'] == 5)
        {
            $this->Session->setFlash(__d('public', 'Nie możesz usunąć tego wniosku.'), 'default', array('class' => 'note note-danger'));
            $this->redirect(array('action' => 'index#vacations'));
        }

        if (!$this->Vacation->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'), 'default', array('class' => 'note note-danger'));
        }
        if ($this->Vacation->delete())
        {
            $this->Session->setFlash(__d('public', 'Wniosek o urlop został usunięty.'), 'default', array('class' => 'note note-success'));
            $this->redirect(array('action' => 'index#vacations'));
        }
        $this->Session->setFlash(__d('public', 'Nie można usunąć.'), 'flash/error');
        $this->redirect(array('action' => 'index#vacations'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index()
    {
        $this->helpers[] = 'FebTime';
        $this->Vacation->recursive = 0;
        $this->set('vacations', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        $this->Vacation->id = $id;
        if (!$this->Vacation->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('vacation', $this->Vacation->read(null, $id));
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

            $this->Vacation->create();
            if ($this->Vacation->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $vacationTypes = $this->Vacation->VacationType->find('list');
        $vacationStatuses = $this->Vacation->VacationStatus->find('list');
        $this->set(compact('vacationTypes', 'vacationStatuses'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->Vacation->id = $id;
        if (!$this->Vacation->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Vacation->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->Vacation->read(null, $id);
        }
        $vacationTypes = $this->Vacation->VacationType->find('list');
        $vacationStatuses = $this->Vacation->VacationStatus->find('list');
        $this->set(compact('vacationTypes', 'vacationStatuses'));
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
        $this->Vacation->id = $id;
        if (!$this->Vacation->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Vacation->delete())
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
        $params['fields'] = array('vacation_type_id');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['Vacation.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->Vacation->recursive = -1;
        $params['conditions']["Vacation.vacation_type_id LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->Vacation->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

    /**
     * Widok listy wniosków urlopowych dla sekreteriatu
     */
    function vacation_applications()
    {

        $title = "Lista wniosków urlopowych";
        $subtitle = "Lista wniosków urlopowych";

        if ($this->request->is('post'))
        {
            $this->Vacation->hasMany = array();
            $vacations = $this->Vacation->getVacations();

            $this->set(compact('vacations'));
            $this->set('_serialize', array('vacations'));
        } else
        {

            $this->set(compact('title', 'subtitle'));
        }
    }

    /**
     * Zmiana statusu danego wniosku urlopowego na nowy
     */
    function change_vaccation_status()
    {
        $this->loadModel('Message');
        $this->Vacation->read(null, $this->request->data['vacation_id']);
        $this->Vacation->set('vacation_status_id', $this->request->data['new_status']);
        $saveVacation = $this->Vacation->save(null, false);
        if (!empty($saveVacation['Vacation']['user_id']))
        {
            $this->Message->sendMessage($saveVacation['Vacation']['user_id'], 1, 'Zmieniono status wniosku urlopowego');
        }
        //odliczanie wolnych dni urlopowych od aktualnej umowy jeśli status wniosku zmieniany na zatwierdzony
        if ($this->request->data['new_status'] == 4 && $this->request->data['profile_id'] != null)
        {
            $this->loadModel('Profile');
            $this->loadModel('UserContractHistory');

            $profile = $this->Profile->findById($this->request->data['profile_id']);
            $uch = $this->UserContractHistory->getCurrentContract($profile['Profile']['user_id']);

            if ($uch)
            {
                $uch['UserContractHistory']['vacation_available'] -= $this->request->data['vacation_days'];
                if ($this->UserContractHistory->save($uch, false))
                {
                    $this->Message->sendMessage($profile['Profile']['user_id'], 1, 'Zaakceptowano wniosek urlopowy');
                    
                    $this->loadModel('VacationReplace');
                    $this->loadModel('ClientProjectUser');
                    $vacation_replaces = $this->VacationReplace->listVacationProfile($this->request->data['vacation_id']); //lista zastępst wyznaczonych na dany urlop
                    foreach ($vacation_replaces as $vr){
                        //wysyłam wiadomość do użytkowników, że zostali wyznaczeni na zastępstno
                        if($vr['VacationReplace']['project_id'] > 0){ //zastępstwo w projekcie                          
                            $url = Router::url(array('controller' => 'client_projects', 'action' => 'view', $vr['VacationReplace']['project_id']), true);
                            $this->Message->sendMessage($vr['VacationReplace']['user_id'], 1, 'Zostałeś wyznaczony przez '.$profile['Profile']['firstname'].' '.$profile['Profile']['surname'].' jako zastępstwo do projektu podczas jego nieobecności w dniach '.$saveVacation['Vacation']['date_start'].' - '.$saveVacation['Vacation']['date_end'],$url);
                            
                            //sprawdzam czy użytkownik jest już przydzielony do projektu, jeśli nie to go przydzielam i ustalam date zakończenia
                            $params['conditions'] = array(
                                'ClientProjectUser.user_id' => $vr['VacationReplace']['user_id'],
                                'ClientProjectUser.client_project_id' => $vr['VacationReplace']['project_id']
                            );
                            $params['recursive'] = -1;
                            $client_project_user = $this->ClientProjectUser->find('first', $params);
                            if(!$client_project_user){
                                $client_project_user['ClientProjectUser']['user_id'] = $vr['VacationReplace']['user_id'];
                                $client_project_user['ClientProjectUser']['client_project_id'] = $vr['VacationReplace']['project_id'];
                                $client_project_user['ClientProjectUser']['replacement_till'] = date('Y-m-d', strtotime($saveVacation['Vacation']['date_end']. ' + 2 days'));
                                if($this->ClientProjectUser->save($client_project_user)){
                                    $url = Router::url(array('controller' => 'client_projects', 'action' => 'view', $vr['VacationReplace']['project_id']), true);
                                    $this->Message->sendMessage($vr['VacationReplace']['user_id'], 1, 'Na czas nieobecności '.$profile['Profile']['firstname'].' '.$profile['Profile']['surname'].' został ci przydzielony dostęp do projektu',$url);
                                }
                            }
                        } else { //zastępstwo ogólne
                            $this->Message->sendMessage($vr['VacationReplace']['user_id'], 1, 'Zostałeś wyznaczony przez '.$profile['Profile']['firstname'].' '.$profile['Profile']['surname'].' na zastępstwo podczas jego nieobecności w dniach '.$saveVacation['Vacation']['date_start'].' - '.$saveVacation['Vacation']['date_end']);
                        }
                        //-------------------------------------------------------------
                        
                    } 
                }
            }
        }

        $this->autoRender = false;
    }
    
    function get_section_vacations_by_date(){
        
        if($this->request->is('post') && $this->request->data['date_start'] && $this->request->data['date_end']){
        //if ($this->request->data['date_start'] && $this->request->data['date_end']){
            $section_id = $this->Session->read('Auth.User.section_id');
           
            //wyszukuje pracowników z działu osoby składającej wniosek
            $this->loadModel('UserSection');
            $params['conditions'] = array(
                'UserSection.section_id' => $section_id
            );
            $params['recursive'] = -1;
            $users = $this->UserSection->find('all',$params);
            //-------------------------------------
            
            //dla każdego pracownika w dziale wyszukuje jego urlopy w podanym zakresie
            $section_vacation = array();
            foreach ($users as $user){
                if(!empty($user['UserSection']['user_id'])){
                    $vacations = $this->Vacation->getVacationByDate($user['UserSection']['user_id'], $this->request->data['date_start'], $this->request->data['date_end'],4);
                    if(!empty($vacations)){
                        $section_vacation[] = $vacations;
                    }
                }
            }
            //-------------------------------------
            //die(debug($section_vacation));
            
            $this->set(compact('section_vacation'));
            $this->set('_serialize', array('section_vacation'));
        } 
        
    }

}
