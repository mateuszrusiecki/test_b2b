<?php

App::uses('AppModel', 'Model');

/**
 * PersonalAim Model
 *
 * @package b2b
 * @property User $User
 */
class PersonalAim extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     * 
     * @var array
     */
    public $actsAs = array(
        'Image.Upload' => array('imageOptions' => array('size' => array('width' => 1920, 'height' => 1200))),
    );

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $validate = array(
        'photo' => array(
            'mime' => array(
                'rule' => array('validateMime', 'image'),
                'message' => 'Ten formularz akceptuje jedynie pliki graficzne (jpeg, gif, png)'
            ),
            'upload' => array(
                'rule' => 'validateUpload'
            )
        )
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array())
    {
        
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
    }

    /**
     * Pobieranie danych celu osobistego.
     * 
     * @param string    $user_id    ID użytkownika
     * 
     * @return mixed                array - cel osobisty, gdy użytkownik istnieje
     *                              false - gdy użytkownik nie istnieje
     * 
     */
    public function getPersonalAim($user_id = null)
    {
        if (!$user_id)
        {
            return false;
        }

        $user = $this->find('first', array(
            'conditions' => array(
                'PersonalAim.user_id' => $user_id
            ),
            'recursive' => -1,
        ));

        return empty($user) ? false : $user;
    }

    /**
     * Zapisywanie celu osobistego.
     * 
     * @param string    $user_id    ID użytkownika
     * @param array     $data       Dane z celem osobistym
     * 
     * @return bool                true  -  gdy zapisano cel osobisty
     *                             false - gdy nie zapisano celu osobistego
     * 
     */
    public function setPersonalAim($user_id = null, $data = array())
    {

        $this->User = ClassRegistry::init('User.User');

        if (empty($user_id) || empty($data))
        {
            return false;
        }

        // Sprawdzenie czy użytkownik istnieje
        $user = $this->User->find('count', array(
            'conditions' => array(
                'User.id' => $user_id
            ),
            'recursive' => 0
        ));

        if (!$user)
        {
            return false;
        }



        if (!empty($data['PersonalAim']['start_date']) && !empty($data['PersonalAim']['end_date']))
        {
            if ($data['PersonalAim']['start_date'] >= $data['PersonalAim']['end_date'])
            {
                $data['PersonalAim']['end_date'] = date('Y-m-d', strtotime('+1 day', strtotime($data['PersonalAim']['start_date'])));
            }
        }

        if (!empty($data['PersonalAim']['photo_url']) && !getimagesize($data['PersonalAim']['photo_url']))
        {
            return false;
        }

        if (!empty($data['PersonalAim']['status']) && $data['PersonalAim']['status'] % 5 != 0)
        {
            return false;
        }

        if (!empty($data['PersonalAim']['photo_type']))
        {
            if ($data['PersonalAim']['photo_type'] == 'file')
            {
                if (!empty($data['PersonalAim']['photo']['error']))
                {
                    return false;
                }
                $data['PersonalAim']['photo_url'] = null;
            } else
            {
                $data['PersonalAim']['photo_delete'] = 1;
                $data['PersonalAim']['photo'] = null;
            }
            unset($data['PersonalAim']['photo_type']);
//            debug($data);die();
        }

        $id = $this->find('list', array(
            'conditions' => array(
                'PersonalAim.user_id' => $user_id
            ),
            'fields' => array(
                'id', 'id'
            ),
            'recursive' => -1
        ));

        !empty($id) ? $this->id = key($id) : $this->create();

        return $this->save($data) ? true : false;
    }

}
