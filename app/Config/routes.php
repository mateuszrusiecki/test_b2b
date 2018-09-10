<?php
App::uses('RouteHome', 'Lib/FebRoute');
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Configure::write('SalarySalt',"kl*&())!@#$%IOPKLKJHUIłłóęśłłł€r8dfklvfdklh65");
$languages = array('eng');
$languages = implode('|', $languages);
$plugins = implode('|', array('news', 'page', 'menu', 'member','translate'));

Router::connectNamed(array('lang'), array('default' => true));

Router::connect('/users/login', array('controller' => 'users', 'action' => 'login', 'plugin'=>'user'));
Router::connect('/login', array('controller' => 'users', 'action' => 'login', 'plugin'=>'user'));
Router::connect('/first_login', array('controller' => 'users', 'action' => 'first_login', 'plugin'=>'user'));
Router::connect('/logwanie', array('controller' => 'users', 'action' => 'login', 'plugin'=>'user'));
Router::connect('/grayscale/*', array('controller' => 'images', 'action' => 'singleFile', 'plugin'=>'Image'));
Router::connect('/js/tiny_mce4/js/tinymce/plugins/filemanager/*', array('plugin' => 'page', 'controller' => 'pages', 'action' => 'ajaxfilemanager'));
Router::connect('/files/module_photo/*', array('controller' => 'module_photos', 'action' => 'photo'));
Router::connect('/admin', array('admin' => 'admin', 'controller' => 'panel', 'action' => 'index', 'plugin'=>'panel'));
//Router::connect('/', array('admin' => 'admin', 'controller' => 'panel', 'action' => 'index', 'plugin'=>'panel'));
Router::connect('/', array('plugin'=> false, 'controller' => 'fronts', 'action' => 'front'),array('routeClass' => 'RouteHome'));
Router::connect('/:lang', array('plugin' => false, 'controller' => 'fronts', 'action' => 'front'), array('lang' => $languages,'routeClass' => 'RouteHome'));
Router::connect('/:lang/p/*', array('plugin'=>'page', 'controller' => 'pages', 'action' => 'view'), array('lang' => $languages));
Router::connect('/p/*', array('plugin'=>'page', 'controller' => 'pages', 'action' => 'view'));
//Router::connect('/clients/*', array( 'controller' => 'clients', 'action' => 'index'));
Router::connect('/aktualnosci/*', array('plugin'=>'news', 'controller' => 'news', 'action' => 'view'));
Router::connect('/site/*', array('plugin'=>'dynamic_elements', 'controller' => 'dynamic_elements', 'action' => 'view'));
Router::connect('/team', array('controller' => 'vacations', 'action' => 'team'));
Router::connect('/coordinator_panel', array('controller' => 'fronts', 'action' => 'coordinator_panel'));
Router::connect('/hire', array('controller' => 'hrs', 'action' => 'hire_employee'));
Router::connect('/worker_panel', array('controller' => 'fronts', 'action' => 'worker_panel'));
Router::connect('/management_panel', array('controller' => 'fronts', 'action' => 'management_panel'));
Router::connect('/client_panel', array('controller' => 'fronts', 'action' => 'client_panel'));
Router::connect('/crm_activity', array('controller' => 'fronts', 'action' => 'crm_activity'));
Router::connect('/crm_report', array('controller' => 'fronts', 'action' => 'crm_report'));
Router::connect('/403', array('controller' => 'fronts', 'action' => 'r403'));
Router::connect('/filled_poll', array('controller' => 'fronts', 'action' => 'filled_poll'));
Router::connect('/feb_book', array('controller' => 'fronts', 'action' => 'feb_book'));
Router::connect('/feb_book/view', array('controller' => 'fronts', 'action' => 'feb_book_view'));
Router::connect('/bonus', array('controller' => 'fronts', 'action' => 'bonus'));
Router::connect('/add_bonus', array('controller' => 'fronts', 'action' => 'add_bonus'));
Router::connect('/bonus_project_list', array('controller' => 'fronts', 'action' => 'bonus_project_list'));
Router::connect('/base_project_list', array('controller' => 'fronts', 'action' => 'base_project_list'));
Router::connect('/base_project_add', array('controller' => 'fronts', 'action' => 'base_project_add'));
Router::connect('/base_modules_list', array('controller' => 'fronts', 'action' => 'base_modules_list'));
Router::connect('/base_modules_add', array('controller' => 'fronts', 'action' => 'base_modules_add'));
Router::connect('/base_modules_view', array('controller' => 'fronts', 'action' => 'base_modules_view'));
Router::connect('/base_project_view', array('controller' => 'fronts', 'action' => 'base_project_view'));


/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
//Router::connect('/page/*', array('plugin' => 'page', 'controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
Router::connect('/robots', array('plugin' => false, 'controller' => 'fronts', 'action' => 'robots'));
Router::connect('/robots', array('plugin' => false, 'controller' => 'fronts', 'action' => 'robots'));


CakePlugin::routes();

Router::connect('/:lang/admin/:plugin/:controller/:action/*', array('plugin' => true, 'admin' => true), array('plugin' => $plugins, 'lang' => $languages));
Router::connect('/:lang/:plugin/:controller/:action/*', array(), array('plugin' => $plugins, 'lang' => $languages));
Router::connect('/:lang/:plugin/:controller', array(), array('plugin' => $plugins, 'lang' => $languages));

Router::connect('/:lang/admin/:controller/:action/*', array('admin' => true), array('lang' => $languages));
Router::connect('/:lang/admin/:controller/:action/*', array('admin' => 'admin'), array('lang' => $languages));
Router::connect('/:lang/admin/:controller', array('admin' => 1, 'prefix' => 'admin'), array('lang' => $languages));
Router::connect('/:lang/admin/:controller', array('admin' => 'admin', 'prefix' => 'admin'), array('lang' => $languages));

Router::connect('/:lang/:controller/:action/*', array(), array('lang' => $languages));
Router::connect('/:lang/:controller/', array(), array('lang' => $languages));

Router::parseExtensions('json', 'txt','pdf','xls','xlsx');

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
