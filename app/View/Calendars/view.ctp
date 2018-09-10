<?php echo $this->Metronic->portlet(__d('public', 'Kalendarz')); ?>           

<div ng-controller="EventsViewCtrl">

    <div style="display: block;" class="portlet-body" ng-init="getCalendar('<?php echo $calendar_id; ?>','<?php echo $profile_id; ?>');">
        <div class="portlet box green-meadow calendar">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i><?php echo __d('public', 'Kalendarz') ?> <span ng-bind="calendar.Calendar.year"></span>
                </div>
            </div>

            <div class="portlet-body">             
                <div class="row">                  
                    <div class="col-md-12 col-sm-12">
                        <div id="calendar" class="has-toolbar">
                        </div> 
                    </div>
                </div>
                <!-- END CALENDAR PORTLET-->
            </div>
        </div>
    </div>  
</div>

<?php echo $this->Metronic->portletEnd(); ?>   