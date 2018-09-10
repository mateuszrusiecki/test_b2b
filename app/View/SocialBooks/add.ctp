<?php $this->set('title_for_layout', __d('cms', 'Editing').' &bull; '.__d('cms', 'Social Books')); ?><h2><?php echo __d('cms', 'Add Social Book'); ?></h2>

<div class="socialBooks form">
    <?php echo $this->Form->create('SocialBook'); ?>
	<?php echo $this->Element('SocialBooks/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List Social Books'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
            </ul>
</div>
