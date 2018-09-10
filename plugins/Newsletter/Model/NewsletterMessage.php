<?php

class NewsletterMessage extends AppModel {

    public $name = 'NewsletterMessage';

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array(
        'Translate' => array(
            'title' => 'translateTitle',
            'html_content' => 'translateHtmlContent',
            'content' => 'translateContent'
        ),
        'Modification.Modification'
    );
    public $validate = array(
        'title' => array(
            'length' => array(
                'rule' => array('notempty')
            )
        ),
        'sender_email' => array(
            'email' => array(
                'rule' => array('email')
            )
        ),
    );
    public $displayField = 'title';

    public function __construct() {
        parent::__construct();
        $this->validate['title']['length']['message'] = __d('validate', "Wprowadź tytuł wiadomości");
        $this->validate['sender_email']['email']['message'] = __d('validate', "Podaj prawidøowy adres email");
    }
        

}

?>