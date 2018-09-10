<?php

App::uses('LeadLog', 'Model');
App::uses('User', 'Model');
App::uses('ClientProjectLog', 'Model');
class LogMailComponent extends Component {
	
	public $components = array('Session');
	
	
    /*
     * Metoda pobiera maile ze skrzynki crm@febdev.pl i umieszcza ja odpowiednio w logach projektu i leada
     * 
     * $hr_settings - zmienna zawiera ustawienia z pliku settings.yml, struktura tych ustawień nieco odbiega od zapotrzebowania dlatego trzebabyło impowizować:) 
     * $hr_settings['Settings']['value'] - to adres hosta, $hr_settings['Settings']['title'] - nazwa użytkownika(email) a $hr_settings['Settings']['params'] zaiwera hasło
     */
    function project_and_lead_mail_log($hr_settings = null)
    {
        if(empty($hr_settings)){ //dla CRONA!
            $hr_settings['Settings']['value'] = '{mail.febdev.pl:110/pop3/novalidate-cert}INBOX';
            $hr_settings['Settings']['title'] = 'crm@febdev.pl';
            $hr_settings['Settings']['params'] = 'i2aWQsj0';
        }

        $projectLog = new ClientProjectLog();
		$leadLog = new LeadLog();

        /* connect to mail */
        $inbox = imap_open($hr_settings['Settings']['value'], $hr_settings['Settings']['title'], $hr_settings['Settings']['params']) or die('Cannot connect to mail: ' . imap_last_error()); //połączenie ze skrzynką pocztową
        /* grab emails */
        //$emails = imap_search($inbox, 'SUBJECT #' . $id);
        //$emails = imap_search($inbox, 'ALL');
		$foo = imap_errors(); //dodałem, żeby uniknąć poajwiania się błędu "Unknown: Mailbox is empty (errflg=1)" w przypadku pustej skrzynki
        $message_count = imap_num_msg($inbox); //sprawdzam liczbę maili w skrzynce

        if ($message_count > 0)//sprawdzam czy w krzynce są jakieś maile
        { 
            if ($message_count > 20)
            {
                $message_count = 20;
                //$this->Session->setFlash('Nie wszystkie maile zostały zsynhronizowane, odśwież stronę aby wczytać pozostałe wiadomości.', 'flash/warning', array(), 'email_info');
            }
			
            /* if emails are returned, cycle through each... */
            for ($i = 1; $i <= $message_count; ++$i)
            {
                $uid = imap_uid($inbox, $i); //sprawdzam numer UID maila
                $overview = imap_fetch_overview($inbox, $uid, 0); //wyszukuję informcję o mailu po jego numerze UID

                preg_match('/\$([0-9]+)/', mb_decode_mimeheader($overview[0]->subject), $res_p); //wyszukuję ciąg znaków z hash tagiem - projekt
                preg_match('/#([0-9]+)/', mb_decode_mimeheader($overview[0]->subject), $res_l); //wyszukuję ciąg znaków z hash tagiem - lead

                if(isset($res_p[1])){
					//zapisuje log tylko jeśli temat ma dołączony hashtag
					// @todo [TODO] sprawdzanie czy w mailu wystepuje słowo base64, jeśli tak to zastosować fetch_body z opcją 1.2 lub coś podobnego, żeby wycieło ten syf
					////$message = imap_qprint(imap_body($inbox, $uid)); 
					$message = imap_fetchbody($inbox, $uid, "2"); //wyszukuję treść maila po numerze UID
					if(strpos($message,'base64')){ 
						//$message = imap_fetchbody($inbox, $uid, "1.2");
					}
					if(!$message){
						$message = imap_fetchbody($inbox, $uid, "1"); //wyszukuję treść maila po numerze UID
					}

					$date = new DateTime($overview[0]->date);
					$overview[0]->date = $date->format('Y-m-d H:i'); //formatuję datę
					//dane do loga leadu
					$data = array();
					$data['ClientProjectLog']['created'] = $overview[0]->date;
					$data['ClientProjectLog']['modified'] = $overview[0]->date;
					$data['ClientProjectLog']['email_date'] = $overview[0]->date;
					$data['ClientProjectLog']['type_log_id'] = 1; //typ loga - email, TYPY ZDEFINIOWANE SĄ W MODELU
					$data['ClientProjectLog']['subject'] = $overview[0]->subject;

					//die(debug($wyr));
					$data['ClientProjectLog']['message'] = addslashes((quoted_printable_decode($message)));
					$data['ClientProjectLog']['from'] = $overview[0]->from;
					$data['ClientProjectLog']['client_project_id'] = (int)$res_p[1]; //client_project_id to numer z hash tagiem dołączany w tytule maila
					
                    
                    $tmp = explode("<", $overview[0]->from);
                    $tmp[1] = str_replace('>', '', $tmp[1]);
                    $user_model = new User();
                    $params['conditions'] = array(
                        'User.email' => $tmp[1]
                    );
                    $user = $user_model->find('first',$params);
                    if($user){
                        $data['ClientProjectLog']['user_id'] = $user['User']['id'];
                    } 

					$projectLog->saveLog(1, $data);//zapisuje wiadomości w logach
				} 
                
                if(isset($res_l[1])){
                    //zapisuje log tylko jeśli temat ma dołączony hashtag
                    $message = imap_fetchbody($inbox, $uid, "2"); //wyszukuję treść maila po numerze UID
                    if(!$message){
                        $message = imap_fetchbody($inbox, $uid, "1"); //wyszukuję treść maila po numerze UID
                    }

                    $date = new DateTime($overview[0]->date);
                    $overview[0]->date = $date->format('Y-m-d H:i'); //formatuję datę
                    //dane do loga leadu
                    $data = array();
                    $data['LeadLog']['created'] = $overview[0]->date;
                    $data['LeadLog']['modified'] = $overview[0]->date;
                    $data['LeadLog']['email_date'] = $overview[0]->date;
                    $data['LeadLog']['type_log_id'] = 1; //typ loga - email, TYPY ZDEFINIOWANE SĄ W MODELU
                    $data['LeadLog']['subject'] = $overview[0]->subject;

                    //die(debug($wyr));
                    $data['LeadLog']['message'] = addslashes((quoted_printable_decode($message)));
                    $data['LeadLog']['from'] = $overview[0]->from;

                    $data['LeadLog']['client_lead_id'] = (int) $res_l[1]; //klient_lead_id to numer z hash tagiem dołączany w tytule maila
                    //$data['LeadLog']['user_id'] = $this->Session->read('Auth.User.id');

                    
                    $tmp = explode("<", $overview[0]->from);
                    $tmp[1] = str_replace('>', '', $tmp[1]);
                    
                    $user_model = new User();
                    $params['conditions'] = array(
                        'User.email' => $tmp[1]
                    );
                    $user = $user_model->find('first',$params);
                    if($user){
                        $data['LeadLog']['user_id'] = $user['User']['id'];
                    } 
                    
                    $leadLog->saveLog(1, $data); //zapisuje wiadomości w logach
                } 
					
                imap_delete($inbox, $uid); //oznaczam odczytaną wiadomość do usunięcia
				
                
            }
            imap_expunge($inbox); //usuwam wiadomości które zostały zapisane w bazie
        }
        imap_close($inbox); /* close the connection */
	}
	
	
	/*
	 * Metoda wysyłająca maila do przełożonego z informacją, że podwładny rozpoczął projekt bez umowy
	 * 
	 * @params			$client_lead_id - id leadu
	 *					$project_id - id projektu
	 *					$supervisor_email - mail przełożonego
	 * 
	 * @return mixed	false - gdy nie wszystkie parametry zostana przekazane fo funkcji
	 *					void - w przypadku wysłania maila;
	 */
	function sendNotifyEmailForProjectStartedWithoutAgreement($client_lead_id = null,$project_id = null, $supervisor_email = null){
		// layout maila app\View\Layouts\Emails\html\default.ctp
		if(empty($client_lead_id) || empty($project_id) || empty($supervisor_email)){
			return false;
		}
		
		App::uses('FebEmail', 'Lib');
		$email = new FebEmail('smtp');
		$email->viewVars(array('value' => 'Lead #' . $client_lead_id . ' został zatwierdzony jako wygrany. Projekt został rozpoczęty bez umowy. '
			. '<a href="' . Router::url('/client_projects/view/', true) . $project_id . '" >Link do projektu</a>'));

		
		$email->template('new_project')
				->emailFormat('html')
				->to($supervisor_email)
               //->bcc("test_dev@febdev.pl")
				->from(array('crm@febdev.pl' => 'Fabryka e-biznesu'))
				->subject(__d('email', 'Prośba o autoryzację'));
		$email->send();
		$email->reset();
	
	}
	
