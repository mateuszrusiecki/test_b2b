<?php

App::uses('AppController', 'Controller');

/**
 * Menus Controller
 *
 * @property Menu $Menu
 */
class MenusController extends AppController
{

    public $uses = array('Menu.Menu');
    public $helpers = array('Js', 'Paginator');
    public $layout = 'admin';

    function export()
    {
        $params['recursive'] = -1;
        $data = $this->Menu->find('all', $params);
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    function import()
    {
        $tmp_file = $this->data['Menu']['data']['tmp_name'];
        $json_file = file_get_contents($tmp_file);
        $data = json_decode($json_file, 1);
        if (empty($data))
        {
            $this->Session->setFlash('Brak danych', 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        $params['recursive'] = -1;
        $params['fields'] = array('id', 'id');
        $list = $this->Menu->find('list', $params);
        foreach ($data as $save)
        {
            if (!empty($list[$save['Menu']['id']]))
            {
                unset($list[$save['Menu']['id']]);
            }
            $this->Menu->save($save);
        }
        foreach ($list as $id)
        {
            $this->Menu->query("DELETE FROM `menus` WHERE `menus`.`id` = {$id}");
        }
        $gparams['recursive'] = -1;
        $gparams['fields'] = array('group_id', 'group_id');
        $groups = $this->Menu->find('list', $gparams);
        foreach ($groups as $group_id)
        {
            $this->reset_menu($group_id);
        }
        $this->Session->setFlash('Poprawnie zaimportowano', 'flash/success');
        $this->redirect(array('action' => 'index'));
    }

    function menu()
    {
//        $this->Menu->setScope("Menu.selection_id = {$this->selection_id}");
        $data = $this->Menu->findTree();
        $data = $this->links($data);
        $this->set(compact('data'));
        $this->render('Menu./Elements/menu');
    }

    function index()
    {
        $title = $subtitle = 'Menu';
//        $this->Menu->setScope("Menu.selection_id = {$this->selection_id}");
        $this->layout = 'default';
        $data = $this->Menu->findTree();
        //$data = $this->links($data);
        $this->set(compact('data', 'subtitle', 'title'));
    }

    function get_menu($group_id)
    {
        $session = $this->Session->read();
        $data = $this->Menu->get_menu($group_id, $session);
//        $data = $this->links($data);
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    function get_groups()
    {
        $this->loadModel('User.Group');
        $params['recursive'] = -1;
        $params['fields'] = array('Group.name', 'Group.id');
        $data = $this->Group->find('all', $params);
        $data = Set::combine($data, '{n}.Group.id', '{n}.Group');
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    function add_menu($group_id)
    {
        $this->Menu->setScope("Menu.group_id = '$group_id'");
        $menu['group_id'] = $group_id;
        if (!empty($this->data['Menu']))
        {

            $menu = $this->data['Menu'];
            $menu['parent_id'] = $menu['id'];
        }
        unset($menu['id']);
        $data = $this->Menu->save($menu);
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    function edit_menu($group_id)
    {
        $this->Menu->setScope("Menu.group_id = '$group_id'");
        $menu = $this->data;
        $data = $this->Menu->save($menu);
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    function move_menu($group_id)
    {
        $this->Menu->setScope("Menu.group_id = '$group_id'");
        $menu = $this->data;
        $data = $this->Menu->saveOrder($menu);
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    function delete_menu($group_id)
    {
        //$this->Menu->setScope("Menu.group_id = '$group_id'");
        //$this->Menu->Behaviors->unload('Tree');
        $data = $this->Menu->query("DELETE FROM `menus` WHERE `menus`.`id` = {$this->data['Menu']['id']}");
        $this->reset_menu($group_id);
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    function reset_menu($group_id = null)
    {
        $this->Menu->setScope("Menu.group_id = '$group_id'");
        //$menu = $this->Menu->findTree();
        $menu = $this->Menu->reset($group_id);
        $data = $this->Menu->saveOrder($menu);
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    function admin_index($treeMode = '')
    {

        //$this->Menu->setScope("Menu.selection_id = {$this->selection_id}");

        if ($this->Menu->Behaviors->attached('Translate') && Configure::read('Config.languages'))
        {
            $this->Menu->locale = Configure::read('Config.languages');
        }

//        $this->Menu->recover();
        //$this->Menu->Translate translateDisplay 
        $this->Menu->bindTranslation(array('name' => 'translateDisplay'));
        $tree = $this->Menu->findTree();
        //$tree = $this->links($tree);
        $this->set('tree', $tree);

        $this->set('is_ajax', $this->request->is('ajax'));

        $this->set('treeMode', $treeMode);
        $urlOptions = $this->Menu->urlOptions();
        $this->set(compact('urlOptions'));

        return $tree;
    }

    function links(&$data = array())
    {

        foreach ($data as &$link)
        {
            $link = $this->link($link);
            if (!empty($link['children']))
            {
                $this->links($link['children']);
            }
        }
        return $data;
    }

    function link($link = array())
    {
        $link['Link']['title'] = isset($link['Menu']['name']) ? $link['Menu']['name'] : '';
        $link['Link']['url'] = '#';
        $link['Link']['options'] = array();

        if (!empty($link['Menu']['model']))
        {
            $link['Menu']['controller'] = Inflector::pluralize(strtolower($link['Menu']['model']));
        }
        $link['Menu']['plugin'] = (isset($link['Menu']['model']) and $link['Menu']['model'] == 'Page') ? 'page' : '';
        switch ($link['Menu']['option'])
        {
            case 0:
                $link['Link']['options']['default'] = false;
                break;
            case 1:
                $link['Link']['url'] = $link['Menu']['url'];
                break;
            case 2:
                $link['Link']['title'] = $link['Menu']['name'];

                $link['Link']['url'] = array();
                $link['Link']['url']['admin'] = false;
                $link['Link']['url']['plugin'] = $link['Menu']['plugin'];
                $link['Link']['url']['controller'] = $link['Menu']['controller'];
                $link['Link']['url']['action'] = 'view';
                $link['Link']['url'][] = $link[$link['Menu']['model']]['slug'];
                break;
            default:
                $link['Link']['options'] = array('onclick' => 'return false;');
        }
        return $link;
    }

    function admin_relatedindex($alias = 'Page.Page', $params = null)
    {

        if (empty($alias))
        {
            throw new NotFoundException(__('Model nie istnieje.'));
        }

        $this->loadModel($alias);

        list($plugin, $model) = pluginSplit($alias);

        if ($this->Menu->Behaviors->attached('Translate') && Configure::read('Config.languages'))
        {
            $language = Configure::read('Config.languages');
            $this->Page->locale = $language;
            $this->Page->bindTranslation(array('name' => 'translateDisplay'));
        }

        if ($params)
        {
            if ($params == 'podstrony')
            {
                $paginateParams['conditions'][$model . '.gallery'] = 0;
            }
            if ($params == 'galerie')
            {
                $paginateParams['conditions'][$model . '.gallery'] = 1;
            }
        }
        $paginateParams['limit'] = 10;
        $this->paginate = $paginateParams;

        $relatedData = $this->paginate($model);
        $displayField = $this->Menu->displayField;

        $this->set(compact('relatedData', 'model', 'plugin', 'displayField'));
    }

    function admin_reset()
    {
        $this->Menu->recover('parent');
        $this->Menu->recover('tree');
        $this->Session->setFlash('Zresetowano');
        $this->redirect(array('action' => 'index'), null, true);
    }

    function admin_update()
    {
        if (empty($this->request->data['dest_id']) or empty($this->request->data['id']))
        {
            throw new MethodNotAllowedException('empty dest_id');
        }

        if (empty($this->request->data['mode']))
        {
            $this->request->data['mode'] = null;
        }

        $valid = $this->Menu->validateDepth($this->request->data['id'], $this->request->data['dest_id'], $this->request->data['mode']);
        if ($valid === false)
        {
            $this->Session->setFlash($this->Menu->validate['depth']['message']);
        }

        if ($valid === true && $this->Menu->moveNode($this->request->data['id'], $this->request->data['dest_id'], $this->request->data['mode']))
        {
            //success
            $this->Session->setFlash(__d('public', 'Zmieniono pozycję'));
        }
        //debug($this->referer());
        $this->render(false);
        //$this->redirect($this->referer());
        return false;
    }

    function admin_add($requested = false)
    {
        //$this->_checkAccess($model);

        if (empty($this->request->data))
        {
            if (!$requested)
            {
                $this->render(false);
            }
            return false;
        }

        if (empty($this->request->data['Menu']['name']))
        {
            $this->Session->setFlash(__d('public', 'Wprowadź nazwę, aby dodać pozycję.'));
            $this->redirect(array('action' => 'index'));
        }

        $this->Menu->create();

        //$this->request->data['Menu']['selection_id'] = $this->selection_id;

        if ($this->Menu->save($this->request->data))
        {
            if (empty($this->request->data['dest_id']))
            {
                $this->Session->setFlash(__d('public', 'Dodano pozycję na koniec drzewa.'));
            } else
            {
                $id = $this->Menu->getInsertID();
                if (empty($this->request->data['mode']))
                {
                    $this->request->data['mode'] = null;
                }
                if ($this->Menu->moveNode($id, $this->request->data['dest_id'], $this->request->data['mode']))
                {
                    $this->Session->setFlash(__d('public', 'Dodano pozycję do drzewa.'));
                } else
                {
                    $this->Session->setFlash(__d('public', 'Dodano pozycję na koniec drzewa.'));
                }
            }
            $this->request->data = array();
        } else
        {
            $this->Session->setFlash(__d('public', 'Dodanie pozycji nie powiodło się, sprawdź formularz i spróbuj ponownie'));
        }

        $this->redirect(array('action' => 'index'));
    }

    function admin_edit($id = null)
    {
        if (!$id && empty($this->request->data))
        {
            $this->Session->setFlash(__('Nie znaleziono pozycji o podanym ID'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data))
        {
            if ($this->Menu->save($this->request->data))
            {
                $this->Session->setFlash(__('Zapisano pozycję w menu'));
                $this->redirect(array('admin' => true, 'plugin' => 'menu', 'controller' => 'menus', 'action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('Zapisywanie pozycji w menu nie powiodło się. Sprawdź formularz i spróbuj ponownie.'));
            }
        }
        $urlOptions = $this->Menu->urlOptions();

        if (empty($this->request->data))
        {
            $this->Menu->locale = Configure::read('Config.languages');
            $this->request->data = $this->Menu->read(null, $id);
            if ($this->request->data['Menu']['option'] == 2)
            {
                $alias = $this->request->data['Menu']['model'];
                $this->request->data['Menu']['model_title'] = $this->request->data['Page']['slug'];
            }
        }

        $this->set(compact('urlOptions'));
        /*
          if (empty($this->request->data)) {
          $this->Menu->Page->set_translate();
          $this->Menu->locale = Configure::read('Config.languages');
          $this->request->data = $this->Menu->read(null, $id);
          if(!empty($this->request->data['Page']['id'])){
          $this->Menu->Page->recursive = 0;
          $page = $this->Menu->Page->findById($this->request->data['Page']['id']);
          $this->request->data['Category']['model_title'] = $page['Page']['name'];
          }
          } */
    }

    function delete($id = null, $all = null, $treeMode = '')
    {
        //$this->loadModel($model);
        $model = 'Menu';
        $lang = 'pl'; //$this->I18n->l10n->locale;
        if (empty($id))
        {
            $this->cakeError('error404');
        }

        if ($all != 0)
        {
            $this->Menu->delete($id);
        } else
        {
            $ile1 = $this->Menu->query("SELECT COUNT(*) as `ile` FROM `i18n` WHERE `model` = '{$model}' AND locale = '{$lang}' AND foreign_key = {$id}");
            $ile2 = $this->Menu->query("SELECT COUNT(*) as `ile` FROM `i18n` WHERE `model` = '{$model}' AND foreign_key = {$id}");
            if ($ile1[0][0]['ile'] == $ile2[0][0]['ile'])
            {
                $this->Menu->delete($id);
            } else
            {
                $this->Menu->query("DELETE FROM `i18n` WHERE `model` = '{$model}' AND locale = '{$lang}' AND foreign_key = {$id}");
            }
        }
        $this->redirect(array('admin' => 'admin', 'action' => 'index', $model, $treeMode), null, true);
    }

}
