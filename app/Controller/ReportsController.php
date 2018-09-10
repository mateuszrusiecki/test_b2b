<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Reports $Reports
 */
class ReportsController extends AppController
{

    /**
     * Nazwa layoutu
     */
    //public $layout = 'admin';
    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array();

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array(); //Slug.Slug

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }

    /**
     * Akcja wyświetlająca zyskowności kontrahentów
     * 
     * @return void
     */
    public function profit_clients()
    {
        $data = $this->Report->profit_clients($this->params->params);
        $this->set(compact('data'));
    }

    /**
     * Akcja wyświetlająca zyskowności działów
     * 
     * @return void
     */
    public function profit_sections()
    {
        $params = $this->params->params;
        $this->loadModel('Section');
        $sections = $this->Section->find('list');
        if (empty($params['named']['s_id']))
        {
            $s_id = array_keys($sections);
        } else
        {
            $s_id[] = $params['named']['s_id'];
        }
        $data = array();
        foreach ($s_id as $s)
        {
            $params['named']['s_id'] = $s;
            $return = $this->Report->profit_sections($params);
            if(!empty($return)){
                $data[] = $return;
            }
        }
        $this->set(compact('data', 'sections'));
    }

    /**
     * Akcja wyświetlająca zadowolenia Klientów
     * 
     * @return void
     */
    public function satisfaction_clients()
    {
        $data = $this->Report->satisfaction_clients($this->params->params);
        $this->set(compact('data'));
    }

}
