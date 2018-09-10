<?php

App::uses('AppModel', 'Model');

/**
 * Profile Model
 *
 * @package b2b
 * @property User $User
 */
class Profile extends AppModel
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
    public $displayField = 'firstname';

    /**
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'Profile.created DESC';

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
        )
    );
    
    public $fields = array(
        'id',
        'firstname',
        'surname',
        'date_of_birth',
        'place_of_birth',
        'father_name',
        'mother_name',
        'family_surname',
        'pesel',
        'education',
        'type_of_card_id',
        'card_id_number',
        'bank_name',
        'account_number',
        'nip',
        'revenue',
        'place_of_work',
        'state',
        'position',
        'vacation_days',
        'vacation_available',
        'salary',
        'salary_net',
        'employment_start',
        'employment_end',
        'period_of_employment',
        'right_to_pension',
        'unemployed',
        'nfz',
        'disabled',
        'work_phone',
        'private_phone',
        'friend_phone',
        'private_email',
        'reg_street',
        'reg_house_number',
        'reg_flat_number',
        'reg_postcode',
        'reg_city',
        'reg_community',
        'reg_district',
        'reg_province',
        'reg_country_id',
        'street',
        'house_number',
        'flat_number',
        'postcode',
        'city',
        'community',
        'district',
        'province',
        'country_id',
        'user_id',
        'User.email',
    );
    public $fieldsTmp = array(
        '_firstname',
        '_surname',
        '_date_of_birth',
        '_place_of_birth',
        '_father_name',
        '_mother_name',
        '_family_surname',
        '_pesel',
        '_education',
        '_type_of_card_id',
        '_card_id_number',
        '_bank_name',
        '_account_number',
        '_nip',
        '_revenue',
        '_place_of_work',
        '_state',
        '_position',
        '_salary',
        '_period_of_employment',
        '_right_to_pension',
        '_unemployed',
        '_nfz',
        '_disabled',
        '_work_phone',
        '_private_phone',
        '_friend_phone',
        '_private_email',
        '_reg_street',
        '_reg_house_number',
        '_reg_flat_number',
        '_reg_postcode',
        '_reg_city',
        '_reg_community',
        '_reg_district',
        '_reg_province',
        '_reg_country_id',
        '_street',
        '_house_number',
        '_flat_number',
        '_postcode',
        '_city',
        '_community',
        '_district',
        '_province',
        '_country_id'
    );
    
    public $virtualFields = array(
        'name' => 'CONCAT(Profile.firstname, " ", Profile.surname)'
    );

    private $__profilesIndexFields = array(
        'Profile.id',
        'Profile.user_id',
        'Profile.firstname',
        'Profile.surname',
        'Profile.position',
        'Profile.place_of_work',
        'Profile.private_phone',
        'Profile.private_email',
        'Profile.pesel',
        'Profile.nip',
        'User.active',
        'User.id',
        'User.email',
        'UserContractHistories.id',
        'UserContractHistories.state',
        'UserContractHistories.working_time',
        'UserContractHistories.position',
        'UserContractHistories.vacation_days',
        'UserContractHistories.vacation_available',
        'UserContractHistories.employment_start',
        'UserContractHistories.employment_end'
    );
    
    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
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
            'firstname' => array(
                'required' => array(
                    'rule' => 'notEmpty',
                    'message' => __d('validate', 'Imię wymagane'),
                )
            ), 
            'surname' => array(
                'required' => array(
                    'rule' => 'notEmpty',
                    'message' => __d('validate', 'Nazwisko wymagane'),
                )
            )
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
     * Pobieranie szczegółów profilu użytkownika.
     * 
     * @params string       $user_id    ID użytkownika
     * @return array|bool               Jeśli użytkownik istnieje to dane użytkownika, jeśli nie - false
     */
    public function getProfile($user_id = null)
    {
        if (empty($user_id))
        {
            return false;
        }

        $params['conditions'] = array(
            'Profile.user_id' => $user_id
        );
        $params['fields'] = $this->fields;
        $params['joins'][] = array(
            'table' => 'countries',
            'alias' => 'Country',
            'type' => 'LEFT',
            'conditions' => array(
                'Profile.country_id = Country.id'
            )
        );
        $params['joins'][] = array(
            'table' => 'countries',
            'alias' => 'CountryReg',
            'type' => 'LEFT',
            'conditions' => array(
                'Profile.reg_country_id = CountryReg.id'
            )
        );

        $profile = $this->find('first', $params);

        return !empty($profile) ? $profile : false;
    }

    /**
     * Wysyłanie zaaktualizowanego profilu użytkownika do zmian - zatwierdzane przez Sekretariat.
     * 
     * @param string    $user_id    ID użytkownika
     * @param array     $profile    Dane użytkownika
     * 
     * @return bool                 True jeśli zapis się powiódł, false w przeciwnym wypadku
     */
    public function setProfile($user_id = null, $profile = array())
    {
        if (empty($user_id) || empty($profile))
        {
            return false;
        }

        // Sprawdzenie czy istnieje user o danym user_id
        $profile_id = $this->find('first', array(
            'conditions' => array(
                'Profile.user_id' => $user_id
            ),
            'recursive' => -1,
        ));

        if (empty($profile_id) && empty($profile['Profile']))
        {
            return false;
        }

        foreach ($this->fields as $field)
        {
            if (in_array($field, array_flip($profile['Profile'])))
            {
                return false;
            }
        }

        // Sprawdzenie czy adres zamieszkania jest taki sam jak zameldowania
        if (!empty($profile['Profile']['different_address']) &&
                $profile['Profile']['different_address'] == 1)
        {
            $profile['Profile']['_street'] = $profile['Profile']['_reg_street'];
            $profile['Profile']['_house_number'] = $profile['Profile']['_reg_house_number'];
            $profile['Profile']['_flat_number'] = $profile['Profile']['_reg_flat_number'];
            $profile['Profile']['_postcode'] = $profile['Profile']['_reg_postcode'];
            $profile['Profile']['_city'] = $profile['Profile']['_reg_city'];
            $profile['Profile']['_community'] = $profile['Profile']['_reg_community'];
            $profile['Profile']['_district'] = $profile['Profile']['_reg_district'];
            $profile['Profile']['_province'] = $profile['Profile']['_reg_province'];
            $profile['Profile']['_country_id'] = $profile['Profile']['_reg_country_id'];
        }

        unset($profile['Profile']['different_address']);

        $this->id = $profile_id['Profile']['id'];

        return (bool) $this->save($profile);
    }

    /**
     * Sprawdzenie, czy użytkownik ma niezatwierdzone zmiany w profilu
     * 
     * @param type $user_id     ID użytkownika
     * 
     * @return bool             true gdy użytkownik ma niezatwierdzone zmiany
     *                          false w przeciwnym wypadku
     */
    public function checkTmpProfile($user_id = null)
    {
        if (empty($user_id))
        {
            return false;
        }

        $data = $this->find('first', array(
            'conditions' => array(
                'Profile.user_id' => $user_id
            ),
            'fields' => $this->fieldsTmp
        ));

        if (empty($data))
        {
            return false;
        }

        foreach ($data['Profile'] as $field)
        {

            if ($field)
            {
                return true;
            } else
            {
                continue;
            }
        }

        return false;
    }

    /**
     * Lista użytkowników
     * 
     * @param type $user_id     ID użytkownika
     * 
     * @return mixed            array z danymi profili
     *                          false w przeciwnym błedu
     */
    public function listProfiles()
    {
        /*
         * @todo pobieranie użytkowników tylko z danego działu 
         * 
         */
        $params = array();
        $params['fields'] = array(
            'user_id',
            'name'
        );

        return $this->find('list', $params);
    }

    public function getProfileForCard($user_id = null)
    {
        if (empty($user_id) || !$this->User->exists($user_id))
        {
            return false;
        }
        $params['fields'][] = 'Profile.position';
        $params['fields'][] = 'Profile.name';
        //$params['fields'][] = 'Profile.id';
        $params['fields'][] = 'User.avatar';
        $params['fields'][] = 'User.avatar_url';
        $params['fields'][] = 'User.email';
        $params['fields'][] = 'User.id';
        $params['conditions']['Profile.user_id'] = $user_id;
        return $this->find('first', $params);
    }
        
    /**
     * Lista wszystkich profili
     * 
     * @return array        lista profili
     */
    public function getProfiles(){
        
        $todayDate = date('Y-m-d');
      
        return $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'user_contract_histories',
                    'alias' => 'UserContractHistories',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Profile.user_id = UserContractHistories.user_id',
                        "UserContractHistories.id = (SELECT max(id) FROM user_contract_histories WHERE user_id = Profile.user_id AND employment_start <= '{$todayDate}')"
                        //"UserContractHistories.id = (SELECT max(id) FROM user_contract_histories WHERE user_id = Profile.user_id AND employment_start <= '{$todayDate}' AND employment_end >= '{$todayDate}')"
                    )
                ),
            ),
            'fields' => $this->__profilesIndexFields,
            'order' => 'Profile.id',
        ));
    }
    
    /**
     * Funkcja przypisuje wartości pól tymczasowych do pól normalnych
     * 
     * @param array $profile         dane profilu użytkownika
     * @return array                 zaktualizowane dane profilu użytkownika    
     */
    public function updateUserChanges($profile = null){
		if(empty($profile)){
			return false;
		}
        $this->set($profile);     

        foreach($this->fieldsTmp as $tmpFieldName){
            $tmpFieldValue = $this->field($tmpFieldName);
 
            if(!empty($tmpFieldValue)){
                $fieldName =  substr($tmpFieldName, 1);
                $this->set($fieldName, $tmpFieldValue);
            }           
        }
        
        return $this->data;
    }
    
    /**
     * Czyszczenie wartości pól tymczasowych
     * 
     * @param int $profile                  profil użytkownika
     * @param int $confirmUserData          gdy false, nie jest wykonywany update
     * $return mixed                        false, jeśli confirmUserData = false, void jeśli $confirmUserData = true
     */
    public function clearTemporaryFieldsValues($profile = null, $confirmUserData = null){   
        if(empty($profile) || empty($confirmUserData)){
            return false;
        }
        
        $this->set($profile);
        
        foreach($this->fieldsTmp as $tmpFieldName){
            $this->set($tmpFieldName, '');
        }
            
        $this->save(null, false);
    }
    
    /**
     * Funkcja zwracająca nazwy pól, które edytował użytkownik
     * 
     * @param array $profile         dane profilu użytkownika
     * @return array                 tablica pól, które edytował użytkownik  
     */
    public function getFieldsChangedByUser($profile = null){
		if(empty($profile)){
			return false;
		}
        $this->set($profile);     
        
        $fieldsChangedByUser = array();
        
        foreach($this->fieldsTmp as $tmpFieldName){
            $tmpFieldValue = $this->field($tmpFieldName);           
            if(!empty($tmpFieldValue)){
                $fieldName = substr($tmpFieldName, 1);
                $fieldsChangedByUser[] = $fieldName;
            }           
        }
        
        return $fieldsChangedByUser;
    }
}
