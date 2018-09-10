<?php

/**
 * BriefAnswer Test Case
 *
 */
class CodeErrorTestCase extends CakeTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.code_error'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        
        $this->CodeError = ClassRegistry::init('CodeError');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CodeError);

        parent::tearDown();
    }

    public function testCorrectValidationAndSave(){
        
        $this->CodeError->create();
        
        $codeErrorData = array (
            'CodeError' => Array
            (
                'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
                'name' => 'nazwa testowa',
                'href' => 'http://www.onet.pl',
                'message' => 'wiadomość testowa',
                'url' => 'www.onet.pl',
                'line' => 4,
                'modified' => "2012-07-08 11:14:15.638276",
                'created' => "2012-08-09 10:12:19.638276",
            )
        );    
        
        if($this->CodeError->save($codeErrorData)){
            $result = true;
        } else {
            $result = false;
        }
        
        $this->assertEquals(true, $result, 'poprawna walidacja i zapis');
    }
     
    public function testIncorrectValidationAndSave(){
        
        $this->CodeError->create();
        
        $codeErrorData = array (
            'CodeError' => Array
            (
                'user_id' => '111111111111111111111111111111111111',
                'name' => 'nazwa testowa',
                'href' => 'http://www.onet.pl',
                'message' => 'wiadomość testowa',
                'url' => 'www.onet.pl',
                'line' => 'wartosc_nie_liczbowa',
                'modified' => "2012-07-08 11:14:15.638276",
                'created' => "2012-08-09 10:12:19.638276",
            )
        );    
        
        if($this->CodeError->save($codeErrorData)){
            $result = true;
        } else {
            $result = false;
        }
        
        $this->assertEquals(false, $result, 'nieudana walidacja i zapis');
    }
    
    public function testStart()
    {
        
        $this->assertEquals(true, true, 'piersze uruchomienie');
    }
}
