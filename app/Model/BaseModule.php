<?php

App::uses('AppModel', 'Model');

/**
 * BaseModule Model
 */
class BaseModule extends AppModel
{
    public $actsAs = array('Containable');
    
    public $belongsTo = array(
        'ClientProject' => array(
            'className' => 'ClientProject',
            'foreignKey' => 'client_project_id',
            'fields' => array(
                'ClientProject.id',
                'ClientProject.name',
                'ClientProject.start_project',
                'ClientProject.end_project',
            )
        ),
        'Coordinator' => array(
            'className' => 'UserUser',
            'foreignKey' => 'coordinator_contact',
        ),
        'Programmer' => array(
            'className' => 'UserUser',
            'foreignKey' => 'programmer_contact',
        )
    );
    
    /**
     * Lista wszystkich kalendarzy
     * 
     * @return array        lista kalendarzy
     */
    public function getBaseModules($client_project_id = null){
        
        $conditions = array();
        
        if($client_project_id != null){
            
            $conditions['BaseModule.client_project_id'] = $client_project_id;
        }
        
        return $this->find('all', array(
              'conditions' => $conditions,
              'contain' => array(
                  'ClientProject',
                  'Coordinator' => array(
                      'Profile' => array(
                          'fields' => array(
                              'Profile.name',
                          )
                      ),
                      'fields' => array(
                          'Coordinator.id',
                          'Coordinator.email',
                      )
                  ),
                  'Programmer' => array(
                      'Profile' => array(
                          'fields' => array(
                              'Profile.name',
                          )
                      ),
                      'fields' => array(
                          'Programmer.id',
                          'Programmer.email',
                      )
                  ),
              )
        ));
    }
}
