<?php

class SynchronizeLog extends AppModel {

    const LEVEL_ERROR = 1;
    const LEVEL_WARRNING = 2;
    const LEVEL_NOTICE = 3;
    const ACTION_SYNCHRONIZE_ERROR = 'synchronize_error';
    const ACTION_SMALL_FILE = 'small_files';
    const ACTION_USED_PROJECT_HOURS = 'project_hours';
    const ACTION_LEFT_PROJECT_DATE = 'project_date';
    const ACTION_PROJECT_DEADLINE = 'project_deadline';
    const ACTION_SMALLER_HOURS = 'smaller_hours';
    const ACTION_DUPLICATE_ISSUE_NAME = 'duplicate_issue_name';
    const ACTION_PROJECT_EXCEED_DATE = 'project_exceed_date';
    const ACTION_PROJECT_EXCEED_TIME = 'project_exceed_time';

    public $order = "SynchronizeLog.level ASC";
    static $ACTIONS = array(
        SynchronizeLog::ACTION_SYNCHRONIZE_ERROR => 'Krytyczny błąd synchronizacji: <strong class="alert-user">%s</strong>',
        SynchronizeLog::ACTION_SMALL_FILE => 'Plik <strong>%s</strong> użytkownika <strong class="alert-user">%s</strong> jest mniejszy niż ostatnio wczytany do systemu! Nie przeprowadzony synchronizacji czasów!',
        SynchronizeLog::ACTION_PROJECT_EXCEED_DATE => 'Przekroczono deadline projektu <strong data-pid=":pid:" class="alert-project">%s</strong> (%s)!',
        SynchronizeLog::ACTION_PROJECT_EXCEED_TIME => 'Przekroczono godziny dla projektu <strong data-pid=":pid:" class="alert-project">%s</strong>!',
        SynchronizeLog::ACTION_USED_PROJECT_HOURS => 'Wykorzystano <strong>%s</strong> co stanowi <strong>%s</strong> dla projektu <strong data-pid=":pid:" class="alert-project">%s</strong>. <small>Alert: %s</small>',
        SynchronizeLog::ACTION_LEFT_PROJECT_DATE => 'Data oddania projektu <strong data-pid=":pid:" class="alert-project">%s</strong> - <strong>(%s)</strong>, pozostało <strong>%s</strong> dni. <small>Alert: %s</small>',
        SynchronizeLog::ACTION_PROJECT_DEADLINE => 'Deadline projektu <strong data-pid=":pid:" class="alert-project">%s</strong>, zaplanowany jest na JUTRO!',
        SynchronizeLog::ACTION_SMALLER_HOURS => 'Czas zadania <strong>%s</strong>, dla użytkownika <strong class="alert-user">%s</strong> zmniejszył się z <strong>%s</strong>, na <strong>%s</strong>',
        SynchronizeLog::ACTION_DUPLICATE_ISSUE_NAME => 'Zduplikowana nazwa zadania: <strong>%s</strong>, użytkownika <strong class="alert-user">%s</strong>'
    );

    public function log($action, $texts = array(), $level = SynchronizeLog::LEVEL_WARRNING, $pid = null, $uniq = false, $details = array()) {
        $message = str_replace(':pid:', $pid, vsprintf(SynchronizeLog::$ACTIONS[$action], $texts));

        if ($uniq == true) {
            if ($this->find('count', array(
                        'recursive' => -1,
                        'conditions' => array(
                            'action' => $action,
                            'level' => $level,
                            'project_id' => $pid,
                            'message' => $message
                        )
                    ))) {
                return true;
            }
        }

        $this->create();
        $this->save($s = array(
            'SynchronizeLog' => array(
                'action' => $action,
                'level' => $level,
                'project_id' => $pid,
                'details' => json_encode($details),
                'message' => $message
            )
        ));
        
        return $s;
    }

    public $findMethods = array('logs' => true);

    protected function _findLogs($state, $query, $results = array()) {
        if ($state == 'before') {
            
            $user_id = AuthComponent::user('id');
            
            $query['joins'][] = array(
                'table' => 'synchronize_logs_users',
                'alias' => 'SLU',
                'type' => 'LEFT',
                'conditions' => array(
                    'SynchronizeLog.message = SLU.synchronize_log_message',
                    'SLU.user_id' => $user_id
                )
            );
            
            $params['joins'][] = array(
                'table' => 'project_users',
                'alias' => 'ProjectUser',
                'type' => 'LEFT',
                'conditions' => array(
                    'User.id = ProjectUser.user_id',
                )
            );
            
            $params['joins'][] = array(
                'table' => 'project_issues',
                'alias' => 'ProjectIssue',
                'type' => 'LEFT',
                'conditions' => array(
                    'ProjectIssue.projects_id IS NOT NULL',
                    'ProjectUser.name = ProjectIssue.project_users_name',
                )
            );
            
            $params['fields'] = array('ProjectIssue.projects_id', 'ProjectIssue.projects_id');
            $params['group'] = 'ProjectIssue.projects_id';
            $params['conditions']['User.id'] = $user_id;
                        
            $userProjects = ClassRegistry::init('User')->find('list', $params);

            
            $query['joins'][] = array(
                'table' => 'projects',
                'alias' => 'Project',
                'type' => 'INNER',
                'conditions' => array(
                    'SynchronizeLog.project_id = Project.id',
                    'OR' => array(
                        'Project.manager' => $user_id,
                        'Project.cordinator' => $user_id,
                        'Project.id' => $userProjects,
                    )
                )
            );
            
            $query['conditions'][] = array(
                'SLU.id' => null
            );
            
            return $query;
        }
        return $results;
    }

}

?>
