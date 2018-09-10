<div class="partners form">
<?php echo $this->Form->create('Partner', array('type'=>'file'));?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->element('partners/form'); ?>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Partner.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Partner.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Lista partnerów'), array('action' => 'index'));?></li>
	</ul>
</div>
