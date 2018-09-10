<?php

/**
 * ProjectFile Test Case
 *
 */
class ProjectFileTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.project_file',
		'app.project_file_category',
		'app.client_project',
		'app.client_lead',
		'app.client',
		'app.userUser',
//		'app.user_client',
		'app.lead_category',
		'app.lead_status',
        'app.lead_log',
		'app.currency',
		'app.client_contact',
		'app.client_contact_client_lead',
		'app.profile',
		'app.client_project_log',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProjectFile = ClassRegistry::init('ProjectFile');
		$this->ProjectFileCategory = ClassRegistry::init('ProjectFileCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProjectFile);

		parent::tearDown();
	}

//         public function checkAgreement($project_id = null)
//         public function getFileList($client_project_id = null, $recursive = 0)
//        public function getFile($id = null)
//          public function saveFile($data = array())
//          public function uploadFile($data = array())
//          public function deleteFile($id = null,$name=null)
            
           
            
        public function testCheckAgreement(){
            $project_id = '';
            $return = $this->ProjectFile->checkAgreement($project_id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $project_id = null;
            $return = $this->ProjectFile->checkAgreement($project_id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $project_id = 2;
            $return = $this->ProjectFile->checkAgreement($project_id);
            $this->assertEquals($return,true,'prawidłowe dane');
            
            $project_id = 43875888;
            $return = $this->ProjectFile->checkAgreement($project_id);
            $this->assertEquals($return,false,'prawidłowe dane, nie istniejący projekt');
            
            $return = $this->ProjectFile->checkAgreement();
            $this->assertEquals($return,false,'brak paramteru');
        }
        
        public function testGetFileList(){

            $client_project_id = '';
            $return = $this->ProjectFile->getFileList($client_project_id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $client_project_id = null;
            $return = $this->ProjectFile->getFileList($client_project_id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $client_project_id = 1;
            $return = $this->ProjectFile->getFileList($client_project_id);
            $this->assertEquals(is_array($return),true,'prawidłowe dane');
            
            $client_project_id = 99988981;
            $return = $this->ProjectFile->getFileList($client_project_id);
            $this->assertEquals($return,false,'nieistniejący ');
            
            $return = $this->ProjectFile->getFileList();
            $this->assertEquals($return,false,'brak paramteru');
        }
        
        public function testGetLeadFileList(){ 
            
            $client_lead_id = 3;
            $recursive = 0;
            $return = $this->ProjectFile->getLeadFileList($client_lead_id,$recursive);
            $this->assertEquals(is_array($return),true,'prawidłowe dane');
            
            $client_lead_id = null;
            $recursive = 0;
            $return = $this->ProjectFile->getLeadFileList($client_lead_id,$recursive);
            $this->assertEquals($return,false,'pusty paramter');
            
            $client_lead_id = null;
            $recursive = 1;
            $return = $this->ProjectFile->getLeadFileList($client_lead_id,$recursive);
            $this->assertEquals($return,false,'pusty paramter 2');
            
            $client_lead_id = 3;
            $recursive = 1;
            $return = $this->ProjectFile->getLeadFileList($client_lead_id,$recursive);
            $this->assertEquals(is_array($return),true,'prawidłowe dane 2');
            
            $client_lead_id = 33333;
            $return = $this->ProjectFile->getLeadFileList($client_lead_id);
            $this->assertEquals($return,false,'nie istniejący wpis w bazie'); //funkcja zwraca pustą tablicę
            
        }
        
        public function testGetFileLeadProjectList(){
            $client_project_id = null;
            $client_lead_id = null;
            $return = $this->ProjectFile->getFileLeadProjectList($client_project_id,$client_lead_id);
            $this->assertEquals($return,false,'parametry null null');
            
            $client_project_id = '';
            $client_lead_id = '';
            $return = $this->ProjectFile->getFileLeadProjectList($client_project_id,$client_lead_id);
            $this->assertEquals($return,false,'puste paramtery');
            
            $client_project_id = 2;
            $client_lead_id = 3;
            $return = $this->ProjectFile->getFileLeadProjectList($client_project_id,$client_lead_id);
            $this->assertEquals(is_array($return),true,'prawidłowe dane');
            
            $client_project_id = 4522;
            $client_lead_id = 39004;
            $return = $this->ProjectFile->getFileLeadProjectList($client_project_id,$client_lead_id);
            $this->assertEquals($return,false,'nieistniejące paramtery'); 
        }
        
        
        public function testGetFile(){
            $id = '';
            $return = $this->ProjectFile->getFile($id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $id = null;
            $return = $this->ProjectFile->getFile($id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $id = 9;
            $return = $this->ProjectFile->getFile($id);
            $this->assertEquals(is_array($return),true,'prawidłowe dane');
            
            $id = 877777;
            $return = $this->ProjectFile->getFile($id);
            $this->assertEquals($return,false,'nieistniejący wpis w bazie');
            
            $return = $this->ProjectFile->getFile();
            $this->assertEquals($return,false,'brak paramteru');
        }
   
        
    public function testSaveFileRows(){
        
        $return = $this->ProjectFile->saveFileRows();
        $this->assertEquals($return,false,'brak parametru');
        
        $project_id='';
        $user_id='';
        $data='';
        $return = $this->ProjectFile->saveFileRows($project_id, $user_id,$data);
        $this->assertEquals($return,false,'puste');
//        
        $project_id=null;
        $user_id= null;
        $data=null;
        $return = $this->ProjectFile->saveFileRows($project_id, $user_id,$data);
        $this->assertEquals($return,false,'parametry null null null');
//        
        // @todo do przemyslenia funkcjonalnosc generująca sturkturę $data(strasznie to skomplikowane i pomieszane)
        $project_id = '5';
        $user_id    = '3a38ee92-6934-102d-9f80-579a023712b2';
        //dane są odbierane z angulara w formacie json, konwertowane do tablicy php i przekazywane do tej funkcji
        $data[2][0] = array(
			'id' => '65',
			'client_project_id' => NULL,
			'client_lead_id' => null,
			'project_file_category_id' => '2',
			'client_domain_id' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'file' => '3hca4_3.png',
			'section_id' => NULL,
			'parent_id' => NULL,
			'client_available' => NULL,
			'desc' => NULL,
			'created' => '2015-06-16 14:18:43',
			'modified' => '2015-06-16 14:18:43'
		);
        $return = $this->ProjectFile->saveFileRows($project_id, $user_id,$data);
        $this->assertEquals(is_array($return),true,'poprawne dane');
        
        
        $user_id    = '3a38ee92-6934-102d-9f80-579a023712b2';
        //dane są odbierane z angulara w formacie json, konwertowane do tablicy php i przekazywane do tej funkcji
        $data[2][0] = array(
			'id' => '65',
			'client_project_id' => NULL,
			'client_lead_id' => null,
			'project_file_category_id' => '2',
			'client_domain_id' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'file' => '3hca4_3.png',
			'section_id' => NULL,
			'parent_id' => NULL,
			'client_available' => NULL,
			'desc' => NULL,
            'delete' => true,
			'created' => '2015-06-16 14:18:43',
			'modified' => '2015-06-16 14:18:43'
		);
        $return = $this->ProjectFile->saveFileRows($project_id, $user_id,$data);
        $this->assertEquals(is_array($return),true,'usunięcie pliku nie należącego do projektu ani do leada');
        
        $data[2][0] = array(
			'client_project_id' => NULL,
			'client_lead_id' => null,
			'project_file_category_id' => '2',
			'client_domain_id' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'file' => '3hca4_3.png',
			'section_id' => NULL,
			'parent_id' => NULL,
			'client_available' => NULL,
			'desc' => NULL,
			'created' => '2015-06-16 14:18:43',
			'modified' => '2015-06-16 14:18:43'
		);
        $return = $this->ProjectFile->saveFileRows($project_id, $user_id,$data);
        $this->assertEquals(is_array($return),true,'poprawne dane');
        
        $data[8][0] = array(
			'client_project_id' => 5,
			'client_lead_id' => null,
			'project_file_category_id' => '8',
			'client_domain_id' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'file' => '3hca4_3.png',
			'section_id' => NULL,
			'parent_id' => NULL,
			'client_available' => NULL,
			'desc' => NULL,
			'created' => '2015-06-16 14:18:43',
			'modified' => '2015-06-16 14:18:43'
		);
        $return = $this->ProjectFile->saveFileRows($project_id, $user_id,$data);
        $this->assertEquals(is_array($return),true,'poprawne dane');

    }
    

    public function testgetFilesById(){

        $return = $this->ProjectFile->getFilesById();
        $this->assertEquals($return,false,'brak parametru');
        
        $id=null;
        $return = $this->ProjectFile->getFilesById($id);
        $this->assertEquals($return,false,'parametr null');
        
        $id='';
        $return = $this->ProjectFile->getFilesById($id);
        $this->assertEquals($return,false,'parametr pusty');
        
        $id=345999;
        $return = $this->ProjectFile->getFilesById($id);
        $this->assertEquals($return,false,'nieistniejące id'); 
        
        $id=12;
        $return = $this->ProjectFile->getFilesById($id);
        $this->assertEquals(is_array($return),true,'poprawne dane'); //zwraca pustą tablicę
    }


    public function testDeleteFile(){
            $return = $this->ProjectFile->deleteFile();
            $this->assertEquals($return,false,'brak paramterów');
            
            $id = '';
            $return = $this->ProjectFile->deleteFile($id);
            $this->assertEquals($return,false,'pusty paramter');
            
            $id = 9;
            $return = $this->ProjectFile->deleteFile($id);
            $this->assertEquals($return,false,'Brak typu');
            
            $id = 9878878;
            $type = 'lead';
            $return = $this->ProjectFile->deleteFile($id,$type);
            $this->assertEquals($return,false,'nieistniejący id');
            
            $id = 45;
            $type = 'lead';
            $return = $this->ProjectFile->deleteFile($id,$type);
            $this->assertEquals(is_array($return),true,'prawidłowe dane');
            
            $id = 46;
            $type = 'project';
            $return = $this->ProjectFile->deleteFile($id,$type);
            $this->assertEquals(is_array($return),true,'prawidłowe dane');
            
            $id = 69;
            $type = 'force';
            $return = $this->ProjectFile->deleteFile($id,$type);
            $this->assertEquals($return,true,'usunięcie force');

//            $return = $this->ProjectFile->deleteFile();
//            $this->assertEquals($return,false,'brak paramteru');
    }
    
    public function testListProjectFile(){
        $return = $this->ProjectFile->listProjectFile();
        $this->assertEquals(is_array($return),true,'prawidłowe dane');
    }
    
    public function testListClientProjectFile(){
        $return = $this->ProjectFile->listClientProjectFile();
        $this->assertEquals($return,false,'brak user_id');
        
        $user_id = '3a38ee92-6934-102d-9f80-579a023712b2';
        $return = $this->ProjectFile->listClientProjectFile($user_id);
        $this->assertEquals(is_array($return),true,'prawidłowe dane');
        
        $user_id = '99999992-6934-102d-9f80-579a023712b2';
        $return = $this->ProjectFile->listClientProjectFile($user_id);
        $this->assertEquals($return,false,'nieistniejące user_id');
    }
    
    public function testBase2file(){
        $file['data'] = '/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAIBAQIBAQICAgICAgICAwUDAwMDAwYEBAMFBwYHBwcGBwcICQsJCAgKCAcHCg0KCgsMDAwMBwkODw0MDgsMDAz/2w'
                . 'BDAQICAgMDAwYDAwYMCAcIDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAz/wAARCAAdADEDASIAAhEBAxEB/8QAHwAAAQUBAQE'
                . 'BAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3'
                . 'ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6e'
                . 'rx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVY'
                . 'nLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbH'
                . 'yMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD1T4b/APBYHwnLLd6fH4+0rUrzK3Ub3izQxpCZEUr5kqqm4Bj8vXGTjANem6d/wWS+C8Wsf2fq'
                . 'fxN8M6fMs8kLyQs11BGB0JlRWQ5PGQcD1r8KbX4fjxvcMLOPVVkb5dsdg0i/oBiuz8Ofs62vh3S4pptQkfWpJ3SWzurLYtkgCFSVLFi7bt3YYx1ySPCzCll9ODqTST8l/wAA/S'
                . 'uE8tzzN8bDL8NaV9by6JbvdN/qfvb4T/bb+DfxO0z7TpHxm+HV0m4qy/8ACQ20UiN/tRvIHX8VqHxf+0j4T0uwmm07xx4D1JoVOdmu2i7CPUb+fpX5gfsMfsgeDvifb+NrzxNo'
                . 'a+KLLR0t3hEAsrN7dZJjGMm444yOnAANa37T/wCxJ4F8Ifst6Rr3hnww3hu8fUobY3101jcbi0LyEbYAHUnABBwQRyOleRSp0PZfWb+72sv+HPsMRkuY0M/jw4pL2knFJr+9Hm'
                . '2u1/5MfbGp/tTeA/FWkRx+IPHXwztNwV5IW8RWavExGT8puMgjp0yKz7b4q/B2CMeR48+GfnAggHxJZrI/pgm4I/MivyX1T9nz/hN1u4bXxFHZaoqp/Z7tH5MV3KzonlSYOVLb'
                . 'jtIzhgBjDHHL6r+xv8VbONwun3lx5R2hoVmlU468qpz+Ga9jA4rCVYc0KnL5HzPGfD+a5Hj/AKpjKSqNq6lvdbd3bVP7j9rP+Fj+Df8AoPeBf/Cisv8A47RX4ef8MtfE/wD6Au'
                . 'q/+AV1/wDG6K7uXD/8/PxR8f8AWsX/AM+T9N9O0XS9EjVrfw/BK8Z3ArDuI/P+nrXwb+3f8Dfjn4l/aH8Vaz4A8H6tJoHiO3s2Sa0aJGtpIoFicKpcFS2zkgenNfpFplnsOM9+u'
                . 'P8APrXRWGmKbeRmbd5eOCOucV8bRxvsJc3KpX6PVH10IVrqVCpKnJX1i7PVNPXzTPxO8N/suftaafdeZY6T8Q7VpuCU1VYWb0/5airOpfspftdaxbJBc6X4/njhOQk+txkA9OAZv'
                . 'rX7aRxq15GirtwckkA7uKS5sobS3VhGjMqh2Yj5nPTr/U5r0I8S1bcqpxt6HnzyOTq+3lXm5/zc2unnvsfkZ+zd+yf+0lYfFDwUfFXh3UoPDmj+JLHWL27vNQtpJBFbTLKY8LKXY'
                . 'Ep0wecdBmv0ovtKt/EcTNc6Jbyeoe3Vufxr0LUbFZLdpF+UxgHAAIOfrWPdqkUwwvVimc/rXDiMc8RJPkUbdtD0JRrb16sqjsleTu7LZemrOA/4Vnon/Qs2X/gKv+FFdf5w/u/r'
                . 'RWfOzPlP/9k=';
        $file['mimetype'] = 'image/jpg';

        $return = $this->ProjectFile->base2file($file);
        $this->assertEquals($return,true,'prawidłowe dane');
        
        $return = $this->ProjectFile->base2file();
        $this->assertEquals($return,false,'brak danych');
        
    }
    
    public function testRev_save_file(){
                
        $saveData['ProjectFile']['client_project_id'] = 5;
        $saveData['ProjectFile']['project_file_category_id'] = 1;
        $saveData['ProjectFile']['client_domain_id'] = 4;
        $saveData['ProjectFile']['user_id'] = '3a38ee92-6934-102d-9f80-579a023712b2';
        $saveData['ProjectFile']['file'] = 'alterfun.pl_google.pl__swiat___2015.06.01-2015.06.30__2.pdf';
        $saveData['ProjectFile']['section_id'] = 2; // SEO/SEM
        $saveData['ProjectFile']['desc'] = 'raport'; // SEO/SEM
        
        $return = $this->ProjectFile->rev_save_file($saveData);
        $this->assertEquals($return['success'],true,'prawidłowe dane');
        
        $saveData['ProjectFile']['client_lead_id'] = 2;
        $_SESSION['Auth']['User']['id'] = '3a38ee92-6934-102d-9f80-579a023712b2';
        $return = $this->ProjectFile->rev_save_file($saveData);
        $this->assertEquals($return['success'],true,'prawidłowe dane2');
        
        $return = $this->ProjectFile->rev_save_file();
        $this->assertEquals($return['success'],false,'brak danych');
        
        $saveData['ProjectFile']['client_lead_id'] = null;
        $saveData['ProjectFile']['tmp_id'] = 66;
        $return = $this->ProjectFile->rev_save_file($saveData);
        $this->assertEquals($return['success'],true,'update pliku ok');
        
        $saveData['ProjectFile']['tmp_id'] = 66;
        $saveData['ProjectFile']['client_lead_id'] = 2;
        $_SESSION['Auth']['User']['id'] = '3a38ee92-6934-102d-9f80-579a023712b2';
        $return = $this->ProjectFile->rev_save_file($saveData);
        $this->assertEquals($return['success'],true,'update pliku ok 2');
        
        $saveData['ProjectFile']['client_project_id'] = null;
        $saveData['ProjectFile']['project_file_category_id'] = null;
        $saveData['ProjectFile']['client_domain_id'] = null;
        $return = $this->ProjectFile->rev_save_file($saveData);
        $this->assertEquals($return['success'],false,'nieprawidlowe dane');
        
    }
    
    public function testChangeClientAccesToFile(){
        $return = $this->ProjectFile->changeClientAccesToFile();
        $this->assertEquals($return['success'],false,'brak danych');
        
        $file_id = null; $client_available = null;
        $return = $this->ProjectFile->changeClientAccesToFile($file_id,$client_available);
        $this->assertEquals($return,false,'nieprawidlowe dane');
        
        $file_id = 66; 
        $return = $this->ProjectFile->changeClientAccesToFile($file_id,$client_available);
        $this->assertEquals(is_array($return),true,'prawidłowe dane, brak $client_available(niewymagane)');
        
        $file_id = 66; 
        $client_available = 0;
        $return = $this->ProjectFile->changeClientAccesToFile($file_id,$client_available);
        $this->assertEquals(is_array($return),true,'prawidłowe dane 1');
        
        $file_id = 66; 
        $client_available = 1;
        $return = $this->ProjectFile->changeClientAccesToFile($file_id,$client_available);
        $this->assertEquals(is_array($return),true,'prawidłowe dane 2');
        
        $file_id = 66888786; 
        $client_available = 1;
        $return = $this->ProjectFile->changeClientAccesToFile($file_id,$client_available);
        $this->assertEquals($return,false,'nieistniejace id');
    }
}
