<?php $this->set('title_for_layout', __d('cms', 'Editing').' &bull; '.__d('cms', 'Client Projects')); ?><h2><?php echo __d('cms', 'Admin Add Client Project'); ?></h2>

<div class="clientProjects form">
    <?php echo $this->Form->create('ClientProject'); ?>
	<?php echo $this->element('ClientProjects/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List Client Projects'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Client Leads'), array('controller' => 'client_leads', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Client Lead'), array('controller' => 'client_leads', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
    </ul>
</div>
