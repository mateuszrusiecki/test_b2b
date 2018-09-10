<div class="suggestions view">
<h2><?php  echo __('Suggestion'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($suggestion['Suggestion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($suggestion['Suggestion']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($suggestion['Suggestion']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($suggestion['Suggestion']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($suggestion['Suggestion']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($suggestion['Suggestion']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($suggestion['Suggestion']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Suggestion'), array('action' => 'edit', $suggestion['Suggestion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Suggestion'), array('action' => 'delete', $suggestion['Suggestion']['id']), null, __('Are you sure you want to delete # %s?', $suggestion['Suggestion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Suggestions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Suggestion'), array('action' => 'add')); ?> </li>
	</ul>
</div>
