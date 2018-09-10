<?php

App::uses('AppController', 'Controller');

/**
 * ModulePhotos Controller
 *
 * @property ModulePhoto $ModulePhoto
 */
class ModulePhotosController extends AppController
{

    public function photo($name)
    {
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $params['conditions']['ModulePhoto.name'] = $filename;
        $photos = $this->ModulePhoto->find('first',$params);
        if (!empty($photos))
        {
            // Set the content type and print the data.
            header("Content-type: img/" . $photos['ModulePhoto']['type']);
            echo $photos['ModulePhoto']['data'];
        } else
        {
            // No images were found, print error
            echo "No images were found";
        }
    }

}
