<?php

App::uses('AppModel', 'Model');

/**
 * Report Model
 */
class Report extends AppModel
{

    public $useTable = null;

    public function profit_clients($params)
    {
        $this->ClientProject = ClassRegistry::init('ClientProject');
        $p = $this->prepapreParamsConditions($params);
        $p['recursive'] = -1;
        $p['fields'] = array(
            'Client.*',
            'client_id',
            'SUM(`total_development_costs`) as sum_development_costs',
            'SUM(`total_buffer`) as sum_buffer',
            'SUM(`total_costs_sum`) as sum_costs_sum',
                //'SUM(`sum_total_development_costs`,`sum_total_buffer`) as sum',
        );
        $p['group'] = 'client_id';
        $p['joins'][] = array(
            'table' => 'clients',
            'alias' => 'Client',
            'type' => 'LEFT',
            'conditions' => array(
                'Client.id = ClientProject.client_id'
            )
        );
        $projects = $this->ClientProject->find('all', $p);
        foreach ($projects as &$project)
        {
            $project['budget'] = ($project['0']['sum_development_costs'] + $project['0']['sum_buffer']) - $project['0']['sum_costs_sum'];
        }
        return $projects;
    }

    public function profit_sections($params = array())
    {
        $section_id = empty($params['named']['s_id']) ? '' : $params['named']['s_id'];
        if (empty($section_id))
        {
            return false;
        }
        $this->ClientProject = ClassRegistry::init('ClientProject');
        $p = $this->prepapreParamsConditions($params);
        $p['recursive'] = -1;
//        $p['fields'] = array(
//            'Client.*',
//            'client_id',
//            'SUM(`total_development_costs`) as sum_development_costs',
//            'SUM(`total_buffer`) as sum_buffer',
//            'SUM(`total_costs_sum`) as sum_costs_sum',
        //'SUM(`sum_total_development_costs`,`sum_total_buffer`) as sum',
//        );
        $p['fields'] = array(
            'ClientProjectBudget.position_value',
            'ClientProjectBudget.section_id',
            'ClientProject.id',
            'ClientProject.alias',
            'ClientProject.name',
                //'SUM(`ClientProjectBudget`.`position_value`) as sum_position_value',
        );
        //$p['group'] = 'ClientProject.id';
        $p['conditions']['ClientProjectBudget.section_id'] = $section_id;

        $p['joins'][] = array(
            'table' => 'client_project_budgets',
            'alias' => 'ClientProjectBudget',
            'type' => 'INNER',
            'conditions' => array(
                'ClientProject.id = ClientProjectBudget.client_project_id'
            )
        );
        $projects = $this->ClientProject->find('all', $p);
        //debug($projects); die;
        $this->ProjectIssue = ClassRegistry::init('ProjectIssue');
        $this->Section = ClassRegistry::init('Section');
        $this->Section->id = $section_id;
        $hourly_rate = $this->Section->field('hourly_rate');
        $this->ProjectIssue->recursive = -1;
        foreach ($projects as &$project)
        {
            $c = array();
            $c['recursive'] = -1;
            $c['fields'] = array(
                'SUM(`time`) as time',
            );
            $c['group'] = 'ProjectIssue.client_project_id';
            $c['conditions']['ProjectIssue.client_project_id'] = $project['ClientProject']['id'];
            $c['conditions']['UserSection.section_id'] = $section_id;

            $c['joins'][] = array(
                'table' => 'user_sections',
                'alias' => 'UserSection',
                'type' => 'LEFT',
                'conditions' => array(
                    'UserSection.user_id = ProjectIssue.user_id'
                )
            );
            $issues = $this->ProjectIssue->find('first', $c);
            $time = empty($issues['0']['time']) ? 0 : $issues['0']['time'];
            $project['work_time'] = $time / (3 * 60);
            $project['work_cost'] = $project['work_time'] * $hourly_rate;
        }
        return $projects;
    }

    public function satisfaction_clients($params)
    {
        $this->PollAnswer = ClassRegistry::init('Poll.PollAnswer');
        $p = $this->prepapreParamsConditions($params, 'Poll', 'created');
        $p['recursive'] = -1;
        $p['conditions'][] = 'PollAnswer.answer IS NOT NULL';
        $p['conditions']['PollQuestion.type'] = 1;
        $p['fields'] = array(
            'Client.*',
            'SUM(`answer`) as sum_answer',
            'COUNT(*) as count_answer',
        );
        $p['group'] = 'Poll.client_project_id';
        $p['joins'][] = array(
            'table' => 'poll_questions',
            'alias' => 'PollQuestion',
            'type' => 'LEFT',
            'conditions' => array(
                'PollQuestion.id = PollAnswer.poll_question_id'
            )
        );
        $p['joins'][] = array(
            'table' => 'polls',
            'alias' => 'Poll',
            'type' => 'LEFT',
            'conditions' => array(
                'Poll.id = PollQuestion.poll_id'
            )
        );
        $p['joins'][] = array(
            'table' => 'clients',
            'alias' => 'Client',
            'type' => 'LEFT',
            'conditions' => array(
                'Client.id = Poll.client_project_id'
            )
        );
        $projects = $this->PollAnswer->find('all', $p);
        foreach ($projects as &$project)
        {
            $project['average'] = empty($project['0']['count_answer']) ? '0' : $project['0']['sum_answer'] / $project['0']['count_answer'];
        }
        return $projects;
    }

    public function prepapreParamsConditions($params = array(), $model = 'ClientProject', $field = 'end_project')
    {
        $date_from = empty($params['named']['from']) ? '' : $params['named']['from'];
        $date_to = empty($params['named']['to']) ? '' : $params['named']['to'];

        if (!empty($date_from))
        {
            $params['conditions']['AND'][][$model . '.' . $field . ' >='] = $date_from;
        }
        if (!empty($date_to))
        {
            $params['conditions']['AND'][][$model . '.' . $field . ' <='] = $date_to;
        }
        return $params;
    }

}
