<?php 
class PanelSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $i18n = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'locale' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 6, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'foreign_key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'field' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'locale' => array('column' => 'locale', 'unique' => 0), 'model' => array('column' => 'model', 'unique' => 0), 'row_id' => array('column' => 'foreign_key', 'unique' => 0), 'field' => array('column' => 'field', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
}
