<?php

App::uses('PollAppModel', 'Poll.Model');

/**
 * Description of PollQuestion
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class PollAnswer extends PollAppModel {

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
        'PollQuestion' => array(
            'className' => 'Poll.PollQuestion',
            'foreignKey' => 'poll_question_id',
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
     * Validation rules domain
     *
     * @access public
     * @var string
     */
    public $validationDomain = 'validate';

    /**
     * Validation rules
     *
     * @access public
     * @var array
     */
    public $validate = array(
        'answer' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Proszę udzielić odpowiedzi na to pytanie',
            )
        ),
    );

    /**
     * Display field
     *
     * @access public
     * @var string
     */
    public $displayField = 'answer';

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
