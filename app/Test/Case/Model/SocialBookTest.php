<?php

/**
 * SocialBook Test Case
 *
 */
class SocialBookTest extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.social_book',
        'app.user_user',
        'app.profile',
        'app.user_section',
        'app.user_contract_history',
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->SocialBook = ClassRegistry::init('SocialBook');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SocialBook);

        parent::tearDown();
    }

    /**
     * testGetIdByUserEmail method
     *
     * @return void
     */
    public function testBeforeValidate()
    {
        $return = $this->SocialBook->beforeValidate();
    }
    /**
     * testGetIdByUserEmail method
     *
     * @return void
     */
    public function testGetIdByUserEmail()
    {
        $email = 'd.czyz@febdev.pl';
        $return = $this->SocialBook->getIdByUserEmail($email);
        $this->assertEquals($return, true, 'poprawny email');
        
        $email = 'd.czyz';
        $return = $this->SocialBook->getIdByUserEmail($email);
        $this->assertEquals($return, false, 'nie poprawny email');
    }

    /**
     * testGetByUserId method
     *
     * @return void
     */
    public function testGetByUserId()
    {
        
        $user_id = '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3';
        $return = $this->SocialBook->getByUserId($user_id);
        $this->assertEquals(is_array($return), true, 'poprawny id');
        
        $user_id = '5324234';
        $return = $this->SocialBook->getByUserId($user_id);
        $this->assertEquals($return, false, 'nie poprawny id');
    }

    /**
     * testGetListUser method
     *
     * @return void
     */
    public function testGetListUser()
    {
        
        $return = $this->SocialBook->getListUser();
        $this->assertEquals(is_array($return), true, 'jest lista');
        $return = reset($return);
        $this->assertEquals(!empty($return['User']), true, 'jest User?');
        $this->assertEquals(!empty($return['Profile']), true, 'jest Profile?');
        $this->assertEquals(!empty($return['UserContractHistory']), true, 'jest UserContractHistory?');
        $this->assertEquals(!empty($return['UserSection']), true, 'jest UserSection?');
        $this->assertEquals(!empty($return['UserSection']), true, 'jest UserSection?');
        $this->assertEquals(!empty($return['SocialBook']), true, 'jest SocialBook?');
    }

}
