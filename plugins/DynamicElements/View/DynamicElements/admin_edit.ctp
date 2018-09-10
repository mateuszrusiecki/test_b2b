<?php $this->set('title_for_layout', __('Edycja wycinka strony').' ('.__('fragmentu layoutu').')'); ?>


<div class="dynamicElements form">
<h2><?php echo  __('Edycja wycinka strony'); ?> (<?php echo  __('fragmentu layoutu'); ?>)</h2>
<?php echo $this->Form->create('DynamicElement');?>
	<fieldset>
 		<legend><?php echo  __('Edytuj wycinek strony'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('slug', array('disabled'=>'disabled'));
		echo $this->Form->input('style');
	?>
	</fieldset>
    <fieldset class="textareaFull">
        <legend><?php echo __('Zawartość'); ?></legend>
        <?php echo $this->FebTinyMce4->input('content', array('label' => false,'id'=>'contentTiny'),'full'); ?>
    </fieldset>

<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo  __('Actions'); ?></h3>
	<ul>
<?php /* ?>
		<li><?php echo $this->Html->link(__('Usuń'), array('action' => 'delete', $this->Form->value('DynamicElement.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('DynamicElement.id'))); ?></li>
<?php /**/ ?>
		<li><?php echo $this->Html->link(__('Lista wycinków'), array('action' => 'index'));?></li>
	</ul>
</div>