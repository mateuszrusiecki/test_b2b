
<p><?php echo __d('public', 'Dzień dobry') ?>,</p>
<p>
    <?php echo __d('public', 'W dniu ').date('Y-m-d').__d('public',' osiągnięto kamień milowy').' "'.$value['ClientProjectShedule']['name'].'" '.
            __d('public','w projekcie').' "'.$value['ClientProject']['name'].'".'?>
    <br/><br/>

    <?php echo '<a href="http://'.$value['feb_address'].'/acceptance_reports/fill/'.$value['AcceptanceReport']['hid'].'">Link do protokołu odbioru kamienia milowego</a>'?><br/>
    
<br/><br/>

    <?php echo __d('public', 'Kliknij') ?> <?php echo '<a href="http://'.$value['feb_address'].'/user/users/login">tutaj</a>'?>
    <?php echo __d('public', 'aby zalogować się do Panelu i zapoznać się z listą dokumentów') ?>.
</p>