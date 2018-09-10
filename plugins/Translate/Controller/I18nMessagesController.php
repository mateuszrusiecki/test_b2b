<?php

App::uses('AppController', 'Controller');

/**
 * I18nMessages Controller
 *
 * @property I18nMessage $I18nMessage
 */
class I18nMessagesController extends AppController
{

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array();

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array(); //Slug.Slug

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('change'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function change($lang, $url)
    {
        $user_id = $this->Session->read('Auth.User.id');
        if ($user_id)
        {
            $this->loadModel('User.User');
            $this->User->id = $user_id;
            $this->User->saveField('lang', $lang);
            $this->Session->write('Auth.User.lang', $lang);
        }

        $decoderUrl = base64_decode($url);
        $parseUrl = Router::parse($decoderUrl);
        foreach ($parseUrl['named'] as $key => $value)
        {
            $parseUrl[$key] = $value;
        }
        unset($parseUrl['named']);
        foreach ($parseUrl['pass'] as $key => $value)
        {
            $parseUrl[$key] = $value;
        }
        unset($parseUrl['pass']);
        if ($lang == 'pol')
        {
            unset($parseUrl['lang']);
        } else
        {
            $parseUrl['lang'] = $lang;
        }
        $this->redirect($parseUrl);
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function domains()
    {
        $title = $subtitle = 'Domeny';
        $this->set(compact('title', 'subtitle'));
        $lang = Configure::read('Config.language');
        $path = APP . 'Locale' . DS . $lang . DS . 'LC_MESSAGES';
        $files = scandir($path);
        unset($files[0], $files[1]);
        $this->set('domains', $files);
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function domain($domain)
    {
        $title = $subtitle = 'Domena';
        $this->set(compact('title', 'subtitle'));
        $user_id = $this->Session->read('Auth.User.id');
        $lang = Configure::read('Config.language');

        $path = APP . 'Locale' . DS . $lang . DS . 'LC_MESSAGES';

        if ($this->request->is('post'))
        {
            $dataPost = $this->request->data;
            //parsowanie danych do stinga aby zapisać w pliku
            $saveFile = $this->I18nMessage->parsePostToFile($dataPost);
            //kopia bezpieczenstwa
            $backupDir = APP . WEBROOT_DIR . DS . 'files' . DS . 'i18nmessage';
            if (!file_exists($backupDir))
            {
                mkdir($backupDir, 0777);
            }
            if (!copy($path . DS . $domain, $backupDir . DS . time() . '_' . $domain))
            {
                //echo "failed to copy $file...\n";
            }
            //zapis do pliku
            file_put_contents($path . DS . $domain, $saveFile);
            //parsowanie danych do tablicy aby zapisać w tabeli
            $saveBase = $this->I18nMessage->parsePostToBase($dataPost, $user_id, $domain, $lang);
            //zapis w tabeli
            $this->I18nMessage->saveMany($saveBase);
            //usuwanie cache plików tłumaczających
            $this->I18nMessage->deleteCache();
        }

        //pobieranie danych z pliku
        $messages = $this->I18nMessage->parseFileToArray($path . DS . $domain);
        if (empty($messages['0']['msgid']))
        {
            unset($messages['0']);
        }
        sort($messages);
        //uzupełnianie danych z bazy
        $messages = $this->I18nMessage->getBase($messages, $user_id, $domain, $lang);


        $this->set('messages', $messages);
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function index()
    {
        $this->helpers[] = 'FebTime';
        $this->I18nMessage->recursive = 0;
        $this->set('i18nMessages', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {

//        $id = $this->Slug->basic();
        $this->I18nMessage->id = $id;
        if (!$this->I18nMessage->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('i18nMessage', $this->I18nMessage->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->I18nMessage->create();
            if ($this->I18nMessage->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->I18nMessage->id = $id;
        if (!$this->I18nMessage->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->I18nMessage->save($this->request->data))
            {
                $this->Session->setFlash(__d('public', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->I18nMessage->read(null, $id);
        }
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->I18nMessage->id = $id;
        if (!$this->I18nMessage->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->I18nMessage->delete())
        {
            $this->Session->setFlash(__d('public', 'Poprawnie usunięto.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('public', 'Nie można usunąć.'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Akcja wyświetlająca listę obiektów
     * 
     * @return void
     */
    public function admin_index()
    {
        $this->helpers[] = 'FebTime';
        $this->I18nMessage->recursive = 0;
        $this->set('i18nMessages', $this->paginate());
    }

    /**
     * Akcja podglądu obiektu
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {

        $this->I18nMessage->id = $id;
        if (!$this->I18nMessage->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        $this->set('i18nMessage', $this->I18nMessage->read(null, $id));
    }

    /**
     * Akcja dodająca obiekt
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post'))
        {
            $this->I18nMessage->create();
            if ($this->I18nMessage->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        }
    }

    /**
     * Akcja edytująca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->I18nMessage->id = $id;
        if (!$this->I18nMessage->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->I18nMessage->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->I18nMessage->read(null, $id);
        }
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->I18nMessage->id = $id;
        if (!$this->I18nMessage->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->I18nMessage->delete())
        {
            $this->Session->setFlash(__d('cms', 'Poprawnie usunięto.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('cms', 'Nie można usunąć.'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Akcja do podpowiadaina danych z formularza
     * 
     * @param type $term
     * @throws MethodNotAllowedException 
     */
    function admin_autocomplete($term = null)
    {
        $this->layout = 'ajax';
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $params = array();
        $params['fields'] = array('domain');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['I18nMessage.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->I18nMessage->recursive = -1;
        $params['conditions']["I18nMessage.domain LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->I18nMessage->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
