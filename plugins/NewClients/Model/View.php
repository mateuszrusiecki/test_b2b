<?php

App::uses('Model', 'NewClientsAppModel');

class View extends NewClientsAppModel {

    public $belongsTo = array(
        'NewClients.Project',
    );
}