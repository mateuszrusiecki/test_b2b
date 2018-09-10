<div class="countries view">
<h2><?php  echo __('Country');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($country['Country']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($country['Country']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Printable Name En'); ?></dt>
		<dd>
			<?php echo h($country['Country']['printable_name_en']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Printable Name'); ?></dt>
		<dd>
			<?php echo h($country['Country']['printable_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Iso3'); ?></dt>
		<dd>
			<?php echo h($country['Country']['iso3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Numcode'); ?></dt>
		<dd>
			<?php echo h($country['Country']['numcode']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Country'), array('action' => 'edit', $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Country'), array('action' => 'delete', $country['Country']['id']), null, __('Are you sure you want to delete # %s?', $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('action' => 'add')); ?> </li>
	</ul>
</div>
