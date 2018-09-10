<?php

App::uses('Model', 'NewClientsAppModel');

class pView extends NewClientsAppModel {
    public $useTable = 'views';
    
    public $actsAs = array('Containable');
    

    public $hasMany = array(
        'NewClients.Version',
    );

    public $belongsTo = array(
        'NewClients.Project',
        'NewClients.Category',
    );
}