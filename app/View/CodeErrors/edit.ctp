<?php $this->set('title_for_layout', __d('cms', 'Adding').' &bull; '.__d('cms', 'Code Errors')); ?><h2><?php echo __d('cms', 'Edit Code Error'); ?></h2>

<div class="codeErrors form">
    <?php echo $this->Form->create('CodeError'); ?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Element('CodeErrors/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('action' => 'delete', $this->Form->value('CodeError.id')), array('outter'=>'<li>%s</li>'), __('Are you sure you want to delete # %s?', $this->Form->value('CodeError.name'))); ?> 
        <?php echo $this->Permissions->link(__d('cms', 'List Code Errors'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
            </ul>
</div>
