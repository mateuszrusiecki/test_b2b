<?php

App::uses('AppModel', 'Model');

/**
 * ChecklistPosition Model
 *
 * @property ChecklistPositionUserGroup $ChecklistPositionUserGroup
 */
class ChecklistPosition extends AppModel
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
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'ChecklistPosition.created DESC';

    /**
     * hasMany associations
     *
     * @var array
     */
    var $hasAndBelongsToMany = array(
        'Group' => array(
            'className' => 'User.Group',
            'joinTable' => 'checklist_position_groups',
            'foreignKey' => 'checklist_position_id',
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
    );

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
//        $params['conditions']['OR']["ChecklistPosition.name LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }

    /**
     * Bindowanie w locie ChecklistPosition do Group
     * $params void       
     * @return void        
     */
    public function bindGroup()
    {
        $this->Group->bindModel(
                array('hasAndBelongsToMany' => array(
                'ChecklistPosition' => array(
                    'className' => 'ChecklistPosition',
                    'joinTable' => 'checklist_position_groups',
                    'foreignKey' => 'group_id',
                    'associationForeignKey' => 'checklist_position_id',
                )
            )
                ), false
        );
    }

    /**
     * Akcja pobierająca pozycje z danej grupy uprawnień
     * $params string       $group_id //id grupy
     * @return array        tablica z pozycjami
     */
    public function positionsFromGroup($group_id = null)
    {
        $params['joins'] = array(
            array(
                'table' => 'checklist_position_groups',
                'alias' => 'ChecklistPositionGroup',
                'type' => 'INNER',
                'conditions' => array(
                    'ChecklistPosition.id = ChecklistPositionGroup.checklist_position_id',
                    'ChecklistPositionGroup.group_id' => $group_id
                )
            )
        );
        $params['fields'] = array('ChecklistPosition.*');
        $params['recursive'] = -1;
        $data = $this->find('all', $params);
        return $data;
    }

}
