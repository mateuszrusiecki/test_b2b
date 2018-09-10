<?php
/* ClientProjectNote Test cases generated on: 2015-03-27 13:55:20 : 1427460920*/
App::uses('ClientProjectNote', 'Model');

/**
 * ClientProjectNote Test Case
 *
 */
class ClientProjectNoteTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
            'app.client_project_note', 
            'app.client', 
            'app.client_project', 
            'app.userUser', 
//            'app.user_client',
            'app.project',
            'app.profile',
            'app.user_section'
            );

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->ClientProjectNote = ClassRegistry::init('ClientProjectNote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientProjectNote);

		parent::tearDown();
	}

        
        public function testGetClientProjectNotes(){
            $project_id = '';
            $return = $this->ClientProjectNote->getClientProjectNotes($project_id);
            $this->assertEquals($return,false,'pusty parametr');
            
            $project_id = '345435646';
            $return = $this->ClientProjectNote->getClientProjectNotes($project_id);
            $this->assertEquals($return,false,'pusty parametr');
            
            $project_id = 3;
            $return = $this->ClientProjectNote->getClientProjectNotes($project_id);
            $this->assertEquals(!empty($return),true,'poprawne dane');
            $this->assertEquals(is_array($return),true,'poprawne dane');
            $this->assertEquals(!empty($return['0']),true,'poprawne dane');
            $return = reset($return);
            $this->assertEquals(!empty($return),true,'poprawne dane');
            $this->assertEquals(!empty($return['ClientProjectNote']),true,'poprawne dane');
            $this->assertEquals(!empty($return['Client']),true,'poprawne dane');
            $this->assertEquals(!empty($return['User']),true,'poprawne dane');
            $this->assertEquals(!empty($return['ClientProject']),true,'poprawne dane');
        }
        public function testGetProjectNotes(){
            
            $project_id = '';
            $return = $this->ClientProjectNote->getProjectNotes($project_id);
            $this->assertEquals($return,false,'pusty parametr');
            
            $project_id = null;
            $return = $this->ClientProjectNote->getProjectNotes($project_id);
            $this->assertEquals($return,false,'parametr null');
            
  
            $return = $this->ClientProjectNote->getProjectNotes();
            $this->assertEquals($return,false,'brak parametru');
            
            $project_id = '12';
            $return = $this->ClientProjectNote->getProjectNotes($project_id);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
            
            
        }
            
        public function testGetProjectNotesSection(){
            
            $project_id = '';
            $return = $this->ClientProjectNote->getProjectNotesSection($project_id);
            $this->assertEquals($return,false,'pusty parametr');
            
            $project_id = null;
            $return = $this->ClientProjectNote->getProjectNotesSection($project_id);
            $this->assertEquals($return,false,'parametr null');
            
  
            $return = $this->ClientProjectNote->getProjectNotesSection();
            $this->assertEquals($return,false,'brak parametru');
            
            $project_id = '12';
            $return = $this->ClientProjectNote->getProjectNotesSection($project_id);
            $this->assertEquals(is_array($return),true,'prawidlowe dane');
        }
        
        public function testChangeClientAccesToNote(){
            
            $note_id = '';
            $visible = '';
            $return  = $this->ClientProjectNote->changeClientAccesToNote($note_id,$visible);
            $this->assertEquals($return,false,'puste parametry');
            
            $note_id = '';
            $visible = null;
            $return  = $this->ClientProjectNote->changeClientAccesToNote($note_id,$visible);
            $this->assertEquals($return,false,'pusty null');
            
            $return = $this->ClientProjectNote->changeClientAccesToNote();
            $this->assertEquals($return,false,'brak parametrow');
            
            $note_id ='6';
            $visible ='1';
            $return  = $this->ClientProjectNote->changeClientAccesToNote($note_id,$visible);
            $this->assertEquals(is_array($return),true,'poprawne');
            
            $note_id ='7';
            $visible ='0';
            $return  = $this->ClientProjectNote->changeClientAccesToNote($note_id,$visible);
            $this->assertEquals(is_array($return),true,'poprawne z wylaczeniem statusu na 0');
            
            
            $note_id ='7';
            $visible = true;
            $return  = $this->ClientProjectNote->changeClientAccesToNote($note_id,$visible);
            $this->assertEquals(is_array($return),true,'poprawne z wlaczeniem statusu na 1 visible true bool');
            
            $note_id ='7';
            $visible = false;
            $return  = $this->ClientProjectNote->changeClientAccesToNote($note_id,$visible);
            $this->assertEquals(is_array($return),true,'poprawne z wylaczeniem statusu na 0 visible true false');
            
            
        }
        
        public function testAddClientProjectNote(){
            
            $note   = '';  // array
            $return = $this->ClientProjectNote->addClientProjectNote($note);
            $this->assertEquals($return,false,'pusty parametr');
            
            $note   = null;  // array
            $return = $this->ClientProjectNote->addClientProjectNote($note);
            $this->assertEquals($return,false,'parametr null');
            
            $return = $this->ClientProjectNote->addClientProjectNote($note);
            $this->assertEquals($return,false,'brak parametru');
            
            $note   = 'asdasdasdasdasdasdasd';  // array
            $return = $this->ClientProjectNote->addClientProjectNote($note);
            $this->assertEquals($return,false,'parametr string');
            
            $note   = array(
                'ClientProjectNote' => array(
                    'id' => '6',
                    'project_id' => '12',
                    'client_id' => '1',
                    'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
                    'content' => 'notatka lol',
                    'client_access' => '0',
                    'created' => '2015-04-10 10:11:11',
                    'modified' => '2015-04-10 10:11:24'
                )
            );  // array
            $return = $this->ClientProjectNote->addClientProjectNote($note);
            $this->assertEquals(is_array($return),true,'poprawne dane');
            
             $note   = array(
                'ClientProjectNote' => array(
                    'id' => '6',
                    'client_id' => '1',
                    'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
                    'content' => 'notatka lol',
                    'client_access' => '0',
                    'created' => '2015-04-10 10:11:11',
                    'modified' => '2015-04-10 10:11:24'
                )
            );  // array
            $return = $this->ClientProjectNote->addClientProjectNote($note);
            $this->assertEquals($return,false,'brak w tablicy project_id');

        }
                  
}
