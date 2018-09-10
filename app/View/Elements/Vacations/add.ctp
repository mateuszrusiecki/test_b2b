

<div class="col-md-12" ng-controller="VacationsAddCtrl as vac">
    <?php echo $this->Form->create('Vacation', array('url' => array('controller' => 'vacations', 'action' => 'add'),'ng-submit' => 'vacationSubmit($event)','novalidate')); ?>

    <table>
        <tr>
            <td><label class="fleft"><?php echo __d('public', 'Rodzaj urlopu') ?></label></td>
            <td><?php
                echo $this->Metronic->input('vacation_type_id', array(
                    'label' => false,
                    'class' => 'form-control',
                    'type' => 'select',
                ));
                ?>
            </td>
        </tr>
        <tr>
            <td><label><?php echo __d('public', 'Czas trwania') ?></label></td>
            <td> <?php
                echo $this->Metronic->input('is_hours', array(
                    'legend' => '',
                    'options' => array(0 => __d('public', 'Dni'), 1 => __d('public', 'Godziny')),
                    'ng-init' => 'typetime = 0',
                    'ng-model' => 'typetime',
                    'type' => 'radio',
                    'class' => 'radio radio-list',
                    'required' => 'required'
                ));
                ?>
            </td>
        </tr>
        <tr class="is_hours" ng-show="typetime == 1">
            <td>
                <label><?php echo __d('public', 'Godzina od') ?></label>
            </td>
            <td>
                <div ng-controller="TimePickerCtrl" class="form-group">
                    <?php echo $this->Metronic->input('time_start', array('type' => 'hidden', 'ng-value' => 'newtimestart', 'ng-init' => 'setTimeStart();')); ?>
                    <timepicker class="timepicker" ng-model="timestart" ng-change="changedTimeStart()" hour-step="1" minute-step="10" show-meridian="false" mousewhell="true" ></timepicker>
                </div>
            </td>
        </tr>
        <tr class="is_hours" ng-show="typetime == 1">
            <td>
                <label><?php echo __d('public', 'Godzina do') ?></label>
            </td>
            <td>
                <div ng-controller="TimePickerCtrl" class="form-group">
                    <?php echo $this->Metronic->input('time_end', array('type' => 'hidden', 'ng-value' => 'newtimeend', 'ng-init' => 'setTimeEnd();')); ?>
                    <timepicker class="timepicker" ng-model="timeend" ng-change="changedTimeEnd()" hour-step="1" minute-step="10" show-meridian="false" mousewhell="true"></timepicker>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <label ng-show="typetime == 0"><?php echo __d('public', 'Data od') ?></label>
                <label ng-show="typetime == 1"><?php echo __d('public', 'Data') ?></label>
            </td>
            <td>
                <?php
                echo $this->Metronic->input('date_start', array(
                    'label' => false,
                    //'placeholder'=> __d('public','Data od'),
                    'type' => 'text',
                    'class' => 'form-control form-control-inline date-picker',
                    'required' => 'required',
                    'ng-model' => 'date_start',
                ));
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <label ng-show="typetime == 0"><?php echo __d('public', 'Data do') ?></label>
            </td>
            <td>
                <?php
                echo $this->Metronic->input('date_end', array(
                    'label' => false,
                    //'placeholder'=> __d('public','Data do'),
                    'type' => 'text',
                    'class' => 'form-control form-control-inline date-picker',
                    'ng-show' => 'typetime == 0',
                    'ng-model' => 'date_end'
                ));
                ?>
            </td>
        </tr>
        
        <tr ng-if="section_vacation">
            <td colspan="2"> 
                <div class="note note-warning">
                    <span><?php echo __d('public', 'W tym czasie są już zaplanowane urlopy') ?>:</span>
                    <div ng-repeat="sv in section_vacation['section_vacation']">
                        &nbsp;&nbsp;<span ng-if="sv[0]['Profile']['firstname']"> {{ sv[0]['Profile']['firstname'] + ' ' + sv[0]['Profile']['surname'] + ', <?php echo __d('public', 'urlop w dniach') ?>: ' + sv[0]['Vacation']['date_start'] + '-' + sv[0]['Vacation']['date_end'] }}</span>
                    </div>
                    <span><?php echo __d('public', 'Upewnij się, że Twój urlop nie będzie kolidował z powyższymi') ?>.</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2"><label><?php echo __d('public', 'Na czas urlopu wyznaczam zastępstwo w osobach') ?>:</label></td>
        </tr>
    </table>

    <table>
        <tr class="tr_replacement" style="display: none;">
            <td class="tr_replacement_td">
                <label><?php echo __d('public', 'Osoba') ?></label><br/>
                <label><?php echo __d('public', 'Projekt') ?></label>
            </td>
            <td>
                <?php
                echo $this->Metronic->input('VacationReplaces.user_id', array(
                    'label' => false,
                    'class' => 'form-control clear',
                    'name' => '',
                    'type' => 'select',
                    'required' => 'required'
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
                    'required' => 'required'
                ));
                ?>
            </td>
        </tr>

    </table>


    <span id="addReplacement" class="btn  green-haze"><i class="fa fa-plus"></i> Dodaj zastępstwo</span>
    <div class="clear clearfix"></div>

    <?php
    $options = array(
        'label' => __d('public', 'Zapisz'),
        'class' => 'btn green-haze clear'
    );
    ?>

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
        var i = 0;
        $("#addReplacement").on('click', function () { //dodanie zastępstwa i ustawienie odpowiednich nazw pól
            i++;
            $('.tr_replacement').before('<tr class="row_row" id="row_' + i + '">' + $('.tr_replacement').html() + '<td><span class="btn btn-icon-only red-haze remove_replacement remove_' + i + '"><i class="fa fa-times"></i></span></td></tr>');
            $('#row_' + i + ' #VacationReplacesUserId').attr('name', 'data[VacationReplaces][' + i + '][user_id]');
            $('#row_' + i + ' #VacationReplacesProjectId').attr('name', 'data[VacationReplaces][' + i + '][project_id]');
        });

        $('body').on('click', '.remove_replacement', function () {
            $(this).parent().parent('tr').remove(); //usunięcie zastępstwa
        });

    })

</script>


<?php echo $this->Html->script('angular/controllers/VacationsAddCtrl', array('block' => 'angular')); ?>