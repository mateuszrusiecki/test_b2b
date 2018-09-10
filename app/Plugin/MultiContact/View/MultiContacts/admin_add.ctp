<?php $this->set('title_for_layout', __d('cms', 'Editing').' &bull; '.__d('cms', 'Multi Contacts')); ?><h2><?php echo __d('cms', 'Admin Add Multi Contact'); ?></h2>

<div class="multiContacts form">
    <?php echo $this->Form->create('MultiContact'); ?>
	<?php echo $this->Element('MultiContacts/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List Multi Contacts'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
            </ul>
</div>
