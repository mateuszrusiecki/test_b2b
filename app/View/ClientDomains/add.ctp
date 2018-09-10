<?php $this->Html->addCrumb(__d('public', 'Lista'), array('action'=>'index',$project_id)); ?>
<?php echo $this->Metronic->portlet($title); ?>
<div class="clientDomains form">
    <?php echo $this->Form->create('ClientDomain'); ?>
    <fieldset>
        <?php
        echo $this->Metronic->input('domain');
        ?>
    </fieldset>
    <button class="btn pull-right bg-red" type="submit"><?php echo  __('public','Submit') ?></button>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>