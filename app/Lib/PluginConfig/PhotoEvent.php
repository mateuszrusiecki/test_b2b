<?php

/**
 * Description of PhotoEvent
 *
 * @author Sławomir Jach
 */
App::uses('CakeEventListener', 'Event');
class PhotoEvent implements CakeEventListener {
    
    public function implementedEvents() {
        return array(
            'Model.Photo.afterInit' => 'afterPhotoInit',
        );
    }

    function afterPhotoInit($event) {
        $model = $event->subject();
        
        $model->belongsTo = array(
            'Page' => array(
                'className' => 'Page.Page',
                'foreignKey' => 'page_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
            ),
            'News' => array(
                'className' => 'News.News',
                'foreignKey' => 'news_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
            ),
            'Article' => array(
                'className' => 'Article',
                'foreignKey' => 'article_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
            )
        );
    }
    
}

?>
