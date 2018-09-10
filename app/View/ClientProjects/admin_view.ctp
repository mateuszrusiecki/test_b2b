<div class="clientProjects view">
<h2><?php  echo __('Client Project');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Alias'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client Lead'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientProject['ClientLead']['name'], array('controller' => 'client_leads', 'action' => 'view', $clientProject['ClientLead']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'User Id'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Seo Domen'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['seo_domen']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Status'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Budget'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['budget']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Start Project'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['start_project']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'End Project'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['end_project']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($clientProject['ClientProject']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Client Project'), array('action' => 'edit', $clientProject['ClientProject']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Client Project'), array('action' => 'delete', $clientProject['ClientProject']['id']), null, __('Are you sure you want to delete # %s?', $clientProject['ClientProject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Projects'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Project'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Leads'), array('controller' => 'client_leads', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Lead'), array('controller' => 'client_leads', 'action' => 'add')); ?> </li>
	</ul>
</div>
