<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Searchers Controller
 *
 * @property Searcher $Searcher
 */
class ThemeController extends AppController {

    /**
     * Nazwa layoutu
     */
    public $layout = 'admin';

    function admin_index(){
        $dir = new Folder(APP.'View'.DS.'Themed');
        $themeds = $dir->read(true);
        foreach($themeds[0] as $key =>$theme){
            $themes[$key]['info'] = json_decode(file_get_contents(APP.'View'.DS.'Themed'.DS.$theme.DS.'webroot'.DS.'info.json'), true);      
            $themes[$key]['id'] = $theme;
        }
        $this->set(compact('themes'));
    }
    
    function admin_activate($value=''){
        $this->loadModel('Setting.Setting');
        $this->Setting->recursive = -1;
        $setting = $this->Setting->findByKey('App.themed');
        @$data['Setting']['id'] = $setting['Setting']['id'];
        $data['Setting']['value'] = $value;
        $data['Setting']['key'] = 'App.themed';
        $this->Setting->save($data);
        $this->redirect(array('action'=>'index'));
    }
    function admin_user_activate($value='',$id=null){
        $this->loadModel('User.User');
        $data['User']['id'] = $id?$id:$this->Session->read('Auth.User.id');
        $data['User']['theme'] = $value;
        $this->User->save($data);
        $id?'':$this->Session->write('Auth.User.themed',$value);
        $this->redirect(array('action'=>'index'));
    }


}