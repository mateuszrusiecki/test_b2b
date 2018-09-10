<?php $this->set('title_for_layout', __d('cms', 'List').' &bull; '.__d('cms', 'Checklist Positions')); ?><div class="checklistPositions index">
     
    <?php echo $this->Element('ChecklistPositions/table_index'); ?> 
    <?php echo $this->Element('cms/paginator'); ?></div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php echo $this->Permissions->link(__d('cms', 'New Checklist Position'), array('action' => 'add'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Checklist Position User Groups'), array('controller' => 'checklist_position_user_groups', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Checklist Position User Group'), array('controller' => 'checklist_position_user_groups', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
	</ul>
</div>
