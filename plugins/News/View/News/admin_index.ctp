<?php $this->set('title_for_layout', __d('cms', 'List').' &bull; '.__d('cms', 'News')); ?><div class="news index">
     
    <?php echo $this->Element('News/table_index'); ?> 
    <?php echo $this->Element('cms/paginator'); ?></div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php echo $this->Permissions->link(__d('cms', 'New News'), array('action' => 'add'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Users'), array('plugin' => false, 'controller' => 'users', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New User'), array('plugin' => false, 'controller' => 'users', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
	</ul>
</div>
