<?php

App::uses('Utils', 'NewClients.Lib');

class DirectoryManager {

    var $actions = array();
    var $storageDir;
    var $profileModel;

    public function __construct() {
        $this->storageDir = ROOT . DS . 'plugins' . DS . 'NewClients' . DS . 'storage';
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

    function Delete($path)
    {
        if (is_dir($path) === true)
        {
            $files = array_diff(scandir($path), array('.', '..'));

            foreach ($files as $file)
            {
                $this->Delete(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        }

        else if (is_file($path) === true)
        {
            return unlink($path);
        }

        return false;
    }
    
    private function deleteDir($dir) {
        
        $directory = $this->storageDir . '/' . $dir . '/';
        if(is_dir($directory)) {                
            
            return $this->Delete($directory);
        } else {
            return true;
        }
    }

    public function getStorageDir() {
        return $this->storageDir;
    }


    public function getProjectFolderName($projectModel, $projectId) {
        
        $p = $projectModel->find('first', array(
            'conditions' => array(
                'Project.id' => $projectId,
            ),
            'contain' => array(
                'Client' => array(    
                    'Profile' => array(
                        'fields' => array(
                            'Profile.firstname',
                            'Profile.surname'
                        )
                    )
                ),
                'B2BClient' => array(
                    'fields' => array (
                        'B2BClient.name'
                    )
                )
            ),
        ));   
        
        if(isset($p['Client']['Profile'])){
            
            $clientName = $p['Client']['Profile']['firstname'] . $p['Client']['Profile']['surname'];
        } else {
            
            $clientName = $p['B2BClient']['name'];
        }
        
        $dir = '';
        if($p) {
            $dir = $clientName . '/' . $p['Project']['title'];
        }
        return(Utils::transliterate($dir));
    }

    public function getCategoryFolderName($categoryModel, $categoryId) {

        $p = $categoryModel->find('first', array(
                'conditions' => array(
                    'Category.id' => $categoryId,
                ),
                'fields' => array(
                    'Category.id',
                    'Category.project_id',
                    'Category.title',
                ),
                'contain' => array(
                    'Project' => array(
                        'fields' => array(
                            'Project.id',
                            'Project.title',
                            'Project.client_id',
                        ),
                        'Client' => array(
                            'fields' => array(                           
                                'Client.id',
                                'Client.email',                 
                            ),
                            'Profile' => array(
                                'fields' => array(
                                    'Profile.firstname',
                                    'Profile.surname'
                                )
                            )
                        ),
                        'B2BClient' => array(
                            'fields' => array (
                                'B2BClient.name'
                            )
                        )
                    )
                )
            )                
        );   

        if(isset($p['Project']['Client']['Profile'])){
            
            $clientName = $p['Project']['Client']['Profile']['firstname'] . $p['Project']['Client']['Profile']['surname'];
        } else {
            
            $clientName = $p['Project']['B2BClient']['name'];
        }
        
        $dir = '';
        if($p) {
            $dir = $clientName . '/' . $p['Project']['title'] . '/' . $p['Category']['title'];
        }

        return(Utils::transliterate($dir));
    }

    public function getViewFolderName($viewModel, $viewId) {

        $p = $viewModel->find('first',  array(
                'conditions' => array(
                    'pView.id' => $viewId,
                ),
                'fields' => array(
                    'pView.id',
                    'pView.project_id',
                    'pView.category_id',
                    'pView.name'
                ),
                'contain' => array(
                    'Project' => array(
                        'fields' => array(
                            'Project.id',
                            'Project.title',
                        ),
                        'Client' => array(
                            'fields' => array(
                                'Client.id',
                                'Client.email',
                            ),
                            'Profile' => array(
                                'fields' => array(
                                    'Profile.id',
                                    'Profile.firstname',
                                    'Profile.surname',
                                )
                            ),
                        ),
                        'B2BClient' => array(
                            'fields' => array (
                                'B2BClient.name'
                            )
                        )
                    ),
                    'Category' => array(
                        'fields' => array(
                            'Category.id',
                            'Category.title'
                        )
                    )
                )
            )
        );
        
        if(isset($p['Project']['Client']['Profile'])){
            
            $clientName = $p['Project']['Client']['Profile']['firstname'] . $p['Project']['Client']['Profile']['surname'];
        } else {
            
            $clientName = $p['Project']['B2BClient']['name'];
        }
        
        $dir = '';
        if($p) {
            $dir = $clientName . '/' . $p['Project']['title'] . '/' . $p['Category']['title'] . '/' . $p['pView']['name'];
            
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
                case 'delete':
                    $results[] = $this->deleteDir($action['dir']);
                    break;
            }
        }
        return $results;
    }

}