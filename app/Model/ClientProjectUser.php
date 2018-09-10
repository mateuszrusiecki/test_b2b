<?php
App::uses('AppModel', 'Model');
/**
 * ClientProjectUser Model
 *
 */
class ClientProjectUser extends AppModel {
    
    
    public $components = array('CheckAccess'); //Slug.Slug
    
    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
   public function beforeValidate($options = array())
    {
        
    }

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ClientProject' => array(
            'className' => 'ClientProject',
            'foreignKey' => 'client_project_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Profile' => array(
			'className' => 'Profile',
			'foreignKey' => '',
			'conditions' => array('Profile.user_id = ClientProjectUser.user_id'),
			'fields' => 'firstname,surname',
			'order' => ''
        )
    );
    /**
     * Konstruktor klasy modelu
     * 
     * @param int $id
     * @param array $table
     * @param bool $ds 
     */
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        //$this->virtualFields = array('fullname' => "CONCAT({$this->alias}.field_1, ' ', {$this->alias}.field_2)");
    }
    
    /**
     * Funkcja sprawdzająca czy user może zobaczyć dany projekt  
     * 
     * @param type $user_id   id usera 
     * @param type $project_id  id projektu 
     * @return type bool    true- może zobaczyć, false, zablokuj
     */
    public function checkUserProjectAccess($project_id, $user_id){
        if(empty($user_id) || empty($project_id)){
            return false;
        }
        $this->Section = ClassRegistry::init('Section');
        $this->ClientProject = ClassRegistry::init('ClientProject');
        
        $params = array();
        $params['conditions'] = array(
            'ClientProjectUser.client_project_id' => $project_id,
            'ClientProjectUser.user_id' => $user_id
        );
        $params['recursive'] = -1;
        
        $checkNormalUser = $this->find('first', $params);    
        
        if(!empty($checkNormalUser)){
           $checkNormalUser = true;
        }
        
        $isCoordinator = $this->Section->checkIsCoordinator($user_id);
        $isCEO =  $this->Section->checkUserIsCEO($user_id);
        $isUserAuthorManager  = $this->ClientProject->checkUserAuthorManager($project_id,$user_id);
		
        
        // to do sprawdzić  czy jest osoba z sekretariatu i z zarządu 
        
        if(in_array(true, array($checkNormalUser,$isCoordinator,$isCEO,$isUserAuthorManager))){
            return true;
        }else{
            return false;
        }
        
    }
    
    /*
     * metoda wyszukuje projekty do których użytkownik jest przydzielony
     */
    public function getUserProjects($user_id){
        if(empty($user_id)){
            return false;
        }
        
        $params['conditions'] = array(
            'ClientProjectUser.user_id' => $user_id,
            'ClientProjectUser.client_project_id > ' => 0
        );
        $params['recursive'] = -1;
        $params['joins'][] = array(
            'alias' => 'ClientProject',
            'table' => 'client_projects',
            'type' => 'LEFT',
            'conditions' => array(
                //'ClientProject.id' => $project_id,
                'ClientProject.id = ClientProjectUser.client_project_id',
            )
        );
        $params['fields'][] = 'ClientProject.name';
        $params['fields'][] = 'ClientProject.id';
        //$params['fields'][] = 'ClientProjectUser.id';
        
        return $this->find('all', $params);  
    }
    
    
    
    
    
}
