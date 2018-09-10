<div class="newsletters view">
<h2><?php  __('Newsletter');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo  __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo  __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo  __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo  __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo  __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Newsletter'), array('action' => 'edit', $newsletter['Newsletter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Newsletter'), array('action' => 'delete', $newsletter['Newsletter']['id']), null, __('Are you sure you want to delete # %s?', $newsletter['Newsletter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Newsletters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Newsletter'), array('action' => 'add')); ?> </li>
	</ul>
</div>