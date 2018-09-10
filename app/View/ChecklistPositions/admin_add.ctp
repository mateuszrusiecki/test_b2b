<?php $this->set('title_for_layout', __d('cms', 'Editing').' &bull; '.__d('cms', 'Checklist Positions')); ?><h2><?php echo __d('cms', 'Admin Add Checklist Position'); ?></h2>

<div class="checklistPositions form">
    <?php echo $this->Form->create('ChecklistPosition'); ?>
	<?php echo $this->Element('ChecklistPositions/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List Checklist Positions'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Checklist Position User Groups'), array('controller' => 'checklist_position_user_groups', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Checklist Position User Group'), array('controller' => 'checklist_position_user_groups', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
    </ul>
</div>
