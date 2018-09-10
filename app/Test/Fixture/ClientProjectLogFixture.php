<?php
/**
 * ClientProjectLogFixture
 *
 */
class ClientProjectLogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_project_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'type_log_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'subject' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'message' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'from' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'id' => '390',
			'client_project_id' => '3',
			'type_log_id' => '2',
			'name' => 'umowa.docx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-03-20 14:12:16',
			'modified' => '2015-03-20 14:12:16'
		),
		array(
			'id' => '391',
			'client_project_id' => '3',
			'type_log_id' => '2',
			'name' => 'loglead.png',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-03-20 14:12:35',
			'modified' => '2015-03-20 14:12:35'
		),
		array(
			'id' => '399',
			'client_project_id' => '3',
			'type_log_id' => '1',
			'name' => NULL,
			'subject' => 'Drugi mail #15 do leada',
			'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque 
quis magna lorem. Etiam posuere interdum augue euismod vehicula. Morbi 
sit amet turpis non lectus feugiat consequat. Suspendisse iaculis quam 
quis urna auctor cursus. Vivamus congue, nunc id tempor feugiat, tellus 
dolor suscipit elit, sed dapibus libero enim sit amet nunc. Suspendisse 
potenti. Phasellus et dignissim nisi. Sed vitae nulla venenatis elit 
luctus molestie. In efficitur justo vitae lectus rhoncus ultrices. Nulla 
dui ligula, porta quis nisi maximus, mattis dignissim nisi. Morbi at 
metus euismod, sagittis felis sed, faucibus metus. Nunc vitae mauris ut 
risus rhoncus lacinia quis quis lectus. Aliquam nec sapien ultricies, 
blandit risus in, suscipit leo.

Integer vehicula pellentesque nunc, vel consectetur lacus dictum vitae. 
Nam risus diam, facilisis nec fermentum vitae, hendrerit ac dui. Nulla 
accumsan ex vel sapien dapibus, sit amet ultrices odio pharetra. Cras ac 
tempor nulla. Mauris ut nisl consequat ante dapibus sodales vitae in 
nunc. In in blandit leo, in scelerisque ligula. Donec commodo felis 
odio, id laoreet turpis posuere ac. Donec lacinia mi in sem euismod 
convallis.

Phasellus id massa porttitor, iaculis purus nec, aliquet odio. Praesent 
vitae lorem quis mi hendrerit bibendum. Ut ut posuere ante, et gravida 
urna. Pellentesque habitant morbi tristique senectus et netus et 
malesuada fames ac turpis egestas. Morbi imperdiet lectus quam, in 
faucibus est lacinia sit amet. Aliquam commodo felis in pellentesque 
auctor. Ut quam elit, faucibus a posuere id, finibus et leo. Vestibulum 
nec lacus placerat, sodales lorem at, varius dui. Ut ac ipsum pulvinar, 
sollicitudin ligula vel, maximus ex. Etiam consequat metus nec eros 
ultricies blandit. Fusce luctus, nisi eu efficitur placerat, dolor felis 
scelerisque orci, at congue mauris massa vitae justo. Praesent aliquet 
nisi quis elementum placerat. Nullam dapibus risus eget dolor imperdiet 
bibendum. Etiam tincidunt pellentesque ex, non maximus quam viverra at.
',
			'from' => 'm.rusiecki@febdev.pl',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => '2015-03-25 13:09:00',
			'created' => '2015-03-25 13:09:00',
			'modified' => '2015-03-25 13:09:00'
		),
		array(
			'id' => '422',
			'client_project_id' => '3',
			'type_log_id' => '1',
			'name' => NULL,
			'subject' => 'sssss #15',
			'message' => '<div dir=\\"ltr\\"><span style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\">Maila wysyłałem z załącznikiem / bo takie sytuacje będą</span><br style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\"><div class=\\"\\" style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>Fwd: Fwd: Przekazanie projektu :: #8</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Thu, 19 Mar 2015 13:49:35 +0100</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Marcin Rudzik <a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">&lt;m.rudzik@feb.net.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:crm@febdev.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">crm@febdev.pl</a></td></tr></tbody></table><br><br><br><div class=\\"\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>Fwd: Przekazanie projektu :: #8</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Thu, 19 Mar 2015 13:46:11 +0100</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Marcin Rudzik <a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">&lt;m.rudzik@feb.net.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:crm@febdev.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">crm@febdev.pl</a></td></tr></tbody></table><br><br><br><div class=\\"\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>Przekazanie projektu :: #13</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Thu, 19 Mar 2015 13:42:13 +0100</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Marcin Rudzik <a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">&lt;m.rudzik@feb.net.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:crm@febdev.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">crm@febdev.pl</a></td></tr></tbody></table><br><br>PRzekazanie tematu:<br><br>Osoba kontaktowa<br>Dane do faktury<br><br>link : <a class=\\"\\" href=\\"http://b2b.febdev.pl/vacations/index/2015#vacations\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">http://b2b.febdev.pl/vacations/index/2015#vacations</a><br><br><table class=\\"\\" border=\\"1\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"border-collapse:collapse;border:none\\"><tbody><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border:1pt solid windowtext\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr></tbody></table><br><br>ccccedsdafasfdsafd<font color=\\"#009900\\">asddsadasdasd</font> <br><div class=\\"\\">-- <br><div class=\\"\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"> </p><div><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><br><br><span style=\\"font-size:12pt\\"></span></p><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><td rowspan=\\"4\\" valign=\\"top\\" width=\\"122\\" style=\\"width:91.25pt\\"><p align=\\"center\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black;text-align:center\\"><span style=\\"font-family:Arial,sans-serif;color:rgb(165,165,165)\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.2&amp;_embed=1&amp;_mimeclass=image\\" height=\\"73\\" width=\\"71\\" style=\\"border: 0px;\\"></span><span style=\\"font-family:Arial,sans-serif;color:rgb(165,165,165)\\"><br><br><br></span></p></td><td colspan=\\"2\\" style=\\"border:none;padding:6pt 6pt 0cm\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 12pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:9pt;font-family:Arial,sans-serif\\">Pozdrawiam<br><b>Marcin Rudzik<br></b></span><b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Koordynator Projektów</span></b><b><span style=\\"font-size:9pt;font-family:Arial,sans-serif\\"></span></b></p></td></tr><tr style=\\"height:20pt\\"><td colspan=\\"2\\" style=\\"border:none;height:20pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 12pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">(+48) 725 823 919<br></span><span style=\\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(247,150,70)\\"><a href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"color:rgb(247,150,70)\\">m.rudzik@feb.net.pl</span></a></span><span style=\\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(247,150,70)\\"></span></p></td></tr><tr><td width=\\"195\\" style=\\"width:146.25pt;border:none;padding:6pt\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Fabryka e-biznesu Sp. z o.o.</span></b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\"> <br>ul. Słowackiego 24<br>35-060 Rzeszów<br><span class=\\"\\">tel</span>/fax: +48 17 852 92 46</span></p></td><td width=\\"216\\" style=\\"width:162pt\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Oddział w Warszawie:</span></b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\"><br>al. Niepodległości 124/2<br>02-577 Warszawa<br><span class=\\"\\">tel</span>/fax: +48 22 299 05 43</span></p></td></tr><tr><td style=\\"border:none;padding:0cm\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\"><tbody><tr><td width=\\"22\\" style=\\"width:16.5pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://feb.net.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;color:rgb(165,165,165);text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.3&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"29\\" width=\\"22\\" style=\\"border: 0px;\\"></span></a></p></td><td width=\\"70\\" style=\\"width:52.5pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:12pt\\"><a href=\\"http://feb.net.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165);text-decoration:none\\">feb.net.pl</span></a></span></p></td></tr></tbody></table></td><td style=\\"padding:0cm\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\"><tbody><tr><td width=\\"25\\" style=\\"width:18.75pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://facebook.com/fabrykaebiznesu\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;color:rgb(165,165,165);text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.4&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"25\\" width=\\"25\\" style=\\"border: 0px;\\"></span></a></p></td><td width=\\"180\\" style=\\"width:135pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:12pt\\"><a href=\\"http://facebook.com/fabrykaebiznesu\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165);text-decoration:none\\">facebook.com/<span class=\\"\\">fabrykaebiznesu</span></span></a></span></p></td></tr></tbody></table></td></tr><tr><td colspan=\\"4\\" style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Należymy do:</span></p></td></tr><tr><td colspan=\\"2\\" style=\\"padding:0cm\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\"><tbody><tr><td><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://www.klasterit.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.5&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"25\\" width=\\"95\\" style=\\"border: 0px;\\"></span></a></p></td><td><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://www.klasterlotniczy.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.6&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"41\\" width=\\"124\\" style=\\"border: 0px;\\"></span></a></p></td></tr></tbody></table></td><td style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><a href=\\"https://www.deloitte.com/view/en_GX/global/industries/technology-media-telecommunications/deloitte-technology-fast-500/deloitte-technology-fast-500-emea/c35f6952b691b310VgnVCM1000003156f70aRCRD.htm\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple\\"><span style=\\"font-family:Arial,sans-serif;text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.7&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"43\\" width=\\"131\\" style=\\"border: 0px;\\"></span></a></p></td><td style=\\"padding:0cm\\"><br></td></tr><tr><td colspan=\\"2\\" style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><span style=\\"font-size:6pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">NIP: 813-35-63-947, REGON: 180361630, KRS: 0000313751 <br><span class=\\"\\">Alior</span> Bank S.A. 82 2490 0005 0000 4530 6177 1504, Kapitał zakładowy: 180.000 PLN</span></p></td><td style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><span style=\\"font-size:6pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Jesteśmy laureatem prestiżowego rankingu Deloitte <br>pod patronatem Forbes w kategorii „Wschodzące Gwiazdy&quot;.</span></p></td></tr></tbody></table></div></div></div></div></div></div>
</div>
',
			'from' => 'Mateusz <mateuszr87@gmail.com>',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => '2015-03-25 15:28:00',
			'created' => '2015-03-25 15:28:00',
			'modified' => '2015-03-25 15:28:00'
		),
		array(
			'id' => '431',
			'client_project_id' => '3',
			'type_log_id' => '2',
			'name' => 'gitignore_global.txt',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-03-26 14:38:22',
			'modified' => '2015-03-26 14:38:22'
		),
		array(
			'id' => '432',
			'client_project_id' => '16',
			'type_log_id' => '1',
			'name' => NULL,
			'subject' => 'Fwd: mail do projektu $16',
			'message' => '

-------- Wiadomość oryginalna --------
Temat: Fwd: mail do leadu #16
Data: 2015-03-27 11:22
Od: m.rusiecki@febdev.pl
Do: Crm <crm@febdev.pl>

-------- Wiadomość oryginalna --------
Temat: mail do leadu #16
Data: 2015-03-27 11:19
Od: m.rusiecki@febdev.pl
Do: Crm <crm@febdev.pl>

Log projektu [koordynator, kierownik, handlowiec] to
automatycznie generowana lista ostatnich wydarzeń w projekcie.
Jeżeli zdarzenie jest związane z użytkownikiem, to w celu
łatwiejszej identyfikacji można dodać kolor i awatar użytkownika.
Log można filtrować wg typu zdarzenia (wybierając odpowiednią
ikonę w nagłówku) oraz tekstowo, na zasadach ogólnych dla
systemu. Odnotowywane są takie zdarzenia jak:
● Nadejście maila na systemowy adres email
● Dodanie nowego pliku do dokumentów
● Usunięcie pliku
● Dodanie nowej wersji (aktualizacja) pliku
● Data wydarzenia, zgodnie z harmonogramem
● Wystąpienie wydarzenia, oznaczone przez użytkownika
● Otwarcie projektu
● Zamknięcie projektu
● Dodanie / usunięcie osób w projekcie
● Dodanie / usunięcie / zmiana pozycji budżetowej
● Realizacja kamienia milowego
● Wystawienie / opłacenie faktury
',
			'from' => 'm.rusiecki@febdev.pl',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => '2015-03-27 11:59:00',
			'created' => '2015-03-27 11:59:00',
			'modified' => '2015-03-27 11:59:00'
		),
		array(
			'id' => '433',
			'client_project_id' => '3',
			'type_log_id' => '1',
			'name' => NULL,
			'subject' => 'Fwd: mail do projektu $3',
			'message' => '

-------- Wiadomość oryginalna --------
Temat: Fwd: mail do projektu $16
Data: 2015-03-27 11:59
Od: m.rusiecki@febdev.pl
Do: Crm <crm@febdev.pl>

-------- Wiadomość oryginalna --------
Temat: Fwd: mail do leadu #16
Data: 2015-03-27 11:22
Od: m.rusiecki@febdev.pl
Do: Crm <crm@febdev.pl>

-------- Wiadomość oryginalna --------
Temat: mail do leadu #16
Data: 2015-03-27 11:19
Od: m.rusiecki@febdev.pl
Do: Crm <crm@febdev.pl>

Log projektu [koordynator, kierownik, handlowiec] to
automatycznie generowana lista ostatnich wydarzeń w projekcie.
Jeżeli zdarzenie jest związane z użytkownikiem, to w celu
łatwiejszej identyfikacji można dodać kolor i awatar użytkownika.
Log można filtrować wg typu zdarzenia (wybierając odpowiednią
ikonę w nagłówku) oraz tekstowo, na zasadach ogólnych dla
systemu. Odnotowywane są takie zdarzenia jak:
● Nadejście maila na systemowy adres email
● Dodanie nowego pliku do dokumentów
● Usunięcie pliku
● Dodanie nowej wersji (aktualizacja) pliku
● Data wydarzenia, zgodnie z harmonogramem
● Wystąpienie wydarzenia, oznaczone przez użytkownika
● Otwarcie projektu
● Zamknięcie projektu
● Dodanie / usunięcie osób w projekcie
● Dodanie / usunięcie / zmiana pozycji budżetowej
● Realizacja kamienia milowego
● Wystawienie / opłacenie faktury
',
			'from' => 'm.rusiecki@febdev.pl',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => '2015-03-27 11:59:00',
			'created' => '2015-03-27 11:59:00',
			'modified' => '2015-03-27 11:59:00'
		),
		array(
			'id' => '434',
			'client_project_id' => '3',
			'type_log_id' => '1',
			'name' => NULL,
			'subject' => 'mail do projektu $3 jddj',
			'message' => '<div dir=\\"ltr\\"><span style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\">Maila wysyłałem z załącznikiem / bo takie sytuacje będą</span><br style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\"><div class=\\"\\" style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>Fwd: Fwd: Przekazanie projektu :: #8</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Thu, 19 Mar 2015 13:49:35 +0100</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Marcin Rudzik <a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">&lt;m.rudzik@feb.net.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:crm@febdev.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">crm@febdev.pl</a></td></tr></tbody></table><br><br><br><div class=\\"\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>Fwd: Przekazanie projektu :: #8</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Thu, 19 Mar 2015 13:46:11 +0100</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Marcin Rudzik <a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">&lt;m.rudzik@feb.net.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:crm@febdev.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">crm@febdev.pl</a></td></tr></tbody></table><br><br><br><div class=\\"\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>Przekazanie projektu :: #13</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Thu, 19 Mar 2015 13:42:13 +0100</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Marcin Rudzik <a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">&lt;m.rudzik@feb.net.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:crm@febdev.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">crm@febdev.pl</a></td></tr></tbody></table><br><br>PRzekazanie tematu:<br><br>Osoba kontaktowa<br>Dane do faktury<br><br>link : <a class=\\"\\" href=\\"http://b2b.febdev.pl/vacations/index/2015#vacations\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">http://b2b.febdev.pl/vacations/index/2015#vacations</a><br><br><table class=\\"\\" border=\\"1\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"border-collapse:collapse;border:none\\"><tbody><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border:1pt solid windowtext\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr></tbody></table><br><br>ccccedsdafasfdsafd<font color=\\"#009900\\">asddsadasdasd</font> <br><div class=\\"\\">-- <br><div class=\\"\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"> </p><div><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><br><br><span style=\\"font-size:12pt\\"></span></p><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><td rowspan=\\"4\\" valign=\\"top\\" width=\\"122\\" style=\\"width:91.25pt\\"><p align=\\"center\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black;text-align:center\\"><span style=\\"font-family:Arial,sans-serif;color:rgb(165,165,165)\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.2&amp;_embed=1&amp;_mimeclass=image\\" height=\\"73\\" width=\\"71\\" style=\\"border: 0px;\\"></span><span style=\\"font-family:Arial,sans-serif;color:rgb(165,165,165)\\"><br><br><br></span></p></td><td colspan=\\"2\\" style=\\"border:none;padding:6pt 6pt 0cm\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 12pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:9pt;font-family:Arial,sans-serif\\">Pozdrawiam<br><b>Marcin Rudzik<br></b></span><b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Koordynator Projektów</span></b><b><span style=\\"font-size:9pt;font-family:Arial,sans-serif\\"></span></b></p></td></tr><tr style=\\"height:20pt\\"><td colspan=\\"2\\" style=\\"border:none;height:20pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 12pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">(+48) 725 823 919<br></span><span style=\\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(247,150,70)\\"><a href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"color:rgb(247,150,70)\\">m.rudzik@feb.net.pl</span></a></span><span style=\\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(247,150,70)\\"></span></p></td></tr><tr><td width=\\"195\\" style=\\"width:146.25pt;border:none;padding:6pt\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Fabryka e-biznesu Sp. z o.o.</span></b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\"> <br>ul. Słowackiego 24<br>35-060 Rzeszów<br><span class=\\"\\">tel</span>/fax: +48 17 852 92 46</span></p></td><td width=\\"216\\" style=\\"width:162pt\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Oddział w Warszawie:</span></b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\"><br>al. Niepodległości 124/2<br>02-577 Warszawa<br><span class=\\"\\">tel</span>/fax: +48 22 299 05 43</span></p></td></tr><tr><td style=\\"border:none;padding:0cm\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\"><tbody><tr><td width=\\"22\\" style=\\"width:16.5pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://feb.net.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;color:rgb(165,165,165);text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.3&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"29\\" width=\\"22\\" style=\\"border: 0px;\\"></span></a></p></td><td width=\\"70\\" style=\\"width:52.5pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:12pt\\"><a href=\\"http://feb.net.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165);text-decoration:none\\">feb.net.pl</span></a></span></p></td></tr></tbody></table></td><td style=\\"padding:0cm\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\"><tbody><tr><td width=\\"25\\" style=\\"width:18.75pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://facebook.com/fabrykaebiznesu\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;color:rgb(165,165,165);text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.4&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"25\\" width=\\"25\\" style=\\"border: 0px;\\"></span></a></p></td><td width=\\"180\\" style=\\"width:135pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:12pt\\"><a href=\\"http://facebook.com/fabrykaebiznesu\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165);text-decoration:none\\">facebook.com/<span class=\\"\\">fabrykaebiznesu</span></span></a></span></p></td></tr></tbody></table></td></tr><tr><td colspan=\\"4\\" style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Należymy do:</span></p></td></tr><tr><td colspan=\\"2\\" style=\\"padding:0cm\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\"><tbody><tr><td><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://www.klasterit.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.5&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"25\\" width=\\"95\\" style=\\"border: 0px;\\"></span></a></p></td><td><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://www.klasterlotniczy.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.6&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"41\\" width=\\"124\\" style=\\"border: 0px;\\"></span></a></p></td></tr></tbody></table></td><td style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><a href=\\"https://www.deloitte.com/view/en_GX/global/industries/technology-media-telecommunications/deloitte-technology-fast-500/deloitte-technology-fast-500-emea/c35f6952b691b310VgnVCM1000003156f70aRCRD.htm\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple\\"><span style=\\"font-family:Arial,sans-serif;text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.7&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"43\\" width=\\"131\\" style=\\"border: 0px;\\"></span></a></p></td><td style=\\"padding:0cm\\"><br></td></tr><tr><td colspan=\\"2\\" style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><span style=\\"font-size:6pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">NIP: 813-35-63-947, REGON: 180361630, KRS: 0000313751 <br><span class=\\"\\">Alior</span> Bank S.A. 82 2490 0005 0000 4530 6177 1504, Kapitał zakładowy: 180.000 PLN</span></p></td><td style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><span style=\\"font-size:6pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Jesteśmy laureatem prestiżowego rankingu Deloitte <br>pod patronatem Forbes w kategorii „Wschodzące Gwiazdy&quot;.</span></p></td></tr></tbody></table></div></div></div></div></div></div>
</div>
',
			'from' => 'Mateusz <mateuszr87@gmail.com>',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => '2015-03-27 12:10:00',
			'created' => '2015-03-27 12:10:00',
			'modified' => '2015-03-27 12:10:00'
		),
		array(
			'id' => '435',
			'client_project_id' => '3',
			'type_log_id' => '1',
			'name' => NULL,
			'subject' => 'jjjjj $3',
			'message' => '<div dir=\\"ltr\\"><span style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\">Maila wysyłałem z załącznikiem / bo takie sytuacje będą</span><br style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\"><div class=\\"\\" style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>Fwd: Fwd: Przekazanie projektu :: #8</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Thu, 19 Mar 2015 13:49:35 +0100</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Marcin Rudzik <a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">&lt;m.rudzik@feb.net.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:crm@febdev.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">crm@febdev.pl</a></td></tr></tbody></table><br><br><br><div class=\\"\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>Fwd: Przekazanie projektu :: #8</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Thu, 19 Mar 2015 13:46:11 +0100</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Marcin Rudzik <a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">&lt;m.rudzik@feb.net.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:crm@febdev.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">crm@febdev.pl</a></td></tr></tbody></table><br><br><br><div class=\\"\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>Przekazanie projektu :: #13</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Thu, 19 Mar 2015 13:42:13 +0100</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Marcin Rudzik <a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">&lt;m.rudzik@feb.net.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:crm@febdev.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">crm@febdev.pl</a></td></tr></tbody></table><br><br>PRzekazanie tematu:<br><br>Osoba kontaktowa<br>Dane do faktury<br><br>link : <a class=\\"\\" href=\\"http://b2b.febdev.pl/vacations/index/2015#vacations\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\">http://b2b.febdev.pl/vacations/index/2015#vacations</a><br><br><table class=\\"\\" border=\\"1\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"border-collapse:collapse;border:none\\"><tbody><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border:1pt solid windowtext\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-style:solid solid solid none;border-top-color:windowtext;border-right-color:windowtext;border-bottom-color:windowtext;border-top-width:1pt;border-right-width:1pt;border-bottom-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr><tr><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-style:none solid solid;border-right-color:windowtext;border-bottom-color:windowtext;border-left-color:windowtext;border-right-width:1pt;border-bottom-width:1pt;border-left-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.75pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td><td valign=\\"top\\" width=\\"102\\" style=\\"width:76.8pt;border-top-style:none;border-left-style:none;border-right-style:solid;border-right-color:windowtext;border-right-width:1pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black\\"> </p></td></tr></tbody></table><br><br>ccccedsdafasfdsafd<font color=\\"#009900\\">asddsadasdasd</font> <br><div class=\\"\\">-- <br><div class=\\"\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"> </p><div><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><br><br><span style=\\"font-size:12pt\\"></span></p><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><td rowspan=\\"4\\" valign=\\"top\\" width=\\"122\\" style=\\"width:91.25pt\\"><p align=\\"center\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black;text-align:center\\"><span style=\\"font-family:Arial,sans-serif;color:rgb(165,165,165)\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.2&amp;_embed=1&amp;_mimeclass=image\\" height=\\"73\\" width=\\"71\\" style=\\"border: 0px;\\"></span><span style=\\"font-family:Arial,sans-serif;color:rgb(165,165,165)\\"><br><br><br></span></p></td><td colspan=\\"2\\" style=\\"border:none;padding:6pt 6pt 0cm\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 12pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:9pt;font-family:Arial,sans-serif\\">Pozdrawiam<br><b>Marcin Rudzik<br></b></span><b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Koordynator Projektów</span></b><b><span style=\\"font-size:9pt;font-family:Arial,sans-serif\\"></span></b></p></td></tr><tr style=\\"height:20pt\\"><td colspan=\\"2\\" style=\\"border:none;height:20pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 12pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">(+48) 725 823 919<br></span><span style=\\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(247,150,70)\\"><a href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"color:rgb(247,150,70)\\">m.rudzik@feb.net.pl</span></a></span><span style=\\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(247,150,70)\\"></span></p></td></tr><tr><td width=\\"195\\" style=\\"width:146.25pt;border:none;padding:6pt\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Fabryka e-biznesu Sp. z o.o.</span></b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\"> <br>ul. Słowackiego 24<br>35-060 Rzeszów<br><span class=\\"\\">tel</span>/fax: +48 17 852 92 46</span></p></td><td width=\\"216\\" style=\\"width:162pt\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Oddział w Warszawie:</span></b><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\"><br>al. Niepodległości 124/2<br>02-577 Warszawa<br><span class=\\"\\">tel</span>/fax: +48 22 299 05 43</span></p></td></tr><tr><td style=\\"border:none;padding:0cm\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\"><tbody><tr><td width=\\"22\\" style=\\"width:16.5pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://feb.net.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;color:rgb(165,165,165);text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.3&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"29\\" width=\\"22\\" style=\\"border: 0px;\\"></span></a></p></td><td width=\\"70\\" style=\\"width:52.5pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:12pt\\"><a href=\\"http://feb.net.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165);text-decoration:none\\">feb.net.pl</span></a></span></p></td></tr></tbody></table></td><td style=\\"padding:0cm\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\"><tbody><tr><td width=\\"25\\" style=\\"width:18.75pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://facebook.com/fabrykaebiznesu\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;color:rgb(165,165,165);text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.4&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"25\\" width=\\"25\\" style=\\"border: 0px;\\"></span></a></p></td><td width=\\"180\\" style=\\"width:135pt\\"><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><span style=\\"font-size:12pt\\"><a href=\\"http://facebook.com/fabrykaebiznesu\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165);text-decoration:none\\">facebook.com/<span class=\\"\\">fabrykaebiznesu</span></span></a></span></p></td></tr></tbody></table></td></tr><tr><td colspan=\\"4\\" style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><span style=\\"font-size:8pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Należymy do:</span></p></td></tr><tr><td colspan=\\"2\\" style=\\"padding:0cm\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\"><tbody><tr><td><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://www.klasterit.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.5&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"25\\" width=\\"95\\" style=\\"border: 0px;\\"></span></a></p></td><td><p class=\\"MsoNormal\\" style=\\"margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif;color:black;line-height:15.6933336257935px\\"><a href=\\"http://www.klasterlotniczy.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple;font-family:&#39;Times New Roman&#39;,serif\\"><span style=\\"font-size:12pt;text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.6&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"41\\" width=\\"124\\" style=\\"border: 0px;\\"></span></a></p></td></tr></tbody></table></td><td style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><a href=\\"https://www.deloitte.com/view/en_GX/global/industries/technology-media-telecommunications/deloitte-technology-fast-500/deloitte-technology-fast-500-emea/c35f6952b691b310VgnVCM1000003156f70aRCRD.htm\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:purple\\"><span style=\\"font-family:Arial,sans-serif;text-decoration:none\\"><img src=\\"http://mail.febdev.pl/roundcube/?_task=mail&amp;_uid=119&amp;_mbox=INBOX&amp;_action=get&amp;_part=1.2.7&amp;_embed=1&amp;_mimeclass=image\\" border=\\"0\\" height=\\"43\\" width=\\"131\\" style=\\"border: 0px;\\"></span></a></p></td><td style=\\"padding:0cm\\"><br></td></tr><tr><td colspan=\\"2\\" style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><span style=\\"font-size:6pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">NIP: 813-35-63-947, REGON: 180361630, KRS: 0000313751 <br><span class=\\"\\">Alior</span> Bank S.A. 82 2490 0005 0000 4530 6177 1504, Kapitał zakładowy: 180.000 PLN</span></p></td><td style=\\"padding:0cm\\"><p style=\\"margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&#39;Times New Roman&#39;,serif;color:black\\"><span style=\\"font-size:6pt;font-family:Arial,sans-serif;color:rgb(165,165,165)\\">Jesteśmy laureatem prestiżowego rankingu Deloitte <br>pod patronatem Forbes w kategorii „Wschodzące Gwiazdy&quot;.</span></p></td></tr></tbody></table></div></div></div></div></div></div>
</div>
',
			'from' => 'Mateusz <mateuszr87@gmail.com>',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => '2015-03-27 12:11:00',
			'created' => '2015-03-27 12:11:00',
			'modified' => '2015-03-27 12:11:00'
		),
		array(
			'id' => '436',
			'client_project_id' => '12',
			'type_log_id' => '2',
			'name' => 'photo.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-03 08:35:13',
			'modified' => '2015-04-03 08:35:13'
		),
		array(
			'id' => '437',
			'client_project_id' => '12',
			'type_log_id' => '1',
			'name' => NULL,
			'subject' => 'email z html do projektu $12',
			'message' => '<div dir=\\"ltr\\"><span style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px;background-color:rgb(245,245,245)\\">info od Shopera na nasze zapytanie </span><br style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px\\"><div class=\\"\\" style=\\"color:rgb(51,51,51);font-family:&#39;Lucida Grande&#39;,Verdana,Arial,Helvetica,sans-serif;font-size:11px;margin:0px!important\\"><br><br>--- Treść przekazanej wiadomości ---<table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"border-collapse:collapse\\"><tbody><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Temat:</th><td>[ZGLOSZENIE #218185]: Re: FW: Proszę o podanie danych do instalacji oprogramowania</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Data:</th><td>Wed, 01 Apr 2015 15:08:10 +0200</td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Nadawca:</th><td>Shoper.pl <a class=\\"\\" href=\\"mailto:bok@shoper.pl\\" rel=\\"noreferrer\\" style=\\"color:rgb(15,111,184)\\">&lt;bok@shoper.pl&gt;</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Odpowiedź-Do:</th><td><a class=\\"\\" href=\\"mailto:bok@shoper.pl\\" rel=\\"noreferrer\\" style=\\"color:rgb(15,111,184)\\">bok@shoper.pl</a></td></tr><tr><th align=\\"RIGHT\\" nowrap valign=\\"BASELINE\\">Adresat:</th><td><a class=\\"\\" href=\\"mailto:m.rudzik@feb.net.pl\\" rel=\\"noreferrer\\" style=\\"color:rgb(15,111,184)\\">m.rudzik@feb.net.pl</a></td></tr></tbody></table><br><br><table align=\\"center\\" bgcolor=\\"#f5f5f5\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse;border-top-width:5px;border-top-style:solid;border-top-color:rgb(15,111,184)\\"><tbody><tr><td align=\\"center\\" valign=\\"top\\" width=\\"100%\\"><table align=\\"center\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"border-collapse:collapse\\"><tbody><tr><td width=\\"100%\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"600\\" style=\\"border-collapse:collapse;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(236,236,236)\\"><tbody><tr><td width=\\"100%\\"><table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"600\\" style=\\"border-collapse:collapse\\"><tbody><tr><td width=\\"560\\"><table align=\\"left\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"600\\" style=\\"border-collapse:collapse\\"><tbody><tr><td align=\\"left\\" valign=\\"top\\" style=\\"padding:0px\\"><table align=\\"center\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"border-collapse:collapse;float:left;margin:0px\\"><tbody><tr><td align=\\"center\\" valign=\\"middle\\" style=\\"text-align:center;padding:15px 0px;font-size:14px;color:rgb(137,143,156);line-height:23px\\"><a href=\\"http://www.shoper.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(0,174,215);text-decoration:none\\"><img src=\\"https://pomoc.shoper.pl/images/logo.png\\" alt=\\"Shoper\\" border=\\"0\\" height=\\"35\\" width=\\"120\\" style=\\"border: 0px; float: none;\\"></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table align=\\"center\\" bgcolor=\\"#f5f5f5\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td valign=\\"top\\" width=\\"100%\\"><table align=\\"center\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"border-collapse:collapse\\"><tbody><tr><td bgcolor=\\"#fff\\" width=\\"100%\\"><table class=\\"\\" bgcolor=\\"#ffffff\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td width=\\"100%\\"><table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td class=\\"\\" width=\\"20\\"><br></td><td width=\\"100%\\"><table class=\\"\\" align=\\"center\\" border=\\"0\\" cellpadding=\\"5\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td align=\\"center\\" valign=\\"middle\\" style=\\"font-size:15px;color:rgb(255,255,255);background-color:rgb(15,111,184)\\">Zgłoszenie nr: <strong>218185<strong></strong></strong></td></tr></tbody></table></td><td class=\\"\\" width=\\"20\\"><br></td></tr></tbody></table></td></tr></tbody></table><table align=\\"left\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td height=\\"40\\" width=\\"100%\\"><br></td></tr></tbody></table><table class=\\"\\" bgcolor=\\"#ffffff\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"600\\" style=\\"border-collapse:collapse\\"><tbody><tr><td width=\\"100%\\"><table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"600\\" style=\\"border-collapse:collapse\\"><tbody><tr><td class=\\"\\" width=\\"20\\"><br></td><td width=\\"560\\"><table class=\\"\\" align=\\"left\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"540\\" style=\\"border-collapse:collapse\\"><tbody><tr><td align=\\"left\\" style=\\"font-size:15px;color:rgb(48,51,54)\\">Witam serdecznie,<br><br>niestety nie jesteśmy w stanie w pełni tego zweryfikować, gdyż nie znamy Państwa asortymentu i treści jakie powinny się w nim znajdować. Jedyne co możemy wskazać to, że w pliku csv mieli Państwo 1648 produktów i tyle też widnieje w sklepie<a href=\\"http://prntscr.com/6o4etd\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(15,111,184)\\">http://prntscr.com/6o4etd</a><br><br>Jeżeli podczas importu nie nastąpiły błędy i doszedł on do końca, a Państwo otrzymali komunikat iż 1648 zostało zaimportowanych oznacza to, że dane znajdujące się w pliku CSV zaciągnęły się w całości.<br><br>Mogą Państwo wyszukać także dany produkt po kodzie określonym na bazie pliku CSV.<br><br><br><br></td></tr></tbody></table><table class=\\"\\" align=\\"left\\" border=\\"0\\" cellpadding=\\"4\\" cellspacing=\\"0\\" width=\\"280\\" style=\\"border-collapse:collapse;background-color:rgb(239,239,239)\\"><tbody><tr><td rowspan=\\"2\\" align=\\"left\\" style=\\"padding-left:15px;font-size:13px;color:rgb(48,51,54)\\">Czy moja odpowiedź była pomocna / zrozumiała?</td><td align=\\"center\\" width=\\"30\\"><a href=\\"https://pomoc.shoper.pl/survey/pts.html?r=1&amp;sid=42&amp;tid=218185&amp;pid=662179\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(15,111,184);text-decoration:none\\"><img src=\\"https://pomoc.shoper.pl/images/plus.png\\" alt=\\"TAK\\" border=\\"0\\" height=\\"27\\" width=\\"27\\" style=\\"border: 0px; float: none;\\"></a></td><td align=\\"center\\" width=\\"40\\"><a href=\\"https://pomoc.shoper.pl/survey/pts.html?r=0&amp;sid=42&amp;tid=218185&amp;pid=662179\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(15,111,184);text-decoration:none\\"><img src=\\"https://pomoc.shoper.pl/images/minus.png\\" alt=\\"NIE\\" border=\\"0\\" height=\\"27\\" width=\\"27\\" style=\\"border: 0px; float: none;\\"></a></td></tr><tr><td align=\\"center\\" width=\\"30\\" style=\\"font-size:13px;color:rgb(48,51,54)\\"><a href=\\"https://pomoc.shoper.pl/survey/pts.html?r=1&amp;sid=42&amp;tid=218185&amp;pid=662179\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(48,51,54);text-decoration:none\\">TAK</a></td><td align=\\"center\\" width=\\"40\\" style=\\"font-size:13px;color:rgb(48,51,54)\\"><a href=\\"https://pomoc.shoper.pl/survey/pts.html?r=0&amp;sid=42&amp;tid=218185&amp;pid=662179\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(48,51,54);text-decoration:none\\">NIE</a></td></tr></tbody></table><table align=\\"left\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td height=\\"40\\" width=\\"100%\\"><br></td></tr></tbody></table><table class=\\"\\" align=\\"left\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"540\\" style=\\"border-collapse:collapse\\"><tbody><tr><td align=\\"left\\" style=\\"font-size:15px;color:rgb(48,51,54)\\"><span style=\\"font-size:13px\\">Pozdrawiam serdecznie,<br><strong>Sergiusz Olszowy</strong><br>Specjalista ds. Obsługi Klienta</span></td></tr></tbody></table><table align=\\"left\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td height=\\"40\\" width=\\"100%\\"><br></td></tr></tbody></table></td><td class=\\"\\" width=\\"20\\"><br></td></tr></tbody></table></td></tr></tbody></table><table class=\\"\\" bgcolor=\\"#ffffff\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td width=\\"100%\\"><table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td class=\\"\\" width=\\"20\\"><br></td><td width=\\"100%\\"><table class=\\"\\" align=\\"left\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td align=\\"center\\" height=\\"70\\" valign=\\"middle\\" width=\\"100\\" style=\\"background-color:rgb(125,198,65)\\"><img src=\\"https://pomoc.shoper.pl/images/akademia.png\\" border=\\"0\\" height=\\"60\\" width=\\"62\\" style=\\"border: 0px; display: inline-block;\\"></td><td align=\\"center\\" style=\\"font-size:15px;color:rgb(255,255,255);background-color:rgb(125,198,65)\\"><span style=\\"font-size:12px\\">Zapisz się na bezpłatne szkolenie online i dowiedz się jak sprzedawać w sieci. <br>Bez wychodzenia z domu. W każdą środę o 10:00. <br><a href=\\"https://akademiashoper-shoper.clickwebinar.pl/prezentacja-online/register?lang=pl%0A\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(255,255,255)\\"><strong>Zapisz się &gt;&gt;</strong></a></span></td></tr></tbody></table></td><td class=\\"\\" width=\\"20\\"><br></td></tr></tbody></table></td></tr></tbody></table><table class=\\"\\" align=\\"center\\" bgcolor=\\"#ffffff\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"600\\" style=\\"border-collapse:collapse\\"><tbody><tr><td width=\\"100%\\" style=\\"line-height:0\\"> </td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table align=\\"center\\" bgcolor=\\"#f5f5f5\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\" style=\\"border-collapse:collapse\\"><tbody><tr><td valign=\\"top\\" width=\\"100%\\"><table align=\\"center\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"border-collapse:collapse\\"><tbody><tr><td width=\\"100%\\"><table class=\\"\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"600\\" style=\\"border-collapse:collapse\\"><tbody><tr><td width=\\"100%\\"><table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"600\\" style=\\"border-collapse:collapse\\"><tbody><tr><td width=\\"600\\"><table align=\\"left\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" height=\\"86\\" width=\\"376\\" style=\\"border-collapse:collapse\\"><tbody><tr><td class=\\"\\" id=\\"foot1\\" align=\\"left\\" style=\\"padding:24px 20px 20px;font-size:14px;color:rgb(0,0,0);line-height:23px\\"><span style=\\"color:rgb(15,111,184)\\"><a class=\\"\\" href=\\"mailto:bok@shoper.pl\\" rel=\\"noreferrer\\" style=\\"color:rgb(15,111,184);text-decoration:none\\">bok@shoper.pl </a><span class=\\"\\"> | </span> <a class=\\"\\" href=\\"tel:+48123793284\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(15,111,184);text-decoration:none\\">12 379 32 84</a></span></td></tr></tbody></table><table align=\\"right\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" height=\\"86\\" width=\\"214\\" style=\\"border-collapse:collapse\\"><tbody><tr><td class=\\"\\" id=\\"foot2\\" align=\\"right\\" valign=\\"middle\\" style=\\"padding:24px 20px 20px;font-size:14px;color:rgb(0,0,0);line-height:18px\\"><a href=\\"https://www.shoper.pl/help/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(255,255,255)\\"><img src=\\"https://pomoc.shoper.pl/images/help.png\\" alt=\\"Pomoc i porady\\" title=\\"Pomoc i
                                                    porady\\" border=\\"0\\" height=\\"36\\" width=\\"36\\" style=\\"border: 0px; display: inline-block;\\"></a>   <a href=\\"https://www.youtube.com/user/shoperpl\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(255,255,255)\\"><img src=\\"https://pomoc.shoper.pl/images/yt.png\\" alt=\\"Filmy
                                                    instruktażowe\\" title=\\"Filmy
                                                    instruktażowe\\" border=\\"0\\" height=\\"36\\" width=\\"36\\" style=\\"border: 0px; display: inline-block;\\"></a>   <a href=\\"http://sugestie.shoper.pl/\\" target=\\"_blank\\" rel=\\"noreferrer\\" style=\\"color:rgb(255,255,255)\\"><img src=\\"https://pomoc.shoper.pl/images/sugestie.png\\" alt=\\"Forum Sugestii\\" title=\\"Forum
                                                    Sugestii\\" border=\\"0\\" height=\\"36\\" width=\\"36\\" style=\\"border: 0px; display: inline-block;\\"></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>
</div>
',
			'from' => 'Mateusz <mateuszr87@gmail.com>',
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => '2015-04-03 08:52:00',
			'created' => '2015-04-03 08:52:00',
			'modified' => '2015-04-03 08:52:00'
		),
		array(
			'id' => '444',
			'client_project_id' => '12',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-03 14:50:53',
			'modified' => '2015-04-03 14:50:53'
		),
		array(
			'id' => '451',
			'client_project_id' => '12',
			'type_log_id' => '2',
			'name' => '500_0_productGfx_e6c0c34b3973f5df7a06aced63727254.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'email_date' => NULL,
			'created' => '2015-04-10 11:50:23',
			'modified' => '2015-04-10 11:50:23'
		),
		array(
			'id' => '452',
			'client_project_id' => '12',
			'type_log_id' => '2',
			'name' => 'e6c0c34b3973f5df7a06aced63727254.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'email_date' => NULL,
			'created' => '2015-04-10 11:50:37',
			'modified' => '2015-04-10 11:50:37'
		),
		array(
			'id' => '453',
			'client_project_id' => '12',
			'type_log_id' => '3',
			'name' => '2015-04-10_11-50_500_0_productGfx_e6c0c34b3973f5df7a06aced63727254.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'email_date' => NULL,
			'created' => '2015-04-10 11:50:44',
			'modified' => '2015-04-10 11:50:44'
		),
		array(
			'id' => '454',
			'client_project_id' => '12',
			'type_log_id' => '3',
			'name' => '2015-04-10_11-50_e6c0c34b3973f5df7a06aced63727254.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '54d32ef2-88fc-4a30-afb4-0cc877ecc6b3',
			'email_date' => NULL,
			'created' => '2015-04-10 11:50:44',
			'modified' => '2015-04-10 11:50:44'
		),
		array(
			'id' => '456',
			'client_project_id' => '14',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 10:41:59',
			'modified' => '2015-04-14 10:41:59'
		),
		array(
			'id' => '457',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'photo.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 13:18:13',
			'modified' => '2015-04-14 13:18:13'
		),
		array(
			'id' => '458',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'selenium-ide-2.9.0.xpi',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 13:18:22',
			'modified' => '2015-04-14 13:18:22'
		),
		array(
			'id' => '459',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-14_13-18_selenium-ide-2.9.0.xpi',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 13:19:41',
			'modified' => '2015-04-14 13:19:41'
		),
		array(
			'id' => '460',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'style.css',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 13:56:53',
			'modified' => '2015-04-14 13:56:53'
		),
		array(
			'id' => '495',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-14_14-35_Zeszyt1.xlsx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 14:38:01',
			'modified' => '2015-04-14 14:38:01'
		),
		array(
			'id' => '496',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'style.css',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 15:15:53',
			'modified' => '2015-04-14 15:15:53'
		),
		array(
			'id' => '497',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'umowa_3.docx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 15:16:03',
			'modified' => '2015-04-14 15:16:03'
		),
		array(
			'id' => '498',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'Zeszyt1.xlsx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 15:16:18',
			'modified' => '2015-04-14 15:16:18'
		),
		array(
			'id' => '499',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-14_15-16_umowa_3.docx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 15:16:26',
			'modified' => '2015-04-14 15:16:26'
		),
		array(
			'id' => '500',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-14_15-15_style.css',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 15:17:03',
			'modified' => '2015-04-14 15:17:03'
		),
		array(
			'id' => '501',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-14_15-16_Zeszyt1.xlsx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 15:17:04',
			'modified' => '2015-04-14 15:17:04'
		),
		array(
			'id' => '502',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'umowa_3.docx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-14 16:08:03',
			'modified' => '2015-04-14 16:08:03'
		),
		array(
			'id' => '503',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'Zeszyt1.xlsx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:10:59',
			'modified' => '2015-04-16 14:10:59'
		),
		array(
			'id' => '504',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'Zrzut ekranu 2015-04-16 11.24.29.png',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:11:09',
			'modified' => '2015-04-16 14:11:09'
		),
		array(
			'id' => '505',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-16_14-10_Zeszyt1.xlsx',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:11:21',
			'modified' => '2015-04-16 14:11:21'
		),
		array(
			'id' => '506',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-16_14-11_Zrzut ekranu 2015-04-16 11.24.29.png',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:11:21',
			'modified' => '2015-04-16 14:11:21'
		),
		array(
			'id' => '507',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'Zrzut ekranu 2015-04-16 11.24.29.png',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:16:02',
			'modified' => '2015-04-16 14:16:02'
		),
		array(
			'id' => '508',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-16_14-16_Zrzut ekranu 2015-04-16 11.24.29.png',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:16:55',
			'modified' => '2015-04-16 14:16:55'
		),
		array(
			'id' => '509',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'style.css',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:28:12',
			'modified' => '2015-04-16 14:28:12'
		),
		array(
			'id' => '510',
			'client_project_id' => '10',
			'type_log_id' => '2',
			'name' => 'style.css',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:28:14',
			'modified' => '2015-04-16 14:28:14'
		),
		array(
			'id' => '511',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-16_14-28_style.css',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:28:26',
			'modified' => '2015-04-16 14:28:26'
		),
		array(
			'id' => '512',
			'client_project_id' => '10',
			'type_log_id' => '3',
			'name' => '2015-04-16_14-28_style.css',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-16 14:28:26',
			'modified' => '2015-04-16 14:28:26'
		),
		array(
			'id' => '513',
			'client_project_id' => '15',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-17 09:43:25',
			'modified' => '2015-04-17 09:43:25'
		),
		array(
			'id' => '515',
			'client_project_id' => '16',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-20 15:28:01',
			'modified' => '2015-04-20 15:28:01'
		),
		array(
			'id' => '516',
			'client_project_id' => '17',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-20 15:32:03',
			'modified' => '2015-04-20 15:32:03'
		),
		array(
			'id' => '517',
			'client_project_id' => '18',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-20 15:33:28',
			'modified' => '2015-04-20 15:33:28'
		),
		array(
			'id' => '518',
			'client_project_id' => '19',
			'type_log_id' => '7',
			'name' => NULL,
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-20 15:41:58',
			'modified' => '2015-04-20 15:41:58'
		),
		array(
			'id' => '519',
			'client_project_id' => '9',
			'type_log_id' => '2',
			'name' => 'photo.jpg',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-21 10:05:17',
			'modified' => '2015-04-21 10:05:17'
		),
		array(
			'id' => '520',
			'client_project_id' => '9',
			'type_log_id' => '17',
			'name' => '2015-04-21 11:58',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-21 11:58:54',
			'modified' => '2015-04-21 11:58:54'
		),
		array(
			'id' => '521',
			'client_project_id' => '9',
			'type_log_id' => '14',
			'name' => '2015-04-21 12:02',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-21 12:02:20',
			'modified' => '2015-04-21 12:02:20'
		),
		array(
			'id' => '526',
			'client_project_id' => '9',
			'type_log_id' => '17',
			'name' => '2015-04-21 13:19',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-21 13:19:05',
			'modified' => '2015-04-21 13:19:05'
		),
		array(
			'id' => '527',
			'client_project_id' => '9',
			'type_log_id' => '14',
			'name' => '2015-04-21 13:19',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-21 13:19:15',
			'modified' => '2015-04-21 13:19:15'
		),
		array(
			'id' => '528',
			'client_project_id' => '9',
			'type_log_id' => '17',
			'name' => '2015-04-21 13:23',
			'subject' => NULL,
			'message' => NULL,
			'from' => NULL,
			'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2',
			'email_date' => NULL,
			'created' => '2015-04-21 13:23:42',
			'modified' => '2015-04-21 13:23:42'
		),
	);

}
