<?php echo $this->Metronic->portlet(__d('public', 'Lista kalendarzy')); ?>

    <div aria-hidden="true" role="dialog" tabindex="-1" id="add_calendar_modal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Dodaj nowy kalendarz') ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->create('Calendar', array('controller' => 'Calendars', 'action' => 'add')); ?>
                    <div>
                        <?php
                            echo $this->Metronic->input('name', array(
                                'label' => 'Nazwa kalendarza',
                                'value' => isset($calendar['Calendar']['name']) ? $calendar['Calendar']['name'] : '',
                            ));
                            echo $this->Metronic->input('year', array(
                                'label' => 'Rok',
                                'value' => isset($calendar['Calendar']['year']) ? $calendar['Calendar']['year'] : '',
                            ));
                            echo $this->Metronic->input('id', array(
                                'value' => isset($calendar['Calendar']['id']) ? $calendar['Calendar']['id'] : '',
                            ));
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    <button class="btn blue-madison" type="submit"><?php echo __d('public', 'Dodaj') ?></button>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>

<div ng-controller="CalendarsCtrl">

    <div aria-hidden="true" role="dialog" tabindex="-1" id="delete_calendar" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Usuń kalendarz') ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo __d('public', 'Czy na pewno chcesz usunąć kalendarz') ?>?
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    <button data-dismiss="modal" ng-click="deleteCallendar()" class="btn blue-madison"><?php echo __d('public', 'Potwierdź') ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix">
        <a class="btn btn-sm yellow margin-bottom pull-right ml" id="add_new_calendar" data-toggle="modal" href="#add_calendar_modal"><?php echo __d('public', 'Dodaj nowy kalendarz') ?></a>
    </div>

    <div class="table-scrollable table-scrollable-borderless">
        <div class="clearfix">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form>
                    <div class="input-icon right">
                        <i class="icon-magnifier"></i>
                        <div class="form-group">
                            <div class="input-icon right">
                                <input ng-model="search" type="text" id="search_box" placeholder="<?php echo __d('public', 'Szukaj') ?>" side="right" class="form-control form-control-inline" />
                            </div>
                        </div>                    
                    </div>
                </form>
            </div>	
        </div>
        <div class="portlet-body">            
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <th sort by="order" reverse="reverse" order="'Calendar.year'" class='vertical-middle'>
                            <i class="fa fa-calendar"></i> 
                            <?php echo __d('public', 'Rok'); ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'Calendar.name'" class='vertical-middle'>
                            <i class="fa fa-briefcase"></i>
                            <?php echo __d('public', 'Nazwa'); ?>
                        </th>
                        <th>
                            <i class="fa fa-cog"></i>  
                            <?php echo __d('public', 'Opcje'); ?>
                        </th>
                    </thead>
                    <tbody>
                        <tr ng-cloak ng-repeat="calendar in calendars | filter:search | orderBy:order:reverse | pag: currentPage : 10">
                            <td>
                                {{calendar.Calendar.year}}
                            </td>
                            <td>
                                {{calendar.Calendar.name}}
                            </td>
                            <td>
                                <a class="pointer" ng-click="setClickedCalendarId(calendar.Calendar.id, $index)" class="action" id="delete_calendar" href="#delete_calendar" data-toggle="modal">
                                    <i class="fa fa-close  large-icon pull-right" tooltip="<?php echo __d('public', 'Usuń') ?>"></i>
                                </a>  
                                <a class="pointer" href="/calendars/edit/{{calendar.Calendar.id}}">
                                    <i class="fa fa-eye  large-icon pull-right" tooltip="<?php echo __d('public', 'Edycja/Podglad') ?>"></i> 
                                </a>  
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="calendars | filter:search | length" boundary-links="true"></pagination>
</div>
<?php echo $this->Metronic->portletEnd(); ?>   