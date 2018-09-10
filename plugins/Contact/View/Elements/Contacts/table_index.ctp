	<h2><?php echo __d('cms', 'Contacts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
    <thead>
	<tr>
	            <th><?php echo $this->Paginator->sort('email', __d('cms', 'Email'));?></th>
	            <th><?php echo $this->Paginator->sort('name', __d('cms', 'Name'));?></th>
	            <th><?php echo $this->Paginator->sort('show', __d('cms', 'Show'));?></th>
	            	            <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
    </thead>
     <tbody>
	<?php
	$i = 0;
	foreach ($contacts as $contact): ?>
	<tr data-id="<?php echo $contact['Contact']['id']; ?>">
		<td><?php echo h($contact['Contact']['email']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['name']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['show']); ?>&nbsp;</td>
		<td><?php echo $this->FebTime->niceShort($contact['Contact']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($contact['Contact']['modified']); ?></td>
		<td class="actions">
			<?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $contact['Contact']['id'])); ?>
			<?php // echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $contact['Contact']['id'])); ?>
			<?php //echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $contact['Contact']['id']), null, __('Are you sure you want to delete # %s?', $contact['Contact']['name'])); ?>
         
            <div class="button">Edit<br /> 				<?php echo $this->Html->div('clearfix', $this->element('Translate.flags/flags', array('url' => array_merge(array('action' => 'edit', $contact['Contact']['id'])), 'active' => $contact['translateDisplay'], 'title' => __d('cms', 'Edit')))); ?>
            </div>
        			<?php echo $this->element('Translate.flags/trash', array('data' => $contact, 'model' => 'Contact')); ?>
		</td>
	</tr>
<?php endforeach; ?>
     </tbody>
	</table>