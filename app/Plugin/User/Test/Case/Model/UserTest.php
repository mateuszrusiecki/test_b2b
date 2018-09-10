<?php

/* User Test cases generated on: 2015-01-22 10:48:16 : 1421920096 */
App::uses('User', 'User.Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User Test Case
 *
 */
class UserTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.userUser',
        'app.user_section',
        'app.user_group',
        'app.user_permission',
        'app.user_groups_user',
        'app.section',
        'app.client',
//        'app.user_client',
        'app.profile',
        'app.modification',
        'app.user_requesters_permission',
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->User = ClassRegistry::init('User.User');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->User);

        parent::tearDown();
    }

    /**
     * Testy funkcjonalności logowania
     *
     * @return void
     */
    public function testLogin()
    {
        // Poprawny login i hasło
        $login = 'admin@feb.net.pl';
        $password = 'FEBtest123';
        $return = $this->User->login($login, $password);
        $this->assertEquals($return, true, 'Poprawny login i hasło');

        // Poprawny login i niepoprawne hasło
        $login = 'admin@feb.net.pl';
        $password = 'ha-tsz';
        $return = $this->User->login($login, $password);
        $this->assertEquals($return, false, 'Poprawny login i niepoprawne hasło');

        // Puste hasło
        $login = 'admin@feb.net.pl';
        $password = '';
        $return = $this->User->login($login, $password);
        $this->assertEquals($return, false, 'Puste hasło');

        // Pusty login
        $login = '';
        $password = 'FEBtest123';
        $return = $this->User->login($login, $password);
        $this->assertEquals($return, false, 'Pusty login');

        // SQL Injection
        $login = 'anything \' OR 1 = 1';
        $password = '';
        $return = $this->User->login($login, $password);
        $this->assertEquals($return, false, 'SQL Injection');
    }

    /**
     * Testy funkcjonalności resetowania hasła
     *
     * @return void
     */
    public function testResetPassword()
    {
        // Poprawny email
        $email = 'admin@feb.net.pl';
        $return = $this->User->resetPassword($email);
        $this->assertEquals($return, true, 'Poprawny email');

        // Pusty email
        $email = '';
        $return = $this->User->resetPassword($email);
        $this->assertEquals($return, false, 'Pusty email');

        // Niepoprawny email
        $email = 'asd';
        $return = $this->User->resetPassword($email);
        $this->assertEquals($return, false, 'Niepoprawny email');

        // Nieistniejący email
        $email = '10293810298@test.pl';
        $return = $this->User->resetPassword($email);
        $this->assertEquals($return, false, 'Nieistniejący email');
    }

    /**
     * Testy dodawania zdjęcia.
     */
    public function testAddPhoto()
    {
        // Prawidłowe dane
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $photo = array(
            'User' => array(
                'avatar_url' => null,
                'avatar' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => 0,
                    'size' => '200'
                )
            )
        );
        $return = $this->User->addPhoto($user_id, $photo);
        $this->assertEquals($return, true, 'Prawidłowe dane');

        // Brak usera
        $photo = array(
            'User' => array(
                'avatar_url' => null,
                'avatar' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => 0,
                    'size' => '200'
                )
            )
        );
        $return = $this->User->addPhoto(null, $photo);
        $this->assertEquals($return, false, 'Brak usera');

        // Brak pliku i linku (błąd php)
        $photo = array(
            'User' => array(
                'avatar_url' => null,
                'avatar' => array(
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'error' => 'UPLOAD_ERR_NO_FILE',
                    'size' => ''
                )
            )
        );
        $return = $this->User->addPhoto($photo);
        $this->assertEquals($return, false, 'Brak pliku i linku (błąd php)');

        // Brak danych z formularza
        $photo = array(
            'User' => array(
                'avatar_url' => null,
                'avatar' => null
            )
        );
        $return = $this->User->addPhoto($photo);
        $this->assertEquals($return, false, 'Brak danych z formularza');

        // Zbyt duży rozmiar pliku
        $photo = array(
            'User' => array(
                'avatar_url' => null,
                'avatar' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => 'UPLOAD_ERR_INI_SIZE',
                    'size' => '9999999999999999999999999999'
                )
            )
        );
        $return = $this->User->addPhoto($photo);
        $this->assertEquals($return, false, 'Prawidłowe dane');

        // Częściowo wgrane zdjęcie
        $photo = array(
            'User' => array(
                'avatar_url' => null,
                'avatar' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => 'UPLOAD_ERR_PARTIAL',
                    'size' => '200'
                )
            )
        );
        $return = $this->User->addPhoto($photo);
        $this->assertEquals($return, false, 'Częściowo wgrane zdjęcie');

        // Dołączony link nie jest zdjęciem
        $photo = array(
            'User' => array(
                'avatar_url' => 'http://onet.pl/wirus.exe',
                'avatar' => null
            )
        );
        $return = $this->User->addPhoto($photo);
        $this->assertEquals($return, false, 'Dołączony link nie jest zdjęciem');
    }

    /**
     * Testy zmiany hasła.
     */
    public function testChangePassword()
    {
        // Poprawne dane
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $old_password = 'FEBtest123';
        $new_password = 'NoweHaslo123*';
        $return = $this->User->changePassword($user_id, $old_password, $new_password);
        $this->assertEquals($return, true, 'Poprawne dane');

        // Niepoprawne stare hasło
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $old_password = 'jakiesZleHaslo';
        $new_password = 'NoweHaslo123*';
        $return = $this->User->changePassword($user_id, $old_password, $new_password);
        $this->assertEquals($return, false, 'Niepoprawne stare hasło');

        // Nieistniejący user
        $user_id = '123456789';
        $old_password = 'FEBtest123';
        $new_password = 'NoweHaslo123*';
        $return = $this->User->changePassword($user_id, $old_password, $new_password);
        $this->assertEquals($return, false, 'Nieistniejący user');

        // Pusty user
        $user_id = '';
        $old_password = 'FEBtest123';
        $new_password = 'NoweHaslo123*';
        $return = $this->User->changePassword($user_id, $old_password, $new_password);
        $this->assertEquals($return, false, 'Pusty user');

        // Puste nowe hasło
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $old_password = 'FEBtest123';
        $new_password = '';
        $return = $this->User->changePassword($user_id, $old_password, $new_password);
        $this->assertEquals($return, false, 'Puste nowe hasło');

        // Nowe hasło zbyt słabe
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $old_password = 'FEBtest123';
        $new_password = 'abcdef';
        $return = $this->User->changePassword($user_id, $old_password, $new_password);
        $this->assertEquals($return, false, 'Nowe hasło zbyt słabe');
    }

    /**
     * Testy pobierania danych wybranego uzytkownika
     */
    public function testGetUser()
    {
        //poprawne id uzytkownika
        $id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $return = $this->User->getUser($id);
        $this->assertEqual(is_array($return), true, 'poprawne id uzytkownika');

        //niepoprawne id uzytkownika
        $id = '000000000000000000000';
        $return = $this->User->getUser($id);
        $this->assertEqual($return, false, 'niepoprawne id uzytkownika');

        //brak id uzytkownika
        $id = null;
        $return = $this->User->getUser($id);
        $this->assertEqual($return, false, 'brak id uzytkownika');
    }

    /*
     * Testowanie zapisu danych do PM
     */

    public function testSavePmCredentials()
    {
        //poprawne dane
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $login = 'm.rusiecki';
        $pass = 'haslo123';
        $return = $this->User->savePmCredentials($user_id, $login, $pass);
        $this->assertEqual($return, true, 'poprawne dane uzytkownika');

        //Brak danych do zapisu
        $user_id = null;
        $login = null;
        $pass = null;
        $return = $this->User->savePmCredentials($user_id, $login, $pass);
        $this->assertEqual($return, false, 'brak danych do zapisu');

        //brak loginu
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $login = null;
        $pass = 'haslohaslo';
        $return = $this->User->savePmCredentials($user_id, $login, $pass);
        $this->assertEqual($return, false, 'brak loginu');

        //brak hasla
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $login = 'loginlogin';
        $pass = null;
        $return = $this->User->savePmCredentials($user_id, $login, $pass);
        $this->assertEqual($return, false, 'brak hasla');
    }

    
    /**
     * Lista użytkowników
     * 
     * @return mixed            array z danymi profili
     *                          false w przeciwnym błedu
     */
    public function testGetAllUsers(){
    
    $return = $this->User->getAllUsers();
    $this->assertEqual(is_array($return), true, 'nie pobiera listy userów, lub faktycznie ich w bazie nie ma');
        
    }
    
    /*
     * funkcja validatePassword prawdopoobnie nie jest wykorzystywana
     */
    public function testValidatePassword(){
        $this->data['User']['newpassword'] = 'haslo123';
        $this->data['User']['confirmpassword'] = 'haslo123';
        $return = $this->User->validatePassword();
        $this->assertEqual($return, true, '??');
    }
    
    public function testGetUserIP(){
        $return = $this->User->getUserIP();
        $this->assertEqual($return, true, 'poprawne dane');
    }
    
    public function testLogAction(){
        $action = null;
        $id  = '556715b8-bbd8-4641-85f6-1adc904cf98e';
        $login = null;
        $email = null;
        
        $return = $this->User->logAction($action, $id, $login, $email);
        $this->assertEqual(is_array($return), true, 'podane id');
        
        $action = null;
        $id  = null;
        $login = null;
        $email = 'w.janowska@feb.net.pl';
        
        $return = $this->User->logAction($action, $id, $login, $email);
        $this->assertEqual(is_array($return), true, 'podane email i id(nie ten sam uzytkownik');
        
        $action = null;
        $id  = '556715b8-bbd8-4641-85f6-1adc904cf98e';
        $login = null;
        $email = 'w.janowska@feb.net.pl';
        
        $return = $this->User->logAction($action, $id, $login, $email);
        $this->assertEqual(is_array($return), true, 'podane email i id(nie ten sam uzytkownik');
        
        $action = null;
        $id  = null;
        $login = 'w.janowska@feb.net.pl';
        $email = null;
        
        $return = $this->User->logAction($action, $id, $login, $email);
        $this->assertEqual(is_array($return), true, 'podane login');
        
        
        $action = 'Wylogowano poprawnie';
        $id  = null;
        $login = 'w.janowska@feb.net.pl';
        $email = null;
        
        $return = $this->User->logAction($action, $id, $login, $email);
        $this->assertEqual(is_array($return), true, 'podana akcja i login');
        
        $action = null;
        $id  = null;
        $login = 'w.janowska@feb.net.pl';
        $email = 'w.janowska@feb.net.pl';
        
        $return = $this->User->logAction($action, $id, $login, $email);
        $this->assertEqual(is_array($return), true, 'podane login');
    }
    
    /*
     * funkcja nieużywana
     */
