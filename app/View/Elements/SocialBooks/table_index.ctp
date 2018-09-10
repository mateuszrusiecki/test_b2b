	<h2><?php echo __d('cms', 'Social Books'); ?></h2>
	<table cellpadding="0" cellspacing="0">
    <thead>
	<tr>
	            <th><?php echo $this->Paginator->sort('user_id', __d('cms', 'User Id'));?></th>
	            	            <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
    </thead>
     <tbody>
	<?php
	$i = 0;
	foreach ($socialBooks as $socialBook): ?>
	<tr data-id="<?php echo $socialBook['SocialBook']['id']; ?>">
		<td><?php echo h($socialBook['SocialBook']['user_id']); ?>&nbsp;</td>
		<td><?php echo $this->FebTime->niceShort($socialBook['SocialBook']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($socialBook['SocialBook']['modified']); ?></td>
		<td class="actions">
			<?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $socialBook['SocialBook']['id'])); ?>
			<?php echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $socialBook['SocialBook']['id'])); ?>
			<?php echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $socialBook['SocialBook']['id']), null, __('Are you sure you want to delete # %s?', $socialBook['SocialBook']['user_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
     </tbody>
	</table>