<div class="col-md-12">
	<?php echo $this->Form->create('Vacation',array('url' => array('controller' => 'vacations', 'action' => 'add'))); ?>
		
	<div>
		<label class="fleft"><?php echo __d('public','Rodzaj urlopu') ?></label>
		<?php echo $this->Metronic->input('vacation_type_id', array(
						'label' => false,
						'class' => 'form-control input-small',
						'type' => 'select',
		)); ?>
	</div>
		
	<div>
		<label><?php echo __d('public','Czas trwania') ?></label>
		<?php echo $this->Metronic->input('is_hours', array(
						'legend' => '',
						'options' => array(0=>__d('public','Dni'),1=>__d('public','Godziny')),
						'ng-init' => 'typetime = 0',
						'ng-model'=>'typetime',
						'type' => 'radio',
						'class' => 'radio radio-list',
						'required'=>'required'
		)); ?>
	</div>
		
	<div class="form_line">
		<div class="is_hours" ng-show="typetime == 1">
				<label><?php echo __d('public','Godzina od') ?></label>
				<?php echo $this->Metronic->input('hour_start', array(
						'label' => false,
						'value' => 8,
						'placeholder'=> __d('public','Godzina od'),
						'type' => 'text',
						'class' => 'form-control form-control-inline',
						'required'=>'required',
					)); ?>
				<label><?php echo __d('public','Godzina do') ?></label>
				<?php echo $this->Metronic->input('hour_end', array(
						'label' => false,
						'value' => 16,
						'placeholder'=> __d('public','Godzina do'),
						'type' => 'text',
						'class' => 'form-control form-control-inline',
						'required'=>'required'
					)); ?>
			</div>
	</div>		
			
			
	<div class="form_line">
		<label ng-show="typetime == 0"><?php echo __d('public','Data od') ?></label>
					<label ng-show="typetime == 1"><?php echo __d('public','Data') ?></label>
				
			<?php echo $this->Metronic->input('date_start', array(
						'label' => false,
						//'placeholder'=> __d('public','Data od'),
						'type' => 'text',
						'class' => 'form-control form-control-inline date-picker input-small',
						'required'=>'required'
			)); ?>
				
			<label ng-show="typetime == 0"><?php echo __d('public','Data do') ?></label>
			<?php
				echo $this->Metronic->input('date_end', array(
					'label' => false,
					//'placeholder'=> __d('public','Data do'),
					'type' => 'text',
					'class' => 'form-control form-control-inline date-picker input-small',
					'ng-show' => 'typetime == 0'
				));
			?>
	</div>
					
	<div>
		<label><?php echo __d('public','Na czas urlopu wyznaczam zastępstwo w osobach') ?>:</label>
	</div>
			
	<div>
		<span id="addReplacement" class="btn  green-haze"><i class="fa fa-plus"></i> <?php echo __d('public', 'Dodaj zastępstwo') ?></span>
	</div>
			
			
			<div class="tr_replacement" style="display: none;">
				<label><?php echo __d('public','Zastępstwo') ?></label>

				<?php 
					echo $this->Metronic->input('VacationReplaces.user_id', array(
						'label' => false,
						'class' => 'form-control clear',
						'name' => '',
						'type' => 'select',
						'required'=>'required'
					));
				?>
				
				<label><?php echo __d('public','Projekt') ?></label>
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
				

	<!--			<td>
					<span class="btn btn-icon-only red-haze remove_replacement"><i class="fa fa-times"></i></span>
				</td>-->
			</div>

		
		
<!--			<span ng-show="showAddChoice(choice)" ng-click="addNewChoice()" class="btn btn-icon-only green-haze"><i class="fa fa-plus"></i></span>
			<span  ng-click="removeChoice()" class="btn btn-icon-only red-haze"><i class="fa fa-times"></i></span>-->
		
		<div class="clear clearfix"></div>
			
		<?php $options = array(
				'label' => __d('public','Zapisz'),
				'class' => 'btn green-haze clear'
		); ?>
	
	<?php echo $this->Form->end($options); ?>

</div>

<script>
	$(document).ready(function ()
	{
		var i = 0;
		$("#addReplacement").on('click',function (){ //dodanie zastępstwa i ustawienie odpowiednich nazw pól
			i++;
			$('.tr_replacement').after('<div id="row_'+i+'">'+$('.tr_replacement').html()+'<div><span class="btn btn-icon-only red-haze remove_replacement remove_'+i+'"><i class="fa fa-times"></i></span></div></div>');
			$('#row_'+i+' #VacationReplacesUserId').attr('name','data[VacationReplaces]['+i+'][user_id]');
			$('#row_'+i+' #VacationReplacesProjectId').attr('name','data[VacationReplaces]['+i+'][project_id]');
		});
		
		$('body').on('click','.remove_replacement',function (){
			$(this).parent().parent('tr').remove(); //usunięcie zastępstwa
		});
	})
	
</script>