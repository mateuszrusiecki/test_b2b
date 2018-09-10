<?php

App::uses('AppModel', 'Model');

/**
 * Pm Model
 *
 * @package b2b
 * @property User $User
 */
class Pm extends AppModel
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
    public $displayField = '';

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array();

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
     * Połączenie z PM
     * 
     * @params string $login    Login użytkownika
     * @params string $password Hasło użytkownika
     * 
     * @return mixed            Połączenie z PM
     *                       false w przypadku błędu
     */
    function getConnection($login = null, $password = null)
    {
        if (!($login && $password))
        {
            return false;
        }

        return new Redmine\Client('https://pm.feb.net.pl:8444', $login, $password);
    }

    /**
     * Pobranie issues
     * 
     * @param object $pm    Połączenie z PM
     * @return array        Issues
     */
    function getIssues($pm = null)
    {
        if (!$pm)
        {
            return false;
        }

        $issues = @$pm->api('issue')->all(array('limit' => 10)); //wszystkie dostępne	

        return reset($issues) == 1 ? false : $issues;
    }

    /**
     * Pobranie aktywnego użytkownika
     * 
     * @param object $pm    Połączenie z PM
     * @return mixed        Aktywny użytkownik
     */
    function getCurrentUser($pm = null)
    {
        if (!$pm)
        {
            return false;
        }

        $user = @$pm->api('user')->getCurrentUser();

        return is_array($user) ? $user : false;
    }

    /**
     * Pobranie zadań przypisanych do usera
     * 
     * @param object $pm            Połączenie z PM
     * @param array $user_id        User
     * @return mixed                Zadania przypisane do usera 
     */
    function getIssuesAssignedTo($pm = null, $user_id = array())
    {
        if (!$pm || empty($user_id))
        {
            return false;
        }

        return @$pm->api('issue')->all(array('assigned_to_id' => $user_id['user']['id'], 'limit' => 10));
    }

    /**
     * Pobranie zadań stworzonych przez usera
     * 
     * @param object $pm        Połączenie z PM
     * @param array $user_id    User
     * @return mixed            Zadania stworzone przez usera
     *                          false w przypadku błedu
     */
    function getIssuesReported($pm = null, $user_id = array())
    {
        if (!$pm || empty($user_id))
        {
            return false;
        }

        return @$pm->api('issue')->all(array('author_id' => $user_id['user']['id'], 'limit' => 10));
    }

    /**
     * Pobranie projektów przypisanych do użytkownika
     * @param object $pm    Połączenie z PM
     * @return mixed        array Projekty
     *                      false w przypadku błędu
     */
    function getProjects($pm = null)
    {
        if (!$pm)
        {
            return false;
        }

        if (!$this->getCurrentUser($pm))
        {
            return false;
        }

        $projects = $pm->api('project')->listing();
        $projects = array_flip($projects);
        $projects['0'] = 'Skocz do projektu...';
        ksort($projects);

        return $projects;
    }

}
