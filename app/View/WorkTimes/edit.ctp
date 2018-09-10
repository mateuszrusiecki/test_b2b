<?php $this->set('title_for_layout', __d('cms', 'Edycja') . ' &bull; ' . __d('cms', 'Work Times')); ?>

<?php echo $this->Metronic->portlet(__d('public','Edit Work Time')); ?>
<div class="clearfix">
    <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('action' => 'delete', $this->Form->value('WorkTime.id')), array('class' => 'btn btn-sm red btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'List Work Times'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>

</div>
<div class="portlet-body">
    <div class="row">
        <?php echo $this->Form->create('WorkTime'); ?>
        <?php echo $this->Form->input('id'); ?>
        <?php echo $this->Element('WorkTimes/fields'); ?>
    </div>
    <?php
    echo $this->Form->submit(__d('public','Zapisz'), array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
