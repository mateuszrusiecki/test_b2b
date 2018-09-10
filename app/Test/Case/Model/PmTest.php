<?php

/* Pm Test cases generated on: 2015-02-25 09:16:54 : 1424852214 */
App::uses('Pm', 'Model');
App::import('Vendor', 'redmine_api', array('file' => 'redmine_api' . DS . 'autoload.php'));
/**
 * Pm Test Case
 *
 */
class PmTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array('app.pm');

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Pm = ClassRegistry::init('Pm');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pm);

        parent::tearDown();
    }

    /**
     * testGetConnection method
     *
     * @return void
     */
    public function testGetConnection()
    {
        $login = 'm.rudzik';
        $password = 'akhjkKHJhui1i189!!';
        $return = $this->Pm->getConnection($login, $password);
        $this->assertEquals(is_object($return), true, 'Prawidłowy login i hasło, zwraca obiekt Redmina/Client');
        $this->assertEquals(is_array($this->Pm->getCurrentUser($return)), true, 'Prawidłowy login i hasło, zwraca tablicę danych zalogowanego użytkownika');

        $login = 'm.rudzik9999';
        $password = 'abc';
        $return = $this->Pm->getConnection($login, $password);
        $this->assertEquals($this->Pm->getCurrentUser($return), false, 'Nieprawidłowy login i hasło');

        $return = $this->Pm->getConnection();
        $this->assertEquals($return, false, 'Brak danych');
    }

    /**
     * testGetIssue method
     *
     * @return void
     */
    public function testGetIssue()
    {
        $login = 'm.rudzik';
        $password = 'akhjkKHJhui1i189!!';
        $con = $this->Pm->getConnection($login, $password);
        $return = $this->Pm->getIssues($con);
        $this->assertEquals(isset($return['issues']), true, 'Wszystkie zadania widoczne przez użytkownika');

        $login = 'm.rudzik9';
        $password = '8888888!!';
        $con = $this->Pm->getConnection($login, $password);
        $return = $this->Pm->getIssues($con);
        $this->assertEquals($return, false, 'Nie poprawne dane logowania');

        $connection = $this->Pm->getConnection();
        $return = $this->Pm->getIssues($connection);
        $this->assertEquals($return, false, 'Brak danych logowania');
    }

    /**
     * testGetCurrentUser method
     *
     * @return void
     */
    public function testGetCurrentUser()
    {

        $login = 'm.rudzik';
        $password = 'akhjkKHJhui1i189!!';
        $con = $this->Pm->getConnection($login, $password);
        $return = $this->Pm->getCurrentUser($con);
        $this->assertEquals(isset($return['user']), true, 'Prawidłowe dane');

        $login = '9999';
        $password = '9999!!';
        $con = $this->Pm->getConnection($login, $password);
        $return = $this->Pm->getCurrentUser($con);
        $this->assertEquals($return, false, 'Nieprawidłowe dane');

        $con = $this->Pm->getConnection();
        $return = $this->Pm->getCurrentUser($con);
        $this->assertEquals($return, false, 'Brak danych');
    }

    /**
     * testGetIssuesAssignedTo method
     *
     * @return void
     */
    public function testGetIssuesAssignedTo()
    {

        $login = 'm.rudzik';
        $password = 'akhjkKHJhui1i189!!';
        $con = $this->Pm->getConnection($login, $password);
        $user_id = $this->Pm->getCurrentUser($con);
        $return = $this->Pm->getIssuesAssignedTo($con, $user_id);
        $this->assertEquals(isset($return['issues']), true, 'Zadania przypisane do użytkownika');

        $login = 'm.rudzik';
        $password = 'akhjkKHJhui1i189!!';
        $con = $this->Pm->getConnection($login, $password);
        $return = $this->Pm->getIssuesAssignedTo($con);
        $this->assertEquals($return, false, 'Brak id użytkownika');

        $con = $this->Pm->getConnection();
        $user_id = 0;
        $return = $this->Pm->getIssuesAssignedTo($con, $user_id);
        $this->assertEquals($return, false, 'Brak danych');
    }

    /**
     * testGetIssuesReported method
     *
     * @return void
     */
    public function testGetIssuesReported()
    {

        $login = 'm.rudzik';
        $password = 'akhjkKHJhui1i189!!';
        $con = $this->Pm->getConnection($login, $password);
        $user_id = $this->Pm->getCurrentUser($con);
        $return = $this->Pm->getIssuesReported($con, $user_id);
        $this->assertEquals(isset($return['issues']), true, 'Zadania zgłoszone użytkownika');

        $login = 'm.rudzik';
        $password = 'akhjkKHJhui1i189!!';
        $con = $this->Pm->getConnection($login, $password);
        $return = $this->Pm->getIssuesReported($con);
        $this->assertEquals($return, false, 'Brak id użytkownika');

        $con = $this->Pm->getConnection();
        $user_id = 0;
        $return = $this->Pm->getIssuesReported($con, $user_id);
        $this->assertEquals($return, false, 'Brak danych');
    }

    /**
     * testGetProject method
     *
     * @return void
     */
    public function testGetProject()
    {

        $login = 'm.rudzik';
        $password = 'akhjkKHJhui1i189!!';
        $con = $this->Pm->getConnection($login, $password);
        $return = $this->Pm->getProjects($con);
        $this->assertEquals(is_array($return), true, 'Wszystkie projekty widoczne przez użytkownika');

        $con = $this->Pm->getConnection();
        $return = $this->Pm->getProjects($con);
        $this->assertEquals($return, false, 'Brak danych logowania');

        $login = 'm.rudzik9';
        $password = '8888888!!';
        $con = $this->Pm->getConnection($login, $password);
        $return = $this->Pm->getProjects($con);
        $this->assertEquals($return, false, 'Nie poprawne dane logowania');
    }

}
