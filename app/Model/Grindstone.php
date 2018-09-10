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
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
	
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
        //$this->Project = ClassRegistry::init('Project');
        $this->ClientProject = ClassRegistry::init('ClientProject');
        //$this->virtualFields = array('fullname' => "CONCAT({$this->alias}.field_1, ' ', {$this->alias}.field_2)");
    }

    public function main()
    {
        //$this->update();
        //$this->synchronize();
    }

	/*
	 * działanie metody: 
	 * 1 łączy się z gindstonem, 
	 * 2 pobiera listę użytkowników, 
	 * 2a pobiera listeporjektów w systemie
	 * 3 sprawdza czy w bazie jest plik z danego dnia dla danego uzytkownika
	 * 4 jeśli nie ma to zapisywany jest plik i jest tworzony nowy wpis w bazie systemu ($grindstone == false)
	 * 5 synchornizacja
	 */
    function update()
    {
        App::uses('GrindstoneApi', 'Network/Http');
        $GrindstoneApi = new GrindstoneApi('http://biuro.feb.net.pl/grindstone/');  //1
		$users = $GrindstoneApi->getUserList(); //2
		
        $projects = array_flip($this->ClientProject->find('list', array( //2a
                    'recursive' => -1,
                    'fields' => array('id', 'alias')
        )));
		
        foreach ($users as $k => $user)
        {
            $lastUserFile = $GrindstoneApi->getLastUserFile($user); //najnowszy plik gridstona danego użytkownika
			
            if (!empty($lastUserFile))
            {
                $grindstone = $this->find('first', array( // 3
                    'recursive' => -1,
					'fields' => 'id,project_user_name,user_id,modified,name,synchronized',
                    'conditions' => array(
                        'Grindstone.project_user_name' => $user,
                        'Grindstone.name' => $lastUserFile['name']
                    )
                ));
				
				//debug(date('H:i:s'));
                if ($grindstone == false || (!empty($grindstone) && $grindstone['Grindstone']['synchronized'] == 0)) // 4 ,jesli pliku nie ma w bazie to jest dodawany(grindston tworzy codziennie nowe pliki)
                {
                    $content = $GrindstoneApi->query($user . '/' . $lastUserFile['name']);
                    	
					$file = fopen('files/grindstone/'.$lastUserFile['name'].".xml", "w");
					
					fwrite($file,$content);
					fclose($file);
					//usuwam znaki BOM z tekstu
					$bom = pack("CCC", 0xef, 0xbb, 0xbf);
					if (0 === strncmp($content, $bom, 3)){
						$content = substr($content, 3);
					}
					
					$user_query = $this->query("SELECT id FROM user_users WHERE SUBSTR(email, 1, INSTR(email, '@') - 1) = '".$user."'"); //nazwa użytkownika z grindstona pokrywa się z pierwszą częsią maila użytkownika - pobieram tą część i id użytkownika
		
					//dodaje do tabeli gridstone tylko użytkowników którzy są w systemie
					if(isset($user_query[0]['user_users']['id'])){
						$user_id = $user_query[0]['user_users']['id'];
						
						$tosave = array(
							'Grindstone' => array(
								'name' => $lastUserFile['name'],
								'date' => $lastUserFile['date'],
								'project_user_name' => $user,
								'user_id' => $user_id
								//'content' => $content, //nie zapisuje pliku do bazy żeby zyskać na wydajności i oszczędzić miejsce
							));
						
						if(!empty($grindstone)){
							$tosave['Grindstone']['id'] = $grindstone['Grindstone']['id'];
						} else {
							$this->create();
						}
						$this->save($tosave, array('validate' => false));
						$user_array = array('name'=>$user,'user_id'=>$user_id);
					
                        
                        //5
						$this->sync($user_array, $content, $this->id, &$users, &$projects); //5

					} 
            
                }
				
            }
        }
    }


	/*
	 * działanie metody:
	 * 
	 * (1) wyszukuje wszystkie issues danego użytkownika jako oldTasks
	 * (2) wczytuje plik xml - bakcup grindstona
	 * (3) dla każdego profilu w pliku spardzam czy ma on zadania
	 * (4)(4a) dla każdego zadania sumuje czas
	 * (5) jeśli zadanie jest przypisane do projektu i (6) w bazie znajduje się projek o aliasie z zadania to zapisuje go do bazy(zadania projektowe - project_issues) 
	 * (7) następnie zapisuje lub aktualizuje(jeśli już istnieje) zadanie i dodaje do go zadań zapisanych (8)
	 * (9) ostatnim krokiem jest sprawdzenie czy w oldTasks jest więcej wpisów niż we wczytanym pliku(np. pracownik pomylił się i przypisał task do złego projektu a później to poprawił)
	 * i usunięcie z bazy nadmiarowych wpisów
	 */
    public function sync($user, $content, $grindstone_id, &$users, &$projects)
    {
		set_time_limit(0);

        debug('Rozpoczynam synchronizacje dla: ' . $user['name']);
        //Lista zadań obecnego uzytkownika
		$this->ProjectIssue->deleteAll(array(
                'ProjectIssue.user_id' => $user['user_id']
            ));

        $xml = Xml::build($content);//(2)
        $x = Xml::toArray($xml);

        $x['config']['profile'] = empty($x['config']['profile']['task']) ? $x['config']['profile'] : array($x['config']['profile']);

        foreach ($x['config']['profile'] as $profiles) //(3)
        {
            if (empty($profiles['task']))
            {
				continue;
			}
			//die(debug($profiles['task']));
			foreach ($profiles['task'] as $task) //(4)
			{
				if (empty($task['time']))
				{ 
					continue; //debug('Brak dat rozpoczecia i zakonczenia! Przechodze do nastepnego zadania');
				}

				$info = $this->calculateTime($task['time']); //(4a)

				$projectName = !empty($task['customValue']) ? Feb::getProjectName($task['customValue']) : null;

				$pAlias = Feb::normalize($projectName);

			
				foreach ($info['time'] as $year_month_time => $value){
					$tmp_y_m_time = explode('_', $year_month_time);
					$toSave = array(
						'ProjectIssue' => array(
							'name' => $task['@name'],
							'project' => $pAlias,
							'client_project_id' => !empty($projects[$pAlias]) ? $projects[$pAlias] : null,
							'alias' => Feb::normalize($task['@name']),
							'time' => $value,
							'project_users_name' => $user['name'],
							'user_id'=>$user['user_id'],
							'start' => date('Y-m-d H:i:s', $info['minTime']),
							'end' => date('Y-m-d H:i:s', $info['maxTime']),
							'year' => $tmp_y_m_time[0],
							'month' => $tmp_y_m_time[1]
						)
					);
					
					$this->ProjectIssue->create();
					if (!$this->ProjectIssue->save($toSave, false))
					{
						debug('NIE ZAPISANO ZADANIA!');
					}
				}
				
			}
        }

        $this->id = $grindstone_id;
        $this->saveField('synchronized', 1);

        debug('Synchronizacja zakonczona.');
		die();//zatrzymuje - synchronizacja wykona się tylko dla pojedynczego użytkownika(trzeba ją odpalić tyle razy ile jest użytkowników
    }
	
	
    public function synchronizeUsers()
    {
        $users = $this->query("SELECT SUBSTR(email, 1, INSTR(email, '@') - 1) as name, id as user_id FROM user_users ");
        foreach ($users as $user){
                $this->query('UPDATE `grindstones` set user_id = "'.$user['user_users']['user_id'].'" WHERE project_user_name = "'.$user[0]['name'].'"');
        }
    }
	
	/*
	 * metoda synchronizuje użytkowników w systemie(tylko tych którzy nie mają przypisanego user_id) z zadaniami z grindstona
	 */
    public function synchronizeUsersWithGrindstone()
    {
        $users = $this->query("SELECT SUBSTR(email, 1, INSTR(email, '@') - 1) as name, id as user_id FROM user_users"); //nazwa użytkownika z grindstona pokrywa się z pierwszą częsią maila użytkownika - pobieram tą część i id użytkownika

        foreach ($users as $user){
                //$this->query('UPDATE `project_issues` set user_id = "'.$user['user_users']['user_id'].'" WHERE project_users_name = "'.$user[0]['name'].'" AND user_id is null'); //przypisuje id użytkownika do wszystkich zadań z daną nazwą użytkownika
                $this->query('UPDATE `grindstones` set user_id = "'.$user['user_users']['user_id'].'" WHERE project_users_name = "'.$user[0]['name'].'" AND user_id is null'); //przypisuje id użytkownika do wszystkich zadań z daną nazwą użytkownika
        }
    }

	
	    /**
     * Szula majmniejszeszej oraz najwiekszego czasu
     * w odpowiedzi zwraca tablice o kluczach time, maxTime, minTime
     * 
     * @param type $times
     * @return type array(time=>(int),maxTime=>(int),minTime=>(int))
     * @throws ErrorException 
     */
    public function calculateTime($times = array())
    {
        if(empty($times)){
            return false;
        }
        if (isSet($times['@end']))
        {
            $times = array($times);
        }

        $ret['time'] = array();
        $ret['maxTime'] = 0;
        $tmp = reset($times);
        $ret['minTime'] = strtotime($tmp['@start']);
        foreach ($times as $time)
        {
            $start = strtotime($time['@start']);
            $end = strtotime($time['@end']);
			
			$xol = date('Y_m', $start);
		
			if(empty($ret['time'][$xol])){
				$ret['time'][$xol] = 0;
			}
			
            $ret['time'][$xol] += $end - $start;
            if ($end > $ret['maxTime'])
            {
                $ret['maxTime'] = $end;
            }

            if ($start < $ret['minTime'])
            {
                $ret['minTime'] = $start;
            }
        }

        return $ret;
    }
}
