<?php

App::uses('NewClientsAppController', 'NewClients.Controller');

class StorageController extends NewClientsAppController {
    public $autoRender = false;
    public function image() {
        $path = '';
        foreach($this->request->params['pass'] as $item) {
            $path .= '/' . $item;
        }
        //pr(ROOT);
        if($path) {
            $realPath = ROOT . DS . 'plugins/NewClients/storage' . $path;

            $parts = explode('.', $path);
            $fileExtenstion = array_pop($parts);
            
            switch($fileExtenstion){
                
                case "gif": $ctype = "image/gif"; break;
                case "png": $ctype = "image/png"; break;
                case "jpeg": $ctype = "image/jpeg"; break;
                case "jpg": $ctype = "image/jpg"; break;
                default: $ctype = "image/jpg";
            }
            
            header('Content-type:' . $ctype); 
            readfile($realPath);
            
            exit();                      
        }
    }
}