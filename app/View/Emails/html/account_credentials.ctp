<p><?php echo __d('public', "Witaj nowy pracowniku FEB!"); ?></p>
<p>&nbsp;</p>
<p><?php echo $this->Html->link(__d('public', "Kliknij w link aby uzyskać dostęp do systemu."), Router::url('/', true).'user/users/new_account_pass');?></p>
<p>&nbsp;</p>
<p><?php echo __d('public', 'Poniżej znajdują się dane niezbędne do rozpoczęcia pracy') ?>:</p>
<p>&nbsp;</p>
<p><?php echo nl2br($value) ?></p>
<p>&nbsp;</p>