//    public function testUtf8CleanString(){
//        $text = 'lorem ipsum dolor sit';
//        $return = $this->User->utf8_clean_string($text);
//        $this->assertEqual($return, true, 'poprawne dane');
//    }
    
    public function testUniqueId(){
        $return = $this->User->unique_id();
        $this->assertEqual(is_string($return), true, 'poprawne dane');
    }
    
    public function testPhpbbHash(){
        $password = 'haslo123';
        $return = $this->User->phpbb_hash($password);
        $this->assertEqual(is_string($return), true, 'poprawne dane');
        
        $return = $this->User->phpbb_hash();
        $this->assertEqual($return, false, 'brak danych');
        
        
    }
    
    public function testPhpbbCheckHash(){
        
        $password = 'haslo123';
        $hash = $this->User->phpbb_hash($password);
        
        $return = $this->User->phpbb_check_hash($password,$hash);
        $this->assertEqual($return, true, 'poprawne dane');
    }
    
    public function testSetUserSession(){
        $user_id='3a38ee92-6934-102d-9f80-579a023712b2';
        $return = $this->User->setUserSession($user_id);
        $this->assertEqual($return, true, 'poprawne dane');
        
        $user_id='99999999-6934-102d-9f80-579a023712b2';
        $return = $this->User->setUserSession($user_id);
        $this->assertEqual($return, false, 'nieistnijeący user');
    }
    
    public function testFilterParams(){
        
        $data = array();
        $return = $this->User->filterParams($data);
        $this->assertEqual($return, false, 'puste dane');
        
        $data['User']['id'] = '55680f13-8020-4ded-8783-2a45904cf98e';
        $return = $this->User->filterParams($data);
        $this->assertEqual(is_array($return), true, 'user id');
        
        $data['User']['id'] = '55680f13-8020-4ded-8783-2a45904cf98e';
        $data['User']['email'] = 'a.pieczonka@feb.net.pl';
        $return = $this->User->filterParams($data);
        $this->assertEqual(is_array($return), true, 'user id + email');
        
        $data['User']['id'] = '55680f13-8020-4ded-8783-2a45904cf98e';
        $data['User']['email'] = 'a.pieczonka@feb.net.pl';
        $data['Group']['id'] = '54e1db06-d618-4db2-9f3f-0a2077ecc6b3';
        $return = $this->User->filterParams($data);
        $this->assertEqual(is_array($return), true, 'user id + email + group');
        
    }
    
    public function testPhpbbEmailHash(){
        $email = 'email@example.com';
        $return = $this->User->phpbb_email_hash($email);
        $this->assertEqual(is_string($return), true, 'prawidłowe dane');
    }
    
    public function testSearch(){
        $options['Searcher']['fraz'] = 'tekst do znalezienia';
        $return = $this->User->search($options);
        $this->assertEqual(is_array($return), true, 'prawidłowe dane');
        
        $return = $this->User->search();
        $this->assertEqual($return, false, 'brak danych');
    }
    
    public function testCreateResetPassLink(){
        $id = '55680f13-8020-4ded-8783-2a45904cf98e';
        $modified = time();
        $return = $this->User->createResetPassLink($id, $modified);
        $this->assertEqual(is_array($return), true, 'prawidłowe dane');
        
        $id = '55680f13-8020-4ded-8783-2a45904cf98e';
        $return = $this->User->createResetPassLink($id);
        $this->assertEqual($return, false, 'brak modified');
        
        $modified = time();
        $return = $this->User->createResetPassLink(null, $modified);
        $this->assertEqual($return, false, 'brak id');
    }
    
    public function testCheckResetPassHash(){
        
        $password = 'haslo123';
        $hash = $this->User->phpbb_hash($password);
        
        $id = '55680f13-8020-4ded-8783-2a45904cf98e';
        $return = $this->User->checkResetPassHash($id,$hash);
        $this->assertEqual($return, false, ' ?? nie wiem jak testować - skąd wziąć HASH');
    }
    
    public function testAftreSave(){
        $this->User->afterSave();
        //log( Router::getRequest() );
    }
    
}
