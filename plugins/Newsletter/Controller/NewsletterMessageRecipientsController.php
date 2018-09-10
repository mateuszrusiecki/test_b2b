<?php
App::uses('AppController', 'Controller');
App::uses('FebEmail', 'Lib');
/**
 * NewsletterMessageRecipients Controller
 *
 * @property NewsletterMessageRecipient $NewsletterMessageRecipient
 */
class NewsletterMessageRecipientsController extends AppController {

    
    /**
     * Nazwa layoutu
     */
    public $layout = 'admin';

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
        $this->Auth->allow(array('cron_send_30'));
    }

    /**
    * Akcja wyświetlająca listę obiektów
    * 
    * @return void
    */
	public function cron_send_30($pass = null) {
        set_time_limit(0);
        
        $this->layout = false;
        $this->scriptTimeLimitCounter = time();

        $this->helpers[] = 'FebTime';
        if ($pass != 'simplePermission231') {
            throw new Exception('Błąd autoryzacji');
        }

        $MyEmail = new FebEmail('public');
       
        //Wybieram pierwszego w buforze i wysyłam do niego email
        $params['conditions']['NewsletterMessageRecipient.error'] = null;
        $params['conditions']['NewsletterMessageRecipient.send'] = 0;
        $this->NewsletterMessageRecipient->recursive = 0;

        $newsletterMessageRecipient = $this->NewsletterMessageRecipient->find('first', $params);
    
        if (!empty($newsletterMessageRecipient)) {
            $this->NewsletterMessageRecipient->id = $newsletterMessageRecipient['NewsletterMessageRecipient']['id'];
            try {
                //Próbujemy wysłać emaila
                $MyEmail->viewVars(array('email' => $newsletterMessageRecipient['NewsletterMessageRecipient']['recipient_email'], 'message' => $newsletterMessageRecipient));
                $MyEmail->template('Newsletter.user_newsletter')
                        ->to($newsletterMessageRecipient['NewsletterMessageRecipient']['recipient_email'])
                        ->from(array($newsletterMessageRecipient['NewsletterMessage']['sender_email'] => $newsletterMessageRecipient['NewsletterMessage']['sender_name']))
                        ->subject($newsletterMessageRecipient['NewsletterMessage']['title']);
                $emailFormat = 'text';
                if (!empty($newsletterMessageRecipient['NewsletterMessage']['html_content'])) {
                    $emailFormat = 'both';
                }
                $MyEmail->emailFormat($emailFormat);
                $MyEmail->send();
                $MyEmail->reset();
                
                //Zapisujemy w wiadomośći newslettera statystyki

                //Lista odbiorców
                $this->NewsletterMessageRecipient->NewsletterMessage->id = $newsletterMessageRecipient['NewsletterMessage']['id'];
                $newsletterMessageRecipient['NewsletterMessage']['recipients_list'] = json_decode($newsletterMessageRecipient['NewsletterMessage']['recipients_list']);
                $newsletterMessageRecipient['NewsletterMessage']['recipients_list'][] = $newsletterMessageRecipient['NewsletterMessageRecipient']['recipient_email'];
                $this->NewsletterMessageRecipient->NewsletterMessage->saveField('recipients_list', json_encode($newsletterMessageRecipient['NewsletterMessage']['recipients_list']));

                //Licznik wysłanych emaili
                $this->NewsletterMessageRecipient->NewsletterMessage->saveField('progress', (int)$newsletterMessageRecipient['NewsletterMessage']['progress'] + 1);
                
                $this->NewsletterMessageRecipient->saveField('send', 1);
                $this->NewsletterMessageRecipient->saveField('send_date', date('Y-m-d H:i:s'));   
                sleep(1);
                
            } catch (Exception $exc) {
                $this->NewsletterMessageRecipient->saveField('error', $exc->getMessage());
            }
            if ((time() - $this->scriptTimeLimitCounter) < 29) $this->cron_send_30($pass);
        }
                
        $this->render(false);
	}
    
    
}
