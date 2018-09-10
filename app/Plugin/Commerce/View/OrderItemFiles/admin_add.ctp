<div class="orderItemFiles form">
    <?php echo $this->Form->create('OrderItemFile'); ?>
	<?php echo $this->Element('OrderItemFiles/fields', array('desc' => __d('cms', 'Admin Add Order Item File'))); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List Order Item Files'), array('plugin' => false, 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Order Items'), array('plugin' => false, 'controller' => 'order_items', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Order Item'), array('plugin' => false, 'controller' => 'order_items', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
    </ul>
</div>
