<?php echo $this->Metronic->portlet(__d('public','Dodaj pracowników')); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Lista działów'), array('action' => 'admin_index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <?php echo $this->Form->create('Section'); ?>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?php echo $this->Form->input('User', array('label' => __d('cms', 'Pracownicy'), 'multiple' => 'checkbox')); ?>
        </div>
        <div class="col-xs-12">
            <div class="pull-right">
                <?php
                $back_button = $this->Html->link(__('Powrót'), array('action' => 'edit', $this->request->data['Section']['id']), array('class' => 'btn grey pull-left margin-right-15'));
                echo $this->Form->submit(__('Zapisz'), array('after' => $back_button, 'class' => 'btn blue-madison pull-right'));
                ?>
            </div>
        </div>
    </div>
    <?php
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>