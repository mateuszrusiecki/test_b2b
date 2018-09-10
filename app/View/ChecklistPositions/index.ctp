<?php echo $this->Metronic->portlet(__d('public', 'Karty obiegowe')); ?>
    <div class="clearfix">
        <?php echo $this->Permissions->link(__d('public', 'Dodaj nową pozycję'), array('action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    </div>
    <?php echo $this->element('ChecklistPositions/table_index'); ?> 
    <?php //echo $this->Element('cms/paginator'); ?></div>

<?php echo $this->Metronic->portletEnd(); ?>