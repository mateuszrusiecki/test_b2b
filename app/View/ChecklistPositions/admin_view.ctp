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
		<li><?php echo $this->Html->link(__('List Checklist Position User Groups'), array('controller' => 'checklist_position_user_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Checklist Position User Group'), array('controller' => 'checklist_position_user_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Checklist Position User Groups');?></h3>
	<?php if (!empty($checklistPosition['ChecklistPositionUserGroup'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Checklist Position Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($checklistPosition['ChecklistPositionUserGroup'] as $checklistPositionUserGroup): ?>
		<tr>
			<td><?php echo $checklistPositionUserGroup['id'];?></td>
			<td><?php echo $checklistPositionUserGroup['group_id'];?></td>
			<td><?php echo $checklistPositionUserGroup['checklist_position_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'checklist_position_user_groups', 'action' => 'view', $checklistPositionUserGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'checklist_position_user_groups', 'action' => 'edit', $checklistPositionUserGroup['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'checklist_position_user_groups', 'action' => 'delete', $checklistPositionUserGroup['id']), null, __('Are you sure you want to delete # %s?', $checklistPositionUserGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Checklist Position User Group'), array('controller' => 'checklist_position_user_groups', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
