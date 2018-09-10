<p><?php echo __d('email', "Witaj!"); ?></p>
<p>&nbsp;</p>

<p><?php echo __d('email', "Aby zapisać się do newslettera, kliknij w poniższy link:"); ?></p>
<p>&nbsp;</p>

<p><?php
$link = $this->Html->url(array('controller' => 'newsletters', 'action' => 'activate', md5($email)), true);
echo $this->Html->link($link, $link);
?></p>
<p>&nbsp;</p>

<p><?php echo __d('email', "Jeśli nie zapisywałeś się do newslettera, zignoruj tę wiadomość."); ?></p>
<p>&nbsp;</p>

<p><?php echo __d('email', "Aby całkowicie usunąć email z listy należy kliknąć w poniższy link:"); ?></p>
<p>&nbsp;</p>

<p><?php
    $link = $this->Html->url(array('controller' => 'newsletters', 'action' => 'delete', md5($email)), true);
    echo $this->Html->link($link, $link);
?></p>