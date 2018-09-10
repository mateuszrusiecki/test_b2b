<div class="baners form">
<?php echo $this->Form->create('Baner', array('type' => 'file'));?>
    <?php echo $this->element('form', array('plugin' => 'baner', 'desc' => __('Nowy baner'))); ?>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Baners'), array('action' => 'index'));?></li>
	</ul>
</div>