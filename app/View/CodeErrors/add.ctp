<?php $this->set('title_for_layout', __d('cms', 'Editing').' &bull; '.__d('cms', 'Code Errors')); ?><h2><?php echo __d('cms', 'Add Code Error'); ?></h2>

<div class="codeErrors form">
    <?php echo $this->Form->create('CodeError'); ?>
	<?php echo $this->Element('CodeErrors/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List Code Errors'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
            </ul>
</div>
