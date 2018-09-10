<?php

/* Section Test cases generated on: 2015-02-17 08:36:05 : 1424158565 */
App::uses('Section', 'Model');

/**
 * Section Test Case
 *
 */
class SectionTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array('app.section', 'app.userUser', 'app.user_section', 'app.profile');

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Section = ClassRegistry::init('Section');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Section);

        parent::tearDown();
    }
    
    public function testBeforeValidate()
    {
        $return = $this->Section->beforeValidate();
    }

    /**
     * Wyszukuje przełożonego po user_id pracownika
     * 
     * @param char $user_id
     * @return type array
     * @return type bool 
     */
    public function testFindSupervisorByUser()
    {
            
        $user_id = '';
        $return = $this->Section->findSupervisorByUser($user_id);
        $this->assertEquals($return, false, 'przepuszcza pusty parametr');

        $user_id = null;
        $return = $this->Section->findSupervisorByUser($user_id);
        $this->assertEquals($return, false, 'przepuszcza null');

        $user_id = '';
        $return = $this->Section->findSupervisorByUser($user_id);
        $this->assertEquals($return, false, 'przepuszcza null');

        $user_id = '3';
        $return = $this->Section->findSupervisorByUser($user_id);
        $this->assertEquals($return, false, 'przepuszcza nieznane id');
    // koordynator
        $user_id = '552cc3b6-2908-4124-84f2-0b3077ecc6b3';
        $return = $this->Section->findSupervisorByUser($user_id);
        $this->assertEquals(is_array($return), true, 'sprawdza supervizora');
        $this->assertEquals(is_array($return['Section']), true, 'sprawdza supervizora');
            //pracownik
        $user_id = '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3'; // wypelniony 
        $return = $this->Section->findSupervisorByUser($user_id);
        $this->assertEquals(is_array($return), true, 'nie znajduje przełożonego');
        $this->assertEquals(count($return) == 1, true, 'zwraca nieprawidłową liczbę wyników');

        //prezes
        $user_id = '552cc2f7-6540-43ed-8b29-0b3077ecc6b3';
        $return = $this->Section->findSupervisorByUser($user_id);
        $this->assertEquals($return, false, 'ma byc false bo to prezes');
    }

    public function testCheckIsCoordinator()
    {

        $user_id = '';
        $return = $this->Section->checkIsCoordinator($user_id);
        $this->assertEquals($return, false, 'pusty paramter');

        $user_id = null;
        $return = $this->Section->checkIsCoordinator($user_id);
        $this->assertEquals($return, false, 'parametr null');

        $user_id = '54eecb9c-00d8-42aa-bd07-05f5904cf98e';
        $return = $this->Section->checkIsCoordinator($user_id);
        $this->assertEquals($return, true, 'jest koordynatorem');

        $user_id = '';
        $return = $this->Section->checkIsCoordinator($user_id);
        $this->assertEquals($return, false, 'nie jest koordynatorem');

        $return = $this->Section->checkIsCoordinator();
        $this->assertEquals($return, false, 'brak parametru');
    }

    public function testGetNormalUserSupervisor()
    {

        $user_id = '';
        $return = $this->Section->getNormalUserSupervisor($user_id);
        $this->assertEquals($return, false, 'pusty paramter');

        $user_id = null;
        $return = $this->Section->getNormalUserSupervisor($user_id);
        $this->assertEquals($return, false, 'parametr null');

        $user_id = '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3';
        $return = $this->Section->getNormalUserSupervisor($user_id);
        $this->assertEquals(is_array($return), true, 'nie zwraca przelozonego');
    }

    public function testGetUserBySection()
    {
        $section_id = '';
        $return = $this->Section->getUserBySection($section_id);
        $this->assertEquals($return, false, 'pusty parametr');

        $section_id = null;
        $return = $this->Section->getUserBySection($section_id);
        $this->assertEquals($return, false, 'paramter null');


//            $return  = $this->Section->getUserBySection();
//            $this->assertEquals($return,false,'brak parametru');

        $section_id = '3';
        $return = $this->Section->getUserBySection($section_id);
        $this->assertEquals(is_array($return), true, 'prawidlowe dane');
    }

    public function testCheckUserIsCEO()
    {
        $user_id = '';
        $return = $this->Section->checkUserIsCEO($user_id);
        $this->assertEquals($return, false, 'pusty parametr');

        $user_id = null;
        $return = $this->Section->checkUserIsCEO($user_id);
        $this->assertEquals($return, false, 'parametr null');

//            $return  = $this->Section->checkUserIsCEO();
//            $this->assertEquals($return,false,'brak parametru');

        $user_id = '';
        $return = $this->Section->checkUserIsCEO($user_id);
        $this->assertEquals($return, false, 'pusty parametr');
        
        $user_id = '23423';
        $return = $this->Section->checkUserIsCEO($user_id);
        $this->assertEquals($return, false, 'pusty parametr');

        $user_id = '552cc2f7-6540-43ed-8b29-0b3077ecc6b3';
        $return = $this->Section->checkUserIsCEO($user_id);
        $this->assertEquals($return, true, 'pusty parametr');
    }

    public function testGetSupervisorCoordintor()
    {

        $user_id = '';
        $return = $this->Section->getSupervisorCoordintor($user_id);
        $this->assertEquals($return, false, 'pusty parametr');

        $user_id = null;
        $return = $this->Section->getSupervisorCoordintor($user_id);
        $this->assertEquals($return, false, 'parametr null');

//            $return  = $this->Section->getSupervisorCoordinator();
//            $this->assertEquals($return,false,'brak parametru');

        $user_id = '54eecb9c-00d8-42aa-bd07-05f5904cf98e';
        $return = $this->Section->getSupervisorCoordintor($user_id);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');
    }

    public function testGetCEOId()
    {

        $return = $this->Section->getCEOId();
        $this->assertEquals(empty($return), false, 'nie zwraca id szefa');
    }

    public function testGetSectionsBoss()
    {
        $return = $this->Section->getSectionsBoss();
        $this->assertEquals(is_array($return), true, 'nie zwraca listy szefów działów');
    }

    public function testGetMerchants()
    {

        $return = $this->Section->getMerchants();
        $this->assertEquals(is_array($return), true, 'nie zwraca danych');
    }

    public function testFindWithoutUserList()
    {

        $return = $this->Section->findWithoutUserList();
        $this->assertEquals(is_array($return), true, 'nie zwraca danych');
        $params['conditions']['supervisor'] = 12343;
        $return = $this->Section->findWithoutUserList($params);
        $this->assertEquals($return, false, 'nie zwraca danych');
    }

    public function testGetProjectBudgetCostsUneditableSectionList()
    {

        $return = $this->Section->getProjectBudgetCostsUneditableSectionList();
        $this->assertEquals(is_array($return), true, 'zwraca danych');
        
        $params['conditions']['supervisor'] = 12343;
        $return = $this->Section->getProjectBudgetCostsUneditableSectionList($params);
        $this->assertEquals($return, false, 'nie zwraca danych');
    }

    public function testListUserGroupSection()
    {
        $return = $this->Section->listUserGroupSection();
        $this->assertEquals(is_array($return), true, 'nie zwraca danych');
    }

    public function testGetTileBySection()
    {

        $section_id = '';
        $return = $this->Section->getTileBySection($section_id);
        $this->assertEquals($return, false, 'pusty parametr');

        $section_id = null;
        $return = $this->Section->getTileBySection($section_id);
        $this->assertEquals($return, false, 'parametr null');

        $section_id = '3';
        $return = $this->Section->getTileBySection($section_id);
        $this->assertEquals(is_array($return), true, 'nie zwraca danych');
    }

}
