<?php
App::uses('Model', 'NewClientsAppModel');

class Project extends NewClientsAppModel {
    public $actsAs = array('Containable');

    public $belongsTo = array(
        'Manager' => array(
            'className' => 'NewClients.User',
            'foreignKey' => 'manager_id',
        ),
        'Client' => array(
            'className' => 'NewClients.User',
            'foreignKey' => 'client_id',
        ),
        'B2BClient' => array(
            'className' => 'NewClients.B2BClient',
            'foreignKey' => 'client_id',
        )
    );

    public $hasMany = array(
        'NewClients.Category',
        'NewClients.pView',
    );
    
    /**
     * Przy tworzeniu projektu z jakiegoś leada aktualizujemy projekty graficzne w tabeli modułu GC
     * 
     * @param int $lead_id                  id_leada do którego przypisane są projekty graficzne
     * @param int $project_id               id projektu które ma być przypisane do wszystkich znalezionych projektów graficznych
     * 
     * $return mixed                        false, jeśli conf
     */
    public function actualizeGraphicsProjects($lead_id=null, $project_id=null){    
        
       
        print_r($lead_id); echo ' ';
        print_r($project_id);die();
        
        $graphicProjects = $this->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'lead_id' => $lead_id
            )
        ));
        
        die();
        foreach($graphicProjects as $graphicProject){
            
            $this->id = $graphicProject['Project']['id'];
            $this->saveField('client_project_id', $project_id);
        }
    }
}