<?php $this->set('title_for_layout', __d('cms', 'List').' &bull; '.__d('cms', 'Vacation Statuses')); ?><div class="vacationStatuses index">
     
    <?php echo $this->element('VacationStatuses/table_index'); ?> 
    <?php echo $this->element('cms/paginator'); ?></div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php echo $this->Permissions->link(__d('cms', 'New Vacation Status'), array('action' => 'add'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Vacations'), array('controller' => 'vacations', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Vacation'), array('controller' => 'vacations', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
	</ul>
</div>
