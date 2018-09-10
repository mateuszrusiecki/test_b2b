<div class="hrSettings view">
<h2><?php  echo __('Hr Setting');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($hrSetting['HrSetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Margin'); ?></dt>
		<dd>
			<?php echo h($hrSetting['HrSetting']['margin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Buffer'); ?></dt>
		<dd>
			<?php echo h($hrSetting['HrSetting']['buffer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'It Rate'); ?></dt>
		<dd>
			<?php echo h($hrSetting['HrSetting']['it_rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Hostname'); ?></dt>
		<dd>
			<?php echo h($hrSetting['HrSetting']['hostname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Username'); ?></dt>
		<dd>
			<?php echo h($hrSetting['HrSetting']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Password'); ?></dt>
		<dd>
			<?php echo h($hrSetting['HrSetting']['password']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Hr Setting'), array('action' => 'edit', $hrSetting['HrSetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Hr Setting'), array('action' => 'delete', $hrSetting['HrSetting']['id']), null, __('Are you sure you want to delete # %s?', $hrSetting['HrSetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Hr Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hr Setting'), array('action' => 'add')); ?> </li>
	</ul>
</div>
