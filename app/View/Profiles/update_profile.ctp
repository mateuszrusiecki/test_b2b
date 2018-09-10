<div ng-controller="UpdateProfileCtrl" class="portlet light">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public', 'Dane profilu') ?></span>
        </div>

    </div>
    <?php if (isset($this->params['named']['user'])): ?>
        <div class="clearfix">
            <?php
            echo $this->Html->link(
                    'Lista pracowników', array('controller' => 'profiles', 'action' => 'index'), array('class' => 'btn btn-sm yellow margin-bottom pull-right ml')
            );
            ?>
            <?php
            echo $this->Html->link(
                    'Przejdź do edycji', array('controller' => 'profiles', 'action' => 'edit_hr', $profile['Profile']['id']), array('class' => 'btn btn-sm blue margin-bottom pull-right ml')
            );
            ?>
            <?php
            echo $this->Html->link(
                    'Przejdź do zatrudnienia', array('controller' => 'vacations', 'action' => 'index', 'user' => $profile['Profile']['user_id']), array('class' => 'btn btn-sm green-haze margin-bottom pull-right')
            );
            ?>                              
        </div>   
    <?php endif; ?>
    <div class="portlet-body">
        <div class="tabbable-custom nav-justified">
            <ul class="nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#personal" data-toggle="tab">
                        <?php echo __d('public', 'Dane personalne') ?> </a>
                </li>
                <li>
                    <a href="#tax" data-toggle="tab">
                        <?php echo __d('public', 'Dane podatkowe i ubezpieczeniowe') ?> </a>
                </li>
                <li>
                    <a href="#address" data-toggle="tab">
                        <?php echo __d('public', 'Dane teleadresowe') ?> </a>
                </li>
            </ul>

            <!--BEGIN TABS-->
            <div class="tab-content">
                <div class="tab-pane active" id="personal">
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <tbody>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Imię') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_firstname']): ?>                                            
                                            <span ng-hide="hide_firstname" ng-class="{'lt' : !hide_firstname_temp}" class="mr">
                                                <?php echo $profile['Profile']['firstname']; ?>
                                            </span>
                                            <span ng-hide="hide_firstname_temp">
                                                <?php echo $profile['Profile']['_firstname']; ?>
                                            </span>
                                            <span ng-hide="hide_firstname_temp || hide_firstname">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('firstname')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('firstname')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['firstname']; ?>
                                        <?php endif; ?>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Nazwisko') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_surname']): ?>
                                            <span ng-hide="hide_surname" ng-class="{'lt' : !hide_surname_temp}" class="mr">
                                                <?php echo $profile['Profile']['surname']; ?>
                                            </span>
                                            <span ng-hide="hide_surname_temp">
                                                <?php echo $profile['Profile']['_surname']; ?>
                                            </span>
                                            <span ng-hide="hide_surname || hide_surname_temp">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('surname')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('surname')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['surname']; ?>
                                        <?php endif; ?>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Data urodzenia') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_date_of_birth']): ?>
                                            <span ng-hide="hide_date_of_birth" ng-class="{'lt' : !hide_date_of_birth_temp}" class="mr">
                                                <?php
                                                    if($profile['Profile']['date_of_birth']) echo date('Y-m-d', strtotime($profile['Profile']['date_of_birth']));
                                                ?>
                                            </span>
                                            <span ng-hide="hide_date_of_birth_temp">
                                                <?php
                                                    echo date('Y-m-d', strtotime($profile['Profile']['_date_of_birth']));
                                                ?>
                                            </span>
                                            <span ng-hide="hide_date_of_birth || hide_date_of_birth_temp">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('date_of_birth')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('date_of_birth')"></i>
                                            </span>
                                        <?php elseif ($profile['Profile']['date_of_birth']): ?>
                                            <?php echo date('Y-m-d', strtotime($profile['Profile']['date_of_birth'])); ?>
                                        <?php endif; ?>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Miejsce urodzenia') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_place_of_birth']): ?>
                                            <span ng-hide="hide_place_of_birth" ng-class="{'lt' : !hide_place_of_birth_temp}" class="mr">
                                                <?php echo $profile['Profile']['place_of_birth']; ?>
                                            </span>
                                            <span ng-hide="hide_place_of_birth_temp">
                                                <?php echo $profile['Profile']['_place_of_birth']; ?>
                                            </span>
                                            <span ng-hide="hide_place_of_birth || hide_place_of_birth_temp">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('place_of_birth')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('place_of_birth')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['place_of_birth']; ?>
                                        <?php endif; ?>  
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        Imię ojca:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_father_name']): ?>
                                            <span ng-hide="hide_father_name" ng-class="{'lt' : !hide_father_name_temp}" class="mr">
                                                <?php echo $profile['Profile']['father_name']; ?>
                                            </span>
                                            <span ng-hide="hide_father_name_temp">
                                                <?php echo $profile['Profile']['_father_name']; ?>
                                            </span>
                                            <span ng-hide="hide_father_name_temp || hide_father_name">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('father_name')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('father_name')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['father_name']; ?>
                                        <?php endif; ?>  
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        Imię matki:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_mother_name']): ?>
                                            <span ng-hide="hide_mother_name" ng-class="{'lt' : !hide_mother_name_temp}" class="mr">
                                                <?php echo $profile['Profile']['mother_name']; ?>
                                            </span>
                                            <span ng-hide="hide_mother_name_temp">
                                                <?php echo $profile['Profile']['_mother_name']; ?>
                                            </span>
                                            <span ng-hide="hide_mother_name_temp || hide_mother_name">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('mother_name')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('mother_name')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['mother_name']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        Nazwisko rodowe:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_family_surname']): ?>
                                            <span ng-hide="hide_family_surname" ng-class="{'lt' : !hide_family_surname_temp}" class="mr">
                                                <?php echo $profile['Profile']['family_surname']; ?>
                                            </span>
                                            <span ng-hide="hide_family_surname_temp">
                                                <?php echo $profile['Profile']['_family_surname']; ?>
                                            </span>
                                            <span ng-hide="hide_family_surname_temp || hide_family_surname">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('family_surname')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('family_surname')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['family_surname']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'PESEL') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_pesel']): ?>
                                            <span ng-hide="hide_pesel" ng-class="{'lt' : !hide_pesel_temp}" class="mr">
                                                <?php echo $profile['Profile']['pesel']; ?>
                                            </span>
                                            <span ng-hide="hide_pesel_temp">
                                                <?php echo $profile['Profile']['_pesel']; ?>
                                            </span>
                                            <span ng-hide="hide_pesel_temp || hide_pesel">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('pesel')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('pesel')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['pesel']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Wykształcenie') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_education']): ?>
                                            <span ng-hide="hide_education" ng-class="{'lt' : !hide_education_temp}" class="mr">
                                                <?php echo $profile['Profile']['education']; ?>
                                            </span>
                                            <span ng-hide="hide_education_temp">
                                                <?php echo $profile['Profile']['_education']; ?>
                                            </span>
                                            <span ng-hide="hide_education_temp || hide_education">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('education')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('education')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['education']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Rodzaj dowodu tożsamości') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_type_of_card_id']): ?>
                                            <span ng-hide="hide_type_of_card_id" ng-class="{'lt' : !hide_type_of_card_id_temp}" class="mr">
                                                <?php echo $profile['Profile']['type_of_card_id']; ?>
                                            </span>
                                            <span ng-hide="hide_type_of_card_id_temp">
                                                <?php echo $profile['Profile']['_type_of_card_id']; ?>
                                            </span>
                                            <span ng-hide="hide_type_of_card_id_temp || hide_type_of_card_id">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('type_of_card_id')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('type_of_card_id')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['type_of_card_id']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Seria i numer dowodu tożsamości') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_card_id_number']): ?>
                                            <span ng-hide="hide_card_id_number" ng-class="{'lt' : !hide_card_id_number_temp}" class="mr">
                                                <?php echo $profile['Profile']['card_id_number']; ?>
                                            </span>
                                            <span ng-hide="hide_card_id_number_temp">
                                                <?php echo $profile['Profile']['_card_id_number']; ?>
                                            </span>
                                            <span ng-hide="hide_card_id_number || hide_card_id_number_temp">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('card_id_number')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('card_id_number')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['card_id_number']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Nazwa banku') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_bank_name']): ?>
                                            <span ng-hide="hide_bank_name" ng-class="{'lt' : !hide_bank_name_temp}" class="mr">
                                                <?php echo $profile['Profile']['bank_name']; ?>
                                            </span>
                                            <span ng-hide="hide_bank_name_temp">
                                                <?php echo $profile['Profile']['_bank_name']; ?>
                                            </span>
                                            <span ng-hide="hide_bank_name_temp || hide_bank_name">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('bank_name')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('bank_name')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['bank_name']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Numer konta') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_account_number']): ?>
                                            <span ng-hide="hide_account_number" ng-class="{'lt' : !hide_account_number_temp}" class="mr">
                                                <?php echo $profile['Profile']['account_number']; ?>
                                            </span>
                                            <span ng-hide="hide_account_number_temp">
                                                <?php echo $profile['Profile']['_account_number']; ?>
                                            </span>
                                            <span ng-hide="hide_account_number_temp || hide_account_number">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('account_number')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('account_number')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['account_number']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tax">
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <tbody>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'NIP') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_nip']): ?>
                                            <span ng-hide="hide_nip" ng-class="{'lt' : !hide_nip_temp}" class="mr">
                                                <?php echo $profile['Profile']['nip']; ?>
                                            </span>
                                            <span ng-hide="hide_nip_temp">
                                                <?php echo $profile['Profile']['_nip']; ?>
                                            </span>
                                            <span ng-hide="hide_nip_temp || hide_nip">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('nip')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('nip')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['nip']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Urząd skarbowy') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_revenue']): ?>
                                            <span ng-hide="hide_revenue" ng-class="{'lt' : !hide_revenue_temp}" class="mr">
                                                <?php echo $profile['Profile']['revenue']; ?>
                                            </span>
                                            <span ng-hide="hide_revenue_temp">
                                                <?php echo $profile['Profile']['_revenue']; ?>
                                            </span>
                                            <span ng-hide="hide_revenue_temp || hide_revenue">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('revenue')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('revenue')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['revenue']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Miejsce pracy') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_place_of_work']): ?>
                                            <span ng-hide="hide_place_of_work" ng-class="{'lt' : !hide_place_of_work_temp}" class="mr">
                                                <?php echo $profile['Profile']['place_of_work']; ?>
                                            </span>
                                            <span ng-hide="hide_place_of_work_temp">
                                                <?php echo $profile['Profile']['_place_of_work']; ?>
                                            </span>
                                            <span ng-hide="hide_place_of_work_temp || hide_place_of_work">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('place_of_work')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('place_of_work')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['place_of_work']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Etat') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_state']): ?>
                                            <span ng-hide="hide_state" ng-class="{'lt' : !hide_state_temp}" class="mr">
                                                <?php echo $profile['Profile']['state']; ?>
                                            </span>
                                            <span ng-hide="hide_state_temp">
                                                <?php echo $profile['Profile']['_state']; ?>
                                            </span>
                                            <span ng-hide="hide_state || hide_state_temp">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('state')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('state')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['state']; ?>                                           
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Stanowisko') ?>:
                                    </td>
                                    <td>
                                        <?php echo $uch['UserContractHistory']['position']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        Okres zatrudnienia:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_period_of_employment']): ?>
                                            <span ng-hide="hide_period_of_employment" ng-class="{'lt' : !hide_period_of_employment_temp}" class="mr">
                                                <?php echo $profile['Profile']['period_of_employment']; ?>
                                            </span>
                                            <span ng-hide="hide_period_of_employment_temp">
                                                <?php echo $profile['Profile']['_period_of_employment']; ?>
                                            </span>
                                            <span ng-hide="hide_period_of_employment_temp || hide_period_of_employment">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('period_of_employment')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('period_of_employment')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['period_of_employment']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>                          
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Ilość urlopu rocznie:') ?>
                                    </td>
                                    <td>
                                        <?php echo $profile['Profile']['vacation_days']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Prawo do renty / emerytury:') ?>
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_right_to_pension']): ?>
                                            <span ng-hide="hide_right_to_pension" ng-class="{'lt' : !hide_right_to_pension_temp}" class="mr">
                                                <?php echo $profile['Profile']['right_to_pension'] ? 'Tak' : 'Nie'; ?>
                                            </span>
                                            <span ng-hide="hide_right_to_pension_temp">
                                                <?php echo $profile['Profile']['_right_to_pension'] ? 'Tak' : 'Nie'; ?>
                                            </span>
                                            <span ng-hide="hide_right_to_pension_temp || hide_right_to_pension">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('right_to_pension')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('right_to_pension')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['right_to_pension'] ? 'Tak' : 'Nie'; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Bezrobotny / student') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_unemployed']): ?>
                                            <span ng-hide="hide_unemployed" ng-class="{'lt' : !hide_unemployed_temp}" class="mr">
                                                <?php echo $profile['Profile']['unemployed'] ? 'Tak' : 'Nie'; ?>
                                            </span>
                                            <span ng-hide="hide_unemployed_temp">
                                                <?php echo $profile['Profile']['_unemployed'] ? 'Tak' : 'Nie'; ?>
                                            </span>
                                            <span ng-hide="hide_unemployed_temp || hide_unemployed">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('unemployed')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('unemployed')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['unemployed'] ? 'Tak' : 'Nie'; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Oddział NFZ') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_nfz']): ?>
                                            <span ng-hide="hide_nfz" ng-class="{'lt' : !hide_nfz_temp}" class="mr">
                                                <?php echo $profile['Profile']['nfz']; ?>
                                            </span>
                                            <span ng-hide="hide_nfz_temp">
                                                <?php echo $profile['Profile']['_nfz']; ?>
                                            </span>
                                            <span ng-hide="hide_nfz_temp || hide_nfz">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('nfz')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('nfz')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['nfz']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Orzeczenie o niepełnosprawności') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_unemployed']): ?>
                                            <span ng-hide="hide_disabled" ng-class="{'lt' : !hide_disabled_temp}" class="mr">
                                                <?php echo $profile['Profile']['disabled'] ? 'Tak' : 'Nie'; ?>
                                            </span>
                                            <span ng-hide="hide_disabled_temp">
                                                <?php echo $profile['Profile']['_disabled'] ? 'Tak' : 'Nie'; ?>
                                            </span>
                                            <span ng-hide="hide_disabled_temp || hide_disabled">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('disabled')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('disabled')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['disabled'] ? 'Tak' : 'Nie'; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="address">
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                                <tr class="uppercase">
                                    <th colspan="2">
                                        <?php echo __d('public', 'Dane kontaktowe') ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-6">
                                       <?php echo __d('public', 'Numer telefonu służbowy') ?> :
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_work_phone']): ?>
                                            <span ng-hide="hide_work_phone" ng-class="{'lt' : !hide_work_phone_temp}" class="mr">
                                                <?php echo $profile['Profile']['work_phone']; ?>
                                            </span>
                                            <span ng-hide="hide_work_phone_temp">
                                                <?php echo $profile['Profile']['_work_phone']; ?>
                                            </span>    
                                            <span ng-hide="hide_work_phone_temp || hide_work_phone">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('work_phone')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('work_phone')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['work_phone']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Numer telefonu prywatny') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_private_phone']): ?>
                                            <span ng-hide="hide_private_phone" ng-class="{'lt' : !hide_private_phone_temp}" class="mr">
                                                <?php echo $profile['Profile']['private_phone']; ?>
                                            </span>
                                            <span ng-hide="hide_private_phone_temp">
                                                <?php echo $profile['Profile']['_private_phone']; ?>
                                            </span>
                                            <span ng-hide="hide_private_phone_temp || hide_private_phone">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('private_phone')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('private_phone')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['private_phone']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Numer osoby bliskiej') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_friend_phone']): ?>
                                            <span ng-hide="hide_friend_phone" ng-class="{'lt' : !hide_friend_phone_temp}" class="mr">
                                                <?php echo $profile['Profile']['friend_phone']; ?>
                                            </span>
                                            <span ng-hide="hide_friend_phone_temp">
                                                <?php echo $profile['Profile']['_friend_phone']; ?>
                                            </span>
                                            <span ng-hide="hide_friend_phone_temp || hide_friend_phone">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('friend_phone')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('friend_phone')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['friend_phone']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', '') ?><?php echo __d('public', 'Adres email służbowy') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['User']['email']): ?>
                                            <?php echo $profile['User']['email']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                       <?php echo __d('public', 'Adres email prywatny') ?> :
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_private_email']): ?>
                                            <span ng-hide="hide_private_email" ng-class="{'lt' : !hide_private_email_temp}" class="mr">
                                                <?php echo $profile['Profile']['private_email']; ?>
                                            </span>
                                            <span ng-hide="hide_private_email_temp">
                                                <?php echo $profile['Profile']['_private_email']; ?>
                                            </span>
                                            <span ng-hide="hide_private_email_temp || hide_private_email">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('private_email')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('private_email')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['private_email']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                                <tr class="uppercase">
                                    <th colspan="2">
                                       <?php echo __d('public', 'Adres zameldowania') ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-6">
                                        Ulica:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_reg_street']): ?>
                                            <span ng-hide="hide_reg_street" ng-class="{'lt' : !hide_reg_street_temp}" class="mr">
                                                <?php echo $profile['Profile']['reg_street']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_street_temp" >
                                                <?php echo $profile['Profile']['_reg_street']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_street_temp || hide_reg_street">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('reg_street')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('reg_street')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['reg_street']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Nr domu') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_reg_house_number']): ?>
                                            <span ng-hide="hide_reg_house_number" ng-class="{'lt' : !hide_reg_house_number_temp}"  class="mr">
                                                <?php echo $profile['Profile']['reg_house_number']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_house_number_temp">
                                                <?php echo $profile['Profile']['_reg_house_number']; ?>
                                            </span>    
                                            <span ng-hide="hide_reg_house_number_temp || hide_reg_house_number">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('reg_house_number')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('reg_house_number')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['reg_house_number']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Nr lokalu') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_reg_flat_number']): ?>
                                            <span ng-hide="hide_reg_flat_number" ng-class="{'lt' : !hide_reg_flat_number_temp}" class="mr">
                                                <?php echo $profile['Profile']['reg_flat_number']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_flat_number_temp">
                                                <?php echo $profile['Profile']['_reg_flat_number']; ?>
                                            </span>    
                                            <span ng-hide="hide_reg_flat_number_temp || hide_reg_flat_number">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('reg_flat_number')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('reg_flat_number')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['reg_flat_number']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Kod pocztowy') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_reg_postcode']): ?>
                                            <span ng-hide="hide_reg_postcode" ng-class="{'lt' : !hide_reg_postcode_temp}" class="mr">
                                                <?php echo $profile['Profile']['reg_postcode']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_postcode_temp">
                                                <?php echo $profile['Profile']['_reg_postcode']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_postcode || hide_reg_postcode_temp">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('reg_postcode')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('reg_postcode')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['reg_postcode']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Miejscowość') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_reg_city']): ?>
                                            <span ng-hide="hide_reg_city" ng-class="{'lt' : !hide_reg_city_temp}" class="mr">
                                                <?php echo $profile['Profile']['reg_city']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_city_temp">
                                                <?php echo $profile['Profile']['_reg_city']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_city_temp || hide_reg_city">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('reg_city')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('reg_city')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['reg_city']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Gmina') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_reg_community']): ?>
                                            <span ng-hide="hide_reg_community" ng-class="{'lt' : !hide_reg_community_temp}" class="mr">
                                                <?php echo $profile['Profile']['reg_community']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_community_temp">
                                                <?php echo $profile['Profile']['_reg_community']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_community_temp || hide_reg_community">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('reg_community')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('reg_community')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['reg_community']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Powiat') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_reg_district']): ?>
                                            <span ng-hide="hide_reg_district" ng-class="{'lt' : !hide_reg_district_temp}" class="mr">
                                                <?php echo $profile['Profile']['reg_district']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_district_temp">
                                                <?php echo $profile['Profile']['_reg_district']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_district_temp || hide_reg_district">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('reg_district')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('reg_district')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['reg_district']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Województwo') ?>:
                                    </td>
                                    <td>
                                        <?php if ($profile['Profile']['_reg_province']): ?>
                                            <span ng-hide="hide_reg_province" ng-class="{'lt' : !hide_reg_province_temp}" class="mr">
                                                <?php echo $profile['Profile']['reg_province']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_province_temp">
                                                <?php echo $profile['Profile']['_reg_province']; ?>
                                            </span>
                                            <span ng-hide="hide_reg_province_temp || hide_reg_province">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('reg_province')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('reg_province')"></i>
                                            </span>
                                        <?php else: ?>
                                            <?php echo $profile['Profile']['reg_province']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">
                                        <?php echo __d('public', 'Państwo') ?>:
                                    </td>
                                    <td>
                                        <?php if (isset($countries[$profile['Profile']['_reg_country_id']]) && isset($countries[$profile['Profile']['reg_country_id']])): ?>
                                            <span ng-hide="hide_reg_country_id" ng-class="{'lt' : !hide_reg_country_id_temp}" class="mr">
                                                <?php echo $countries[$profile['Profile']['reg_country_id']]; ?>
                                            </span>
                                            <span ng-hide="hide_reg_country_id_temp">
                                                <?php echo $countries[$profile['Profile']['_reg_country_id']]; ?>
                                            </span>
                                            <span ng-hide="hide_reg_country_id_temp || hide_reg_country_id">
                                                <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('reg_country_id')"></i> 
                                                <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('reg_country_id')"></i>
                                            </span>
                                        <?php elseif ($countries[$profile['Profile']['reg_country_id']]): ?>
                                            <?php echo $countries[$profile['Profile']['reg_country_id']]; ?>
                                        <?php endif; ?>                                     
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                    <?php
                    if ($profile['Profile']['reg_street'] != $profile['Profile']['street'] ||
                            $profile['Profile']['reg_house_number'] != $profile['Profile']['house_number'] ||
                            $profile['Profile']['reg_flat_number'] != $profile['Profile']['flat_number'] ||
                            $profile['Profile']['reg_postcode'] != $profile['Profile']['postcode'] ||
                            $profile['Profile']['reg_city'] != $profile['Profile']['city'] ||
                            $profile['Profile']['reg_community'] != $profile['Profile']['community'] ||
                            $profile['Profile']['reg_district'] != $profile['Profile']['district'] ||
                            $profile['Profile']['reg_province'] != $profile['Profile']['province']
                    ):
                        ?>
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr class="uppercase">
                                        <th colspan="2">
                                            <?php echo __d('public', 'Adres zamieszkania') ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-6">
                                            <?php echo __d('public', 'Ulica') ?>:
                                        </td>
                                        <td>
                                            <?php if ($profile['Profile']['_street']): ?>
                                                <span ng-hide="hide_street" ng-class="{'lt' : !hide_street_temp}" class="mr">
                                                    <?php echo $profile['Profile']['street']; ?>
                                                </span>
                                                <span ng-hide="hide_street_temp">
                                                    <?php echo $profile['Profile']['_street']; ?>
                                                </span>
                                                <span ng-hide="hide_street_temp || hide_street">
                                                    <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('street')"></i> 
                                                    <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('street')"></i>
                                                </span>
                                            <?php else: ?>
                                                <?php echo $profile['Profile']['street']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6">
                                            <?php echo __d('public', 'Nr domu') ?>:
                                        </td>
                                        <td>
                                            <?php if ($profile['Profile']['_house_number']): ?>
                                                <span ng-hide="hide_house_number" ng-class="{'lt' : !hide_house_number_temp}" class="mr">
                                                    <?php echo $profile['Profile']['house_number']; ?>
                                                </span>
                                                <span ng-hide="hide_house_number_temp">
                                                    <?php echo $profile['Profile']['_house_number']; ?>
                                                </span>
                                                <span ng-hide="hide_house_number_temp || hide_house_number">
                                                    <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('house_number')"></i> 
                                                    <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('house_number')"></i>
                                                </span>
                                            <?php else: ?>
                                                <?php echo $profile['Profile']['house_number']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6">
                                           <?php echo __d('public', 'Nr lokalu') ?> :
                                        </td>
                                        <td>
                                            <?php if ($profile['Profile']['_flat_number']): ?>
                                                <span ng-hide="hide_flat_number" ng-class="{'lt' : !hide_flat_number_temp}" class="mr">
                                                    <?php echo $profile['Profile']['flat_number']; ?>
                                                </span>
                                                <span ng-hide="hide_flat_number_temp"> 
                                                    <?php echo $profile['Profile']['_flat_number']; ?>
                                                </span>
                                                <span ng-hide="hide_flat_number || hide_flat_number_temp">
                                                    <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('flat_number')"></i> 
                                                    <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('flat_number')"></i>
                                                </span>
                                            <?php else: ?>
                                                <?php echo $profile['Profile']['flat_number']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6">
                                            <?php echo __d('public', 'Kod pocztowy') ?>:
                                        </td>
                                        <td>
                                            <?php if ($profile['Profile']['_postcode']): ?>
                                                <span ng-hide="hide_postcode" ng-class="{'lt' : !hide_postcode_temp}" class="mr">
                                                    <?php echo $profile['Profile']['postcode']; ?>
                                                </span>
                                                <span ng-hide="hide_postcode_temp">
                                                    <?php echo $profile['Profile']['_postcode']; ?>
                                                </span>
                                                <span ng-hide="hide_postcode_temp || hide_postcode">
                                                    <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('postcode')"></i> 
                                                    <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('postcode')"></i>
                                                </span>
                                            <?php else: ?>
                                                <?php echo $profile['Profile']['postcode']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6">
                                            <?php echo __d('public', 'Miejscowość') ?>:
                                        </td>
                                        <td>
                                            <?php if ($profile['Profile']['_city']): ?>
                                                <span ng-hide="hide_city" ng-class="{'lt' : !hide_city_temp}" class="mr">
                                                    <?php echo $profile['Profile']['city']; ?>
                                                </span>
                                                <span ng-hide="hide_city_temp">
                                                    <?php echo $profile['Profile']['_city']; ?>
                                                </span>
                                                <span ng-hide="hide_city_temp || hide_city">
                                                    <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('city')"></i> 
                                                    <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('city')"></i>
                                                </span>
                                            <?php else: ?>
                                                <?php echo $profile['Profile']['city']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6">
                                            <?php echo __d('public', 'Gmina') ?>:
                                        </td>
                                        <td>
                                            <?php if ($profile['Profile']['_community']): ?>
                                                <span ng-hide="hide_community" ng-class="{'lt' : !hide_community_temp}" class="mr">
                                                    <?php echo $profile['Profile']['community']; ?>
                                                </span>
                                                <span ng-hide="hide_community_temp">
                                                    <?php echo $profile['Profile']['_community']; ?>
                                                </span>
                                                <span ng-hide="hide_community_temp || hide_community">
                                                    <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('community')"></i> 
                                                    <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('community')"></i>
                                                </span>
                                            <?php else: ?>
                                                <?php echo $profile['Profile']['community']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6">
                                            <?php echo __d('public', 'Powiat') ?>:
                                        </td>
                                        <td>
                                            <?php if ($profile['Profile']['_district']): ?>
                                                <span ng-hide="hide_district" ng-class="{'lt' : !hide_district_temp}" class="mr">
                                                    <?php echo $profile['Profile']['district']; ?>
                                                </span>
                                                <span ng-hide="hide_district_temp">
                                                    <?php echo $profile['Profile']['_district']; ?>
                                                </span>
                                                <span ng-hide="hide_district_temp || hide_district">
                                                    <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('district')"></i> 
                                                    <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('district')"></i>
                                                </span>
                                            <?php else: ?>
                                                <?php echo $profile['Profile']['district']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6">
                                            <?php echo __d('public', 'Województwo') ?>:
                                        </td>
                                        <td>
                                            <?php if ($profile['Profile']['_province']): ?>
                                                <span ng-hide="hide_province" ng-class="{'lt' : !hide_province_temp}" class="mr">
                                                    <?php echo $profile['Profile']['province']; ?>
                                                </span>
                                                <span ng-hide="hide_province_temp">
                                                    <?php echo $profile['Profile']['_province']; ?>
                                                </span>
                                                <?php echo $profile['Profile']['province']; ?>
                                                    <span ng-hide="hide_province_temp || hide_province">
                                                    <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('province')"></i> 
                                                    <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('province')"></i>
                                                </span>
                                            <?php else: ?>
                                                <?php echo $profile['Profile']['province']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6">
                                            <?php echo __d('public', 'Państwo') ?>:
                                        </td>
                                        <td>
                                            <?php if (isset($countries[$profile['Profile']['_country_id']]) && isset($countries[$profile['Profile']['country_id']])): ?>
                                                <span ng-hide="hide_country_id" ng-class="{'lt' : !hide_country_id_temp}" class="mr">
                                                    <?php echo $countries[$profile['Profile']['country_id']]; ?>
                                                </span>
                                                <span ng-hide="hide_country_id_temp">
                                                    <?php echo $countries[$profile['Profile']['_country_id']]; ?>
                                                </span>
                                                <span ng-hide="hide_country_id || hide_country_id_temp">
                                                    <i class="fa pointer fa-times-circle font-red pull-right" tooltip="<?php echo __d('public', 'Odrzuć zmiany') ?>" ng-click="rejectChange('country_id')"></i> 
                                                    <i class="fa pointer fa-check-circle font-green pull-right" tooltip="<?php echo __d('public', 'Akceptuj zmiany') ?>" ng-click="acceptChange('country_id')"></i>
                                                </span>
                                            <?php elseif ($countries[$profile['Profile']['country_id']]): ?>
                                                <?php echo $countries[$profile['Profile']['country_id']]; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--END TABS-->
    </div>
</div>