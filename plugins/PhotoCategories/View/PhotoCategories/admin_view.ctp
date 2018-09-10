<div class="photoCategories view">
<h2><?php  echo __('Photo Category');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($photoCategory['PhotoCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($photoCategory['PhotoCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Parent Id'); ?></dt>
		<dd>
			<?php echo h($photoCategory['PhotoCategory']['parent_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Lft'); ?></dt>
		<dd>
			<?php echo h($photoCategory['PhotoCategory']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Rght'); ?></dt>
		<dd>
			<?php echo h($photoCategory['PhotoCategory']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($photoCategory['PhotoCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($photoCategory['PhotoCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Photo Category'), array('action' => 'edit', $photoCategory['PhotoCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Photo Category'), array('action' => 'delete', $photoCategory['PhotoCategory']['id']), null, __('Are you sure you want to delete # %s?', $photoCategory['PhotoCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Photo Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo Category'), array('action' => 'add')); ?> </li>
	</ul>
</div>
