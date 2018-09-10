<?php

/*
 * 
 * 
 */

/**
 * Description of Email
 *
 * @author Sławomir Jach
 */
App::uses('CakeEventListener', 'Event');
class Email implements CakeEventListener {
    public function implementedEvents() {
        return array(
            'Model.Order.afterPlace' => 'updateBuyStatistic',
        );
    }

    public function updateBuyStatistic($event) {
        // Code to update statistics
    }
}

?>
