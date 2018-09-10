<?php

App::uses('AppModel', 'Model');

/**
 * ClientNote Model
 *
 * @package b2b
 * @property Client $Client
 * @property User $User
 */
class ClientNote extends AppModel
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
    public $displayField = 'title';

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
     * Pobranie notatek przypisanych do danego klienta dodanych przez danego usera
     * 
     * @param string $user_id   ID Usera
     * @param int $client_id    ID klienta
     * 
     * @return mixed            array Notatki
     *                          false w przypadku błędu
     */
    function getClientNotes($user_id = null, $client_id = null)
    {
        if (!$user_id || !$client_id)
        {
            return false;
        }

        $toReturn = $this->find('all', array(
            'conditions' => array(
                'ClientNote.user_id' => $user_id,
                'ClientNote.client_id' => $client_id
            ),
            'recursive' => -1
        ));

        return empty($toReturn) ? false : $toReturn;
    }

    /**
     * Dodawanie notatki do klienta
     * 
     * @param array $note   Notatka wraz z user_id i client_id
     * 
     * @return mixed        array Zapisana notatka
     *                      false w przypadku błędu
     */
    function addClientNote($note = array())
    {
        if (empty($note))
        {
            return false;
        }

        if (empty($note['ClientNote']['client_id']) || empty($note['ClientNote']['user_id']) ||
                empty($note['ClientNote']['content']) || empty($note['ClientNote']['title']))
        {
            return false;
        }

        return $this->save($note);
    }

    /**
     * Usuwanie notatki
     * 
     * @param int $id   ID notatki
     * @return boolean  true po pomyślnym usunięciu
     *                  false w przypadku błędu
     */
    function deleteClientNote($id = null)
    {
        if (!$id)
        {
            return false;
        }

        $this->id = $id;
        return $this->delete();
    }

}
