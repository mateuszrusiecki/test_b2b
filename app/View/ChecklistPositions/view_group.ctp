
<?php echo $this->Metronic->portlet(__d('public', 'Karta obiegowa').' - '.$this->data['Group']['name']); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('public', 'Lista kart obiegowych'), array('action' => 'index'), array('class' => 'btn btn-sm  green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('public', 'Drukuj'),array('action' => 'print_group', $id, 'ext' => 'pdf'), array('class' => 'btn btn-sm  green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('public', 'Dodaj nową pozycję'), array('action' => 'add',$id), array('class' => 'btn btn-sm  green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <div class="row">
        <?php echo $this->Form->create('Group'); ?>
        <div class="col-md-12 col-xs-12">
            <?php
            echo $this->Form->hidden('Group.name');
            echo $this->Metronic->input('ChecklistPosition.ChecklistPosition', array('multiple' => 'checkbox', 'label' => __d('cms', 'Lista pozycji')));
            ?>
        </div>
    </div>
    <?php
    echo $this->Form->submit(__d('public', 'Zapisz'), array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
