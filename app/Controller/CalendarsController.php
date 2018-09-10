<?php

App::uses('AppController', 'Controller');

/**
 * Calendars Controller
 */
class CalendarsController extends AppController
{

    public $components = array('CheckAccess');

    /** Akcja wyświetlająca listę kalendarzy
     * 
     * @return void
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'add', 'view', 'edit', 'save_event', 'update_event_dates', 'saveWorkTimes', 'get_calendar'));
    }

    public function index()
    {
        $title = $subtitle = 'Lista kalendarzy';

        if ($this->request->is('post'))
        {

            $calendars = $this->Calendar->getCalendars();

            $this->set(compact('calendars'));
            $this->set('_serialize', array('calendars'));
        } else
        {

            $this->set(compact('title', 'subtitle'));
        }
    }

    /**
     * Dodawanie nowego kalendarza
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post') || $this->request->is('put'))
        {
            $calendar = $this->request->data;
            $this->Calendar->create();
            if ($this->Calendar->save($calendar))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');

                $this->loadModel('WorkTime');
                $this->WorkTime->saveWorkTimes($calendar['Calendar']['year']);

                $this->redirect(array('action' => 'index'));
            } else
            {
                $showModal = true;
                $title = $subtitle = 'Lista kalendarzy';
                $this->set(compact('calendar', 'title', 'subtitle', 'showModal'));
                $this->render('index');
            }
        } else
        {
            $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * Podgląd kalendarza
     *
     * @return void
     */
    public function view($calendar_id = null, $profile_id = null)
    {
        if ($calendar_id == 'current')
        {
            $calPrarms['recursive'] = -1;
            $calPrarms['conditions']['Calendar.year'] = date('Y');
            $calendar_id = $this->Calendar->find('first',$calPrarms);
            if (empty($calendar_id))
            {
                throw new NotFoundException(__d('cms', 'Brak aktualnego kalendarza'));
            }
            $calendar_id = $calendar_id['Calendar']['id'];
        }
        $title = $subtitle = 'Podgląd kalendarza';

        if ($this->request->is('post'))
        {

            $session = $this->Session->read();
            $user_id = $session['Auth']['User']['id'];

            $user_access = $this->CheckAccess->checkIfUserIsAuthorized($session); //sprawdzam czy użytkownik należy do sekretariatu lub zarzadu

            if ($this->request->data['profile_id'])
            {
                $this->loadModel('Profile');
                $params['conditions']['Profile.id'] = $this->request->data['profile_id'];
                $params['recursive'] = 1;

                
                $profile = $this->Profile->User->find('first', $params);

                if ($profile['Profile']['user_id'] == $user_id)
                {
                    $user_access = 'user';
                }

                if ($user_access == 'user' || $user_access == 'all' || $user_access == 'manager')
                {
                    $calendar = $this->Calendar->getProfilesCalendar($this->request->data['calendar_id'], $this->request->data['profile_id']);
                    $vacations = $this->Calendar->getApprovedVacations($this->request->data['profile_id']);
                }
            } else
            {
                if ($user_access == 'all' || $user_access == 'manager')
                {
                    $calendar = $this->Calendar->getEventsWithEmptyProfiles($this->request->data['calendar_id']);
                    $vacations = $this->Calendar->getApprovedVacations();
                } else
                {
                    $calendar = $this->Calendar->getProfilesCalendar($this->request->data['calendar_id'], $profile['Profile']['id']);
                    $vacations = $this->Calendar->getApprovedVacations($profile['Profile']['id']);
                }
            }
            $this->loadModel('EventDefined');
            $eventsDefined = $this->EventDefined->find('all');


            $this->set(compact('calendar', 'eventsDefined', 'vacations'));
            $this->set('_serialize', array('calendar', 'eventsDefined', 'vacations'));
        } else
        {

            $this->Calendar->id = $calendar_id;

            if (!$this->Calendar->exists())
            {
                throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
            }

            $this->set(compact('title', 'subtitle', 'calendar_id', 'profile_id'));
        }
    }

