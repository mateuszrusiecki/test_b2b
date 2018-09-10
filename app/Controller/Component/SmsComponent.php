<?php
/*
 * http://www.smsapi.pl/rest
 * 
 * komponent wysyłajacy smsy
 */

class SmsComponent extends Component {
	
	public $params = array();
	
	function __construct() {
		
		$this->params = array(
			'username' => 'm.rudzik@feb.net.pl',
			'password' => '20cf0f3d23038c788f350599012d0ff5',
			'from' => null,
			//'from' => 'FEB',
			'eco' => 0,
			'encoding' => 'utf-8',
	   );
	}
	
	function sms_send2($data = null){
		if(empty($data)){
			return false;
		}

		$params = $this->params;
		$params['to'] = $data['to'];
		$params['message'] = $data['message'];
		
//		$url = 'https://ssl.smsapi.pl/sms.do';
//		$c = curl_init();
//        curl_setopt($c, CURLOPT_URL, $url);
//        curl_setopt($c, CURLOPT_POST, true);
//        curl_setopt($c, CURLOPT_POSTFIELDS, 'username='.$params['username'].'&password='.$params['password'].'&from='.$params['from'].'&eco='.$params['eco'].'&to='.$params['to'].'&message='.$params['message'].'&encoding='.$params['encoding']);
//        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
//        $content = curl_exec($c);
//        curl_close ($c); 
	echo 'SMSy chwilowo wstrzymane';
	}

	

}