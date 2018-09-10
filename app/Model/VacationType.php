<?php

App::uses('AppModel', 'Model');

/**
 * VacationType Model
 *
 * @package b2b
 * @property Vacation $Vacation
 */
class VacationType extends AppModel
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
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Vacation' => array(
            'className' => 'Vacation',
            'foreignKey' => 'vacation_type_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
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
     * Pobieranie wszystkich typów
     * 
     * @return mixed            array z typami
     *                          false w przypładku błedów
     *                          NULL w przypładku braków rekordow
     */
    function listTypes()
    {
        return $this->find('list');
    }

    /**
     * Pobieranie szczegółów typu urlopu.
     * 
     * @params string       $type_id    ID typu
     * @return array|bool               Jeśli typ istnieje to dane typu, jeśli nie - false
     */
    public function getType($type_id)
    {
        if (!$type_id)
        {
            return false;
        }

        $params['conditions'] = array(
            'VacationType.id' => $type_id
        );
        $params['recursive'] = -1;
        $params['fields'] = $this->fields;

        $type = $this->find('first', $params);

        return !empty($type) ? $type : false;
    }

}
