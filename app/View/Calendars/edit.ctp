<?php echo $this->Metronic->portlet(__d('public', 'Kalendarz')); ?>           

<div ng-controller="EventsCtrl">
    
    <div style="display: block;" class="portlet-body" >
        <div class="portlet box green-meadow calendar">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i><?php echo __d('public', 'Kalendarz') ?> <span ng-bind="calendar.Calendar.year"></span>
                    <i id="calendar-info-icon" class="fa fa-info font-large ml" tooltip="<?php echo __d('public', 'Instrukcja korzystania z kalendarza') ?>"></i>
                </div>
            </div>

            <div class="portlet-body">   
                <div aria-hidden="true" role="dialog" tabindex="-1" id="events_saved" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                <h4 class="modal-title">Sukces</h4>
                            </div>
                            <div class="modal-body">
                                <?php echo __d('public', 'Kalendarz został zapisany do bazy') ?>
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="eventsSavedModal" id="events_saved" data-toggle="modal" href="#events_saved"></a>
                
                <div aria-hidden="true" role="dialog" tabindex="-1" id="delete_calendar_event" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                <h4 class="modal-title"><?php echo __d('public', 'Usuń wydarzenie') ?></h4>
                            </div>
                            <div class="modal-body">
                                <?php echo __d('public', 'Czy na pewno chcesz usunąć wydarzenie z kalendarza') ?>?
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                                <button id="modalSubmit" data-dismiss="modal" class="btn blue-madison"><?php echo __d('public', 'Potwierdź') ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="deleteEventModal" id="delete_calendar_event" data-toggle="modal" href="#delete_calendar_event" style="display: none;"></a>

                 <div aria-hidden="true" role="dialog" tabindex="-1" id="delete_external_event" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                <h4 class="modal-title"><?php echo __d('public', 'Usuń wydarzenie') ?></h4>
                            </div>
                            <div class="modal-body">
                                <?php echo __d('public', 'Czy na pewno chcesz usunąć wydarzenie') ?>?
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>        
                                <button event_id="" id="modalSubmit" data-dismiss="modal" class="btn blue-madison"><?php echo __d('public', 'Potwierdź') ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="deleteExternalEventModal" id="delete_external_event" data-toggle="modal" href="#delete_external_event" style="display: none;"></a>   

                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                        <h3 class="event-form-title"><?php echo __d('public', 'Dodaj nowe wydarzenie') ?></h3>
                        <div id="external-events">
                            <form class="inline-form">
                                <input type="text" id="event_title" placeholder="<?php echo __d('public', 'Tytuł wydarzenia') ?>" class="form-control" value="">

                                <?php 
                                    echo $this->Form->input('', array(
                                        'label' => null,
                                        'type' => 'select',
                                        'options' => $event_types,
                                        'div' => 'event_type_select',
                                        'class' => 'form-control margin-top-10',
                                        'id' => 'event_type',
                                    ));
                                ?>
      
                                <div class="clearfix">
                                    <a ng-click="addEvent()" class="btn btn-sm green-haze margin-top-10 btn-sm margin-bottom poitnier pull-left " id="event_add" href="javascript:;"><?php echo __d('public', 'Dodaj') ?></a>
                                </div>
                            </form>  
                            <form class="margin-top-10 inline-form add-people-form" style="display: none;">
                                
                                <h3 class="event-form-title"><?php echo __d('public', 'Nazwa') ?></h3>
                                <input id="event_id" type="hidden" value="">
                                
                                 <?php 
                                    echo $this->Form->input('', array(
                                        'label' => null,
                                        'type' => 'select',
                                        'options' => $profiles,
                                        'div' => 'event_type_select',
                                        'class' => 'form-control margin-top-10',
                                        'id' => 'profile',
                                    ));
                                ?>                             
                            </form>
                            <hr>
                            <div id="event_box"></div>    
                        </div>
                        <!-- END DRAGGABLE EVENTS PORTLET-->
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div id="calendar" class="has-toolbar">
                        </div> 
                    </div>
                </div>
                <!-- END CALENDAR PORTLET-->
            </div>
        </div>
    </div>  
    <div class="clearfix">
        <a class="btn btn-sm yellow margin-bottom pull-right ml" href="/calendars"><?php echo __d('public', 'Wróc do listy') ?></a>
    </div>
</div>

<?php echo $this->Metronic->portletEnd(); ?>   