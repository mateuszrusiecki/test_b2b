<?php

App::uses('HttpResponse', 'Network/Http');

class GrindstoneResponse extends HttpResponse {

    public function parseResponse($message) {
        parent::parseResponse($message);
//        $messgae = $this->body();    
    }
    
    
}