	function sendNotifyEmailAboutProjectWithoutConfirmReport($project_id = null, $project_name = null, $supervisor_email = null){
		
		if(empty($project_id) || empty($project_name) || empty($supervisor_email)){
			return false;
		}
		//die($supervisor_email);
		App::uses('FebEmail', 'Lib');
		$email = new FebEmail('smtp');
		$email->viewVars(array('value' => 'Projekt "' . $project_name . '" został zamknięty bez protokołu odbioru. '
			. '<a href="' . Router::url('/client_projects/view/', true) . $project_id . '" >Link do projektu</a>'));

		$email->template('new_project')
				->emailFormat('html')
				->to($supervisor_email)
                //->bcc("test_dev@febdev.pl")
				->from(array('crm@febdev.pl' => 'Fabryka e-biznesu'))
				->subject(__d('email', 'Projekt zamknięty bez protokołu odbioru'));
		$email->send();
		$email->reset();
	}
	
	
	/*
	 * Metoda wysyłająca maila do nowego pracownika z danymi do konta w b2b, maila służbowego, itp.
	 * 
	 * @params			$content - dodatkowa treść maila
	 *					$mail - mail pracownika
	 * 
	 * @return mixed	false - gdy nie wszystkie parametry zostana przekazane fo funkcji
	 *					void - w przypadku wysłania maila;
	 */
	function sendAccountCredentials($mail = null,$content = null){
		// layout maila app\View\Layouts\Emails\html\default.ctp
		if(empty($mail) || empty($content)){
			return false;
		}
		//die(debug($content));
		App::uses('FebEmail', 'Lib');
		$email = new FebEmail('smtp');
		$email->viewVars(array('value' => $content));

		$email->template('account_credentials')
				->emailFormat('html')
				->to($mail)
                //->bcc("test_dev@febdev.pl")
				->from(array('crm@febdev.pl' => 'Fabryka e-biznesu'))
                //->from(array(Configure::read('App.WebSenderEmail') => Configure::read('App.WebSenderName')))
				->subject(__d('public', 'Feb - dane do konta'));
		$email->send();
		$email->reset();
	
	}
}

