<?php

class Newsletter extends AppModel {

    public $name = 'Newsletter';
    public $displayField = 'email';
    
    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */     
    public $actsAs = array(
        'Modification.Modification'
    );
    
    public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Podaj poprawny adres e-mail',
            ),
        ),
    );

    public function beforeSave() {
        if (empty($this->id) AND empty($this->data[$this->alias]['id'])) {
            if (!empty($this->data[$this->alias])) {
                $this->data[$this->alias]['locale'] = $this->getLocale();
            }
        }
        return true;
    }

    public function getLocale() {
        if (!isset($this->locale) || is_null($this->locale)) {
            if (!class_exists('I18n')) {
                App::import('Core', 'i18n');
            }
            $I18n = & I18n::getInstance();

            $I18n->l10n->get(Configure::read('Config.language'));
            $this->locale = $I18n->l10n->locale;
        }
        return $this->locale;
    }

}

?>