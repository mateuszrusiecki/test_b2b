<?php
App::uses('Model', 'NewClientsAppModel');

class Comment extends NewClientsAppModel {
    
    public $actsAs = array('Containable');
    
    var $belongsTo = array(
        'NewClients.Version',
        'NewClients.User',
        'NewClients.Region',
    );
    
    
    /**
     * Pobieranie komentarzy do potwierdzenia mailowego
     * 
     * @return array             lista komentarzy
     */
    public function getComments(){
        
        return $this->find('all', array(
                'conditions' => array(
                    'Comment.email_confirmed' => 0
                ),
                'fields' => array(
                    'Comment.id',
                    'Comment.content',
                    'Comment.version_id',
                    'Comment.created',
                    'Comment.modified',
                    'Comment.email_confirmed',
                ),
                'contain' => array(
                    'Version' => array(
                        'fields' => array(
                            'Version.id',
                            'Version.view_id',
                            'Version.view_id',
                        ),
                        'View' => array(
                            'fields' => array(
                                'View.id',
                                'View.project_id',
                            ),
                            'Project' => array(
                                'fields' => array(
                                    'Project.id',
                                    'Project.manager_id',
                                    'Project.title',
                                ),
                                'Manager' => array(
                                    'fields' => array(
                                        'Manager.id',
                                        'Manager.email',
                                    )
                                )
                            )                               
                        )                    
                    )
                )
            )
        );
    }
    
}