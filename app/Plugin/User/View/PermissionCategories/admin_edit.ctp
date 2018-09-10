<?php $this->set('title_for_layout', __d('cms', 'Edit') . ' &bull; ' . __d('cms', 'Permission Categories')); ?>

<?php echo $this->Metronic->portlet('Edycja kategorii uprawnień'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->postLink(__d('cms', 'Usuń'), array('action' => 'delete', $this->Form->value('PermissionCategory.id')), array('class' => 'btn btn-sm red btn-sm margin-bottom pull-right poitnier')); ?>

    <?php echo $this->Permissions->link(__d('cms', 'List Permission Categories'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Zarzadzanie akcjami uprawnień'), array('controller' => 'permission_groups', 'action' => 'summary'), array('class' => 'btn btn-sm blue btn-sm margin-bottom pull-right poitnier')); ?>

</div>
<div class="portlet-body">
    <div class="row">
        <?php echo $this->Form->create('PermissionCategory'); ?>
        <?php echo $this->Form->input('id'); ?>
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
