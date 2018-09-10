<?php $this->set('title_for_layout', __d('cms', 'List').' &bull; '.__d('cms', 'Client Projects')); ?><div class="clientProjects index">
     
    <?php echo $this->Element('ClientProjects/table_index'); ?> 
    <?php echo $this->Element('cms/paginator'); ?></div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php echo $this->Permissions->link(__d('cms', 'New Client Project'), array('action' => 'add'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Client Leads'), array('controller' => 'client_leads', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Client Lead'), array('controller' => 'client_leads', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
	</ul>
</div>
