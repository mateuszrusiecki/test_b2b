<?php

App::uses('AppModel', 'Model');

/**
 * ClientContact Model
 *
 * @property Client $Client
 */
class ClientContact extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();

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
        )
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'ClientLead' => array(
            'className' => 'ClientLead',
            'joinTable' => 'client_contact_client_leads',
            'foreignKey' => 'client_contact_id',
            'associationForeignKey' => 'client_lead_id',
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
     * Pobranie osób kontaktowych danego klienta
     * 
     * @param int $client_id    ID klienta
     * @return mixed            array Lista osób kontaktowych
     *                          false w przypadku błędu
     */
    function getClientContacts($client_id = null)
    {
        if (!$client_id)
        {
            return false;
        }

        $toReturn = $this->find('all', array(
            'conditions' => array(
                'ClientContact.client_id' => $client_id
            ),
            'order' => 'ClientContact.modified desc',
            'recursive' => -1
        ));

        return empty($toReturn) ? false : $toReturn;
    }

    /**
     * Pobranie osób kontaktowych po id
     * 
     * @param int $id    ID klienta
     * @return mixed            array Lista osób kontaktowych
     *                          false w przypadku błędu
     */
    function getClientContact($id = null)
    {
        if (!$id)
        {
            return false;
        }

        $toReturn = $this->find('all', array(
            'conditions' => array(
                'ClientContact.id' => $id
            ),
            'order' => 'ClientContact.modified desc',
            'recursive' => -1
        ));

        return empty($toReturn) ? false : $toReturn;
    }

    /**
     * Dodawanie osoby kontaktowej
     * 
     * @param array $contact    Osoba kontaktowa wraz z client_id
     * 
     * @return mixed            array Zapisana osoba
     *                          false w przypadku błędu
     */
    function addClientContact($contact = array())
    {
        if (empty($contact) || empty($contact['ClientContact']['client_id']))
        {
            return false;
        }

        if (!isset($contact['ClientContact']['id']))
        {
            $this->create();
        }
        return $this->save($contact);
    }

    /**
     * Usuwanie osoby kontaktowej
     * 
     * @param int $contact_id   ID osoby
     * @return boolean          true po pomyślnym usunięciu
     *                          false w przypadku błędu
     */
    function deleteClientContact($contact_id = null)
    {
        if (!$contact_id)
        {
            return false;
        }

        $this->id = $contact_id;

        if (!$this->exists())
        {
            return false;
        }
        return $this->saveField('delete', 1);
    }

}
