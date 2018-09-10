<?php

App::uses('ProjectMockupsAppModel', 'ProjectMockups.Model');

/**
 * Description of ProjectMockupComment
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class ProjectMockupComment extends ProjectMockupsAppModel {

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
        'ProjectMockupNode' => array(
            'className' => 'ProjectMockups.ProjectMockupNode',
            'foreignKey' => 'project_mockup_node_id',
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
     * hasMany associations
     *
     * @access public
     * @var array
     */
    public $hasMany = array(
        'ProjectMockupComment' => array(
            'className' => 'ProjectMockups.ProjectMockupComment',
            'foreignKey' => 'parent_id',
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
    public $displayField = 'comment';

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
    
    public function afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);

        foreach ($results as &$value) {
            if (isset($value[$this->alias]['position'])) {
                $value[$this->alias]['position'] = json_decode($value[$this->alias]['position']);
            }
        }
        return $results;
    }

}
