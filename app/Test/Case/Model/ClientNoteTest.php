<?php

/* ClientNote Test cases generated on: 2015-02-18 13:40:18 : 1424263218 */
App::uses('ClientNote', 'Model');

/**
 * ClientNote Test Case
 *
 */
class ClientNoteTestCase extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.client_note', 
        'app.client', 
        'app.UserUser', 
//        'app.user_client'
        );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->ClientNote = ClassRegistry::init('ClientNote');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientNote);

        parent::tearDown();
    }

    /**
     * testGetClientNote method
     *
     * @return void
     */
    public function testGetClientNote()
    {
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = 1;
        $return = $this->ClientNote->getClientNotes($user_id, $client_id);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = null;
        $return = $this->ClientNote->getClientNotes($user_id, $client_id);
        $this->assertEquals($return, false, 'niepoprawny klient');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = 0;
        $return = $this->ClientNote->getClientNotes($user_id, $client_id);
        $this->assertEquals($return, false, 'niepoprawny klient 2');

        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $client_id = 999;
        $return = $this->ClientNote->getClientNotes($user_id, $client_id);
        $this->assertEquals($return, false, 'nie ma takiego klienta');

        $user_id = null;
        $client_id = 1;
        $return = $this->ClientNote->getClientNotes($user_id, $client_id);
        $this->assertEquals($return, false, 'niepoprawny użytkownik');

        $user_id = '6666666-6666-66666-6666-579a023712b2';
        $client_id = 1;
        $return = $this->ClientNote->getClientNotes($user_id, $client_id);
        $this->assertEquals($return, false, 'nie ma takiego użytkownika');

    }

    /**
     * testAddClientNote method
     *
     * @return void
     */
    public function testAddClientNote()
    {
        $note['ClientNote'] = array(
            'id' => '1',
            'client_id' => '1',
            'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
            'title' => 'Przykładowy tytuł',
            'content' => 'To jest przykładowa treść notatki.'
            );
        $return = $this->ClientNote->addClientNote($note);
        $this->assertEquals(is_array($return), true, 'prawidłowe dane');

        $return = $this->ClientNote->addClientNote();
        $this->assertEquals($return, false, 'brak parametrów funkcji');

        $note['ClientNote'] = array(
            'client_id'=> null,
            'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
            'title' => 'Testowy tytuł',
            'content' => 'Treść'
            );
        $return = $this->ClientNote->addClientNote($note);
        $this->assertEquals($return, false, 'brak id klienta');

        $note['ClientNote'] = array(
            'client_id'=> 2,
            'user_id' => null,
            'title' => 'Testowy tytuł',
            'content' => 'Treść'
            );
        $return = $this->ClientNote->addClientNote($note);
        $this->assertEquals($return, false, 'brak id użytkownika');

        $note['ClientNote'] = array(
            'client_id'=> 2,
            'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
            'title' => null,
            'content' => 'Treść'
            );
        $return = $this->ClientNote->addClientNote($note);
        $this->assertEquals($return, false, 'brak tytułu');

        $note['ClientNote'] = array(
            'client_id'=> 2,
            'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
            'title' => 'Testowy tytuł',
            'content' => null
            );
        $return = $this->ClientNote->addClientNote($note);
        $this->assertEquals($return, false, 'brak treści');

    }

    /**
     * testDeleteClientNote method
     *
     * @return void
     */
    public function testDeleteClientNote()
    {
        $id = 6;
        $return = $this->ClientNote->deleteClientNote($id);
        $this->assertEquals($return, true, 'prawidłowe dane');

        
        $return = $this->ClientNote->deleteClientNote();
        $this->assertEquals($return, false, 'brak parametrów funkcji');

    }

}
