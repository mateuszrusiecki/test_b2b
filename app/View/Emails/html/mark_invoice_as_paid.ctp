<p><?php echo __d('public', 'Dzień dobry') ?>,</p><br/>
<p><?php echo __d('public', 'Dziękujemy za opłacenie faktury nr') ?> <?php echo $value['Invoice']['invoice_nr'] ?> <?php echo __d('public', 'w projekcie') ?> "<?php echo $value['ClientProject']['name'] ?>".</p>
<br/>
<br/>
<p>
    <?php echo __d('public', 'Kliknij') ?> <?php echo '<a href="http://'.$_SERVER['SERVER_NAME'].'/user/users/login">tutaj</a>'?> 
    <?php echo __d('public', 'aby zalogować się do Panelu i zapoznać się z listą dokumentów') ?>.
</p>
