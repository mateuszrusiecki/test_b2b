<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 * p
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Tablica komponentów ładowana w kazdym kontrolerze przed wykonaniem akcji
     * 
     * AuthComponent, SessionComponent, FebI18nComponent, PermissionsComponent, MaintenanceComponent, RequestHandlerComponent, Html2PsComponent
     */
    public $components = array(
        'Auth',
        'Session',
        'Cookie',
        'Theme.Theme',
        'Translate.FebI18n',
        'User.Permissions',
        //'DebugKit.Toolbar',
        //'Maintenance.Maintenance',
        'RequestHandler',
        'CheckAccess'
    );

    /**
     * Tablica helperów ładowana w każym kontrolerze przed wykonaniem akcji
     * 
     * SessionHelper, HtmlHelper, FormHelper, PermissionsHelper, JsHelper, TextHelper, FebHtmlHelper, ImageHelper
     */
    public $helpers = array(
        'Session',
        'Html',
        'Form',
        'Menu.Menu',
        'FebForm',
        'User.Permissions',
        'Js' => 'Jquery',
        'Text',
        'FebHtml',
        'Image.Image',
    );

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    public function beforeFilter()
    {
        //Configure AuthComponent
        $this->Auth->authorize = 'Controller';
        $this->Auth->ajaxLogin = 'User.Elements/Users/ajaxlogin';
        $this->Auth->autoRedirect = false;
        $this->Auth->fields = array('username' => 'email', 'password' => 'pass');
        $this->Auth->loginAction = array('plugin' => 'user', 'admin' => false, 'controller' => 'users', 'action' => 'login');
        $this->Auth->loginError = __d('users', "Nieprawidłowy email lub hasło");

        if ($this->Auth->user('id'))
        {
            $this->Auth->authError = __d('users', "Nie masz dostępu do tego zasobu");
        } else
        {
            $this->Auth->authError = __d('users', "Zaloguj się, aby uzyskać dostęp");
        }

        $this->Auth->logoutRedirect = array('plugin' => 'user', 'controller' => 'users', 'action' => 'login', 'admin' => null);
        $this->Auth->loginRedirect = array('plugin' => false, 'admin' => false, 'controller' => 'fronts', 'action' => 'r403');
        $this->Auth->userScope = array('User.active' => 1);
        $this->Auth->allow('display', 'logout');
//        $this->Auth->allow('*');         

        if (!empty($this->request->params['requested']))
        {
            $this->Auth->allow(array($this->request->action, 'test'));
        }

        if (isset($_GET['search_mode']) && $_GET['search_mode'] == 'this_project')
        {

            $searchModes = array(
                'this_project' => 'W tym projekcie',
                'my_projects' => 'Moje projekty',
                'workers' => 'Pracownicy',
                'clients' => 'Klienci',
            );
        } else
        {

            $searchModes = array(
                'my_projects' => 'Moje projekty',
                'workers' => 'Pracownicy',
                'clients' => 'Klienci',
            );
        }


        $this->set(compact('searchModes'));
        /*
         * sprawdzanie uprawnien zalogowanego użytkownika
         */
        $session = $this->Session->read();
        $this->Session->write('user_permission', $this->CheckAccess->checkIfUserIsAuthorized($session)); //sprawdzam czy użytkownik należy do sekretariatu, kierowników lub zarzadu
    }

    /**
     * Metoda sprawdzająca uprawnienia zalogowanego użytkownika do zasobu
     * 
     * @return true if authorised/false if not authorized
     * @access public
     */
    public function isAuthorized()
    {

        $return = $this->Permissions->isAuthorized('/' . $this->request->url);
        return $return;
    }

    /**
     * Callback wykonywany przed generowaniem widoku
     * 
     * @access public
     */
    public function beforeRender()
    {
        $this->set('clip', $this->Cookie->read('clip'));
        $session = $this->Session->read();
        if (empty($this->Menu))
        {
            $this->loadModel('Menu.Menu');
        }
        $rootMenus = $this->Menu->get_menu('session', $session);
        $this->set(compact('rootMenus'));
        $this->_setErrorLayout();
    }

    /**
     * 
     * example of basic usage
     * @param bool $baz testowy parametr
     * @return mixed cos zwracanego
     */
    public function test($baz)
    {

        $this->loadModel('User.PermissionGroup');

        $this->PermissionGroup->recursive = -1;
        $this->set('per', $this->PermissionGroup->find('all'));

        $this->render('/Elements/StaticPage/test');
    }

    function _setErrorLayout() {
        if ($this->name == 'CakeError') {
            $this->layout = 'error';
        }
    }

}
