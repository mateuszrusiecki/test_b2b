<?php

App::uses('Section', 'Model');
App::uses('ClientProject', 'Model');
App::uses('User', 'Model');
App::uses('ClientProjectUser', 'Model');
App::uses('Client', 'Model');
class CheckAccessComponent extends Component {
	
	public $components = array('Session');
	
	/*
	 * Metoda sprawdza czy aktualniezalogowany użytkownik należy do działu 'sekretariat'
	 */
    function checkIfUserBelngsToSecretariat($user_id=null)
    {
        if(empty($user_id)){
            return false;
        }
		$section = new Section();
		return $section->checkIfUserBelngsToSecretariat($user_id);
	}
	
	/*
	 * Metoda sprawdza jakie uprawnienia ma aktualnie zalogowany uzytkownik
	 * 
	 * @param				$user_id - id użytkownika
	 * 
	 * @return	boolean		string - uprawnienia - dla zarządu, amdina i kierownika sekretariatu lub dostęp dla kierowników i prac. sekretariatu
	 *						false - w przypadku braku uprawnień
	 * 
	 * $access_level - user,all,manager,client lub false(nie zalogowany)
	 */
    function checkIfUserIsAuthorized($session=null)
    {
		if(empty($session['Auth']['Groups'])){
            return false;
        }

		$access_level = 'user';
		
		$group = key($session['Auth']['Groups']);
		if($group == 'superAdmins' || $group == 'm_secretariat' || $group == 'management'){
			$access_level = 'all'; //dostęp dla zarządu, amdina i kierownika sekretariatu
		}
		if($group == 'w_secretariat' ||  
			$group == 'm_it' || 
			$group == 'm_trader' || 
			$group == 'm_marketing'|| 
			$group == 'm_technical'|| 
			$group == 'm_slubowisko'){
			$access_level = 'manager'; //dostep dla kierowników i prac. sekretariatu
		}
		if($group == 'w_trader'){
			$access_level = 'trader'; //dostep dla kierowników i prac. sekretariatu
		}
		if($group == 'client'){
			$access_level = 'client';
		}
		return $access_level;
		
	}
	
	
	/*
	 * Metoda sprawdza czy zalogowany uzytkownik jest kierownikiem/pracownikiem działu handlowego lub ma wieksze uprawnienia
	 * 
	 * @param				$user_id - id użytkownika
	 * 
	 * @return	boolean		true - gdy użytkownik ma uprawnienia
	 *						false - w przypadku braku uprawnień
	 */
    function checkIfUserIsAccountManager($session=null)
    {
		if(empty($session['Auth']['Groups'])){
            return false;
        }

		$access_level = false;
		$group = key($session['Auth']['Groups']);
		if($group == 'superAdmins' || $group == 'm_secretariat' || $group == 'management' || $group == 'm_trader' || $group == 'w_trader'){
			$access_level = true; //dostęp dla zarządu, amdina i kierownika sekretariatu
		}
		
		return $access_level;
		
	}
	
	/*
	 * Funkcja pobiera klientów w zależnościo od uprawnienń
	 *
	 */
	function getClients($archive = 0){
		$session = $this->Session->read();
		$client_model = new Client();
		$acces_level = $this->checkIfUserIsAccountManager($session);
		if($acces_level){
			$clients = $client_model->getAllClients($archive);
		} else {
			$clients = $client_model->getClients($this->Session->read('Auth.User.id'),$archive);
		}
		return $clients;
	}
	
	/**
     * Funkcja sprawdzająca czy user może zobaczyć dany projekt  
     * 
     * @param type $user_id		id usera 
     * @param type $project_id  id projektu 
     * @return type bool		true - może zobaczyć, false - zablokuj
     */
    public function checkUserProjectAccess($project_id, $user_id){
        if(empty($user_id) || empty($project_id)){
            return false;
        }
		$section = new Section();
		$client_project = new ClientProject();
		$client_project_user = new ClientProjectUser();
        
        $params = array();
        $params['conditions'] = array( //warunki zapytania  do tabeli client_project_user , szukamy ze pracownik istnieje w tej bazie (klikniecie on/off kafelka w "zespoł projektowy")
            'ClientProjectUser.client_project_id' => $project_id,
            'ClientProjectUser.user_id' => $user_id
        );
        
        $checkNormalUser = $client_project_user->find('first', $params);	// wyszukuje czy uzytkownik  jest przydzielony do tego projektu  
        
        if(!empty($checkNormalUser)){
            if($checkNormalUser['ClientProjectUser']['replacement_till'] &&  strtotime(date('Y-m-d')) > strtotime($checkNormalUser['ClientProjectUser']['replacement_till'])){
                $client_project_user->delete($checkNormalUser['ClientProjectUser']['id']); //od razu usuwam wpis o dostępie użytkownika
                return false; //jeśli użytkownik ma przydzielony dostęp do projektu ale otrzymał go w ramach zastępstwa to ma ustawioną datę replacement_till i po przekroczeniu tej daty(+2 dni buforu) traci dostęp do projektu
            }
            return true; //jeśli użytkownik jest przydzielony do projektu to zezwalam na wyświetlenie
        } else { //jesli użytkownik nie jest przypisany do projektu to sprawdzam czy ma inne uprawnienia
			//$isCoordinator = $section->checkIsCoordinator($user_id);   // sprawdzenie czy uzytkownik jest koordynatorem    
			$isUserAuthorManager  = $client_project->checkUserAuthorManager($project_id,$user_id);  //  czy uzytkownik jest kierownikiem projektu, autorem projektu czy handlowcem projektu  (pola: user_id, project_author_id, account_manager_id) 
			$session = $this->Session->read();
			$isAuthorizedUser = $this->checkIfUserIsAuthorized($session); //sprawdzam czy użytkownik jest kierownikiem, pracownikiem sekretariatu, zarządem lub adminem
			
			if($isUserAuthorManager || ($isAuthorizedUser == 'all' || $isAuthorizedUser == 'managment' || $isAuthorizedUser == 'trader')){ 
				return true;
			} else {
				return false;
			}
		}
        
    }
    
    /**
     * Funkcja  definiująca rolę  dla modułu GC, 
     * Uwaga: dzięki temu  kolumna role z tabeli users będzie mogła być wyrzucona 
     * @param type $user_id
     * @return boolean
     */
    public function setRoleForGCModule($user_id){
        if(empty($user_id)){
            return false;
        }
        $group = key($this->Session->read('Auth.Groups'));
        if($group =='superAdmins'){  // obsługa  admina jako manager
            $this->Session->write('Auth.User.role', 'manager');
            return;
        }
        $section = new Section();
        $is_manager = $section->checkIsCoordinator($user_id); // sprawdzenie czy jest koordynatorem    

        if($is_manager == true){
            $this->Session->write('Auth.User.role', 'manager');
            return;
        }else if($is_manager == false){

            $is_worker = $this->checkIfUserIsAuthorized($this->Session->read());  // sprawdzenie czy jest pracownikiem 
            
            if($is_worker == false){
                $this->Session->write('Auth.User.role', 'worker');   
                return;
            }else if($is_worker == false && $is_manager == false){
                //if($group == 'client'){
                    $this->Session->write('Auth.User.role', 'client');
                    return;
                //}
            }
        }
        
        $this->Session->write('Auth.User.role', 'client');
        return;
    }
	
    
}

