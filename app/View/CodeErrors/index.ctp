<?php echo $this->Metronic->portlet(__d('public', 'Lista błędów')); ?>
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
<?php echo $this->element('CodeErrors/table_index'); ?> 
<?php echo $this->element('cms/paginator'); ?></div>
<?php echo $this->Metronic->portletEnd(); ?>