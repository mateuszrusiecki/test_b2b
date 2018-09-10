<?php
$this->set('title_for_layout', __d('cms', 'Podstrony'));
?>

<?php echo $this->Metronic->portlet('Lista podstron'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Dodaj pozycję'), array('action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<?php echo $this->element('Pages/table_index'); ?>
<?php echo $this->element('cms/paginator'); ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>