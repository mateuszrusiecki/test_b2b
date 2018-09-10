<?php
App::import('Vendor','Recaptcha.recaptcha'.DS.'recaptchalib');
/**
 * CaptchaToolHelper
 * 
 * CaptchaComponent and CaptchaToolHelper allow the easy use of reCaptcha.net's captcha library.
 * @link http://recaptcha.net
 *
 * @see CaptchaComponent
 * @author Jason Burgess <jason@holostek.net>
 * @version 0.8.0
 * @copyright (c) 2009 Jason Burgess
 * @license MIT/X
 */
class CaptchaToolHelper  extends Helper {
	/**
	 * Display a reCapthca input
	 * 
	 * @since 0.1.0
	 * @access public
	 */
	var $helpers = array("Form", "Html");
     
	public function show($model = null) {

		if (!Configure::read('Recaptcha.public_key')) {
			return $this->output(__('No public key was set for reCaptcha.'));
		}
        
		$code = '';
		if (is_array(Configure::read('Recaptcha.configuration'))) {
			$code = '<script type="text/javascript">var RecaptchaOptions = ' . json_encode(Configure::read('Recaptcha.configuration')) . ';</script>';
		}

		$code .= recaptcha_get_html(Configure::read('Recaptcha.public_key'));
		$after = $model?$this->Form->hidden($model.'.recaptcha').$this->Form->error($model.'.recaptcha'):'';
		
		return $this->output($code).$after;
	}
    
    public function init($model = null) {
        $this->Html->script('http://www.google.com/recaptcha/api/js/recaptcha_ajax.js', array('inline' => false));
        
        $code = '<div id="recaptcha_div"></div>';
        
        $code .= $this->Form->error($model.'.recaptcha_response_field');

        $code .= $this->Form->hidden($model.'.recaptcha_response_field');
        
        $config = Configure::read('Recaptcha.public_key');
        $c = json_encode(Configure::read('Recaptcha.configuration'));

        $code .= "<script type='text/javascript'>$(function(){Recaptcha.create('{$config}', 'recaptcha_div', {$c});})</script>";
        
        return $code;
    }
    
}
?>