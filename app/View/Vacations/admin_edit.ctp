<?php $this->set('title_for_layout', __d('cms', 'Adding').' &bull; '.__d('cms', 'Vacations')); ?><h2><?php echo __d('cms', 'Admin Edit Vacation'); ?></h2>

<div class="vacations form">
    <?php echo $this->Form->create('Vacation'); ?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Element('Vacations/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('action' => 'delete', $this->Form->value('Vacation.id')), array('outter'=>'<li>%s</li>'), __('Are you sure you want to delete # %s?', $this->Form->value('Vacation.vacation_type_id'))); ?> 
        <?php echo $this->Permissions->link(__d('cms', 'List Vacations'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Vacation Types'), array('controller' => 'vacation_types', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Vacation Type'), array('controller' => 'vacation_types', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Vacation Statuses'), array('controller' => 'vacation_statuses', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Vacation Status'), array('controller' => 'vacation_statuses', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Vacation Replaces'), array('controller' => 'vacation_replaces', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Vacation Replace'), array('controller' => 'vacation_replaces', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
    </ul>
</div>
