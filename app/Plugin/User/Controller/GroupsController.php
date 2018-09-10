<?php

class GroupsController extends AppController {

    public $name = 'Groups';

//    public $layout = 'admin';

    function admin_index() {
        $this->Group->recursive = 0;
        $this->set('groups', $this->paginate());
        $title = 'Grupy';
        $subtitle = 'Grupy';

        $this->set(compact('title', 'subtitle'));
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowy ID grupy'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('group', $this->Group->read(null, $id));
        $title = 'Grupy - szczegóły';
        $subtitle = 'Grupy - szczegóły';

        $this->set(compact('title', 'subtitle'));
    }

    function admin_add() {
        if (!empty($this->request->data)) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Grupa została zapisana'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('cms', 'Zapisywanie grupy nie powidło się. Sprawdź formularz i spróbuj ponownie.'));
            }
        }
        $this->loadModel('User.PermissionGroup');
        $params['fields'] = array('PermissionGroup.id', 'PermissionGroup.name', 'PermissionCategory.name');
        $params['recursive'] = 0;
        $permissionGroups = $this->PermissionGroup->find('list', $params);
        $this->set(compact('permissionGroups'));
        $title = 'Grupy - dodaj';
        $subtitle = 'Grupy - dodaj';

        $this->set(compact('title', 'subtitle'));
        
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowy ID grupy'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Grupa została zapisana'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('cms', 'Zapisywanie grupy nie powidło się. Sprawdź formularz i spróbuj ponownie.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Group->read(null, $id);
        }

        $this->loadModel('User.PermissionGroup');
        $params['fields'] = array('PermissionGroup.id', 'PermissionGroup.name', 'PermissionCategory.name');
        $params['recursive'] = 0;
        $permissionGroups = $this->PermissionGroup->find('list', $params);
        $this->set(compact('permissionGroups'));
        $title = 'Grupy - edycja';
        $subtitle = 'Grupy - edycja';

        $this->set(compact('title', 'subtitle'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowy ID grupy'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Group->delete($id)) {
            $this->Session->setFlash(__d('cms', 'Grupa została usunięta'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('cms', 'Usuwanie grupy nie powiodło się, spróbuj ponownie, lub skontaktuj się z administratorem.'));
        $this->redirect(array('action' => 'index'));
    }

}

?>