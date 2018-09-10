<div class="baners form">
<?php echo $this->Form->create('Baner', array('type' => 'file'));?>
    <?php echo $this->Form->input('id'); ?>
    <?php echo $this->element('form', array('plugin' => 'baner', 'desc' => __('Edycja banera'))); ?>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Baner.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Baner.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Baners'), array('action' => 'index'));?></li>
	</ul>
</div>