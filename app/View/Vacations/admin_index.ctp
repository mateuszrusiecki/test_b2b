<?php $this->set('title_for_layout', __d('cms', 'List').' &bull; '.__d('cms', 'Vacations')); ?><div class="vacations index">
     
    <?php echo $this->Element('Vacations/table_index'); ?> 
    <?php echo $this->Element('cms/paginator'); ?></div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php echo $this->Permissions->link(__d('cms', 'New Vacation'), array('action' => 'add'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Vacation Types'), array('controller' => 'vacation_types', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Vacation Type'), array('controller' => 'vacation_types', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Vacation Statuses'), array('controller' => 'vacation_statuses', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Vacation Status'), array('controller' => 'vacation_statuses', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Vacation Replaces'), array('controller' => 'vacation_replaces', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Vacation Replace'), array('controller' => 'vacation_replaces', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
	</ul>
</div>
