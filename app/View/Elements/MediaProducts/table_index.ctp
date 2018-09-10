	<h2><?php echo __d('cms', 'Media Products'); ?></h2>
	<table cellpadding="0" cellspacing="0">
    <thead>
	<tr>
	            <th><?php echo $this->Paginator->sort('name', __d('cms', 'Name'));?></th>
	            <th><?php echo $this->Paginator->sort('amout', __d('cms', 'Amout'));?></th>
	            <th><?php echo $this->Paginator->sort('disc', __d('cms', 'Disc'));?></th>
	            <th><?php echo $this->Paginator->sort('disc_overprint', __d('cms', 'Disc Overprint'));?></th>
	            <th><?php echo $this->Paginator->sort('package_type', __d('cms', 'Package Type'));?></th>
	            <th><?php echo $this->Paginator->sort('package', __d('cms', 'Package'));?></th>
	            <th><?php echo $this->Paginator->sort('package_overprint', __d('cms', 'Package Overprint'));?></th>
	            <th><?php echo $this->Paginator->sort('typography', __d('cms', 'Typography'));?></th>
	            <th><?php echo $this->Paginator->sort('overprint_type', __d('cms', 'Overprint Type'));?></th>
	            <th><?php echo $this->Paginator->sort('format', __d('cms', 'Format'));?></th>
	            <th><?php echo $this->Paginator->sort('confection', __d('cms', 'Confection'));?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
    </thead>
     <tbody>
	<?php
	$i = 0;
	foreach ($mediaProducts as $mediaProduct): ?>
	<tr data-id="<?php echo $mediaProduct['MediaProduct']['id']; ?>">
		<td><?php echo h($mediaProduct['MediaProduct']['name']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['amout']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['disc']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['disc_overprint']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['package_type']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['package']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['package_overprint']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['typography']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['overprint_type']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['format']); ?>&nbsp;</td>
		<td><?php echo h($mediaProduct['MediaProduct']['confection']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $mediaProduct['MediaProduct']['id'])); ?>
			<?php echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $mediaProduct['MediaProduct']['id'])); ?>
			<?php echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $mediaProduct['MediaProduct']['id']), null, __('Are you sure you want to delete # %s?', $mediaProduct['MediaProduct']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
     </tbody>
	</table>