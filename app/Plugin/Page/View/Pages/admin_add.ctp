<?php
if (!empty($add_params)):
    $this->set('title_for_layout', __d('cms', 'Nowa pozycja » Realizacje'));
else:
    $this->set('title_for_layout', __d('cms', 'Nowa pozycja » Podstrony'));
endif;
?>

<?php echo $this->Metronic->portlet('Dodaj postronę'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Lista stron'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <div class="row">
        <?php echo $this->Form->create('Page', array('type' => 'file')); ?>
        <?php echo $this->element('Pages/fields'); ?>     
    </div>
    <?php
    echo $this->Form->submit('Wyślij', array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
