<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $comments = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'desc' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'active' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'page_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $contacts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'show' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	public $groups = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'order' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 3),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 15, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'permission_groups' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
	public $groups_users = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'group_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'group_user' => array('column' => array('group_id', 'user_id'), 'unique' => 1), 'group_id' => array('column' => 'group_id', 'unique' => 0), 'user_id' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
	public $helps = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
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
	public $langs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 3, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 60, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 3, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'lc' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2, 'collate' => 'utf8_unicode_ci', 'comment' => 'language code', 'charset' => 'utf8'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $menus = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'option' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 3),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'row_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $modifications = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'plugin' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'foreign_key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'action' => array('type' => 'string', 'null' => false, 'default' => 'edit', 'length' => 15, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'user_details' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'content_before' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'content_after' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
	public $multi_contacts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'label' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'latitude' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'longitude' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $news = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'main' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'photo_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	public $newsletter_message_recipients = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'newsletter_message_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'recipient_email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'send' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'error' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'comment' => 'Wystąpił błąd podczas wysyłania tego emaila', 'charset' => 'utf8'),
		'send_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $newsletter_messages = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'html_content' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sender_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sender_email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'recipients' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'recipients_list' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'progress' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'status' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4, 'comment' => 'null/0 - nie wysłany, 1 - w trakcie wysyłania, 2 - wysłany, 3- newsletter wysłany z błędami'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	public $newsletters = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'confirmed' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $pages = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'static' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'gallery' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'comments' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'lock' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'photo_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $permission_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $permission_groups = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'permission_category_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'permission_category_id' => array('column' => 'permission_category_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $permissions = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 80, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'permission_group_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1), 'permission_group_id' => array('column' => 'permission_group_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
	public $photos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'img' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'photo_category_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'offer_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'page_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'news_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'x' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'y' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'order' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 6),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $requesters_permissions = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'permission_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'model' => array('type' => 'string', 'null' => false, 'default' => 'Group', 'length' => 40, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'row_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'requester_permission' => array('column' => array('permission_id', 'model', 'row_id'), 'unique' => 1), 'permission_id' => array('column' => 'permission_id', 'unique' => 0), 'model_row_id' => array('column' => array('model', 'row_id'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
	public $searchers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'row_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'selected' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'row_id' => array('column' => 'row_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $settings = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'value' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'input_type' => array('type' => 'string', 'null' => false, 'default' => 'text', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'editable' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'params' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'key' => array('column' => 'key', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
	public $sites = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
	public $slugs = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'locale' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 6, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'row_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
	public $users = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'facebook_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 13),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 254, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'login' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'pass' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'avatar' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'x' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'y' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'remember' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'menu' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'themed' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'permission_groups' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'failed_loginss' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'date_locked' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'email_unique' => array('column' => 'email', 'unique' => 1), 'login_unique' => array('column' => 'login', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
	public $users_logs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'username' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'action' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'really_ip' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'users_ip' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
}
