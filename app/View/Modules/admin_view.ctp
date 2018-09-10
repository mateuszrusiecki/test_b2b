<div class="modules view">
<h2><?php  echo __('Module');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($module['Module']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client Project'); ?></dt>
		<dd>
			<?php echo $this->Html->link($module['ClientProject']['name'], array('controller' => 'client_projects', 'action' => 'view', $module['ClientProject']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Module Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($module['ModuleCategory']['name'], array('controller' => 'module_categories', 'action' => 'view', $module['ModuleCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($module['Module']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Desc'); ?></dt>
		<dd>
			<?php echo h($module['Module']['desc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Img'); ?></dt>
		<dd>
			<?php echo h($module['Module']['img']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Lang'); ?></dt>
		<dd>
			<?php echo h($module['Module']['lang']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Manager User Id'); ?></dt>
		<dd>
			<?php echo h($module['Module']['manager_user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Contact User Id'); ?></dt>
		<dd>
			<?php echo h($module['Module']['contact_user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', ' Comments'); ?></dt>
		<dd>
			<?php echo h($module['Module'][' comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Rep Type'); ?></dt>
		<dd>
			<?php echo h($module['Module']['rep_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Rep Path'); ?></dt>
		<dd>
			<?php echo h($module['Module']['rep_path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($module['Module']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($module['Module']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Module'), array('action' => 'edit', $module['Module']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Module'), array('action' => 'delete', $module['Module']['id']), null, __('Are you sure you want to delete # %s?', $module['Module']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Modules'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Module'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Projects'), array('controller' => 'client_projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Project'), array('controller' => 'client_projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Module Categories'), array('controller' => 'module_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Module Category'), array('controller' => 'module_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
