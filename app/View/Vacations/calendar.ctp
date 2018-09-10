
<?php $this->Html->addCrumb(__d('public','Mój profil'), array('controller' => 'profiles', 'action' => 'metrics')); ?>
<div ng-controller="ProfileController">

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <?php echo $this->element('Profile/profile'); ?>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN PORTLET -->
                        <?php echo $this->Session->flash('updatedProfile'); ?>
                        
                        <div class="portlet light">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public','Zatrudnienie');?> 
									</span>
										
                                </div>
                            </div>
                            <div class="portlet-body">
								
								<div class="tabbable-custom nav-justified">
									<ul class="nav nav-tabs nav-justified">
										<li class="">
											<a href="#arrangement" data-toggle="tab"><?php echo __d('public','Umowa');?></a>
										</li>
                                        <li class="">
                                            <a href="#contract_history" data-toggle="tab"><?php echo __d('public', 'Historia zatrudnienia'); ?></a>
                                        </li>
										<li class=" ">
											<a href="#worktime" data-toggle="tab"><?php echo __d('public','Czas pracy');?></a>
										</li>
										<li class=" ">
											<a href="#vacations" data-toggle="tab"><?php echo __d('public','Urlopy');?></a>
										</li>
										<li class="active">
											<a href="#proposal" data-toggle="tab"><?php echo __d('public','Złóż wniosek urlopowy');?></a>
										</li>
									</ul>
									<!--BEGIN TABS-->
									<div class="tab-content">
										<div class="tab-pane" id="arrangement">
											<div class="table-scrollable table-scrollable-borderless">
												<?php echo $this->element('Vacations/arrangement'); ?>
											</div>
										</div>
                                        <div class="tab-pane " id="contract_history">
											 <?php echo $this->element('Vacations/contract_history'); ?>
                                        </div>
										<div class="tab-pane" id="worktime">
											<div class="table-scrollable table-scrollable-borderless">
											 <?php echo $this->element('work_time'); ?>

											</div>
										</div>
										<?php $events =''; ?>
										<?php if($vacations): ?>
											<?php foreach ($vacations as $vac): ?>
												<?php if($vac['Vacation']['hour_start'] && $vac['VacationType']['is_hours']){
													$hour_start = 'T'.$vac['Vacation']['hour_start'].':00:00';
												} else{
													$hour_start = '';
												}
												if($vac['Vacation']['hour_end'] && $vac['VacationType']['is_hours']){
													$hour_end = 'T'.$vac['Vacation']['hour_end'].':00:00';
												} else{
													$hour_end = '';
												} ?>
												<?php $events.= '{' ?>	
												<?php $events.= 'title: \''.$vac['VacationType']['name'].'\',' ?>	
												<?php $events.= 'start: \''.$vac['Vacation']['date_start'].$hour_start.'\',' ?>	
												<?php $events.= 'end: \''.$vac['Vacation']['date_end'].$hour_end.'\',' ?>	
												<?php $events.= '},'; ?>	
											<?php endforeach; ?>
										<?php endif; ?>

										<!--<div class="tab-pane active" id="vacations" ng-controller="CalendarCtrl" ng-init="events=[<?php //echo $events ?>]">-->
										<div class="tab-pane active" id="vacations">
											<?php								
												if($year == date('Y') || !$year){ 
													$year = date('Y');
													echo urldecode($this->Html->link(
														__d('public','Przełącz na rok ').($year-1), array(
														'controller' => 'vacations',
														'action' => 'calendar',
														($year-1).'#vacations'
														), array('escape' => false,'class'=>'btn green-haze btn-circle')
													));
												}else{
													echo urldecode($this->Html->link(
														__d('public','Przełącz na rok ').($year-1), array(
														'controller' => 'vacations',
														'action' => 'calendar',
														($year-1).'#vacations'
														), array('escape' => false,'class'=>'btn green-haze btn-circle')
													));
													//echo '<br/>';
													echo urldecode($this->Html->link(
														__d('public','Przełącz na rok ').date('Y'), array(
														'controller' => 'vacations',
														'action' => 'calendar',
														date('Y').'#vacations'
														), array('escape' => false,'class'=>'btn green-haze btn-circle')
													));
												}

												echo urldecode($this->Html->link(
													__d('public','Pokaż listę'), array(
													'controller' => 'vacations',
													'action' => 'index',
													date('Y').'#vacations'
													), array('escape' => false,'class'=>'btn green-haze btn-circle')
												));
											?>
											<br/><br/>

	<!--										<div id='calendar-lang' class="">
												<label class="col-md-1"><?php //echo __d('public','Język') ?>:</label>
												<select id="lang-selector" class="form-control input-xsmall">
													<option value="en">en</option>
													<option value="pl" selected="selected">pl</option>
												</select>
											</div>-->
											<!--@todo zaciąganie informacji o czasie pracy z dashboarda i umieszczanie ich w kalendarzu-->
											<div id="calendar"></div>

										</div>
										 <div class="tab-pane" id="proposal">
											<div class="table-scrollable table-scrollable-borderless">
												<?php echo $this->element('Vacations/add'); ?>
											</div>


										</div>
										<div>


										</div>
									</div>
									<!--END TABS-->
								</div>

                            </div>
                        </div>
                        <!-- END PORTLET -->
                    </div>
                </div>

            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

<script>

	$(document).ready(function() {
		var currentLangCode = 'pl';

		// rerender the calendar when the selected option changes
		$('#lang-selector').on('change', function() {
			if (this.value) {
				currentLangCode = this.value;
				$('#calendar').fullCalendar('destroy');
				renderCalendar();
			}
		});
		
		
		var tooltip = $('<div/>').qtip({
			id: 'calendar',
			prerender: true,
			content: {
				text: ' ',
				title: {
					button: true
				}
			},
			position: {
				my: 'bottom center',
				at: 'top center',
				target: 'event',
				viewport: $('#calendar'),
				adjust: {
					mouse: false,
					scroll: false
				}
			},
			show: false,
			style: 'qtip-light'
		}).qtip('api');
	
		
		function renderCalendar() {
			$('#calendar').fullCalendar({
				//defaultDate: '2014-11-12',
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
				//lang: 'pl',
				lang: currentLangCode,
				editable: false,
				eventLimit: true, // allow "more" link when too many events
				eventMouseover: function(data, event, view) {
					var title = data.title.replace(/\n/g, "<br />");
					var content = '<p>'+title+'</p>'; 
					tooltip.set({
						'content.text': content
					})
					//.reposition(event)
					.show(event);
				},
				eventMouseout: function(calEvent, domEvent) {
					//tooltip.hide(event);
					$('#qtip-calendar').css({'display':'none'});
				},
				events: [
					<?php echo $vacation_events; ?>
				],

			});

	
			<?php if($year != date('Y')): ?>
				$('#calendar').fullCalendar('gotoDate', <?php echo '"'.$year.'"' ?>); //ustawiam kalendarz na wybrany rok - kliknięcie 'przełącz na rok ...'
			<?php endif ?>
		}
		
		renderCalendar();
	});

</script>