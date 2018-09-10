<?php

App::uses('AppModel', 'Model');

/**
 * ModulePhoto Model
 *
 */
class ModulePhoto extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    public function photo($name)
    {
        if ($ROW = mysql_fetch_assoc($RESULT))
        {
            // Set the content type and print the data.
            header("Content-type: img/" . $ROW['ImgType']);
            echo $ROW['ImgData'];
        } else
        {
            // No images were found, print error
            echo "No images were found";
        }
    }

}
