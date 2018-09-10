<div class="partners form">
<?php echo $this->Form->create('Partner', array('type'=>'file'));?>
	<?php echo $this->element('partners/form'); ?>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Partners'), array('action' => 'index'));?></li>
	</ul>
</div>
