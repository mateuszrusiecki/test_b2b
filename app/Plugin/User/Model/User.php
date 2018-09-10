<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('ComponentCollection', 'Controller');

/**
 * Profile User
 *
 * @property    User $User
 * @package     b2b
 */
class User extends AppModel
{

    var $name = 'User';
    var $displayField = 'email';
    //var $actsAs = array('Image.Upload', 'Modification.Modification');
//    var $useTable = 'phpbb_users';
    public $tablePrefix = 'user_';
//    var $primaryKey = 'user_id';
//    var $displayField = 'username';
    public $hasOne = 'Profile';
    var $validate = array(
        'email' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Podaj prawidłowy adres email',
            ),
            'uniqe' => array(
                'rule' => 'isUnique',
                'message' => 'Ten adres jest już zarejestrowany w naszej bazie'
            )
        ),
//        'name' => array(
//            'isUnique' => array(
//                'rule' => 'isUnique',
//                'message' => 'Ten login jest już zajęty, wybierz inny'
//            ),
//        ),
        'newpassword' => array(
            'lenght' => array(
                'rule' => array('minLength', 5),
                'message' => 'Hasło musi zawierać minimum 5 znaków',
            ),
            'equal' => array(
                'rule' => 'validatePassword',
                'message' => 'Hasła wpisane w oba pola nie są takie same.',
            )
        ),
