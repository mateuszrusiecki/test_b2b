<?php

Configure::write('Page', array(
    'hasComments' => false,
    'hasPhotos' => true
));

/**
 * Konfiguracja pluginu page
 */

App::uses('CakeEventManager', 'Event');
CakeEventManager::instance()->attach('afterPageInit', 'Model.Page.afterInit');

function afterPageInit($event) {
    $model = $event->subject();

//    $model->belongsTo = array(
//        'Photo' => array(
//            'className' => 'Photo.Photo',
//            'foreignKey' => 'photo_id',
//            'conditions' => '',
//            'fields' => '',
//            'order' => ''
//        )
//    );
//    
//	$model->hasMany = array(
//		'Photos' => array(
//			'className' => 'Photo.Photo',
//			'foreignKey' => 'page_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
//		)
//	); 
    
    
}

?>