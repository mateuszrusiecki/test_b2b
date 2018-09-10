<?php

App::uses('AppModel', 'Model');

/**
 * SocialBook Model
 *
 */
class SocialBook extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'user_id';
    
    /**
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'SocialBook.created DESC';

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => '',
            'conditions' => array('Profile.user_id = SocialBook.user_id'),
            'fields' => '',
            'order' => ''
        )
    );

    public function beforeValidate($options = array())
    {
        $this->validate = array(
            'user_id' => array(
                'uuid' => array(
                    'rule' => array('uuid'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
        );
    }

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
     * Logika dla globalnej wyszukiwarki w cms
     * nadpisuje metodę z AppModel
     * 
     * @param array $options
     * @param array $params
     * @return type array
     */
//    public function search($options, $params = array()) {
//        $fraz = $options['Searcher']['fraz'];
//        $params['conditions']['OR']["SocialBook.user_id LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
    public function getIdByUserEmail($user_email = null)
    {
        $params['conditions']['User.email'] = $user_email;
        $this->User->recursive = -1;
        $data = $this->User->findByEmail($user_email, array('User.id'));
        return empty($data) ? false : $data['User']['id'];
    }

    public function getByUserId($user_id = null, $fields = array())
    {
        if (!$this->User->exists($user_id))
        {
            return false;
        }
        $params['conditions']['User.id'] = $user_id;
        $params['fields'] = $fields;
        $socialBook = $this->find('first', $params);
        if (empty($socialBook))
        {
            $data['SocialBook']['user_id'] = $user_id;
            $this->create();
            $this->save($data, false);
        }
        $socialBook = $this->find('first', $params);
        return $socialBook;
    }

    public function getListUser()
    {
        $todayDate = date('Y-m-d H:i:s');
        $params['joins'][] = array(
            'table' => 'user_sections',
            'alias' => 'UserSection',
            'type' => 'INNER',
            'conditions' => array(
                'User.id = UserSection.user_id'
            )
        );
        $params['joins'][] = array(
            'table' => 'profiles',
            'alias' => 'Profile',
            'type' => 'LEFT',
            'conditions' => array(
                'User.id = Profile.user_id'
            )
        );
        $params['joins'][] = array(
            'table' => 'social_books',
            'alias' => 'SocialBook',
            'type' => 'LEFT',
            'conditions' => array(
                'User.id = SocialBook.user_id'
            )
        );
        $params['joins'][] = array(
            'table' => 'user_contract_histories',
            'alias' => 'UserContractHistory',
            'type' => 'LEFT',
            'limit'=>1,
            'order'=>'UserContractHistory.id DESC',
            'conditions' => array(
                'User.id = UserContractHistory.user_id',
                'UserContractHistory.employment_start <=' => $todayDate,
            )
        );
        $params['group'] = 'User.id';
        $params['recursive'] = -1;
        $params['fields'][] = 'User.email';
        $params['fields'][] = 'User.avatar';
        $params['fields'][] = 'User.avatar_url';
        $params['fields'][] = 'Profile.firstname';
        $params['fields'][] = 'Profile.surname';
        $params['fields'][] = 'Profile.work_phone';
        $params['fields'][] = 'UserContractHistory.position';
        $params['fields'][] = 'UserSection.section_id';
        $params['fields'][] = 'SocialBook.facebook';
        $data = $this->User->find('all', $params);
        //debug($data);die;
        return $data;
    }
       
    /**
     * Funkcja pobierająca tablicę elementów SocialBooks dla wyszukiwarki
     * 
     * @param $query		wyszukiwana fraza
     * 
     * @return array		tablica elementów SocialBooks
     */
    public function getSocialBooksSearcher($query = null)
    {
        
        if($query == null){
            
            return array();
        }
        
        $this->unBindModel(array('belongsTo' => array('Profile')));
        
        $socialBooks = $this->find('all', array(
            
            'fields' => array(
                'SocialBook.*',
                'User.id',
                'User.email',
            ),
            'recursive' => 0,
            'conditions' => array(
                'OR' => array(
                    'SocialBook.about LIKE ' => '%' . $query . '%',
                    'SocialBook.competence LIKE ' => '%' . $query . '%',
                    'SocialBook.skype LIKE ' => '%' . $query . '%',
                    'SocialBook.website LIKE ' => '%' . $query . '%',
                    'SocialBook.facebook LIKE ' => '%' . $query . '%',
                    'SocialBook.office_room LIKE ' => '%' . $query . '%',         
                ),
            )
        ));   
        
        
        // Dodanie pola z informacją w jakim tekście dokładnie znaleziono poszukiwaną frazę
        for($i = 0; $i < sizeof($socialBooks); $i++){
            
            foreach($socialBooks[$i]['SocialBook'] as $fieldName => $fieldValue){
                
                if(stripos($fieldValue, $query) !== false && $fieldName != 'user_id'){
                    
                    $socialBooks[$i]['foundIn'] = '<span>' . str_ireplace($query, '<b>' . $query . '</b>', $fieldValue) . '<span>';
                    break;
                }
            }
        }
        
        return $socialBooks;
    }
}
