<?php

App::uses('Utils', 'Lib');

class DirectoryManager {

    var $actions = array();
    var $storageDir;

    public function __construct() {
        $this->storageDir = ROOT . DS . APP_DIR . DS . 'storage';
    }


    private function renameDir($prev, $new) {
        $prevDir = $this->storageDir . '/' . $prev . '/';
        $newDir = $this->storageDir .  '/' . $new . '/';
        if(!is_dir($prevDir)) {
            return @mkdir($newDir, 0777, true);
        } else {
            return @rename($prevDir, $newDir);
        }
    }

    private function createDir($dir) {
        $directory = $this->storageDir . '/' . $dir . '/';
        if(!is_dir($directory)) {
            return @mkdir($directory, 0777, true);
        } else {
            return true;
        }
    }


    public function getStorageDir() {
        return $this->storageDir;
    }


    public function getProjectFolderName($projectModel, $projectId) {
        $p = $projectModel->find('first', array(
            'recursive' => 1,
            'conditions' => array(
                'Project.id' => $projectId,
            ),
            'contain' => array(
                'Client',
            )
        ));
        $dir = '';
        if($p) {
            $dir = $p['Client']['name']. '/' . $p['Project']['title'];
        }
        return(Utils::transliterate($dir));
    }

    public function getCategoryFolderName($categoryModel, $categoryId) {


        $options['recursive'] =2;
        $options['conditions'] = array('Category.id' => $categoryId);
        $p = $categoryModel->find('first', $options);

        $dir = '';
        if($p) {
            $dir = $p['Project']['Client']['name'].'/'.$p['Project']['title'] . '/' . $p['Category']['title'];
        }
        return(Utils::transliterate($dir));
    }

    public function getViewFolderName($viewModel, $viewId) {
        $options = array(
            'recursive' => 2,
            'conditions' => array(
                'pView.id' => $viewId,
            ),
        );
        $p = $viewModel->find('first',  $options);
        $dir = '';
        if($p) {
            $dir = $p['Project']['Client']['name'] . '/' . $p['Project']['title'] . '/' . $p['Category']['title'] . '/' . $p['pView']['name'];
            return(Utils::transliterate($dir));
        }
    }


    public function addAction($action) {
        $this->actions[] = $action;
    }

    public function processActions() {
        $results = array();
        foreach($this->actions as $action) {
            switch($action['action']) {
                case 'rename':
                    $results[] = $this->renameDir($action['previous'], $action['new']);
                    break;
                case 'create':
                    $results[] = $this->createDir($action['new']);
                    break;
            }
        }
        return $results;
    }

}