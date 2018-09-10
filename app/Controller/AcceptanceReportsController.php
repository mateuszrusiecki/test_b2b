<?php
App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
/**
 * AcceptanceReports Controller
 *
 * @property AcceptanceReport $AcceptanceReport
 */
class AcceptanceReportsController extends AppController {

    
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
        $this->Auth->allow(array('fill','report_pdf'));
    }

    /**
    * Akcja wyświetlająca listę protokołów odbioru
    * 
    * @return void
    */
	public function index() {
        $title = 'Protokoły odbiotu';
        $subtitle = 'Lista protokołów odbioru';
       
        if($this->request->is('post')){
            $this->helpers[] = 'FebTime';
            $params['order'] = 'AcceptanceReport.modified desc';
            $reports = $this->AcceptanceReport->find('all',$params);
            
            $this->set(compact('reports'));
            $this->set('_serialize', array('reports'));
        }
        
        $this->set(compact('title','subtitle'));
	}

    /**
    * Akcja podglądu protokołu odbiotu
    *
    * @param string $id
    * @return void
    */
	public function view($id = null) {
	
        $title = 'Protokół odbiotu';
        $subtitle = 'Protokół odbioru';

		$this->AcceptanceReport->id = $id;
		if (!$this->AcceptanceReport->exists()) {
			throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
		}
		$this->set('report', $this->AcceptanceReport->read(null, $id));
        
        $this->loadModel('Settings');
        $params['conditions'] = array(
            'key'=>'App.FebDaneReszow'
        );
        $executor = $this->Settings->find('first',$params);
        
        $this->set(compact('title','subtitle','executor'));
	}

    /**
    * Akcja dodająca obiekt
    *
    * @return void
    */
	public function add() {
     
        $this->layout = 'ajax';
		$this->render(false);
		if ($this->request->is('post')) {
            $client_project_shedule_id = (int)$this->request->data;
            
            $params['conditions'] = array(
                'ClientProjectShedule.id' => $client_project_shedule_id
            );
            $clientProjectShedule = $this->AcceptanceReport->ClientProjectShedule->find('first',$params);
        
			$this->AcceptanceReport->create();
            $data['AcceptanceReport']['hid'] = String::uuid();
            $data['AcceptanceReport']['client_project_id'] = $clientProjectShedule['ClientProject']['id'];
            $data['AcceptanceReport']['client_id'] = $clientProjectShedule['ClientProject']['client_id'];
            $data['AcceptanceReport']['client_project_shedule_id'] = $clientProjectShedule['ClientProjectShedule']['id'];
            $data['AcceptanceReport']['task_list'] = $clientProjectShedule['ClientProjectShedule']['desc'];
            $data['AcceptanceReport']['date_end'] = $clientProjectShedule['ClientProjectShedule']['date'];
            $this->AcceptanceReport->save($data);

            /*
             * Dane do maila
             */
            $this->loadModel('Client');
            $params['conditions'] = array(
                'Client.id' => $clientProjectShedule['ClientProject']['client_id']
            );
            $client = $this->Client->find('first',$params); //dane klienta
            
            $clientProjectShedule['AcceptanceReport']['hid'] = $data['AcceptanceReport']['hid']; //link do protokołu
            $clientProjectShedule['feb_address'] = $_SERVER['SERVER_NAME'];
            
            App::uses('FebEmail', 'Lib');
            $email = new FebEmail('smtp');
            $email->viewVars(array('value' => $clientProjectShedule));

            $to[] = $client['Client']['email']; //mail do klienta
            $to2[] = "test_dev@febdev.pl";

            $email->template('acceptance_report')
                    ->emailFormat('html')
                    ->to($to)
                    ->from(array('crm@febdev.pl' => 'Fabryka e-biznesu'))
                    ->subject(__d('email', 'Protokół odbioru został osiągnięty'));
            //$email->attachments($pdf);
            $email->send();
            $email->reset();
            
            $this->set('data', true);
            $this->set('_serialize', array('data'));
		}

	}

    /**
    * Akcja edytująca protokół
    *
    * @param string $id
    * @return void
    */
	public function edit($hid = null) {
        
        $title = 'Protokół odbiotu';
        $subtitle = 'Protokół odbioru';
        
        $params['conditions'] = array(
            'hid'=>$hid
        );
		$report = $this->AcceptanceReport->find('first',$params);
		if (empty($report)) {
			throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AcceptanceReport->save($this->request->data)) {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
			} else {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
			}
		} else {
            $this->set('report', $report);
		}
		
        $this->loadModel('Settings');
        $params['conditions'] = array(
            'key'=>'App.FebDaneReszow'
        );
        $executor = $this->Settings->find('first',$params);
        
        $this->set(compact('title','subtitle','executor'));
	}
    
    public function report_pdf() {

        $title = 'Protokół odbiotu';
        $subtitle = 'Protokół odbioru';
        
        $params['conditions'] = array(
            'hid'=>'55b8834d-1b28-4a05-88f3-2d7877ecc6b3'
        );
		$report = $this->AcceptanceReport->find('first',$params);
          
        $this->loadModel('Settings');
        $params['conditions'] = array(
            'key'=>'App.FebDaneReszow'
        );
        $executor = $this->Settings->find('first',$params);
        $this->layout = 'pdf/acceptance_report';
        
        $this->set(compact('title','subtitle','executor','report'));
	}
    /**
    * Akcja edytująca protokół(dla klienta)
    *
    * @param string $id
    * @return void
    */
	public function fill($hid = null) {
        
        $title = 'Protokół odbiotu';
        $subtitle = 'Protokół odbioru';
        
        $report_params['conditions'] = array(
            'hid'=>$hid
        );
		$report = $this->AcceptanceReport->find('first',$report_params);
          
        $this->loadModel('Settings');
        $executor_params['conditions'] = array(
            'key'=>'App.FebDaneReszow'
        );
        $executor = $this->Settings->find('first',$executor_params);
        
		if (empty($report)) {
			throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
            $this->AcceptanceReport->id = $report['AcceptanceReport']['id'];
			$this->AcceptanceReport->saveField('opinion',$this->request->data['AcceptanceReport']['opinion']);
			$this->AcceptanceReport->saveField('acceptance',$this->request->data['AcceptanceReport']['acceptance']);
                /*
                 * powiadomienie koordynatora
                 */
                $params['conditions'] = array(
                    'ClientProject.id' => $report['AcceptanceReport']['client_project_id']
                );
                $params['recursive'] = -1;
                $clientProject = $this->AcceptanceReport->ClientProject->find('first', $params);

                if($clientProject){
                    $this->loadModel('Message');
                    $url = Router::url(array('controller' => 'acceptance_reports', 'action' => 'view', $report['AcceptanceReport']['id']), true);
                    $this->Message->sendMessage($clientProject['ClientProject']['user_id'], 1, 'Klient zakończył wypełnianie protokołu odbioru', $url); //powiadomienie do kierownika projektu
                }
                    
                
                $report = $this->AcceptanceReport->find('first',$report_params); //laduje raport jeszcze raz - potrzebne do pdf ido wyświetlania(nie ma przekierowania)
                /*
                * Generowanie PDF
                */
                $CakePdf = new CakePdf(Configure::read('CakePdf'));
                $CakePdf->viewVars(array('report' => $report,'executor'=>$executor));
                $CakePdf->template('/AcceptanceReports/pdf/report_pdf', 'acceptance_report');
                $date = date('Y_m_d__H_i_s');
                $filename = 'Czesciowy_protokol_odbioru_' . $date . '.pdf';
                //write it to file directly
                if (file_exists(WWW_ROOT . 'files' . DS . 'projectfile' . DS . $filename)) {
                    unlink(WWW_ROOT . 'files' . DS . 'projectfile' . DS . $filename); //usuwam archiwum jeśli już takie istnieje
                }
                $pdf = $CakePdf->write(WWW_ROOT . 'files' . DS . 'projectfile' . DS . $filename);
                
                /*
                * zapis pliku do projeku
                */
               $this->loadModel('ProjectFile');
               $data = array();
               $data['ProjectFile']['client_project_id'] = $clientProject['ClientProject']['id'];
               $data['ProjectFile']['file'] = $filename;
               $data['ProjectFile']['project_file_category_id'] = 8; //protokół odbioru
               if(isset($_SESSION['Auth']['User']['id'])) {
                   $data['ProjectFile']['user_id'] = $_SESSION['Auth']['User']['id'];
               } else{
                   //klient
                   $data['ProjectFile']['user_id'] = $report['Client']['user_id'];
               }
               $this->ProjectFile->save($data);

               /*
                * logowanie utworzenia pliku briefa
                */
               $this->loadModel('ClientProjectLog');
               $data = array();
               $data['ClientProjectLog']['client_project_id'] = $clientProject['ClientProject']['id']; //klient_lead_id
               if(isset($_SESSION['Auth']['User']['id'])) {
                   $data['ClientProjectLog']['user_id'] = $_SESSION['Auth']['User']['id'];
               } else{
                   //klient
                   $data['ClientProjectLog']['user_id'] = $report['Client']['user_id'];
               }
               $data['ClientProjectLog']['name'] = $filename;
               $this->ClientProjectLog->saveLog(34, $data); //log_type - nowy plik
        
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                
              
		} 
        
        $this->set(compact('title','subtitle','executor','report'));
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
		$this->AcceptanceReport->id = $id;
		if (!$this->AcceptanceReport->exists()) {
			throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
		}
		if ($this->AcceptanceReport->delete()) {
			$this->Session->setFlash(__d('public', 'Poprawnie usunięto.'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__d('public', 'Nie można usunąć.'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

    

}
