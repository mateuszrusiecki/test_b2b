<fieldset>
	<legend><?php echo __('Partnerzy'); ?></legend>

    <?php echo $this->Form->input('name'); ?>
    <?php echo $this->Form->input('link'); ?>
</fieldset>
<fieldset>
    <legend>Logo</legend>
    <?php echo $this->FebForm->input('img', array('type'=>'file','label'=>false)); ?>
</fieldset>
<fieldset class="textareaFull" style="display: none;">
    <legend>Opis</legend>
    <?php echo $this->FebTinyMce->input('content',array(),'full', array()); ?>
</fieldset>