<?php

class DynamicElementsController extends AppController {

    var $name = 'DynamicElements';
    var $layout = 'admin';
    var $helpers = array('FebTinyMce4');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('element', 'view'));
    }

    function view($slug) {
        $this->layout = 'default';
        $slug = $this->DynamicElement->isSlug($slug);
        if (!$slug) {
            echo 'Nie zdefiniowano elementu';
        }
        if (!empty($slug['error'])) {
//            $this->redirect(array($slug['slug']), $slug['error']);
        }
        $this->DynamicElement->id = $slug['id'];
        $id = $slug['id'];

        $dynamicElement = $this->DynamicElement->read(null, $id);
        $this->set('dynamicElement', $dynamicElement);
//        echo $dynamicElement['DynamicElement']['content'];
//        $this->render('Page.Pages/view');
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    function element($slug = null) {
        $this->layout = false;
        $slug = $this->DynamicElement->isSlug($slug);
        if (!$slug) {
            echo 'Nie zdefiniowano elementu';
        }
        if (!empty($slug['error'])) {
//            $this->redirect(array($slug['slug']), $slug['error']);
        }
        $this->DynamicElement->id = $slug['id'];
        $id = $slug['id'];

        $dynamicElement = $this->DynamicElement->read(null, $id);
//        $this->set('dynamicElement', $dynamicElement);
        echo $dynamicElement['DynamicElement']['content'];
        $this->autoRender = false;
    }

    function admin_index() {
        $this->DynamicElement->recursive = 0;
        $this->set('dynamicElements', $this->paginate());
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->DynamicElement->create();
            if ($this->DynamicElement->save($this->data)) {
                $this->Session->setFlash(__('Wycinek został zapisany'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Zapisywanie wycinka nie powiodło się. Sprawdź formularz i spróbuj ponownie'));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Nieprawidłowy ID wycinka.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->DynamicElement->save($this->data)) {
                $this->Session->setFlash(__('Wycinek został zapisany'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Zapisywanie wycinka nie powiodło się. Sprawdź formularz i spróbuj ponownie'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->DynamicElement->read(null, $id);
        }
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Nieprawidłowy ID wycinka.'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->DynamicElement->delete($id)) {
            $this->Session->setFlash(__('Wycinek został usunięty'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Usuwanie wycinka nie powiodło się'));
        $this->redirect(array('action' => 'index'));
    }

}

?>