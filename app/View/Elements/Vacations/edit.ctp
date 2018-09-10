<div class="col-md-12" ng-controller="MainCtrl as main">
	<?php echo $this->Form->create('Vacation',array('url' => array('controller' => 'vacations', 'action' => 'edit', $vacation['Vacation']['id']),'ng-submit' => 'vacationSubmit($event)','novalidate')); ?>

	
	<table>
		<tr>
			<td><label><?php echo __d('public','Rodzaj urlopu') ?></label></td>
			<td><?php echo $this->Metronic->input('vacation_type_id', array(
					'label' => false,
					'class' => 'form-control ',
					'ng-model'=> 'vacationType',
					'ng-init' => 'vacationType = '.$vacationType['VacationType']['id'],
					'type' => 'select',
					'readonly'=>true
				)); ?>
			</td>
		</tr>
		<tr>
			<td><label><?php echo __d('public','Czas trwania') ?></label></td>
			<td> <?php 
				if($vacationType['VacationType']['is_hours']){
					$is_hours = 1; 
				}else{ 
					$is_hours = 0;
				}
				echo $this->Metronic->input('is_hours', array(
					'legend' => '',
					'options' => array(0=>__d('public','Dni'),1=>__d('public','Godziny')),
					'ng-init' => 'typetime = '.$is_hours,
					'ng-model'=>'typetime',
					'type' => 'radio',
					'class' => 'radio radio-list',
					'disabled'=> 'disabled',
					'value' => $is_hours
				));
                    echo $this->Metronic->input('is_hours', array('type'=>'hidden', 'value'=> $is_hours)); 
				?>
			</td>
		</tr>
	
		<tr class="is_hours" ng-show="typetime == 1">
			<td>
				<label><?php echo __d('public','Godzina od') ?></label>
			</td>
			<td>
				<div ng-controller="TimePickerCtrl" class="form-group time_input">
					<?php echo $this->Metronic->input('old_time_start', array('type' => 'hidden', 'value' => $vacation['Vacation']['time_start'])); ?>
					<?php echo $this->Metronic->input('time_start', array('type' => 'hidden', 'ng-value' => 'newtimestart', 'ng-init' => 'setTimeStart("' . $vacation['Vacation']['time_start'] . '")')); ?>
					<timepicker class="timepicker" ng-model="timestart" ng-change="changedTimeStart()" hour-step="1" minute-step="10" show-meridian="false" mousewhell="true" ></timepicker>
				</div>
			</td>
		</tr>
		<tr class="is_hours" ng-show="typetime == 1">
			<td>
				<label><?php echo __d('public','Godzina do') ?></label>
			</td>
			<td>
				<div ng-controller="TimePickerCtrl" class="form-group time_input">
					<?php echo $this->Metronic->input('old_time_end', array('type' => 'hidden', 'value' => $vacation['Vacation']['time_end'])); ?>
					<?php echo $this->Metronic->input('time_end', array('type' => 'hidden', 'ng-value' => "newtimeend", 'ng-init' => 'setTimeEnd("' . $vacation['Vacation']['time_end'] . '")')); ?>
					<timepicker class="timepicker" ng-model="timeend"  ng-change="changedTimeEnd()" hour-step="1" minute-step="10" show-meridian="false" mousewhell="true"></timepicker>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>
				<label ng-show="typetime == 0"><?php echo __d('public','Data od') ?></label>
				<label ng-show="typetime == 1"><?php echo __d('public','Data') ?></label>
			</td>
			<td>
				<?php echo $this->Metronic->input('date_start', array(
					'label' => false,
					//'placeholder'=> __d('public','Data od'),
					'type' => 'text',
					'value' => $vacation['Vacation']['date_start'],
					'class' => 'form-control form-control-inline date-picker ',
					'required'=>'required'
				)); ?>
			</td>
		</tr>
		<tr>
			<td>
				<label ng-if="typetime == 0"><?php echo __d('public','Data do') ?></label>
			</td>
			<td><?php echo $this->Metronic->input('date_end', array(
					'label' => false,
					//'placeholder'=> __d('public','Data do'),
					'value' => $vacation['Vacation']['date_end'],
					'type' => 'text',
					'class' => 'form-control form-control-inline date-picker  ',
					'ng-if' => 'typetime == 0'
				)); ?>
			</td>
		</tr>
		
