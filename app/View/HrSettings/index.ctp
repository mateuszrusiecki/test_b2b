<?php echo $this->Metronic->portlet(__d('public', 'Ustawiena hr')); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Dodaj ustawiena hr'), array('action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="clearfix">
    <div class="col-md-3">
        <form>
            <?php
//            echo $this->Metronic->input('search_box', array(
//                //'label' => __d('public','Szukaj'),
//                'placeholder' => __d('public', 'Szukaj'),
//                'type' => 'text',
//                'ng-model' => 'name',
//                'class' => ' form-control form-control-inline',
//            ));
            ?>
        </form>
    </div>	
</div> 
<?php echo $this->element('HrSettings/table_index'); ?> 

<?php echo $this->Metronic->portletEnd(); ?>


<?php echo $this->Metronic->portlet(__d('public', 'Czas pracy')); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Dodaj czas pracy'), array('controller' => 'work_times', 'action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>

</div>
<div class="clearfix">
    <div class="col-md-3">
        <form>
            <?php
//            echo $this->Metronic->input('search_box', array(
//                //'label' => __d('public','Szukaj'),
//                'placeholder' => __d('public', 'Szukaj'),
//                'type' => 'text',
//                'ng-model' => 'name',
//                'class' => ' form-control form-control-inline',
//            ));
            ?>
        </form>
    </div>	
</div> 
<?php echo $this->element('HrSettings/work_times'); ?> 

<?php echo $this->Metronic->portletEnd(); ?>