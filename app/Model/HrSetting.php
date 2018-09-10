<?php

App::uses('AppModel', 'Model');

/**
 * HrSetting Model
 *
 */
class HrSetting extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'hostname';

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
     * Logika dla globalnej wyszukiwarki w cms
     * nadpisuje metodę z AppModel
     * 
     * @param array $options
     * @param array $params
     * @return type array
     */
//    public function search($options, $params = array()) {
//        $fraz = $options['Searcher']['fraz'];
//        $params['conditions']['OR']["HrSetting.hostname LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }

    /**
     * Pobranie domen przypisanych do danego klienta
     * 
     * 
     * @return mixed            array ustawienia hr
     *                          false w przypadku braku danych
     */
    function getHrSettings()
    {
        $toReturn = $this->find('first', array(
            'recursive' => -1,
        ));

        return empty($toReturn) ? false : $toReturn;
    }

    /**
     * Zapis ustawień HR
     * 
     * @param   $data    dane do zapisania
     * 
     * @return mixed        array Zapisane ustawienia
     *                      false w przypadku błędu
     */
    public function saveHrSettings($data = null)
    {
        if (empty($data))
        {
            return false;
        }

        return $this->save($data);
    }

}
