<?php

App::uses('ProjectMockupsAppModel', 'ProjectMockups.Model');

/**
 * Description of ProjectMockupNode
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class ProjectMockupNode extends ProjectMockupsAppModel {

    /**
     * Behaviors
     *
     * @access public
     * @var array
     */
    public $actsAs = array(
        'Containable'
    );

    /**
     * belongsTo associations
     *
     * @access public
     * @var array
     */
    public $belongsTo = array(
        'ProjectMockup' => array(
            'className' => 'ProjectMockups.ProjectMockup',
            'foreignKey' => 'project_mockup_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    /**
     * hasMany associations
     *
     * @access public
     * @var array
     */
    public $hasMany = array(
        'ProjectMockupComment' => array(
            'className' => 'ProjectMockups.ProjectMockupComment',
            'foreignKey' => 'project_mockup_node_id',
            'dependent' => true
        ),
    );

    /**
     * Validation rules
     *
     * @access public
     * @var array
     */
    public $validate = array();

    /**
     * Display field
     *
     * @access public
     * @var string
     */
    public $displayField = 'node';

    /**
     * Class constructor
     *
     * @access public
     * @param boolean|integer|string|array $id
     * @param string $table
     * @param string $ds
     * @return void
     */
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
    }

}
