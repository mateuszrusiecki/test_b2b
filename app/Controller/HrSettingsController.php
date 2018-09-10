<?php

App::uses('AppController', 'Controller');

/**
 * HrSettings Controller
 *
 * @property HrSetting $HrSetting
 */
class HrSettingsController extends AppController
{
    /**
     * Nazwa layoutu
     */
    //public $layout = 'admin';

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array();

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array(); //Slug.Slug

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index()
    {
        $this->helpers[] = 'FebTime';

        $title = $subtitle = 'Ustwienia Hr';
        $this->set(compact('title', 'subtitle'));

        $this->HrSetting->recursive = 0;
        $hrSettings = $this->HrSetting->find('all');
        $this->set('hrSettings', $hrSettings);


        $this->loadModel('WorkTime');
        $this->WorkTime->recursive = 0;
        $workTimes = $this->WorkTime->find('all');
        $this->set('workTimes', $workTimes);
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
        $this->HrSetting->id = $id;
        if (!$this->HrSetting->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('hrSetting', $this->HrSetting->read(null, $id));
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
            $this->HrSetting->create();
            if ($this->HrSetting->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
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
        $this->HrSetting->id = $id;
        if (!$this->HrSetting->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->HrSetting->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->HrSetting->read(null, $id);
        }
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
        $this->HrSetting->id = $id;
        if (!$this->HrSetting->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->HrSetting->delete())
        {
            $this->Session->setFlash(__d('public', 'Poprawnie usunięto.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('public', 'Nie można usunąć.'), 'flash/error');
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
        $params['fields'] = array('hostname');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['HrSetting.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->HrSetting->recursive = -1;
        $params['conditions']["HrSetting.hostname LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->HrSetting->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
