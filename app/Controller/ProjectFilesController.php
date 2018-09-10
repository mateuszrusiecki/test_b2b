<?php

App::uses('AppController', 'Controller');

/**
 * ProjectFiles Controller
 *
 * @property ProjectFile $ProjectFile
 */
class ProjectFilesController extends AppController
{
    public $components = array('CheckAccess');


    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('get_files','project_file_access_for_client'));
    }

    public function get_files($client_project_id = null)
    {
        if (!$this->ProjectFile->ClientProject->exists($client_project_id))
        {
            throw new NotFoundException(__d('cms', 'Projekt nie istnieje.'));
        }
        /* pliki projektu */
        $files_tmp = $this->ProjectFile->getFileList($client_project_id, 1);
        $this->loadModel('ProjectFileCategory');
        //$fileCategory = $this->ProjectFileCategory->getAll();

        $session = $this->Session->read();
		//$access = $this->ProjectFile->ClientProject->checkUserAuthorManager($client_project_id, $session['Auth']['User']['id']); // [boolean] czy uzytkownik jest kierownikiem projektu, autorem projektu czy handlowcem projektu 
        $user_access = $this->CheckAccess->checkIfUserIsAuthorized($session);

        $files = array();
        $acceptance_report = false;
        foreach ($files_tmp as &$file_tmp)
        {
            if ($file_tmp['ProjectFile']['project_file_category_id'] == 8) //jeśli kategoria pilku równa się 8 to jest protokół odbioru (category w modelu projectFile.php)
            {
                $acceptance_report = true;
            }

			if($user_access == 'client' && $file_tmp['ProjectFile']['client_available'] == false){ //jeśli użytkownik jest klientem i dokument nie jest mu udostpniony to go pomijam
				continue;
			} elseif ($user_access == 'user' && $file_tmp['ProjectFileCategory']['user_accessible'] == false ) { //jeśli kategoria plików nie jest dostępna dla zwykłych pracowników i użytkownik nie jest uprawniony to dokument pomijam
				continue;
			}
            if ($file_tmp['ProjectFile']['parent_id'] > 0)
            {
                $files[$file_tmp['ProjectFile']['parent_id']]['children'][] = $file_tmp;
            } else
            {
                $files[$file_tmp['ProjectFile']['id']] = $file_tmp;
            }
        }

        /*
         * Do plików projektu dołączam plik TC z leadu powiązanego z projektem
         */
        $params['recursive'] = -1;
        $params['conditions'] = array('id'=>$client_project_id);
        $client_project = $this->ProjectFile->ClientProject->find('first',$params);
        $this->loadModel('TextDocument');
        $files_TC_tmp = $this->TextDocument->getTextDocuments($client_project['ClientProject']['client_lead_id'], 1);

        if($files_TC_tmp){
            foreach ($files_TC_tmp as $value) {
                $value['TextDocument']['text_document'] = 1;
                $files_TC[]['ProjectFile'] = $value['TextDocument'];
            }
            $files = array_merge($files,$files_TC);
        }
        /*
         * Koniec dołączania
         */

        $this->set('files', $files);
        $this->set('_serialize', 'files');
    }

    public function get_lead_files($client_lead_id = null)
    {
        if (!$this->ProjectFile->ClientLead->exists($client_lead_id))
        {
            throw new NotFoundException(__d('cms', 'Lead nie istnieje.'));
        }
        /* pliki projektu */
        $files_tmp = $this->ProjectFile->getLeadFileList($client_lead_id, 1);
        $this->loadModel('ProjectFileCategory');
        $fileCategory = $this->ProjectFileCategory->getAll();
        //debug($files_tmp);
        //debug($fileCategory);
        $session = $this->Session->read();
        $user_access = $this->CheckAccess->checkIfUserIsAuthorized($session);

        $files = array();
        $acceptance_report = false;
        foreach ($files_tmp as &$file_tmp)
        {
            if ($file_tmp['ProjectFile']['project_file_category_id'] == 8) //jeśli kategoria pilku równa się 8 to jest protokół odbioru (category w modelu projectFile.php)
            {
                $acceptance_report = true;
            }

            if ($file_tmp['ProjectFileCategory']['user_accessible'] == false && $user_access == false)
            {
                continue; //jeśli pliki nie są dostępne dla zwykłych użytkowników i użytkownik nie ma do nich prawa dostępu to je pomijam
            }
            if ($file_tmp['ProjectFile']['parent_id'] > 0)
            {
                $files[$file_tmp['ProjectFile']['parent_id']]['children'][] = $file_tmp;
            } else
            {
                $files[$file_tmp['ProjectFile']['id']] = $file_tmp;
            }
        }
        
        $files = $this->merge_files_and_tc($client_lead_id,$files);

//        $this->loadModel('TextDocument');
//        $files_TC_tmp = $this->TextDocument->getTextDocuments($client_lead_id, 1);
//       // die(debug($files));
//        if($files_TC_tmp){
//            foreach ($files_TC_tmp as $value) {
//                $value['TextDocument']['text_document'] = 1;
//                $files_TC[]['ProjectFile'] = $value['TextDocument'];
//            }
//            $files = array_merge($files,$files_TC);
//        }


        $this->set('files', $files);
        $this->set('_serialize', 'files');
    }
    
    /*
     * do plików projektu/leada dołączam powiązane linki do TC
     * s.52 w dokumentacji - "właściwości pliku: (...) Nazwa, będąca jednocześnie linkiem do pobierania pliku (w przypadku Text Cooperation - edycji pliku)"
     * 
     * @param       $client_lead_id - id leadu do którego przypisane są dokumenty TC
     * 
     * @return      array() - metoda zwara tablice(pustą w przypadku błedu)
     */
    public function merge_files_and_tc($client_lead_id=null, $files=null){
        if(empty($client_lead_id) || empty($files)){
            return array();
        }
        $this->loadModel('TextDocument');
        $files_TC_tmp = $this->TextDocument->getTextDocuments($client_lead_id, 1);
        if($files_TC_tmp){
            foreach ($files_TC_tmp as $value) {
                $value['TextDocument']['text_document'] = 1;
                $files_TC[]['ProjectFile'] = $value['TextDocument'];
            }
            return array_merge($files,$files_TC);
        } else {
            return $files;
        }
    }

    public function get_hr_files()
    {
        //pliki dokumentu sekretariatu hr
        $files = $this->ProjectFile->listProjectFile();
        $this->set('files', $files);
        $this->set('_serialize', 'files');
    }
    public function get_client_files()
    {
        //pliki dokumentów zalogowanego klienta
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];
        
        $files = $this->ProjectFile->listClientProjectFile($user_id);
        $this->set('files', $files);
        $this->set('_serialize', 'files');
    }

    public function delete()
    {
        $return = false;
        if (!empty($this->data['id']) && !empty($this->data['type']))
        {
            $return = $this->ProjectFile->deleteFile($this->data['id'], $this->data['type']);
        }
        $this->set('return', $return);
        $this->set('_serialize', 'return');
    }
	
	
    public function project_file_access_for_client()
    {
        $this->layout = false;
        $this->render(false);

        $file_id = (int) $this->request->data['file_id'];
        $client_available = $this->request->data['client_available'];

        if (!$file_id)//zmiennej $access nie trzeba sprawdzać
        { 
            return false;
        }

        return $this->ProjectFile->changeClientAccesToFile($file_id, $client_available);
    }

}
