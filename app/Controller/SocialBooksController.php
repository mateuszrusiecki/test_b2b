<?php

App::uses('AppController', 'Controller');

/**
 * SocialBooks Controller
 *
 * @property SocialBook $SocialBook
 */
class SocialBooksController extends AppController
{

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
        $title = 'FebBook';
        $subtitle = 'FebBook';
        $this->set(compact('title', 'subtitle'));
        $this->helpers[] = 'FebTime';
        if ($this->layoutPath == 'json')
        {
            $users = $this->SocialBook->getListUser();
            $this->set(compact('users'));
            $this->set('_serialize', 'users');
        }
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($user_email = null)
    {
        $title = 'FebBook';
        $subtitle = 'FebBook';
        $this->set(compact('title', 'subtitle'));

        $session = $this->Session->read();


        $user_id = empty($user_email) ?
                $session['Auth']['User']['id'] :
                $this->SocialBook->getIdByUserEmail($user_email);

        if (!$this->SocialBook->User->exists($user_id))
        {
            throw new NotFoundException(__d('cms', 'Użytkownik nie istnieje'));
        }
        //json
        if ($this->layoutPath == 'json')
        {
            $fields[] = 'SocialBook.*';
            $socialBook = $this->SocialBook->getByUserId($user_id, $fields);
            $users = $this->SocialBook->getListUser();
            $this->set(compact('socialBook'));
            $this->set('_serialize', 'socialBook');
            $this->render();
        }
        //wyszykiwanie przy pierwszym załadowaniu
        $fields[] = 'Profile.firstname';
        $fields[] = 'Profile.surname';
        $fields[] = 'Profile.work_phone';
        $fields[] = 'Profile.private_phone';
        $fields[] = 'User.email';
        $fields[] = 'User.avatar';
        $fields[] = 'User.avatar_url';
        $socialBook = $this->SocialBook->getByUserId($user_id, $fields);
        
        $this->loadModel('UserContractHistory');
        $contract = $this->UserContractHistory->getCurrentContract($user_id);
        //cel osobisty
        $this->loadModel('PersonalAim');
        $aim = $this->PersonalAim->getPersonalAim($user_id);
        $isEdit = $user_id == $session['Auth']['User']['id'];
        $this->set(compact('socialBook', 'user_email', 'aim', 'isEdit','contract'));
    }

    public function save_social_book()
    {
        if (empty($this->data['id']))
        {
            return false;
        }
        if (!$this->SocialBook->exists($this->data['id']))
        {
            return false;
        }
        $this->SocialBook->save($this->data, false);
        $this->SocialBook->recursive = -1;
        $save = $this->SocialBook->findById($this->data['id']);
        $this->set(compact('save'));
        $this->set('_serialize', 'save');
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
            $this->SocialBook->create();
            if ($this->SocialBook->save($this->request->data))
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
        $this->SocialBook->id = $id;
        if (!$this->SocialBook->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->SocialBook->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->SocialBook->read(null, $id);
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
        $this->SocialBook->id = $id;
        if (!$this->SocialBook->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->SocialBook->delete())
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
        $this->SocialBook->recursive = 0;
        $this->set('socialBooks', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        $this->SocialBook->id = $id;
        if (!$this->SocialBook->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('socialBook', $this->SocialBook->read(null, $id));
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
            $this->SocialBook->create();
            if ($this->SocialBook->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->SocialBook->id = $id;
        if (!$this->SocialBook->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->SocialBook->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->SocialBook->read(null, $id);
        }
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
        $this->SocialBook->id = $id;
        if (!$this->SocialBook->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->SocialBook->delete())
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
        $params['fields'] = array('user_id');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['SocialBook.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->SocialBook->recursive = -1;
        $params['conditions']["SocialBook.user_id LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->SocialBook->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
