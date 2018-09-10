<?php

App::uses('AppController', 'Controller');

/**
 * News Controller
 *
 * @property News $News
 */
class NewsController extends AppController {

    /**
     * Nazwa layoutu
     */

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array();

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array();

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('get_news_to_front', 'index', 'view', 'news_front');
    }

    public function news_front() {
        $this->layout = false;
        $this->News->recursive = 0;
        $params['limit'] = 1;
        $params['order'] = "News.created DESC";
        $params['conditions']['News.main'] = 1;
        $news = $this->News->find('all', $params);
        $this->set(compact('news'));
        $this->render('news_front');
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index() {
        $this->helpers[] = 'FebTime';
        $this->helpers[] = 'Fancybox.Fancybox';
        $this->News->recursive = 0;
        $params['limit'] = 5;
        $this->paginate = $params;
        $news = $this->paginate();
        
//        if(!$this->request->isAjax){
//            $this->redirect(array('action'=>'view',$news[0]['News']['slug']));
//        }
        $this->set(compact('news'));
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($slug = null) {
        $this->helpers[] = 'Fancybox.Fancybox';
        $slug = $this->News->isSlug($slug);
        if (!$slug) {
            throw new NotFoundException(__('Strona nie istnieje.'));
        }
        if (!empty($slug['error'])) {
            $this->redirect(array($slug['slug']), $slug['error']);
        }
        $this->News->id = $slug['id'];
        if (!$this->News->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('news', $this->News->read(null, $slug['id']));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index() {
        $this->layout = 'admin';
        $this->helpers[] = 'FebTime';
        $this->News->recursive = 1;
        $this->News->locale = Configure::read('Config.languages');
        $this->News->bindTranslation(array('title' => 'translateDisplay'));
        $this->set('news', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        $this->layout = 'admin';
        $this->News->id = $id;
        if (!$this->News->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('news', $this->News->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function admin_add() {
        $this->layout = 'admin';
        $this->helpers[] = 'FebTinyMce4';
        if ($this->request->is('post')) {
            $this->News->create();
            if ($this->News->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        $users = $this->News->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->layout = 'admin';
        $this->helpers[] = 'FebTinyMce4';
        $this->News->id = $id;
        if (!$this->News->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->News->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('admin', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.', 'flash/error'));
            }
        } else {
            $this->News->locale = Configure::read('Config.languages');
            $this->request->data = $this->News->read(null, $id);
        }
        $users = $this->News->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    function admin_delete($id = null, $all = null) {
        $this->FebI18n->delete($id, $all);
        $this->redirect(array('action' => 'index'), null, true);
    }

    /**
     * Akcja do podpowiadaina danych z formularza
     * 
     * @param type $term
     * @throws MethodNotAllowedException 
     */
    function admin_autocomplete($term = null) {
        $this->layout = 'ajax';
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $params = array();
        $params['fields'] = array('title');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['News.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->News->recursive = -1;
        $params['conditions']["News.title LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->News->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
