<?php

/**
 * FebInstall
 *
 * @autor Sławomir Jach
 * @property $FebShell FebShell
 */
App::uses('ClassRegistry', 'Utility');

class Install extends Object {

    protected $FebShell = null;
    protected $_initData = array();

    protected function _insert($model, $data) {

        $obj = ClassRegistry::init($model);
        $obj->create();
        if (!$obj->saveAll($data)) {
            $this->FebShell->err('Błąd podczas zapisu');
            debug($data);
            debug($obj->validateErrors);
            return false;
        }

        return true;
    }

}