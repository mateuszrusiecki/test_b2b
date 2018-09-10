<?php

App::uses('AppModel', 'Model');

/**
 * I18nMessage Model
 *
 */
class I18nMessage extends AppModel
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
    public $displayField = 'domain';

    /**
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'I18nMessage.created DESC';

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
//        $params['conditions']['OR']["I18nMessage.domain LIKE"] = "%{$fraz}%";
//        $params['limit'] = 5;
//        $this->recursive = 1;        
//        return $this->find('all', $params);
//    }
    /**
     * Logika parsowania tabeli do zapisu w pliku
     * 
     * @param array $data
     * @return type string
     */
    public function parsePostToFile($data = array())
    {
        $save = '';
        $save .= 'msgid: ""' . "\n";
        $save .= 'msgstr: "Plural-Forms: nplurals=3; plural=n==1 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2;"' . "\n\n";
        foreach ($data as $post)
        {
            foreach ($post as $name => $value)
            {
                
                //czyszczenie z błedych znaków
                $d = array("\n", "\r", '"');
                $r = array(' ', ' ', "'");
                $value = str_replace($d, $r, $value);
                //sprawdzam kategorie jak nie ma to pomija
                if ($name == 'msgctxt' and empty($value))
                {
                    continue;
                }
                if (is_array($value))
                {
                    $save .= 'msgid_plural "' . end($value) . '"';
                    $save .= "\n";
                    foreach ($value as $k => $v)
                    {

                        $save .= "msgstr[$k] ";
                        $save .= '"' . $v . '"';
                        $save .= "\n";
                    }
                } else
                {
                    $save .= $name . ' ';
                    $save .= '"' . $value . '"';
                }
                $save .= "\n";
            }
            $save .= "\n";
        }
        return $save;
    }

    /**
     * Logika parsowania tabeli do zapisu w bazie
     * 
     * @param string $data
     * @param string $user_id
     * @param string $domain
     * @param string $lang
     * @return type array
     */
    public function parsePostToBase($data = array(), $user_id = null, $domain = null, $lang = null)
    {
        foreach ($data as &$post)
        {
            $msgid = $post['msgid'];
            $params['recursive'] = -1;
            $params['fields'] = array('id', 'id');
            $params['conditions']['msgid'] = $msgid;
            $params['conditions']['domain'] = $domain;
            $params['conditions']['lang'] = $lang;
            $id = $this->find('list', $params);
            $post['id'] = reset($id);
            $post['domain'] = $domain;
            $post['lang'] = $lang;
            $post['user_id'] = $user_id;
        }
        return $data;
    }

    /**
     * Logika parsowania pliku do tabeli
     * 
     * @param array $path
     * @return type string
     */
    public function parseFileToArray($path = '')
    {
        if (!file_exists($path))
        {
            return false;
        }
        App::uses('Lib', 'I18n/I18n');
        $i18n = new I18n();
        $messagesPo = $i18n::loadPo($path);
        foreach ($messagesPo as $msgid => $message)
        {
            if (is_string($message))
            {
                $data['msgid'] = "";
                $data['msgstr'] = $message;
                $messages[] = $data;
                continue;
            }
            $data = array();
            $data['msgctxt'] = key($message);
            $data['msgid'] = $msgid;
            if (is_array(reset($message)))
            {
                $data['msgstr_plural'] = reset($message);
            } else
            {
                $data['msgstr'] = reset($message);
            }
            $messages[] = $data;
        }
        return $messages;
    }

    /**
     * Usuwanie cache
     * 
     * @return type bool
     */
    public function deleteCache()
    {
        $path = TMP . 'cache' . DS . 'persistent';
        $files = scandir($path); // get all file names
        foreach ($files as $file)
        { // iterate files
            if (is_file($path . DS . $file))
                @unlink($path . DS . $file); // delete file
        }
        return true;
    }

    /**
     * Uzupełnianie danymi z bazy
     * 
     * @param string $data
     * @param string $user_id
     * @param string $domain
     * @param string $lang
     * @return type array
     */
    public function getBase($messages = array(), $user_id = '', $domain = '', $lang = '')
    {
        if (empty($messages))
        {
            return false;
        }
        foreach ($messages as &$post)
        {
            if (!empty($post['msgstr']) || isset($post['msgstr_plural']))
            {
                continue;
            }
            $msgid = $post['msgid'];
            $params['recursive'] = -1;
            $params['fields'] = array('id', 'msgstr');
            $params['conditions']['msgid'] = $msgid;
            $params['conditions']['domain'] = $domain;
            $params['conditions']['lang'] = $lang;
            $id = $this->find('list', $params);
            if (empty($id))
            {
                continue;
            }
            $post['id'] = key($id);

            $post['base'] = reset($id);
        }
        return $messages;
    }

}
