<p><big><?php echo __d('public', 'Witaj'); ?> <?php echo $user['email'] ?>,</big></p>
<p>&nbsp;</p>
<p><?php echo __d('public', 'Aby ustawić nowe hasło, kliknij poniższy link:'); ?></p>
<p>&nbsp;</p>
<?php $link = Router::url($resetLink, true); ?>
<p><a href="<?php echo $link ?>" ><?php echo $link ?></a></p>
<p>&nbsp;</p>
<p style="font-style: italic;"><?php __('Zgłoszenie wysłane:') ?> <?php echo date('Y-m-d H:i:s'); ?>, <?php __('z adresu:') ?> <?php echo $ip; ?></p>