    /**
     * Edycja kalendarza
     *
     * @return void
     */
    public function edit($calendar_id = null)
    {

        $title = $subtitle = 'Edycja kalendarza';

        if ($this->request->is('post'))
        {

            $calendar = $this->Calendar->findById($this->request->data['calendar_id']);

            $this->loadModel('EventDefined');
            $eventsDefined = $this->EventDefined->find('all');

            $vacations = $this->Calendar->getApprovedVacations();

            $this->set(compact('calendar', 'eventsDefined', 'vacations'));
            $this->set('_serialize', array('calendar', 'eventsDefined', 'vacations'));
        } else
        {
            $this->loadModel('EventType');

            $this->Calendar->id = $calendar_id;

            if (!$this->Calendar->exists())
            {
                throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
            }

            $event_types = $this->EventType->find('list', array(
                'fields' => array('EventType.name')
            ));

            $event_types = array_merge(array(0 => 'Typ wydarzenia'), $event_types);

            $this->loadModel('Profile');
            $profiles = $this->Profile->find('list', array(
                'fields' => array('Profile.id', 'Profile.name'),
                'order' => 'Profile.id'
            ));

            $profiles = array(0 => 'Dodaj osobę') + $profiles;

            $this->set(compact('title', 'subtitle', 'event_types', 'profiles'));
        }
    }

    /**
     * Zapisywanie w bazie danych wydarzenia po dodaniu go w edycji kalendatza
     */
    public function save_event()
    {

        $this->loadModel('Event');
        $this->Event->create();

        $this->Event->save($this->request->data, false);

        echo $this->Event->field('id');
        $this->autoRender = false;
    }

    /**
     * Usuwanie kalendarza
     */
    public function delete()
    {

        $this->Calendar->delete($this->request->data['id'], false);
        $this->autoRender = false;
    }

    /**
     * Usuwanie wydarzenia
     */
    public function delete_event($calendar_id = null, $event_id = null)
    {

        $this->loadModel('Event');

        if ($this->request->is('post'))
        {
            $this->Event->delete($this->request->data['event_id']);

            $this->autoRender = false;
        } else
        {
            $this->Event->delete($event_id);

            $this->redirect(array('action' => 'edit', $calendar_id));
        }
    }

    /*
     * uaktualnia osoby przypisane do wydarzenia
     */

    public function update_people_event()
    {

        $this->loadModel('Event');
        $this->Event->id = $this->request->data['event_id'];

        $this->Event->saveField('profiles', json_encode($this->request->data['profiles']));

        $this->autoRender = false;
    }

    /*
     * uaktualnia daty przypisane do wydarzenia
     */

    public function update_event_dates()
    {

        $this->loadModel('Event');
        $this->Event->id = $this->request->data['data']['event_id'];

        $this->Event->saveField('date_start', substr($this->request->data['data']['date_start'], 0, 10));
        $this->Event->saveField('date_end', substr($this->request->data['data']['date_end'], 0, 10));

        $this->autoRender = false;
    }

    /*
     * utworzy w bazie drugi taki sam event tylko z innymi datami
     */

    public function duplicate_event()
    {

        $this->loadModel('Event');

        $event = $this->Event->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Event.id' => $this->request->data['data']['event_id'],
            )
                )
        );

        $this->Event->create();
        $this->Event->set('event_type_id', $event['Event']['event_type_id']);
        $this->Event->set('profiles', $event['Event']['profiles']);
        $this->Event->set('title', $event['Event']['title']);
        $this->Event->set('calendar_id', $event['Event']['calendar_id']);
        $this->Event->set('date_start', substr($this->request->data['data']['date_start'], 0, 10));
        $this->Event->set('date_end', substr($this->request->data['data']['date_end'], 0, 10));
        $this->Event->save(null, false);

        echo $this->Event->field('id');

        $this->autoRender = false;
    }

    /*
     * pobiera kalendarz z wydarzeniami
     */

    public function get_calendar()
    {
        $calendar = $this->Calendar->findById($this->request->data['calendar_id']);

        $this->set(compact('calendar'));
        $this->set('_serialize', array('calendar'));
    }

    /*
     * Na podstawie kalendarza danego roku zapisuje w tabeli work_times dni i godziny pracujące
     */
    public function saveWorkTimes()
    {

        $this->loadModel('WorkTime');
        $this->WorkTime->saveWorkTimes($this->request->data['year']);

        $this->autoRender = false;
    }
}