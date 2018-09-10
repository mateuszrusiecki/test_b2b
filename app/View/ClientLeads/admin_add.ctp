<div class="clientLeads form">
<?php echo $this->Form->create('ClientLead'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Client Lead'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('client_id');
		echo $this->Form->input('lead_category_id');
		echo $this->Form->input('lead_status_id');
		echo $this->Form->input('probability');
		echo $this->Form->input('amount');
		echo $this->Form->input('currency_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('comment');
		echo $this->Form->input('closing_date');
		echo $this->Form->input('ClientContact');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Client Leads'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lead Categories'), array('controller' => 'lead_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lead Category'), array('controller' => 'lead_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lead Statuses'), array('controller' => 'lead_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lead Status'), array('controller' => 'lead_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies'), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency'), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Contacts'), array('controller' => 'client_contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Contact'), array('controller' => 'client_contacts', 'action' => 'add')); ?> </li>
	</ul>
</div>
