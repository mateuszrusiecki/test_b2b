<?php

App::uses('AppModel', 'Model');

/**
 * ClientDomain Model
 *
 * @property Client $Client
 */
class ClientDomain extends AppModel
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
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id',
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
     * Pobranie domen przypisanych do danego klienta
     * 
     * @param int $client_id    ID klienta
     * 
     * @return mixed            array domeny
     *                          false w przypadku błędu
     */
    function getClientDomains($client_id = null)
    {
        if (empty($client_id))
        {
            return false;
        }

        $toReturn = $this->find('all', array(
            'conditions' => array(
                'ClientDomain.client_id' => $client_id
            ),
            'recursive' => -1
        ));

        return empty($toReturn) ? false : $toReturn;
    }

    /**
     * wyszukiwanie domeny klinta po nazwie
     * 
     * @param int $client_id    ID klienta
     * @param int $domain		domena
     * 
     * @return mixed            array domena
     *                          false w przypadku błędu
     */
    function getClientDomainByName($client_id = null, $domain = null)
    {
        if (empty($client_id) || empty($domain))
        {
            return false;
        }

        $toReturn = $this->find('first', array(
            'conditions' => array(
                'ClientDomain.client_id' => $client_id,
                'ClientDomain.domain' => $domain
            ),
            'recursive' => -1
        ));

        return empty($toReturn) ? false : $toReturn;
    }

    /**
     *  funkcja zwracająca listę wszystkich domen klienta
     * 
     */
    public function getSeoList($client_id = null)
    {
        if (empty($client_id))
        {
            return false;
        }

        $params = array();
        $params['conditions'] = array(
            'client_id' => $client_id,
        );
        $params['fields'] = array('id', 'domain');

        $seoList = $this->find('list', $params);

        return $seoList;
    }

    /**
     * Dodawanie domeny do klienta
     * 
     * @param array $data   Domena z client_id
     * 
     * @return mixed        array Zapisana domena
     *                      false w przypadku błędu
     */
    function addClientDomain($data = array())
    {
        if (empty($data))
        {
            return false;
        }

        if (empty($data['ClientDomain']['client_id']) || empty($data['ClientDomain']['domain']))
        {
            return false;
        }

        return $this->save($data);
    }

    /**
     * Usuwanie domeny
     * 
     * @param int $id   ID domeny
     * @return boolean  true po pomyślnym usunięciu
     *                  false w przypadku błędu
     */
    function deleteClientDomain($id = null)
    {
        if (!$id)
        {
            return false;
        }

        $this->id = $id;
        return $this->delete();
    }

    /**
     * Integracja z stat4seo.pl
     * logowanie się w aplikacji
     * 
     * @param int $id   ID domeny
     * @return boolean  true po pomyślnym usunięciu
     *                  false w przypadku błędu
     */
    private function api_login()
    {
        //username and password of account
        $username = trim('b2bsystem');
        $password = trim('CpG3C39M');

//set the directory for the cookie using defined document root var
        $dir = WWW_ROOT;
//build a unique path with every request to store 
//the info per user with custom func. 
        $path = 'webroot' . DS . 'files' . DS . 'clientdomain' . DS;

//login form action url
        $url = "http://seo.feb.net.pl/";
        $postinfo = "user=" . $username . "&pass=" . $password;

        $cookie_file_path = $path . "cookie.txt";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_NOBODY, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
//set the cookie the site has for certain features, this is optional
        curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
        curl_exec($ch);
        return $ch;
    }

    /**
     * Integracja z stat4seo.pl
     * pobieranie pdf
     * 
     * @param int $id   ID domeny
     * @return boolean  true po pomyślnym usunięciu
     *                  false w przypadku błędu
     */
    public function api_pdf($site_id = null, $date = null)
    {
        if (empty($site_id) && empty($date))
        {
            return false;
        }
        $this->recursive = -1;
        $clientDomain = $this->findBySiteId($site_id);
        debug($clientDomain);
        $ch = $this->api_login();
        //page with the content I want to grab
        //$url = "http://seo.feb.net.pl/makepdf.php?site={$site_id}&from={$date}&name=Y3VybA==";
        // First day of the month.
        $time = strtotime($date . '01');
        $from = date('Y-m-01', $time);
        $to = date('Y-m-t', $time);
        $url = "http://seo.feb.net.pl/makepdf.php?site={$site_id}&from={$from}&to={$to}&type=1&name=Y3VybA==";
        curl_setopt($ch, CURLOPT_URL, $url);
//do stuff with the info with DomDocument() etc
        $pdf = curl_exec($ch);
        $file_dir = 'files' . DS . 'projectfile' . DS;
        $file_name = $clientDomain['ClientDomain']['domain'] . '_' . $date . '.pdf';
        if (file_put_contents(WWW_ROOT . $file_dir . $file_name, $pdf))
        {
            return $file_name;
        }
        curl_close($ch);
        return false;
    }

    /**
     * Integracja z stat4seo.pl
     * pobieranie site_id na podstawie domain  id
     * 
     * @param int $id   ID domeny
     * @return boolean  true po pomyślnym usunięciu
     *                  false w przypadku błędu
     */
    public function client2site($id = null)
    {
        $this->id = $id;
        if (!$this->exists())
        {
            return false;
        }
        $this->recursive = -1;
        $clientDomains = $this->findById($id);


//zakomentowane bo na bieżąco musi sprawdzić czy jest dostep do domeny
//        if (!empty($clientDomains['ClientDomain']['site_id']))
//        {
//            return $clientDomains['ClientDomain']['site_id'];
//        }
        if (empty($clientDomains['ClientDomain']['domain']))
        {
            return false;
        }
        $domain = base64_encode($clientDomains['ClientDomain']['domain']);
        //$domain = base64_encode('alterfun.pl');
        $site_id = (int) @file_get_contents("http://seo.feb.net.pl/api/client.php?domena={$domain}&mobile=0");
        if ($site_id > 0)
        {
            $this->saveField('site_id', $site_id);
            return $site_id;
        }
        return false;
    }

    /**
     * Zbindowwanie plików do domeny
     * 
     * @param void
     * @return void  
     */
    function bindFile()
    {
        $this->bindModel(
                array('hasMany' => array(
                'ProjectFile' => array(
                    'className' => 'ProjectFiles'
                )
            )
                ), false
        );
    }

    /**
     * Zbindowwanie projektow do domeny
     * 
     * @param void
     * @return void  
     */
    function bindProject()
    {
        $this->bindModel(
                array('hasAndBelongsToMany' => array(
                'ClientProject' => array(
                    'className' => 'ClientProject',
                    'joinTable' => 'client_project_domains',
                    'foreignKey' => 'project_id',
                    'associationForeignKey' => 'client_domain_id',
                )
            )
                ), false
        );
    }

    /**
     * Integracja z stat4seo.pl
     * przygotowanie danych do zapisu pliku
     * oraz zapis plików
     * 
     * @param char $user_id   user_id
     * @param char $file_name   dane do zapisu pliku
     * @param int $project_id   id projektu
     * @param int $client_domain_id   id domeny
     * @return boolean  array po pomyślnym dodaniu
     *                  false w przypadku błędu
     */
    function parseFile($user_id = null, $file_name = null, $project_id = null, $client_domain_id = null)
    {
        $this->ProjectFile = ClassRegistry::init('ProjectFile');
        $saveData['client_project_id'] = $project_id;
        $saveData['project_file_category_id'] = 1;
        $saveData['client_domain_id'] = $client_domain_id;

        $saveData['user_id'] = $user_id;
        $saveData['file'] = $file_name;
        $saveData['section_id'] = 16; // SEO/SEM
        $saveData['desc'] = __d('public', 'raport'); // SEO/SEM
        $paramsFile['conditions']['ProjectFile.client_domain_id'] = $saveData['client_domain_id'];
        $paramsFile['conditions'][] = 'ProjectFile.parent_id IS NULL';
        $paramsFile['recursive'] = -1;
        $projectFile = $this->ProjectFile->find('first', $paramsFile);
        if (!empty($projectFile))
        {
            $saveData['tmp_id'] = $projectFile['ProjectFile']['id'];
        }
        if ($saveData['file'])
        {

            $save = $this->ProjectFile->rev_save_file(array('ProjectFile' => $saveData));
            return $save;
        }
        return false;
    }

    /**
     * Lista domen filtrowana przez id projektu
     * 
     * @param int $project_id   id projektu
     * @return boolean  array po pomyślnym dodaniu
     *                  false w przypadku błędu
     */
    function listDomainsByProject($project_id = null)
    {
        $this->ClientProject = ClassRegistry::init('ClientProject');
        if (!$this->ClientProject->exists($project_id))
        {
            return false;
        }
        $params['recursive'] = 1;

        $params['joins'][] = array(
            'alias' => 'ClientProjectDomain',
            'table' => 'client_project_domains',
            'type' => 'INNER',
            'conditions' => array(
                'ClientDomain.id = ClientProjectDomain.client_domain_id',
                'ClientProjectDomain.project_id' => $project_id,
            )
        );
        $params['joins'][] = array(
            'alias' => 'ClientProject',
            'table' => 'client_projects',
            'type' => 'LEFT',
            'conditions' => array(
                //'ClientProject.id' => $project_id,
                'ClientProject.id = ClientProjectDomain.project_id',
            )
        );

        $params['fields'][] = 'ClientProject.*';
        $params['fields'][] = 'ClientProjectDomain.*';
        $params['fields'][] = 'ClientDomain.*';
        //$params['fields'][] = 'ProjectFile.*';
        $clientDomains = $this->find('all', $params);
        return $clientDomains;
    }

}
