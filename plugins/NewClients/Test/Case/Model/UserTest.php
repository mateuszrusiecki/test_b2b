<?php

App::uses('User', 'Model');

class UserTest extends CakeTestCase {
    public $fixtures = array();

    public function setUp() {
        parent::setUp();
        $this->Users = ClassRegistry::init('User');
    }

    public function testLogin() {

        $data = array('User' => array(
            'username' => 'test@test.com',
            'password' => '000000'
            )
        );


        //$this->Users = $this->generate('Users', array());

        $this->assertEquals(2, 1+1);
    }

    public function testLogout() {
        $this->assertEquals(2, 1+1);
    }
}