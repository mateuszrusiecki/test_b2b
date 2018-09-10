<?php echo $this->Metronic->portlet($title); ?>
<div class="modules form">
    <?php echo $this->Form->create('Module', array('type' => 'file')); ?>
    <?php echo $this->element('Modules/fields'); ?>
    <?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>