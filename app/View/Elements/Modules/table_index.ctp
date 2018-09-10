	<h2><?php echo __d('cms', 'Modules'); ?></h2>
	<table cellpadding="0" cellspacing="0">
    <thead>
	<tr>
	            <th><?php echo $this->Paginator->sort('client_project_id', __d('cms', 'Client Project Id'));?></th>
	            <th><?php echo $this->Paginator->sort('module_category_id', __d('cms', 'Module Category Id'));?></th>
	            <th><?php echo $this->Paginator->sort('name', __d('cms', 'Name'));?></th>
	            <th><?php echo $this->Paginator->sort('desc', __d('cms', 'Desc'));?></th>
	            <th><?php echo $this->Paginator->sort('img', __d('cms', 'Img'));?></th>
	            <th><?php echo $this->Paginator->sort('lang', __d('cms', 'Lang'));?></th>
	            <th><?php echo $this->Paginator->sort('manager_user_id', __d('cms', 'Manager User Id'));?></th>
	            <th><?php echo $this->Paginator->sort('contact_user_id', __d('cms', 'Contact User Id'));?></th>
	            <th><?php echo $this->Paginator->sort(' comments', __d('cms', ' Comments'));?></th>
	            <th><?php echo $this->Paginator->sort('rep_type', __d('cms', 'Rep Type'));?></th>
	            <th><?php echo $this->Paginator->sort('rep_path', __d('cms', 'Rep Path'));?></th>
	            	            <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
    </thead>
     <tbody>
	<?php
	$i = 0;
	foreach ($modules as $module): ?>
	<tr data-id="<?php echo $module['Module']['id']; ?>">
		<td>
			<?php echo $this->Permissions->link($module['ClientProject']['name'], array('controller' => 'client_projects', 'action' => 'view', $module['ClientProject']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Permissions->link($module['ModuleCategory']['name'], array('controller' => 'module_categories', 'action' => 'view', $module['ModuleCategory']['id'])); ?>
		</td>
		<td><?php echo h($module['Module']['name']); ?>&nbsp;</td>
		<td><?php echo h($module['Module']['desc']); ?>&nbsp;</td>
		<td><?php echo h($module['Module']['img']); ?>&nbsp;</td>
		<td><?php echo h($module['Module']['lang']); ?>&nbsp;</td>
		<td><?php echo h($module['Module']['manager_user_id']); ?>&nbsp;</td>
		<td><?php echo h($module['Module']['contact_user_id']); ?>&nbsp;</td>
		<td><?php echo h($module['Module'][' comments']); ?>&nbsp;</td>
		<td><?php echo h($module['Module']['rep_type']); ?>&nbsp;</td>
		<td><?php echo h($module['Module']['rep_path']); ?>&nbsp;</td>
		<td><?php echo $this->FebTime->niceShort($module['Module']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($module['Module']['modified']); ?></td>
		<td class="actions">
			<?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $module['Module']['id'])); ?>
			<?php echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $module['Module']['id'])); ?>
			<?php echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $module['Module']['id']), null, __('Are you sure you want to delete # %s?', $module['Module']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
     </tbody>
	</table>