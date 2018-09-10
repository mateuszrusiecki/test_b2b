<p><?php echo __d('public', 'Dzień dobry') ?>,</p><br/>
<p><?php echo __d('public', 'W dniu') ?> <?php echo $value['Invoice']['issue_date'] ?> <?php echo __d('public', 'wystawiono fakturę w projekcie') ?> "<?php echo $value['ClientProject']['name'] ?>".</p>
<p><?php echo __d('public', 'Faktura nr') ?> <?php echo $value['Invoice']['invoice_nr'] ?><br/>
<?php echo __d('public', 'Kwota netto') ?>: <?php echo $value['Invoice']['net_price'] ?> zł,<br/>
<?php echo __d('public', 'Kwota brutto') ?>: <?php echo $value['Invoice']['gross_price'] ?> zł,<br/>
<?php echo __d('public', 'Termin płatności') ?>: <?php echo $value['Invoice']['payment_date'] ?>
</p>
<br/>
<p><?php echo __d('public', 'Dziękujemy za terminowe regulowanie płatności') ?>!</p>
<br/>
<br/>
<p>
    <?php echo __d('public', 'Kliknij') ?> <?php echo '<a href="http://'.$_SERVER['SERVER_NAME'].'/user/users/login">tutaj</a>'?>  
    <?php echo __d('public', 'aby zalogować się do Panelu i zapoznać się z listą faktur') ?>.
</p>
