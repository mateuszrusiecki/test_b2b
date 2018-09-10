<?php

class UserControllersTest extends ControllerTestCase {

    //public $fixtures = array('app.user');
    public $autoFixtures = false;


    public  function testLoginWithoutPostData() {
        $result = $this->testAction('/login', array('method'=>'get'));
        $this->assertNull($result);
    }


    public  function testLoginWithCorrectData() {
        $this->loadFixtures('User');

        $data = array(
            'User' => array(
                'username' => 'test@test.com',
                'password' => '000000',
            )
        );

        $result = $this->testAction('/login', array(
            'return'=>'result',
            'method'=>'post',
            'data'=> $data,
        ));
        $this->assertNotNull($this->headers['Location']);
        $this->assertEqual(0, $result);
    }


    public function testLoginWithIncorrectData() {
        $this->loadFixtures('User');

        $data = array(
            'User' => array(
                'username' => 'test@test.com',
                'password' => '000001',
            )
        );

        $result = $this->testAction('/login', array(
            'return'=>'result',
            'method'=>'post',
            'data'=> $data,
        ));
        //$this->assertNotNull($this->headers['Location']);
        $this->assertEqual(1, $result);
    }


    public function testLogout() {
        $result = $this->testAction('/logout', array('return' => 'view'));
        $this->assertNull($this->view);
    }



    public function testListing() {
        $this->loadFixtures('User');

        $result = $this->testAction('/users/listing/manager.json');
        $result = json_decode($result, true);
        $records = count($result);
        $this->assertEqual(2, $records);

    }
}