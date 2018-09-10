<?php

/**
 * BriefAnswer Test Case
 *
 */
class CronTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.cron'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Cron = ClassRegistry::init('Cron');
    }

    public function testCorrectCheck(){
        
        $data = array(
            'N' => '',
            'm' => '',
            'd' => '',
            'H' => '',
            'i' => '',
        );
        
        $result = $this->Cron->check($data);
        
        $this->assertEquals(true, $result, 'dla pustej tablicy');
        
        $data = array(
            'N' => date('N'),
            'm' => date('m'),
            'd' => date('d'),
            'H' => '*',
            'i' => '*',
        );

        $result = $this->Cron->check($data);
        
        $this->assertEquals(true, $result, 'dla obecnej daty');
    }
    
    public function testIncorrectCheck(){
              
        $data = array(
            'N' => date("N", strtotime('-1 days')),
            'm' => '',
            'd' => '',
            'H' => '',
            'i' => '',
        );
        
        $result = $this->Cron->check($data);
        
        $this->assertEquals(false, $result, 'dla pustej tablicy');      
    }
    
    public function testCorrectValidationAndSave(){
        
        $this->Cron->create();
        
        $codeErrorData = array (
            'Cron' => Array
            (
                'active' => '1',
                'name' => 'nazwa testowa',
                'N' => 'aa',
                'm' => 'aa',
                'd' => 'aa',
                'H' => 'aa',
                'i' => 'aa',
                'url' => 'aa',
                'modified' => "2012-08-09 10:12:19.638276",
                'created' => "2012-08-09 10:12:19.638276",
            )
        );    
        
        if($this->Cron->save($codeErrorData)){
            $result = true;
        } else {
            $result = false;
        }
        
        $this->assertEquals(true, $result, 'poprawna walidacja i zapis');
    }
     
    public function testIncorrectValidationAndSave(){
        
        $this->Cron->create();
        
        $codeErrorData = array (
            'Cron' => Array
            (
                'active' => '1',
                'name' => 'nazwa testowa',
                'N' => 'aa',
                'm' => 'aa',
                'd' => 'aa',
                'H' => 'aa',
                'i' => 'aa',
                'url' => '',
                'modified' => "2012-08-09 10:12:19.638276",
                'created' => "2012-08-09 10:12:19.638276",
            )
        );    
        
        if($this->Cron->save($codeErrorData)){
            $result = true;
        } else {
            $result = false;
        }
        
        $this->assertEquals(false, $result, 'nieudana walidacja i zapis');
    }
    
    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cron);

        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }

}