//        'rules' => array(
//            'rule' => array('comparison', '!=', 0),
//            'message' => 'Nie zaakceptowałeś regulaminu serwisu',
//        //'on' => 'create'
//        ),
        'avatar' => array(
            //mime nie działa bo wymaga włączonego rozszerzenie php_fileinfo
//            'mime' => array(
//                'rule' => array('validateMime', 'image'),
//                'message' => 'Ten formularz akceptuje jedynie pliki graficzne (jpeg, gif, png)'
//            ),
//            'upload' => array(
//                'rule' => 'validateUpload'
//            )
        )
    );
    var $hasAndBelongsToMany = array(
        'Group' => array(
            'className' => 'User.Group',
            'joinTable' => 'user_groups_users',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'group_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'Section' => array(
            'className' => 'Section',
            'joinTable' => 'user_sections',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'section_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'Permission' => array(
            'className' => 'User.Permission',
//			'joinTable' => 'requesters_permissions',
            'with' => 'User.RequestersPermission',
            'foreignKey' => 'row_id',
            'associationForeignKey' => 'permission_id',
            'unique' => true,
            'conditions' => array('RequestersPermission.model' => 'User'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );

    /**
     * Serializacja pól PermissionGroup
     * 
     * @return boolean 
     */
    function beforeSave($options = null)
    {
        if (isSet($this->data['PermissionGroup']))
        {
            $this->data[$this->name]['permission_groups'] = json_encode($this->data['PermissionGroup']);
        }
        return true;
    }

    /**
     * Logika powiązań z modelem RequestersPermission, usuwanie odznaczonych
     * oraz zapisywanie zaznaczonych uprawnień, w chwili obecnym ich stanie
     * 
     * @param type $created
     * @return boolean
     * @throws ErrorException 
     */
    function afterSave($created, $options = array())
    {
        if (isSet($this->data['PermissionGroup']))
        {
            $this->data[$this->name]['permission_groups'] = json_encode($this->data['PermissionGroup']);

            $params['conditions']['Permission.permission_group_id'] = $this->data['PermissionGroup']['PermissionGroup'];
            $params['fields'] = array('Permission.id');
            $permissions = $this->Permission->PermissionGroup->Permission->find('list', $params);

            $params = array();
            $params['conditions']['RequestersPermission.model'] = $this->name;
            $params['conditions']['RequestersPermission.row_id'] = $this->data[$this->name]['id'];
            $params['fields'] = array('RequestersPermission.permission_id');
            $requestersPermissionsToDelete = $this->Permission->RequestersPermission->find('list', $params);
            if (!empty($requestersPermissionsToDelete))
            {
                if (!$this->Permission->RequestersPermission->deleteAll(array('RequestersPermission.permission_id' => $requestersPermissionsToDelete), false))
                {
                    throw new ErrorException(__d('cms', 'Krytyczny błąd podczas usuwania uprawnień'));
                }
            }
            if (!empty($permissions))
            {
                $toSave['RequestersPermission']['model'] = $this->name;
                $toSave['RequestersPermission']['row_id'] = $this->data[$this->name]['id'];
                foreach ($permissions as $permissionId)
                {
                    $toSave['RequestersPermission']['permission_id'] = $permissionId;
                    $this->Permission->RequestersPermission->create();
                    if (!$this->Permission->RequestersPermission->save($toSave))
                    {
                        throw new ErrorException(__d('cms', 'Krytyczny błąd podczas zapisywania uprawnień (odznaczone uprawnienia zostały już usunięte)'));
                    }
                }
            }
            unset($this->data['PermissionGroup']);
        }
        return true;
    }

    /**
     * Deserializacja pól PermissionGroup
     * 
     * @param type $dates
     * @return type 
     */
    public function afterFind($dates = null, $primary = null)
    {
        foreach ($dates as &$data)
        {
            if (isSet($data[$this->name]['permission_groups']))
            {
                if ($data[$this->name]['permission_groups'] == null)
                {
                    $data['PermissionGroup']['PermissionGroup'] = array();
                } else
                {
                    $data['PermissionGroup'] = json_decode($data[$this->name]['permission_groups'], true);
                    if (empty($data['PermissionGroup']['PermissionGroup']))
                    {
                        $data['PermissionGroup']['PermissionGroup'] = array();
                    }
                }
            } else
            {
                if (!empty($data['PermissionGroup']['PermissionGroup']))
                {
                    $data['PermissionGroup']['PermissionGroup'] = array();
                }
            }
        }
        return $dates;
    }

    function beforeValidate($options = null)
    {

        if (!empty($this->data['User']))
        {
            foreach ($this->data['User'] as $key => &$field)
            {
                if (is_string($field) and ! in_array($key, array('newpassword', 'confirmpassword')))
                {
                    $field = trim($field);
                }
            }
        }
        return true;
    }

    /**
     *  Sprawdzenie zgodnosci hasla z powtorzeniem hasla
     * 
     * @param type $value
     * @param type $params
     * @return boolean 
     */
    function validatePassword($value = null, $params = null)
    {
        if (isset($this->data['User']['newpassword'], $this->data['User']['confirmpassword']) && $this->data['User']['newpassword'] !== $this->data['User']['confirmpassword'])
        {
            $this->invalidate('confirmpassword', ' ');
            return false;
        }
        return true;
    }

    /**
     * Sprawdza poprawność hash'a'
     * 
     * @param type $id
     * @param type $hash
     * @return boolean 
     */
    function checkResetPassHash($id, $hash)
    {
        $userData = $this->read('modified', $id);
        //link wazny tylko 2 godziny
        if (strtotime('+2 hours', strtotime($userData['User']['modified'])) < time())
        {
            return false;
        }
        //porownie hash z tym co jest w bazie
        $compare = Security::hash($id . $userData['User']['modified'], null, true);
        if ($compare == $hash)
        {
            return true;
        } else
        {
            return false;
        }
    }

    /**
     * Zwraca link do zmiany hasła
     * 
     * @param type $email
     * @param type $modified
     * @return type 
     */
    function createResetPassLink($id = null, $modified = null)
    {
        if (empty($id) || empty($modified))
        {
            return false;
        }
        $link = array('controller' => 'users', 'action' => 'new_pass', $id);
        $link[] = Security::hash($id . $modified, null, true);
        return $link;
    }

    /**
     * Funkcja zwraca IP uzytkownika, serwera PROXY i host
     * 
     * @return string 
     */
    function getUserIP()
    {
        $userIP = '';

        // Uzytkownik wchodzi poprzez PROXY
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $userIP .= 'IP:' . $_SERVER['HTTP_X_FORWARDED_FOR'] . ', PROXY:' . $_SERVER['REMOTE_ADDR'] . ', HOST: ' . @gethostbyaddr($_SERVER['HTTP_X_FORWARDED_FOR']);
        } else
        {
            // Uzytkownik wszedl bez serwera PROXY
            $userIP .= 'IP:' . $_SERVER['REMOTE_ADDR'] . ', HOST: ' . @gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        return $userIP;
    }

    function logAction($action = null, $id = null, $login = null, $email = null, $browser = null)
    {

        App::uses('UsersLog', 'User.Model');
        $this->UsersLog = new UsersLog();
        $data['UsersLog']['user_id'] = ($id === null) ? $this->id : $id;

        if ($action != null)
        {
            $data['UsersLog']['action'] = $action;
        }
        if ($login != null)
        {
            $data['UsersLog']['login'] = $login;
        }
        if (!empty($id))
        {
            $user = $this->find('first', array('conditions' => array('User.' . $this->primaryKey => $id)));
            $data['UsersLog'][$this->displayField] = $user['User'][$this->displayField];
            $email = $user['User']['email'];
        }
        if ($email != null)
        {
            $data['UsersLog']['email'] = $email;
        }
        if (!empty($browser))
        {
            $data['UsersLog']['browser'] = $browser;
        }

        $this->UsersLog->create();
        return $this->UsersLog->save($data);
    }

    /**
     * Generate salt for hash generation 
     * 
     * @param type $input
     * @param type $itoa64
     * @param int $iteration_count_log2
     * @return type 
     */
    private function _hash_gensalt_private($input, $itoa64, $iteration_count_log2 = 6)
    {
        if ($iteration_count_log2 < 4 || $iteration_count_log2 > 31)
        {
            $iteration_count_log2 = 8;
        }
        $output = '$H$';
        $output .= $itoa64 [min($iteration_count_log2 + ((PHP_VERSION >= 5) ? 5 : 3), 30)];
        $output .= $this->_hash_encode64($input, 6, $itoa64);
        return $output;
    }

    /**
     * Encode hash 
     * 
     * @param type $input
     * @param type $count
     * @param type $itoa64
     * @return type 
     */
    private function _hash_encode64($input, $count, $itoa64)
    {
        $output = '';
        $i = 0;
        do
        {
            $value = ord($input [$i++]);
            $output .= $itoa64 [$value & 0x3f];
            if ($i < $count)
            {
                $value |= ord($input [$i]) << 8;
            }
            $output .= $itoa64 [($value >> 6) & 0x3f];
            if ($i++ >= $count)
            {
                break;
            }
            if ($i < $count)
            {
                $value |= ord($input [$i]) << 16;
            }
            $output .= $itoa64 [($value >> 12) & 0x3f];
            if ($i++ >= $count)
            {
                break;
            }
            $output .= $itoa64 [($value >> 18) & 0x3f];
        } while ($i < $count);
        return $output;
    }

    /**
     * The crypt function/replacement 
     * 
     * @param type $password
     * @param type $setting
     * @param type $itoa64
     * @return string 
     */
    private function _hash_crypt_private($password, $setting, $itoa64)
    {
        $output = '*';
        // Check for correct hash 
        if (substr($setting, 0, 3) != '$H$')
        {
            return $output;
        }
        $count_log2 = strpos($itoa64, $setting [3]);
        if ($count_log2 < 7 || $count_log2 > 30)
        {
            return $output;
        }
        $count = 1 << $count_log2;
        $salt = substr($setting, 4, 8);
        if (strlen($salt) != 8)
        {
            return $output;
        }
        /**
         * We're kind of forced to use MD5 here since it's the only 
         * cryptographic primitive available in all versions of PHP 
         * currently in use.  To implement our own low-level crypto 
         * in PHP would result in much worse performance and 
         * consequently in lower iteration counts and hashes that are 
         * quicker to crack (by non-PHP code). 
         */
        if (PHP_VERSION >= 5)
        {
            $hash = md5($salt . $password, true);
            do
            {
                $hash = md5($hash . $password, true);
            } while (--$count);
        } else
        {
            $hash = pack('H*', md5($salt . $password));
            do
            {
                $hash = pack('H*', md5($hash . $password));
            } while (--$count);
        }
        $output = substr($setting, 0, 12);
        $output .= $this->_hash_encode64($hash, 16, $itoa64);
        return $output;
    }

//    function utf8_clean_string($text)
//    {
//        static $homographs = array();
//        if (empty($homographs))
//        {
//            $homographs = include(WWW_ROOT . 'confusables.php');
//        }
//        $text = strtr($text, $homographs);
//        // Other control characters
//        $text = preg_replace('#(?:[\x00-\x1F\x7F]+|(?:\xC2[\x80-\x9F])+)#', '', $text);
//        // we need to reduce multiple spaces to a single one
//        $text = preg_replace('# {2,}#', ' ', $text);
//        $text = strtolower($text);
//        // we can use trim here as all the other space characters should have been turned
//        // into normal ASCII spaces by now
//        return trim($text);
//    }

    public function unique_id($extra = 'c')
    {
        static $dss_seeded = false;
        $val = microtime();
        $val = md5($val);
        $dss_seeded = true;
        return substr($val, 4, 16);
    }

    /**
     * Check for correct password
     *
     * @param string $password The password in plain text
     * @param string $hash The stored password hash
     *
     * @return bool Returns true if the password is correct, false if not.
     */
    function phpbb_check_hash($password, $hash)
    {

        $itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        if (strlen($hash) == 34)
        {
            return ($this->_hash_crypt_private($password, $hash, $itoa64) === $hash) ? true : false;
        }
        return (md5($password) === $hash) ? true : false;
    }

    public function phpbb_hash($password = null)
    {
        if (empty($password))
        {
            return false;
        }
        $itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $random_state = $this->unique_id();
        $random = '';
        $count = 6;

        if (($fh = @fopen('/dev/urandom', 'rb')))
        {

            $random = fread($fh, $count);

            fclose($fh);
        }

        if (strlen($random) < $count)
        {
            $random = '';
            for ($i = 0; $i < $count; $i+=16)
            {

                $random_state = md5($this->unique_id() . $random_state);

                $random .= pack('H*', md5($random_state));
            }

            $random = substr($random, 0, $count);
        }
        $hash = $this->_hash_crypt_private($password, $this->_hash_gensalt_private($random, $itoa64), $itoa64);

        if (strlen($hash) == 34)
        {
            return $hash;
        }
        return md5($password);
    }

    /**
     * Hashes an email address to a big integer
     *
     * @param string $email		Email address
     *
     * @return string			Unsigned Big Integer
     */
    function phpbb_email_hash($email)
    {
        return sprintf('%u', crc32(strtolower($email))) . strlen($email);
    }

    /**
     * Logika dla globalnej wyszukiwarki w cms
     * nadpisuje metodę z AppModel
     * 
     * @param array $options
     * @param array $params
     * @return type array
     */
    public function search($options = null, $params = array())
    {
        if (empty($options) || !isset($options['Searcher']['fraz']))
        {
            return false;
        }
        $fraz = $options['Searcher']['fraz'];
        $params['conditions']['OR']["User.name LIKE"] = "%{$fraz}%";
        $params['conditions']['OR']["User.email LIKE"] = "%{$fraz}%";
        $params['limit'] = 5;
        $this->recursive = 1;
        return $this->find('all', $params);
    }

    function filterParams($data = null)
    {
        if (empty($data))
        {
            return false;
        }
        $params = array();
        if (!empty($data['User']['id']))
        {
            $params['conditions']['User.id'] = $data['User']['id'];
        }
        if (!empty($data['User']['email']))
        {
            $params['conditions']['User.email LIKE'] = '%' . $data['User']['email'] . '%';
        }
        if (!empty($data['Group']['id']))
        {
            $params['joins'][] = array(
                'table' => 'user_groups_users',
                'alias' => 'GroupsUser',
                'type' => 'LEFT',
                'conditions' => array(
                    'GroupsUser.user_id = User.id',
                )
            );
            $params['conditions']['GroupsUser.group_id'] = $data['Group']['id'];
        }

        return $params;
    }

    /**
     * Logowanie użytkowników
     * 
     * @param string $login     Login użytkownika
     * @param string $pass      Hasło użytkownika
     * 
     * @return bool             Zwraca wartość  true po poprawnym zalogowaniu
     *                                          false po niepomyślnym logowaniu
     */
    function login($login, $pass)
    {
        $this->recursive = -1;

        $user = $this->findByEmail($login);

        if (empty($login) || empty($pass) || empty($user))
        {
            return false;
        }

        if (!$user['User']['active'])
        {
            return false;
        }
        $collection = new ComponentCollection();
        $this->Auth = new AuthComponent($collection);

        if ($user['User']['pass'] !== $this->Auth->password($pass))
        {
            return false;
        }

        unset($user['User']['pass'], $user['User']['login'], $user['User']['remember']);
        unset($user['User']['pass'], $user['User']['login'], $user['User']['remember']);
        return $this->Auth->login($user['User']);
    }

    /**
     * Ustawianie dodatkowych zmiennych w sessji
     * 
     * @param string $user_id     Id użytkownika
     * 
     * @return bool             Zwraca wartość  true po poprawnym dodaniu sesji
     *                                          false gdy jest błąd
     */
    function setUserSession($user_id = null)
    {
        if (!$this->exists($user_id))
        {
            return false;
        }
        $this->recursive = 1;
        $user = $this->findById($user_id);
        if (empty($user))
        {
            return false;
        }
        if (!empty($user['Group']))
        {
//sprawdzam czy nie jest to client który nie ma profilu
            $gr = reset($user['Group']);
            if (!empty($gr['alias']) && $gr['alias'] == 'client')
            {
                $this->Client = ClassRegistry::init('Client');
                $cl = $this->Client->getClientForUser($user['User']['id']);
                CakeSession::write('Auth.User.name', $cl['Client']['name']);
            }
        }
        if (!empty($user['Section'][0]['id']))
        {
            $section_id = $user['Section'][0]['id'];
        } else
        {
            $section_id = 0;
        }
        CakeSession::write('Auth.User.section_id', $section_id);
        if (!empty($user['Profile']['id']))
        {
            CakeSession::write('Auth.User.name', $user['Profile']['firstname'] . ' ' . $user['Profile']['surname']);
        }
        return TRUE;
    }

    /**
     * Resetowanie hasła dla zarejestrowanego użytkownika
     * 
     * @param string $email     Email użytkownika
     * 
     * @return bool             Zwraca wartość  true po poprawnym wysłaniu maila z linkiem do zresetowania hasła,
     *                                          false gdy podany email nie istnieje w bazie danych
     */
    function resetPassword($email)
    {
        if (empty($email))
        {
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return false;
        }
        $user = $this->findByEmail($email);
        if (empty($user))
        {
            return false;
        }
        if (!$user['User']['active'])
        {
            return false;
        }
        return true;
    }

    /**
     * Zmiana zdjęcia profilowego.
     * 
     * @param string $user_id   ID użytkownika
     * @param array $photo      Dane ze zdjęciem
     * 
     * @return bool             True po pomyślnym wgraniu zdjęcia, 
     *                          false w przeciwnym wypadku
     */
    public function addPhoto($user_id = null, $data = array())
    {

        $this->id = $user_id;

        if (empty($user_id) || empty($data))
        {
            return false;
        }
        // Sprawdzenie czy użytkownik istnieje
        if (!$this->exists())
        {
            return false;
        }

        if (!empty($data['User']['avatar']['error']))
        {
            return false;
        }

//        if (!empty($data['User']['avatar_url']) && !getimagesize($data['User']['avatar_url'])) //nie używamy getimgaesize bo strasznie zamula serwer jeśli sprawdzamy np. link https:
//        {
//            return false;
//        }


        if (!empty($data['User']['avatar']))
        {
            $data['User']['avatar_url'] = null;
            $ext = substr(strtolower(strrchr($data['User']['avatar']['name'], '.')), 1); //get the extension
            $filename = str_replace('.'.$ext, '_'.time().'.'.$ext, $data['User']['avatar']['name']); //dodaje timestamp zeby uniknac konfliktu nazw
            move_uploaded_file($data['User']['avatar']['tmp_name'],WWW_ROOT.DS.'files'.DS.'user'.DS.$filename);  
            
            $data['User']['avatar'] = $filename;
        }

        if (!empty($data['User']['avatar_url']))
        {
            $data['User']['avatar_delete'] = 1;
            $data['User']['avatar'] = null;
        }

        $data['User']['id'] = $this->id;


        $return = $this->save($data);
        

        if (!empty($return['User']['avatar']))
        {
            CakeSession::write('Auth.User.avatar', $return['User']['avatar']);
        } else
        {
            CakeSession::write('Auth.User.avatar', '');
        }

        if (!empty($return['User']['avatar_url']))
        {
            CakeSession::write('Auth.User.avatar_url', $return['User']['avatar_url']);
        } else
        {
            CakeSession::write('Auth.User.avatar_url', '');
        }


        return $return ? true : false;
    }

    /**
     * Zmiana hasła.
     * 
     * @param string $user_id           ID użytkownika
     * @param string $old_password      Stare hasło
     * @param string $new_password      Nowe hasło
     * 
     * @return bool                     True po pomyślnej zmianie hasła, 
     *                                  false w przeciwnym wypadku
     */
    public function changePassword($user_id = null, $old_password = null, $new_password = null)
    {
        $this->id = $user_id;
        $pass = $this->field('pass');


        if ($pass == AuthComponent::password($old_password))
        {
            return ($this->saveField('pass', AuthComponent::password($new_password))) ? true : false;
        }
        return false;
    }

    /*
     * Pobranie danych zalogowanego użytkownika
     * 
     * @param int $user_id		Id użytkownika
     * 
     * @return mixed			array z danymi użytkownika
     * 							false w przypadku błędu
     */

    public function getUser($user_id = null)
    {
        if (!$user_id)
        {
            return false;
        }

        $params['conditions'] = array(
            'User.id' => $user_id
        );
        $params['recursive'] = -1;
        $params['fields'] = $this->fields;

        $type = $this->find('first', $params);

        return !empty($type) ? $type : false;
    }

    /**
     * Lista użytkowników
     *
     * @return mixed            array z danymi profili
     *                          false w przeciwnym błedu
     */
    public function getAllUsers()
    {
        /*
         * @todo pobieranie użytkowników tylko z danego działu ? 
         * 
         */
        $params = array();
        $params['fields'] = array(
            'id',
            'pm_user',
            'pm_password',
            'email'
        );
        $params['recursive'] = -1;

        return $this->find('all', $params);
    }

    /*
     * Zapis danych logowania do PM
     * 
     * @param int $user_id		Id użytkownika
     * @param string $login		login
     * @param string $pass		hasło
     * 
     * @return bool				true gdy dane zostaną zapisane
     * 							false w przypadku błędu
     */

    public function savePmCredentials($user_id = null, $login = null, $pass = null)
    {

        if (!$user_id || !$login || !$pass)
        {
            return false;
        }

        $this->id = $user_id;
        $data['pm_user'] = $login;
        $data['pm_password'] = $pass;
        if ($this->save($data))
        {
            return true;
        } else
        {
            return false;
        }
    }

}
