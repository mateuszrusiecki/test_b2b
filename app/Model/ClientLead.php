<?php

App::uses('AppModel', 'Model');

/**
 * ClientLead Model
 *
 * @property Client $Client
 * @property LeadCategory $LeadCategory
 * @property LeadStatus $LeadStatus
 * @property Currency $Currency
 * @property User $User
 */
class ClientLead extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array('Containable');

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'LeadCategory' => array(
            'className' => 'LeadCategory',
            'foreignKey' => 'lead_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'LeadStatus' => array(
            'className' => 'LeadStatus',
            'foreignKey' => 'lead_status_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'ClientContact' => array(
            'className' => 'ClientContact',
            'joinTable' => 'client_contact_client_leads',
            'foreignKey' => 'client_lead_id',
            'associationForeignKey' => 'client_contact_id',
            'unique' => true,
            'conditions' => '',
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
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array())
    {
        $this->validate = array(
            'id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'name' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                    //'allowEmpty' => false,
                    'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'client_id' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                    //'allowEmpty' => false,
                    'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                    //'allowEmpty' => false,
                    'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'lead_category_id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                    //'allowEmpty' => false,
                    'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                    //'allowEmpty' => false,
                    'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'lead_status_id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                    //'allowEmpty' => false,
                    'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'probability' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                    //'allowEmpty' => false,
                    'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'amount' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                    //'allowEmpty' => false,
                    'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'currency_id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                    //'allowEmpty' => false,
                    'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
//            'user_id' => array(
//                'notempty' => array(
//                    'rule' => array('notempty'),
//                    'message' => __d('validate', 'Pole formularza nie może być puste'),
//                //'allowEmpty' => false,
//                'required' => true,
//                //'last' => false, // Stop validation after this rule
//                //'on' => 'create', // Limit validation to 'create' or 'update' operations
//                ),
//            ),
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
     * Dodawanie leada
     * 
     * @param array $lead   Lead
     * @return mixed        array Zapisany lead
     *                      false w przypadku błędu
     */
    function addClientLead($lead = array())
    {
        if (empty($lead))
        {
            return false;
        }

        if (empty($lead['ClientLead']['id']))
        {
            $this->create();
        } else
        {
            $this->id = $lead['ClientLead']['id'];
            if (!$this->exists())
            {
                return false;
            }
        }

        $save = $this->save($lead);
        //die(debug($this->validationErrors));
//        $log = $this->getDataSource()->getLog(false, false);
        return $save;
    }

    /**
     * Pobranie leadów przypisanych do klienta
     * 
     * @param int $client_id    ID klienta  
     * @return mixed            array Lista leadów
     *                          false w przypadku błędu
     */
    function getLeads($client_id = null)
    {
        if (!$client_id)
        {
            return false;
        }

        $this->Client->id = $client_id;
        if (!$this->Client->exists($client_id))
        {
            return false;
        }

        return $this->find('all', array(
                    'conditions' => array(
                        'ClientLead.client_id' => $client_id
                    ),
                    'recursive' => -1,
                    'joins' => array(
                        array(
                            'table' => 'profiles',
                            'alias' => 'Profile',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Profile.user_id = ClientLead.user_id'
                            )
                        ),
                    ),
                    'fields' => array(
                        'ClientLead.*', 'Profile.firstname', 'Profile.surname'
                    ),
                    'order' => 'ClientLead.created DESC'
        ));
    }

    /**
     * Pobranie szczegółów leadu
     * 
     * @param int $id       ID leadu
     * @return mixed        array Szczegółów leadu
     *                      false w przypadku błędu
     */
    function getLeadDetails($id = null)
    {
        if (!$id)
        {
            return false;
        }

        return $this->find('first', array(
                    'conditions' => array(
                        'ClientLead.id' => $id
                    )
        ));
    }

    /**
     * Pobranie osób kontaktowych przypisanych do leadu
     * 
     * @param int $id       ID leadu
     * @return mixed        array Kontakty leadu
     *                      false w przypadku błędu
     */
    function getLeadContacts($id = null)
    {
        if (!$id)
        {
            return false;
        }

        $data = $this->find('all', array(
            'conditions' => array(
                'ClientLead.id' => $id
            ),
            'order' => 'ClientLead.modified desc',
            'recursive' => 1
        ));

        $toReturn = reset($data);
        return $toReturn['ClientContact'];
    }

    /**
     * Usuwanie osoby kontaktowej z leadu
     * 
     * @param int $lead_id      ID leadu
     * @param int $contact_id   ID osoby
     * @return boolean          true po pomyślnym usunięciu
     *                          false w przypadku błędu
     */
    function deleteLeadContact($lead_id = null, $contact_id = null)
    {
        if (!$contact_id || !$lead_id)
        {
            return false;
        }

        $this->ClientContactClientLead = ClassRegistry::init('client_contact_client_leads');

        $id = $this->ClientContactClientLead->find('list', array(
            'conditions' => array(
                'client_contact_id' => $contact_id,
                'client_lead_id' => $lead_id
            ),
            'fields' => array(
                'id', 'id'
            )
        ));

        return $this->ClientContactClientLead->delete(reset($id));
    }

    /**
     * Dodawanie kontaktu do leadu z listy kontaktów klienta
     * 
     * @param int $lead_id      ID leadu
     * @param int $contact_id   ID kontaktu
     * @return mixed            array Zapisane połączenie lead - kontakt
     *                          false w przypadku błędu
     */
    function addClientContactList($lead_id = null, $contact_id = null)
    {
        if (!$contact_id || !$lead_id)
        {
            return false;
        }

        $this->id = $lead_id;
        if (!$this->exists($lead_id))
        {
            return false;
        }

        $this->ClientContact->id = $contact_id;
        if (!$this->ClientContact->exists($contact_id))
        {
            return false;
        }

        $this->ClientContactClientLead = ClassRegistry::init('client_contact_client_leads');

        return $this->ClientContactClientLead->save(array(
                    'client_lead_id' => $lead_id,
                    'client_contact_id' => $contact_id
        ));
    }

    /**
     * Pobranie leadów utworzonych w wybranym przedziale czasowym
     * 
     * @param string $user_id       ID użytkownika
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    function getUserCreatedLeadsByDate($user_id = null, $client_id = null, $date_start = null, $date_end = null)
    {
        if (empty($date_start) || empty($user_id) || empty($client_id))
        {
            return false;
        }
        if (empty($date_end))
            $date_end = date('Y-m-d');

        return $this->find('all', array(
                    'conditions' => array(
                        'ClientLead.user_id' => $user_id,
                        'ClientLead.client_id' => $client_id,
                        'ClientLead.created >= ' => $date_start,
                        'ClientLead.created <= ' => $date_end,
                    )
        ));
    }

    /**
     * Pobraie leadów wygranych w podanym przedziale czasowym dla wybrnego klienta
     * 
     * @param string $user_id       ID użytkownika
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    function getUserWinLeadsByDate($user_id = null, $client_id = null, $date_start = null, $date_end = null)
    {
        if (empty($date_start) || empty($date_end) || empty($user_id) || empty($client_id))
        {
            return false;
        }

        return $this->find('all', array(
                    'conditions' => array(
                        'ClientLead.user_id' => $user_id,
                        'ClientLead.client_id' => $client_id,
                        'ClientLead.closing_date >= ' => $date_start,
                        'ClientLead.closing_date <= ' => $date_end,
                        'ClientLead.lead_status_id = ' => 6,
                    )
        ));
    }

    /**
     * Pobraie leadów przegranych w podanmym przedziale czasowym dla wybrnego klienta
     * 
     * @param string $user_id       ID użytkownika
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    function getUserLostLeadsByDate($user_id = null, $client_id = null, $date_start = null, $date_end = null)
    {
        if (empty($date_start) || empty($date_end) || empty($user_id) || empty($client_id))
        {
            return false;
        }

        return $this->find('all', array(
                    'conditions' => array(
                        'ClientLead.user_id' => $user_id,
                        'ClientLead.client_id' => $client_id,
                        'ClientLead.closing_date >= ' => $date_start,
                        'ClientLead.closing_date <= ' => $date_end,
                        'ClientLead.lead_status_id = ' => 7,
                    )
        ));
    }

    /**
     * Pobranie wszystkich leadów utworzonych w wybranym przedziale czasowym dla wybrnego klienta
     * 
     * @param string $user_id       ID użytkownika
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    function getAllUserCreatedLeadsByDate($user_id = null, $date_start = null, $date_end = null)
    {
        //die($date_end);
        if (empty($date_start) || empty($date_end) || empty($user_id))
        {
            return false;
        }

        return $this->find('all', array(
                    'conditions' => array(
                        'ClientLead.user_id' => $user_id,
                        'ClientLead.created >= ' => $date_start,
                        'ClientLead.created <= ' => $date_end,
                    )
        ));
    }

    /**
     * Pobraie wszystkich leadów wygranych w podanym przedziale czasowym
     * 
     * @param string $user_id       ID użytkownika
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    function getAllUserWinLeadsByDate($user_id = null, $date_start = null, $date_end = null)
    {
        if (empty($date_start) || empty($date_end) || empty($user_id))
        {
            return false;
        }

        return $this->find('all', array(
                    'conditions' => array(
                        'ClientLead.user_id' => $user_id,
                        'ClientLead.closing_date >= ' => $date_start,
                        'ClientLead.closing_date <= ' => $date_end,
                        'ClientLead.lead_status_id = ' => 6,
                    )
        ));
    }

    /**
     * Pobraie wszystkich leadów przegranych w podanmym przedziale czasowym
     * 
     * @param string $user_id       ID użytkownika
     * @param date $date_start      data początkowa
     * @param date $date_end		data końcowa
     * 			
     * @return mixed        array tablica z leadami
     *                      false w przypadku błędu
     */
    function getAllUserLostLeadsByDate($user_id = null, $date_start = null, $date_end = null)
    {
        if (empty($date_start) || empty($date_end) || empty($user_id))
        {
            return false;
        }

        return $this->find('all', array(
                    'conditions' => array(
                        'ClientLead.user_id' => $user_id,
                        'ClientLead.closing_date >= ' => $date_start,
                        'ClientLead.closing_date <= ' => $date_end,
                        'ClientLead.lead_status_id = ' => 7,
                    )
        ));
    }

    /**
     * Zliczanie leadów uzytkownika.
     * 
     * @param string $user_id       ID użytkownika
     * 			
     * @return mixed        int count z leadów
     *                      false w przypadku błędu
     */
    function countUserLead($user_id = null, $date_from = null, $date_to = null)
    {
        if (!is_array($user_id) and ! $this->User->exists($user_id))
        {
            return false;
        }
        $params = $this->prepapreParamsConditions($user_id, $date_from, $date_to);
        $params['recursive'] = -1;
        $params['fields'] = array('amount');
        $return = $this->find('count', $params);

        return $return;
    }

    /**
     * Zliczanie wartosci leadów uzytkownika.
     * 
     * @param string $user_id       ID użytkownika
     * 			
     * @return mixed        int count z leadów
     *                      false w przypadku błędu
     */
    function countUserLeadAmount($user_id = null, $date_from = null, $date_to = null, $lead_status_id = null)
    {
        $params = $this->prepapreParamsConditions($user_id, $date_from, $date_to, $lead_status_id);
        //$params['conditions'][] = 'ClientLead.closing_date IS NULL';
        $params['recursive'] = -1;
        $params['fields'] = array('id', 'amount');
        $data = $this->find('all', $params);
        if (!$data)
        {
            return false;
        }
        $return = 0;
        foreach ($data as $d)
        {
            $return += $d['ClientLead']['amount'];
        }
        return $return;
    }

    /**
     * Zliczanie wartosci leadów ze statusem nowy.
     * 
     * @param string $user_id       ID użytkownika
     * 			
     * @return mixed        int count z leadów
     *                      false w przypadku błędu
     */
    function amountLeadStatus($user_id = null, $date_from = null, $date_to = null, $status_id = null)
    {
        if (!is_array($user_id) and ! $this->User->exists($user_id))
        {
            return false;
        }
        $params = $this->prepapreParamsConditions($user_id, $date_from, $date_to, $status_id);
        $params['conditions']['lead_status_id'] = 1;
        $params['conditions'][] = 'ClientLead.closing_date IS NULL';
        $params['recursive'] = -1;
        $params['fields'] = array('id', 'amount');
        $return = $this->find('list', $params);

        return $return;
    }

    /**
     * Lejek sprzedazy
     * 
     * @param string $user_id       ID użytkownika
     * 			
     * @return mixed        int count z leadów
     *                      false w przypadku błędu
     */
    function pipeline($user_id = null, $date_from = null, $date_to = null)
    {
        if (empty($user_id))
        {
            return false;
        }
        $leadStatuseIds = array(
            1, //nowy
            3, //Ofertowanie
            5, //Negocjacje
            6 //wygrany
        );
        ClassRegistry::init('LeadStatus');
        $paramStatuse['conditions']['id'] = $leadStatuseIds;
        $leadStatuses = $this->LeadStatus->find('list', $paramStatuse);
        $params = $this->prepapreParamsConditions($user_id, $date_from, $date_to);
        $params['recursive'] = -1;
        $params['fields'] = array('id');
        $max = 1;

        //wyciagam dane
        foreach ($leadStatuseIds as $status_id)
        {
            $params['conditions']['lead_status_id'] = $status_id;
            $datas[$status_id]['count'] = $this->find('count', $params);
            $datas[$status_id]['amount'] = $this->countUserLeadAmount($user_id, $date_from, $date_to, $status_id);
            $max = max($max, $datas[$status_id]['count']);
        }
        //parsuje dane
        foreach ($datas as $status_id => $data)
        {
            if (!isset($lastMax))
            {
                $lastMax = $data['count'];
            }
            if (empty($lastMax))
            {
                $lastMax = 1;
            }
            $return[$status_id]['width'] = ($data['count'] / $max) * 100;
            $return[$status_id]['count'] = $data['count'];
            $return[$status_id]['name'] = $leadStatuses[$status_id];
            $return[$status_id]['name'] .= ' (' . number_format((($data['count'] / $lastMax) * 100), 0) . ' %) ';
            $return[$status_id]['name'] .= $data['amount'] . ' PLN';
            $lastMax = $data['count'];
        }

        return $return;
    }

    /**
     * Kategorie leadów wykres kołowy
     * 
     * @param string $user_id       ID użytkownika
     * 			
     * @return mixed        int count z leadów
     *                      false w przypadku błędu
     */
    function pieCategory($user_id = null, $date_from = null, $date_to = null, $lead_status_id = null)
    {
        if (empty($user_id))
        {
            return false;
        }

        $leadCategories = $this->LeadCategory->find('list');
        $params = $this->prepapreParamsConditions($user_id, $date_from, $date_to, $lead_status_id);
        $params['recursive'] = -1;
        $params['fields'] = array('lead_category_id', 'COUNT(*) as count');
        $params['group'] = 'lead_category_id';

        //wyciagam dane
        $leads = $this->find('all', $params);
        //parsuje dane
        $return = $this->parsePieChart($leads, $leadCategories);
        return $return;
    }

    /**
     * przetwarznie danych do wyrkresu kołowego
     * 
     * @param string $leads       lista leadów
     * @param string $leadCategories       lista kategori leadow
     * 			
     * @return mixed        int count z leadów
     *                      false w przypadku błędu
     */
    public function parsePieChart($leads = array(), $leadCategories = array())
    {
        $sum = 0;
        foreach ($leads as $lead)
        {
            $lead_category_id = $lead['ClientLead']['lead_category_id'];
            $count = $lead[0]['count'];

            $sum += $count;
            //parasowanie do tabeli dane
            $leadCount[$lead_category_id] = $lead[0]['count'];

            //parsowanie do wykresu
            $return['data'][] = array(
                'label' => empty($leadCategories[$lead_category_id]) ? 'brak danych' : $leadCategories[$lead_category_id],
                'data' => $lead[0]['count'],
            );
        }
        //parsowanie do tabeli
        foreach ($leadCategories as $lead_category_id => $category)
        {
            $count = empty($leadCount[$lead_category_id]) ? 0 : $leadCount[$lead_category_id];
            $leadCategory[] = array(
                'name' => $category,
                'count' => $count,
                'percent' => empty($sum) ? 0 : round(($count / $sum) * 100),
            );
        }
        $return['leadCategories'] = $leadCategory;
        return $return;
    }

    /**
     * Kategorie leadów wykres kołowy
     * 
     * @param string $user_id       ID użytkownika
     * @param string $date_from       data od
     * @param string $date_to       data do
     * 			
     * @return mixed        array dane do wyresu
     *                      false w przypadku błędu
     */
    function pieCustomerSales($user_id = null, $date_from = null, $date_to = null)
    {
        if (empty($user_id))
        {
            return false;
        }

        $params = $this->prepapreParamsConditions($user_id, $date_from, $date_to);
        $params['recursive'] = -1;
        $params['fields'] = array('client_id', 'COUNT(*) as count', 'SUM(`amount`) as sum');
        $params['group'] = 'client_id';

        //wyciagam dane
        $leads = $this->find('all', $params);
        $clientIds = Set::combine($leads, '{n}.ClientLead.client_id', '{n}.ClientLead.client_id');
        $clientParam['conditions']['Client.id'] = $clientIds;
        $clientParam['fields'] = array('id', 'name');
        $clientsList = $this->Client->find('list', $clientParam);
        //parsuje dane
        $clients = $clients = $data = array();

        foreach ($leads as $lead)
        {
            $client_id = $lead['ClientLead']['client_id'];
            $name = empty($clientsList[$client_id]) ? 'brak danych' : $clientsList[$client_id];
            $data[] = array(
                'label' => $name,
                'data' => $lead[0]['count'],
            );

            //
            $clients[] = array(
                'name' => $name,
                'count' => $lead[0]['count'],
                'sum' => $lead[0]['sum']
            );
        }
        $return['clients'] = $clients;
        $return['data'] = $data;
        return $return;
    }

    /* Wartość podpisanych umów
     * 
     * @param string $user_id       ID użytkownika
     * @param string $date_from     data od
     * @param string $date_to       data do
     * 			
     * @return mixed        array danymi do wykresu
     *                      false w przypadku błędu
     */

    function valueContracts($user_id = null, $date_from = null, $date_to = null)
    {
        if (empty($user_id))
        {
            return false;
        }
        $status = 6;
        $params = $this->prepapreParamsConditions($user_id, $date_from, $date_to, $status);
        $params['recursive'] = -1;
        $params['order'] = 'created ASC';
        $params['fields'] = array('created', 'amount', 'name');
        $data = array();
        //wyciagam dane
        $leads = $this->find('all', $params);
        foreach ($leads as $lead)
        {
            $data[] = $lead['ClientLead'];
        }

        $return['data'] = $data;
        return $return;
    }

    /* Przygodtowanie danych do condition finda
     * 
     * @param string $user_id       ID użytkownika
     * @param string $date_from     data od
     * @param string $date_to       data do
     * 			
     * @return mixed        array z parametrami
     *                      false w przypadku błędu
     */

    public function prepapreParamsConditions($user_id = null, $date_from = null, $date_to = null, $lead_status_id = null)
    {
        $params['conditions']['user_id'] = $user_id;
        if (!empty($date_from))
        {
            $params['conditions']['AND'][]['ClientLead.created >='] = $date_from;
        }
        if (!empty($date_to))
        {
            $params['conditions']['AND'][]['ClientLead.created <='] = $date_to;
        }
        if (!empty($lead_status_id))
        {
            $params['conditions']['ClientLead.lead_status_id'] = $lead_status_id;
        }
        return $params;
    }

}
