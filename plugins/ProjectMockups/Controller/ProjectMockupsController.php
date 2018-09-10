<?php

App::uses('ProjectMockupsAppController', 'ProjectMockups.Controller');

/**
 * ProjectMockupsController
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class ProjectMockupsController extends ProjectMockupsAppController {

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
     * Components
     * 
     * @access public
     * @var array
     */
    public $components = array();

    /**
     * beforeFilter
     * 
     * @access public
     * @param void
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();

        // Allow all methods (tmp)
        $this->Auth->allow();
    }

    /**
     * Display all project mockups
     *
     * @access public
     * @param int|null $client_project_id
     * @return void
     */
    public function index($client_project_id = null) {
        $title = __d('project_mockups', 'Makiety');
        $subtitle = __d('project_mockups', 'Lista makiet');

        $mockups = $this->ProjectMockup->find('all', array(
            'conditions' => array(
                'ProjectMockup.client_project_id' => $client_project_id,
                'ProjectMockup.visible' => true,
            )
        ));
        $this->set(compact('title', 'subtitle'));
        $this->set(compact('mockups'));
    }

    /**
     * View mockup
     *
     * @access public
     * @param int $client_project_id
     * @param string $version
     * @return void
     */
    public function view($client_project_id, $version) {
        $this->layout = 'ProjectMockups.mockup';

        $title = __d('project_mockups', 'Makiety');
        $subtitle = __d('project_mockups', 'Podgląd makiety');

        $mockup = $this->ProjectMockup->find('first', array(
            'conditions' => array(
                'ProjectMockup.client_project_id' => $client_project_id,
                'ProjectMockup.version' => $version,
            )
        ));
        if (empty($mockup)) {
            throw new NotFoundException(__('Strona nie istnieje.'));
        }
        $this->set(compact('title', 'subtitle'));
        $this->set(compact('mockup'));
    }

    /**
     * Cron task for unzipping mockups
     *
     * @access public
     * @param void
     * @return void
     */
    public function cron() {
        $this->layout = false;
        $this->autoRender = false;

        // Get list of mockups
        $this->loadModel('ProjectFile');
        $mockups = $this->ProjectFile->find('all', array(
            'conditions' => array(
                'ProjectFileCategory.slug' => 'mockup'
            )
        ));
        if (!empty($mockups)) {
            foreach ($mockups as $mockup) {
                $this->ProjectMockup->unpackMockup($mockup);
            }
        }
        echo 'OK';
    }

    public function api_get_data() {
        $this->layout = false;
        $this->autoRender = false;

        $result = $this->ProjectMockup->find('first', array(
            'contain' => array(
                'ClientProject',
                'ProjectMockupNode',
                'ProjectMockupNode.ProjectMockupComment',
                'ProjectMockupNode.ProjectMockupComment.User',
                'ProjectMockupNode.ProjectMockupComment.User.Profile',
                'ProjectMockupNode.ProjectMockupComment.ProjectMockupComment',
                'ProjectMockupNode.ProjectMockupComment.ProjectMockupComment.User',
                'ProjectMockupNode.ProjectMockupComment.ProjectMockupComment.User.Profile',
            ),
            'conditions' => array(
                'ProjectMockup.client_project_id' => $this->request->query['ProjectMockup']['client_project_id'],
                'ProjectMockup.version' => $this->request->query['ProjectMockup']['version'],
            )
        ));
        $result['ProjectMockupNode'] = Hash::combine($result['ProjectMockupNode'], '{n}.url', '{n}');

        $toolsEnabled = false;
        if ($this->Auth->user()) {
            $this->loadModel('User.User');
            $this->User->Behaviors->load('Containable');
            $results = $this->User->find('first', array(
                'contain' => array(
                    'Group',
                    'Section',
                ),
                'conditions' => array(
                    'User.id' => $this->Auth->user('id')
                )
            ));
            if (!empty($results['Group'])) {
                foreach ($results['Group'] as $group) {
                    if (in_array($group['alias'], array('superAdmins', 'client', 'm_trader', 'w_trader', 'm_it'))) {
                        $toolsEnabled = true;
                    }
                }
            }
        }
        $result['toolsEnabled'] = $toolsEnabled;

        $this->response->type('json');
        $this->response->body(json_encode($result));
    }
    
    public function api_get_user_credentials() {
        $this->layout = false;
        $this->autoRender = false;

        $toolsEnabled = false;
        $results = array();
        if ($this->Auth->user()) {
            $this->loadModel('User.User');
            $this->User->Behaviors->load('Containable');
            $results = $this->User->find('first', array(
                'contain' => array(
                    'Group',
                    'Section',
                ),
                'conditions' => array(
                    'User.id' => $this->Auth->user('id')
                )
            ));
            if (!empty($results['Group'])) {
                foreach ($results['Group'] as $group) {
                    if (in_array($group['alias'], array('superAdmins'))) {
                        $toolsEnabled = true;
                    }
                }
            }
        }
        $this->response->type('json');
        $this->response->body(json_encode(array(
            'toolsEnabled' => $toolsEnabled
        )));
    }
    
    public function api_accept() {
        $this->layout = false;
        $this->autoRender = false;
        
        $this->ProjectMockup->ProjectMockupNode->id = $this->request->query['ProjectMockupNode']['id'];
        if ($this->ProjectMockup->ProjectMockupNode->exists()) {
            $this->ProjectMockup->ProjectMockupNode->save(array(
                'ProjectMockupNode' => array(
                    'id' => $this->request->query['ProjectMockupNode']['id'],
                    'accepted' => $this->request->query['ProjectMockupNode']['accepted'],
                )
            ));
            $result = array(
                'success' => true
            );
        } else {
            $result = array(
                'success' => false
            );
        }
        $this->response->type('json');
        $this->response->body(json_encode($result));
    }

    public function api_get() {
        $nodes = array();
        $this->layout = false;
        $this->autoRender = false;

        if (!empty($this->request->query)) {
            $value = $this->ProjectMockup->find('first', array(
                'conditions' => array(
                    'ProjectMockup.client_project_id' => $this->request->query['ProjectMockup']['client_project_id'],
                    'ProjectMockup.version' => $this->request->query['ProjectMockup']['version'],
                ),
                'contains' => array(
                    'ProjectMockupNode',
                    'ProjectMockupNode.ProjectMockupComment',
                )
            ));
            if (!empty($value)) {
                $nodes = $value['ProjectMockupNode'];
                $nodes = Hash::combine($nodes, '{n}.url', '{n}');
            }
        }
        $this->response->type('json');
        $this->response->body(json_encode($nodes));
    }

}
