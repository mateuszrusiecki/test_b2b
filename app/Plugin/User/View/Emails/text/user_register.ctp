<?php echo  __d('users', 'Witaj,'); ?>

<?php echo  __d('users', 'Aby dokończyć proces rejestracji, należy kliknąć (lub wkleić w pasek adresu przeglądarki) poniższy link:'); ?>

<?php echo Router::url(array('admin' => false, 'controller' => 'users', 'action' => 'activate', $user['User']['id'], $user['User']['md5']), true); ?>
