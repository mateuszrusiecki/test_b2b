<?php

App::uses('AppController', 'Controller');

/**
 * ChecklistPositions Controller
 *
 * @property ChecklistPosition $ChecklistPosition
 */
class ChecklistPositionsController extends AppController
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
        $title = $subtitle = __d('public', 'Karty obiegowe');

        $params['recursive'] = -1;
        //$params['fields'] = array('Group.name', 'Group.id');
        $groups = $this->ChecklistPosition->Group->find('all', $params);
        $this->set(compact('groups', 'subtitle', 'title'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function print_group($id = null)
    {
        $this->helpers[] = 'FebTime';
        $this->layout = 'invoice';
        $this->ChecklistPosition->Group->id = $id;
        if (!$this->ChecklistPosition->Group->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $checklistPositions = $this->ChecklistPosition->positionsFromGroup($id);
        $this->set('checklistPositions', $checklistPositions);
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index_positions()
    {
        $this->helpers[] = 'FebTime';
        $this->ChecklistPosition->recursive = 0;
        $this->set('checklistPositions', $this->paginate());
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
        $this->ChecklistPosition->id = $id;
        if (!$this->ChecklistPosition->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('checklistPosition', $this->ChecklistPosition->read(null, $id));
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view_group($id = null)
    {
//        $id = $this->Slug->basic();
        $title = $subtitle = __d('public', 'Karta obiegowa');
        $this->ChecklistPosition->Group->id = $id;
        if (!$this->ChecklistPosition->Group->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        $this->ChecklistPosition->bindGroup();
        $this->ChecklistPosition->Group->recursive = 1;
        if ($this->request->is('post') || $this->request->is('put'))
        {
            $this->request->data['Group']['id'] = $id;
            if ($this->ChecklistPosition->Group->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                //$this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->ChecklistPosition->Group->read(null, $id);
        }
        unset($this->request->data['PermissionGroup']);
        unset($this->request->data['Permission']);

        $checklistPositions = $this->ChecklistPosition->find('list');
        $this->set(compact('checklistPositions', 'title', 'subtitle', 'id'));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function add($group = null)
    {
        $title = $subtitle = __d('public', 'Dodawanie nowej pozycji');
        if ($this->request->is('post'))
        {
            $this->ChecklistPosition->create();
            if ($this->ChecklistPosition->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                if (!empty($group))
                {
                    $this->redirect(array('action'=>'view_group',$group));
                }
                $this->redirect($this->referer());
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $this->set(compact('title', 'subtitle'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->ChecklistPosition->id = $id;
        if (!$this->ChecklistPosition->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->ChecklistPosition->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->ChecklistPosition->read(null, $id);
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
        $this->ChecklistPosition->id = $id;
        if (!$this->ChecklistPosition->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->ChecklistPosition->delete())
        {
            $this->Session->setFlash(__d('public', 'Poprawnie usunięto.'), 'flash/success');
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
        $this->ChecklistPosition->recursive = 0;
        $this->set('checklistPositions', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        $this->ChecklistPosition->id = $id;
        if (!$this->ChecklistPosition->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('checklistPosition', $this->ChecklistPosition->read(null, $id));
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
            $this->ChecklistPosition->create();
            if ($this->ChecklistPosition->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'), 'flash/success');
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
        $this->ChecklistPosition->id = $id;
        if (!$this->ChecklistPosition->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->ChecklistPosition->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->ChecklistPosition->read(null, $id);
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
        $this->ChecklistPosition->id = $id;
        if (!$this->ChecklistPosition->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->ChecklistPosition->delete())
        {
            $this->Session->setFlash(__d('cms', 'Poprawnie usunięto.'), 'flash/success');
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
        //    $params['conditions']['ChecklistPosition.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->ChecklistPosition->recursive = -1;
        $params['conditions']["ChecklistPosition.name LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->ChecklistPosition->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
