<?php
/**
 * This is email configuration file.
 *
 * Use it to configure email transports of Cake.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.config
 * @since         CakePHP(tm) v 2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * In this file you set up your send email details.
 *
 * @package       cake.config
 */
/**
 * Email configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * transport => The name of a supported transport; valid options are as follows:
 *		Mail 		- Send using PHP mail function
 *		Smtp		- Send using SMTP
 *
 * You can add custom transports (or override existing transports) by adding the
 * appropriate file to app/Network/Email.  Transports should be named 'YourTransport.php',
 * where 'Your' is the name of the transport.
 *
 * from =>
 * The origin email. See CakeEmail::from() about the valid values
 *
 */
class EmailConfig {

	public $default = array(
		'transport' => 'Mail',
		'from' => 'm.rusiecki@febdev.pl'
	);

    public $public = array(
        'transport' => 'Mail',
        'emailFormat' => 'both',
    );        
    
    
	public $smtp = array(
		'transport' => 'Smtp',
		'from' => array('m.rusiecki@febdev.pl' => 'Test Mail name sender'),    
		'host' => 'mail.febdev.pl',
		'port' => 25,
		'timeout' => 30,
		'username' => 'crm@febdev.pl',
		'password' => 'i2aWQsj0',
		//'client' => null
	);

	public $fast = array(
		'from' => 'm.rusiecki@febdev.pl',
		'sender' => null,
		'to' => null,
		'cc' => null,
		'bcc' => null,
		'replyTo' => null,
		'readReceipt' => null,
		'returnPath' => null,
		'messageId' => true,
		'subject' => null,
		'message' => null,
		'headers' => null,
		'viewRender' => null,
		'template' => false,
		'layout' => false,
		'viewVars' => null,
		'attachments' => null,
		'emailFormat' => null,
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null
	);
    
    public function __construct() {

        $this->public['attachments'] = array(
            'logo.png' => array(
                'file' => APP.'webroot'.DS.'img'.DS.'_logo_email.png',
                'mimetype' => 'image/png',
                'contentId' => 'logo.png'
            )
        );
        $this->public['bcc'] = array(
            'test@feb.net.pl'
        );
        
    }
}