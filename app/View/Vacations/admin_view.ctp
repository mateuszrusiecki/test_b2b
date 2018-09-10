<div class="vacations view">
<h2><?php  echo __('Vacation');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($vacation['Vacation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vacation Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vacation['VacationType']['name'], array('controller' => 'vacation_types', 'action' => 'view', $vacation['VacationType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Date Start'); ?></dt>
		<dd>
			<?php echo h($vacation['Vacation']['date_start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Date End'); ?></dt>
		<dd>
			<?php echo h($vacation['Vacation']['date_end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Hour Start'); ?></dt>
		<dd>
			<?php echo h($vacation['Vacation']['hour_start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Hour End'); ?></dt>
		<dd>
			<?php echo h($vacation['Vacation']['hour_end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vacation Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vacation['VacationStatus']['name'], array('controller' => 'vacation_statuses', 'action' => 'view', $vacation['VacationStatus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($vacation['Vacation']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($vacation['Vacation']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vacation'), array('action' => 'edit', $vacation['Vacation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vacation'), array('action' => 'delete', $vacation['Vacation']['id']), null, __('Are you sure you want to delete # %s?', $vacation['Vacation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vacations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vacation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vacation Types'), array('controller' => 'vacation_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vacation Type'), array('controller' => 'vacation_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vacation Statuses'), array('controller' => 'vacation_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vacation Status'), array('controller' => 'vacation_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vacation Replaces'), array('controller' => 'vacation_replaces', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vacation Replace'), array('controller' => 'vacation_replaces', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Vacation Replaces');?></h3>
	<?php if (!empty($vacation['VacationReplace'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Vacation Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Project Id'); ?></th>
		<th><?php echo __('No Project'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($vacation['VacationReplace'] as $vacationReplace): ?>
		<tr>
			<td><?php echo $vacationReplace['id'];?></td>
			<td><?php echo $vacationReplace['vacation_id'];?></td>
			<td><?php echo $vacationReplace['user_id'];?></td>
			<td><?php echo $vacationReplace['project_id'];?></td>
			<td><?php echo $vacationReplace['no_project'];?></td>
			<td><?php echo $vacationReplace['modified'];?></td>
			<td><?php echo $vacationReplace['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'vacation_replaces', 'action' => 'view', $vacationReplace['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'vacation_replaces', 'action' => 'edit', $vacationReplace['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'vacation_replaces', 'action' => 'delete', $vacationReplace['id']), null, __('Are you sure you want to delete # %s?', $vacationReplace['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vacation Replace'), array('controller' => 'vacation_replaces', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
