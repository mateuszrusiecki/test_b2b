<?php

/*
 * 
 * 
 */

/**
 * Description of Sms
 *
 * @author Sławomir Jach
 */
App::uses('CakeEventListener', 'Event');
class Sms implements CakeEventListener {
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
