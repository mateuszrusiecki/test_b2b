<?php $this->set('title_for_layout', __d('cms', 'List').' &bull; '.__d('cms', 'Work Times')); ?><div class="workTimes index">
     
</div>

<?php echo $this->Metronic->portlet(__d('public','Work Times')); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'New Work Time'), array('action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
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
    <?php echo $this->Element('WorkTimes/table_index'); ?> 
    <?php echo $this->Element('cms/paginator'); ?>

<?php echo $this->Metronic->portletEnd(); ?>
