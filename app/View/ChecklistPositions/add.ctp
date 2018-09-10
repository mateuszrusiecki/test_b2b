<?php echo $this->Metronic->portlet(__d('public', 'Dodawanie nowej pozycji')); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('public', 'Lista kart obiegowych'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <div class="row">
        <?php echo $this->Form->create('ChecklistPosition'); ?>
        <?php echo $this->Element('ChecklistPositions/fields'); ?>
    </div>
    <?php
    echo $this->Form->submit(__d('public', 'Zapisz'), array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>

<?php echo $this->Metronic->portletEnd(); ?>

