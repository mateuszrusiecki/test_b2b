
<?php echo $this->Metronic->portlet('Import uprawnień'); ?>

    <?php echo $this->Form->create('PermissionsImport', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Wyślij plik (zgodny z formatem)'); ?></legend>
        <?php echo $this->Form->input('json', array('type' => 'file')); ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
    
<?php echo $this->Metronic->portletEnd(); ?> 
