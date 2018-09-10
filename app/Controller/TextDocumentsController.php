<?php

App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');

/**
 * TextDocuments Controller
 */
class TextDocumentsController extends AppController
{

    public $components = array('FebEmail');
    
    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('createNewPad', 'getTextDocument', 'send_share_links', 'send_share_link_email', 'getPadsHtml', 'get_doc', 'get_pdf'));
    }
    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index()
    {
        $title = $subtitle = "Dokumenty tekstowe";     
        
        $session = $this->Session->read();
        
        $user_permission = $session['user_permission'];
        
        if($this->request->is('post')){          
            
            $textdocuments = $this->TextDocument->getTextDocuments($this->request->data['lead_id']);       
            
            $this->set(compact('textdocuments'));
            $this->set('_serialize', array('textdocuments'));  
        } else {        
            
            $this->set(compact('title', 'subtitle','user_permission'));
        }
    }
    
    /**
     * Usuwanie dokumentu tekstowego
     */
    public function delete(){       
        
        $this->TextDocument->delete($this->request->data['id'], false);               
        $this->autoRender = false;
    }
    
    /**
     * Akcja tworzenia nowego dokumentu tekstowego
     * 
     * @return void
     */
    public function create($lead_id = null){

        /*
         * @todo
         * 
         * obsługa tc z leada
         * na liście leadów(elements/clients/lead_list) przy każdym leadzie jest link to tc: <a href="/text_documents/update/null/<?php echo $lead['ClientLead']['id']; ?>"
         * nie zawiera on id tc bo w leadzie nie ma takiej informacji
         * z leada do tej metody przechodzimy przesyłając lead_id - na tej podstawie trzeba wyszukać odpowiedni dokument a jeśli go nie ma to przekierować do akcji tworzenia nowego dokumentu
         * 
         */
        $title = $subtitle = "Nowy dokument tekstowy";       
        $textdocument = array();
        
        if ($this->request->is('post'))
        {           
            $this->TextDocument->create();         
            $requestData = $this->request->data;
        
            $requestData = $this->TextDocument->setDefaultFields($requestData, $this->Auth->user('id')); 
                    
            if($lead_id != null){
                $requestData['TextDocument']['lead_id'] = $lead_id;
            } else {

                $requestData['TextDocument']['lead_id'] = 0;
            }
            
            if ($this->TextDocument->save($requestData))
            {
                
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                
                if($lead_id != null){
                    
                    $this->redirect(array('action' => 'index', $lead_id));
                } else {
                    
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                
                $textdocument = $requestData;
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        
        $this->set(compact('title', 'subtitle', 'textdocument', 'lead_id'));
    }
    
    /**
     * Akcja edycji dokumentu tekstowego
     * 
     * @return void
     */
    public function update($text_document_id = null, $lead_id = null){
        $this->loadModel('Profile');
        /*
         * @todo
         * 
         * obsługa TC z listy leadów i z leada
         * na liście leadów(elements/clients/lead_list) przy każdym leadzie jest link to tc: <a href="/text_documents/update/null/<?php echo $lead['ClientLead']['id']; ?>"
         * nie zawiera on id tc bo w leadzie nie ma takiej informacji
         * z leada do tej metody przechodzimy przesyłając lead_id - na tej podstawie trzeba wyszukać odpowiedni dokument a jeśli go nie ma to przekierować do akcji tworzenia nowego dokumentu
         * 
         * obsługa TC z listy projektów i z projektu
         * analogicznie jak wyżej ale tu trzeba się zastanowić czy dodać parametr do tej funkcji - client_project_id czy
         */
        
        if($lead_id != null){
            $requestData['TextDocument']['lead_id'] = $lead_id;
        } else {
            $requestData['TextDocument']['lead_id'] = 0;
        }
        
        $this->TextDocument->id = $text_document_id;
        
        if (!$this->TextDocument->exists()){
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        
        $title = $subtitle = "Dokument tekstowy - edycja";       
        
        $textdocument = $this->TextDocument->find('first', array(
                'conditions' => array(
                    'TextDocument.id' => $text_document_id,
                )
            )
        );
        
        
        // sprawdzanie  czy  nie jest autorem i dokument jest zablokowany 
        if($textdocument['TextDocument']['user_id'] != $this->Session->read('Auth.User.id') && $textdocument['TextDocument']['share_block'] == 1){
              $this->redirect('/403');
        }
        
        $documentAuthor = $this->Profile->getProfile($textdocument['TextDocument']['user_id']);
                
        $user_permission = $this->Session->read('user_permission');
        
        if($this->request->is('post'))
        {     
            
            $requestData = $this->request->data;
            $requestData['TextDocument']['id'] = $text_document_id;
            
            $requestData = $this->TextDocument->setDefaultFields($requestData, $this->Auth->user('id'));                            
            
            if ($this->TextDocument->save($requestData))
            {
                
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'), 'flash/success');
                if(isset($this->request->data['TextDocument']['current_lead_id'])){
                    
                    $this->redirect(array('action' => 'index', $this->request->data['TextDocument']['current_lead_id']));
                } else {
                    
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                
                $textdocument = $requestData;
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
        
        
        $this->set(compact('title', 'subtitle', 'textdocument', 'lead_id', 'documentAuthor', 'user_permission'));
    }
    
    
    
    /**
     * Akcja edycji dokumentu tekstowego z leada lub listy leadów
     * 
     * @return void
     */
    public function update_from_lead($lead_id = null){
       
        /*
         * @todo
         * 
         * obsługa TC z listy leadów i z leada
         * na liście leadów(elements/clients/lead_list) przy każdym leadzie jest link to tc: <a href="/text_documents/update/null/<?php echo $lead['ClientLead']['id']; ?>"
         * nie zawiera on id tc bo w leadzie nie ma takiej informacji
         * z leada do tej metody przechodzimy przesyłając lead_id - na tej podstawie trzeba wyszukać odpowiedni dokument a jeśli go nie ma to przekierować do akcji tworzenia nowego dokumentu
         * 
         */
        $this->loadModel('ClientLead');
        $client_lead = $this->ClientLead->findById($lead_id);
        if (empty($client_lead)){ //sprawdzam czy lead istnieje
            throw new NotFoundException(__d('cms', 'Nie poprawny lead.'));
        }
        
        $textdocument = $this->TextDocument->find('first', array('conditions' => array('TextDocument.lead_id' => $lead_id)));
       
        if(empty($textdocument)){
            $this->redirect(array('action' => 'create')); //jeśli dokument nie istnieje to tworzę nowy
        } else {
            $this->redirect(array('action' => 'update',$textdocument['TextDocument']['id']));
        }
        
    }
    
    /**
     * Akcja edycji dokumentu tekstowego z projektu lub listy projektów
     * 
     * @return void
     */
    public function update_from_client_project($client_project_id = null){
       
        /*
         * @todo
         * 
         * obsługa TC z listy projektów i z projektu
         * analogicznie jak update_from_lead
         */
        $this->loadModel('ClientProject');
        $client_project = $this->ClientProject->findById($client_project_id);
        if (empty($client_project)){ //sprawdzam czy projekt istnieje
            throw new NotFoundException(__d('cms', 'Nie poprawny projekt.'));
        }
        
        $textdocument = $this->TextDocument->find('first', array('conditions' => array('TextDocument.client_project_id' => $client_project_id)));
       
        if(empty($textdocument)){
            $this->redirect(array('action' => 'create')); //jeśli dokument nie istnieje to tworzę nowy
        }
        
        if(empty($textdocument)){
            $this->redirect(array('action' => 'create')); //jeśli dokument nie istnieje to tworzę nowy
        } else {
            $this->redirect(array('action' => 'update', $textdocument['TextDocument']['id']));
        }
    }
    
    /**
     * Pobiera z bazy dokument tekstowy na podstawie id i zwraca jako json
     */
    public function getTextDocument(){
        
        $this->layout = 'ajax';
        $text_document = $this->TextDocument->find('first', array(       
            'conditions' => array(
                'TextDocument.id' => $this->request->data['text_document_id'],
            ),    
            'contain' => array(
                'ClientLead' => array(
                    'fields' => array(
                        'ClientLead.id',
                        'ClientLead.client_id',
                    ),
                    'Client' => array(
                        'fields' => array(
                            'Client.id',
                            'Client.email'
                        )
                    )
                )
            )
        ));
        
        echo json_encode($text_document);
        $this->render(false);
    } 
    
    public function createNewPad(){
        
        echo file_get_contents('http://144.76.249.142:9001/api/1/createPad?padID=' . $this->request->data['pad_id'] . '&text=&apikey=9cf2380cb88049d64df541f9de4a8368ce2f6b4ad578ed255a345172b6fdc318');
        exit();
    }
    
    /**
     * Funkcja zwracająca zawartość danego pada tekstowego
     * 
     * @param type $padId             id pada 
     * @return html                   zawartość tekstowego pada
     */
    public function getPadsHtml($padId = null){
        
        return file_get_contents('http://144.76.249.142:9001/api/1/getHTML?padID=' . $padId . '&apikey=9cf2380cb88049d64df541f9de4a8368ce2f6b4ad578ed255a345172b6fdc318');
    }
    
    /**
     * Generuje i zwraca plik PDF
     */
    public function get_pdf(){
        
        $padContent = json_decode($this->getPadsHtml($_GET['padId']), true);
        
        $padContent = $padContent['data']['html'];
                
        $this->layout = 'textdocument';   
        
        $this->pdfConfig = array(
            'filename' => 'Dokument_' . $_GET['padId'].'.pdf',
        );
        
        $this->set(compact('padContent'));

        Configure::write('CakePdf.download', true);
    }
    
    /**
     * Generuje i zwraca plik DOC
     */
    public function get_doc(){
        
        $padContent = json_decode($this->getPadsHtml($_GET['padId']), true);
        
        $padContent = $padContent['data']['html'];
        
        $documentTitle = 'Dokument_' . $_GET['padId'];
        $documentContent = $padContent;
        
        $this->layout = false;
        $this->set(compact('documentTitle', 'documentContent'));
    }
    
    /**
     * Funkcja wysyłająca mail powiadamiający z linkiem do współdzielenia dokumentu tekstowego
     */
    public function send_share_link_email($email, $share_link){
        
        $subject = 'Link do współdzielenia dokumentu tekstowego';
        $to = $email;
        $template = 'share_link_email';
        $from = null;
        $sender = null;
        $emailFormat = 'html';
        $debug = false;
        $data['share_link'] = $share_link;
        $return = $this->FebEmail->sendFastEmail($subject, $to, $template, $data, $from, $sender, $emailFormat, $debug);
        $this->FebEmail->reset();
    }
    
    /**
     * Akcja wysyłająca maile z linkiem do współdzielenia dokumentu
     */
    public function send_share_links(){

        $this->send_share_link_email($this->request->data['mailToClient'], $this->request->data['share_link']);
        
        if(isset($this->request->data['email'])){
            
            foreach($this->request->data['email'] as $email){
            
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                    $this->send_share_link_email($email, $this->request->data['share_link']);
                }
            }
        }       
        
        $this->Session->setFlash(__d('public', 'Powiadomienie wysłano.'), 'flash/success');
        
        if(isset($this->request->data['lead_id'])){
            
            $this->redirect(array('action' => 'update', $this->request->data['text_document_id'], $this->request->data['lead_id'])); //jeśli dokument nie istnieje to tworzę nowy
        } else {
            
            $this->redirect(array('action' => 'update', $this->request->data['text_document_id']));
        }
    }
}