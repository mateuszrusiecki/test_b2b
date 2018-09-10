<?php

App::uses('Model', 'NewClientsAppModel');

class Category extends NewClientsAppModel {
    public $actsAs = array('Containable');
    
    public $useTable = 'categories';

    public $hasMany = array(
        'NewClients.pView'
    );

    public $belongsTo = array(
        'NewClients.Project'
    );
}

