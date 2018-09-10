<?php $this->set('title_for_layout', __d('cms', 'Adding').' &bull; '.__d('cms', 'Contacts')); ?><h2><?php echo __d('cms', 'Admin Edit Contact'); ?></h2>

<div class="contacts form">
    <?php echo $this->Form->create('Contact'); ?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Element('Contacts/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('action' => 'delete', $this->Form->value('Contact.id')), array('outter'=>'<li>%s</li>'), __('Are you sure you want to delete # %s?', $this->Form->value('Contact.name'))); ?> 
        <?php echo $this->Permissions->link(__d('cms', 'List Contacts'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
            </ul>
</div>
