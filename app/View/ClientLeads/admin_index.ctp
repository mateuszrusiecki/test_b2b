<div class="clientLeads index">
	<h2><?php echo __('Client Leads'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('client_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lead_category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lead_status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('probability'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('currency_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('closing_date'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($clientLeads as $clientLead): ?>
	<tr>
		<td><?php echo h($clientLead['ClientLead']['id']); ?>&nbsp;</td>
		<td><?php echo h($clientLead['ClientLead']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($clientLead['Client']['name'], array('controller' => 'clients', 'action' => 'view', $clientLead['Client']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($clientLead['LeadCategory']['name'], array('controller' => 'lead_categories', 'action' => 'view', $clientLead['LeadCategory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($clientLead['LeadStatus']['name'], array('controller' => 'lead_statuses', 'action' => 'view', $clientLead['LeadStatus']['id'])); ?>
		</td>
		<td><?php echo h($clientLead['ClientLead']['probability']); ?>&nbsp;</td>
		<td><?php echo h($clientLead['ClientLead']['amount']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($clientLead['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $clientLead['Currency']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($clientLead['User']['name'], array('controller' => 'users', 'action' => 'view', $clientLead['User']['id'])); ?>
		</td>
		<td><?php echo h($clientLead['ClientLead']['comment']); ?>&nbsp;</td>
		<td><?php echo h($clientLead['ClientLead']['closing_date']); ?>&nbsp;</td>
		<td><?php echo h($clientLead['ClientLead']['modified']); ?>&nbsp;</td>
		<td><?php echo h($clientLead['ClientLead']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $clientLead['ClientLead']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $clientLead['ClientLead']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $clientLead['ClientLead']['id']), null, __('Are you sure you want to delete # %s?', $clientLead['ClientLead']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Client Lead'), array('action' => 'add')); ?></li>
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
