<?php

/**
 * I18nMessage Test Case
 *
 */
class I18nMessageTest extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.i18n_message'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->I18nMessage = ClassRegistry::init('Translate.I18nMessage');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->I18nMessage);

        parent::tearDown();
    }

    /**
     * testParsePostToFile method
     *
     * @return void
     */
    public function testParsePostToFile()
    {
        $data[1]['msgctxt'] = '';
        $data[1]['msgid'] = 'key';
        $data[1]['msgstr'] = 'key1';


        $return = $this->I18nMessage->parsePostToFile($data);
        $this->assertEquals(strpos($return, 'sgid "key"') > 0, true, 'poprwne dane');
        $this->assertEquals(strpos($return, 'msgstr "key1"') > 0, true, 'poprawne dane');
        $this->assertEquals(strpos($return, 'msgstr "key2"'), false, 'poprawne dane');

        $return = $this->I18nMessage->parsePostToFile();
        $this->assertEquals(empty($return), true, 'brak danych');
    }

    /**
     * testParsePostToBase method
     *
     * @return void
     */
    public function testParsePostToBase()
    {
        $data[1]['msgctxt'] = '';
        $data[1]['msgid'] = 'key';
        $data[1]['msgstr'] = 'key1';


        $return = $this->I18nMessage->parsePostToBase($data);

        $this->assertEquals($data[1]['msgctxt'] == $return[1]['msgctxt'], true, 'poprwne dane');

        $return = $this->I18nMessage->parsePostToBase();
        $this->assertEquals(empty($return), true, 'brak danych');
    }

    /**
     * testParseFileToArray method
     *
     * @return void
     */
    public function testParseFileToArray()
    {
        $path = APP . 'Locale' . DS . 'pol' . DS . 'LC_MESSAGES' . DS . 'default.po';
        $retrun = $this->I18nMessage->parseFileToArray($path);

        $this->assertEquals(is_array($retrun), true, 'poprawne dane');
        $this->assertEquals($retrun['1']['msgid']['January'], true, 'poprawne dane');

        $retrun = $this->I18nMessage->parseFileToArray();
        $this->assertEquals($retrun, false, 'brak parametry');
    }

    /**
     * testDeleteCache method
     *
     * @return void
     */
    public function testDeleteCache()
    {
        $this->markTestIncomplete('testDeleteCache not implemented.');
    }

    /**
     * testGetBase method
     *
     * @return void
     */
    public function testGetBase()
    {
        $data[1]['msgctxt'] = '';
        $data[1]['msgid'] = 'January';
        $data[1]['msgstr'] = '';
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2'; //admin
        $domain = 'default.po';
        $lang = 'pol';
        $retrun = $this->I18nMessage->getBase($data, $user_id, $domain, $lang);
        $this->assertEquals(is_array($retrun), true, 'poprawne dane');
        $this->assertEquals($retrun['1']['msgid']['January'], true, 'poprawne dane');
        $this->assertEquals($retrun['1']['base']['Styczeń'], true, 'poprawne dane');

        $retrun = $this->I18nMessage->getBase();
        $this->assertEquals($retrun, false, 'brak danych');
    }

}
