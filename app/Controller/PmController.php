<?php

App::uses('AppController', 'Controller');
//require_once '../Vendor/redmine_api/autoload.php';
App::import('Vendor', 'redmine_api', array('file' => 'redmine_api' . DS . 'autoload.php'));

/**
 * Vacations Controller
 *
 * @property Vacation $Vacation
 */
class PmController extends AppController
{

    /**
     * Nazwa layoutu
     */
    public $layout = 'default';

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array('Metronic', 'Html');

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array(); //Slug.Slug

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('pm_ajax'));
    }

    /**
     * Akcja wyświetlająca zakładkę pm
     * 
     * @return void
     */
    public function index()
    {
        $title = "Mój PM";
        $subtitle = "Mój PM";

        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];
        $this->helpers[] = 'FebTime';

        $this->loadModel('Profile');
        $user = $this->Profile->User->getUser($user_id);
        $profile = $this->Profile->getProfile($user_id);

        if ($user['User']['pm_user'] && $user['User']['pm_password'])
        {
            $pm                 = $this->Pm->getConnection($user['User']['pm_user'], $user['User']['pm_password']);
            $issues             = $this->Pm->getIssues($pm);
            $user_id            = $this->Pm->getCurrentUser($pm);
            $issuesAssignedTo   = $this->Pm->getIssuesAssignedTo($pm, $user_id); //przypisane do mnie 
            $issuesReported     = $this->Pm->getIssuesReported($pm, $user_id); //zgłoszone przeze mnie 
            $projects           = $this->Pm->getProjects($pm);

            $this->set(compact('projects', 'issues', 'issuesAssignedTo', 'issuesReported'));
            $this->set('login_to_pm', false);
        } else
        {
            $this->set('login_to_pm', true);
        }

        $this->set(compact('title', 'subtitle', 'profile', 'user'));
    }

    /**
     * Akcja logowania do pm
     * 
     * @return void
     */
    public function login()
    {
        if (!empty($this->data))
        {
            $session = $this->Session->read();
            $user_id = $session['Auth']['User']['id'];

            $login = isset($this->data['PM']['login']) ? $this->data['PM']['login'] : '';
            $pass = isset($this->data['PM']['password']) ? $this->data['PM']['password'] : '';
            
            $pm     = $this->Pm->getConnection($login, $pass);
            $user   = $this->Pm->getCurrentUser($pm);
            
            if (!empty($user['user']))
            { //jeśli na przesłane dane udało zalogować się do pm
                $this->loadModel('Profile');

                if ($this->Profile->User->savePmCredentials($user_id, $login, $pass))
                {
                    //zapisanie danym pm do sesji - potrzebne do grindstona
                    $_SESSION['Auth']['User']['pm_user'] = $login;
                    $_SESSION['Auth']['User']['pm_password'] = $pass;
                    $this->Session->setFlash(__d('public', 'Zalogowano poprawnie.'), 'default', array('class' => 'note note-success'));
                } else
                {
                    $this->Session->setFlash(__d('public', 'Niepoprawne dane logowania.'), 'default', array('class' => 'note note-danger'));
                }
            } else
            {
                $this->Session->setFlash(__d('public', 'Niepoprawny login lub hasło.'), 'default', array('class' => 'note note-danger'));
            }
        }
        $this->redirect($this->referer());
        //$this->redirect(array('action' => 'index'));
    }

    /**
     * Akcja wylogowania z pm
     * 
     * @return void
     */
    public function logout()
    {
        $session = $this->Session->read();
        $user_id = $session['Auth']['User']['id'];

        if ($user_id)
        {
            $this->loadModel('Profile');
            $user = $this->Profile->User->getUser($user_id);
        } else
        {
            $user = array();
        }

        if ($user['User']['pm_user'] && $user['User']['pm_password'])
        {
            if ($this->Profile->User->savePmCredentials($user_id, ' ', ' '))
            {
                $_SESSION['Auth']['User']['pm_user'] = null;
                $_SESSION['Auth']['User']['pm_password'] = null;
                $this->Session->setFlash(__d('public', 'Zostałeś wylogowany. Aby w pełni korzystać z systemu zaloguj się ponownie.'), 'default', array('class' => 'note note-success'));
            } else
            {
                $this->Session->setFlash(__d('public', 'Niepoprawne dane.'), 'default', array('class' => 'note note-danger'));
            }
        }

        $this->redirect($this->referer());
    }

		public function pm_ajax(){
			$session = $this->Session->read();
			$user = $session['Auth']['User'];

			if ($user['pm_user'] && $user['pm_password']) {
				//$pm = new Redmine\Client('http://pm.feb.net.pl', 'm.rusiecki','Startowe13');
				$pm = new Redmine\Client(Configure::read('App.PMUrl'), $user['pm_user'], $user['pm_password']);
				$issues = $pm->api('issue')->all(array('limit' => 10)); //wszystkie dostępne

				$pm_user_id = $pm->api('user')->getCurrentUser();
				$issuesAssignedTo = $pm->api('issue')->all(array('assigned_to_id' => $pm_user_id['user']['id'], 'limit' => 10)); //przypisane do mnie
				$issuesReported = $pm->api('issue')->all(array('author_id' => $pm_user_id['user']['id'], 'limit' => 10)); //zgłoszone przeze mnie

				$projects_tmp = $pm->api('project')->listing();
				ksort($projects_tmp);
				$projects = array_flip($projects_tmp);
				$projects['0'] = 'Skocz do projektu...';
				//

				$data['projects'] = $projects;
				$data['issues'] = $issues;
				$data['issuesAssignedTo'] = $issuesAssignedTo;
				$data['issuesReported'] = $issuesReported;
				$data['login_to_pm'] = false;
				
				$this->set('data', $data);
				$this->set('_serialize', array('data'));
				$this->render(false);
			} else {
				$data['login_to_pm'] = true;
				
				$this->set('data', $data);
				$this->set('_serialize', array('data'));
				$this->render(false);
			}
		}
}
