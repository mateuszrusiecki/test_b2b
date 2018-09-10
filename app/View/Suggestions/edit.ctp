<div class="suggestions form">
<?php echo $this->Form->create('Suggestion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Suggestion'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('content');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Suggestion.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Suggestion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Suggestions'), array('action' => 'index')); ?></li>
	</ul>
</div>
