<?php
App::uses('AppController', 'Controller');
/**
 * Grindstones Controller
 *
 */
class GrindstonesController extends AppController {

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('synchronize','synchronizeUsers'));
    }
	
	/*\
	 * Pobiera wszystkie zadania z grindstona
	 */
    public function synchronize() {
        //debug('');
        $this->Grindstone->update();
        echo 'Synchronizacja przebiegla pomyslnie';
        die();
    }
	
	/*
	 * metoda synchronizuje użytkowników w systemie(tylko tych którzy nie mają przypisanego user_id) z zadaniami z grindstona
	 */
	public function synchronizeUsers(){
		$this->Grindstone->synchronizeUsersWithGrindstone();
		
		//return $this->redirect($this->referer());
	}
	
	

}
