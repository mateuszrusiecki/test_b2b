<?php

App::uses('HttpSocket', 'Network/Http');

define('EMAIL_ERROR', 1);
define('ADMIN_LOGIN_ERROR', 2);
define('PROJECT_NAME_ERROR', 3);
define('SERVER_NAME_ERROR', 4);
define('DOMAIN_ERROR', 5);

/**
 * Klasa do API z Grindstone-em
 * @version 1.0
 * @author Sławomir Jach
 *
 */
class GrindstoneApi {
    /*
     * ip/url to direct admin panel
     */

    private $adress = null;

    /*
     *  direct admin port
     */
    private $port = null;

    /*
     * socket to direct admin
     */
    private $socket = null;

    public function __construct($adress, $user = null, $pass = null) {
        $this->adress = $adress;

        $this->socket = new HttpSocket();
        $this->socket->responseClass = 'GrindstoneResponse';
//        $this->socket->configAuth('Basic', $user, $pass);

    }

    public function query($commend, $data = array()) {
        
        $response = $this->socket->get($this->adress . $commend, $data);

        return $response->body();
    }

    /**
     * Funkcja zwracajaca tablice userow w Direct Admin
     * @access public
     * @return array users list<br><br>
     */
    public function getUserList() {
        $response = $this->query('/');
        preg_match_all("/href=\"([^\"\/][^\"]*)\/\"/", $response, $matches);	

        $results = isSet($matches[1]) ? $matches[1] : array();
        return $results;   
    }
    
    public function getLastUserFile($user) {
		$response = $this->query($user.'/');
			
        preg_match_all("/href=\"([^\"\/][^\"]*\\)%20([0-9\%-]+)[^\"]*[^\"\/])\"/", $response, $matches);	
        
        $matches[2] = preg_replace(array('/\%20/', '/-(?=[0-9]{2}$)/'), array(' ', ':'), $matches[2]);        
        $out = array();
        
        if (!empty($matches[0])) {
            $maxTime = 0;
            foreach($matches[0] as $k => $ret) {
                
                $time = strtotime($matches[2][$k]);
                
                if ($time > $maxTime) {
                    $out = array(
                        'name' => $matches[1][$k],
                        'date' => $matches[2][$k],
                        'time' => strtotime($matches[2][$k])
                    );
                    $maxTime = $time;
                }
                
                
            }   
        }        
        return $out;
    }
    
}
