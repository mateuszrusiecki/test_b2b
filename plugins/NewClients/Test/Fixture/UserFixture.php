<?php

class UserFixture extends CakeTestFixture {
    //public $useDbConfig = 'test';
    public $import = array('table' => 'users', 'connection' => 'default');
/*
    public $fields = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'username' => array('type' => 'string', 'length' => 128, 'null' => false),
        'password' => array('type' => 'string', 'length' => 128, 'null' => false),
        'clearpassword' => array('type' => 'string', 'length' => 128),
        'email' => array('type' => 'string', 'length' => 128, 'null' => false),
        'role' => array('type' => 'string', 'length' => 128, 'null' => false),
    );
*/
    public $records = array(
        array(
            'id' => 1,
            'username' => 'test@test.com',
            'password' => '$2a$10$Y37qF7Lxt3yJ4.GcqRt9He2WpLt/3Xn54QYDq3yyXy927wKqoz4lO',
            'clearpassword' => null,
            'email' => 'test@test.com',
            'role' => 'manager'
        ),
        array(
            'id' => 2,
            'username' => 'test@kleint.com',
            'password' => '$2a$10$Y37qF7Lxt3yJ4.GcqRt9He2WpLt/3Xn54QYDq3yyXy927wKqoz4lO',
            'clearpassword' => '000000',
            'email' => 'test@test.com',
            'role' => 'client'
         ),
        array(
            'id' => 3,
            'username' => 'test@manager.com',
            'password' => '$2a$10$Y37qF7Lxt3yJ4.GcqRt9He2WpLt/3Xn54QYDq3yyXy927wKqoz4lO',
            'clearpassword' => null,
            'email' => 'test@manager.com',
            'role' => 'manager'
        ),

    );
}