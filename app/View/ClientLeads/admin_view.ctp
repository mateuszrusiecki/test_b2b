<div class="clientLeads view">
<h2><?php  echo __('Client Lead'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($clientLead['ClientLead']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($clientLead['ClientLead']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientLead['Client']['name'], array('controller' => 'clients', 'action' => 'view', $clientLead['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lead Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientLead['LeadCategory']['name'], array('controller' => 'lead_categories', 'action' => 'view', $clientLead['LeadCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lead Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientLead['LeadStatus']['name'], array('controller' => 'lead_statuses', 'action' => 'view', $clientLead['LeadStatus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Probability'); ?></dt>
		<dd>
			<?php echo h($clientLead['ClientLead']['probability']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($clientLead['ClientLead']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientLead['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $clientLead['Currency']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientLead['User']['name'], array('controller' => 'users', 'action' => 'view', $clientLead['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($clientLead['ClientLead']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Closing Date'); ?></dt>
		<dd>
			<?php echo h($clientLead['ClientLead']['closing_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($clientLead['ClientLead']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($clientLead['ClientLead']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Client Lead'), array('action' => 'edit', $clientLead['ClientLead']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Client Lead'), array('action' => 'delete', $clientLead['ClientLead']['id']), null, __('Are you sure you want to delete # %s?', $clientLead['ClientLead']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Leads'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Lead'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Client Contacts'); ?></h3>
	<?php if (!empty($clientLead['ClientContact'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('Firstname'); ?></th>
		<th><?php echo __('Surname'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Phone2'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($clientLead['ClientContact'] as $clientContact): ?>
		<tr>
			<td><?php echo $clientContact['id']; ?></td>
			<td><?php echo $clientContact['client_id']; ?></td>
			<td><?php echo $clientContact['firstname']; ?></td>
			<td><?php echo $clientContact['surname']; ?></td>
			<td><?php echo $clientContact['email']; ?></td>
			<td><?php echo $clientContact['phone']; ?></td>
			<td><?php echo $clientContact['phone2']; ?></td>
			<td><?php echo $clientContact['note']; ?></td>
			<td><?php echo $clientContact['created']; ?></td>
			<td><?php echo $clientContact['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'client_contacts', 'action' => 'view', $clientContact['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'client_contacts', 'action' => 'edit', $clientContact['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'client_contacts', 'action' => 'delete', $clientContact['id']), null, __('Are you sure you want to delete # %s?', $clientContact['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Client Contact'), array('controller' => 'client_contacts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
