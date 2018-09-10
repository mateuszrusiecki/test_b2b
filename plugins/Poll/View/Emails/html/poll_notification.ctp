
<p>Dzień dobry,</p>
<p>W projekcie „<?php echo $poll['ClientProject']['name']; ?>” znajduje się ankieta przygotowana dla Państwa. Jej wypełnienie nie zajmie więcej niż 5 minut.</p>
<p><a href="<?php 
    echo Router::url(array(
        'full_base' => true,
        'plugin' => 'poll',
        'controller' => 'polls',
        'action' => 'fill',
        $poll['Poll']['hash']
    ), true);
    ?>">Link do ankiety</a></p>
<p>Dziękujemy za pomoc w doskonaleniu naszych usług, robimy to dla Państwa!</p>
<p>Kliknij <a href="<?php echo Router::url('/', true); ?>">tutaj</a> aby zalogować się do Panelu i przejść do listy dokumentów.</p>
