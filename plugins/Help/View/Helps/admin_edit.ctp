<div class="helps form">
    <?php echo $this->Form->create('Help', array('url' => array('admin' => 'admin', 'plugin' => 'help', 'controller' => 'helps', 'action' => 'edit'))); ?>
    <fieldset>
        <legend><?php echo __('Admin Edit Help'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('url');
        echo $this->Form->input('title');
        ?>
    </fieldset>
    <fieldset>
        <legend><?php echo __('Treść'); ?></legend>
        <?php
            echo $this->FebTinyMce4->input('content', array('label' => false));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Help.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Help.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Helps'), array('action' => 'index')); ?></li>
    </ul>
</div>
