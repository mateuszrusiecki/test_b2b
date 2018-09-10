<div class="categories form">
    <?php echo $this->Form->create('Menu'); ?>
    <?php echo $this->element('fields'); ?>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?></li>
    </ul>
</div>