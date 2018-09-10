<?php echo $this->Metronic->portlet(__d('public','Lista pracowników')); ?>

<div ng-controller="ProfilesCtrl">
    <div ng-bind="message"></div>
    <div class="clearfix">

    </div>
    <div class="clearfix row">
        <form class="form ng-pristine ng-valid">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="form-body">
                    <div class="form-group">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input 
                                type="text" 
                                ng-model="search" 
                                class="form-control ng-pristine ng-valid ng-touched" 
                                placeholder="<?php echo __d('public','Szukaj') ?>..."
                                >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <a ng-click="search_user_id = !search_user_id" ng-class="{'blue':search_user_id}" class="poitnier btn btn-sm   margin-bottom pull-left default margin-top-10">Kandydaci</a>
            </div>
        </form>
    </div>

    <div ng-hide="typeTable">
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th sort by="order" reverse="reverse" class='vertical-middle text-center hidden-md hidden-sm hidden-xs' order="'Profile.id'">
                            #
                        </th>
                        <th sort by="order" reverse="reverse" class='vertical-middle' order="'Profile.surname'">
                            <i class="fa fa-user"></i> <?php echo __d('public', 'Imię i nazwisko') ?>
                        </th>
                        <th class='vertical-middle hidden-xs' order="'Profile.surname'">
                            <span class='display-cell vertical-middle'>
                                <i class="fa fa-building margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Profile.position'"><?php echo __d('public', 'Stanowisko') ?></span>
                                <span sort by="order" reverse="reverse" order="'Profile.place_of_work'"><?php echo __d('public', 'Miejsce pracy') ?></span>
                            </span>
                        </th>
                        <th class='vertical-middle'>
                            <span class='display-cell vertical-middle'>
                                <i class="fa fa-phone margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Profile.private_phone'"><?php echo __d('public', 'Telefon') ?></span>
                                <span sort by="order" reverse="reverse" order="'User.email'"><?php echo __d('public', 'E-mail') ?></span>
                            </span>
                        </th>
                        <th class='vertical-middle hidden-sm hidden-xs'>
                            <span class='display-cell vertical-middle'>
                                <i class="fa fa-barcode margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Profile.pesel'"><?php echo __d('public', 'Pesel') ?></span>
                                <span sort by="order" reverse="reverse" order="'Profile.nip'"><?php echo __d('public', 'Nip') ?></span>
                            </span>
                        </th>
                        <th sort by="order" reverse="reverse" class='vertical-middle center-lg' order="'User.active'">
                            <i class="fa fa-square"></i> <span class='hidden-md  hidden-sm hidden-xs'><?php echo __d('public', 'Zatrudnienie') ?></span>                           
                        </th>
                        <th class='vertical-middle center-lg hidden-xs'>
                            <i class="fa fa-question"></i> <span class='hidden-md hidden-sm'><?php echo __d('public', 'Powiadomienia') ?></span>
                        </th>
                        <th class='vertical-middle'>
                            <i class="fa fa-cog"></i> <?php echo __d('public', 'Opcje') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-cloak ng-repeat="profile in profiles| filter:search | candidates:search_user_id | orderBy:order:reverse | pag: currentPage : 10">
                        <td class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                            {{profile.Profile.id}}
                        </td>
                        <td class='vertical-middle'>
                            {{profile.Profile.firstname + ' ' + profile.Profile.surname}}
                        </td>
                        <td class='vertical-middle  hidden-xs'>
                            <strong>
                                {{profile.UserContractHistories.position|| "<?php echo __d('public', 'brak danych') ?>"}}
                            </strong><br />
                            {{profile.Profile.place_of_work|| "<?php echo __d('public', 'brak danych') ?>"}}
                        </td>
                        <td class='vertical-middle'>
                            {{profile.Profile.private_phone|| "<?php echo __d('public', 'brak danych') ?>"}}<br />
                            <div ng-if="profile.User.email">
                                <a href="mailto:{{profile.User.email}}">
                                    {{profile.User.email}}
                                </a>
                            </div>
                            <div ng-if="!profile.User.email">                                
                                brak danych
                            </div>
                        </td>
                        <td class='vertical-middle hidden-sm hidden-xs'>
                            {{profile.Profile.pesel|| "<?php echo __d('public', 'brak danych') ?>"}}<br />
                            {{profile.Profile.nip|| "<?php echo __d('public', 'brak danych') ?>"}}
                        </td>
                        <td class='vertical-middle text-center'>
                            <!--                            <div ng-if="profile.User.active == 1">
                                                            <i class="fa fa-check-square font-green" tooltip="{{getEmploymentTooltipText(profile.UserContractHistories.state, profile.UserContractHistories.working_time) | ucfirst}}"></i>
                                                        </div>-->
                            <a ng-show="{{profile.User.active}}"  href="/profiles/deactivate_user/{{profile.Profile.user_id}}" tooltip="{{getEmploymentTooltipText(profile.UserContractHistories.state, profile.UserContractHistories.working_time) | ucfirst}}. <?php echo __d('public', 'Kliknij aby dezaktywować') ?>.">
                                <i class="fa fa-check-square font-green" ></i>
                            </a>
                            <a ng-if="!profile.User.active && profile.Profile.user_id"  href="/profiles/activate_user/{{profile.Profile.user_id}}" tooltip="<?php echo __d('public', 'Użytkownik nie aktywny. Kliknij aby aktywować.') ?>">
                                <i class="fa fa-minus-square font-red"></i>
                            </a>
                            <div ng-if="!profile.Profile.user_id">
                                <a href="/hrs/hire_employee/{{profile.Profile.id}}" class="">
                                    <i class="fa fa-briefcase  large-icon " tooltip="<?php echo __d('public', 'Zatrudnij') ?>"></i> 
                                </a>  
                            </div>
                        </td>
                        <td class='vertical-middle hidden-xs'>
                            <div ng-if="profile.Profile.user_id">
                                <i class="fa  font-large ml" 
                                   ng-repeat='event in profile.Event' 
                                   ng-class="{'fa-ambulance':event.event_type_id == '1',
                                               'font-green':event.event_type_id == '1',
                                               'fa-graduation-cap':event.event_type_id == '3',
                                               'font-red-pink':event.event_type_id == '3'
                                   }" 
                                   tooltip-html-unsafe="{{event.title}}<br>{{event.date_start}}"
                                   ></i>
                                <a href="/hrs/add_employe_contract/{{profile.Profile.id}}"><i class="fa fa-warning  font-red-pink font-large ml" ng-if="!profile.UserContractHistories.employment_start" tooltip="<?php echo __d('public', 'Brak danych o umowie. Kliknij aby dodać.') ?>"></i></a>
                                <i class="fa fa-file-text-o  font-green font-large ml" ng-if="profile.UserContractHistories.employment_start" tooltip="<?php echo __d('public', 'Umowa na okres') ?> {{profile.UserContractHistories.employment_start}} - {{profile.UserContractHistories.employment_end}}"></i>
                                <a ng-show="{{profile.Profile.tmpProfile}}" tooltip="<?php echo __d('public', 'Pracownik edytował swoje dane') ?>." href="/profiles/update_profile/{{profile.Profile.id}}">
                                    <i class="fa fa-pencil-square icon-state-warning font-large ml"></i>
                                </a>
                            </div>
                        </td>
                        <td class='action vertical-middle text-right'>
                            <div ng-if="profile.Profile.user_id">
                                <a href="/profiles/edit_hr/{{profile.Profile.id}}" class="">
                                    <i class="fa fa-pencil-square  large-icon pull-right" tooltip="<?php echo __d('public', 'Edycja') ?>"></i> 
                                </a>  
                                <a href="/profiles/metrics/user:{{profile.User.id}}" class="">
                                    <i class="fa fa-eye large-icon pull-right" tooltip="<?php echo __d('public', 'Podgląd') ?>"></i> 
                                </a>  	
                            </div>

                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="profiles | candidates:search_user_id | filter:search | length" boundary-links="true"></pagination>
</div>

<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>

<?php echo $this->Metronic->portletEnd(); ?>