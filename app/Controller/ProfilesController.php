<?php

App::uses('AppController', 'Controller');

/**
 * Profiles Controller
 *
 * @property Profile $Profile
 */
class ProfilesController extends AppController
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
    public $components = array('RequestHandler', 'FebEmail');

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('loggedUserData'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index()
    {
        $title = "Pracownicy";
        $subtitle = "Pracownicy";

        if ($this->request->is('post'))
        {

            //print_r('aa'); die();
            $profiles = $this->Profile->getProfiles();

            //$this->loadModel('Event');
            //  for ($i = 0; $i < sizeof($profiles); $i++)
            //  {
            //$profiles[$i]['Profile']['tmpProfile'] = $this->Profile->checkTmpProfile($profiles[$i]['User']['id']);
            //1 -badanie
            //3 - szkolenie
            //$profiles[$i]['Event'] = $this->Event->getEventForProfile($profiles[$i]['Profile']['id'], array(1, 3));
            // }
            //print_r($profiles); die();
            $this->set(compact('profiles'));
            $this->set('_serialize', array('profiles'));
        } else
        {

            $this->set(compact('title', 'subtitle'));
        }
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {

//        $id = $this->Slug->basic();
        $this->Profile->id = $id;
        if (!$this->Profile->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('profile', $this->Profile->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->Profile->create();
            if ($this->Profile->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $users = $this->Profile->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->Profile->id = $id;
        if (!$this->Profile->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Profile->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->Profile->read(null, $id);
        }
        $users = $this->Profile->User->find('list');
        $this->set(compact('users'));
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
        $this->Profile->id = $id;
        if (!$this->Profile->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Profile->delete())
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
        $this->Profile->recursive = 0;
        $this->set('profiles', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        $this->Profile->id = $id;
        if (!$this->Profile->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('profile', $this->Profile->read(null, $id));
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
            $this->Profile->create();
            if ($this->Profile->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $users = $this->Profile->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->Profile->id = $id;
        if (!$this->Profile->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Profile->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->Profile->read(null, $id);
        }
        $users = $this->Profile->User->find('list');
        $this->set(compact('users'));
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
        $this->Profile->id = $id;
        if (!$this->Profile->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Profile->delete())
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
        $params['fields'] = array('firstname');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['Profile.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->Profile->recursive = -1;
        $params['conditions']["Profile.firstname LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->Profile->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

    /**
     * Mój profil / Metryka
     */
    public function metrics()
    {
        $title = "Metryka";
        $subtitle = "Metryka";

        $session = $this->Session->read();
        $user_id = isset($this->params['named']['user']) ? $this->params['named']['user'] : $session['Auth']['User']['id'];

        $profile = $this->Profile->getProfile($user_id);
        $tmp_profile = $this->Profile->checkTmpProfile($user_id);

        $this->loadModel('Country');
        $countries = $this->Country->find('list', array(
            'fields' => array('id', 'printable_name')
        ));

        $this->request->data['Profile']['_reg_country_id'] = 'PL';
        $this->request->data['Profile']['_country_id'] = 'PL';
        $this->loadModel('UserContractHistory');
        $uch = $this->UserContractHistory->getCurrentContract($user_id);

        $this->set(compact('profile', 'title', 'subtitle', 'tmp_profile', 'countries', 'uch'));
    }

    /**
     * Mój profil / Cel osobisty
     */
    public function personal_aim()
    {
        $this->loadModel('PersonalAim');

        $title = "Cel osobisty";
        $subtitle = "Cel osobisty";

        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        $profile = $this->Profile->getProfile($user_id);
        $aim = $this->PersonalAim->getPersonalAim($user_id);

        $this->set(compact('profile', 'title', 'subtitle', 'aim'));
    }

    /**
     * Mój profil / Zatrudnienie
     */
    public function employment()
    {
        $title = "Zatrudnienie";
        $subtitle = "Zatrudnienie";

        $session = $this->Session->read();
        $profile = $this->Profile->getProfile($session['Auth']['User']['id']);

        $this->set(compact('profile', 'title', 'subtitle'));
    }

    /**
     * Wysłanie powiadomienia do sekretariatu z zaaktualizowanymi danymi profilu
     */
    public function profile_update()
    {
        if ($this->request->is('post'))
        {
            $user_id = $this->Session->read('Auth.User.id');
            if ($saved = $this->Profile->setProfile($user_id, $this->request->data))
            {
                $this->loadModel('Section');
                $this->Section->id = 2;
                $supervisorSecretariat = $this->Section->field('supervisor');
                $this->loadModel('Message');
                $profile_id = $this->Profile->field('id', array('user_id' => $user_id));
                $url = Router::url(array('controller' => 'profiles', 'action' => 'update_profile', $profile_id), true);
                $this->Message->sendMessage($supervisorSecretariat, 1, 'Powiadomienie o zmianie danych', $url);

                $this->Session->setFlash('Powiadomienie o zmianie danych zostało pomyślnie wysłane.', 'flash/success', array(), 'updatedProfile');
            } else
            {
                $this->Session->setFlash('Błąd podczas wysyłania powiadmowienia o zmianie danych. Spróbój ponownie później.', 'flash/error', array(), 'notUpdatedProfile');
            }
        }


        $this->redirect($this->referer());
    }

    /**
     * Aktualizowanie celu osobistego
     */
    public function personal_aim_update()
    {
        $this->loadModel('PersonalAim');

        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        if ($this->PersonalAim->setPersonalAim($user_id, $this->request->data))
        {
            $this->Session->setFlash('Cel osobisty został zaaktualizowany.', 'flash/success', array(), 'aim');
        } else
        {
            $this->Session->setFlash('Wystąpił błąd. Sprawdź czy wszystkie dane się zgadzają i spróbój ponownie.', 'flash/error', array(), 'aim');
        }

        $this->redirect($this->referer());
    }

    /**
     * Pokazywanie wynagrodzenia
     */
    public function show_salary($profile_id = null)
    {
        $this->loadModel('UserContractHistory');
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];
        $groups = $session['Auth']['Groups'];
        $data = $this->data;
        $salary = $this->UserContractHistory->read_salary($data, $groups, $user_id);
        $this->set(compact('salary'));
        $this->set('_serialize', array('salary'));
        $this->render(false);
    }

    /**
     * Lista umów danego użytkownika
     */
    public function contracts($profile_id = null)
    {

        if ($this->request->is('post'))
        {

            $this->loadModel('UserContractHistory');

            $profile = $this->Profile->findById($this->request->data['profile_id']);
            $contracts = $this->UserContractHistory->getUserContractHistory($profile['Profile']['user_id']);

            $this->set(compact('contracts'));
            $this->set('_serialize', array('contracts'));
        } else
        {

            $profile = $this->Profile->findById($profile_id);

            if (!$profile)
            {
                throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
            }

            $title = $profile['Profile']['firstname'] . " " . $profile['Profile']['surname'] . " - lista umów";
            $subtitle = $profile['Profile']['firstname'] . " " . $profile['Profile']['surname'] . " - lista umów";

            $this->set(compact('title', 'subtitle'));
        }
    }

    /**
     * Tabela płac
     */
    public function salaries()
    {

        $title = "Tabela płac";
        $subtitle = "Tabela płac";
        $this->set(compact('title', 'subtitle'));

        $user_id = $this->Session->read('Auth.User.id');

        //szukam zarządu
        $this->loadModel('UserSection');
        $sp['conditions']['UserSection.section_id'] = 1;
        $sp['fields'] = array('id', 'user_id');
        $managment = $this->UserSection->find('list', $sp);
        
        $user = $this->Session->read('Auth');
        if(!empty($user['Groups']['m_secretariat'])){ //dostęp do tabeli płac ma też kieronik sekretariatu
            $managment[] = $user['User']['id'];
        }
        
        //@todo [TODO] brakuje funkcjonalności wyznaczania przez zarząd osoby do przegladania tabeli płac !! [TODO]
        $this->loadModel('UserContractHistory');
        $managment[0] = $this->UserContractHistory->userAllowViewSalary;

        $isAllow = false;

        if (!in_array($user_id, $managment))
        {
            $this->Session->setFlash(__d('public', 'Nie posiadasz uprawnień do przeglądania tej strony'), 'flash/error');
        } else
        {

            $this->Profile->User->id = $user_id;
            $pass = $this->Profile->User->field('pass');

            if (!empty($this->data))
            {
                if ($this->Auth->password($this->data['password']) == $pass)
                {
                    $isAllow = true;
                } else
                {
                    $this->Session->setFlash(__d('public', 'Nieprawidłowe hasło'), 'flash/error');
                }
            }
        }
        $this->set(compact('isAllow'));
    }

    /**
     * Edycja profilu użytkownika w sekretariacie
     *
     * @param int $profile_id                 id profilu
     * @return void
     */
    public function edit_hr($profile_id = null)
    {
        $this->Profile->id = $profile_id;

        if (!$this->Profile->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        if ($this->request->is('post') || $this->request->is('put'))
        {
            //zapis stawki
//			$column = 'hourly_rate';
//			$rate = $profile['Profile']['hourly_rate'];
//			$salt = Configure::read('SalarySalt');
//			$profile['Profile']['hourly_rate'] = "DECODE('$rate','$salt')";
//die(debug($this->request->data['Section']['supervisor_chceck']));

            $this->request->data['User']['id'] = $this->request->data['Profile']['user_id'];

            if ($this->Profile->User->save($this->request->data, false))
            {
                if ($this->request->data['Section']['supervisor_chceck']) //jeśli zaznaczony jako kierwnik to zapisuje do bazy
                {
                    $this->Profile->User->Section->id = $this->request->data['Section']['Section']['0'];
                    $this->Profile->User->Section->saveField('supervisor', $this->request->data['Profile']['user_id']);
                } else
                { //jeśli nie zaznaczony to sprawdzam czy jest aktualnie kierownikiem - jeśli tak to odznaczam 
                    $user = $this->Profile->User->findById($this->request->data['User']['id']);
                    if (!empty($user['Section'][0]['supervisor']) && $user['User']['id'] == $user['Section'][0]['supervisor'])
                    {
                        $this->Profile->User->Section->id = $this->request->data['Section']['Section']['0'];
                        $this->Profile->User->Section->saveField('supervisor', null);
                    }
                }
                $this->Profile->User->saveAll($this->request->data, array('validate' => false));
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $params['conditions']['Profile.id'] = $profile_id;
        $params['recursive'] = 1;
        $profile = $this->request->data = $this->Profile->User->find('first', $params);
        $this->request->data['Sections']['supervisor_chceck'] = ($profile['Section']['0']['supervisor'] == $profile['User']['id']);

        $title = $profile['Profile']['firstname'] . " " . $profile['Profile']['surname'] . " - edycja profilu";
        $subtitle = $profile['Profile']['firstname'] . " " . $profile['Profile']['surname'] . " - edycja profilu";

        $formUrlParams = array($profile_id);

        //read country
        $this->loadModel('Country');
        $countries = $this->Country->find('list', array(
            'fields' => array('id', 'printable_name')
        ));

        //read section
        $sections = $this->Profile->User->Section->find('list');
        $perm_groups = $this->Profile->User->Group->find("list", array(
            'recursive' => -1,
        ));
        $group_id = empty($profile['Group']['0']['id']) ? null : $profile['Group']['0']['id'];
        $section_id = empty($profile['Section']['0']['id']) ? null : $profile['Section']['0']['id'];
        $this->set(compact('title', 'subtitle', 'countries', 'profile', 'formUrlParams', 'sections', 'perm_groups', 'section_id', 'group_id'));
    }

    /**
     * Zatwierdzanie zmian profilu w sekretariacie
     *
     * @param int $profile_id                 id profilu
     * @return void 
     */
    public function update_profile($profile_id = null)
    {
        $this->Profile->id = $profile_id;

        if (!$this->Profile->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        $profile = $this->Profile->findById($profile_id);

        $title = $profile['Profile']['firstname'] . " " . $profile['Profile']['surname'] . " - zatwierdzanie zmian";
        $subtitle = $profile['Profile']['firstname'] . " " . $profile['Profile']['surname'] . " - zatwierdzanie zmian";

        $this->loadModel('Country');

        $countries = $this->Country->find('list', array(
            'fields' => array('id', 'printable_name')
        ));

        $this->loadModel('UserContractHistory');
        $uch = $this->UserContractHistory->getCurrentContract($profile['Profile']['user_id']);

        $this->set(compact('title', 'subtitle', 'profile', 'countries', 'uch'));
    }

    /**
     * Lista wszystkich wiadomości
     *
     * @return void 
     */
    public function messages()
    {
        $title = "Powiadomienia";
        $subtitle = "Powiadomienia";

        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        if ($this->request->is('post'))
        {

            $this->loadModel('Message');
            $messages = $this->Message->getMessages($user_id);
            $this->set(compact('messages'));
            $this->set('_serialize', array('messages'));
        } else
        {

            $this->set(compact('title', 'subtitle'));
        }
    }

    /**
     * Pobieranie wiadomości do listy powiadomień na górze strony
     *
     * @return void 
     */
    public function messages_info()
    {
        $this->loadModel('Message');

        $user_id = $this->Auth->user('id') ? $this->Auth->user('id') : null;
        $messages = $this->Message->getMessagesInfo($user_id);

        $this->set(compact('messages'));
        $this->set('_serialize', array('messages'));
    }

    /**
     * Zatwierdzanie pola wprowadzonego przez usera
     * 
     * $return void
     */
    public function accept_temp_field()
    {
        $fieldName = $this->request->data['fieldName'];

        $tmpFieldName = '_' . $fieldName;

        $this->Profile->read(null, $this->request->data['profile_id']);
        $this->Profile->set($fieldName, $this->Profile->field($tmpFieldName));
        $this->Profile->set($tmpFieldName, '');

        $this->Profile->save(null, false);

        $this->loadModel('Message');
        $url = '/profiles/metrics';
        $this->Message->sendMessage($this->Profile->field('user_id'), '1', 'Sekretariat zatwierdził zmianę', $url);

        $this->autoRender = false;
    }

    /**
     * Odrzucanie pola wprowadzonego przez usera
     * 
     * $return void
     */
    public function reject_temp_field()
    {
        $fieldName = $this->request->data['fieldName'];
        $tmpFieldName = '_' . $fieldName;

        $this->Profile->read(null, $this->request->data['profile_id']);
        $this->Profile->set($tmpFieldName, '');

        $this->Profile->save(null, false);
        $this->loadModel('Message');
        $url = '/profiles/metrics';
        $this->Message->sendMessage($this->Profile->field('user_id'), '3', 'Sekretariat odrzucił zmianę', $url);

        $this->autoRender = false;
    }

    /**
     * Oznacza wiadomości jako przeczytane
     */
    public function set_messages_readed()
    {
        $this->loadModel('Message');

        foreach ($this->request->data as $message)
        {
            $this->Message->read(null, $message['Message']['id']);
            $this->Message->set('readed', 1);
            $this->Message->save(null, false);
        }

        $this->autoRender = false;
    }

    public function activate_user($id)
    {

        $this->loadModel('User');
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $id
            ),
            'recursive' => -1,
        ));

        if ($user)
        {
            $this->User->id = $user['User']['id'];
            $this->User->saveField('active', true);
        }
        $this->redirect($this->referer());
    }

    public function deactivate_user($id)
    {
        $this->loadModel('User');
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $id
            ),
            'recursive' => -1,
        ));

        if ($user)
        {
            $this->User->id = $user['User']['id'];
            $this->User->saveField('active', false);
        }
        $this->redirect($this->referer());
    }

    /**
     * Jsonowe pobieranie danych zalogowanego użytkownika
     * 
     * @return json         dane zalogowanego użytkownika
     */
    public function loggedUserData()
    {
        $out = $this->Auth->user();
        $this->response->body(json_encode($out));

        $this->autoRender = false;
    }

    public function emailTest()
    {

        foreach (array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10) as $i)
        {

            //$to[] = "<mkustra0@gmail.com>";
            $subject = 'test';
            $to = 'd.czyz@febdev.pl';
            $to = 'm.kustra@febdev.pl';
            $template = 'gc_confirm';
            $from = null;
            $sender = null;
            $emailFormat = 'html';
            $debug = false;
            $data['commentsCount'] = $i;
            $data['projectName'] = 'teststttttt' . $i;
            $return = $this->FebEmail->sendFastEmail($subject, $to, $template, $data, $from, $sender, $emailFormat, $debug);
            debug($return);
        }
    }

}
