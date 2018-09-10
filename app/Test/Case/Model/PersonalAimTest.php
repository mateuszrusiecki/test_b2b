<?php

/* PersonalAim Test cases generated on: 2015-01-28 09:59:30 : 1422435570 */
App::uses('PersonalAim', 'Model');

/**
 * PersonalAim Test Case
 *
 */
class PersonalAimTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.personal_aim', 
        'app.UserUser',
        'app.profile',
        );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->PersonalAim = ClassRegistry::init('PersonalAim');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PersonalAim);

        parent::tearDown();
    }

    /**
     * testGetPersonalAim method
     *
     * @return void
     */
    public function testGetPersonalAim()
    {
        $return = $this->PersonalAim->getPersonalAim();
        $this->assertEquals($return, false, 'brak usera');
        
        $user_id = 'zly-id';
        $return = $this->PersonalAim->getPersonalAim($user_id);
        $this->assertEquals($return, false, 'zle id');
        
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $return = $this->PersonalAim->getPersonalAim($user_id);
        $this->assertEquals(count($return) == 1, true, 'recursive = -1');
        
        $this->assertEquals(count($return['PersonalAim']) == 10, true, ' są wszystkie fields');
        
        $this->assertEquals(isset($return['PersonalAim']['name']), true, 'jest name');
        
        
    }

    /**
     * testSetPersonalAim method
     *
     * @return void
     */
    public function testSetPersonalAim()
    {
        $photo = array(
            'PersonalAim' => array(
                'photo_url' => null,
                'photo' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim(null, $photo);
        $this->assertEquals($return, false, 'brak usera');
        
        $user = '11';
        $photo = array(
            'PersonalAim' => array(
                'photo_url' => null,
                'photo' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user, $photo);
        $this->assertEquals($return, false, 'zwraca dane pomimo podanego nieisniejącego usera');
        
        // prawidlowe dane 
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $photo = array(
            'PersonalAim' => array(
                'photo_url' => null,
                'photo' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user_id, $photo);
        $this->assertEquals($return, true, 'Prawidłowe dane');

        
        // status podzielny przez  5
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $photo = array(
            'PersonalAim' => array(
                'photo_url' => null,
                'status' => 5,
                'photo' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user_id, $photo);
        $this->assertEquals($return, true, 'status podzielny przez 5');

        // status nie podzielny przez  5
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $photo = array(
            'PersonalAim' => array(
                'photo_url' => null,
                'status' => 3,
                'photo_type' => 'file',
                'photo' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user_id, $photo);
        $this->assertEquals($return, false, 'status nie podzielny przez 5');
        
        // Zbyt duży rozmiar pliku
        $photo = array(
            'PersonalAim' => array(
                'photo_url' => null,
                'photo_type' => 'file',
                'photo' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => 'UPLOAD_ERR_INI_SIZE',
                    'size' => '9999999999999999999999999999'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user_id, $photo);
        $this->assertEquals($return, false, 'Prawidłowe dane');

        
        // Częściowo wgrane zdjęcie
        $photo = array(
            'PersonalAim' => array(
                'photo_url' => null,
                'photo_type' => 'file',
                'photo' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => 'UPLOAD_ERR_PARTIAL',
                    'size' => '200'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user_id, $photo);
        $this->assertEquals($return, false, 'Częściowo wgrane zdjęcie');

        // Dołączony link nie jest zdjęciem
        $photo = array(
            'PersonalAim' => array(
                'photo_url' => 'http://onet.pl/wirus.exe',
                'photo' => null
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user_id, $photo);
        $this->assertEquals($return, false, 'Dołączony link nie jest zdjęciem');

        $user_id = '54c10ad6-c888-49c2-afd8-106077ecc6b3';
        $return = $this->PersonalAim->setPersonalAim($user_id);
        $this->assertEquals($return, false, 'brak danych do zapisu');

        
         // start_date >  end_date
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $photo = array(
            'PersonalAim' => array(
                'start_date' => '2015-03-01',
                'end_date' => '2015-03-01',
                'photo_url' => null,
                'photo' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user_id, $photo);
        $this->assertEquals($return, true, 'błąd przy starcie pozniejszym niz koncu');
        
        
        
        // photo type = 'file'
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $photo = array(
            'PersonalAim' => array(
                'start_date' => '2015-03-01',
                'end_date' => '2015-03-01',
                'photo_type' =>'file',
                'photo' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user_id, $photo);
        $this->assertEquals($return, true, 'Sprawdza czy link czy file');
        
        // photo type != 'file'
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $photo = array(
            'PersonalAim' => array(
                'start_date' => '2015-03-01',
                'end_date' => '2015-03-01',
                'photo_type' =>'aaa',
                'photo' => array(
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->PersonalAim->setPersonalAim($user_id, $photo);
        $this->assertEquals($return, true, 'Sprawdza photo type != file');



    }

}
