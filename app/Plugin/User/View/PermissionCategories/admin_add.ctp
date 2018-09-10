<?php $this->set('title_for_layout', __d('cms', 'Editing') . ' &bull; ' . __d('cms', 'Permission Categories')); ?>
<?php echo $this->Metronic->portlet('Permission Category Data'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'List Permission Categories'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Zarzadzanie akcjami uprawnień'), array('controller' => 'permission_groups', 'action' => 'summary'), array('class' => 'btn btn-sm blue btn-sm margin-bottom pull-right poitnier')); ?>

</div>
<div class="portlet-body">
    <div class="row">
        <?php echo $this->Form->create('PermissionCategory'); ?>
        <?php echo $this->Element('PermissionCategories/fields'); ?>
        <div class="pull-right">
            <?php
            echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>