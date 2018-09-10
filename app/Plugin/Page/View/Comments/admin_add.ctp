<div class="comments form">
<?php echo $this->Form->create('Comment');?>
	<fieldset>
 		<legend><?php echo  __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->input('desc');
		echo $this->Form->input('active');
		echo $this->Form->input('page_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo  __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Comments'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Albums'), array('controller' => 'albums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album'), array('controller' => 'albums', 'action' => 'add')); ?> </li>
    </ul>
</div>