<?php

App::uses('PollAppModel', 'Poll.Model');

/**
 * Description of PollQuestion
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class PollQuestion extends PollAppModel {

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
        'Poll' => array(
            'className' => 'Poll.Poll',
            'foreignKey' => 'poll_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    /**
     * hasOne associations
     *
     * @access public
     * @var array
     */
    public $hasOne = array(
        'PollAnswer' => array(
            'className' => 'Poll.PollAnswer',
            'foreignKey' => 'poll_question_id',
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
    public $displayField = 'question';

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
