<?php

App::uses('TextDocument', 'Model');
App::uses('TextDocument', 'Model');
/**
 * TextDocument Test Case
 *
 */
class TextDocumentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.text_document'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TextDocument = ClassRegistry::init('TextDocument');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TextDocument);

		parent::tearDown();
	}

/**
 * testGetTextDocuments method
 *
 * @return void
 */
	public function testGetTextDocuments() {
            
            $return = $this->TextDocument->getTextDocuments();
            $this->assertEquals(is_array($return), true, 'funkcja nie zwraca danych');
            
            $return = $this->TextDocument->getTextDocuments(5);
            $this->assertEquals(is_array($return), true, 'funkcja z parametrem nie zwraca danych');
            
	}

/**
 * testSetDefaultFields method
 *
 * @return void
 */
	public function testSetDefaultFields() {
            
            $requestData = array();
            $requestData['TextDocument'] = array();
            
            $requestData = $this->TextDocument->setDefaultFields($requestData, 13);
            
            $this->assertEquals($requestData['TextDocument']['user_id'], 13, 'zle przypisane user_id');          
            $this->assertEquals($requestData['TextDocument']['pdf_file'], '', 'zle przypisane pdf_file');          
            $this->assertEquals($requestData['TextDocument']['doc_file'], '', 'zle przypisane doc_file');     
	}        
}
