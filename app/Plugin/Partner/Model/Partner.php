<?php
App::uses('AppModel', 'Model');
/**
 * Partner Model
 *
 */
class Partner extends AppModel {
    var $actsAs = array(
        'Slug.Slug',
        'Translate'=>array('name','content'),
		'Image.Upload'=>array('imageOptions'=>array('size'=>array('width'=>1920, 'height'=>1200))),
		//'Tree.FebTree'
    );
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
}
