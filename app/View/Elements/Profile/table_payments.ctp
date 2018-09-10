<div ng-controller="ProfilesCtrl">
    <div ng-bind="message"></div>
    <div class="clearfix">
        <div class="col-lg-3 col-md-4 col-xs-12 col-sm-6 margin-bottom-10">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input 
                    type="text" 
                    ng-model="search" 
                    class="pull-left form-control form-control-inline ng-pristine ng-valid ng-touched" 
                    placeholder="<?php echo __d('public', 'Szukaj') ?>..."
                    >
            </div>
        </div>
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
                                <span sort by="order" reverse="reverse" order="'Profile.private_email'"><?php echo __d('public', 'E-mail') ?></span>
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
                        <th class='vertical-middle hidden-sm hidden-xs'>
                            <i class="fa fa-usd"></i> <?php echo __d('public', 'Wynagrodzenie') ?>
                        </th>
                        <th class='vertical-middle hidden-sm hidden-xs'>
                            <i class="fa fa-money"></i> <?php echo __d('public', 'Wynagrodzenie netto') ?>
                        </th>
                        <th sort by="order" reverse="reverse" class='vertical-middle center-lg' order="'User.active'">
                            <i class="fa fa-square"></i> <span class='hidden-md  hidden-sm hidden-xs'><?php echo __d('public', 'Zatrudnienie') ?></span>                           
                        </th>
                        
                        <th class='vertical-middle'>
                            <i class="fa fa-cog"></i> <?php echo __d('public', 'Opcje') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-cloak ng-repeat="profile in profiles| filter:search | orderBy:order:reverse | pag: currentPage : 10"></td>
                        <td class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                            {{profile.Profile.id}}
                        </td>
                        <td class='vertical-middle' ng-class="profile.User.active == 0 ? 'font-red' : ''">
                            {{profile.Profile.firstname + ' ' + profile.Profile.surname}}
                        </td>
                        <td class='vertical-middle  hidden-xs'>
                            <strong>
                                {{profile.Profile.position|| "<?php echo __d('public', 'brak danych') ?>"}}
                            </strong><br />
                            {{profile.Profile.place_of_work|| "<?php echo __d('public', 'brak danych') ?>"}}
                        </td>
                        <td class='vertical-middle'>
                            {{profile.Profile.private_phone|| "<?php echo __d('public', 'brak danych') ?>"}}<br />
                            <div ng-if="profile.User.private_email == 1">
                                <a href="mailto:{{profile.Profile.private_email}}">
                                    {{profile.Profile.private_email}}
                                </a>
                            </div>
                            <div ng-if="!profile.User.private_email">                                
                                brak danych
                            </div>
                        </td>
                        <td class='vertical-middle hidden-sm hidden-xs'>
                            {{profile.Profile.pesel|| "<?php echo __d('public', 'brak danych') ?>"}}<br />
                            {{profile.Profile.nip|| "<?php echo __d('public', 'brak danych') ?>"}}
                        </td>
                        <td class='vertical-middle hidden-sm hidden-xs'>
                            <div ng-if="profile.UserContractHistories.id">
                                <span show-salary data-netto="0"  data-id="profile.UserContractHistories.id"></span>
                            </div>
                        </td>
                        <td class='vertical-middle hidden-sm hidden-xs'>
                            <div ng-if="profile.UserContractHistories.id">
                                <span show-salary data-netto="1"  data-id="profile.UserContractHistories.id"></span>
                            </div>
                        </td>
                        <td class='vertical-middle text-center'>
                            <div ng-if="profile.User.active == 1">
                                <i class="fa fa-check-square font-green" tooltip="{{getEmploymentTooltipText(profile.UserContractHistories.state, profile.UserContractHistories.working_time) | ucfirst}}"></i>
                            </div>
                            <div ng-if="profile.User.active == 0">
                                <i class="fa fa-minus-square font-red"></i>
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
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="profiles | filter:search | length" boundary-links="true"></pagination>
</div>

<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>