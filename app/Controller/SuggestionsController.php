<?php

App::uses('AppController', 'Controller');

/**
 * Suggestions Controller
 *
 * @property Suggestion $Suggestion
 */
class SuggestionsController extends AppController
{

    /**
     * Nazwa layoutu
     */
    public $layout = 'default';

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
        $title = $subtitle = 'Sugestie';
        $this->helpers[] = 'FebTime';
        $this->Suggestion->recursive = 0;
        $belongsTo = array(
            'Profile' => array(
                'className' => 'Profile',
                'foreignKey' => '',
                'conditions' => array('Profile.user_id = Suggestion.user_id'),
                'fields' => array('firstname','surname'),
                'order' => ''
            )
        );
        $this->Suggestion->bindModel(array('belongsTo' => $belongsTo));
        $this->set('suggestions', $this->paginate());
        $this->set(compact('title','subtitle'));
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
        $this->Suggestion->id = $id;
        if (!$this->Suggestion->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('suggestion', $this->Suggestion->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function add()
    {
        $session = $this->Session->read();
        if ($this->request->is('post'))
        {
            $this->request->data['Suggestion']['user_id'] = $session['Auth']['User']['id'];
            $this->Suggestion->create();
            if ($save = $this->Suggestion->save($this->request->data))
            {
                $return = $save['Suggestion'];
                //$return['message'] = __d('public', 'Poprawnie zapisano.');
                $this->Session->setFlash(__d('public', 'Uwagę została zgłoszona do administratora'), 'flash/success');
                //$this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
                //$return['message'] = __d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.');
            }
        }
        $this->redirect($this->referer());
//        /$users = $this->Suggestion->User->find('list');
        //$this->set(compact('return'));
        //$this->set('_serialize', array('return'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->Suggestion->id = $id;
        if (!$this->Suggestion->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Suggestion->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.', 'flash/success'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->Suggestion->read(null, $id);
        }
        $users = $this->Suggestion->User->find('list');
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
        $this->Suggestion->id = $id;
        if (!$this->Suggestion->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Suggestion->delete())
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
        $this->Suggestion->recursive = 0;
        $this->set('suggestions', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        $this->Suggestion->id = $id;
        if (!$this->Suggestion->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('suggestion', $this->Suggestion->read(null, $id));
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
            $this->Suggestion->create();
            if ($this->Suggestion->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $users = $this->Suggestion->User->find('list');
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
        $this->Suggestion->id = $id;
        if (!$this->Suggestion->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Suggestion->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->Suggestion->read(null, $id);
        }
        $users = $this->Suggestion->User->find('list');
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
        $this->Suggestion->id = $id;
        if (!$this->Suggestion->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Suggestion->delete())
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
        //    $params['conditions']['Suggestion.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->Suggestion->recursive = -1;
        $params['conditions']["Suggestion.name LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->Suggestion->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
