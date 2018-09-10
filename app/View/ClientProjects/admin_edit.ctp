<?php $this->set('title_for_layout', __d('cms', 'Adding').' &bull; '.__d('cms', 'Client Projects')); ?><h2><?php echo __d('cms', 'Admin Edit Client Project'); ?></h2>

<div class="clientProjects form">
    <?php echo $this->Form->create('ClientProject'); ?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Element('ClientProjects/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('action' => 'delete', $this->Form->value('ClientProject.id')), array('outter'=>'<li>%s</li>'), __('Are you sure you want to delete # %s?', $this->Form->value('ClientProject.name'))); ?> 
        <?php echo $this->Permissions->link(__d('cms', 'List Client Projects'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Client Leads'), array('controller' => 'client_leads', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Client Lead'), array('controller' => 'client_leads', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
    </ul>
</div>
