<?php

App::uses('PollAppModel', 'Poll.Model');

/**
 * Description of PollQuestion
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class PollNotificationLog extends PollAppModel {

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
        'poll_id' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Pole nie może być puste',
            )
        ),
//        'user_id' => array(
//            'required' => array(
//                'rule' => 'notEmpty',
//                'message' => 'Pole nie może być puste',
//            )
//        ),
        'action_date' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Pole nie może być puste',
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
