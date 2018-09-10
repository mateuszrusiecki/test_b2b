<?php

App::uses('AppModel', 'Model');
App::uses('Feb', 'Utility');
//App::uses('Xml', 'Utility');
App::import('Utility', 'Xml');
/**
 * Grindstone Model
 *
 */
class Grindstone extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array())
    {
        
    }

    /**
     * Konstruktor klasy modelu
     * 
     * @param int $id
     * @param array $table
     * @param bool $ds 
     */
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->ProjectIssue = ClassRegistry::init('ProjectIssue');
        $this->ProjectUser = ClassRegistry::init('ProjectUser');
        $this->Project = ClassRegistry::init('Project');
        //$this->virtualFields = array('fullname' => "CONCAT({$this->alias}.field_1, ' ', {$this->alias}.field_2)");
    }

    public function main()
    {
        $this->update();
        $this->synchronize();
    }

    function update()
    {
        App::uses('GrindstoneApi', 'Network/Http');
        $GrindstoneApi = new GrindstoneApi('http://biuro.feb.net.pl/grindstone/');
        $folders = $GrindstoneApi->getUserList();

        foreach ($folders as $k => $user)
        {
            $lastUserFile = $GrindstoneApi->getLastUserFile($user);
            if (!empty($lastUserFile))
            {
                $is = $this->find('count', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'Grindstone.name' => $lastUserFile['name']
                    )
                ));
                if ($is == 0)
                {
                    $content = $GrindstoneApi->query($user . '/' . $lastUserFile['name']);
                    $this->create();
					
					//usuwam znaki BOM z tekstu
					$bom = pack("CCC", 0xef, 0xbb, 0xbf);
					if (0 === strncmp($content, $bom, 3)){
						$content = substr($content, 3);
					}
					if($user == 'a.dziki' || $user == 'd.czyz'){
						//@todo [TODO] USUNAC TEN WARUNEK ALE MUSI BYC ZMIENIONE max_allowed_packet w my.ini bazy lokalnej 192.168.0.10 z 1048576 na 2097152
					} else {
					
                    $this->save($tosave = array(
                        'Grindstone' => array(
                            'name' => $lastUserFile['name'],
                            'date' => $lastUserFile['date'],
                            'project_user_name' => $user,
                            'content' => $content,
                        )), array('validate' => false));
					}
                }
            }
        }
    }

    public function synchronize()
    {
        $this->ProjectIssue->query("TRUNCATE TABLE project_issue_entries");
        $users = $this->ProjectUser->find('list');
        $projects = array_flip($this->Project->find('list', array(
                    'recursive' => -1,
                    'fields' => array('id', 'alias')
        )));
        $data = $this->query("SELECT * FROM ( SELECT * FROM grindstones ORDER BY date DESC) AS Grindstone GROUP BY Grindstone.project_user_name;");
        foreach ($data as $k => $d)
        {
            $this->sync($user = $d['Grindstone']['project_user_name'], $content = $d['Grindstone']['content'], $grindstone_id = $d['Grindstone']['id'], &$users, &$projects);
            $this->updateUserLastSync($user, $d['Grindstone']['date']);
        }
    }

    public function sync($user, $content, $grindstone_id, &$users, &$projects)
    {
		set_time_limit(0);
        if (!in_array($user, $users))
        {
            debug('Uzytkownika: ' . $user . 'nie ma w systemie, pomijam go, dodaje go');
            $this->ProjectUser->create();
            $this->ProjectUser->save(array(
                'ProjectUser' => array(
                    'name' => $user
                )
            ));
        }


//        debug('Rozpoczynam synchronizacje dla: ' . $user);
        $savedTasks = array();
        $savedTasksAlias = array();
        //Lista zadań obecnego uzytkownika
        $oldTasks = $this->ProjectIssue->find('all', array(
            'recursive' => -1,
            'fields' => array('id', 'name', 'time', 'alias'),
            'conditions' => array(
                'project_users_name' => $user
            )
        ));

//        debug('Znaleziono: ' . count($oldTasks) . ' obecnie wprowadzonych zadan do systemu');

        $oldTaskIndexes = Set::combine($oldTasks, '{n}.ProjectIssue.id', '{n}.ProjectIssue.id');
        $oldTasks = Set::combine($oldTasks, '{n}.ProjectIssue.alias', '{n}.ProjectIssue');
 
		
        $xml = Xml::build($content);
        $x = Xml::toArray($xml);

        $x['config']['profile'] = empty($x['config']['profile']['task']) ? $x['config']['profile'] : array($x['config']['profile']);

        foreach ($x['config']['profile'] as $profiles)
        {
            if (!empty($profiles['task']))
            {
                foreach ($profiles['task'] as $task)
                {
                    $alias = Feb::normalize($task['@name']);

                    debug('Synchronizacja zadania: ' . $task['@name']);
                    debug('Uzytkownik: ' . $user);

                    if (empty($task['time']))
                    {
//                        debug('Brak dat rozpoczecia i zakonczenia! Przechodze do nastepnego zadania');
                        continue;
                    }

//                    if (in_array($alias, $savedTasksAlias)) {
//                        $this->notifications[] = $this->SynchronizeLog->log(SynchronizeLog::ACTION_DUPLICATE_ISSUE_NAME, array(
//                            $task['@name'],
//                            $user
//                        ), SynchronizeLog::LEVEL_WARRNING);
//
////                        debug('Zduplikowana nazwa zadania! Pomijam wiersz');
//                        //@ToDo Fix problemy http://pm.feb.net.pl/issues/10923 jeżeli jest zduplikowana nazwa zadania nie jest synchronizowane
//                        //continue;
//                    }

                    $info = $this->Project->calculateTime($task['time']);

                    $currentTime = isSet($oldTasks[Feb::normalize($task['@name'])]['time']) ? $oldTasks[$alias]['time'] : 0;

                    debug(__('Do tej porty na zadanie poswiecono: %s, obecnie: %s, roznica: %s', round($currentTime / 60 / 60, 2) . 'h', round($info['time'] / 60 / 60, 2) . 'h', round(($info['time'] - $currentTime) / 60 / 60, 2) . 'h'));

                    $projectName = !empty($task['customValue']) ? Feb::getProjectName($task['customValue']) : null;

                    $pAlias = Feb::normalize($projectName);

                    if (!empty($projectName))
                    {

                        if (!key_exists($pAlias, $projects))
                        {
//                            debug('Brak projektu ' . $projectName . ' - tworze go');
                            $this->Project->create();
                            $this->Project->save(array('Project' => array('alias' => $pAlias, 'name' => $projectName)), array('validate' => false));
                            $projects[$pAlias] = $this->Project->getLastInsertID();
                        }
                    }


                    $toSave = array(
                        'ProjectIssue' => array(
                            'name' => $task['@name'],
                            'project' => $pAlias,
                            'projects_id' => !empty($projects[$pAlias]) ? $projects[$pAlias] : null,
                            'alias' => Feb::normalize($task['@name']),
                            'time' => $info['time'],
                            'project_users_name' => $user,
                            'start' => date('Y-m-d H:i:s', $info['minTime']),
                            'end' => date('Y-m-d H:i:s', $info['maxTime']),
                        )
                    );

//                    if ($currentTime > $info['time']) {
//                        $this->notifications[] = $this->SynchronizeLog->log(SynchronizeLog::ACTION_SMALLER_HOURS, array(
//                            $task['@name'],
//                            $user,
//                            round($currentTime / DAY, 2),
//                            round($info['time'] / DAY, 2)
//                        ), SynchronizeLog::LEVEL_WARRNING, $toSave['ProjectIssue']['projects_id']);
//                    }

                    if (isSet($oldTasks[Feb::normalize($task['@name'])]))
                    {
//                        debug('Uakualnianie zadania: ' . $task['@name']);
                        $toSave['ProjectIssue']['id'] = $oldTasks[Feb::normalize($task['@name'])]['id'];
                        if (!$this->ProjectIssue->save($toSave, array('validate' => false)))
                        {
                            debug('NIE ZAPISANO ZADANIA!');
                        }
                        $this->saveTime($projectIssueID = $toSave['ProjectIssue']['id'], $task['time']);
                    } else
                    {
//                        debug('Zapisywanie zadania: ' . $task['@name']);
                        $this->ProjectIssue->create();
                        if (!$this->ProjectIssue->save($toSave, array('validate' => false)))
                        {
                            debug('NIE ZAPISANO ZADANIA!');
                        }
                        $this->saveTime($projectIssueID = $this->ProjectIssue->getLastInsertID(), $task['time']);
                    }

                    array_push($savedTasks, $projectIssueID);
                    array_push($savedTasksAlias, $toSave['ProjectIssue']['alias']);
                }
            }
        }

        $notExists = array_diff($oldTaskIndexes, $savedTasks);
        if (!empty($notExists))
        {
//            debug('Usuwam zadania: ' . implode(',', $notExists));
            $this->ProjectIssue->deleteAll(array(
                'ProjectIssue.id' => $notExists
            ));
        } else
        {
//            debug('Brak zadan do usuniecia');
        }

        $this->id = $grindstone_id;
        $this->saveField('synchronized', 1);

        debug('Synchronizacja zakonczona.');
    }

    private function saveTime($project_issue_id, $times)
    {
        if (!empty($times['@end']))
        {
            $times = array($times);
        }
        foreach ($times as $time)
        {
            $this->ProjectIssue->query($cos = "
                            INSERT INTO `project_issue_entries` (`project_issue_id`, `start`, `end`) 
                            VALUES ('{$project_issue_id}', '{$time['@start']}', '{$time['@end']}')");
        }
    }

    public function updateUserLastSync($user, $date)
    {
        $this->ProjectUser->create();
        $this->ProjectUser->save(array('name' => $user, 'last_sync' => $date));
    }

}
