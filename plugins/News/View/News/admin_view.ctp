<div class="news view">
<h2><?php  echo __('News');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($news['News']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Main'); ?></dt>
		<dd>
			<?php echo h($news['News']['main']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Slug'); ?></dt>
		<dd>
			<?php echo h($news['News']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Title'); ?></dt>
		<dd>
			<?php echo h($news['News']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Content'); ?></dt>
		<dd>
			<?php echo h($news['News']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($news['User']['name'], array('controller' => 'users', 'action' => 'view', $news['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Photo Id'); ?></dt>
		<dd>
			<?php echo h($news['News']['photo_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($news['News']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($news['News']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit News'), array('action' => 'edit', $news['News']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete News'), array('action' => 'delete', $news['News']['id']), null, __('Are you sure you want to delete # %s?', $news['News']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List News'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New News'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
