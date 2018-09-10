<?php
App::uses('AppModel', 'Model');
/**
 * TextDocument Model
 *
 */
class TextDocument extends AppModel {
    
    public $actsAs = array('Containable');
    
    public $belongsTo = array(
        'ClientLead' => array(
            'className' => 'ClientLead',
            'foreignKey' => 'lead_id',
        )
    );
            
    /**
     * Funkcja pobierająca dokumenty tekstowe do listy
     */
    public function getTextDocuments($lead_id = null){
        
        if($lead_id == null){
            
            return $this->find('all', array('order' => 'TextDocument.name'));
        } else {
            
            return $this->find('all', array(
               'order' => 'TextDocument.name',
               'conditions' => array(
                    'lead_id' => $lead_id
               ) 
            ));
        }
    }   
    

    
    /** 
     * Funkcja ustawiająca w danych do zapisu modelu domyślne wartości kilku pól
     * 
     * @param Array $requestData       dane do zapisu modelu
     * 
     * @return Array      uzupełnione request data 
    */
    public function setDefaultFields($requestData, $user_id){
        
        $requestData['TextDocument']['user_id'] = $user_id;
        $requestData['TextDocument']['pdf_file'] = '';
        $requestData['TextDocument']['doc_file'] = '';   
        
        return $requestData;
    }
}  