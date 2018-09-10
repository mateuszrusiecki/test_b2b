<div ng-controller="ProjectFilesCtrl"  ng-init="getClientProjectFiles();
                deleteFileType = 'client';
                ">
    <?php
    echo $this->element('Hrs/tab_client');
    ?>
</div>
<?php echo $this->Metronic->portlet(__d('public', 'Moje projekty')); ?>
 <!--    //     -->
 <!--projekty klienta-->
 <!--   //      -->
<?php echo $this->element('ClientProjects/table_index_no_ajax', array('hidenClient'=>true)); ?> 
<?php echo $this->Metronic->portletEnd(); ?>

<?php echo $this->Html->script('angular/controllers/ProjectFilesCtrl',  array('block' => 'angular')); ?>