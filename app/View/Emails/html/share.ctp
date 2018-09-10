<p><?php echo __d('public', 'Dzień dobry') ?>,</p>
<br/>
<p><?php echo __d('public', 'Projekty realizowane przez Fabrykę e-Biznesu Sp. z o.o. są w pełni zdigitalizowane, dzięki czemu możesz na bieżąco śledzić postępy prac, tworzyć i współtworzyć dokumenty, opłacać faktury i przeglądać dostępne materiały.') ?>,</p>
<br/>

<p><?php echo __d('public', 'Aby zalogować się kliknij') ?>
    <?php echo ' <a href="http://'.$value['feb_address'].'/login">'.__d('public', 'tutaj').'</a> ' ?>
    <?php echo __d('public', 'i wprowadź swój email i hasło') ?>.
    <br/>
    <?php echo __d('public', 'Jeśli logujesz się do systemu pierwszy raz kliknij') ?>
    <?php echo ' <a href="http://'.$value['feb_address'].'/first_login">'.__d('public', 'tutaj').'</a> ' ?>
    <?php echo __d('public', 'i wprowadź swój email aby aktywować konto') ?>.
</p>
<br/>
<p><?php echo __d('public', 'Link do projektu') ?>: 
    <?php echo ' <a href="http://'.$value['feb_address'].'/client_projects/view_client/'.$project['ClientProject']['id'].'">'.$project['ClientProject']['name'].'</a>' ?></p>
<br/>
<p><?php echo __d('public', 'W razie pytań pozostajemy do dyspozycji – <br/> Zespół FEB') ?>,</p>