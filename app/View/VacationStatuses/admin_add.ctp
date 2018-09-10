<?php $this->set('title_for_layout', __d('cms', 'Editing').' &bull; '.__d('cms', 'Vacation Statuses')); ?><h2><?php echo __d('cms', 'Admin Add Vacation Status'); ?></h2>

<div class="vacationStatuses form">
    <?php echo $this->Form->create('VacationStatus'); ?>
	<?php echo $this->element('VacationStatuses/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List Vacation Statuses'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Vacations'), array('controller' => 'vacations', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Vacation'), array('controller' => 'vacations', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
    </ul>
</div>
