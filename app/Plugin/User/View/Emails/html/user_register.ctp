<p>
    <?php echo __d('users', 'Witaj,'); ?>
</p>
<p>
    <?php echo __d('users', 'Aby dokończyć proces rejestracji, należy kliknąć (lub wkleić w pasek adresu przeglądarki) poniższy link:'); ?>
</p>
<p>
    <?php $link = Router::url(array('admin' => false, 'controller' => 'users', 'action' => 'activate', $user['User']['id'], $user['User']['md5']), true); ?>

    <a href="<?php echo $link; ?>"><?php echo $link; ?></a>
</p>
