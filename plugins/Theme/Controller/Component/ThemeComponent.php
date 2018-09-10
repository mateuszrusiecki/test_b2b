<?php
class ThemeComponent  extends Component{

    function initialize(Controller $controller){
        $this->controller = $controller;
        $this->activeTheme();
    }
	function activeTheme(){
	   $user = $this->controller->Session->read('Auth.User');
	   if(!isset($user['themed']) and $user['id']){
	       $this->controller->loadModel('User.User');
	       $this->controller->User->id = $user['id'];
	       $themed = $this->controller->User->field('themed');
	       $this->controller->Session->write('Auth.User.themed',$themed);
	   }
	   $userThemed = $this->controller->Session->read('Auth.User.themed');
	   $settingThemed = Configure::read('App.themed');
	   $this->controller->theme =  $userThemed?$userThemed:$settingThemed;
	}
}
?>