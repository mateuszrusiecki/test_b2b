<?php
echo $this->FebHtml->meta('description', '', array('inline' => false));
echo $this->FebHtml->meta('keywords', '', array('inline' => false));

$this->set('title_for_layout', '');
?>
<div ng-controller="ProjectFilesCtrl">
    

    <?php echo $this->element('Hrs/tabs'); ?> 
    <?php echo $this->Metronic->portlet(__d('public','Lista projektów')); ?>
    <?php echo $this->element('ClientProjects/table_index_no_ajax'); ?> 
    <?php echo $this->Metronic->portletEnd(); ?>
    <?php //pm   ?>

    <?php echo $this->element('Pm/table'); ?>

    <?php echo $this->Metronic->portlet(__d('public','Inne')); ?>
    <div class="col-md-7">
        <?php echo $this->Element('default/my_team'); ?> 
    </div>
    <div class="col-md-5">
        <?php echo $this->Element('default/personal_purpose'); ?> 
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
<?php $this->Html->script('angular/controllers/ProfileCartCtrl', array('block' => 'angular')); ?>