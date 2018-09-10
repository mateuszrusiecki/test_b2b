<?php $this->set('title_for_layout', __d('cms', 'Editing').' &bull; '.__d('cms', 'I18n Messages')); ?><h2><?php echo __d('cms', 'Admin Add I18n Message'); ?></h2>

<div class="i18nMessages form">
    <?php echo $this->Form->create('I18nMessage'); ?>
	<?php echo $this->Element('I18nMessages/fields'); ?>
	<?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List I18n Messages'), array('action' => 'index'), array('outter'=>'<li>%s</li>')); ?>
            </ul>
</div>
