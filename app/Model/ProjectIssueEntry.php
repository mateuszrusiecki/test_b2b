<?php

App::uses('AppModel', 'Model');

/**
 * ProjectIssueEntry Model
 *
 */
class ProjectIssueEntry extends AppModel
{

    /**
     * Pobieranie danych z pojektu oraz na virala fields suma stawek 
     * oraz suma godzin w odpowiedzi daje tablic ProjectIssueEntry
     * 
     * @param type $client_project_id
     * @return type array()
     * @throws ErrorException 
     */
    public function getCostByProject($pid = null)
    {
        if (empty($pid))
        {
            return false;
        }

        //$this->virtualFields['stawka'] = "SUM(((UNIX_TIMESTAMP(ProjectIssueEntry.end) - UNIX_TIMESTAMP(ProjectIssueEntry.start)) / 3600) * ProjectUsersSalary.rate)";
        $this->virtualFields['godziny'] = "SUM(((UNIX_TIMESTAMP(ProjectIssueEntry.end) - UNIX_TIMESTAMP(ProjectIssueEntry.start)) / 3600))";

        $params['fields'] = array(
           //'ProjectUsersType.id',
           //'ProjectUsersType.name',
           // 'ProjectIssueEntry.stawka',
            'ProjectIssue.project_users_name',
           //'ProjectUsersSalary.*',
            'ProjectIssueEntry.godziny',
            'ProjectIssueEntry.*'
        );

        //$params['group'] = 'ProjectUsersSalary.project_users_type_id';

        $params['joins'][] = array(
            'table' => 'project_issues',
            'alias' => 'ProjectIssue',
            'type' => 'LEFT',
            'conditions' => array(
                'ProjectIssue.id = ProjectIssueEntry.project_issue_id'
            )
        );

        $params['joins'][] = array(
            'table' => 'project_users',
            'alias' => 'ProjectUser',
            'type' => 'LEFT',
            'conditions' => array(
                'ProjectUser.name = ProjectIssue.project_users_name'
            )
        );

//       $params['joins'][] = array(
//           'table' => 'project_users_types',
//           'alias' => 'ProjectUsersType',
//           'type' => 'LEFT',
//           'conditions' => array(
//               'ProjectUsersType.id = ProjectUser.project_users_type_id'
//           )
//       );
//       $params['joins'][] = array(
//           'table' => 'project_users_salaries',
//           'alias' => 'ProjectUsersSalary',
//           'type' => 'LEFT',
//           'conditions' => array(
//               'ProjectIssue.project_users_name = ProjectUsersSalary.project_users_name',
//               'DATE_FORMAT(ProjectIssueEntry.start, "%Y-%m-%d") >= ProjectUsersSalary.from',
//               'IF(ProjectUsersSalary.to IS NULL, DATE_FORMAT(ProjectIssueEntry.start, "%Y-%m-%d") <= NOW(), DATE_FORMAT(ProjectIssueEntry.start, "%Y-%m-%d") <= ProjectUsersSalary.to)',
//           )
//       );


        $params['conditions'] = array(
            'ProjectIssue.client_project_id' => $pid
        );
        $d = $this->find('all', $params);
        return $d;
    }

}
