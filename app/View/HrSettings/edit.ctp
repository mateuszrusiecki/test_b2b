<?php $this->set('title_for_layout', __d('cms', 'Edycja') . ' &bull; ' . __d('cms', 'Hr Settings')); ?>

<?php echo $this->Metronic->portlet(__d('public', 'Edtycja HR')); ?>
<div class="clearfix">
    <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('action' => 'delete', $this->Form->value('HrSetting.id')), array('class' => 'btn btn-sm red btn-sm margin-bottom pull-right poitnier'), __('Are you sure you want to delete # %s?', $this->Form->value('HrSetting.hostname'))); ?> 
    <?php echo $this->Permissions->link(__d('cms', 'List Hr Settings'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <?php echo $this->Form->create('HrSetting'); ?>
    <div class="row">
        <?php echo $this->Form->input('id'); ?>
        <?php echo $this->Element('HrSettings/fields'); ?>
    </div>
    <?php
    echo $this->Form->submit(__d('public', 'Zapisz'), array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>

