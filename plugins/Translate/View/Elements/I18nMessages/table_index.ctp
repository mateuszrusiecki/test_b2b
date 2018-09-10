	<h2><?php echo __d('cms', 'I18n Messages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
    <thead>
	<tr>
	            <th><?php echo $this->Paginator->sort('msgid', __d('cms', 'Msgid'));?></th>
	            <th><?php echo $this->Paginator->sort('msgstr', __d('cms', 'Msgstr'));?></th>
	            <th><?php echo $this->Paginator->sort('user_id', __d('cms', 'User Id'));?></th>
	            <th><?php echo $this->Paginator->sort('domain', __d('cms', 'Domain'));?></th>
	            <th><?php echo $this->Paginator->sort('lang', __d('cms', 'Lang'));?></th>
	            <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
	            			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
    </thead>
     <tbody>
	<?php
	$i = 0;
	foreach ($i18nMessages as $i18nMessage): ?>
	<tr data-id="<?php echo $i18nMessage['I18nMessage']['id']; ?>">
		<td><?php echo h($i18nMessage['I18nMessage']['msgid']); ?>&nbsp;</td>
		<td><?php echo h($i18nMessage['I18nMessage']['msgstr']); ?>&nbsp;</td>
		<td><?php echo h($i18nMessage['I18nMessage']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($i18nMessage['I18nMessage']['domain']); ?>&nbsp;</td>
		<td><?php echo h($i18nMessage['I18nMessage']['lang']); ?>&nbsp;</td>
		<td><?php echo $this->FebTime->niceShort($i18nMessage['I18nMessage']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($i18nMessage['I18nMessage']['modified']); ?></td>
		<td class="actions">
			<?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $i18nMessage['I18nMessage']['id'])); ?>
			<?php echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $i18nMessage['I18nMessage']['id'])); ?>
			<?php echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $i18nMessage['I18nMessage']['id']), null, __('Are you sure you want to delete # %s?', $i18nMessage['I18nMessage']['domain'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
     </tbody>
	</table>