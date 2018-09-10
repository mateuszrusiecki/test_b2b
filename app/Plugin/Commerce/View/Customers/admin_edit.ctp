<div class="customers form">
    <?php echo $this->Form->create('Customer'); ?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Element('Customers/fields', array('desc' =>  __d('cms', 'Admin Edit Customer'))); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('plugin' => false, 'action' => 'delete', $this->Form->value('Customer.id')), array('outter'=>'<li>%s</li>'), __('Are you sure you want to delete # %s?', $this->Form->value('Customer.contact_person'))); ?> 
        <?php echo $this->Permissions->link(__d('cms', 'List Customers'), array('plugin' => false, 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Users'), array('plugin' => false, 'controller' => 'users', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New User'), array('plugin' => false, 'controller' => 'users', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Addresses'), array('plugin' => false, 'controller' => 'addresses', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Address'), array('plugin' => false, 'controller' => 'addresses', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Invoice Identities'), array('plugin' => false, 'controller' => 'invoice_identities', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Invoice Identity'), array('plugin' => false, 'controller' => 'invoice_identities', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Orders'), array('plugin' => false, 'controller' => 'orders', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Order'), array('plugin' => false, 'controller' => 'orders', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
    </ul>
</div>
