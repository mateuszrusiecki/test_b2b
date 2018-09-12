<?php

App::uses('FebEmail', 'Lib');	
App::uses('DirectoryManager', 'NewClients.Lib');
App::uses('NewClientsAppController', 'NewClients.Controller');


class ApiController extends NewClientsAppController {
    
    public $components = array('RequestHandler','FebEmail');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('sendacceptanceemails', 'sendversionvisiblemail', 'projectdetail');
    }
    
    public $autoRender = false;
    public $uses = array(
        'NewClients.Project',
        'NewClients.Version',
        'NewClients.pView',
        'NewClients.Comment',
        'NewClients.Category',
        'NewClients.User',
        'NewClients.Region',
        'Profile',
        'ClientLead',
        'ClientProject',
        'NewClients.B2BClient',
        'Client',
    );
    public function isAuthorized() {
        return true;
    }
    public function userdata() {
        $out = $this->Auth->user();
        // ukrywamy czyste hasło, zakodowane w Auth->user() nie jest zwracane
        unset($out['clearpassword']);
        $this->response->body(json_encode($out));
    }

    /**
     * Pobiera leada na podstawie id i zwraca jako json
     */
    public function get_lead() {
        
        $clientLead = $this->ClientLead->find('first', array(
            'conditions' => array(
                'ClientLead.id' => $this->request->data['lead_id']
            ),
            'fields' => array(
                'ClientLead.id',
                'ClientLead.client_id',
                'ClientLead.user_id',
                'ClientLead.name',
            ),
            'contain' => array(
                'Client' => array(
                    'fields' => array(
                        'Client.id',
                        'Client.name',
                    ),
                ),
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.email',
                    ),
                    'Profile' => array(
                        'fields' => array(
                            'Profile.id',
                            'Profile.name',
                            'Profile.user_id',
                        )
                    )
                ),
            ),
        ));
        
        if($clientLead) {
            $this->response->body(json_encode($clientLead));
        } else {
            $this->response->body(json_encode(array()));
        }
        
    }
    
    /**
     * Pobiera client_project na podstawie id i zwraca jako json
     */
    public function get_client_project() {
        
        $clientProject = $this->ClientProject->find('first', array(
            'conditions' => array(
                'ClientProject.id' => $this->request->data['client_project_id']
            ),
            'fields' => array(
                'ClientProject.id',
                'ClientProject.client_id',
                'ClientProject.user_id',
                'ClientProject.name',
            ),
            'contain' => array(
                'Client' => array(
                    'fields' => array(
                        'Client.id',
                        'Client.name',
                    ),
                ),
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.email',
                    ),
                    'Profile' => array(
                        'fields' => array(
                            'Profile.id',
                            'Profile.name',
                            'Profile.user_id',
                        )
                    )
                ),
            ),
        ));
        
        $this->response->body(json_encode($clientProject));
    }
    
    /*
     * returns: lista projektów z danymi dla managera (project-list)
     */
    public function projectsreview() {   
        
        $conditions = array();
        
        if(isset($_GET['lead_id'])){
            $conditions['lead_id'] = $_GET['lead_id'];        
        }
        
        if(isset($_GET['client_project_id'])){
            $conditions['client_project_id'] = $_GET['client_project_id'];
        }
        
        $projects = $this->Project->find('all', array(
            
            'conditions' => $conditions,
            'recursive' => 2,                     
            'Category' => array(
                'order' => array(
                    'Category.ordernum' => 'ASC',          
                ),
                'pView' => array(
                    'order' => array(
                       'pView.ordernum' => 'ASC',
                    ),
                    'Version' => array(
                        'order' => array(
                            'number' => 'DESC'
                        )
                    )
                )
            )
        ));
        
        $this->response->body(json_encode($projects));
    }
    public function projectdetail($id) {
        $project = $this->Project->find('first', array(
            'recursive' => 5,
            'conditions' => array(
                'Project.id' => $id
            ),
            'contain' => array(
                'Manager' => array(
                    'Profile' => array(
                        'fields' => array(
                            'Profile.name'
                        )
                    )             
                ),
                'Client' => array(
                    'Profile' => array(
                        'fields' => array(
                            'Profile.name'
                        )
                    )             
                ),
                'B2BClient' => array(
                    'fields' => array(
                        'B2BClient.id',
                        'B2BClient.name',
                        'B2BClient.email',
                    )
                ),
                'Category' => array(
                    'order' => array(
                        'Category.ordernum' => 'ASC',
                    ),               
                    'pView' => array(
                        'order' => array(
                            'pView.ordernum' => 'ASC',
                        ),
                        'Version' => array(
                            'order' => array(
                                'Version.number' => 'DESC',
                            ),
                            'Region' => array(
                                'Comment',
                                'User'
                            )
                        )
                    )
                )
            )
        ));
 
        $this->response->body(json_encode($project));
    }
    public function clientsprojectsreview() {
        $userId = $this->Auth->user('id');
        
        $b2bClient = $this->B2BClient->find('first', array(            
            $conditions = array(
                'B2BClient.user_id' => $userId
            )
        ));
        
        $conditions = array(
            'client_id' => $b2bClient['B2BClient']['id'],
        );
        
        if(isset($_GET['lead_id'])){
            $conditions['lead_id'] = $_GET['lead_id'];        
        }
        
        if(isset($_GET['client_project_id'])){
            $conditions['client_project_id'] = $_GET['client_project_id'];
        }
                
        $projects = $this->Project->find('all', array(
            
            'conditions' => $conditions,
            'contain' => array(
                'Category' => array(
                    'order' => array(
                        'Category.ordernum' => 'ASC',
                    ),
                    'pView' => array(
                        'order' => array(
                            'pView.ordernum' => 'ASC',
                        ),
                        'Version' => array(
                            'order' => array(
                                'number' => 'DESC'
                            ),
                            'conditions' => array(
                                'Version.visible' => 1
                            ),
                            'Region' => array(
                                'Comment',
                                'User' => array(
                                    'Profile' => array(
                                        'fields' => array(
                                            'Profile.firstname',
                                            'Profile.surname'
                                        )
                                    ),                                    
                                )
                            )
                        )
                    )
                )
            )
        ));     
        
        $this->response->body(json_encode($projects));
    }
    public function setversionvisibility() {
        $response = array(
            'Status' => array(
                'success' => 0,
                'message' => 'Operacja niedozwolona'
            )
        );
        if ($this->request->is('post')) {
            // sprawdzamy czy jesteśmy z rolą manager żeby zmienić widoczność
            $user = $this->Auth->user();
            $role = $user['role'];
            if ($role == 'manager') {
                $versionId = $this->request->data['Version']['id'];
                $visibility = $this->request->data['Version']['visible'];
                $version = $this->Version->find('first', array(
                    'conditions' => array(
                        'Version.id' => $versionId
                    )
                ));
                $version['Version']['visible'] = $visibility;
                $this->Version->save($version);
                $response['Status'] = array(
                    'success' => 1
                );
                
                $this->Project->unbindModel(array('hasMany' => array('Category', 'pView')));            
                
                $project = $this->Project->find('first', array(
                        'conditions' => array(
                            'Project.id' => $version['View']['project_id'],
                        ),
                        'fields' => array(
                            'Project.id',
                            'Project.manager_id',
                            'Client.email'
                        )
                    )
                );
 
                //JESLI KOORDYNATOR UDOSTEPNIA WERSJĘ (czyli $visibility == 1) TO W TYM MIEJSCU NALEŻY WYSŁAĆ EMAIL
                
                //email ma informować klienta że został mu udostępniony nowy projekt graficzny i czeka on na akceptację
                
                //$project['Client']['email'] -> adres email do klienta
                
                // w dokumentacji ten mail jest opisany na stronie 76
                
            }
        }
        $this->response->body(json_encode($response));
    }
    
    public function sendversionvisiblemail() {
                 
        $subject = 'Udostępniono wersję graficzną';
        $to[] = 'mkustra0@gmail.com';
        $to[] = $this->request->data['clientEmail'];
        $template = 'gc_new_version_visible';
        $from = null;
        $sender = null;
        $emailFormat = 'html';
        $debug = false;
        //$data = array();
        $return = $this->FebEmail->sendFastEmail($subject, $to, $template, $data, $from, $sender, $emailFormat, $debug);
    }
    
    public function sendacceptanceemails() {
        
        $imgPath = $this->request->data['fullImagePath'];                  
        $subject = 'Wersja graficzna została zaakceptowana';
        $to[] = 'mkustra0@gmail.com';
        $to[] = $this->request->data['clientEmail'];
        $to[] = $this->request->data['coordinatorEmail'];
        $template = 'gc_change_version_status';
        $from = null;
        $sender = null;
        $emailFormat = 'html';
        $debug = false;
        $data = array();
        $data['fullImagePath'] = $imgPath;
        $return = $this->FebEmail->sendFastEmail($subject, $to, $template, $data, $from, $sender, $emailFormat, $debug);
    }
    
    public function setversionacceptancestatus() {
        
        $dirManager = new DirectoryManager();
        $response = array(
            'Status' => array(
                'success' => 0,
                'message' => 'Operacja niedozwolona'
            )
        );
        if ($this->request->is('post')) {
                                                       
            $user = $this->Auth->user();
            $role = $user['role'];
            if ($role == 'client' || $role == 'manager') {
                
//                if($this->request->data['Version']['acceptance_status'] == 1){
                    
//                }
 
                $versionId = $this->request->data['Version']['id'];
                $acceptanceStatus = $this->request->data['Version']['acceptance_status'];
                $version = $this->Version->find('first', array(
                    'conditions' => array(
                        'Version.id' => $versionId
                    )
                ));              
                
                $version['Version']['acceptance_status'] = $acceptanceStatus;
                $result = $this->Version->save($version);
                $view = $this->pView->findById($result['Version']['view_id']);
                $response['Status'] = array(
                    'success' => 1,
                    'View' => $view['pView']
                );
                
//                $this->Project->unbindModel(array('hasMany' => array('Category', 'pView')));
//                
//                $project = $this->Project->find('first', array(
//                        'conditions' => array(
//                            'Project.id' => $version['View']['project_id'],
//                        ),
//                        'fields' => array(
//                            'Project.id',
//                            'Project.manager_id',
//                            'Manager.email',
//                            'Client.email'
//                        )
//                    )
//                );

                
//                $fullVersionImagePath = $dirManager->storageDir . '/' . $version['Version']['image_path'];

                //JESLI KLIENT ZAAKCEPTOWAŁ WERSJĘ (czyli $acceptanceStatus == 1) TO W TYM MIEJSCU NALEŻY WYSŁAĆ DWA MAILE
                
                //pierwszy mail ma iść do klienta, drugi do koordynatora. oba informujące, o akceptacji wersji               
                
                //$fullVersionImagePath -> pełna ścieżka do zaakceptowanego pliku graficznego
                //$project['Manager']['email'] -> adres email do koordynatora
                //$project['Client']['email'] -> adres email do klienta
                
            }
        }
        $this->response->body(json_encode($response));
    }
    public function managers() {
        $managers = $this->User->find('all', array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'sections',
                    'alias' => 'Section',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Section.supervisor = User.id',        
                    )
                )
            ),
            'fields' => array(
                'User.id',
                'Profile.firstname',
                'Profile.surname',
                'Section.id',
                'Section.supervisor',               
            ),           
        ));

        //superAdmins
        
        $admins = $this->User->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'User.email' => 'admin@feb.net.pl',
            ),
            'joins' => array(
                array(
                    'table' => 'sections',
                    'alias' => 'Section',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Section.supervisor = User.id',        
                    )
                )
            ),
            'fields' => array(
                'User.id',
                'Profile.firstname',
                'Profile.surname',         
                'Section.id',
                'Section.supervisor',        
            ),           
        ));         

        $result = array_merge($managers, $admins);
        
        foreach ($result as $key => $value) {
            $result[$key]['Profile']['name'] = $result[$key]['Profile']['firstname'] . ' ' . $result[$key]['Profile']['surname'];
            unset($result[$key]['Profile']['firstname']);
            unset($result[$key]['Profile']['surname']);
            unset($result[$key]['Profile']['User']); 
        }
        
        $this->response->body(json_encode($result));
    } 
        
    /**
     * Lista komentarzy dla wersji
     *
     * @param int $versionId
     *            - id wersji
     *
     * @return json - lista komentarzy dla podanego id wersji
     */
    public function comments($versionId) {
        $comments = $this->Comment->find('all', array(
            'recursive' => 2,
            'conditions' => array(
                'Comment.version_id' => $versionId
            ),
            'order' => array(
                'Comment.created DESC'
            ),
            'contain' => array(
                'User' => array(
                    'Profile' => array(
                        'fields' => array(
                            'Profile.name',
                        )
                    ) 
                ),
                'Region' => array()
            )
        ));

        $this->response->body(json_encode($comments));
    }

    /**
     * Lista userów w stysemie z podziałem na role (Manager/Client)
     *
     * @return json - lista userków
     *
     */
    public function users() {
        
//        $users = $this->User->find('all', array(
//            'recursive' => 0,
//            'fields' => array(
//                'User.id',
//                //'User.role',
//                'Profile.firstname',
//                'Profile.surname'
//            )
//        ));
//        // zakodowane hasła nie są pokazywane na zewnątrz
//        foreach ($users as $key => $value) {
//            $users[$key]['Profile']['name'] = $users[$key]['Profile']['firstname'] . ' ' . $users[$key]['Profile']['surname'];
//            unset($users[$key]['Profile']['firstname']);
//            unset($users[$key]['Profile']['surname']);
//            unset($users[$key]['Profile']['User']); 
//        }

        $clients = $this->Client->find('all', array(
            
            'recursive' => -1,
            'fields' => array(
                'Client.id',
                'Client.name',
            )
            
        ));
        
        $clients2 = array();
        
        foreach($clients as $client){
            
            $clients2[] = array(
                'User' => array(
                    'id' => $client['Client']['id']
                ),
                'Profile' => array(
                    'name' => $client['Client']['name']
                ), 
            );
        }
        
//      print_r($users);
//      echo "<br><br><br>";
//      print_r($clients);
//      echo "<br><br><br>";
//      print_r($clients2);
//      die();

        $this->response->body(json_encode($clients2));
    }

    /**
     * Lista regionów (obszarów)
     *
     * @return json - lista regionów
     */
    public function regions($versionId) {
        $regions = $this->Region->find('all', array(
            'conditions' => array(
                'Region.version_id' => $versionId
            )
        ));
        $this->response->body(json_encode($regions));
    }

    /**
     * Zapis regionu w tabeli
     */
    public function saveregion() {
        if ($this->request->is('post')) {
            $region = $this->request->data;
            $region['Region']['user_id'] = $this->Auth->user('id');
            $this->Region->save($region);
            $id = $this->Region->getLastInsertId();
            $region['Region']['id'] = $id;
            $region['Status']['success'] = 1;
            $this->response->body(json_encode($region));
        }
    }
    public function deleteregion() {
        $response = array(
            'Status' => array(
                'success' => 0
            )
        );
        if ($this->request->is('post')) {
            try {
                $this->Region->deleteAll(array(
                    'Region.id' => $this->request->data('Region.id'),
                    'Region.user_id' => $this->Auth->User('id')
                ));
            } catch ( Exception $e ) {
                $response['Status']['message'] = $e->getMessage();
                $this->response->body(json_encode($response));
                return;
            }
        }
        $result = $this->Region->findById($this->request->data('Region.id'));
        if (!$result) {
            $response['Status']['success'] = 1;
        }
        $this->response->body(json_encode($response));
    }
    /**
     * Zapis komentarza
     */
    public function savecomment() {
        if ($this->request->is('post')) {
            $comment = $this->request->data;
            $region['Comment']['user_id'] = $this->Auth->user('id');
            $this->Comment->save($comment);
            $id = $this->Comment->getLastInsertId();
            $comment['Comment']['id'] = $id;
            $comment['Status']['success'] = 1;
            
//            $profile = $this->Profile->find('first', array(
//                    'conditions' => array(
//                        'Profile.user_id' => $comment['Comment']['user_id']
//                    ),
//                    'fields' => array(
//                        'Profile.name'
//                    )
//                )
//            );
//           
//            $comment['User']['Profile'] = $profile['Profile'];
            
            $this->response->body(json_encode($comment));
        }
    }

    /**
     * Zapis danych usera
     */
    public function saveuser() {
        $result = array('Status' => array('success' => 0));

        if($this->request->is('post')) {
            $user = $this->request->data;

            // jeśli podano hasło to dajemy do zaszyfrowania
            if($user['User']['clearpassword']!='') {
                $user['User']['password'] = $user['User']['clearpassword'];
            }

            // dla authentykacji username=email
            $user['User']['username'] = $user['User']['email'];

            $result = $this->User->save($user);
            if($result) {
                // tworzymy katalog na projekty dla klienta
                if($user['User']['role']=='client') {
                    $dirManager = new DirectoryManager();
                    $folderName = Utils::transliterate($user['User']['name']);
                    $dirManager->addAction(array('action'=>'create', 'new'=>$folderName));
                    $dirManager->processActions();
                }

                $result['Status']['success'] =1;
            }
        }
        $this->response->body(json_encode($result));
    }
    
    /**
     * Wysyłanie zaaktualizowanego profilu użytkownika do zmian - zatwierdzane przez Sekretariat.
     * 
     * @param string    $user_id    ID użytkownika
     * @param array     $profile    Dane użytkownika
     * 
     * @return bool                 True jeśli zapis się powiódł, false w przeciwnym wypadku
     */

    /**
     * Pobieranie nazwy katalogu projektów na podstawie klienta
     * 
     * @param int      $client_id           id klienta
     * @param string   $project_title       tytuł projektu         
     * 
     * @return string                       nazwa katalogu
     */
    private function __getProjectDir($client_id, $project_title) {
        
        $client = $this->User->find('first', array(
                'recursive' => 0,
                'conditions' => array(
                    'User.id' => $client_id
                ),
                'fields' => array(
                    'Profile.firstname',
                    'Profile.surname'
                )
            )
        );
        
        if(isset($client) && isset($client['Profile']) && isset($client['Profile']['firstname'])){
            
            $clientName = $client['Profile']['firstname'] . $client['Profile']['surname'];
        } else {
            
            $clientName = 'Default';
        }
        
        if(!$client) {
            
            $client = $this->B2BClient->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'B2BClient.id' => $client_id
                    ),
                    'fields' => array(
                        'B2BClient.id',
                        'B2BClient.name',
                    )
                )
            );
            
            $clientName = $client['B2BClient']['name'];
        }
        
        return Utils::transliterate($clientName . '/' . $project_title);
    }
    
    /**
     * Zapis danych projektu
     */
    public function saveproject() {
        $dirManager = new DirectoryManager();

        $result = array('Status' => array('success' => 0));

        if($this->request->is('post')) {
            
            $project = array();
            $project['Project'] = $this->request->data['Project'];

            if(isset($project['Project']['id'])) {
                // aktualizacja
                
                $pid = $project['Project']['id'];
                $projectDirOld = $dirManager->getProjectFolderName($this->Project, $pid);

                // dla nowej nazwy katalogu musimy odczytać nazwę klienta
                $projectDir = $this->__getProjectDir($project['Project']['client_id'], $project['Project']['title']);
                
                if($projectDir !== $projectDirOld) {
                    $dirManager->addAction(array(
                        'action' => 'rename',
                        'previous' => $projectDirOld,
                        'new' => $projectDir,
                    ));
                }

            } else {
                $projectDirOld = '';
//                $client = $this->User->findById($project['Project']['client_id']);
                
                $projectDir = $this->__getProjectDir($project['Project']['client_id'], $project['Project']['title']);
                
                $dirManager->addAction(array(
                    'action' => 'create',
                    'new' => $projectDir
                ));
                
                $project = $this->assignLeadAndClientProject($this->request->data, $project);
                              
            }
    
            
            $this->Project->save($project);
            if(!isset($project['Project']['id'])) {
                //$project = $this->Project->findById($this->Project->getLastInsertId());
                
                $project = $this->Project->find('first', array(
                    'recursive' => 5,
                    'conditions' => array(
                        'Project.id' => $this->Project->getLastInsertId()
                    ),
                    'contain' => array(
                        'Manager' => array(
                            'Profile' => array(
                                'fields' => array(
                                    'Profile.name'
                                )
                            )             
                        ),
                        'Client' => array(
                            'Profile' => array(
                                'fields' => array(
                                    'Profile.name'
                                )
                            )             
                        ),
                        'B2BClient' => array(
                            'fields' => array(
                                'B2BClient.id',
                                'B2BClient.name',
                                'B2BClient.email',
                            )
                        ),
                        'Category' => array(
                            'order' => array(
                                'Category.ordernum' => 'ASC',
                            ),               
                            'pView' => array(
                                'order' => array(
                                    'pView.ordernum' => 'ASC',
                                ),
                                'Version' => array(
                                    'order' => array(
                                        'Version.number' => 'DESC',
                                    ),
                                    'Region' => array(
                                        'Comment',
                                        'User'
                                    )
                                )
                            )
                        )
                    )
                ));
            }
            
            $dirManager->processActions();
            $result['Status']['success'] = 1;
            $result['Project'] = $project['Project'];
            $result['fullData'] = $project;
        }
        $this->response->body(json_encode($result));
    }

    /**
     * Przypisuje lead_id i client_project_id do nowego projektu graficznego
     * 
     * @param array $requestData           dane otrzymane z post
     * @param array $project               dane projektu do zapisu
     * @return        array            projekt z przypisanymi wartościami
     */
    public function assignLeadAndClientProject($requestData, $project){
        
        if(isset($this->request->data['lead_id']) && !isset($this->request->data['client_project_id'])){              
                
            $project['Project']['lead_id'] = $this->request->data['lead_id'];   
            
            $clientProject = $this->ClientProject->find('first', array(
                'conditions' => array(
                    'client_lead_id' => $this->request->data['lead_id']
                )
            ));
            
            if($clientProject){
                
                $project['Project']['client_project_id'] = $clientProject['ClientProject']['id'];
            }
        } 
        
        if(isset($this->request->data['client_project_id']) && !isset($this->request->data['lead_id'])){
            
            $project['Project']['client_project_id'] = $this->request->data['client_project_id'];
            
            $clientProject = $this->ClientProject->find('first', array(
                'conditions' => array(
                    'ClientProject.id' => $this->request->data['client_project_id']
                )
            ));
            
            if($clientProject){
                
                $project['Project']['lead_id'] = $clientProject['ClientProject']['client_lead_id'];
            }
        } 
        
        if(!isset($project['Project']['lead_id'])){
            
            $project['Project']['lead_id'] = 0;
        }
        
        if(!isset($project['Project']['client_project_id'])){
            
            $project['Project']['client_project_id'] = 0;
        }
        
        return $project;
    }
    
    public function savecategory() {
        $dirManager = new DirectoryManager();
        $result = array('Status' => array('success' => 0));
        if($this->request->is('post')) {
            $category = $this->request->data;
            if (isset($category['Category']['id'])) {
                $pid = $category['Category']['id'];
                $projectId = $category['Category']['project_id'];
                $categoryDirOld = $dirManager->getCategoryFolderName($this->Category, $pid);
                $categoryDir = Utils::transliterate( $dirManager->getProjectFolderName($this->Project, $projectId) . '/' . $category['Category']['title']);
                if($categoryDir != $categoryDirOld) {
                    $dirManager->addAction(array(
                        'action' => 'rename',
                        'previous' => $categoryDirOld,
                        'new' => $categoryDir
                    ));
                }
            } else {
                $categoryDirOld = '';
                $project = $this->Project->findById($category['Category']['project_id']);

                $categoryDir = Utils::transliterate($dirManager->getProjectFolderName($this->Project, $project['Project']['id']) . '/' . $category['Category']['title']);
                $dirManager->addAction(array(
                    'action' => 'create',
                    'new' => $categoryDir,
                ));

            }
            $this->Category->save($category);
            if(!isset($category['Category']['id'])) {
                $category = $this->Category->findById($this->Category->getLastInsertId());
                $category['Category']['ordernum'] = $category['Category']['id'];
                $this->Category->save($category);
            }
            $dirManager->processActions();
            $result['Status']['success'] = 1;
            $result['Category'] = $category['Category'];

        }
        $this->response->body(json_encode($result));
    }

    public function deletecategory() {
        $dirManager = new DirectoryManager();
        $result = array('Status' => array('success' => 0));
        if($this->request->is('post')) {
            $category = $this->request->data;
            
            $categoryDir = $dirManager->getCategoryFolderName($this->Category, $category['Category']['id']);
            
            $dirManager->addAction(array(
                'action' => 'delete',
                'dir' => $categoryDir,
            ));

            $dirManager->processActions();
            
            try {
                $deleted = $this->Category->delete($category['Category']['id']);
                if($deleted) {
                    $result['Status']['success'] = 1;
                }
            } catch (Exception $e) {
                $result['Status']['message'] = $e->getMessage();
            }
        }
        $this->response->body(json_encode($result));
    }

    public function saveview() {
		$dirManager = new DirectoryManager();
        $result = array('Status' => array('success' => 0));
        if($this->request->is('post')) {
            $view = $this->request->data;
            if (isset($view['pView']['id'])) {
                $pid = $view['pView']['id'];
                $projectId = $view['pView']['project_id'];
                $categoryId = $view['pView']['category_id'];

                $viewDirOld = $dirManager->getViewFolderName($this->pView, $pid);
                $viewDir = Utils::transliterate($dirManager->getCategoryFolderName($this->Category, $categoryId) . '/' . $view['pView']['name']);
                
                //print_r($viewDir);
                //print_r($viewDirOld);
                
                if($viewDir != $viewDirOld) {
                    $dirManager->addAction(array(
                        'action' => 'rename',
                        'previous' => $viewDirOld,
                        'new' => $viewDir
                    ));
                }
            } else {
                $viewDirOld = '';
                //$category = $this->Category->findById($view['View']['category_id']);
                $categoryId = $view['pView']['category_id'];
                $viewDir = Utils::transliterate($dirManager->getCategoryFolderName($this->Category, $categoryId) . '/' . $view['pView']['name']);
                $dirManager->addAction(array(
                    'action' => 'create',
                    'new' => $viewDir,
                ));
            }
            $this->pView->save($view);
            if(!isset($view['pView']['id'])) {
                $view = $this->pView->findById($this->pView->getLastInsertId());
                $view['pView']['ordernum'] = $view['pView']['id'];
                $this->pView->save($view);
            }
            $dirManager->processActions();
            $result['Status']['success'] = 1;
            $result['pView'] = $view['pView'];
        }
        $this->response->body(json_encode($result));
    }

    public function deleteview() {
        $dirManager = new DirectoryManager();
        $result = array('Status' => array('success' => 0));
        if($this->request->is('post')) {
            $view = $this->request->data;
            
            $viewDir = $dirManager->getViewFolderName($this->pView, $view['pView']['id']);
            
            $dirManager->addAction(array(
                'action' => 'delete',
                'dir' => $viewDir,
            ));

            $dirManager->processActions();
                    
            try {  
                $deleted = $this->pView->delete($view['pView']['id']);
                if($deleted) {
                    $result['Status']['success'] = 1;                    
                }
            } catch (Exception $e) {
                $result['Status']['message'] = $e->getMessage();
            }
        }
        $this->response->body(json_encode($result));
    }

    public function changecategoryorder() {
        $in = $this->request->input('json_decode');
        $cat1 = $this->Category->findById($in->categorySourceId);
        $cat2 = $this->Category->findById($in->categoryDestinationId);
        if($cat1 && $cat2) {
            $temp = $cat1['Category']['ordernum'];
            $cat1['Category']['ordernum'] = $cat2['Category']['ordernum'];
            $cat2['Category']['ordernum'] = $temp;
            $this->Category->save($cat1);
            $this->Category->save($cat2);
        }
    }

    public function changevieworder() {
        $in = $this->request->input('json_decode');
        $view1 = $this->pView->findById($in->viewSourceId);
        $view2 = $this->pView->findById($in->viewDestinationId);
        if($view1 && $view2) {
            $temp = $view1['pView']['ordernum'];
            $view1['pView']['ordernum'] = $view2['pView']['ordernum'];
            $view2['pView']['ordernum'] = $temp;
            $this->pView->save($view1);
            $this->pView->save($view2);
        }
    }
}
