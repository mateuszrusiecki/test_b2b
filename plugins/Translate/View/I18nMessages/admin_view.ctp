<div class="i18nMessages view">
<h2><?php  echo __('I18n Message');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($i18nMessage['I18nMessage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Msgid'); ?></dt>
		<dd>
			<?php echo h($i18nMessage['I18nMessage']['msgid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Msgstr'); ?></dt>
		<dd>
			<?php echo h($i18nMessage['I18nMessage']['msgstr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'User Id'); ?></dt>
		<dd>
			<?php echo h($i18nMessage['I18nMessage']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Domain'); ?></dt>
		<dd>
			<?php echo h($i18nMessage['I18nMessage']['domain']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Lang'); ?></dt>
		<dd>
			<?php echo h($i18nMessage['I18nMessage']['lang']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($i18nMessage['I18nMessage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($i18nMessage['I18nMessage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit I18n Message'), array('action' => 'edit', $i18nMessage['I18nMessage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete I18n Message'), array('action' => 'delete', $i18nMessage['I18nMessage']['id']), null, __('Are you sure you want to delete # %s?', $i18nMessage['I18nMessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List I18n Messages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New I18n Message'), array('action' => 'add')); ?> </li>
	</ul>
</div>
