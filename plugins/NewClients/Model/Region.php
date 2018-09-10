<?php

App::uses('Model', 'NewClientsAppModel');

class Region extends NewClientsAppModel {
    var $hasMany = array(
        'NewClients.Comment', 
    );
    
    var $belongsTo = array(
        'NewClients.User',
    );
}