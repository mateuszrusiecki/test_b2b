<p>
    <?php echo __d('public', 'Wykryto wielokrotne logowanie użytkownika') ?>:<br/><br/>
    
    <?php echo __d('public', 'Nazwa użytkownika') ?>:<b><?php echo $value[0]['UsersLog']['email'] ?>.</b><br/>
    
    <?php echo __d('public', 'Nieudane próby logowania') ?>:
    
</p>
    
<div class="table-scrollable">
    <table border="1" class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th> <?php echo __d('public', 'Lp') ?></th>
                <th> <?php echo __d('public', 'Czas'); ?></th>
                <th> <?php echo __d('public', 'IP'); ?></th>
                <th> <?php echo __d('public', 'Przeglądarka i system') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($value as $login_attempts):?>
                <tr>
                    <td><?php echo $i; ?>&nbsp;</td>
                    <td><?php echo $login_attempts['UsersLog']['created']; ?>&nbsp;</td>
                    <td><?php echo $login_attempts['UsersLog']['users_ip']; ?>&nbsp;</td>
                    <td><?php echo $login_attempts['UsersLog']['browser']; ?>&nbsp;</td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>