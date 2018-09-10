<?php

App::uses('AppModel', 'Model');

/**
 * ClientProjectNote Model
 *
 * @property Client $Client
 * @property User $User
 */
class ClientProjectNote extends AppModel
{

    /**
     * Pole inicjalizujące Behaviory
     *
     * @var array
     */
    public $actsAs = array();

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ClientProject' => array(
            'className' => 'ClientProject',
            'foreignKey' => 'project_id',
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
        //$this->virtualFields = array('fullname' => "CONCAT({$this->alias}.field_1, ' ', {$this->alias}.field_2)");
    }

    /**
     * Pobranie notatek przypisanych do danego projektu 
     * 
     * @param string $project_id   ID projekt
     * 
     * @return mixed            array Notatki
     *                          false w przypadku błędu
     */
    function getProjectNotes($project_id = null)
    {
        if (empty($project_id))
        {
            return false;
        }

        $toReturn = $this->find('all', array(
            'conditions' => array(
                'ClientProjectNote.project_id' => $project_id,
            ),
            'order' => 'ClientProjectNote.created desc',
            'recursive' => 0
        ));

        return empty($toReturn) ? false : $toReturn;
    }
	
    /**
     * Pobranie notatek przypisanych do danego projektu i widocznych dla klienta
     * 
     * @param string $project_id   ID projekt
     * 
     * @return mixed            array Notatki
     *                          false w przypadku błędu
     */
    function getClientProjectNotes($project_id = null)
    {
        if (empty($project_id))
        {
            return false;
        }

        $toReturn = $this->find('all', array(
            'conditions' => array(
                'ClientProjectNote.project_id' => $project_id,
                'ClientProjectNote.client_access' => 1,
            ),
            'order' => 'ClientProjectNote.created desc',
            'recursive' => 0
        ));

        return empty($toReturn) ? false : $toReturn;
    }

    /**
     * Pobranie notatek przypisanych do danego projektu i nalezącą sekcją
     * 
     * @param string $project_id   ID projekt
     * 
     * @return mixed            array Notatki
     *                          false w przypadku błędu
     */
    function getProjectNotesSection($project_id = null)
    {
        if (empty($project_id))
        {
            return false;
        }

        $params = array(
            'conditions' => array(
                'ClientProjectNote.project_id' => $project_id,
            ),
            'order' => 'ClientProjectNote.created desc',
            'recursive' => 0
        );
        $params['joins'] = array(
            array('table' => 'user_sections',
                'alias' => 'UserSection',
                'type' => 'Left',
                'conditions' => array(
                    'ClientProjectNote.user_id = UserSection.user_id'
                )
            ),
            array('table' => 'profiles',
                'alias' => 'Profile',
                'type' => 'Left',
                'conditions' => array(
                    'ClientProjectNote.user_id = Profile.user_id'
                )
            )
        );
        $params['fields'] = array('Profile.firstname','Profile.surname','ClientProjectNote.*','Client.*','ClientProject.*','User.*','UserSection.section_id');
        $toReturn = $this->find('all', $params);
        return empty($toReturn) ? false : $toReturn;
    }

    /**
     * Dodawanie notatki do projektu
     * 
     * @param array $note   Notatka wraz z project_id, user_id i client_id
     * 
     * @return mixed        array Zapisana notatka
     *                      false w przypadku błędu
     */
    function addClientProjectNote($note = array())
    {
        if (empty($note))
        {
            return false;
        }

        if (empty($note['ClientProjectNote']['client_id']) || empty($note['ClientProjectNote']['project_id']) || empty($note['ClientProjectNote']['user_id']) ||
                empty($note['ClientProjectNote']['content']))
        {
            return false;
        }
        $this->create();
        return $this->save($note);
    }

    function changeClientAccesToNote($note_id = null, $visible = 0)
    {
        if (empty($note_id))
        {
            return false;
        }

        if ($visible == 'true')
        {
            $visible = 1;
        } else
        {
            $visible = 0;
        }

        $this->id = $note_id;
        $note['ClientProjectNote']['id'] = $note_id;
        $note['ClientProjectNote']['client_access'] = $visible;
        return $this->save($note);
    }

}
