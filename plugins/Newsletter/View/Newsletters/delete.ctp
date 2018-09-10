<div id="page">
    <h2 class="big"><?php echo __d('public', 'Rezygnuję z newslettera'); ?></h2>
    <p><?php echo __d('public', 'Twój adres email to'); ?> <b><?php echo $newsletter['Newsletter']['email']; ?></b></p>
    <p><?php echo __d('public', 'Czy jesteś pewien ze chcesz usunąć go z listy newslettera?'); ?></p>
    
    <?php
    echo $this->Form->create('Newsletter', array('url' => array('admin' => false,'plugin' => 'newsletter', 'controller' => 'newsletters', 'action' => 'delete', md5($newsletter['Newsletter']['email']))));
    echo $this->Form->hidden('Newsletter.email');
    echo $this->Form->end(__d('public', 'Rezygnuję', array('class' => 'more')));
    ?>
</div>
