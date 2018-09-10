<?php

App::uses('AppController', 'Controller');

/**
 * Modules Controller
 *
 * @property Module $Module
 */
class ModulesController extends AppController
{

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array('Metronic');

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
        $this->Module->recursive = 0;
        $this->set('modules', $this->paginate());
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
        $this->Module->id = $id;
        if (!$this->Module->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('module', $this->Module->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function add($project_id = null)
    {
        $title = $subtitle = 'Dodaj moduł';

        if (empty($project_id))
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        if (!$this->Module->ClientProject->exists($project_id))
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }

        if ($this->request->is('post'))
        {
            $this->request->data['Module']['project_id'] = $project_id;
            $this->Module->create();
            if (empty($this->request->data['Module']['module_category_id']) && !empty($this->request->data['Module']['module_category']))
            {
                $this->Module->ModuleCategory->create();
                $moduleCategory['ModuleCategory']['name'] = $this->request->data['Module']['module_category'];
                $this->Module->ModuleCategory->save($moduleCategory);
            }
            if ($this->Module->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $moduleCategories = $this->Module->ModuleCategory->find('list');
        $this->loadModel('Section');
        $sections = $this->Section->find('list', array('fields' => array('supervisor', 'supervisor')));
        $this->loadModel('Profile');
        $profileParam['conditions']['Profile.user_id'] = $sections;
        $profileParam['fields'] = array('user_id', 'name');
        $managerUsers = $this->Profile->find('list', $profileParam);

        $contactUsers = $this->Profile->find('list', array('fields' => array('user_id', 'name')));

        $repTypes = $this->Module->repTypes;
        $this->set(compact('moduleCategories', 'title', 'subtitle', 'managerUsers', 'contactUsers', 'repTypes'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->Module->id = $id;
        if (!$this->Module->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Module->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->Module->read(null, $id);
        }
        $clientProjects = $this->Module->ClientProject->find('list');
        $moduleCategories = $this->Module->ModuleCategory->find('list');
        $this->set(compact('clientProjects', 'moduleCategories'));
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
        $this->Module->id = $id;
        if (!$this->Module->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Module->delete())
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
        $this->Module->recursive = 0;
        $this->set('modules', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        $this->Module->id = $id;
        if (!$this->Module->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('module', $this->Module->read(null, $id));
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
            $this->Module->create();
            if ($this->Module->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $clientProjects = $this->Module->ClientProject->find('list');
        $moduleCategories = $this->Module->ModuleCategory->find('list');
        $this->set(compact('clientProjects', 'moduleCategories'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->Module->id = $id;
        if (!$this->Module->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Module->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->Module->read(null, $id);
        }
        $clientProjects = $this->Module->ClientProject->find('list');
        $moduleCategories = $this->Module->ModuleCategory->find('list');
        $this->set(compact('clientProjects', 'moduleCategories'));
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
        $this->Module->id = $id;
        if (!$this->Module->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Module->delete())
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
        //    $params['conditions']['Module.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->Module->recursive = -1;
        $params['conditions']["Module.name LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->Module->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

    

}
