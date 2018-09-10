<div class="regions view">
<h2><?php  echo __('Region');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($region['Region']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($region['Region']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Order'); ?></dt>
		<dd>
			<?php echo h($region['Region']['order']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Region'), array('action' => 'edit', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Region'), array('action' => 'delete', $region['Region']['id']), null, __('Are you sure you want to delete # %s?', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('action' => 'add')); ?> </li>
	</ul>
</div>
