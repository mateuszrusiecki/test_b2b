<?php

/**
 * Command-line plugin managment
 *
 * @author Sławomir Jach
*/

App::uses('AppShell', 'Console/Command');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

class FebShell extends AppShell {

    /**
     * Schema class being used.
     *
     * @var FebInstall
     */
    public $Config;

    /**
     * Override initialize
     *
     * @return string
     */
    public function initialize() {
        $this->_welcome();
        $this->out('System zarządzania modułami');
        $this->hr();
    }

    /**
     * Override startup
     *
     * @return void
     */
    public function startup() {
         $connection = $plugin = null;

        if (empty($this->params['file'])) {
            $this->params['file'] = 'FebInstall.php';
        }

        if (!empty($this->params['connection'])) {
            $connection = $this->params['connection'];
        }
        if (!empty($this->params['plugin'])) {
            $plugin = $this->params['plugin'];
        }

    }


    public function install() {
        App::uses('FebInstall', "{$this->params['plugin']}.Install");
        
        $this->Install = new FebInstall(&$this);
        $this->Install->install();
        
    }

     /**
     * get the option parser
     *
     * @return void
     */
    public function getOptionParser() {
        $plugin = array(
            'help' => __d('cake_console', 'The plugin to use.'),
        );
        $connection = array(
            'help' => __d('cake_console', 'Set the db config to use.'),
            'default' => 'default'
        );
        

        $parser = parent::getOptionParser();
        $parser->description(__d('cake_console', 'Instrukcja instalacji plugina'))->addSubcommand('install', array(
            'help' => __d('cake_console', 'Nazwa plugina'),
            'parser' => array(
                'options' => compact('plugin', 'connection'),
                'arguments' => compact('plugin')
            )
        ));
        return $parser;
    }

}