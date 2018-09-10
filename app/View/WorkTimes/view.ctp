<div class="workTimes view">
<h2><?php  echo __('Work Time');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Year'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Month'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['month']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Work Hours'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['work_hours']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Work Days'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['work_days']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Days Off'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['days_off']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Work Time'), array('action' => 'edit', $workTime['WorkTime']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Work Time'), array('action' => 'delete', $workTime['WorkTime']['id']), null, __('Are you sure you want to delete # %s?', $workTime['WorkTime']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Work Times'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Work Time'), array('action' => 'add')); ?> </li>
	</ul>
</div>
