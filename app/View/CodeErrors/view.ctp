<div class="codeErrors view">
<h2><?php  echo __('Code Error');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($codeError['CodeError']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'User Id'); ?></dt>
		<dd>
			<?php echo h($codeError['CodeError']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($codeError['CodeError']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Message'); ?></dt>
		<dd>
			<?php echo h($codeError['CodeError']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Url'); ?></dt>
		<dd>
			<?php echo h($codeError['CodeError']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Line'); ?></dt>
		<dd>
			<?php echo h($codeError['CodeError']['line']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($codeError['CodeError']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($codeError['CodeError']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Code Error'), array('action' => 'edit', $codeError['CodeError']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Code Error'), array('action' => 'delete', $codeError['CodeError']['id']), null, __('Are you sure you want to delete # %s?', $codeError['CodeError']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Code Errors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Code Error'), array('action' => 'add')); ?> </li>
	</ul>
</div>
