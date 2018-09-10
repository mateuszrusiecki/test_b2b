<?php $this->set('title_for_layout', __d('cms', 'Editing') . ' &bull; ' . __d('cms', 'Crons')); ?><h2><?php echo __d('cms', 'Admin Add Cron'); ?></h2>

<?php echo $this->Metronic->portlet('Cron Data'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'List Crons'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <?php echo $this->Form->create('Section'); ?>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?php echo $this->Form->create('Cron'); ?>
            <?php echo $this->Element('Crons/fields'); ?>
        </div>
        <div class="col-xs-12">
            <div class="pull-right">
                <?php
                echo $this->Form->submit('Dodaj', array('class' => 'btn blue-madison pull-right'));
                ?>
            </div>
        </div>
    </div>
    <?php
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>