<!--		<tr>
			<td colspan="2">
				<label><?php //echo $this->Permissions->link(__('Wydrukuj wniosek urlopowy'), array('action' => 'view', $vacation['Vacation']['id'].'.pdf'),array('class' =>'btn green-haze clear')); ?></label>
			</td>
		</tr>-->
		<tr>
			<td colspan="2"><label><?php echo __d('public','Na czas urlopu wyznaczam zastępstwo w osobach') ?>:</label></td>
		</tr>
		<tr>
			<td colspan="2"> </td>
		</tr>
	</table>
	
	<table>
		
			<?php $i=99 ?>
		<?php if($replaces): ?>
			<?php foreach ($replaces as $replace){ ?>
					<tr class="row_row row_<?php echo $i ?>">
						<td class="tr_replacement_td">
							<label><?php echo __d('public','Osoba') ?></label><br/>
							<label><?php echo __d('public','Projekt') ?></label>
						</td>
						<td>
							<?php echo $this->Form->input('VacationReplaces.user_id', array(
								'label' => false,
								'class' => 'form-control clear',
								'name' => 'data[VacationReplaces]['.$i.'][user_id]',
								'default' => $replace['VacationReplace']['user_id'],
								'type' => 'select',
								'required'=>'required'
							)); ?>
							<br/>
							<?php echo $this->Form->input('VacationReplaces.project_id', array(
								'label' => false,
								'class' => 'form-control clear',
								'name' => 'data[VacationReplaces]['.$i.'][project_id]',
								'type' => 'select',
								'default' => $replace['VacationReplace']['project_id'],
								'options' => $projects,
								'required'=>'required'
							)); ?>
						</td>

						<td>
							<span ng-click="removeReplacementId(<?php echo $i ?>)" class="btn btn-icon-only red-haze remove_replacement remove_<?php echo $i ?>"><i class="fa fa-times"></i></span>
						</td>
					</tr>
					
				<?php $i++; ?>
			<?php } ?>
			
		<?php endif; ?>
			
		
		
		<!--Kopjuję ten wiersz-->
		<tr class="tr_replacement" style="display: none;">
			<td class="tr_replacement_td">
				<label><?php echo __d('public','Osoba') ?></label><br/>
				<label><?php echo __d('public','Projekt') ?></label>
			</td>
			<td>
					<?php 
						echo $this->Metronic->input('VacationReplaces.user_id', array(
							'label' => false,
							'class' => 'form-control clear',
							'name' => '',
							'type' => 'select',
							'required'=>'required'
						));
					?>
					<br/>
					<?php 
						echo $this->Metronic->input('VacationReplaces.project_id', array(
							'label' => false,
							'class' => 'form-control clear',
							'name' => '',
							'type' => 'select',
							'options' => $projects,
							'required'=>'required'
						));
					?>
			</td>
		</tr>
		<!-- END Kopjuję ten wiersz END-->

	</table>


<!--		<span ng-show="showAddChoice(choice)" ng-click="addNewChoice()" class="btn btn-icon-only green-haze"><i class="fa fa-plus"></i></span>
		<span  ng-click="removeChoice()" class="btn btn-icon-only red-haze"><i class="fa fa-times"></i></span>-->
			<span id="addReplacement" class="btn green-haze pull-left"><i class="fa fa-plus"></i> <?php echo __d('public', 'Dodaj zastępstwo') ?></span>
            <div class="clear"></div>
		<?php $options = array(
			'label' => __d('public','Zapisz'),
			'class' => 'btn green-haze'
		); ?>
		<?php echo $this->Form->end($options); ?>


	<div aria-hidden="false" role="delete_project_file" tabindex="-1" id="delete_project_file" class="modal fade" my-modal ng-class="modal_toggle ? 'in show_show' : ''" ng-show="modal_toggle">
		<div class="modal-backdrop fade in" ng-click="modal_toggle = 0" style="height: 100%;"></div>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
					<h4 class="modal-title"><?php echo __d('public', 'Wniosek urlopowy'); ?></h4>
				</div>
				<div class="modal-body">
					<?php echo __d('public', 'Wybierz zastępstwo.'); ?>
				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" ng-click="modal_toggle = 0" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
				</div>
			</div>
		</div>
	</div>

</div>

<script>
	$(document).ready(function ()
	{
		var i = <?php echo $i ?>;
		$("#addReplacement").on('click',function (){ //dodanie zastępstwa i ustawienie odpowiednich nazw pól
			i++;
			$('.tr_replacement').before('<tr class="row_row row_'+i+'">'+$('.tr_replacement').html()+'<td><span ng-click="removeReplacementId('+i+')"  class="btn btn-icon-only red-haze remove_replacement remove_'+i+'"><i class="fa fa-times"></i></span></td></tr>');
			$('.row_'+i+' #VacationReplacesUserId').attr('name','data[VacationReplaces]['+i+'][user_id]');
			$('.row_'+i+' #VacationReplacesProjectId').attr('name','data[VacationReplaces]['+i+'][project_id]');
		});
		
		$('body').on('click','.remove_replacement',function (){
			$(this).parent().parent('tr').remove(); //usunięcie zastępstwa
		});
		
	})
	
</script>