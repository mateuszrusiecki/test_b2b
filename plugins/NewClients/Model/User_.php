<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('Model', 'NewClientsAppModel');
class User extends NewClientsAppModel {
    
    public $actsAs = array('Containable');
    
    public $useTable = 'user_users';
    
    public $hasOne = array('Profile' => array(
        'className' => 'Profile',
        'foreignKey' => 'user_id',
    ));
    
    public function beforeSave($options = array()) {
        parent::beforeSave($options);

        $role = $this->data[$this->alias]['role'];

        if (isset($this->data[$this->alias]['password'])) {
            $pwd = $this->data[$this->alias]['password'];
            $passwordHasher = new BlowfishPasswordHasher();
            $hashedPwd = $passwordHasher->hash($pwd);
            $this->data[$this->alias]['password'] = $hashedPwd;

            // dla roli 'client' zapisujemy hasło otwartym tekstem
            if ($role == 'client') {
                $this->data[$this->alias]['clearpassword'] = $pwd;
            } else {
                $this->data[$this->alias]['clearpassword'] = null;
            }
        }
        return true;
    }
//    public function afterFind($result, $primary = false) {
//        // Wywalamy hasło zakodowane z rezultatu w złączeniach
//        if (!$primary) {
//            foreach ( $result as $key => $item ) {
//                if (is_array($item)) {
//                    $keys = array_keys($item);
//                    $aKey = $keys[0];
//                    unset($result[$key][$aKey]['password']);
//                }
//            }
//        }
//        return parent::afterFind($result, $primary);
//    }
}