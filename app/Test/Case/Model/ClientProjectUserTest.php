<?php

App::uses('ClientProjectUser', 'Model');

/**
 * ClientProjectUser Test Case
 *
 */
class ClientProjectUserTest extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.client_project_user'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->ClientProjectUser = ClassRegistry::init('ClientProjectUser');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientProjectUser);

        parent::tearDown();
    }
    
    /**
     * Dostęp przyznany
     */
    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }
    
//    public function testCheckUserProjectAccessGranted()
//    {
//        $this->checkUserProjectAccess();
//    }
    
    /**
     * Dostęp odrzucony
     */
    public function testCheckUserProjectAccessDenied()
    {

        $return = $this->ClientProjectUser->checkUserProjectAccess(FALSE, 'asd');
        $this->assertEquals(false, $return, 'brak danych wejściowych');

        $return = $this->ClientProjectUser->checkUserProjectAccess('asd', FALSE);
        $this->assertEquals(false, $return, 'brak danych wejściowych');
    }
}

//$user_id = '54ca02f7-5ce0-45d6-b179-173477ecc6b3';
//        $return = $this->Profile->getProfile($user_id);
//        $this->assertEquals(is_array($return), true, 'Czy jest to tablica?');
//
//        $user_id = 'string';
//        $return = $this->Profile->getProfile($user_id);
//        $this->assertEquals($return, false, 'sprawdza id uzytkownika');
//
//        $user_id = '';
//        $return = $this->Profile->getProfile($user_id);
//        $this->assertEquals($return, false, 'sprawdza id uzytkownika');
//
//        foreach ($this->Profile->fields as $field)
//        {
//            $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
//            $return = $this->Profile->getProfile($user_id);
//            $this->assertEquals(isset($return['Profile'][$field]) || is_null($return['Profile'][$field]) , true, "sprawdza czy jest $field w fields");
//        }
//
//        foreach ($this->Profile->fieldsTmp as $field)
//        {
//            $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
//            $return = $this->Profile->getProfile($user_id);
//            $this->assertEquals(isset($return['Profile'][$field]), false, "sprawdza czy nie ma $field w fields");
//        }
//        
//        public function checkUserProjectAccess($project_id, $user_id){
//        if(empty($user_id) || empty($project_id)){
//            return false;
//        }
//        $this->Section = ClassRegistry::init('Section');
//        $this->ClientProject = ClassRegistry::init('ClientProject');
//        
//        $params = array();
//        $params['conditions'] = array(
//            'client_project_id' => $project_id,
//            'user_id' => $user_id
//        );
//        
//        $checkNormalUser = $this->find('first', $params);    
//        
//        if(!empty($checkNormalUser)){
//           $checkNormalUser = true;
//        }
//        
//        $isCoordinator = $this->Section->checkIsCoordinator($user_id);
//        $isCEO =  $this->Section->checkUserIsCEO($user_id);
//        $isUserAuthorManager  = $this->ClientProject->checkUserAuthorManager($project_id,$user_id);
//		
//        // to do sprawdzić  czy jest osoba z sekretariatu i z zarządu 
//        
//        if(in_array(true, array($checkNormalUser,$isCoordinator,$isCEO,$isUserAuthorManager))){
//            return true;
//        }else{
//            return false;
//        }
//        