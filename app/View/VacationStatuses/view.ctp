<div class="vacationStatuses view">
<h2><?php  echo __('Vacation Status');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($vacationStatus['VacationStatus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($vacationStatus['VacationStatus']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($vacationStatus['VacationStatus']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($vacationStatus['VacationStatus']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vacation Status'), array('action' => 'edit', $vacationStatus['VacationStatus']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vacation Status'), array('action' => 'delete', $vacationStatus['VacationStatus']['id']), null, __('Are you sure you want to delete # %s?', $vacationStatus['VacationStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vacation Statuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vacation Status'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vacations'), array('controller' => 'vacations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vacation'), array('controller' => 'vacations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Vacations');?></h3>
	<?php if (!empty($vacationStatus['Vacation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Vacation Type Id'); ?></th>
		<th><?php echo __('Date Start'); ?></th>
		<th><?php echo __('Date End'); ?></th>
		<th><?php echo __('Hour Start'); ?></th>
		<th><?php echo __('Hour End'); ?></th>
		<th><?php echo __('Vacation Status Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($vacationStatus['Vacation'] as $vacation): ?>
		<tr>
			<td><?php echo $vacation['id'];?></td>
			<td><?php echo $vacation['vacation_type_id'];?></td>
			<td><?php echo $vacation['date_start'];?></td>
			<td><?php echo $vacation['date_end'];?></td>
			<td><?php echo $vacation['hour_start'];?></td>
			<td><?php echo $vacation['hour_end'];?></td>
			<td><?php echo $vacation['vacation_status_id'];?></td>
			<td><?php echo $vacation['modified'];?></td>
			<td><?php echo $vacation['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'vacations', 'action' => 'view', $vacation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'vacations', 'action' => 'edit', $vacation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'vacations', 'action' => 'delete', $vacation['id']), null, __('Are you sure you want to delete # %s?', $vacation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vacation'), array('controller' => 'vacations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
