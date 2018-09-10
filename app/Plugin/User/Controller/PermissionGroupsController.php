<?php
App::uses('AppController', 'Controller');
/**
 * PermissionGroups Controller
 *
 * @property PermissionGroup $PermissionGroup
 */
class PermissionGroupsController extends AppController {

    
    /**
     * Nazwa layoutu
     */
//    public $layout = 'admin';

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array();

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array();

    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }

    /**
    * Akcja wyświetlająca listę obiektów
    * 
    * @return void
    */
	public function admin_index() {
        //Dla końcowego użytkownika
        $this->helpers[] = 'FebTime';
		$this->PermissionGroup->recursive = 0;
		$this->set('permissionGroups', $this->paginate());
	}

    public function admin_get_permissions() {
        $this->layout = 'ajax';
        $this->PermissionGroup->Permission->recursive = -1;
        $params['conditions']['Permission.permission_group_id'] = $this->request->data['PermissionGroup']['id'];
        $permissions = $this->PermissionGroup->Permission->find('all', $params);
        $this->set(compact('permissions'));
    }
    
    /**
    * Akcja dodająca obiekt
    *
    * @return void
    */
	public function admin_add($permission_category_id = null) {
        $this->layout = 'ajax';
		$this->PermissionGroup->PermissionCategory->id = $permission_category_id;
		if (!$this->PermissionGroup->PermissionCategory->exists()) {
			throw new NotFoundException(__d('cms', 'Brak kategorii.'));
		}
        //Dla developera
		if ($this->request->is('post')) {
			$this->PermissionGroup->create();
			if ($this->PermissionGroup->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('controller' => 'permission_groups', 'action' => 'summary'));
            } else {
                $this->Session->setFlash(__d('cms', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.'), 'flash/error');
            }
		}

		$permissionCategories = $this->PermissionGroup->PermissionCategory->find('list');
		$this->set(compact('permissionCategories', 'permission_category_id'));
        $this->render('/Elements/PermissionGroups/addForm');
	}

    /**
    * Akcja edytująca obiekt
    *
    * @param string $id
    * @return void
    */
	public function admin_edit($id = null) {
        $this->layout = 'ajax';
        //Dla developera
		$this->PermissionGroup->id = $id;
		if (!$this->PermissionGroup->exists()) {
			throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PermissionGroup->save($this->request->data)) {
                $this->Session->setFlash(__d('cms', 'Poprawnie zapisano.'));
                $this->redirect(array('controller' => 'permission_groups', 'action' => 'summary'));
			} else {
                $this->Session->setFlash(__d('admin', 'Wystąpił błąd podczas zapisu, popraw formularz i spróbuj ponownie.', 'flash/error'));
			}
		} else {
			$this->request->data = $this->PermissionGroup->read(null, $id);
		}
		$permissionCategories = $this->PermissionGroup->PermissionCategory->find('list');
		$this->set(compact('permissionCategories'));
        $this->render('/Elements/PermissionGroups/editForm');
	}

    /**
    * Akcja usuwająca obiekt
    *
    * @param string $id
    * @return void
    */
	public function admin_delete($id = null) {
        //Dla developera
        $this->layout = 'ajax';
//		if (!$this->request->is('ajax')) {
//			throw new MethodNotAllowedException();
//		}
		$this->PermissionGroup->id = $id;
		if (!$this->PermissionGroup->exists()) {
			throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
		}
		if ($this->PermissionGroup->delete()) {

		}
		$this->render(false);
	}
    
    /**
    * Główny panel kontrolny Developera
    *
    * @param string $id
    * @return void
    */
	public function admin_summary($id = null) {
        //Dla developera
        $title = 'Konfigurator grup uprawnień';
        $subtitle = 'Konfigurator grup uprawnień';
        
        $this->PermissionGroup->PermissionCategory->recursive = 1;
        $permissionCategories = $this->PermissionGroup->PermissionCategory->find('all');
              
        $this->set(compact('permissionCategories','title', 'subtitle'));
        
	}   
    
    /**
     * Akcja aktualizuje wszystkie uprawnienia dla grup obecnie już przydzielonych 
     */
    public function admin_fix() {
        
        //Tworzę tranzakcję
        $dataSource = $this->PermissionGroup->Permission->RequestersPermission->getDataSource();
        $dataSource->begin($this->PermissionGroup->Permission->RequestersPermission);
        
        //Wyciągam wszystkie grupy w raz z ich uprawnieniami
        $params['fields'] = array('Permission.id', 'Permission.permission_group_id');
        $permissionGroups = $this->PermissionGroup->Permission->find('list', $params);

//        //Czyszczę całą tabelę
        if (!$this->PermissionGroup->Permission->RequestersPermission->deleteAll(array('1' => '1'), false)) {
            $dataSource->rollback($this->PermissionGroup->Permission->RequestersPermission);
            throw new ErrorException('Błąd podczas czyszczenia tabeli modelu RequestersPermission');
        }
            
        $this->loadModel('User.User');

        $this->User->recursive = -1;
        $allUsers = $this->User->find('all');
                
        foreach($allUsers as $user) {
            $toSave = array();
            if (!empty($user['PermissionGroup']['PermissionGroup'])) {
                $toSave['RequestersPermission']['model'] = 'User';
                $toSave['RequestersPermission']['row_id'] = $user['User']['id'];
                foreach ($permissionGroups as $permissionId => $permissionGroupId) {
                    if (in_array($permissionGroupId, $user['PermissionGroup']['PermissionGroup'])) {
                        $toSave['RequestersPermission']['permission_id'] = $permissionId;
                        $this->PermissionGroup->Permission->RequestersPermission->create();
                        if (!$this->PermissionGroup->Permission->RequestersPermission->save($toSave)) {
                            $dataSource->rollback($this->PermissionGroup->Permission->RequestersPermission);
                            throw new ErrorException(__d('cms', 'Krytyczny błąd podczas zapisywania uprawnień'));
                        }
                    }
                }
            }
        }
        
        $this->loadModel('User.Group');
        $this->Group->recursive = -1;
        $allGroup = $this->Group->find('all');
        
        foreach($allGroup as $group) {
            $toSave = array();
            if (!empty($group['PermissionGroup']['PermissionGroup'])) {
                $toSave['RequestersPermission']['model'] = 'Group';
                $toSave['RequestersPermission']['row_id'] = $group['Group']['id'];
                foreach ($permissionGroups as $permissionId => $permissionGroupId) {
                    if (in_array($permissionGroupId, $group['PermissionGroup']['PermissionGroup'])) {
                        $toSave['RequestersPermission']['permission_id'] = $permissionId;;
                        $this->PermissionGroup->Permission->RequestersPermission->create();
                        if (!$this->PermissionGroup->Permission->RequestersPermission->save($toSave)) {
                            $dataSource->rollback($this->PermissionGroup->Permission->RequestersPermission);
                            throw new ErrorException(__d('cms', 'Krytyczny błąd podczas zapisywania uprawnień'));
                        }
                    }
                }
            }
        }
        
        //Commituję tranzakcję
        $dataSource->commit($this->PermissionGroup->Permission->RequestersPermission);
        $this->Session->setFlash(__d('cms', 'Tabela uprawnień została pomyślnie przeładowana'));
        $this->redirect('summary');
        $this->render(false);
        
    }
    
    /**
     * Akcja exportująca tabelę kategorii uprawnień, grup uprawnień, grup użytkowników wraz z przywiązanymi do nich uprawnieniami
     */
    public function admin_export() {
        $this->layout = false;

        $permissions = $this->PermissionGroup->Permission->find("all", array(
            'recursive' => -1,
        ));
        
        $permissions_categories = $this->PermissionGroup->PermissionCategory->find("all", array(
            'recursive' => -1,
        ));
        
        $permission_groups = $this->PermissionGroup->find("all", array(
            'recursive' => -1,
        ));

        $requesters_permissions = $this->PermissionGroup->Permission->User->RequestersPermission->find("all", array(
            'recursive' => -1,
            'conditions' => array('RequestersPermission.model' => 'Group')
        ));

        $user_groups = $this->PermissionGroup->Permission->Group->find("all", array(
            'recursive' => -1,
        ));
        

        $permissions_data = array(
          'user_groups' => $user_groups,
          'permissions' => $permissions,
          'permissions_categories' => $permissions_categories,
          'requesters_permissions' => $requesters_permissions,
          'permission_groups' => $permission_groups,  
        );
        
        $json_data = json_encode($permissions_data);
//        debug($permissions_data);
        
 //       $file = "data.json";
  //      file_put_contents($file, $json_data);    
        $this->set("json_data", $json_data);
    }
    
    /**
     * Akcja importująca tabelę kategorii uprawnień, grup uprawnień, grup użytkowników wraz z przywiązanymi do nich uprawnieniami
     */
    public function admin_import() {
        
        $title = 'Import uprawnień';
        $subtitle = 'Import uprawnień';
        
        set_time_limit(500);
         if (!empty($this->data['PermissionsImport']['json']['tmp_name'])) {
            if (empty($this->data['PermissionsImport']['json']['size'])) {
                $this->Session->setFlash(__d('cms', 'Nie wysłano pliku, lub plik jest pusty.'));
                $this->redirect('import');
            }
            if (!empty($this->data['PermissionsImport']['json']['error'])) {
                $this->Session->setFlash(__d('cms', 'Błąd podczas uploadu pliku.'));
                $this->redirect('import');
            }
            $_SESSION['permissionsImportFile'] = APP . 'tmp' . DS . 'cache' . DS . uniqid() . '.json';
            if (!move_uploaded_file($this->data['PermissionsImport']['json']['tmp_name'], $_SESSION['permissionsImportFile'])) {
                unset($_SESSION['permissionsImportFile']);
                $this->Session->setFlash(__d('cms', 'Błąd podczas dostępu do pliku.'));
                $this->redirect('import');
            }
        }
        else {
            unset($_SESSION['permissionsImportFile']);
        }
        
        if (!empty($_SESSION['permissionsImportFile'])) {
            $json_data = file_get_contents($_SESSION['permissionsImportFile']);
            
            $permissions = json_decode($json_data, true);       
   
            $db_user_groups = $this->PermissionGroup->Permission->Group->find("list", array(
                'recursive' => -1,
                'fields' => array('Group.id')
            ));
            
            // Sprawdzenie czy w pliku importuje nie brakuje grupy, która jest już w bazie danych
            $groups_ids = array();
            foreach($permissions['user_groups'] as $group) {     
                $groups_ids[] = $group['Group']['id'];
            }
            foreach($db_user_groups as $group_id) {
                if (!in_array($group_id, $groups_ids)) {
                    $this->Session->setFlash(__d('cms', 'Nie udało się zaimportować danych. W pliku importu brakuje grupy, która znajduje się w bazie danych.'));
                    $this->redirect('import');
                }
            }
                  
            $show_create_table =  $this->PermissionGroup->Permission->User->RequestersPermission->query("SHOW CREATE TABLE `user_requesters_permissions`");     
            $out = $show_create_table[0][0]['Create Table'];
            $startsAt = strpos($out, "CONSTRAINT `") + strlen("CONSTRAINT `");
            $endsAt = strpos($out, "` FOREIGN", $startsAt);
            $foreign_key = substr($out, $startsAt, $endsAt - $startsAt);
                        
            $requesters_permissions_drop_fk = "ALTER TABLE `user_requesters_permissions` DROP FOREIGN KEY `".$foreign_key."`";
            $requesters_permissions_add_fk = "ALTER TABLE `user_requesters_permissions` ADD CONSTRAINT `".$foreign_key."` FOREIGN KEY (`permission_id`) REFERENCES `user_permissions` (`id`);";

            $dataSource = $this->PermissionGroup->getDataSource();
            $dataSource->begin();
            try {
                if (!$this->PermissionGroup->Permission->Group->saveMany($permissions['user_groups'])) {
                    throw new Exception(1);
                }
                if (!$this->PermissionGroup->PermissionCategory->query("TRUNCATE TABLE `user_permission_categories`") ) {
                    throw new Exception(2);
                }
                if (!$this->PermissionGroup->PermissionCategory->saveMany($permissions['permissions_categories'])) {
                    throw new Exception(3);
                }
                if (!$this->PermissionGroup->query("TRUNCATE TABLE `user_permission_groups`") ) {
                    throw new Exception(4);
                }
                if (!$this->PermissionGroup->saveMany($permissions['permission_groups'])) {
                    throw new Exception(5);
                }
                $this->PermissionGroup->Permission->User->RequestersPermission->query($requesters_permissions_drop_fk);
                $this->PermissionGroup->Permission->User->RequestersPermission->query("DELETE FROM `user_requesters_permissions` WHERE `model` LIKE 'Group'");

                if (!$this->PermissionGroup->Permission->User->RequestersPermission->saveMany($permissions['requesters_permissions'])) { 
                    throw new Exception(7);
                }
                if (!$this->PermissionGroup->Permission->query("TRUNCATE TABLE `user_permissions`") ) {
                    throw new Exception(9);
                }
                if (!$this->PermissionGroup->Permission->saveMany($permissions['permissions'])) { 
                    throw new Exception(10);
                }         
                $this->PermissionGroup->Permission->User->RequestersPermission->query($requesters_permissions_add_fk);
                
                $dataSource->commit();
                $this->Session->setFlash(__d('cms', 'Ustawienia uprawnień zostały zaimportowane.'));
                $this->redirect('import');
  
            }
            catch(Exception $e) 
            {
                $dataSource->rollback();
                $this->Session->setFlash(__d('cms', 'Nie udało się zaimportować uprawnień.'.$e));   
                $this->redirect('import');  
            }
                  
             $this->Session->setFlash(__d('cms', 'Jeśli to widzisz to coś poszło nie tak ;-)'));     
        }
        
        
        $this->set(compact('title', 'subtitle'));
    }
    
}
