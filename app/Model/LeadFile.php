<?php

App::uses('AppModel', 'Model');

/**
 * LeadFile Model
 *
 */
class LeadFile extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array(
        'Image.Upload',
            //'Slug.Slug'
    );
    public $validate = array(
        'img' => array(
//            'mime' => array(
//                'rule' => array('validateMime', 'image'),
//                'message' => 'Ten formularz akceptuje jedynie pliki graficzne (jpeg, gif, png)'
//            ),
            'upload' => array(
                'rule' => 'validateUpload'
            )
        ),
        'file_category_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Pole formularza nie może być puste',
            //'required' => false,
            ),
        ),
        'client_lead_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Pole formularza nie może być puste',
            //'required' => false,
            ),
        )
    );
    public $displayField = 'img';

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'ClientLead' => array(
            'className' => 'ClientLead',
            'foreignKey' => 'client_lead_id',
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
        $this->validate = array(
            'file_category_id' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'required' => false,
                ),
            ),
            'client_lead_id' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                //'required' => false,
                ),
            )
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
        $this->category = array(
            '1' => __d('public', 'Inne'),
            '2' => __d('public', 'Inne hand.'),
            '3' => __d('public', 'Brief'),
            '4' => __d('public', 'Wycena'),
            '5' => __d('public', 'Oferta'),
            '6' => __d('public', 'Umowa'),
            '7' => __d('public', 'FV'),
        );
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
//        $params['conditions']['OR']["LeadFile. LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }

    /**
     * Zapisywanie pliku
     * 
     * @param		$data       dane pliku
     * 
     * @return bool                 true- gdy zapisze
     *                              false - w przypadku błędu
     */
    public function saveFile($data = array())
    {
		//die(debug($data));
        if (empty($data) || !isset($data['LeadFile']['file_category_id']) || !isset($data['LeadFile']['client_lead_id']))
        {
            return false;
        }

        if ($data['LeadFile']['file']['error'] != '0')
        {
            return false;
        }
		
		if(is_array($data['LeadFile']['file'])){
			$leadfile['LeadFile']['file_category_id'] = $data['LeadFile']['file_category_id'];
			$leadfile['LeadFile']['client_lead_id'] = $data['LeadFile']['client_lead_id'];
			$leadfile['LeadFile']['type'] = $data['LeadFile']['file']['type'];
			$leadfile['LeadFile']['size'] = $data['LeadFile']['file']['size'];
			$leadfile['LeadFile']['file'] = $data['LeadFile']['file']['name'];
			$leadfile['LeadFile']['file_name'] = $filename = date('Y-m-d_H-i_').$data['LeadFile']['file']['name'];
			
			move_uploaded_file($data['LeadFile']['file']['tmp_name'],WWW_ROOT . 'files' . DS . 'leadfile' . DS . $filename);

			return $this->save($leadfile);
		} else {
			return false;
		}
	
        //die(debug($this->validationErrors));
    }

    /**
     * Pobiera listę plików przypisanych do leadu
     * 
     * @param   $client_lead_id    ID leadu
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getFileList($client_lead_id = null, $recursive = 0)
    {
        if (empty($client_lead_id))
        {
            return false;
        }

        return $this->find('all', array('conditions' => array(
                        'LeadFile.client_lead_id' => $client_lead_id
                    ),
                    'recursive' => $recursive
        ));
    }

    /**
     * Pobiera plik o danym ID 
     * 
     * @param   $id    ID pliku
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getFile($id = null)
    {
        if (empty($id))
        {
            return false;
        }

        return $this->find('first', array('conditions' => array(
                        'LeadFile.id' => $id
        )));
    }

    /**
     * Wyszukuje plik o danej nazwie
     * 
     * @param   $id    ID pliku
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getFileByName($name = null)
    {
        if (empty($name))
        {
            return false;
        }

        return $this->find('first', array(
			'conditions' => array(
                'LeadFile.file' => $name
			),
			'recursive' => -1,
		));
    }

    /**
     *  usuwanie pliku o danym id 
     * 
     * @param   $id    ID pliku
     * 
     * @return  bool    true - prawidłowe usunięcie
     *                  false - w przypadku błędu
     */
    public function deleteFile($id = null)
    {
        if (empty($id))
        {
            return false;
        }

        $this->id = $id;
        return $this->delete();
    }

    /**
     * Pobiera listę plików  o danej kategorii przypisanych do leadu 
     * 
     * @param   $client_lead_id    ID leadu
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getFileCategoryList($client_lead_id = null, $category)
    {
        if ($client_lead_id == null || $category == null)
        {
            return false;
        }

        return $this->find('all', array('conditions' => array(
                        'LeadFile.client_lead_id' => $client_lead_id,
                        'LeadFile.file_category_id' => $category
        )));
    }

    /**
     * Pobiera liste plikow z podana tablica id'kow 
     * 
     * @param   $id    tablica id'kow
     * 
     * @return  mixed    array - lista plików
     *                  false - w przypadku błędu
     */
    public function getFileSelectedList($id = null)
    {
        if (empty($id))
        {
            return false;
        }
        $this->recursive = -1;
        return $this->find('all', array('conditions' => array(
                        'LeadFile.id' => $id
        )));
    }

    
    /**
     * Funckja zbierają  pliki z leadu do widoku tworzenia projektu
     * 
     * 
     * @param array $lead_id
     * @return array 
     */
    public function getFilesFromLead($LeadId = null)
    {
        if(empty($LeadId)){
            return false;
        }
        $categoriesArray = array(2, 3, 4, 5, 1);
        $files = $this->getFileCategoryList($LeadId, $categoriesArray);
        if ($files != false)
        {
            $optiontradefiles = $this->generateFileOptions($files);
        } else
        {
            $optiontradefiles = array();
        }
        unset($files);

        $files = $this->getFileCategoryList($LeadId, 6);
        if ($files != false)
        {
            $optionagreementfiles = $this->generateFileOptions($files);
        } else
        {
            $optionagreementfiles = array();
        }
        unset($files);

        $files = $this->getFileCategoryList($LeadId, 7);
        if ($files != false)
        {
            $optioninvoicefiles = $this->generateFileOptions($files);
        } else
        {
            $optioninvoicefiles = array();
        }
        unset($files);

        $files = $this->getFileCategoryList($LeadId, '0');
        if ($files != false)
        {
            $optionpublicfiles = $this->generateFileOptions($files);
        } else
        {
            $optionpublicfiles = array();
        }
        unset($files);

        return array($optiontradefiles, $optionagreementfiles, $optioninvoicefiles, $optionpublicfiles);
    }
    
    public function generateFileOptions($files = null)
    {
        if(empty($files) || !is_array($files)){
            return false;
        }
        $return = array();
        foreach ($files as $file)
        {
            $return[$file['LeadFile']['id']] = $file['LeadFile']['file'];
        }
        return $return;
    }
}
