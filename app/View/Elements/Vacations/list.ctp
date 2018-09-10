<?php								
	if($year == date('Y') || !$year){ 
		$year = date('Y');
		echo urldecode($this->Html->link(
			__d('public','Przełącz na rok ').($year-1), array(
			'controller' => 'vacations',
			'action' => 'index',
			($year-1).'#vacations'
			), array('escape' => false,'class'=>'btn green-haze btn-circle')
		));
	}else{
		echo urldecode($this->Html->link(
			__d('public','Przełącz na rok ').($year-1), array(
			'controller' => 'vacations',
			'action' => 'index',
			($year-1).'#vacations'
			), array('escape' => false,'class'=>'btn green-haze btn-circle')
		));
		//echo '<br/>';
		echo urldecode($this->Html->link(
			__d('public','Przełącz na rok ').date('Y'), array(
			'controller' => 'vacations',
			'action' => 'index',
			date('Y').'#vacations'
			), array('escape' => false,'class'=>'btn green-haze btn-circle')
		));
	}
	?>

	<?php
            if(!empty($calendar_id) && !empty($profile_id)){
		echo $this->Html->link(
			__d('public','Pokaż w kalendarzu'), array(
			'controller' => 'calendars',
			'action' => 'view',
                        $calendar_id,
                        $profile_id,
			), array('escape' => false,'class'=>'btn green-haze btn-circle')
		);
            }
	?>
	<?php if($vacations): ?>
		<div class="table-scrollable table-scrollable-borderless rwd-table">
			<table class="table table-hover table-light">
			<thead>
				<tr class="uppercase">
						<th><?php echo __d('public','Rodzaj wolnego');?> </th>
						<th><?php echo __d('public','Data od');?></th>
						<th><?php echo __d('public','Data do');?></th>
						<th><?php echo __d('public','Ilośc dni(d) / godzin(h)');?></th>
						<th><?php echo __d('public', 'Urlop poz./wyk.'); ?></th>
				</tr>
			</thead>
			 <tbody>
			<?php
			$i = 0;
			$sum_days = 0;

			foreach ($vacations as $vac): ?>
				<tr data-id="<?php echo $vac['Vacation']['id']; ?>" >
					<td>
						<?php //echo $this->Permissions->link($vac['VacationType']['name'], array('controller' => 'vacation_types', 'action' => 'view', $vac['VacationType']['id'])); ?>
						<?php echo $vac['VacationType']['name'] ?>
					</td>
					<td><?php echo h($vac['Vacation']['date_start']); ?>&nbsp;</td>
					<td><?php echo h($vac['Vacation']['date_end']); ?>&nbsp;</td>
					<td><?php 
						if($vac['VacationType']['is_hours']){
//							echo $vac['Vacation']['hour_end'] - $vac['Vacation']['hour_start'].' h';
                                                        echo $vac['Vacation']['private_time'];  // jak coś to mogę przerobic na INT 
						} else {
							$secs = strtotime($vac['Vacation']['date_end']) - strtotime($vac['Vacation']['date_start']);
							$days = ($secs / 86400) + 1;//+1 ponieważ urlop liczy się razem z datą początkową, np. od 2015-03-08 do 2015-03-08 
							echo h($days.' d'); 
							if($vac['Vacation']['vacation_status_id'] == 4){
								$sum_days += $days;
							} 
						} ?>
					</td>
					<td class="actions">
						
						<?php if($vac['Vacation']['vacation_status_id'] == 4): ?>
							<?php if(empty($user_contract)){
                                echo 'N/A';
                            } else {
                                echo $user_contract['UserContractHistory']['vacation_days'] - $sum_days;
                            } 
                            ?>
                            <?php echo '/'.$sum_days ?>
						<?php elseif($vac['Vacation']['vacation_status_id'] < 4): ?>
							<?php echo h($vac['VacationStatus']['name']); ?><br/>
								<?php echo $this->Permissions->link(__(' '), array('action' => 'view', $vac['Vacation']['id'].'.pdf'),array('class' =>'fa fa-print btn default clear','target'=>'_blank','title'=>__d('public','Drukuj'),'alt'=>__d('public','Drukuj'))); ?>
							<?php if($vac['Vacation']['vacation_status_id'] < 3): ?>
								<?php echo $this->Permissions->link(__(' '), array('action' => 'edit', $vac['Vacation']['id']),array('class' =>'fa fa-edit btn default clear','title'=>__d('public','Edytuj'),'alt'=>__d('public','Edytuj'))); ?>
								<?php //echo $this->Permissions->postLink(__(' '), array('action' => 'delete', $vac['Vacation']['id']),array('class' =>'fa fa-times btn default'), null, __('Usunąć # %s?', $vac['Vacation']['vacation_type_id'])); ?>
							<?php endif; ?>
							<?php echo $this->Permissions->postLink(__(' '), array('action' => 'delete', $vac['Vacation']['id']),array('class' =>'fa fa-times btn default','title'=>__d('public','Usuń'),'alt'=>__d('public','Usuń')), null, __('Usunąć # %s?', $vac['Vacation']['vacation_type_id'])); ?>
							
						<?php else: ?>
							<?php echo h($vac['VacationStatus']['name']); ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			 </tbody>
			</table>
		</div>
	<?php else: ?>
		<div class="top-buffer note note-info">
			<h4 class="block"><?php echo __d('public','Urlopy Ci nie w głowie, Twoja miłość do FEBu jest nieustanna !') ?></h4>
		</div>
	<?php endif; ?>