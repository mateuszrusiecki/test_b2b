<?php

App::uses('AppModel', 'Model');
App::uses('CakeEvent', 'Event');

/**
 * Photo Model
 *
 * @property Offer $Offer
 * @property Page $Page
 */
class Photo extends AppModel
{
    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array('Slug.Slug', 'Modification.Modification');
    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'img';

    /**
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'Photo.order ASC';

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
    'Page' => array(
            'className' => 'Page.Page',
            'foreignKey' => 'page_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),        
    );

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array()) {
    $this->validate = array(
    'order' => array(
    'numeric' => array(
    'rule' => array('numeric'),
    'message' => __d('validate', 'Pole formularza nie może być puste'),
    //'allowEmpty' => false,
    //'required' => false,
    //'last' => false, // Stop validation after this rule
    //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ),
    ),
    );
}

/**
 * Konstruktor klasy modelu
 * 
 * @param int $id
 * @param array $table
 * @param bool $ds 
 */
function __construct($id = false, $table = null, $ds = null)
{
    parent::__construct($id, $table, $ds);
    //$this->virtualFields = array('fullname' => "CONCAT({$this->alias}.field_1, ' ', {$this->alias}.field_2)");
    //Notification
    //$this->getEventManager()->dispatch(new CakeEvent('Model.Photo.afterInit', $this));
}

function beforeDelete($cascade = true)
{
    $location = empty($this->tmpPlugin) ? 'Model' : $this->tmpPlugin . '.Model';
    $model = $this->tmpModel;

    App::uses($this->tmpModel, $location);

    $this->$model = new $model();

    $this->$model->id = $this->tmpRemoteId;
    try
    {
        $photoId = $this->$model->field('photo_id');
        if ($photoId == $this->id)
        {
            $this->$model->saveField('photo_id', null);
        }
    } catch (Exception $exc)
    {
        
    }

    $img = $this->field('img');
    $this->deleteFiles($img, 'Photo');

    return true;
    }

    /**
     *         
     * Funkcja usuwa plik właściwy dla danego pola modelu
     *
     * @param object $name        Potencjalna nazwa pliku
     *      
     * @param object $modelName    Nazwa modelu
     */
    private function deleteFiles($name, $modelName)
    {
        $destDir = WWW_ROOT . 'files' . DS . strtolower($modelName);
        $filePath = $destDir . DS . $name;

        if (!file_exists($filePath))
        {
            return true;
        }
        if (!is_file($filePath))
        {
            return false;
        }

        // check folders with thumbs
        $readed = scandir($destDir);

        // delete thumbs from folders
        foreach ($readed as $dir)
        {
            if (!is_dir($destDir . DS . $dir))
            {
                continue;
            }
            $thumbPath = $destDir . DS . $dir . DS . $name;
            @chmod($thumbPath, 0666);
            @unlink($thumbPath);
            @passthru("del $thumbPath /q");
        }

        $delete = false;
        $delete = $delete | @chmod($filePath, 0666);
        $delete = $delete | @unlink($filePath);
        $delete = $delete | @passthru("del $filePath /q");

        return $delete;
    }

    /**
     * Logika dla globalnej wyszukiwarki w cms
     * nadpisuje metodę z AppModel
     * 
     * @param array $options
     * @param array $params
     * @return type array
     */
//    public function search($options, $params = array()) {
//        $fraz = $options['Searcher']['fraz'];
//        $params['conditions']['OR']["Photo.title LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
}
