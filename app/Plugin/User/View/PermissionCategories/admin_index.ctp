<?php $this->set('title_for_layout', __d('cms', 'List') . ' &bull; ' . __d('cms', 'Permission Categories')); ?>
<?php echo $this->Metronic->portlet('Kategorie uprawnień'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'New Permission Category'), array('action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Zarzadzanie akcjami uprawnień'), array('controller' => 'permission_groups', 'action' => 'summary'), array('class' => 'btn btn-sm blue btn-sm margin-bottom pull-right poitnier')); ?> 
</div>
<?php echo $this->Element('PermissionCategories/table_index'); ?> 
<?php echo $this->Element('cms/paginator'); ?></div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
