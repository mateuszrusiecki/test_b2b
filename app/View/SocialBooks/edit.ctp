<?php $this->set('title_for_layout', __d('cms', 'Adding').' &bull; '.__d('cms', 'Social Books')); ?><h2><?php echo __d('cms', 'Edit Social Book'); ?></h2>

<div class="socialBooks form">
    <?php echo $this->Form->create('SocialBook'); ?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Element('SocialBooks/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('action' => 'delete', $this->Form->value('SocialBook.id')), array('outter'=>'<li>%s</li>'), __('Are you sure you want to delete # %s?', $this->Form->value('SocialBook.user_id'))); ?> 
        <?php echo $this->Permissions->link(__d('cms', 'List Social Books'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
            </ul>
</div>
