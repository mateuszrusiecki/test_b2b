<div class="categories form">
    <?php echo $this->Form->create('Menu'); ?>
    <fieldset>
        <legend><?php __d('public', 'Menu'); ?></legend>	
        <?php
        echo $this->Form->input('id');
        echo $this->element('fields');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Zapisz')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d('cms', 'Menu'), array('plugin' => 'menu', 'admin' => true, 'controller' => 'menus', 'action' => 'index')); ?></li>
    </ul>
</div>