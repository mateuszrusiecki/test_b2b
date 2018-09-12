<?php

App::uses('NewClientsAppController', 'NewClients.Controller');
App::uses('DirectoryManager', 'NewClients.Lib');
App::uses('VersionProvider', 'NewClients.Lib');

class ProjectsController extends NewClientsAppController {

    public $autoRender = false;
    public $uses = array(
        'NewClients.pView',
        'NewClients.Category',
        'NewClients.Version',
        'NewClients.Project',
    );

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('refresh', 'refreshAll', 'doRefresh');
    }

    public function refresh($projectId) {
        $options = array(
            'recursive' => 1,
            'conditions' => array(
                'pView.project_id' => $projectId,
            )
        );
        $this->_recreateProjectDirTree($projectId);
        $views = $this->pView->find('all', $options);     
        $out = $this->doRefresh($views);
        $this->response->body(json_encode($out));
    }


    private function _recreateProjectDirTree($projectId) {
        //$project = $this->Project->findById($projectId);

        $project = $this->Project->findById($projectId);
        //pr($project);

        $dirManager = new DirectoryManager();
        $dir = $dirManager->getProjectFolderName($this->Project, $projectId);
        $dirManager->addAction(array('action'=>'create', 'new' => $dir));


        // kategorie
        foreach($project['Category'] as $category) {
            //pr($category);
            $dir = $dirManager->getCategoryFolderName($this->Category, $category['id']);
            $dirManager->addAction(array('action'=>'create', 'new' => $dir));
        }

        // widoki
        foreach($project['pView'] as $view) {
            $dir = $dirManager->getViewFolderName($this->pView, $view['id']);
            $dirManager->addAction(array('action'=>'create', 'new' => $dir));
        }

        $dirManager->processActions();
    }


    /*
     * Przegląda katalogi projektów w poszukiwaniu
     * nowych wersji widoków.
     */
    public function refreshall() {
        $out = array();
        $dirManager = new DirectoryManager();
        $versionProvider = new VersionProvider();

        $projects = $this->Project->find('all');
        foreach($projects as $project) {
            $this->_recreateProjectDirTree($project['Project']['id']);
        }


        $options = array(
            'recursive' => 1,
        );
        $views = $this->pView->find('all', $options);
        $out = $this->doRefresh($views);
        $this->response->body(json_encode($out));
    }

    /*
     * Przegląda katalogi projektów w poszukiwaniu
     * nowych wersji widoków.
     */
    public function refreshAllRedirect() {
        $projects = $this->Project->find('all');
        foreach($projects as $project) {
            $this->_recreateProjectDirTree($project['Project']['id']);
        }

        $options = array(
            'recursive' => 1,
        );
        $views = $this->pView->find('all', $options);
        $this->doRefresh($views);

        $this->Session->setFlash('Odświeżono.', 'flash/success', array(), 'contact');
        $this->redirect('/new_clients/main#/projects/');
    }


    public function doRefresh($views) {
        $dirManager = new DirectoryManager();
        $versionProvider = new VersionProvider();

        $out = array();
        foreach($views as  $view) {
        //pr($view);
            $viewDir = $dirManager->getStorageDir() .  '/' . $dirManager->getViewFolderName($this->pView, $view['pView']['id']);
            $wwwDir = $dirManager->getViewFolderName($this->pView, $view['pView']['id']);
            if(!is_dir($viewDir)) {
                @mkdir($viewDir, 0777, true);
            }
            $files = $versionProvider->scanForImages($viewDir);
            if(!$files) continue;
            //debug($files);
            $number = count($view['Version']) + 1;
            foreach($files as $file => $mtime) {
                // patrzamy czy obrazek jest w wersjach
                $imageExists = false;
                $fileWwwPath = $wwwDir . '/' . $file;
                //$filePath = $dirManager->getStorageDir() . '/' . $file;
                foreach($view['Version'] as $version) {
                    if($version['image_path'] == $fileWwwPath) {
                        $imageExists = true;
                        break;
                    }
                }
                if($imageExists) continue;

                // dodajemy wersję
                $version = array('Version' => array(
                    'number' => $number,
                    'image_path' => $fileWwwPath,
                    'view_id' => $view['pView']['id'],
                    'mtime'=> $mtime,
                ));
                $this->Version->create();
                //debug($version);
                $result = $this->Version->save($version);
                if($result) {
                    $number++;
                    $vid = $this->Version->getLastInsertId();
                    // generujemy miniaturkę
                    
                    $filePath = $dirManager->getStorageDir() . '/' . $dirManager->getViewFolderName($this->pView, $view['pView']['id']) .'/' . $file;
                    
                    $felem = explode('.', $filePath);
                    $extension = $felem[count($felem)-1];

                    $thumb = $dirManager->getStorageDir() . '/thumbs/' . $vid . '.jpg';
                    $wwwThumb = 'thumbs/' . $vid . '.jpg';
                    $versionProvider->createThumb($filePath, $thumb);
                    $version['Version']['thumb_path'] = $wwwThumb;
                    $n = $this->Version->save($version);
                    
                    $this->pView->id = $view['pView']['id'];
                    $this->pView->saveField('thumb_path', $wwwThumb);
                    $this->pView->saveField('image_path', $fileWwwPath);
                    
                    $out[] = $version;
                }
            }
        }
        return $out;
    }

    public function archive($projectId) {
        $out = array('Status' => array('success' => 0));
        $result = $this->Project->findById($projectId);
        if($result) {
            $result['Project']['archived'] = 1;
            $result = $this->Project->save($result);
            if($result) {
                $out['Status']['success'] = 1;
            }
        }
        $this->response->body(json_encode($out));
    }

    public function unarchive($projectId) {
        $out = array('Status' => array('success' => 0));
        $result = $this->Project->findById($projectId);
        if($result) {
            $result['Project']['archived'] = 0;
            $result = $this->Project->save($result);
            if($result) {
                $out['Status']['success'] = 1;
            }
        }
        $this->response->body(json_encode($out));
    }
}
