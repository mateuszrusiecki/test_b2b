<?php
/**
 * ClientProjectNoteFixture
 *
 */
class ClientProjectNoteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'project_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'client_access' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'project_id' => '3',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et diam at neque suscipit commodo. Aenean mattis tincidunt ex, ut convallis nisi luctus ac. Nulla a felis eget nisi mattis consequat quis vel augue. Ut erat quam, pellentesque non diam eu, mollis blandit ipsum. Ut sed euismod felis. Vivamus faucibus diam nec sapien malesuada, lacinia convallis risus hendrerit. Fusce a varius metus, vel ultricies risus. Proin sit amet consectetur elit. Etiam in diam et enim viverra mollis.

Praesent urna dui, convallis quis urna in, fermentum tempus est. Praesent mattis condimentum dui, a pulvinar neque maximus vel. Duis ornare iaculis condimentum. Proin sed mauris at massa rhoncus viverra. Sed vel faucibus lacus, vel facilisis purus. Sed eget leo ac turpis porttitor mollis et et leo. Praesent tristique velit eget quam gravida ultrices.

Etiam efficitur tellus odio, ultrices feugiat augue dignissim tincidunt. Donec est dolor, convallis vitae eleifend efficitur, auctor eget quam. Quisque congue nec metus sit amet semper. Nulla scelerisque mauris nunc, nec interdum risus placerat auctor. Praesent mollis arcu eget sapien convallis, eu luctus tortor rutrum. Praesent iaculis erat et magna suscipit fringilla. Integer lobortis libero eget purus mollis fringilla nec nec neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;',
			'client_access' => '0',
			'created' => '2015-03-27 14:46:52',
			'modified' => '2015-03-30 14:57:39'
		),
		array(
			'id' => '2',
			'project_id' => '3',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pulvinar semper turpis, et aliquam dui ultricies non. Sed accumsan ipsum et orci volutpat tempus.',
			'client_access' => '0',
			'created' => '2015-03-27 15:00:20',
			'modified' => '2015-03-30 14:56:58'
		),
		array(
			'id' => '3',
			'project_id' => '3',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et diam at neque suscipit commodo. Aenean mattis tincidunt ex, ut convallis nisi luctus ac. Nulla a felis eget nisi mattis consequat quis vel augue. Ut erat quam, pellentesque non diam eu, mollis blandit ipsum. Ut sed euismod felis. Vivamus faucibus diam nec sapien malesuada, lacinia convallis risus hendrerit. Fusce a varius metus, vel ultricies risus. Proin sit amet consectetur elit. Etiam in diam et enim viverra mollis.',
			'client_access' => '1',
			'created' => '2015-03-30 14:57:18',
			'modified' => '2015-03-30 14:57:18'
		),
		array(
			'id' => '4',
			'project_id' => '3',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam cursus mattis est, in bibendum ex commodo quis. Vivamus ut euismod neque. Donec porta vitae lectus sit amet feugiat. Pellentesque nec semper massa. Donec eget lorem dui. Mauris orci ligula, egestas non venenatis et, consequat et ipsum. Duis sit amet turpis suscipit, placerat mi nec, gravida quam. Pellentesque et dui euismod, convallis ipsum varius, mattis lorem. Ut elementum lectus vitae pretium tincidunt. Aenean vitae dapibus nisl. Cras quis luctus leo. Aliquam dapibus, nunc non pretium volutpat, justo nunc cursus odio, gravida suscipit leo magna et nulla. In aliquam fermentum quam ut vestibulum. Curabitur tempor, leo sed mattis malesuada, diam lorem tincidunt leo, nec consequat eros est vel eros.

Nulla fringilla sapien sit amet dapibus volutpat. Nunc aliquam risus eu urna volutpat, non varius mauris efficitur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi non tristique ipsum. Suspendisse potenti. Nulla metus augue, condimentum a viverra vitae, dignissim eget justo. Duis quis elit eu ante lacinia mollis.

Phasellus porttitor lacus leo, eleifend tincidunt justo scelerisque nec. Sed ac faucibus ligula. Cras rutrum et sapien nec cursus. Quisque tristique justo et lacinia blandit. Pellentesque sed blandit magna, in eleifend felis. Quisque ut sapien nisi. Integer fringilla iaculis ligula, sed venenatis quam posuere vitae. In ac dapibus magna, ut pretium ante.

Phasellus ligula purus, maximus sit amet fringilla cursus, ultricies a arcu. Quisque erat mi, tempus a porta id, vulputate at eros. Fusce consequat vitae dui quis pellentesque. Pellentesque interdum vitae ligula a molestie. Sed ullamcorper tortor odio, sit amet laoreet purus ultrices tempus. Praesent ullamcorper dolor dui. Vestibulum viverra posuere urna in imperdiet. Nullam elementum ornare vestibulum. Praesent consectetur, eros nec mattis volutpat, lorem magna hendrerit metus, convallis tincidunt magna velit sed lacus. Pellentesque lobortis scelerisque felis nec placerat. Aenean id lacinia arcu. Nulla facilisi. Vivamus iaculis nulla id aliquet porta. Duis vulputate facilisis neque vel condimentum.

Sed lacinia nisi vitae ligula scelerisque tincidunt. Quisque in pharetra nunc. Donec quis urna nec purus venenatis eleifend. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus ornare varius sagittis. Curabitur ultricies odio ut felis gravida, non fermentum magna ultrices. Curabitur ante nisi, iaculis eget pulvinar sit amet, porta a massa. Sed elementum ante id velit blandit, nec sagittis nibh varius. Phasellus ut massa nunc. Etiam vehicula eros eget euismod feugiat. Nullam vulputate lectus ac sagittis venenatis.',
			'client_access' => '1',
			'created' => '2015-03-30 14:57:28',
			'modified' => '2015-03-30 14:57:35'
		),
		array(
			'id' => '5',
			'project_id' => '12',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'content' => 'nowa otatka niewidoczna dla klienta lorem ipsum dolor sit amet',
			'client_access' => '1',
			'created' => '2015-04-02 15:51:47',
			'modified' => '2015-04-08 15:20:40'
		),
		array(
			'id' => '6',
			'project_id' => '12',
			'client_id' => '1',
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'content' => 'notatka lol',
			'client_access' => '0',
			'created' => '2015-04-10 10:11:11',
			'modified' => '2015-04-10 10:11:24'
		),
		array(
			'id' => '7',
			'project_id' => '13',
			'client_id' => '8',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'content' => 'asf',
			'client_access' => '1',
			'created' => '2015-04-14 11:00:11',
			'modified' => '2015-04-14 11:00:11'
		),
		array(
			'id' => '8',
			'project_id' => '10',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'content' => 'uuuuuuu',
			'client_access' => '1',
			'created' => '2015-04-14 14:13:14',
			'modified' => '2015-04-16 07:44:44'
		),
		array(
			'id' => '9',
			'project_id' => '8',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'content' => 'dasffa',
			'client_access' => '0',
			'created' => '2015-04-15 12:45:11',
			'modified' => '2015-04-15 13:02:22'
		),
		array(
			'id' => '10',
			'project_id' => '8',
			'client_id' => '1',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'content' => 'asdf',
			'client_access' => '1',
			'created' => '2015-04-15 12:49:38',
			'modified' => '2015-04-15 13:18:03'
		),
	);

}
