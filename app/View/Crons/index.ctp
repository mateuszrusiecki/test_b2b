<?php $this->set('title_for_layout', __d('cms', 'List') . ' &bull; ' . __d('cms', 'Crons')); ?>

<?php echo $this->Metronic->portlet('Crons'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'New Cron'), array('action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
    <?php echo $this->element('Crons/table_index'); ?> 
    <?php echo $this->element('default/paginator'); ?></div>
<?php echo $this->Metronic->portletEnd(); ?>
