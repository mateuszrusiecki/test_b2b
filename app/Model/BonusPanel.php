<?php

App::uses('AppModel', 'Model');

/**
 * Report Model
 */
class BonusPanel extends AppModel
{

    public $useTable = null;

    function timeProject($startProject = null, $endProject = null)
    {

        $check = time();
        $long = (strtotime($endProject) - strtotime($startProject));
        $current = ($check - strtotime($startProject));
        $return['percent'] = empty($long) ? 0 : round(($current / $long)*100);
        $return['overrange'] = intval($return['percent'] / 100);
        return $return;
    }

    function profitCost($total_costs_sum = null, $total_development_costs = null)
    {
        
        $total = intval($total_development_costs);
        $return['percent'] = empty($total) ? 0 : round(($total_costs_sum / $total) * 100);
        $return['percent'] = 100 - $return['percent'];
        $return['overrange'] = intval($return['percent'] / 100);
        return $return;
    }

    function profitButget($total_costs_sum = null, $total_development_costs = null, $total_buffer = null)
    {
        $total = intval($total_development_costs + $total_buffer);
        $return['percent'] = empty($total) ? 0 : round(($total_costs_sum / $total) * 100);
        $return['percent'] = 100 - $return['percent'];
        $return['overrange'] = intval($return['percent'] / 100);
        return $return;
    }

}
