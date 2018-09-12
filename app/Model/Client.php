<?php

App::uses('AppModel', 'Model');

/**
 * Client Model
 *
 * @package b2b
 * @property User $User
 */
class Client extends AppModel
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
    public $displayField = 'name';

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

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array())
    {
        
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
     * Pobranie listy klientów przypisanych do usera
     * 
     * @param string $user_id  ID użytkownika
     * @return mixed            array Lista użytkowników (ID, nazwa, strona, telefon)
     *                          false w przypadku błędu
     */
    function getClients($account_manager_id = null,$archive = 0)
    {
        if (!$account_manager_id)
        {
            return false;
        }

        $toReturn = $this->find('all', array(
            'conditions' => array(
                'Client.account_manager_id' => $account_manager_id,
				'Client.archive' => $archive
            ),
            'recursive' => 0,
            'fields' => array(
                'Client.*'
            ),
//            'fields' => array(
//                'Client.id', 'Client.name', 'Client.site', 'Client.phone', 'Client.archive','Client.email','Client.comarch_id'
//            ),
            'order' => 'Client.id desc'
        ));

        return empty($toReturn) ? false : $toReturn;
    }

    /**
     * Pobranie listy wszysktich klientów 
     * 
     * @return mixed            array Lista użytkowników (ID, nazwa, strona, telefon)
     *                          false w przypadku błędu lub pustej listy
     */
    function getAllClients($archive = 0)
    {

        $toReturn = $this->find('all', array(
            'recursive' => 0,
            'conditions' => array(
				'Client.archive' => $archive
            ),
            'fields' => array(
                'Client.*'
            ),
//            'fields' => array(
//                'Client.id', 'Client.name', 'Client.site', 'Client.phone', 'Client.archive','Client.email','Client.comarch_id'
//            ),
            'order' => 'Client.id desc'
        ));

        return empty($toReturn) ? false : $toReturn;
    }

    /**
     * Szczegóły danego klienta
     * 
     * @param int $client_id    ID Klienta
     * @return mixed            array Szczegóły klienta
     *                          false w przypadku błędu
     */
    function getClientDetails($client_id = null)
    {
        if (!$client_id)
        {
            return false;
        }

        return $this->find('first', array(
                    'conditions' => array(
                        'Client.id' => $client_id
                    ),
                    'recursive' => -1
        ));
    }

    /**
     * Szczegóły danego klienta
     * 
     * @param int $client_id    ID Klienta
     * @return mixed            array Szczegóły klienta
     *                          false w przypadku błędu
     */
    function getClientForUser($user_id = null)
    {
        if (!$user_id)
        {
            return false;
        }

        return $this->find('first', array(
                    'conditions' => array(
                        'Client.user_id' => $user_id
                    ),
                    'recursive' => -1
        ));
    }

    /**
     * Dodawanie klienta
     * 
     * @param array $client     Dane klienta
     */
    function addClient($client = array())
    {
        if (empty($client) || empty($client['Client']['name']))
        {
            return false;
        }
        $this->User = ClassRegistry::init('User.User');

        $this->User->create();
        $user['User']['email'] = $client['Client']['email'];
        $user['User']['active'] = 0;

        $groupParams['conditions']['Group.alias'] = 'client';
        $groupParams['fields'] = array('alias', 'id');
        $group = $this->User->Group->find('list', $groupParams);

        $user['Group']['Group'][0] = reset($group);
        $groupSave = $this->User->save($user);
        $client['Client']['user_id'] = $groupSave['User']['id'];
        $this->create();
        return $this->save($client);
    }

    /**
     * Edycja klienta
     * 
     * @param array $client     Dane klienta
     */
    function editClient($client = array())
    {
        if (empty($client) || empty($client['Client']['id']))
        {
            return false;
        }
        $this->id = $client['Client']['id'];

        if (!$this->exists())
        {
            return false;
        }
        if ($this->field('email') != $client['Client']['email'])
        {
            $this->User = ClassRegistry::init('User.User');
            $this->User->id = $this->field('user_id');
            $this->User->saveField('email', $client['Client']['email']);
        }

        return $this->save($client);
    }

    /**
     * Szczegóły przeniesienie klienta do archiwum
     * 
     * @param int $client_id    ID Klienta
     * @return bool             true w przypadku sukcesu
     *                          false w przypadku błędu
     */
    public function archiveClient($client_id = null)
    {
        if (!$client_id)
        {
            return false;
        }
        
        $params['conditions']['id'] = $client_id;
        $params['recursive'] = -1;
        $client = $this->find('first', $params);
        if(empty($client['Client']['id'])){
            return false;
        }
        
        if(!empty($client['Client']['user_id'])){
            $params['conditions']['id'] = $client['Client']['user_id'];
            $params['recursive'] = -1;
            $user = $this->User->find('first', $params);
            if(empty($user['User']['id'])){
                return false;
            } else {
                $this->User->id = $user['User']['id'];
                
                $this->User->saveField('active', 0);
            }
        }
        
        $this->id = $client['Client']['id'];
        if ($this->saveField('archive', 1))
        {
            return true;
        } else {
            return false;
        };
    }
    
    /**
     * metoda przywracająca klienta z archiwum
     * 
     * @param int $client_id    ID Klienta
     * @return bool             true w przypadku sukcesu
     *                          false w przypadku błędu
     */
    public function unarchiveClient($client_id = null)
    {
        if (!$client_id)
        {
            return false;
        }
        
        $params['conditions']['id'] = $client_id;
        $params['recursive'] = -1;
        $client = $this->find('first', $params);
        if(empty($client['Client']['id'])){
            return false;
        }
        
        $this->id = $client['Client']['id'];
        if ($this->saveField('archive', 0))
        {
            return true;
        } else {
            return false;
        };
    }

    /**
     * Zliczanie leadów uzytkownika.
     * 
     * @param string $user_id       ID użytkownika
     * 			
     * @return mixed        int count z leadów
     *                      false w przypadku błędu
     */
    function countUserClient($user_id = null, $date_from = null, $date_to = null)
    {
        if (!is_array($user_id) and !$this->User->exists($user_id))
        {
            return false;
        }
        $params['conditions']['Client.account_manager_id'] = $user_id;
        if (!empty($date_from))
        {
            $params['conditions']['AND'][]['Client.created >='] = $date_from;
        }
        if (!empty($date_to))
        {
            $params['conditions']['AND'][]['Client.created <='] = $date_to;
        }
        $params['recursive'] = -1;
//        $params['joins'][] = array(
//                    'table' => 'client_leads',
//                    'alias' => 'ClientLead',
//                    'type' => 'INNER',
//                    'conditions' => array(
//                        'Client.id = ClientLead.client_id'
//                    )
//        );
        return $this->find('count', $params);
    }

    /**
     * Funkcja pobierająca tablicę elementów typu Client dla wyszukiwarki
     * 
     * @param $query		wyszukiwana fraza
     * 
     * @return array		tablica elementów typu Client
     */
    public function getClientsSearcher($query = null)
    {
        
        if($query == null){
            
            return array();
        }
        
        //$this->unBindModel(array('belongsTo' => array('Profile')));
        
        $clients = $this->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'OR' => array(
                    'Client.name LIKE ' => '%' . $query . '%',
                    'Client.street LIKE ' => '%' . $query . '%',
                    'Client.zipcode LIKE ' => '%' . $query . '%',
                    'Client.city LIKE ' => '%' . $query . '%',
                    'Client.country LIKE ' => '%' . $query . '%',
                    'Client.phone LIKE ' => '%' . $query . '%',   
                    'Client.site LIKE ' => '%' . $query . '%',         
                    'Client.email LIKE ' => '%' . $query . '%',         
                    'Client.nip LIKE ' => '%' . $query . '%',            
                ),
            )
        ));  
       
        for($i = 0; $i < sizeof($clients); $i++){
            
            foreach($clients[$i]['Client'] as $fieldName => $fieldValue){
                
                if(stripos($fieldValue, $query) !== false && $fieldName != 'user_id' && $fieldName != 'account_manager_id'){
                    
                    $clients[$i]['foundIn'] = '<span>' . str_ireplace($query, '<b>' . $query . '</b>', $fieldValue) . '<span>';
                    break;
                }
            }
        }

        return $clients;
    }   
}