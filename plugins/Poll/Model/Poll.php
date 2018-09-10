<?php

//ANKIETY

App::uses('PollAppModel', 'Poll.Model');
App::uses('FebEmail', 'Lib');

/**
 * Description of Poll
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class Poll extends PollAppModel {

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
        'ClientProject' => array(
            'className' => 'ClientProject',
            'foreignKey' => 'client_project_id',
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
        'PollQuestion' => array(
            'className' => 'Poll.PollQuestion',
            'foreignKey' => 'poll_id',
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
    public $displayField = 'client_project_id';

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

    /**
     * afterFind
     *
     * @access public
     * @param array $results
     * @param boolean $primary
     * @return mixed
     */
    public function afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);

        foreach ($results as &$value) {
            if (!isset($value[$this->alias]) || !is_array($value[$this->alias])) {
                continue;
            }
            $value[$this->alias]['hash'] = $this->encrypt($value[$this->alias]['id']);
        }
        return $results;
    }

    /**
     * Create hash out of provided string.
     *
     * @access public
     * @param string|null $string    String that needs to be encrypted
     * @return string
     */
    public function encrypt($string = null) {
        return strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, 'PR3t5mupEger2TebretrU3AZek2s8ta', $string, MCRYPT_MODE_ECB)), '+/=', '-_.');
    }

    /**
     * Decode hash and returns original string
     *
     * @access public
     * @param string|null $hash      Encrypted string that needs to be decrypted
     * @return string
     */
    public function decrypt($hash = null) {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, 'PR3t5mupEger2TebretrU3AZek2s8ta', base64_decode(strtr($hash, '-_.', '+/=')), MCRYPT_MODE_ECB));
    }

    /**
     * Create poll [lub bardziej po polsku - tworzeie ankiety, polecam komentarze po polsku
     *
     * @access public
     * @param int|null $client_project_id
     * @return boolean
     */
    public function createPoll($client_project_id = null) {
        // Poll for this project already exists
        $poll = $this->find('first', array(
            'conditions' => array(
                'Poll.client_project_id' => $client_project_id
            )
        ));
        // Get project details
        $this->ClientProject->Behaviors->load('Containable');
        $project = $this->ClientProject->find('first', array(
            'conditions' => array(
                'ClientProject.id' => $client_project_id
            ),
            'contain' => array(
                'User',
                'Client',
                'ClientProjectBudget' =>array(
                    'ClientProjectBudgetPosition',
                ),
                'ClientProjectShedule'
            )
        ));

        // Project does not exists
        // Poll already exists
        if (empty($project) || !empty($poll)) {
            return false;
        }

        // Create poll array
        $data['Poll'] = array(
            'client_project_id' => $project['ClientProject']['id']
        );
        
        $data['PollQuestion'] = $this->buildQuestions($project['ClientProjectShedule'], $project['Client']['user_id']);
//        $data['PollQuestion'] = $this->buildQuestions($project['ClientProjectBudget']['ClientProjectBudgetPosition'], $project['Client']['user_id']);

        // Save poll along with associated data
        $result = $this->saveAssociated($data, array(
            'validate' => false,
            'deep' => true,
        ));

        return $result;
    }

    /**
     * Build questions array out of provided data.
     *
     * @access public
     * @param type $projectBudgetPositions
     * @param type $userId
     * @return string
     */
    public function buildQuestions($projectBudgetPositions = array(), $userId = null) {
        $budgetPositions[] = array(
            'type' => 1,
            'question' => 'Ogólna ocena projektu',
            'PollAnswer' => array(
                'user_id' => $userId,
            ),
        );
        foreach ($projectBudgetPositions as $budgetPosition) {
            $budgetPositions[] = array(
                'type' => 1,
                'question' => $budgetPosition['name'],
                'PollAnswer' => array(
                    'user_id' => $userId,
                ),
            );
        }
        $budgetPositions[] = array(
            'type' => 0,
            'question' => 'Komentarz',
            'PollAnswer' => array(
                'user_id' => $userId,
            ),
        );
        return $budgetPositions;
    }

    /**
     * Send link to the poll.
     *
     * @access public
     * @param int $client_project_id
     * @param boolean $first
     * @param boolean $merchant
     * @return array
     */
    public function sendPoll($client_project_id, $first = true, $merchant = false) {
        // Poll for this project already exists
        $poll = $this->find('first', array(
            'conditions' => array(
                'Poll.client_project_id' => $client_project_id
            ),
            'contain' => array(
                'ClientProject',
                'ClientProject.Client',
                'ClientProject.ClientLead',
                'ClientProject.User',
                'ClientProject.Client.User',
                'ClientProject.ClientLead.User',
                'PollQuestion',
                'PollQuestion.PollAnswer',
            )
        ));
        $targetEmail = $poll['ClientProject']['Client']['email'];

        if (!empty($merchant)) {
            $targetEmail = $poll['ClientProject']['User']['email'];
        }

        // Send email
        try {
            $email = new FebEmail('smtp');
            $email->viewVars(array(
                'poll' => $poll
            ));
            $email->template('Poll.poll_notification')
                ->emailFormat('html')
                ->to(array($targetEmail))
                ->from(array('crm@febdev.pl' => 'crm@febdev.pl'))
                ->subject(__d('email', 'Ankieta'));
            $email->send();
            $email->reset();

            // Save project log
            $log = array();
            $log['ClientProjectLog']['user_id'] = $poll['ClientProject']['Client']['user_id'];
            $log['ClientProjectLog']['client_project_id'] = $client_project_id;
            $log['ClientProjectLog']['name'] = 'Wysyłka maila z ankietą';

            $this->ClientProjectLog = ClassRegistry::init('ClientProjectLog');
            $this->ClientProjectLog->saveLog(32, $log);

            if (!empty($first)) {
                // Save notification log
                $this->saveNotificationLog($poll['Poll']['id'], $poll['ClientProject']['Client']['user_id']);
            }
        } catch (Exception $ex) {
            return array(
                'status' => false,
                'message' => $ex->getMessage(),
            );
        }
        return array(
            'status' => true,
            'message' => '',
        );
    }

    /**
     * Save notification log
     *
     * @access public
     * @param int $poll_id
     * @param string $user_id
     * @return array|boolean
     */
    public function saveNotificationLog($poll_id, $user_id) {
        $now = new DateTime();

        // First one is already sent
        $notificationLog[] = array(
            'PollNotificationLog' => array(
                'user_id' => $user_id,
                'poll_id' => $poll_id,
                'action_date' => $now->format('Y-m-d H:i:s'),
                'type' => 0,
                'status' => 1,
            )
        );
        // Two more notifications
        $now->modify('+7 day');
        $notificationLog[] = array(
            'PollNotificationLog' => array(
                'user_id' => $user_id,
                'poll_id' => $poll_id,
                'action_date' => $now->format('Y-m-d H:i:s'),
                'type' => 0,
                'status' => 0,
            )
        );
        $now->modify('+7 day');
        $notificationLog[] = array(
            'PollNotificationLog' => array(
                'user_id' => $user_id,
                'poll_id' => $poll_id,
                'action_date' => $now->format('Y-m-d H:i:s'),
                'type' => 1,
                'status' => 0,
            )
        );
        $this->PollNotificationLog = ClassRegistry::init('PollNotificationLog');
        return $this->PollNotificationLog->saveMany($notificationLog);
    }

    /**
     * Send email with poll results to provided recipients.
     *
     * @access public
     * @param int $client_project_id
     * @param array $emails
     * @return boolean
     */
    public function sendPollResult($poll_id, $emails = array()) {
        // Poll for this project already exists
        $poll = $this->find('first', array(
            'conditions' => array(
                'Poll.id' => $poll_id
            ),
            'contain' => array(
                'ClientProject',
                'ClientProject.Client',
                'PollQuestion',
                'PollQuestion.PollAnswer',
            )
        ));
        try {
            $email = new FebEmail('smtp');
            $email->viewVars(array(
                'poll' => $poll
            ));
            $email->template('Poll.poll_result')
                ->emailFormat('html')
                ->to($emails)
                ->from(array('crm@febdev.pl' => 'crm@febdev.pl'))
                ->subject(__d('email', 'Ankieta'));
            $email->send();
            $email->reset();
        } catch (Exception $ex) {
            return false;
        }
        return true;
    }
    
    /**
     * Get bosses emails
     * 
     * @access public
     * @param void
     * @return array
     */
    public function getSectionBossesEmails() {
        $this->Section = ClassRegistry::init('Section');
        $params['recursive'] = -1;
        $params['joins'] = array(
            array('table' => 'user_users',
                'alias' => 'User',
                'type' => 'LEFT',
                'conditions' => array(
                    'User.id = Section.supervisor',
                )
            ),
        );
        $params['fields'] = array('User.id', 'User.email');
        $params['conditions'] = array(
            'User.email IS NOT NULL'
        );
        $emails = $this->Section->find('list', $params);
        return $emails;
    }

}
