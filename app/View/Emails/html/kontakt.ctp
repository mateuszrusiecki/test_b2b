<p><?php echo __d('public', 'Imię i nazwisko').': '.$data['Page']['name']; ?></p>


<p><?php echo __d('public', 'E-mail').': '.$data['Page']['email']; ?></p>


<p><?php echo __d('public', 'Telefon').': '.$data['Page']['phone']; ?></p>


<p><?php echo __d('public', 'Treść').': '.nl2br($data['Page']['desc']); ?></p>