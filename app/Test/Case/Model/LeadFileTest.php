<?php


/**
 * LeadFile Test Case
 *
 */
class LeadFileTest extends CakeTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.lead_file',
        'app.client_lead',
//        'app.client',
//        'app.user_user',
//        'app.user_client',
//        'app.lead_category',
//        'app.lead_status',
//        'app.currency',
//        'app.client_contact',
//        'app.client_contact_client_lead'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->LeadFile = ClassRegistry::init('LeadFile');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LeadFile);

        parent::tearDown();
    }

    /**
     * testSaveFile method
     *
     * @return void
     */
    public function testSaveFile()
    {
        $return = $this->LeadFile->saveFile();
        $this->assertEquals($return, false, 'brak parametrów');
     

        // Prawidłowe dane
        $photo = array(
            'LeadFile' => array(
                'client_lead_id' => 3,
                'file_category_id' => 1,
                'file' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->LeadFile->saveFile($photo);
        $this->assertEquals(is_array($return), true, 'Prawidłowe dane');

//         Zbyt duży rozmiar pliku
        $photo = array(
            'LeadFile' => array(
                'client_lead_id' => 3,
                'lead_category_id' => 1,
                'file' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => 'UPLOAD_ERR_INI_SIZE',
                    'size' => '9999999999999999999999999999'
                )
            )
        );
        $return = $this->LeadFile->saveFile($photo);
        $this->assertEquals($return, false, 'Zbyt duży rozmiar pliku');

        // Częściowo wgrane zdjęcie
        $photo = array(
            'LeadFile' => array(
                'client_lead_id' => 3,
                'file_category_id' => 1,
                'file' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => 'UPLOAD_ERR_PARTIAL',
                    'size' => '200'
                )
            )
        );
        $return = $this->LeadFile->saveFile($photo);
        $this->assertEquals($return, false, 'Częściowo wgrane zdjęcie');

        // Dołączony link nie jest zdjęciem
        $photo = array(
            'LeadFile' => array(
                'client_lead_id' => 3,
                'file_category_id' => 1,
                'client_lead_id' => 'http://onet.pl/wirus.exe',
                'file' => null
            )
        );
        $return = $this->LeadFile->saveFile($photo);
        $this->assertEquals($return, false, 'Dołączony link nie jest zdjęciem');

        $photo = '';
        $return = $this->LeadFile->saveFile($photo);
        $this->assertEquals($return, false, 'brak danych do zapisu');

        // Prawidłowe dane
        $photo = array(
            'LeadFile' => array(
                'client_lead_id' => 3,
                'file' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->LeadFile->saveFile($photo);
        $this->assertEquals($return, false, 'brak kategori');
        // Prawidłowe dane
        $photo = array(
            'LeadFile' => array(
                'file_category_id' => 3,
                'file' => array(
                    'name' => 'agata.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php/php1h4j1o',
                    'error' => '0',
                    'size' => '200'
                )
            )
        );
        $return = $this->LeadFile->saveFile($photo);
        $this->assertEquals($return, false, 'brak clienta leadu');
    }

    /**
     * testGetFileList method
     *
     * @return void
     */
    public function testGetFileList()
    {
        $return = $this->LeadFile->getFileList();
        $this->assertEquals($return, false, 'brak clienta');
        
        $return = $this->LeadFile->getFileList(3);
        $this->assertEquals(empty($return), false, 'poprawne dane');
        
        $return = $this->LeadFile->getFileList(-1);
        $this->assertEquals(!empty($return), false, 'niepoprawny client');
    }
    
    
    
    /**
     * testGetFileList method
     *  pobieranie plikow danej kategori danego leadu
     * @return void
     */
    public function testGetFileCategoryList()
    {
        $client_lead_id = ''; // pusty
        $category = '';      // pusty
        $return = $this->LeadFile->getFileCategoryList($client_lead_id,$category);
        $this->assertEquals(is_array($return), false, 'przepuscza pusty lead_id i category');
        
        
        $client_lead_id = '3'; //wypelniony
        $category = '';   // pusty
        $return = $this->LeadFile->getFileCategoryList($client_lead_id,$category);
        $this->assertEquals(is_array($return), false, 'przepuszcza pusta kategorie');
        
        
        $client_lead_id = ''; //pusty
        $category = '3';   // wypelniony
        $return = $this->LeadFile->getFileCategoryList($client_lead_id,$category);
        $this->assertEquals(is_array($return), false, 'przepuszcza pusty lead_id');
        
        
        $client_lead_id = null; //null
        $category = '3';   // wypelniony
        $return = $this->LeadFile->getFileCategoryList($client_lead_id,$category);
        $this->assertEquals(is_array($return), false, 'przepuszcza  lead_id null');
        
        
        $client_lead_id = null; //null
        $category = null;   // null
        $return = $this->LeadFile->getFileCategoryList($client_lead_id,$category);
        $this->assertEquals(is_array($return), false, 'przepuszcza  nulle');
        
        
        $client_lead_id = '3'; //null
        $category = null;   // wypelniony
        $return = $this->LeadFile->getFileCategoryList($client_lead_id,$category);
        $this->assertEquals(is_array($return), false, 'przepuszcza  lead_id null');
        
        
        $client_lead_id = '3'; //wypelniony
        $category = '3';   // wypelniony
        $return = $this->LeadFile->getFileCategoryList($client_lead_id,$category);
        $this->assertEquals(is_array($return), true, 'nie znajduje plikow');
        $this->assertEquals(count($return), 1, 'zwraca nieprawidłową listę plików');
    }
    
    public function testGetFile(){
        
        $id = '';
        $return = $this->LeadFile->getFile($id);
        $this->assertEquals($return,false,'pusty parametr');
        
        $id = null;
        $return = $this->LeadFile->getFile($id);
        $this->assertEquals($return,false,'parametr null');
        
        
        $return = $this->LeadFile->getFile();
        $this->assertEquals($return,false,'brak parametru');
        
        $id = '2';
        $return = $this->LeadFile->getFile($id);
        $this->assertEquals(is_array($return),true,'prawidlowe dane');
    }

    
    public function testGetFileByName(){
        $name = '';
        $return = $this->LeadFile->getFileByName($name);
        $this->assertEquals($return,false,'pusty parametr');
        
        $name = null;
        $return = $this->LeadFile->getFileByName($name);
        $this->assertEquals($return,false,'parametr null');
        
        
        $return = $this->LeadFile->getFileByName();
        $this->assertEquals($return,false,'brak parametru');
        
        $name = 'plik 2';
        $return = $this->LeadFile->getFileByName($name);
        $this->assertEquals(is_array($return),true,'prawidlowe dane');
        
    }
    
    public function testDeleteFile(){
        $id = '';
        $return = $this->LeadFile->deleteFile($id);
        $this->assertEquals($return,false,'pusty parametr');
        
        $id = null;
        $return = $this->LeadFile->deleteFile($id);
        $this->assertEquals($return,false,'parametr null');
        
        
        $return = $this->LeadFile->deleteFile();
        $this->assertEquals($return,false,'brak parametru');
        
        $id = '2';
        $return = $this->LeadFile->deleteFile($id);
        $this->assertEquals($return,true,'prawidlowe dane');
        
    }

    public function testGetFileSelectedList(){
        
        $id = '';
        $return = $this->LeadFile->getFileSelectedList($id);
        $this->assertEquals($return,false,'pusty parametr');
        
        $id = null;
        $return = $this->LeadFile->getFileSelectedList($id);
        $this->assertEquals($return,false,'parametr null');
        
        
        $return = $this->LeadFile->getFileSelectedList();
        $this->assertEquals($return,false,'brak parametru');
        
        $id = array(1,2);
        $return = $this->LeadFile->getFileSelectedList($id);
        $this->assertEquals(is_array($return),true,'prawidlowe dane');
    }
    
    public function testGetFileFromLead(){
        $LeadId = '';
        $return = $this->LeadFile->getFilesFromLead($LeadId);
        $this->assertEquals($return,false,'pusty parametr');
        
        $LeadId = null;
        $return = $this->LeadFile->getFilesFromLead($LeadId);
        $this->assertEquals($return,false,'parametr null');
        
        
        $return = $this->LeadFile->getFilesFromLead();
        $this->assertEquals($return,false,'brak parametru');
        
        $LeadId = '3';
        $return = $this->LeadFile->getFilesFromLead($LeadId);
        $this->assertEquals(is_array($return),true,'prawidlowe dane');
        
        
    }
    
    public function testGenerateFileOptions(){
        $files = '';
        $return = $this->LeadFile->generateFileOptions($files);
        $this->assertEquals($return,false,'pusty parametr');
        
        $files = null;
        $return = $this->LeadFile->generateFileOptions($files);
        $this->assertEquals($return,false,'parametr null');
        
        
        $return = $this->LeadFile->generateFileOptions();
        $this->assertEquals($return,false,'brak parametru');
        
//        $files = array(
//            ''
//        );
//        $return = $this->LeadFile->generateFileOptions($files);
//        $this->assertEquals(is_array($return),true,'prawidlowe dane');
        
    }
}
