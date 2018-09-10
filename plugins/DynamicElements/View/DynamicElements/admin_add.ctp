<?php $this->set('title_for_layout', __('Nowy wycinek strony').' ('.__('fragment layoutu').')'); ?>

<div class="dynamicElements form">
<h2><?php echo  __('Nowy wycinek strony'); ?> (<?php echo  __('fragment layoutu'); ?>)</h2>
<?php echo $this->Form->create('DynamicElement');?>
	<fieldset>
 		<legend><?php echo  __('Dodaj wycinek strony'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
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

		<li><?php echo $this->Html->link(__('Lista wycinków'), array('action' => 'index'));?></li>
	</ul>
</div>