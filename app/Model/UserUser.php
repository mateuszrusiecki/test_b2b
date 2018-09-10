<?php
App::uses('AppModel', 'Model');
/**
 * UserClient Model
 *
 * @property User $User
 */
class UserUser extends AppModel {
    
    public $actsAs = array('Containable');
     
    public $hasAndBelongsToMany = array(
         'UserGroup' => array(
            'joinTable' => 'user_groups_users',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'group_id',
         )
    );
    
    public $hasOne = array(
        'Profile' => array(
            'foreignKey' => 'user_id',
            'fields' => array(
                'Profile.id',
                'Profile.user_id',
                'Profile.name',
            )
        )
    );
    
    /**
     * Pomocnicza funkcja pobierająca programistów
     */
    public function getProgrammers(){   
        
        $allUsers = $this->find('all');
        $programmers = array();
        
        foreach($allUsers as $user){
            
            foreach($user['UserGroup'] as $userGroup){
                
                if($userGroup['alias'] == 'w_it' || $userGroup['alias'] == 'z_it'){
                    
                    $programmers[$user['UserUser']['id']] = $user['Profile']['name'];
                    break;
                }
                
            }
        }
        
        return $programmers;
    }
    
    public function getSecretariat(){
        $w_secretariat = $this->query('SELECT user_users.id FROM user_users
        JOIN user_groups_users as ugu ON user_users.id = ugu.user_id
        JOIN user_groups as ug ON ug.id = ugu.group_id
        WHERE ug.alias = "w_secretariat"');
        return $w_secretariat;
    }
    
}