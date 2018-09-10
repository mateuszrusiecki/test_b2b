<?php $this->set('title_for_layout', __d('cms', 'Adding').' &bull; '.__d('cms', 'Modules')); ?><h2><?php echo __d('cms', 'Edit Module'); ?></h2>

<div class="modules form">
    <?php echo $this->Form->create('Module', array('type' => 'file')); ?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->element('Modules/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('action' => 'delete', $this->Form->value('Module.id')), array('outter'=>'<li>%s</li>'), __('Are you sure you want to delete # %s?', $this->Form->value('Module.name'))); ?> 
        <?php echo $this->Permissions->link(__d('cms', 'List Modules'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Client Projects'), array('controller' => 'client_projects', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Client Project'), array('controller' => 'client_projects', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Module Categories'), array('controller' => 'module_categories', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Module Category'), array('controller' => 'module_categories', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
    </ul>
</div>
