<?php

//App::Uses('Version', 'Model');
App::uses('Model', 'NewClientsAppModel');

class Version extends NewClientsAppModel {
    public $hasMany = array(
        'NewClients.Region',
    );
    
    public $belongsTo = array(
        'NewClients.View',
    );
}
