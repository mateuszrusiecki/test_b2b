<?php $this->set('title_for_layout', __d('cms', 'Edit') . ' &bull; ' . __d('cms', 'Crons')); ?>

<?php echo $this->Metronic->portlet('Cron Data'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'List Crons'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<?php echo $this->Form->create('Cron'); ?>
<div class="portlet-body">
    <?php echo $this->Form->input('id'); ?>
    <?php echo $this->element('Crons/fields'); ?>
</div>
<div class="pull-right">
    <?php
    echo $this->Form->submit('Zmień', array('class' => 'btn blue-madison pull-right'));
    ?>
</div>
<?php
echo $this->Form->end();
?>
<?php echo $this->Metronic->portletEnd(); ?>