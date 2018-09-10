<?php

App::uses('AppModel', 'Model');

/**
 * BaseProject Model
 */
class BaseProject extends AppModel
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
    public function getBaseProjects(){
        
        $baseProjects = $this->find('all', array(
              'contain' => array(
                  'ClientProject' => array(
                      'BaseModule' => array(
                          'fields' => array(
                              'BaseModule.id',
                              'BaseModule.client_project_id',
                              //'BaseModule.name',
                          )
                      )
                  ),
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
                  )
              )
        ));
        
        foreach($baseProjects as $key => $baseProject){
            
            $baseProjects[$key]['BaseProject']['description_no_html'] = str_replace('&nbsp;', ' ', strip_tags($baseProject['BaseProject']['description']));
        }      
        
        return $baseProjects;
    }
    
    
    public function findByClientProjectId($lient_project_id = null){
        if(empty($lient_project_id)){
            return false;
        }
        
        $params['recursive'] = -1;
        $params['conditions'] = array(
            'client_project_id' => $lient_project_id
        );
        
        return $this->find('first',$params);
    }
}
