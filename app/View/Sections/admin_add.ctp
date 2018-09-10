<?php echo $this->Metronic->portlet('Dodaj dział'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Lista działów'), array('action' => 'admin_index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <?php echo $this->Form->create('Section'); ?>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?php
            echo $this->Metronic->input('name');
            echo $this->Metronic->input('supervisor', array('label' => 'przełożony'));
            echo $this->Metronic->input('hourly_rate', array('label' => 'stawka godzinowa'));
            ?>
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