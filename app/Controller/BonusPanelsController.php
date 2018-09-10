<?php

App::uses('AppController', 'Controller');

/**
 * Calendars Controller
 */
class BonusPanelsController extends AppController
{

    public $components = array('CheckAccess');

    /** Akcja wyświetlająca listę kalendarzy
     * 
     * @return void
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('index',));
    }

    /*
     * lista projektów danego zespołu
     * 
     * działanie:
     * po wejściu na listę bez parametru wyświetlany jest selectbox wyboruzespołu(ten widok mogą wyświetlić tylko zalogowaniu użytkownicy nie będący klientami
     */

    public function index($section_id = null)
    {
        $title = 'Panel premi';
        $subtitle = 'Panel premii';

        $this->loadModel('ClientProject');



        $session = $this->Session->read();
        //@todo sprawdzać czy zalogowany użytkownik jest klientem - on też nie ma dostępu go tego widoku
        if (!isset($session['Auth']['User']['id']))
        {
            throw new NotFoundException(__d('cms', 'Nie masz dostępu do tego zasobu.')); //nie zalogowany nie ma dostępu do wyboru zespołu
        }
        $user_id = $session['Auth']['User']['id'];
        $user_permission = $session['user_permission']; //sprawdzam czy użytkownik należy do sekretariatu, kierowników lub zarzadu

        if ($user_permission == 'user')
        { //projekty użytkownika
            $allProjects = $this->ClientProject->getUserProjectTable($user_id);
        }
        if ($user_permission == 'manager')
        {//projekty do których przypisany jest dział użytkownika
            $session_section_id = $session['Auth']['User']['section_id'];
            $allProjects = $this->ClientProject->getManagerProjectTableBySection($session_section_id);
        }
        if ($user_permission == 'all')
        {//wszystkie projekty
            $allProjects = $this->ClientProject->getAllProjectTable();
        }
        foreach ($allProjects as &$project)
        {
            $project['id_md5'] = md5($project['id']);
        }

        //debug($userProjectList);

        $this->set(compact('title', 'subtitle', 'allProjects'));
    }

    public function bonus($md5 = null)
    {
        $this->layout = 'tv';
        $title = 'Premie';
        $subtitle = 'Premie';


        $this->loadModel('ClientProject');
        $param['conditions']['md5(`ClientProject.id`)'] = $md5;
        $param['fields'] = array('id', 'id');
        $project_id = reset($this->ClientProject->find('list', $param));

        if (!$this->ClientProject->exists($project_id))
        {
            throw new NotFoundException(__d('cms', 'Nie ma takiego projektu.'));
        }
        $this->loadModel('Section');

        $project = $this->ClientProject->getProject($project_id);
        $sections = $this->ClientProject->ClientProjectBudget->getSections($project_id);
        $agreement = $this->ClientProject->ClientProjectShedule->lastAgreement($project_id);
        //przeliczenie procentowe czasu projektu
        $chart['timeProject'] = $this->BonusPanel->timeProject(
                $project['ClientProject']['start_project']
                , $agreement['date_to']
                , $project['ClientProject']['close_realization']
        );
        $chart['profitCost'] = $this->BonusPanel->profitCost($project['ClientProject']['total_costs_sum'], $project['ClientProject']['total_development_costs']);
        $chart['profitButget'] = $this->BonusPanel->profitButget($project['ClientProject']['total_costs_sum'], $project['ClientProject']['total_development_costs'], $project['ClientProject']['total_buffer']);
        $this->set(compact('title', 'subtitle', 'section_id', 'project', 'sections', 'chart'));
    }

    public function add_bonus()
    {
        $title = 'Premie';
        $subtitle = 'Premie - dodaj premie';

        $this->set(compact('title', 'subtitle'));
    }

}
