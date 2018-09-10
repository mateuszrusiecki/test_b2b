<?php
App::uses('AppController', 'Controller');
/**
 * WorkTimes Controller
 *
 * @property WorkTime $WorkTime
 */
class WorkTimesController extends AppController {

    
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
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }

    /**
    * Akcja wyświetlająca listę obiektów
    * 
    * @return void
    */
	public function index() {
        $this->helpers[] = 'FebTime';
		$this->WorkTime->recursive = 0;
		$this->set('workTimes', $this->paginate());
	}

    /**
    * Akcja podglądu obiektu
    *
    * @param string $id
    * @return void
    */
	public function view($id = null) {
	
//        $id = $this->Slug->basic();
		$this->WorkTime->id = $id;
		if (!$this->WorkTime->exists()) {
			throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
		}
		$this->set('workTime', $this->WorkTime->read(null, $id));
	}

    /**
    * Akcja dodająca obiekt
    *
    * @return void
    */
	public function add() {
		if ($this->request->is('post')) {
			$this->WorkTime->create();
			if ($this->WorkTime->save($this->request->data)) {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else {
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
	public function edit($id = null) {
		$this->WorkTime->id = $id;
		if (!$this->WorkTime->exists()) {
			throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->WorkTime->save($this->request->data)) {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
			} else {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
			}
		} else {
			$this->request->data = $this->WorkTime->read(null, $id);
		}
	}

    /**
    * Akcja usuwająca obiekt
    *
    * @param string $id
    * @return void
    */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->WorkTime->id = $id;
		if (!$this->WorkTime->exists()) {
			throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
		}
		if ($this->WorkTime->delete()) {
			$this->Session->setFlash(__d('public', 'Poprawnie usunięto.'));
			$this->redirect(array('action'=>'index'));
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
    function admin_autocomplete($term = null) {
        $this->layout = 'ajax';
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $params = array();
        $params['fields'] = array('id');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['WorkTime.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->WorkTime->recursive = -1;
        $params['conditions']["WorkTime.id LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->WorkTime->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }


}
