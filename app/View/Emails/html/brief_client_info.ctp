<p><?php echo __d('public', 'Dzień dobry') ?>,</p>
<br>
<p>
    <?php echo __d('public', 'W celu zebrania informacji o Państwa potrzebach i 
    oczekiwaniach związanych z nowym produktem, 
    przygotowaliśmy indywidualny dokument – Brief –
    pozwalający na zebranie istotnych informacji') ?>
    .
</p>
<br>
<p>
    <?php echo __d('public', 'Aby przejść do edycji briefa proszę skorzystać z linku') ?>: 
    <a href="<?php echo Router::url(array('controller'=>'briefs','action'=>'view',$brief['Brief']['hid']), true); ?>">
        <?php echo __d('public', 'Kliknij tutaj aby otworzyć brief') ?>
    </a>.
</p>
<br>
<p>
    <?php //echo __d('public', 'Kliknij') ?> <?php //echo '<a href="http://'.$_SERVER['SERVER_NAME'].'/user/users/login">tutaj</a>'?> 
    <?php //echo __d('public', 'aby zalogować się do Panelu i zapoznać się z listą dokumentów') ?>.
</p>
