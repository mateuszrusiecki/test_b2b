<div class="crons view">
<h2><?php  echo __('Cron');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Active'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'N'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['N']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'M'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['m']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'D'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['d']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'H'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['H']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'I'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['i']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Url'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($cron['Cron']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cron'), array('action' => 'edit', $cron['Cron']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cron'), array('action' => 'delete', $cron['Cron']['id']), null, __('Are you sure you want to delete # %s?', $cron['Cron']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Crons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cron'), array('action' => 'add')); ?> </li>
	</ul>
</div>
