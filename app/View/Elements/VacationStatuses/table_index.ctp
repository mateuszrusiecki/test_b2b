	<h2><?php echo __d('cms', 'Vacation Statuses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
    <thead>
	<tr>
	            <th><?php echo $this->Paginator->sort('name', __d('cms', 'Name'));?></th>
	            	            <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
    </thead>
     <tbody>
	<?php
	$i = 0;
	foreach ($vacationStatuses as $vacationStatus): ?>
	<tr data-id="<?php echo $vacationStatus['VacationStatus']['id']; ?>">
		<td><?php echo h($vacationStatus['VacationStatus']['name']); ?>&nbsp;</td>
		<td><?php echo $this->FebTime->niceShort($vacationStatus['VacationStatus']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($vacationStatus['VacationStatus']['modified']); ?></td>
		<td class="actions">
			<?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $vacationStatus['VacationStatus']['id'])); ?>
			<?php // echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $vacationStatus['VacationStatus']['id'])); ?>
			<?php //echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $vacationStatus['VacationStatus']['id']), null, __('Are you sure you want to delete # %s?', $vacationStatus['VacationStatus']['name'])); ?>
         
            <div class="button">Edit<br /> 				<?php echo $this->Html->div('clearfix', $this->element('Translate.flags/flags', array('url' => array_merge(array('action' => 'edit', $vacationStatus['VacationStatus']['id'])), 'active' => $vacationStatus['translateDisplay'], 'title' => __d('cms', 'Edit')))); ?>
            </div>
        			<?php echo $this->element('Translate.flags/trash', array('data' => $vacationStatus, 'model' => 'VacationStatus')); ?>
		</td>
	</tr>
<?php endforeach; ?>
     </tbody>
	</table>