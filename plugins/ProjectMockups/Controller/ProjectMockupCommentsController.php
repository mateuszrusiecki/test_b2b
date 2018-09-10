<?php

App::uses('ProjectMockupsAppController', 'ProjectMockups.Controller');

/**
 * ProjectMockupCommentsController
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class ProjectMockupCommentsController extends ProjectMockupsAppController {

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

    public function api_add() {
        $this->layout = false;
        $this->autoRender = false;

        $data = $this->request->query;
        $data['user_id'] = $this->Auth->user('id');
        
        $this->ProjectMockupComment->create();
        $result = $this->ProjectMockupComment->save($data);

        $this->response->type('json');
        $this->response->body(json_encode($result));
    }

}
