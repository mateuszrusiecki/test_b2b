<?php

/* Profile Test cases generated on: 2015-01-26 13:16:53 : 1422274613 */
App::uses('Profile', 'Model');

/**
 * Profile Test Case
 *
 */
class ProfileTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.profile',
        'app.country',
        'app.userUser',
        'app.user_contract_history',
        'core.translate',
            //'app.i18n'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Profile = ClassRegistry::init('Profile');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Profile);

        parent::tearDown();
    }

    public function testGetProfile()
    {
        $user_id = '54ca02f7-5ce0-45d6-b179-173477ecc6b3';
        $return = $this->Profile->getProfile($user_id);
        $this->assertEquals(is_array($return), true, 'Czy jest to tablica?');

        $user_id = 'string';
        $return = $this->Profile->getProfile($user_id);
        $this->assertEquals($return, false, 'sprawdza id uzytkownika');

        $user_id = '';
        $return = $this->Profile->getProfile($user_id);
        $this->assertEquals($return, false, 'sprawdza id uzytkownika');

        foreach ($this->Profile->fields as $field)
        {
            $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
            $return = $this->Profile->getProfile($user_id);
            $this->assertEquals(isset($return['Profile'][$field]) || is_null($return['Profile'][$field]) , true, "sprawdza czy jest $field w fields");
        }

        foreach ($this->Profile->fieldsTmp as $field)
        {
            $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
            $return = $this->Profile->getProfile($user_id);
            $this->assertEquals(isset($return['Profile'][$field]), false, "sprawdza czy nie ma $field w fields");
        }
    }

    public function testSetProfile()
    {
        $fieldsTmp = $this->Profile->fieldsTmp;
        $fields = $this->Profile->fields;
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $profile['Profile'] = array_flip($fieldsTmp);
        $profile['Profile']['different_address'] = 1;
        $return = $this->Profile->setProfile($user_id, $profile);
        $this->assertEquals($return, true, 'Czy jest ok');

        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $profile['Profile'] = array_flip($fields);
        $return = $this->Profile->setProfile($user_id, $profile);
        $this->assertEquals($return, false, 'Sprawdza czy nie zapisuje danych których nie moze');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $profile = array();
        $return = $this->Profile->setProfile($user_id, $profile);
        $this->assertEquals($return, false, 'Sprawdza czy jest walidacja');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $profile = '';
        $return = $this->Profile->setProfile($user_id, $profile);
        $this->assertEquals($return, false, 'Sprawdza czy jest walidacja');

        $user_id = null;
        $profile = null;
        $return = $this->Profile->setProfile($user_id, $profile);
        $this->assertEquals($return, false, 'Sprawdza czy jest walidacja');


        $return = $this->Profile->setProfile();
        $this->assertEquals($return, false, 'Sprawdza czy jest walidacja');

        $user_id = 'string';
        $profile = $fieldsTmp;
        $return = $this->Profile->setProfile($user_id, $profile);
        $this->assertEquals($return, false, 'sprawdza id uzytkownika');

        $user_id = '';
        $profile = $fieldsTmp;
        $return = $this->Profile->setProfile($user_id, $profile);
        $this->assertEquals($return, false, 'sprawdza id uzytkownika');
    }

    public function testCheckTmpProfile()
    {
        $return = $this->Profile->checkTmpProfile();
        $this->assertEquals($return, false, 'brak id uzytkownika');

        $user_id = '';
        $return = $this->Profile->checkTmpProfile($user_id);
        $this->assertEquals($return, false, 'puste id uzytkownika');

//        $user_id = '54c1f918-f2d4-428c-b5e9-0aa077ecc6b3';
//        $return = $this->Profile->checkTmpProfile($user_id);
//        $this->assertEquals($return, false, 'użytkownika który nie ma zmian');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $return = $this->Profile->checkTmpProfile($user_id);
        $this->assertEquals($return, true, 'użytkownik ma zmiany w bazie');
    }

    
    public function testListProfiles()
    {
        $return = $this->Profile->listProfiles();
        $this->assertEquals(is_array($return), true, 'Sprawdzam czy zwraca tabele');
        $this->assertEquals(is_string(reset($return)), true, 'Sprawdzam czy zwraca klucz jako string');
        
    }
    
    
    public function testGetProfileForCard(){
        
        $user_id = '';
        $return = $this->Profile->getProfileForCard($user_id);
        $this->assertEquals($return, false, 'puste id uzytkownika');

        $user_id = null;
        $return = $this->Profile->getProfileForCard($user_id);
        $this->assertEquals($return, false, 'parametr null');

        $user_id = '54ca02f7-5ce0-45d6-b179-173477ecc6b3';
        $return = $this->Profile->getProfileForCard($user_id);
        $this->assertEquals(is_array($return),true, 'funkcja nie zwraca danych');
        
    }
    
    public function testGetProfiles(){
        $return = $this->Profile->getProfiles();
        $this->assertEquals(is_array($return),true,'funkcja nie zwraca danych');
    }
    
    
    public function testGetFielsChangedByUser(){
        
//        $profile = '';
//        $return = $this->Profile->getFieldsChangedByUser($profile);
//        $this->assertEquals(empty($return), true, 'pusty parametr');
//        
//        $profile = null;
//        $return = $this->Profile->getFieldsChangedByUser($profile);
//        $this->assertEquals(empty($return), true, 'null');
        
//        $profile = 11;
//        $return = $this->Profile->getFieldsChangedByUser($profile);
//        debug($return);
//        $this->assertEquals(is_array($return), true, 'nie zwraca edytowanych pol');
//        $this->assertEquals(!empty($return), true, 'nie zwraca edytowanych pol');
        
    }
    
    public function testUpdateUserChanges(){
        
//        $profile = '';
//        $return = $this->Profile->updateUserChanges($profile);
//        $this->assertEquals($return, false, 'pusty parametr');
//        
//        $profile = null;
//        $return = $this->Profile->updateUserChanges($profile);
//        $this->assertEquals($return, false, 'null');
//        
//        $profile = '11';
//        $return = $this->Profile->updateUserChanges($profile);
//        $this->assertEquals(is_array($return), true, 'prawidłowe dane');
//        
//        
        
    }
    
    

}
