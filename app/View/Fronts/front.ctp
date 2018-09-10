<?php
if ($this->action == 'management')
{
    echo $this->element('Fronts/raporty');
}
?>
<?php
if (
        $this->action == 'management' ||
        $this->action == 'm_secretariat' ||
        $this->action == 'w_secretariat')
{
    ?>
    <div ng-controller="ProjectFilesCtrl"  ng-init="getProjectFiles()">
        <?php
        echo $this->element('Hrs/tabs');
        ?>
    </div>
    <?php
}
?> 

<?php echo $this->Metronic->portlet(__d('public', 'Moje projekty')); ?>
<?php //echo $this->element('ClientProjects/table'); ?>
<?php echo $this->element('ClientProjects/table_index_no_ajax'); ?> 
<?php echo $this->Metronic->portletEnd(); ?>

<?php echo $this->element('Pm/table'); ?>

<?php //echo $this->element('Bonuses/table');   ?>

<?php echo $this->Metronic->portlet(__d('public', 'Inne')); ?>
<div class="col-md-7">
    <?php echo $this->element('default/my_team'); ?> 
</div>
<div class="col-md-5">
    <?php echo $this->element('default/personal_purpose'); ?> 
</div>
<?php echo $this->Metronic->portletEnd(); ?>

<?php $this->Html->script('angular/controllers/ProfileCartCtrl', array('block' => 'angular')); ?>
