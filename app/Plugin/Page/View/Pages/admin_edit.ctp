<?php $this->set('title_for_layout', __d('cms', 'Edycja pozycji » Podstrony')); ?>

<?php echo $this->Metronic->portlet('Edytuj podstronę'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->postLink(__d('cms', 'Usuń'), array('action' => 'delete', $this->Form->value('Page.id')), array('class' => 'btn btn-sm red btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Lista stron'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>

</div>
<div class="portlet-body">
    <div class="row">
           <?php echo $this->Form->create('Page', array('type' => 'file')); ?>
        <?php echo $this->Form->input('id'); ?>
        <?php echo $this->element('Pages/fields'); ?>
    </div>
    <?php
    echo $this->Form->submit('Zmień', array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>