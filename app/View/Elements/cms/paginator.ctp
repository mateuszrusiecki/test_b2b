<p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __d('cms', 'Strona %page% z %pages%, pokazano %current% rekordów (%count% wszystkich), zaczynająć od %start%, a kończąc na %end%')
    ));
    ?>	</p>
<div class="paging">
    <?php echo $this->Paginator->prev('<< ' . __d('cms', 'poprzednia'), array(), null, array('class' => 'disabled')); ?>
    | 	<?php echo $this->Paginator->numbers(); ?>
    |
    <?php echo $this->Paginator->next(__d('cms', 'następna') . ' >>', array(), null, array('class' => 'disabled')); ?>
</div>