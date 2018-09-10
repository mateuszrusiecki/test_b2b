<?php

App::uses('AppModel', 'Model');

/**
 * B2BClient Model
 */
class B2BClient extends AppModel
{
    
    public $actsAs = array('Containable');

    public $useTable = 'clients';
    
}