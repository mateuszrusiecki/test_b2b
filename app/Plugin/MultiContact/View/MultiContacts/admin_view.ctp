<div class="multiContacts view">
<h2><?php  echo __('Multi Contact');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($multiContact['MultiContact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Label'); ?></dt>
		<dd>
			<?php echo h($multiContact['MultiContact']['label']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Content'); ?></dt>
		<dd>
			<?php echo h($multiContact['MultiContact']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Latitude'); ?></dt>
		<dd>
			<?php echo h($multiContact['MultiContact']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Longitude'); ?></dt>
		<dd>
			<?php echo h($multiContact['MultiContact']['longitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($multiContact['MultiContact']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($multiContact['MultiContact']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Multi Contact'), array('action' => 'edit', $multiContact['MultiContact']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Multi Contact'), array('action' => 'delete', $multiContact['MultiContact']['id']), null, __('Are you sure you want to delete # %s?', $multiContact['MultiContact']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Multi Contacts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Multi Contact'), array('action' => 'add')); ?> </li>
	</ul>
</div>
