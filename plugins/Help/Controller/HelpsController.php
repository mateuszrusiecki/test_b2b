<?php

App::uses('HelpLib', 'Help.Lib');

class HelpsController extends AppController {

    var $name = 'Helps';
    var $helpers = array('FebTinyMce4');
    var $uses = array('Help.Help');
    var $layout = 'help';

    function admin_index() {
        $this->layout = 'admin';
        $this->Help->recursive = 0;
        $this->set('helps', $this->paginate());
    }

    /*
     * Uwaga na Https
     */

    function admin_view() {
        $referer = $this->referer();
//        set_time_limit(1);
        $referer = str_replace('http://' . $_SERVER['SERVER_NAME'] . $this->params->base, '', $referer);
        $tree = HelpLib::getHelpTree($referer);
        $help = $this->Help->getLastHelp($tree);
        $url = $referer;
        $this->set(compact('tree', 'help', 'referer', 'url'));
    }

    function admin_special_view($referer = null, $url = '/') {
        $this->layout = false;

        $url = base64_decode($url);
        $referer = base64_decode($referer);
        $tree = HelpLib::getHelpTree($referer);
        $params['conditions']['Help.url'] = $url;
        $help = $this->Help->find('first', $params);
        $this->set(compact('tree', 'help', 'referer', 'url'));
        $this->render('admin_view');
    }

    function admin_set($referer = null, $url) {
        $referer = base64_decode($referer);
        $url = base64_decode($url);

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Help->save($this->request->data)) {
                $this->Session->setFlash(__('Poprawinie zapisano'));
            } else {
                $this->Session->setFlash(__('Wystapily bledy przy zapisie'));
            }
        }

        $tree = HelpLib::getHelpTree($referer);

        $params['conditions']['Help.url'] = $url;
        $this->request->data = $this->Help->find('first', $params);
        $help = $this->request->data;
        $this->set(compact('tree', 'help', 'referer', 'url'));
    }

    /**
     * admin_edit method
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->layout = 'admin';
        $this->Help->id = $id;
        if (!$this->Help->exists()) {
            throw new NotFoundException(__('Invalid help'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Help->save($this->request->data)) {
                $this->Session->setFlash(__('The help has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The help could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Help->read(null, $id);
        }
    }

    /**
     * admin_delete method
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $this->Help->id = $id;
        if (!$this->Help->exists()) {
            throw new NotFoundException(__('Invalid help'));
        }
        if ($this->Help->delete()) {
            $this->Session->setFlash(__('Help deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Help was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
