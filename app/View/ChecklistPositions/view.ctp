<div class="checklistPositions view">
<h2><?php  echo __('Checklist Position');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($checklistPosition['ChecklistPosition']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($checklistPosition['ChecklistPosition']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($checklistPosition['ChecklistPosition']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($checklistPosition['ChecklistPosition']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Checklist Position'), array('action' => 'edit', $checklistPosition['ChecklistPosition']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Checklist Position'), array('action' => 'delete', $checklistPosition['ChecklistPosition']['id']), null, __('Are you sure you want to delete # %s?', $checklistPosition['ChecklistPosition']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Checklist Positions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Checklist Position'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Groups');?></h3>
	<?php if (!empty($checklistPosition['Group'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Alias'); ?></th>
		<th><?php echo __('Permission Groups'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($checklistPosition['Group'] as $group): ?>
		<tr>
			<td><?php echo $group['id'];?></td>
			<td><?php echo $group['order'];?></td>
			<td><?php echo $group['name'];?></td>
			<td><?php echo $group['alias'];?></td>
			<td><?php echo $group['permission_groups'];?></td>
			<td><?php echo $group['created'];?></td>
			<td><?php echo $group['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'groups', 'action' => 'edit', $group['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'groups', 'action' => 'delete', $group['id']), null, __('Are you sure you want to delete # %s?', $group['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
