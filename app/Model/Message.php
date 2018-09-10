<?php
App::uses('AppModel', 'Model');
/**
 * Meszsage Model
 *
 * @property ClientProject $ClientProject
 * @property ModuleCategory $ModuleCategory
 */
class Message extends AppModel {
    /**
     * belongsTo associations
     *
     * @var array
    */
    public $belongsTo = array(
        'MessageType' => array(
            'className' => 'MessageType',
            'foreignKey' => 'message_type_id',
        )
    );
    
    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('sendMessage'));
    }
    
    /**
     * Wysyłanie wiadomości
     * 
     * @param type $user_id                 id użytkownika
     * @param type $message_type_id         id typu wiadomośći
     * @param type $body                    treść wiadomości
     * @return void
     */
    public function sendMessage($user_id, $message_type_id, $body, $link = null){
        $this->create();
        $this->set('user_id', $user_id);
        $this->set('message_type_id', $message_type_id);
        $this->set('body', $body);
        $this->set('received', date('Y-m-d H:i:s'));
		if(!empty($link)) $this->set('link',$link);
        $this->set('readed', 0);
        $this->save(null, false);
    }
    
    /**
     * Lista powiadomień danego użytkownika
     * 
     * @return array        lista wiadomosci
     */
    public function getMessages($user_id = null){
        
        return $this->find('all', array(
            //'fields' => array('Message.link','Message.body', 'Message.received', 'Message.message_type_id'),
            'order' => 'Message.received DESC',
            'conditions' => array(
                'Message.user_id' => $user_id
            )
        ));
    }
    
    /**
     * Lista 5 ostatnich nieprzeczytanych powiadomień danego użytkownika
     * 
     * @return array        lista wiadomości
     */
    public function getMessagesInfo($user_id = null){
        
        if($user_id === null){
            return array();
        }
        
        return $this->find('all', array(
                'limit' => 5,
                'conditions' => array(
                    'Message.user_id' => $user_id,
                    'Message.readed' => 0
                ),
                'order' => 'Message.id DESC'
            )
        );       
    }
}