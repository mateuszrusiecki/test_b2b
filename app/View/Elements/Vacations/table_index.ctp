	<h2><?php echo __d('cms', 'Vacations'); ?></h2>
	<table class="table table-hover table-light">
    <thead>
	<tr class="uppercase">
	            <th><?php echo $this->Paginator->sort('vacation_type_id', __d('cms', 'Rodzaj wolnego'));?></th>
	            <th><?php echo $this->Paginator->sort('date_start', __d('cms', 'Data od'));?></th>
	            <th><?php echo $this->Paginator->sort('date_end', __d('cms', 'Data do'));?></th>
	            <th><?php echo $this->Paginator->sort('time_start', __d('cms', 'Ilośc dni(d) / godzin(h)'));?></th>
	            <th><?php echo $this->Paginator->sort('time_end', __d('cms', 'Urlop pozostały / wykorzystany'));?></th>
	            <th><?php echo $this->Paginator->sort('vacation_status_id', __d('cms', 'Vacation Status Id'));?></th>
	            	            <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
    </thead>
     <tbody>
	<?php
	$i = 0;
	
	foreach ($vacations as $vacation): ?>
		<tr data-id="<?php echo $vacation['Vacation']['id']; ?>">
			<td>
				<?php echo $this->Permissions->link($vacation['VacationType']['name'], array('controller' => 'vacation_types', 'action' => 'view', $vacation['VacationType']['id'])); ?>
			</td>
			<td><?php echo h($vacation['Vacation']['date_start']); ?>&nbsp;</td>
			<td><?php echo h($vacation['Vacation']['date_end']); ?>&nbsp;</td>
			<td><?php 
				if($vacation['VacationType']['is_hours']){

				} else {
					$secs = strtotime($vacation['Vacation']['date_end']) - strtotime($vacation['Vacation']['date_start']);
					$days = $secs / 86400;
					echo h($days.' d');
				}
				?>
			</td>
			<td><?php echo h($vacation['Vacation']['time_end']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Permissions->link($vacation['VacationStatus']['name'], array('controller' => 'vacation_statuses', 'action' => 'view', $vacation['VacationStatus']['id'])); ?>
			</td>
			<td><?php echo $this->FebTime->niceShort($vacation['Vacation']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($vacation['Vacation']['modified']); ?></td>
			<td class="actions">
				<?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $vacation['Vacation']['id'])); ?>
				<?php echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $vacation['Vacation']['id'])); ?>
				<?php echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $vacation['Vacation']['id']), null, __('Are you sure you want to delete # %s?', $vacation['Vacation']['vacation_type_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
     </tbody>
	</table>
	
