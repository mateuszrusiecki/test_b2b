<?php $this->Html->addCrumb(__d('public', 'Projekt'), array('controller'=>'client_projects','action'=>'view',$project_id)); ?>
<?php $this->Html->addCrumb(__d('public', 'Lista'), array('action'=>'index',$project_id)); ?>

<?php echo $this->Metronic->portlet($title); ?>
<div class="clearfix margin-bottom-20">
    <?php  echo $this->Form->postLink(__('public','Delete'), array('action' => 'delete', $this->Form->value('ClientDomain.id')), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier'),__('Are you sure you want to delete # %s?', $this->Form->value('ClientDomain.id'))); ?>
</div>
<div class="clientDomains form">
    <?php echo $this->Form->create('ClientDomain'); ?>
    <fieldset>
        <?php
        echo $this->Form->input('id');
        echo $this->Metronic->input('domain');
        ?>
    </fieldset>
    <button class="btn pull-right bg-red" type="submit"><?php echo  __('public','Submit') ?></button>
    <?php echo $this->Form->end(); ?>
</div>

<?php echo $this->Metronic->portletEnd(); ?>