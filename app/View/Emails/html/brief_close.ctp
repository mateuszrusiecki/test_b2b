
<p><?php echo __d('public', 'Dzień dobry') ?>,</p>
<p>
    <?php echo __d('public', 'Dziękujemy za udzielenie wyczerpujących
informacji na temat nowego produktu. W
załączniku przesyłamy gotowy brie w formacie
PDF. W przypadku zauważenia istotnych różnic ze
stanem faktycznym, posimy o kontakt z Państwa opiekunem') ?>
:<br/>
<?php echo $value['guardian']['firstname'].' '.$value['guardian']['surname'] ?>.<br/>
 <?php if(!empty($value['guardian']['work_phone'])) echo 'Telefon: '.$value['guardian']['work_phone'] ?><br/>
 <?php if(!empty($value['guardian_email'])) echo 'Email: '.$value['guardian_email'] ?><br/><br/>

    <?php //echo __d('public', 'Kliknij') ?> <?php //echo '<a href="http://'.$_SERVER['SERVER_NAME'].'/user/users/login">tutaj</a>'?> 
    <?php //echo __d('public', 'aby zalogować się do Panelu i zapoznać się z listą dokumentów') ?>.
</p>