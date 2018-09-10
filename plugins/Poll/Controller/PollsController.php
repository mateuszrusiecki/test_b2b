<?php

App::uses('PollAppController', 'Poll.Controller');

/**
 * PollsController
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class PollsController extends PollAppController {

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
            'fill',
            'developer',
        ));
    }

    /**
     * User polls list
     * 
     * @access public
     * @param void
     * @return void
     */
    public function index() {
        $this->helpers[] = 'FebTime';

        $title = __d('poll', 'Ankiety');
        $subtitle = __d('poll', 'Lista ankiet');
        
        // Get current user projects list
        $this->loadModel('Client');
        $this->loadModel('ClientProject');
        $client = $this->Client->getClientForUser($this->Auth->user('id'));
        $projects = $this->ClientProject->find('list', array(
            'conditions' => array(
                'ClientProject.client_id' => $client['Client']['id']
            )
        ));

        $params['conditions'] = array(
            'Poll.client_project_id' => $projects
        );
        $params['contain'] = array(
            'ClientProject',
            'ClientProject.Client',
            'ClientProject.Client.User',
            'PollQuestion',
            'PollQuestion.PollAnswer',
        );
        $params['order'] = 'Poll.id DESC';
        $params['limit'] = 25;
        $this->paginate = $params;
        $polls = $this->paginate();

        $this->set(compact('title', 'subtitle', 'polls'));
    }

    /**
     * User poll fill
     *
     * @access public
     * @param int|null $poll_hash_id
     * @return void
     */
    public function fill($poll_hash_id = null) {
        $title = __d('poll', 'Ankiety');
        $subtitle = __d('poll', 'Wypełnianie ankiety');

        // Decode hash
        $poll_id = $this->Poll->decrypt($poll_hash_id);
        $poll = $this->Poll->find('first', array(
            'conditions' => array(
                'Poll.id' => $poll_id
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
        if (empty($poll)) {
            $this->Session->setFlash(__d('poll', 'Ankieta nie została odnaleziona.'), 'flash/error');
            return $this->redirect($this->referer());
        }
        if (!empty($poll['Poll']['filled'])) {
            $this->Session->setFlash(__d('poll', 'Wypełniłeś już tę ankietę.'), 'flash/info');
            return $this->redirect($this->referer());
        }

        // Save answers
        if (!empty($this->request->data)) {
            $this->loadModel('Poll.PollAnswer');
            $result = $this->PollAnswer->saveMany($this->request->data['poll']);

            if (!empty($result)) {
                // Save log
                $this->loadModel('ClientProjectLog');
                $log = array();
                $log['ClientProjectLog']['user_id'] = $poll['ClientProject']['Client']['user_id'];
                $log['ClientProjectLog']['client_project_id'] = $poll_id;
                $log['ClientProjectLog']['name'] = 'Wypełnienie ankiety';
                $this->ClientProjectLog->saveLog(33, $log);

                // Mark poll as filled
                $now = new DateTime();
                $this->Poll->save(array(
                    'Poll' => array(
                        'id' => $poll_id,
                        'filled' => true,
                        'fill_date' => $now->format('Y-m-d H:i:s'),
                    )
                ));
                // Send emails
                $emails = array_values($this->Poll->getSectionBossesEmails());
                if (!empty($poll['User']['email'])) {
                    $emails[] = $poll['User']['email'];
                }
                $emails[] = $poll['ClientProject']['Client']['email'];
                $emails[] = $poll['ClientProject']['ClientLead']['User']['email'];
                $uniqueEmails = array_unique($emails);
                $this->Poll->sendPollResult($poll_id, $uniqueEmails);

                $this->Session->setFlash(__d('poll', 'Twoje odpowiedzi zostały zapisane. Dziękujemy za udział w ankiecie.'), 'flash/success');
                return $this->redirect('/');
            } else {
                $this->Session->setFlash(__d('poll', 'Wystąpił niespodziewany błąd.'), 'flash/error');
            }
        }

        $this->set(compact('title', 'subtitle', 'clients', 'poll'));
    }

    /**
     * Admin polls list
     *
     * @access public
     * @param void
     * @return void
     */
    public function admin_index() {
        $title = __d('poll', 'Ankiety');
        $subtitle = __d('poll', 'Lista ankiet');

        $this->helpers[] = 'FebTime';

        $params['contain'] = array(
            'ClientProject',
            'ClientProject.Client',
            'ClientProject.Client.User',
            'PollQuestion',
            'PollQuestion.PollAnswer',
        );
        $params['order'] = 'Poll.id DESC';
        $params['limit'] = 25;
        $this->paginate = $params;
        $polls = $this->paginate();

        $this->set(compact('title', 'subtitle', 'polls'));
    }

    /**
     * Poll view
     *
     * @access public
     * @param string|null $field
     * @param int|null $value
     * @return void
     */
    public function view($field = null, $value = null) {
        $this->admin_view($field, $value);
    }

    /**
     * Admin poll view
     *
     * @access public
     * @param string|null $field
     * @param int|null $value
     * @return void
     */
    public function admin_view($field = null, $value = null) {
        $title = __d('poll', 'Ankiety');
        $subtitle = __d('poll', 'Podgląd ankiety');

        if (!in_array($field, array('id', 'client_project_id'))) {
            throw new BadRequestException(__d('poll', 'Błędne zapytanie'));
        }
        $poll = $this->Poll->find('first', array(
            'order' => array(
                'Poll.fill_date' => 'desc'
            ),
            'conditions' => array(
                'Poll.' . $field => $value
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
        if (empty($poll)) {
            $this->Session->setFlash(__d('poll', 'Brak ankiety dla tego projektu. Zamknij projekt aby ją utworzyć.'), 'flash/info');
            return $this->redirect($this->referer());
        }
        $this->set(compact('title', 'subtitle', 'poll'));
    }

    /**
     * Admin poll raport
     *
     * @access public
     * @param int|null $poll_id
     * @return void
     */
    public function admin_report($poll_id = null) {
        $title = __d('poll', 'Ankiety');
        $subtitle = __d('poll', 'Raport z ankiety');
        $this->set(compact('title', 'subtitle'));
    }

}
