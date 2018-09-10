<?php

/**
 * HrSettings Test Case
 *
 */
class HrSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hr_setting'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HrSetting = ClassRegistry::init('HrSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HrSetting);

		parent::tearDown();
	}

/**
 * testGetHrSettings method
 *
 * @return void
 */
	public function testGetHrSettings() {
        
            $return = $this->HrSetting->getHrSettings();
            $this->assertEquals(is_array($return),true,'w tabeli nie ustawień hr');
	}

/**
 * testSaveHrSettings method
 *
 * @return void
 */
	public function testSaveHrSettings() {
            
            $data   = '';
            $return = $this->HrSetting->saveHrSettings($data);
            $this -> assertEquals($return,false,'parametr pusty');
                        
            $data   = null;
            $return = $this->HrSetting->saveHrSettings($data);
            $this -> assertEquals($return,false,'parametr null');
                        
            $return = $this->HrSetting->saveHrSettings();
            $this -> assertEquals($return,false,'brak parametru');
                        
            
            $data   = array(
                'HrSetting' => array(
                        'margin' => '67',
			'buffer' => '19',
			'it_rate' => '49',
			'hostname' => '{mail.febdev.pl:110/pop3/novalidate-cert}INBOX',
			'username' => 'crm@febdev.pl',
			'password' => 'i2aWQsj0'
                )
            );
            $return = $this->HrSetting->saveHrSettings($data);
            $this -> assertEquals(is_array($return),true,'parametr null');
	}

}
