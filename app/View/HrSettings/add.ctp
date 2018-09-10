<?php $this->set('title_for_layout', __d('cms', 'Dodawanie') . ' &bull; ' . __d('cms', 'Hr Settings')); ?>
<?php echo $this->Metronic->portlet(__d('public', 'Edtycja HR')); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'List Hr Settings'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <?php echo $this->Form->create('HrSetting'); ?>
    <div class="row">
        <?php echo $this->Element('HrSettings/fields'); ?>       
    </div>
    <?php
    echo $this->Form->submit(__d('public', 'Zapisz'), array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
