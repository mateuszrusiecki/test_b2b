<?php

App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');

/**
 * Briefs Controller
 *
 * @property Brief $Brief
 */
class BriefsController extends AppController
{

    public $layout = 'default';

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array();

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array('CheckAccess'); //Slug.Slug
    public $group_name = array('1' => 'www', '2' => 'facebook', '3' => 'Zintegrowany', '4' => 'Buzz');
    public $category_name = array('1' => 'IT', '2' => 'SEO');

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('view', 'get_answers_ajax', 'save_answer_ajax', 'notify_salesman'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index()
    {
        $title = 'Briefing';
        $subtitle = 'Briefing';

        $this->helpers[] = 'FebTime';
        $this->Brief->recursive = 0;
        $params['order'] = 'Brief.client_lead_id DESC, Brief.id DESC';
        //$params['group'] = 'Brief.client_lead_id';
        $this->paginate = $params;
        $this->set('briefs', $this->paginate());

        $this->loadModel('BriefDefaultQuestion');
        $brief_default_questions = $this->BriefDefaultQuestion->find('all');

        $group_name = $this->BriefDefaultQuestion->group_name;
        $category_name = $this->BriefDefaultQuestion->category_name;
        $this->set(compact('brief_default_questions', 'group_name', 'category_name','title','subtitle'));
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($id = null, $find_lead = false)
    {
        $title = 'Briefing';
        $subtitle = 'Briefing';
        
        $access = ($_SESSION['user_permission'] == 'all' || $_SESSION['user_permission'] == 'manager' || $_SESSION['user_permission'] == 'trader');

        
        /*
         *  BriefsCtrl.js - $scope.getBrief = function(brief_id){ ... });
         */
        if ($this->request->is('post'))
        {
            //die(debug($this->request->data['brief_id']));
            $this->loadModel('BriefQuestion');
            $params['conditions']['brief_id'] = $this->request->data['brief_id'];
            $params['recursive'] = 1;
            $brief_questions_query = $this->BriefQuestion->find('all', $params);
            $brief_questions = array();
            $brief_questions['brief_id'] = $this->request->data['brief_id'];
            /*
             * Przygotowuję odpowiednia strukturę - pytania i odpowiedzi do nich w blokach 'nazwa grupy - nazwa kategorii'
             */
            foreach ($brief_questions_query as $b)
            {
                $tmp = $b['BriefQuestion'];
                $tmp['BriefAnswer'] = $b['BriefAnswer'];
                $brief_questions[$b['BriefQuestion']['group_name'] . ' - ' . $b['BriefQuestion']['category_name']][] = $tmp;
            }
            //die(debug($brief_questions));
            if (!empty($brief_questions))
            {
                $this->set('data', $brief_questions);
                $this->set('_serialize', array('data'));
            }
            
            return;
        }
        
        if (empty($id))
        {
            throw new NotFoundException(__('Invalid id'));
        }
        
        if ($find_lead && ($access))
        {
            $brief = $this->Brief->findByClientLeadId($id, 1);
        } else {
            $params['conditions']['or']['Brief.hid'] = $id;
            if ($access)
            {
                $params['conditions']['or']['Brief.id'] = $id;
            }
            $brief = $this->Brief->find('first', $params);
        }

        if (empty($brief) && !empty($find_lead))
        {
            $this->redirect(array('action' => 'add', $id));
        }

        if (empty($brief) && empty($find_lead))
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($brief['Brief']['completed'])
        {
            $this->Session->setFlash(__d('public', 'Brief został zamknięty.'), 'flash/info');
        }

        $params2['conditions'] = array(
            'Brief.client_lead_id' => $brief['Brief']['client_lead_id'],
        );
        $params2['recursive'] = -1;
        $all_briefs = $this->Brief->find('all', $params2);

        $this->loadModel('BriefQuestion');
        $params3['conditions']['brief_id'] = $brief['Brief']['id'];
        $params3['recursive'] = 1;
        $brief_questions_query = $this->BriefQuestion->find('all', $params3);

        /*
         * Przygotowuję odpowiednia strukturę - pytania i odpowiedzi do nich w blokach 'nazwa grupy - nazwa kategorii'
         */
        foreach ($brief_questions_query as $b)
        {
            $tmp = $b['BriefQuestion'];
            $tmp['BriefAnswer'] = $b['BriefAnswer'];
            $brief_questions[$b['BriefQuestion']['group_name'] . ' - ' . $b['BriefQuestion']['category_name']][] = $tmp;
        }


        $session = $this->Session->read();
        $user_permission = $session['user_permission']; //uprawnienia użytkownika

        $this->set(compact('brief', 'all_briefs', 'brief_questions', 'user_permission','title','subtitle','access'));
    }
    
    public function get_brief_ajax(){
        if ($this->request->is('post') && !empty($this->request->data['client_lead_id']))
        {
            $client_lead_id = $this->request->data['client_lead_id'];
            $brief = $this->Brief->findByClientLeadId($client_lead_id,-1);
            
            $this->set('data', $brief);
            $this->set('_serialize', array('data'));
            return;
        }
    }

    public function get_answers_ajax()
    {
        if ($this->request->is('post') && !empty($this->request->data['brief_id']))
        {
            $this->loadModel('BriefQuestion');
            $brief_id = (int) $this->request->data['brief_id'];
            $params['conditions']['BriefQuestion.brief_id'] = $brief_id;
            $params['recursive'] = 1;
            $brief_questions_query = $this->BriefQuestion->BriefAnswer->find('all', $params);

            $this->loadModel('Brief');
            $params_2['conditions']['Brief.id'] = $brief_id;
            $params_2['recursive'] = -1;
            $brief = $this->Brief->find('first', $params_2);
            $tmp = array();
            $tmp['completed'] = 0; 
            if(!empty($brief) && $brief['Brief']['completed'] == true){ //jeśli brief nie został oznaczony jako zakończony
               $tmp['completed'] = 1; 
            }
            
            /*
             * Przygotowuję odpowiednia strukturę - pytania i odpowiedzi do nich w blokach 'nazwa grupy - nazwa kategorii'
             */
            foreach ($brief_questions_query as $bqq)
            {
                $tmp['answer_' . $bqq['BriefAnswer']['id']] = $bqq['BriefAnswer'];
                $tmp['answer_' . $bqq['BriefAnswer']['id']]['Profile'] = $bqq['Profile'];
            }

            if (!empty($tmp))
            {
                $this->set('data', $tmp);
                $this->set('_serialize', array('data'));
                return;
            }
            
        }

        $this->set('data', 'Błąd');
        $this->set('_serialize', array('data'));
        $this->render(false);
    }


    public function save_answer_ajax()
    {
        //$this->layout = 'ajax';
        if ($this->request->is('post'))
        {
            $session = $this->Session->read();
            $this->loadModel('BriefAnswer');

            $tmp['brief_question_id'] = $this->request->data['brief_question_id'];
            $tmp['answer'] = $this->request->data['answer'];
            if (!empty($session['Auth']['User']['id']))
            {
                $tmp['user_id'] = $session['Auth']['User']['id'];
            }
            //debug($tmp);
            if (empty($tmp['answer']))
            {
                $this->set('data', 'Nie wpisano odpowiedzi');
                $this->set('_serialize', array('data'));
                $this->render(false);
                return;
            }

            $this->BriefAnswer->create();
            $this->BriefAnswer->save($tmp);

            $this->set('data', 'Ok');
            $this->set('_serialize', array('data'));
            $this->render(false);
            return;
        }
    }

    /*
     * funkcja zamyka brief, 
     */

    public function close_brief($id = null)
    {

        if (empty($id))
        {
            $this->Session->setFlash(__d('public', 'Nie ma takiego briefa'), 'flash/error');
            $this->redirect($this->referer());
            //return false;
        }


        $session = $this->Session->read();

        $params['conditions'] = array(
            'Brief.hid' => $id
        );
        $params['recursive'] = 0;
        $brief = $this->Brief->find('first', $params);
        $brief['Brief']['completed'] = 1;

        $this->Brief->save($brief); //zamykam brief
        //die(debug($brief));
        /*
         * wyszukiwanie briefu
         */
        $this->loadModel('BriefQuestion');
        $params['conditions']['brief_id'] = $brief['Brief']['id'];
        $params['recursive'] = 1;
        $brief_questions_query = $this->BriefQuestion->find('all', $params);

        /*
         * Przygotowanie odpowiedniej struktury - pytania i odpowiedzi do nich w blokach 'nazwa grupy - nazwa kategorii'
         */
        $brief_questions = array();
        foreach ($brief_questions_query as $b)
        {
            $tmp = $b['BriefQuestion'];
            $tmp['BriefAnswer'] = $b['BriefAnswer'];
            $brief_questions[$b['BriefQuestion']['group_name'] . ' - ' . $b['BriefQuestion']['category_name']][] = $tmp;
        }

        /*
         * Przygotowanie odpowiedniej struktury listy użytkowników
         */
        $this->loadModel('Profile');
        $params1['fields'] = array('Profile.firstname', 'Profile.surname', 'Profile.user_id');
        $users_query = $this->Profile->find('all', $params1);
        $users = array();
        foreach ($users_query as $user)
        {
            $users[$user['Profile']['user_id']] = $user['Profile'];
        }

        /*
         * Generowanie PDF
         */
        $CakePdf = new CakePdf(Configure::read('CakePdf'));
        $CakePdf->viewVars(array('brief' => $brief, 'brief_questions' => $brief_questions, 'users' => $users));
        $CakePdf->template('/Briefs/pdf/brief_pdf', 'brief_pdf');
        $date = date('Y_m_d__i_s');
        $filename = 'BRIEF_' . $brief['Brief']['hid'] . '_' . $date . '.pdf';
        //write it to file directly
        if (file_exists(WWW_ROOT . 'files' . DS . 'leadfile' . DS . $filename))
        {
            unlink(WWW_ROOT . 'files' . DS . 'leadfile' . DS . $filename); //usuwam archiwum jeśli już takie istnieje
        }
        $pdf = $CakePdf->write(WWW_ROOT . 'files' . DS . 'leadfile' . DS . $filename);

        
        $this->loadModel('ClientProject');
        //$params1['fields'] = array('ClientProject.id', 'Profile.surname', 'Profile.user_id');
        $params_cp['conditions'] = array(
            'client_lead_id' => $brief['Brief']['client_lead_id']
        );
        $params_cp['recursive'] = -1;
        $clinet_project = $this->ClientProject->find('first', $params_cp);
        /*
         * zapis pliku do leada
         */
        $this->loadModel('ProjectFile');
        $data = array();
        if(!empty($clinet_project['ClientProject'])) {
            $data['ProjectFile']['client_project_id'] = $clinet_project['ClientProject']['id'];
        }
        $data['ProjectFile']['client_lead_id'] = $brief['Brief']['client_lead_id'];
        $data['ProjectFile']['file'] = $filename;
        $data['ProjectFile']['project_file_category_id'] = 3; //bierf
        $data['ProjectFile']['user_id'] = $session['Auth']['User']['id'];
        $this->ProjectFile->save($data);

        /*
         * logowanie utworzenia pliku briefa
         */
        $this->loadModel('LeadLog');
        $data = array();
        $data['LeadLog']['client_lead_id'] = $brief['Brief']['client_lead_id']; //klient_lead_id
        $data['LeadLog']['user_id'] = $session['Auth']['User']['id'];
        $data['LeadLog']['name'] = $filename;
        $this->LeadLog->saveLog(2, $data); //log_type - nowy plik

        /*
         * Dane do maila
         */
        $this->loadModel('User');
        $params2['conditions']['User.id'] = $brief['Brief']['guardian_id'];
        $params2['fields'] = array('User.email');
        $guardian_email = $this->User->find('first', $params2);

        $email_data['guardian'] = $brief['Guardian'];
        $email_data['guardian_email'] = $guardian_email['User']['email'];
        $email_data['user_email'] = $session['Auth']['User']['email'];
        $email_data['client_email'] = $brief['Client']['email'];
        $this->sendBriefEmail($email_data, WWW_ROOT . 'files' . DS . 'leadfile' . DS . $filename);
        $this->redirect($this->referer());
    }

    /*
     * Metoda wysyłająca maila do klienta i handlowca z briefem
     * 
     * @params			$guardian - dane opiekuna klienta
     * 					$user_email - email uzytkownika zamykającego briefing
     * 					$quardian_email - mail opiekuna
     * 
     * @return mixed	false - gdy nie wszystkie parametry zostana przekazane fo funkcji
     * 					void - w przypadku wysłania maila;
     */

    function sendBriefEmail($email_data = null, $pdf)
    {
        // layout maila app\View\Layouts\Emails\html\default.ctp
        if (empty($email_data) || empty($pdf))
        {
            return false;
        }

        App::uses('FebEmail', 'Lib');
        $email = new FebEmail('smtp');
        //$email->viewVars(array('value' => 'Lead #' . $client_lead_id . ' został zatwierdzony jako wygrany. Projekt został rozpoczęty bez umowy. '
        //	. '<a href="' . Router::url('/client_projects/view/', true) . $project_id . '" >Link do projektu</a>'));
        $email->viewVars(array('value' => $email_data));

        $to[] = $email_data['client_email']; //mail do klienta
        $to2[] = $email_data['user_email']; //mail do użytkownika, który zamyka brief
        $to2[] = "test_dev@febdev.pl";

        $email->template('brief_close')
                ->emailFormat('html')
                ->to($to)
                ->bcc($to2)
                ->from(array('crm@febdev.pl' => 'Fabryka e-biznesu'))
                ->subject(__d('email', ' Przygotowaliśmy dla Państwa brief'));
        $email->attachments($pdf);
        $email->send();
        $email->reset();
    }

    function brief_pdf($id = null, $download = false)
    {
        $this->layout = 'brief_pdf';
        //$this->layout = 'pdf/brief_pdf';

        if ($download)
        {
            Configure::write('CakePdf.download', true);
        } else
        {
            Configure::write('CakePdf.download', false);
        }

        $params['conditions']['or'] = array(
            'Brief.id' => $id,
            'Brief.hid' => $id
        );
        $brief = $this->Brief->find('first', $params);
        if (empty($brief))
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        $this->loadModel('BriefQuestion');
        $params['conditions']['brief_id'] = $brief['Brief']['id'];
        $params['recursive'] = 1;
        $brief_questions_query = $this->BriefQuestion->find('all', $params);

        /*
         * Przygotowuję odpowiednia strukturę - pytania i odpowiedzi do nich w blokach 'nazwa grupy - nazwa kategorii'
         */
        foreach ($brief_questions_query as $b)
        {
            $tmp = $b['BriefQuestion'];
            $tmp['BriefAnswer'] = $b['BriefAnswer'];
            $brief_questions[$b['BriefQuestion']['group_name'] . ' - ' . $b['BriefQuestion']['category_name']][] = $tmp;
        }

        /*
         *  BriefsCtrl.js - $scope.$watch('brief_id', function () { ... });
         */
        if ($this->request->is('get'))
        {
            $this->loadModel('BriefQuestion');
            $params['conditions']['brief_id'] = $brief['Brief']['id'];
            $params['recursive'] = 1;
            $brief_questions_query = $this->BriefQuestion->find('all', $params);
            $brief_questions = array();
            /*
             * Przygotowuję odpowiednia strukturę - pytania i odpowiedzi do nich w blokach 'nazwa grupy - nazwa kategorii'
             */
            foreach ($brief_questions_query as $b)
            {
                $tmp = $b['BriefQuestion'];
                $tmp['BriefAnswer'] = $b['BriefAnswer'];
                $brief_questions[$b['BriefQuestion']['group_name'] . ' - ' . $b['BriefQuestion']['category_name']][] = $tmp;
            }
            //die(debug($brief_questions));
            if (!empty($brief_questions))
            {
                $this->set('data', $brief_questions);
                $this->set('_serialize', array('data'));
            }
        }

        $this->loadModel('Profile');
        $params1['fields'] = array('Profile.firstname', 'Profile.surname', 'Profile.user_id');
        $users_query = $this->Profile->find('all', $params1);
        $users = array();
        foreach ($users_query as $user)
        {
            $users[$user['Profile']['user_id']] = $user['Profile'];
        }


        $this->set(compact('brief', 'brief_questions', 'users'));

        //$this->render('pdf/brief_pdf');
    }

    /*
     * funkcja otwiera brief, 
     */

    public function reopen_brief($id = null)
    {

        if (empty($id))
        {
            $this->Session->setFlash(__d('public', 'Nie ma takiego briefa'), 'flash/error');
            $this->redirect($this->referer());
            //return false;
        }

        $session = $this->Session->read();

        $params['conditions'] = array(
            'Brief.hid' => $id
        );
        $params['recursive'] = 0;
        $brief = $this->Brief->find('first', $params);

        if (!empty($brief))
        {
            $brief['Brief']['completed'] = 0;
            $this->Brief->save($brief); //zamykam brief
        }

        $this->Session->setFlash(__d('public', 'Brief został ponownie otwarty'), 'flash/success');
        $this->redirect('/briefs/view/' . $id);
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function add($client_lead_id = null, $brief_id = null)
    {
        $title = 'Brief';
        $subtitle = 'konfiguracja';

        $this->set(compact('title', 'subtitle'));
        if (!$this->Brief->ClientLead->exists($client_lead_id))
        {
            //throw new NotFoundException(__('Invalid client lead'));
        }
        $brief = array();
        if (!empty($brief_id) && $this->Brief->exists($brief_id))
        {
            $brief = $this->Brief->findById($brief_id);
            if ($brief["Brief"]['client_lead_id'] != $client_lead_id)
            {
                throw new NotFoundException(__('Invalid brief'));
            }
        }

        $session = $this->Session->read();
        if ($this->request->is('post'))
        {
            if (!empty($this->data['input']))
            {
                $data['Brief'] = json_decode($this->data['input'], 1);
            }
            $data['Brief']['user_id'] = $session['Auth']['User']['id'];
            $data['Brief']['hid'] = String::uuid();

            if (!empty($this->data['questions']))
            {
                $questions = json_decode($this->data['questions'], 1);
                $q = array();
                foreach ($questions as $value)
                {
                    if (
                            empty($value['content']) ||
                            !empty($value['delete'])
                    )
                    {
                        continue;
                    }
                    unset($value['id']);
                    unset($value['modified']);
                    unset($value['created']);
                    $q[] = $value;
                }
            }
            $data['BriefQuestion'] = $q;
            $this->Brief->create();
            unset($data['Brief']['id']);
            unset($data['Brief']['modified']);
            unset($data['Brief']['created']);
            if ($this->Brief->saveAssociated($data, array('validate' => false)))
            {
                $brief_last_id = $this->Brief->getLastInsertID();
                //powiadomienie email dla klienta
                if (!empty($this->data['client_info']))
                {
                    $this->client_info($brief_last_id);
                }
                $this->Session->setFlash(__d('public', 'Dokument został zapisany na liście dokumentów związanych z leadem!'), 'flash/success');
                $this->redirect(array('action' => 'view', $brief_last_id));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $this->loadModel('Section');
        $guardians = $this->Section->getMerchants();

        //Dodaje użytkownika który założył lead do listy opiekunów
        $client_lead = $this->Brief->ClientLead->findById($client_lead_id);
       
        $this->loadModel('Profile');
        $user = $this->Profile->getProfile($client_lead['ClientLead']['user_id']);
        $guardians[$client_lead['ClientLead']['user_id']] = $user['Profile']['firstname'] . ' ' . $user['Profile']['surname'];
        $default_guardian = $client_lead['ClientLead']['user_id'];

        if (empty($brief["Brief"]['guardian_id']))
        {
            $brief["Brief"]['guardian_id'] = empty($guardians[$session['Auth']['User']['id']]) ?
                    key($guardians) :
                    $session['Auth']['User']['id'];
        }
        $this->set(compact('client_lead_id', 'guardians', 'default_guardian', 'brief','client_lead','title','subtitle'));
    }

    //powiadomienie email dla klienta
    private function client_info($brief_id = null)
    {
        $brief = $this->Brief->findById($brief_id);
        App::uses('FebEmail', 'Lib');
        $email = new FebEmail('smtp');
        $email->viewVars(array('brief' => $brief));

        $to[] = $brief['Client']['email'];

        $email->template('brief_client_info')
                ->emailFormat('html')
                ->to($to)
                //->bcc("test_dev@febdev.pl")
                ->from(array('crm@febdev.pl' => 'Fabryka e-biznesu'))
                ->subject(__d('email', 'Przygotowaliśmy dla Państwa brief'));
        $email->send();
        $email->reset();
    }

    public function get_brief_default_question()
    {
        $this->loadModel('BriefDefaultQuestion');
        $data = $this->BriefDefaultQuestion->allParse();
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function add_default_question()
    {
        $this->loadModel('BriefDefaultQuestion');

        $group_name = $this->BriefDefaultQuestion->group_name;
        $category_name = $this->BriefDefaultQuestion->category_name;
        $group_category_name = $this->BriefDefaultQuestion->group_category_name;

        if ($this->request->is('post'))
        {
            //die(debug($this->request->data));
            $this->BriefDefaultQuestion->create();

            $group_category_explode = explode(',', $this->request->data['BriefDefaultQuestion']['group_category_name']);
            $this->request->data['BriefDefaultQuestion']['group_name'] = $group_name[$group_category_explode['0']];
            $this->request->data['BriefDefaultQuestion']['category_name'] = $category_name[$group_category_explode['1']];

            if ($this->BriefDefaultQuestion->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $users = $this->Brief->User->find('list');
        $clientLeads = $this->Brief->ClientLead->find('list');

        $this->set(compact('users', 'clientLeads', 'group_name', 'category_name', 'group_category_name'));
    }

    /*
     * klient powiadamia handlowca o zakończeniu wypełniania briefa
     */

    public function notify_salesman()
    {

        if ($this->request->is('post'))
        {
            $params['conditions'] = array(
                'Brief.hid' => $this->request->data['brief_id']
            );
            $brief = $this->Brief->find('first', $params);
            //powiadomienie email dla klienta
            $this->loadModel('Message');
//            $url = $_SERVER['SERVER_NAME'] . '/briefs/view/' . $brief['Brief']['hid'];
            $url = Router::url(array('controller' => 'briefs', 'action' => 'view', $brief['Brief']['hid']), true);

            $this->Message->sendMessage($brief['Brief']['user_id'], 1, 'Klient zakończył wypełnianie briefa', $url);

            $data = 'Ok';
            $this->set(compact('data'));
            $this->set('_serialize', 'data');
        }
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $title = 'Briefing';
        $subtitle = 'Edycja';
        
        $this->Brief->id = $id;
        if (!$this->Brief->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Brief->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->Brief->read(null, $id);
        }
        $users = $this->Brief->User->find('list');
        $clientLeads = $this->Brief->ClientLead->find('list');
        $this->set(compact('users', 'clientLeads','title','subtitle'));
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
        $this->Brief->id = $id;
        if (!$this->Brief->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Brief->delete())
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
        $this->Brief->recursive = 0;
        $this->set('briefs', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        $this->Brief->id = $id;
        if (!$this->Brief->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('brief', $this->Brief->read(null, $id));
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
            $this->Brief->create();
            if ($this->Brief->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $users = $this->Brief->User->find('list');
        $clientLeads = $this->Brief->ClientLead->find('list');
        $this->set(compact('users', 'clientLeads'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->Brief->id = $id;
        if (!$this->Brief->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Brief->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->Brief->read(null, $id);
        }
        $users = $this->Brief->User->find('list');
        $clientLeads = $this->Brief->ClientLead->find('list');
        $this->set(compact('users', 'clientLeads'));
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
        $this->Brief->id = $id;
        if (!$this->Brief->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Brief->delete())
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
        //    $params['conditions']['Brief.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->Brief->recursive = -1;
        $params['conditions']["Brief.name LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->Brief->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
