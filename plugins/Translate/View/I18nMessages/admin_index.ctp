<?php $this->set('title_for_layout', __d('cms', 'List') . ' &bull; ' . __d('cms', 'I18n Messages')); ?>

<?php echo $this->Metronic->portlet('I18n'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'New I18n Message'), array('action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<?php echo $this->Element('I18nMessages/table_index'); ?> 
<?php echo $this->Element('cms/paginator'); ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>

