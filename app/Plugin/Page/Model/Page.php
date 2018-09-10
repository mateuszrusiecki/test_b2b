<?php

class Page extends AppModel
{

    var $name = 'Page';
    var $actsAs = array(
        'Slug.Slug',
        'Translate' => array('name', 'desc', 'slug', 'meta_title', 'description', 'keywords'),
        'Image.Upload' => array('imageOptions' => array('size' => array('width' => 1920, 'height' => 1200))),
        'Modification.Modification'
            //'Tree.FebTree'
    );
    var $displayField = 'name';
    var $validate = array(
        'name' => array(
            'length' => array(
                'rule' => array('notempty')
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Wpisz poprawny adres e-mail',
            //'allowEmpty' => false,
            //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'pictogram' => array(
            'mime' => array(
                'rule' => array('validateMime', 'image'),
                'message' => 'Ten formularz akceptuje jedynie pliki graficzne (jpeg, gif, png)'
            ),
            'upload' => array(
                'rule' => 'validateUpload'
            )
        )
    );

    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);

        $this->getEventManager()->dispatch(new CakeEvent('Model.Page.afterInit', $this));
    }

    function beforeValidate($options=array())
    {
        parent::beforeValidate();
        $this->validate['name']['length']['message'] = __d('validate', "Wprowadź tytuł strony");
    }

    function set_translate($on = true)
    {
        if ($on)
        {
            $this->Behaviors->attach('Translate', array('name' => 'translateDisplay', 'desc', 'slug', 'description', 'keywords'));
        } else
        {
            $this->Behaviors->detach('Translate');
        }
    }

    public function search($options, $params = array())
    {
        $params['limit'] = 5;
        $language = Configure::read('Config.languages');
        $this->locale = $language;
        $params['conditions']["I18n__translateDisplay__pol.content LIKE"] = "%{$options['Searcher']['fraz']}%";
        //$this->Page->locale = Configure::read('Config.locale');
        $this->bindTranslation(array('name' => 'translateDisplay'));

        $this->recursive = 1;
        return $this->find('all', $params);
    }

//     function read($fields, $id){
//         $results = parent::read($fields, $id);
//         if(!empty($results)){
//             return $results;
//         }
//         $this->locale = array('eng','pol','deu', 'spa');
//         $this->recursive = 1;
//         $results = parent::read($fields, $id);
// //         return $results;
//         debug($results);
//     }
}

?>