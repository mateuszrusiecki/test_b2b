<?php

App::uses('Version', 'Model');

class VersionProvider {

    public $ignored = array('.', '..');
    public $validExtensions = array('jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF', 'png', 'PNG');

    public function scanForImages($dir) {
        $files = array();
        if(!is_dir($dir)) return false;

        foreach(scandir($dir) as $file) {
            if(in_array($file, $this->ignored)) continue;
            $felem = explode('.', $file);
            if(!in_array($felem[count($felem)-1], $this->validExtensions)) continue;
            $files[$file] = filemtime($dir . '/' . $file);
        }
        asort($files);
        return ($files) ? $files : false;
    }

    public function createThumb($imageFile, $thumbFile) {
        
        if(!is_dir(dirname($thumbFile)))
            @mkdir(dirname($thumbFile));
        $felem  = explode('.', $imageFile);
        $extension = $felem[count($felem)-1];
        if(strtoupper($extension)=='JPG' || strtoupper($extension)=='JPEG') {
            $img = imagecreatefromjpeg($imageFile);
        }
        if(strtoupper($extension)=='GIF') {
            $img = imagecreatefromgif($imageFile);
        }
        if(strtoupper($extension)=='PNG') {
            $img = imagecreatefrompng($imageFile);
        }
        $width = imagesx($img);
        $height = imagesy($img);

        $newWidth = 200;
        $newHeight = 140;

        $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresized($tmpImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($tmpImg, $thumbFile);

    }
}
