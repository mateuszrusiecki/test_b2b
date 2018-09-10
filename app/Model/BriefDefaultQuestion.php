<?php

App::uses('AppModel', 'Model');

/**
 * BriefDefaultQuestion Model
 *
 */
class BriefDefaultQuestion extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();
    
	
	public $group_name = array(
		'1'=>'WWW',
		'2'=>'Facebook',
		'3'=>'Zintegrowany',
		'4'=>'Buzz'
	);
	
	public $category_name = array(
		'5'=>'Projekt',
		'6'=>'Serwis internetowy',
		'7'=>'Mara / Produkt',
		'8'=>'Informacje zasadnicze',
		'9'=>'Informacje zasadnicze',
		'10'=>'Informacje zasadnicze'
	);
	public $group_category_name = array(
		'WWW'=>array('1,5'=>'Projekt','1,6'=>'Serwis internetowy','1,7'=>'Mara / Produkt'),
		'Facebook'=>array('2,8'=>'Informacje zasadnicze'),
		'Zintegrowany'=>array('3,9'=>'Informacje zasadnicze'),
		'Buzz'=>array('4,10'=>'Informacje zasadnicze'),
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
     * Logika dla globalnej wyszukiwarki w cms
     * nadpisuje metodę z AppModel
     * 
     * @param array $options
     * @param array $params
     * @return type array
     */
//    public function search($options, $params = array()) {
//        $fraz = $options['Searcher']['fraz'];
//        $params['conditions']['OR']["BriefDefaultQuestion. LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
    function allParse()
    {
        $questions = $this->find('all');
        $data = array();
        foreach ($questions as $question)
        {
            $question['BriefDefaultQuestion']['default'] = true;
            $gr = $question['BriefDefaultQuestion']['group_name'];
            $cat = $question['BriefDefaultQuestion']['category_name'];
            $data[$cat.'_'.$gr]['id'] = $question['BriefDefaultQuestion']['id'];
            $data[$cat.'_'.$gr]['category'] = $cat;
            $data[$cat.'_'.$gr]['group'] = $gr;
            $data[$cat.'_'.$gr]['questions'][] = $question['BriefDefaultQuestion'];
        }
        $data = array_values($data);
        return $data;
    }

}
