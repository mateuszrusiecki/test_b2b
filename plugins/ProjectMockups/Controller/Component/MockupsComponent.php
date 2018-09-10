<?php

App::uses('Component', 'Controller');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MockupsComponent
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class MockupsComponent extends Component {

    /**
     * Component default settings
     *
     * @access public
     * @var array
     */
    protected $_defaults = array(
        'invalidExtensions' => array(
            'exe',
            'so',
            'bat',
            'db',
        ),
    );

    /**
     * Component settings
     *
     * @access public
     * @var array
     */
    public $settings = array();

    /**
     * Path
     *
     * @access public
     * @var string
     */
    public $path = null;

    /**
     * Constructor
     *
     * @access public
     * @param   ComponentCollection     $collection         A ComponentCollection this component can use to lazy load its components
     * @param   array                   $settings           Array of configuration settings.
     * @return void
     */
    public function __construct(\ComponentCollection $collection, $settings = array()) {
        parent::__construct($collection, $settings);
        $_settings = array_merge($this->_defaults, $settings);
        $this->settings = $_settings;
    }

}
