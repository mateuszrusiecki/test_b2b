<?php

class Menu extends AppModel
{

    public $name = 'Menu';
    public $displayField = 'lft';
    public $order = 'Menu.lft';
    public $lft = 0;
    public $rght = 0;

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array(
        //'Slug',
        'Translate' => array('name', 'url'),
        //'Image.Upload'=>array('imageOptions'=>array('size'=>array('width'=>1920, 'height'=>1200))),
        //'Tree.FebTree'
        'Menu.Menu',
        'Modification.Modification',
        'Tree',
    );

//    public $belongsTo = array(
//        'Page' => array(
//            'className' => 'Page.Page',
//            'foreignKey' => 'row_id',
//            'conditions' => array('Menu.model' => 'Page')
//        )
//    );

    public function urlOptions()
    {
        $options['0'] = __d('cms', 'Pozycja bez linku (węzeł)');
        $options['1'] = __d('cms', 'Pozycja z linkiem');
        $options['2'] = __d('cms', 'Pozycja powiązana z podstroną');
        return $options;
    }

    public function setScope($scope)
    {
        $this->Behaviors->attach('Menu.Menu', array('scope' => $scope));
    }

    public function saveOrder($data)
    {
        //liczy ilosc w pozycji menu
        $flatten = Set::flatten($data);
        foreach ($flatten as $k => $v)
        {
            if (stripos($k, "Menu.id") !== false)
            {
                ++$this->rght;
            }
        }

        $this->lft($data);
        //$this->recover('tree');
    }

    public function lft($nodes, $parent_id = null)
    {
        foreach ($nodes as &$node)
        {
            //opoznienie wynika ze wzgledu zwłoki dodawania $this->lft
            usleep(500);
            $node['Menu']['lft'] = ++$this->lft;
            $node['Menu']['rght'] = $this->rght + ($this->rght - $this->lft) + 1;
            $node['Menu']['parent_id'] = $parent_id;
            $return = $this->save($node['Menu']);
            if (!empty($node['children']))
            {
                $this->lft($node['children'], $return['Menu']['id']);
            }
        }
    }

    public function reset($group_id)
    {
        $this->recursive = -1;
        $all = $this->findAllByGroupId($group_id);
        $list = Set::combine($all, '{n}.Menu.id', '{n}.Menu.id');
        foreach ($all as $value)
        {
            if (!empty($value['Menu']['parent_id']) && in_array($value['Menu']['parent_id'], $list))
            {
                continue;
            }
            $this->id = $value['Menu']['id'];
            $this->saveField('parent_id', null);
        }
        $this->setScope("Menu.group_id = '$group_id'");
        return $this->findTree();
    }

    function get_menu($group_id = null, $session = array())
    {
        if (empty($session['Auth']['Groups']))
        {
            return false;
        }
        
        if ('session' == $group_id)
        {
            $this->Group = ClassRegistry::init('User.Group');
            $group_alias = key($session['Auth']['Groups']);
            $params['conditions']['Group.alias'] = $group_alias;
            $params['fields'] = array('Group.id', 'Group.id');
            $tmp = $this->Group->find('list', $params);
            $group_id = reset($tmp);
        }
        $this->setScope("Menu.group_id = '$group_id'");
        $data = $this->findTree();
        return $data;
    }

}
