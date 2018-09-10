<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class PagesController extends AppController
{

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    var $name = 'Pages';
    var $helpers = array(
        'Recaptcha.CaptchaTool',
        'FebForm',
        'FebTinyMce4',
    );
    var $components = array(
        //'FebEmail',
        'Recaptcha.Captcha' => array(
            'private_key' => '6LcOzr0SAAAAAON0wiMcOEroKy_VaD1i6c-ci9qn',
            'public_key' => '6LcOzr0SAAAAAENp6qLOs5TgvJ6lxvaereP1d-VH'
        )
    );

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('display', 'message', 'view');
        //$this->Page->set_translate(true);
    }

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @access public
     */
    function display()
    {
        $path = func_get_args();

        $count = count($path);
        if (!$count)
        {
            $this->redirect('/');
        }
        $page = $subpage = $title = null;

        if (!empty($path[0]))
        {
            $page = $path[0];
        }
        if (!empty($path[1]))
        {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1]))
        {
            $title = Inflector::humanize($path[$count - 1]);
        }
        //$this->saveAnkieta();
        $this->set(compact('page', 'subpage', 'title'));
        $this->render(implode('/', $path));

        $key = join('/', $path);
        $pagecontent = $this->Page->find('first', array('conditions' => array('or' => array('Page.id' => $key, 'I18n__slug.content' => $key))));
        $this->set('pagecontent', $pagecontent);
    }

    function send_email()
    {

        if (!empty($this->request->data))
        {
            $this->Page->set($this->request->data);

            if ($this->Page->validates())
            {

                App::uses('FebEmail', 'Lib');
                $email = new FebEmail('public');

                $email->viewVars(array('data' => $this->request->data));
                //        $email->helpers(array('Html'));
                $email->template('kontakt')
                        ->emailFormat('both')
                        ->to(array(Configure::read('App.ContactEmail') => Configure::read('App.ContactName')))
                        ->from(array(Configure::read('App.WebSenderEmail') => Configure::read('App.WebSenderName')))
                        ->subject(__d('email', 'Kontakt'));
                $email_sent = $email->send();
                $email->reset();
                $email->config('public');
                $email->template('kontakt_podziekowanie')
                        ->emailFormat('both')
                        ->to(array($this->request->data['Page']['email']))
                        ->from(array(Configure::read('App.WebSenderEmail') => Configure::read('App.WebSenderName')))
                        ->subject(__d('email', 'Kontakt'));
                $email_sent = $email->send();

                return true;
            }
        }
        return false;
    }

    /**
     * Displays a flashMessage, and Pages.message if defined in session
     * Use title defined in Pages.title session key
     *
     * @param mixed What page to display
     * @access public
     */
    function message()
    {
        if (!$this->Session->check('Pages.title') AND ! $this->Session->check('Pages.message') AND ! $this->Session->check('Message.flash.message'))
        {
            $this->redirect('/');
        }
        if ($this->Session->check('Pages.message'))
        {
            $this->set('message', $this->Session->read('Pages.message'));
            $this->Session->delete('Pages.message');
        } else
        {
            $this->set('message', '');
        }
        if ($this->Session->check('Pages.title'))
        {
            $this->set('title_for_layout', $this->Session->read('Pages.title'));
            $this->Session->delete('Pages.title');
        } else
        {
            $this->set('title_for_layout', "");
        }
    }

    function admin()
    {
        $this->layout = 'admin';
    }

    /*
     * POLECAM DODAWANIE KOMENTARZY!!
     */
    function view($slug = null)
    {
//        $this->helpers[] = 'Fancybox.Fancybox';
        $slug = $this->Page->isSlug($slug);

        if (!$slug)
        {
            throw new NotFoundException(__d('cms', 'Invalid localization'));
        }
        if (!empty($slug['error']))
        {
            $this->redirect(array($slug['slug']), $slug['error']);
        }

        if ($this->send_email())
        {
            $this->redirect(array('action' => 'view', 'dziekujemy-za-kontakt'));
        }
        $this->Page->recursive = -1;
        $strona = $this->Page->read(null, $slug['id']);
        $this->loadModel('Photo.Photo');
        $params['conditions']['page_id'] = $strona['Page']['id'];
        $photos = $this->Photo->find('all', $params);
        Configure::read('Page.hasComments') ? $this->_add_comment() : '';
        $title = $subtitle = $siteTitle = $strona['Page']['meta_title'];
        $this->set(compact('siteTitle', 'title', 'subtitle'));
        $this->set('title', $strona['Page']['meta_title']);
        $this->set(compact('strona', 'photos'));

        $this->render('/Elements/Pages/view');
    }

    function _add_comment()
    {
        if (!empty($this->request->data))
        {
            $this->Page->Comment->set($this->request->data);
            if ($this->Page->Comment->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Komentarz został zapisany i oczekuje na weryfikację.'));
                $this->request->data = null;
            } else
            {
                $this->Session->setFlash(__d('cms', 'Komentarz nie został zapisany. Proszę sprawdzić formularz i spróbować ponownie.'));
            }
        }
    }

    function admin_index()
    {
//        $this->layout = 'admin';
        $this->Page->recursive = 1;
        $this->Page->locale = Configure::read('Config.languages');
        $this->Page->bindTranslation(array('name' => 'translateDisplay'));
        $pages = $this->paginate();
        $this->set('pages', $pages);
        $title = 'Podstrony';
        $subtitle = 'Podstrony';

        $this->set(compact('title', 'subtitle'));
    }

    function admin_add($id = null)
    {
//        $this->layout = 'admin';

        if (!empty($this->request->data))
        {
            $this->Page->create();
            if ($this->Page->save($this->request->data))
            {
                if ($this->request->data['Page']['gallery'])
                {
                    $this->Session->setFlash(__d('cms', 'Dodaj zdjęcia'));
                    $this->redirect(array('plugin' => 'photo', 'controller' => 'photos', 'action' => 'index', 'Page.Page', $this->Page->getLastInsertID()));
                } else
                {
                    $this->Session->setFlash(__d('cms', 'Pozycja została zapisana'));
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash(__d('cms', 'Pozycja nie została zapisana. Sprawdz formularz i spróbuj ponnownie'));
            }
        }
        if ($id && empty($this->request->data))
        {
            $this->Page->locale = Configure::read('Config.languages');
            $this->request->data = $this->Page->findById($id);
        }
        $title = 'Podstrony - dodawanie';
        $subtitle = 'Podstrony - dodawanie';

        $this->set(compact('title', 'subtitle'));
    }

    function admin_edit($id = null)
    {
//        $this->layout = 'admin';
        $this->Page->recursive = 1;
        if (!$id && empty($this->request->data))
        {
            $this->Session->setFlash(__d('cms', 'Nieprawidłowa pozycja'));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->request->data))
        {
            if ($this->Page->save($this->request->data))
            {
                $this->Session->setFlash(__d('cms', 'Pozycja została zapisana'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__d('cms', 'Pozycja nie została zapisana. Sprawdz formularz i spróbuj ponnownie'));
            }
        } else
        {
            $this->Page->locale = Configure::read('Config.languages');
            $this->request->data = $this->Page->read(null, $id);
        }
        $title = 'Podstrony - edycja';
        $subtitle = 'Podstrony - edycja';

        $this->set(compact('title', 'subtitle'));
    }

    function admin_delete($id = null, $all = null)
    {
        $this->FebI18n->delete($id, $all);
        $this->redirect(array('action' => 'index', 'pages'), null, true);
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
        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->Page->recursive = -1;
        $params['conditions']["I18n__name.content LIKE"] = "%{$this->request->data['fraz']}%";
//        $params['conditions']["I18n__name__pol.content"] = "{$this->request->data['fraz']}";
        $res = $this->Page->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

    public function admin_language_export($fromLanguage = 'pol')
    {
        $this->layout = false;
        $i18ns = $this->Page->query('SELECT * FROM i18n');
        foreach ($i18ns as $i18nModel)
        {
            try
            {
                $model = $i18nModel['i18n']['model'];
                $this->loadModel($model);
                $primaryKey = $this->$model->primaryKey;
                $this->$model->$primaryKey = $i18nModel['i18n']['foreign_key'];
                if (!$this->$model->exists())
                {
                    //Nie istnieje ID więc czyszczę
                    $this->Page->query("DELETE FROM `i18n` WHERE `model` = '{$model}' AND `foreign_key` = {$i18nModel['i18n']['foreign_key']}");
                    echo "Usunięto {$model} {$i18nModel['i18n']['foreign_key']} <br/>";
                }
            } catch (Exception $exc)
            {
                echo $exc->getMessage() . '<br/>';
                $this->Page->query("DELETE FROM `i18n` WHERE `model` = '{$model}' AND `foreign_key` = {$i18nModel['i18n']['foreign_key']}");
                echo "Usunięto {$model} {$i18nModel['i18n']['foreign_key']} <br/>";
            }
        }

        $doPrzetlumaczenia = "SELECT `content` FROM i18n WHERE locale = '{$fromLanguage}'";


        $out = $this->Page->query($doPrzetlumaczenia);

        $output = '';
        foreach ($out as $k => $o)
        {
            $output .= "{$o['i18n']['content']} <hr>";
        }
        $this->response->type('text');
        header("Content-Type: text/html; charset=utf8");

        echo $output;
        $this->render(false);
    }

    public function ajaxfilemanager()
    {
        $this->layout = null;
        $this->autoRender = false;
    }

}

?>