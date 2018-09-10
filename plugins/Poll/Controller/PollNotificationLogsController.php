<?php

App::uses('PollAppController', 'Poll.Controller');

/**
 * PollNotificationLogsController
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class PollNotificationLogsController extends PollAppController {

    /**
     * Default layout
     * 
     * @access public
     * @var string
     */
    public $layout = 'default';

    /**
     * Helpers
     * 
     * @access public
     * @var array
     */
    public $helpers = array(
        'Metronic',
        'Html',
    );

    /**
     * beforeFilter
     * 
     * @access public
     * @param void
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow(array(
            'cron',
        ));
    }

    /**
     * Cron action to send email confirmation
     *
     * @access public
     * @param void
     * @return void
     */
    public function cron() {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('Poll.Poll');

        // Get notifications that needs to be dealt with
        $now = new DateTime();
        $notifications = $this->PollNotificationLog->find('all', array(
            'contain' => array(
                'Poll',
//                'Poll.ClientProject',
//                'Poll.ClientProject.Client',
//                'Poll.ClientProject.User',
            ),
            'conditions' => array(
                'PollNotificationLog.action_date <=' => $now->format('Y-m-d H:i:s'),
                'PollNotificationLog.status' => 0,
            )
        ));

        // Send emails
        foreach ($notifications as $notification) {
            // Already filleed
            if ($notifications['Poll']['filled']) {
                $result = array(
                    'message' => 'Ankieta wypełniona',
                    'status' => 1,
                );
            } else {
                $result = $this->Poll->sendPoll($notification['Poll']['client_project_id'], false, $notification['PollNotificationLog']['type']);
            }
            $this->PollNotificationLog->save(array(
                'PollNotificationLog' => array(
                    'id' => $notification['PollNotificationLog']['id'],
                    'message' => $result['message'],
                    'status' => (!empty($result['status']) ? 1 : 2),
                )
            ));
        }
    }

}
