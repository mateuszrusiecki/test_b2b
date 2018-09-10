<?php echo $this->Metronic->portlet('Edycja grupy'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Lista grup'), array('action' => 'admin_index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <?php echo $this->Form->create('User'); ?>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <?php echo $this->Form->create('Group'); ?>
            <?php
            echo $this->Form->input('id');
            echo $this->metronic->input('name', array('label' => __d('cms', 'Nazwa')));
            echo $this->metronic->input('alias');
            ?>
            <?php echo $this->Form->input('PermissionGroup.PermissionGroup', array('label' => false, 'multiple' => 'checkbox', 'div' => array('class' => 'input select multiple'))); ?>
            <div class="pull-right">
                <?php
                echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
