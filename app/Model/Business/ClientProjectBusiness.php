<?php

App::uses('AppModel', 'Model');

/**
 * ClientProject Model
 *
 * @property ClientLead $ClientLead
 * @property User $User
 */
class ClientProjectBusiness extends AppModel
{

    public $useTable = false;
   
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
        $this->ClientProjectBudget = ClassRegistry::init('ClientProjectBudget');
    }
    
    /*
     * metoda przygotosuje tablicę budżetów i pozycji budżetowych dla projektu
     * 
     * @param int $project_id		id projektu
     */

    public function prepare_project_budget($project_id = null)
    {
        if (empty($project_id))
        {
            return array();
        }

        $clientProjectBudget_query = $this->ClientProjectBudget->getAllProjectBudget($project_id);

        $clientProjectBudget = array();
        if ($clientProjectBudget_query)
        {
            foreach ($clientProjectBudget_query as $key => $pb)
            { //dostosowuję tablicę do tej w widoku
                $clientProjectBudget[$pb['ClientProjectBudget']['section_id']]['section'] = $pb['ClientProjectBudget'];
                $clientProjectBudget[$pb['ClientProjectBudget']['section_id']]['payments'] = $pb['ClientProjectBudgetPosition'];
            }
        }

        return $clientProjectBudget;
    }
}

