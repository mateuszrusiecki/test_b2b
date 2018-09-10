<?php $this->set('title_for_layout', __d('cms', 'List').' &bull; '.__d('cms', 'Modules')); ?><div class="modules index">
     
    <?php echo $this->Element('Modules/table_index'); ?> 
    <?php echo $this->Element('cms/paginator'); ?></div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php echo $this->Permissions->link(__d('cms', 'New Module'), array('action' => 'add'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Client Projects'), array('controller' => 'client_projects', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Client Project'), array('controller' => 'client_projects', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Module Categories'), array('controller' => 'module_categories', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Module Category'), array('controller' => 'module_categories', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
	</ul>
</div>
