<?php

class GoogleAnalyticsAccount extends AppModel {

    var $useDbConfig = 'GoogleAnalytics';

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array(
            //'Modification.Modification'
    );

    function __construct() {
        //App::import('Config', 'GoogleAnalytics.GoogleAnalyticsConfig'); //
        require_once realpath(APP . '../plugins/GoogleAnalytics/Config/GoogleAnalyticsConfig.php');
        require_once realpath(APP . '../plugins/GoogleAnalytics/Model/Datasources/GoogleAnalytics.php');
        //App::import('Model\Datasources', 'GoogleAnalytics.GoogleAnalytics');
        $config = & new GoogleAnalyticsConfig();

        ConnectionManager::create('GoogleAnalytics', $config->googleAnalytics);

        parent::__construct();
    }

}