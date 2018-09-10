<?php echo $this->Metronic->portlet(__d('public','Nadchodzące urlopy')); ?>
<div class="clearfix row">
    <div class="col-md-3 col-sm-4 col-xs-12">
        <form class="form ng-pristine ng-valid">
            <div class="form-body">
                <div class="form-group">
                    <div class="input-icon right">
                        <i class="icon-magnifier"></i>
                        <input type="text" class="form-control" placeholder="<?php echo __d('public', 'Szukaj') ?>" ng-model="vacation_search">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div>
    <div class="table-scrollable" id="team_upcoming_vacations">
        <table class="table table-striped table-bordered table-advance table-hover" ng-init="upcomingVacations = <?php echo a($upcomingVacations); ?>">
            <thead>
                <tr>
                    <th sort by="order" reverse="reverse" order="'Vacation.id'" class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                        #
                    </th>
                    <th sort by="order" reverse="reverse" order="'Profile.surname'" class='vertical-middle'> 
                        <i class="fa fa-user"></i> <?php echo __d('public', 'Imię i nazwisko') ?>
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
                </tr>
            </thead>
            <tbody>      
                <tr class="list-group-item-warning" ng-cloak  ng-repeat="vacation in upcomingVacations| obj2arr |orderBy:order:reverse |filter: vacation_search |pag:currentPagVacation  "> 
                    <td class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                        {{vacation.Vacation.id}}
                    </td>
                    <td class='vertical-middle'>
                        <span>
                            {{vacation.Profile.firstname}}
                            {{vacation.Profile.surname}}
                        </span>
                    </td>
                    <td class='vertical-middle'>
                        {{vacation.Vacation.date_start}}
                        {{vacation.Vacation.time_start}}
                        <br>
                        {{vacation.Vacation.date_end}}
                        {{vacation.Vacation.time_end}}
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPagVacation" items-per-page="10" total-items="vacations | filter:vacation_search | length" boundary-links="true"></pagination>
<div class="clearfix">
    <div class="alert alert-info">
        <?php echo __d('public', 'Frekwencja za ostatnie 6 miesięcy') ?>: <strong><?php echo $attendance; ?>%</strong>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>

<?php echo $this->Metronic->portlet(reset($sectionName)); ?>
<?php
foreach ($profiles as $profile)
{
    ?>
    <?php echo $this->Metronic->portlet($profile['User']['profile_name'], 0, null, 'blue', 0, null, 0); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="profile-sidebar width-460">
                <div class="row">
                    <div class="col-sm-4 col-xs-5">
                        <?php
                        $avatarOptions = array('width' => 132, 'height' => 132);
                        echo $this->element('default/avatar', array('avatarOptions' => $avatarOptions, 'userProfile' => $profile['User']))
                        ?>
                        <?php //echo $this->image->thumb('/img/layouts/default/example.jpg', array('width' => '132', 'height' => '132', 'crop' => 'true'), array('class' => ''));  ?>
                    </div>
                    <div class="col-sm-8 col-xs-5">
                        <?php echo __d('public', 'Stanowisko') ?>: <strong><?php echo!empty($profile['current_contract_history']) ? $profile['current_contract_history']['UserContractHistory']['position'] : 'brak'; ?></strong><br />
                        <?php echo __d('public', 'Umowa') ?>: <strong><?php echo!empty($profile['current_contract_history']['UserContractHistory']['state']) ? $profile['current_contract_history']['UserContractHistory']['state'] : 'brak'; ?></strong><br />
                        <?php echo __d('public', 'Frekwencja za ostatnie 6 miesięcy') ?>: <strong><?php echo $profile['attendance']; ?>%</strong><br />
                        <?php echo __d('public', 'Ostatnie logowanie') ?>: <strong><?php echo $profile['last_login']; ?></strong>
                        <div class="clearfix">
                            <?php
                            echo $this->Html->link(__d('public','Kalendarz'), array('controller' => 'calendars', 'action' => 'view', 'current', $profile['Profile']['id']), array('class' => 'min-width margin-top-15 margin-right-10 poitnier btn btn-sm margin-bottom pull-left green-haze'));
                            echo $this->Html->link(__d('public','FEBbook'), array('controller' => 'social_books', 'action' => 'view', $profile['User']['email']), array('class' => 'margin-top-15 margin-right-10 poitnier btn btn-sm margin-bottom pull-left yellow'));
                            ?>
                        </div>
                    </div>
                    <?php if (!empty($profile['PersonalAim'])){ ?>
                        <div class="col-xs-12">
                            <div class="panel panel-default margin-top-15">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo __d('public', 'Cel osobisty') ?></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h4 class="no-margin"><?php echo $profile['PersonalAim']['name'] ?></h4>
                                            <?php echo __d('public', 'Stopień realizacji') ?>: <strong><?php echo $profile['PersonalAim']['status'] ?>%</strong><br />
                                            <?php echo __d('public', 'Data') ?>: <strong><?php echo $profile['PersonalAim']['start_date'] ?>  <?php echo $profile['PersonalAim']['end_date'] ?></strong>
                                        </div>
                                        <div class="col-xs-6">
                                            <?php
                                            $avatarOptionsPA = array('width' => 195, 'height' => 195, 'crop' => true);
                                            echo $this->element('default/avatar', array('avatarOptions' => $avatarOptionsPA, 'userProfile' => $profile['PersonalAim']))
                                            ?>
                                            <?php //echo $this->image->thumb('/img/layouts/default/example2.jpg', array('width' => '195', 'height' => '145', 'crop' => 'true'), array('class' => 'pull-right'));     ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="profile-content">
                <?php echo $this->element('Vacations/contract_history', array('user_contract_history' => $profile['user_contract_history'])); ?>
            </div>
        </div>
    </div>
    <?php echo $this->Metronic->portletEnd(); ?>
<?php } ?>
<?php echo $this->Metronic->portletEnd(); ?>
