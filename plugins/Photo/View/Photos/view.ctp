<div class="photos view">
<h2><?php  echo __('Photo');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Img'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['img']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Offer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photo['Offer']['id'], array('controller' => 'offers', 'action' => 'view', $photo['Offer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photo['Page']['id'], array('controller' => 'pages', 'action' => 'view', $photo['Page']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Title'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Order'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Photo'), array('action' => 'edit', $photo['Photo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Photo'), array('action' => 'delete', $photo['Photo']['id']), null, __('Are you sure you want to delete # %s?', $photo['Photo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offers'), array('controller' => 'offers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offer'), array('controller' => 'offers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pages'), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page'), array('controller' => 'pages', 'action' => 'add')); ?> </li>
	</ul>
</div>
