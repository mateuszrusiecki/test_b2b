<?php

App::uses('CakeRoute', 'Routing/Route');
App::uses('AppModel', 'Model');
//App::uses('User', 'User.Model');
App::uses('Group', 'User.Model');
App::uses('CakeSession', 'Model/Datasource');

class RouteHome extends CakeRoute
{

    public function __construct($template, $defaults = array(), $options = array())
    {
        $groups = $this->checkPermission();

        $defaults = $this->redirectHome($groups, $defaults);
        parent::__construct($template, $defaults, $options);
    }

    public function checkPermission()
    {
        $session = CakeSession::read();
        if (empty($session['Auth']['User']))
        {
            return array();
        }
        $Group = new Group();
        $params['joins'] = array(
            array('table' => 'user_groups_users',
                'alias' => 'GroupsUser',
                'type' => 'INNER',
                'conditions' => array(
                    'Group.id = GroupsUser.group_id',
                    'GroupsUser.user_id' => $session['Auth']['User']['id']
                )
            )
        );
        $params['fields'] = array('alias', 'alias');
        $params['recursive'] = -1;
        $groups = $Group->find('list', $params);
        //$User = new User();
        //$User->recursive = -1;
        //$user = $User->find('all');
//        $session = CakeSession::read();
//        $groups = empty($session['Auth']['Groups']) ? array() : array_keys($session['Auth']['Groups']);
        return $groups;
    }

    public function redirectHome($groups = array(), $defaults = array())
    {

        if (empty($groups))
        {
            return array(
                'plugin' => 'user',
                'controller' => 'users',
                'action' => 'login'
            );
        }
        $defaults['action'] = reset($groups);
        if ('/eng' == $_SERVER['REQUEST_URI'])
        {
            $defaults['lang'] = 'eng';
        }
        return $defaults;
    }

    public function redirectHomeOld($groups = array(), $defaults = array())
    {

        if (in_array('superAdmins', $groups))
        {
            $defaults = array(
                'plugin' => false,
                'controller' => 'fronts',
                'action' => 'super_admin'
            );
            return $defaults;
        }
        if (in_array('management', $groups))
        {
            $defaults = array(
                'plugin' => false,
                'controller' => 'fronts',
                'action' => 'management_panel'
            );
            return $defaults;
        }
        debug($groups);
        if (in_array('w_trader', $groups))
        {
            $defaults = array(
                'plugin' => false,
                'controller' => 'fronts',
                'action' => 'trader_panel'
            );
            return $defaults;
        }
        if (in_array('client', $groups))
        {
            $defaults = array(
                'plugin' => false,
                'controller' => 'fronts',
                'action' => 'client_panel'
            );
            return $defaults;
        }
        if (in_array('m_secretariat', $groups) || in_array('w_secretariat', $groups) || in_array('secretariat', $groups))
        {
            $defaults = array(
                'plugin' => false,
                'controller' => 'hrs',
                'action' => 'index'
            );
            return $defaults;
        }
        return $defaults;
    }

}
