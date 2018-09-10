<div class="suggestions form">
<?php echo $this->Form->create('Suggestion'); ?>
	<fieldset>
		<legend><?php echo __('Add Suggestion'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Suggestions'), array('action' => 'index')); ?></li>
	</ul>
</div>
