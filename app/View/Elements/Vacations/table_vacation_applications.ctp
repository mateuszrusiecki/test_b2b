<div ng-controller="VacationsCtrl">
    <?php echo $this->element('Vacations/vacation_applications_modals'); ?>

    <div></div>
    <div class="clearfix row">
        <div class="col-md-3 col-sm-4 col-xs-12">
            <form class="form ng-pristine ng-valid">
                <div class="form-body">
                    <div class="form-group">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input type="text" ng-model="search" class="form-control" placeholder="Szukaj">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
            <form class="form ng-pristine ng-valid">
                <div class="form-body">
                    <div class="form-group">
                        <div class="right">
                            <select ng-model="searchStatus.Vacation.vacation_status_id" id="user_add" side="right" class="form-control">
                                <option value=""><?php echo __d('public', 'Status') ?></option>
                                <option value="4"><?php echo __d('public', 'Zatwierdzony') ?></option>
                                <option value="5"><?php echo __d('public', 'Odrzucony') ?></option>
                                <option value="3"><?php echo __d('public', 'Przyjęty') ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <div>
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th sort by="order" reverse="reverse" order="'Vacation.id'" class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                            #
                        </th>
                        <th sort by="order" reverse="reverse" order="'Profile.surname'" class='vertical-middle'> 
                            <i class="fa fa-user"></i> <?php echo __d('public', 'Imię i nazwisko') ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'Section.name'" class='vertical-middle'> 
                            <i class="fa fa-users"></i> <?php echo __d('public', 'Dział') ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'VacationType.name'" class='vertical-middle'> 
                            <i class="fa fa-coffee"></i> <?php echo __d('public', 'Rodzaj urlopu') ?>
                        </th>
                        <th class='vertical-middle'>                            
                            <span class='display-cell vertical-middle'>
                                <i class="fa fa-calendar margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Vacation.date_start'"><?php echo __d('public', 'Wolne od') ?></span>
                                <span sort by="order" reverse="reverse" order="'Vacation.date_end'"><?php echo __d('public', 'Wolne do') ?></span>
                            </span>      
                        </th>
                        <th class='vertical-middle'>
                            <span class='display-cell vertical-middle'>
                                <i class="fa fa-calculator margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Vacation.working_days'"><?php echo __d('public', 'Dni roboczych') ?></span>
                                <span sort by="order" reverse="reverse" order="'Vacation.working_hours'"><?php echo __d('public', 'Godzin') ?></span>
                            </span>                            
                        </th>
                        <th class='vertical-middle hidden-sm  hidden-xs'>
                            <span class='display-cell vertical-middle'>
                                <i class="fa fa-calculator margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Profile.vacation_days'"><?php echo __d('public', 'Dostępy urlop') ?></span>
                                <span class="vacations-header-p" sort by="order" reverse="reverse" order="'Profile.vacation_used'"><?php echo __d('public', 'Wykorzystany') ?></span>/<span class="vacations-header-p" sort by="order" reverse="reverse" order="'Profile.vacation_available'"><?php echo __d('public', 'Pozostały') ?></span>
                            </span>                            
                        </th>
                        <th class='vertical-middle'>
                            <i class="fa fa-cog"></i> <?php echo __d('public', 'Opcje') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>      
                    <tr ng-class="{'3' : 'list-group-item-warning', '5' : 'list-group-item-danger', '4' : 'list-group-item-success'}[vacation.Vacation.vacation_status_id]" ng-repeat="vacation in vacations | filter:search | filter:searchStatus | orderBy:order:reverse | pag: currentPage : 10">
                        <td class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                            {{vacation.Vacation.id}}
                        </td>
                        <td class='vertical-middle'>
                            <span ng-if="vacation.Profile.firstname || vacation.Profile.surname">
                                {{vacation.Profile.firstname}}
                                {{vacation.Profile.surname}}
                            </span>
                            <span ng-if="!vacation.Profile.surname && !vacation.Profile.firstname">
                                brak danych
                            </span>
                        </td>
                        <td class='vertical-middle'>
                            {{vacation.Section.name || '<?php echo __d('public', 'Brak danych') ?>'}}
                        </td>
                        <td class='vertical-middle'>
                            {{vacation.VacationType.name || '<?php echo __d('public', 'Brak danych') ?>'}}
                        </td>
                        <td class='vertical-middle'>
                            {{vacation.Vacation.date_start}}<br />
                            {{vacation.Vacation.date_end}}
                        </td>
                        <td class='vertical-middle'>
                            {{vacation.Vacation.working_days}}<br />
                            {{vacation.Vacation.working_hours}}
                        </td>
                        <td class='vertical-middle hidden-sm hidden-xs'>
                            <span ng-if="vacation.UserContractHistories.vacation_days">
                                {{vacation.UserContractHistories.vacation_days}} dni<br />
                                {{vacation.UserContractHistories.vacation_used || 0}} / <b>{{vacation.UserContractHistories.vacation_available}}</b> dni
                            </span>
                            <span ng-if="!vacation.UserContractHistories.vacation_days">
                                brak danych
                            </span>
                        </td>
                        <td class='action vertical-middle text-right'>
                            <span ng-show="vacation.Vacation.vacation_status_id != 4 && vacation.Vacation.vacation_status_id != 5">
                                <a ng-click="setClickedVacation(vacation)" data-toggle="modal" href="#reject_vacation_application" class="btn btn-sm red btn-sm margin-bottom pull-right poitnier"><?php echo __d('public', 'Odrzuć') ?></a>
                            </span>
                            <span ng-show="vacation.Vacation.vacation_status_id == 3">
                                <a ng-click="setClickedVacation(vacation)" data-toggle="modal" href="#confirm_vacation_application" class="btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier"><?php echo __d('public', 'Zatwierdź') ?></a>
                            </span>
                            <span ng-show="vacation.Vacation.vacation_status_id == 1">
                                <a ng-click="setClickedVacation(vacation)" data-toggle="modal" href="#apply_vacation_application" class="btn btn-sm yellow btn-sm margin-bottom pull-right poitnier"><?php echo __d('public', 'Przyjmij') ?></a>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="vacations | filter:search | filter:searchStatus | length" boundary-links="true"></pagination>
</div>

<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>