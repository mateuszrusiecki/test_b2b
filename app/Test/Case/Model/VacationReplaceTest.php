<?php

/* VacationReplace Test cases generated on: 2015-02-03 08:11:32 : 1422947492 */
App::uses('VacationReplace', 'Model');

/**
 * VacationReplace Test Case
 *
 */
class VacationReplaceTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.vacation_replace',
        'app.vacation',
        'app.vacation_type',
        'app.vacation_status',
        'app.userUser'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->VacationReplace = ClassRegistry::init('VacationReplace');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VacationReplace);

        parent::tearDown();
    }

    /**
     * testListVacationProfile method
     *
     * @return void
     */
    public function testListVacationProfile()
    {
        $return = $this->VacationReplace->listVacationProfile();
        $this->assertEquals($return, false, 'brak danych do oczytu');

        $vacation_id = '1';
        $return = $this->VacationReplace->listVacationProfile($vacation_id);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');

        $vacation_id = '1';
        $return = $this->VacationReplace->listVacationProfile($vacation_id);
        $this->assertEquals(is_array($return[0]['VacationReplace']), true, 'prawidłowe dane');

        $vacation_id = '-1';
        $return = $this->VacationReplace->listVacationProfile($vacation_id);
        $this->assertEquals($return, false, 'nieprawidłowe id');
    }
    
    public function testBeforeValidate(){
        $this->VacationReplace->beforeValidate();
    }
    
    public function testSaveVacationReplace(){
        $data = array(
            'vacation_id' => 2,
            'project_id' => 0,
        );
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $return = $this->VacationReplace->saveVacationReplace($user_id,$data);
        $this->assertEquals($return, true, 'prawidłowe dane, brak project_id');
        
        $data = array(
            'vacation_id' => 2,
            'project_id' => 2,
        );
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $return = $this->VacationReplace->saveVacationReplace($user_id,$data);
        $this->assertEquals($return, true, 'prawidłowe dane z project_id');
        
        $return = $this->VacationReplace->saveVacationReplace();
        $this->assertEquals($return, false, 'brak danych');
        
        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $return = $this->VacationReplace->saveVacationReplace($user_id);
        $this->assertEquals($return, false, 'brak vacation_id');
    }

}
