<?php echo __d('public', 'Witaj'); ?> <?php echo $user['email'] ?>,


<?php echo __d('public', 'Aby ustawić nowe hasło, kliknij poniższy link:'); ?>


<?php echo Router::url($resetLink, true); ?>


<?php __('Zgłoszenie wysłane:') ?> <?php echo date('Y-m-d H:i:s'); ?>, <?php __('z adresu:') ?> <?php echo $ip; ?>
