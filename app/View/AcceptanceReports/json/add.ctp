<?php $this->set('title_for_layout', __d('cms', 'Editing').' &bull; '.__d('cms', 'Acceptance Reports')); ?><h2><?php echo __d('cms', 'Add Acceptance Report'); ?></h2>

<div class="acceptanceReports form">
    <?php echo $this->Form->create('AcceptanceReport'); ?>
	<?php echo $this->Element('AcceptanceReports/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List Acceptance Reports'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Client Projects'), array('controller' => 'client_projects', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Client Project'), array('controller' => 'client_projects', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Clients'), array('controller' => 'clients', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Client'), array('controller' => 'clients', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Client Project Shedules'), array('controller' => 'client_project_shedules', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Client Project Shedule'), array('controller' => 'client_project_shedules', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
    </ul>
</div>
