<?php // debug(array_flip($profile['Profile']));    ?>



<?php $this->Html->addCrumb(__d('public','Mój profil'), array('controller' => 'profiles', 'action' => 'metrics')); ?>
<div ng-controller="ProfileController">

    <div class="md-overlay"></div>
    <!--/modal-->

    <div aria-hidden="true" role="dialog" tabindex="-1" id="change_profile_modal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Zmiana danych osobowych') ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->create('Profile', array('controller' => 'profiles', 'action' => 'profile_update')); ?>

                    <div class="portlet-title tabbable-line">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#change_personal" data-toggle="tab">
                                    <?php echo __d('public', 'Dane personalne') ?> </a>
                            </li>
                            <li>
                                <a href="#change_tax" data-toggle="tab">
                                    <?php echo __d('public', 'Dane podatkowe i ubezpieczeniowe') ?> </a>
                            </li>
                            <li>
                                <a href="#change_address" data-toggle="tab">
                                    <?php echo __d('public', 'Dane teleadresowe') ?> </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane active margin-top-20" id="change_personal">
                            <?php
                            echo $this->Metronic->input('_firstname', array(
                                'placeholder' => $profile['Profile']['firstname'],
                                'label' => __d('public','Imię')
                            ));

                            echo $this->Metronic->input('_surname', array(
                                'placeholder' => $profile['Profile']['surname'],
                                'label' => __d('public','Nazwisko')
                            ));

                            echo $this->Metronic->input('_date_of_birth', array(
                                'placeholder' => $profile['Profile']['date_of_birth'],
                                'type' => 'text',
                                'ng-model' => '_date_of_birth',
                                'class' => 'form-control form-control-inline date-picker',
                                'label' => __d('public','Data urodzenia')
                            ));

                            echo $this->Metronic->input('_place_of_birth', array(
                                'placeholder' => $profile['Profile']['place_of_birth'],
                                'label' => __d('public','Miejsce urodzenia')
                            ));

                            echo $this->Metronic->input('_father_name', array(
                                'placeholder' => $profile['Profile']['father_name'],
                                'label' => __d('public','Imię ojca')
                            ));

                            echo $this->Metronic->input('_mother_name', array(
                                'placeholder' => $profile['Profile']['mother_name'],
                                'label' => __d('public','Imię matki')
                            ));

                            echo $this->Metronic->input('_family_surname', array(
                                'placeholder' => $profile['Profile']['family_surname'],
                                'label' => __d('public','Nazwisko rodowe')
                            ));

                            echo $this->Metronic->input('_pesel', array(
                                'placeholder' => $profile['Profile']['pesel'],
                                'label' => __d('public','PESEL')
                            ));

                            echo $this->Metronic->input('_education', array(
                                'placeholder' => $profile['Profile']['education'],
                                'label' => __d('public','Wykształcenie')
                            ));

                            echo $this->Metronic->input('_type_of_card_id', array(
                                'placeholder' => $profile['Profile']['type_of_card_id'],
                                'type' => 'text',
                                'label' => __d('public','Rodzaj dokumentu tożsamości'),
                            ));

                            echo $this->Metronic->input('_card_id_number', array(
                                'placeholder' => $profile['Profile']['card_id_number'],
                                'label' => __d('public','Numer i seria dowodu tożsamości')
                            ));

                            echo $this->Metronic->input('_bank_name', array(
                                'placeholder' => $profile['Profile']['bank_name'],
                                'label' => 'Nazwa banku'
                            ));

                            echo $this->Metronic->input('_account_number', array(
                                'placeholder' => $profile['Profile']['account_number'],
                                'label' => __d('public','Numer konta')
                            ));
                            ?>
                        </div>

                        <div class="tab-pane margin-top-20" id="change_tax">
                            <?php
                            echo $this->Metronic->input('_nip', array(
                                'placeholder' => $profile['Profile']['nip'],
                                'label' => __d('public','NIP')
                            ));

                            echo $this->Metronic->input('_revenue', array(
                                'placeholder' => $profile['Profile']['revenue'],
                                'label' => __d('public','Urząd skarbowy')
                            ));

                            echo $this->Metronic->input('_place_of_work', array(
                                'placeholder' => $profile['Profile']['place_of_work'],
                                'label' => __d('public','Miejsce pracy')
                            ));


                            echo $this->Metronic->input('_nfz', array(
                                'placeholder' => $profile['Profile']['nfz'],
                                'label' => __d('public','Oddział NFZ')
                            ));

                            $right_to_pension = array(
                                'label' => __d('public','Prawo do renty / emerytury'),
                                'type' => 'checkbox'
                            );
                            if ($profile['Profile']['right_to_pension'])
                            {
                                $right_to_pension['checked'] = 'checked';
                            }
                            echo $this->Form->input('_right_to_pension', $right_to_pension);

                            $unemployed = array(
                                'label' => __d('public','Bezrobotny / student'),
                                'type' => 'checkbox'
                            );
                            if ($profile['Profile']['unemployed'])
                            {
                                $unemployed['checked'] = 'checked';
                            }
                            echo $this->Form->input('_unemployed', $unemployed);

                            $disabled = array(
                                'label' => __d('public','Orzeczenie o niepełnosprawności'),
                                'type' => 'checkbox'
                            );
                            if ($profile['Profile']['disabled'])
                            {
                                $disabled['checked'] = 'checked';
                            }
                            echo $this->Form->input('_disabled', $disabled);
                            ?>
                        </div>
                        <div class="tab-pane margin-top-20 " id="change_address">
                            <?php
                            echo $this->Metronic->input('_work_phone', array(
                                'placeholder' => $profile['Profile']['work_phone'],
                                'label' => __d('public','Numer telefonu służbowy')
                            ));

                            echo $this->Metronic->input('_private_phone', array(
                                'placeholder' => $profile['Profile']['private_phone'],
                                'label' => __d('public','Numer telefonu prywatny')
                            ));

                            echo $this->Metronic->input('_friend_phone', array(
                                'placeholder' => $profile['Profile']['friend_phone'],
                                'label' => __d('public','Numer osoby bliskiej')
                            ));

                            echo $this->Metronic->input('_private_email', array(
                                'placeholder' => $profile['Profile']['private_email'],
                                'label' => __d('public','Adres email prywatny')
                            ));
                            ?>

                            <div class="margin-top-20">
                                <blockquote>
                                    <h4><?php echo __d('public', 'Adres zameldowania') ?>:</h4>
                                </blockquote>
                                <?php
                                echo $this->Metronic->input('_reg_street', array(
                                    'placeholder' => $profile['Profile']['reg_street'],
                                    'label' => __d('public','Ulica')
                                ));

                                echo $this->Metronic->input('_reg_house_number', array(
                                    'placeholder' => $profile['Profile']['reg_house_number'],
                                    'label' => __d('public','Nr domu')
                                ));

                                echo $this->Metronic->input('_reg_flat_number', array(
                                    'placeholder' => $profile['Profile']['reg_flat_number'],
                                    'label' => __d('public','Nr lokalu')
                                ));

                                echo $this->Metronic->input('_reg_postcode', array(
                                    'placeholder' => $profile['Profile']['reg_postcode'],
                                    'label' => __d('public','Kod pocztowy')
                                ));

                                echo $this->Metronic->input('_reg_city', array(
                                    'placeholder' => $profile['Profile']['reg_city'],
                                    'label' => __d('public','Miejscowość')
                                ));

                                echo $this->Metronic->input('_reg_community', array(
                                    'placeholder' => $profile['Profile']['reg_community'],
                                    'label' => __d('public','Gmina')
                                ));

                                echo $this->Metronic->input('_reg_district', array(
                                    'placeholder' => $profile['Profile']['reg_district'],
                                    'label' => __d('public','Powiat')
                                ));

                                echo $this->Metronic->input('_reg_province', array(
                                    'placeholder' => $profile['Profile']['reg_province'],
                                    'label' => __d('public','Województwo')
                                ));

                                echo $this->Form->input('_reg_country_id', array(
                                    'label' => __d('public','Państwo'),
                                    'type' => 'select',
                                    'options' => $countries,
                                    'value'=>'',
                                    'div' => 'form-group',
                                    'class' => 'form-control'
                                ));
                                ?>
                            </div>

                            <div class="margin-top-20" <?php
                            if ($profile['Profile']['reg_street'] != $profile['Profile']['street'] ||
                                    $profile['Profile']['reg_house_number'] != $profile['Profile']['house_number'] ||
                                    $profile['Profile']['reg_flat_number'] != $profile['Profile']['flat_number'] ||
                                    $profile['Profile']['reg_postcode'] != $profile['Profile']['postcode'] ||
                                    $profile['Profile']['reg_city'] != $profile['Profile']['city'] ||
                                    $profile['Profile']['reg_community'] != $profile['Profile']['community'] ||
                                    $profile['Profile']['reg_district'] != $profile['Profile']['district'] ||
                                    $profile['Profile']['reg_province'] != $profile['Profile']['province']
                            )
                            {
                                echo 'ng-init="different_address = 1"';
                                $different_address['ng-checked'] = 'true';
                            }
                            ?> >
                                     <?php
                                     $different_address['type'] = 'checkbox';
                                     $different_address['label'] = __d('public','Adres zamieszkania inny niż adres zameldowania');
                                     $different_address['ng-model'] = 'different_address';

                                     echo $this->Form->input('different_address', $different_address);
                                     ?>

                            </div>

                            <div class="margin-top-20" ng-show="different_address">
                                <blockquote>
                                    <h4><?php echo __d('public', 'Adres zamieszkania') ?></h4>
                                </blockquote>
                                <?php
                                echo $this->Metronic->input('_street', array(
                                    'placeholder' => $profile['Profile']['street'],
                                    'label' => __d('public','Ulica')
                                ));

                                echo $this->Metronic->input('_house_number', array(
                                    'placeholder' => $profile['Profile']['house_number'],
                                    'label' => __d('public','Nr domu')
                                ));

                                echo $this->Metronic->input('_flat_number', array(
                                    'placeholder' => $profile['Profile']['flat_number'],
                                    'label' => __d('public','Nr lokalu')
                                ));

                                echo $this->Metronic->input('_postcode', array(
                                    'placeholder' => $profile['Profile']['postcode'],
                                    'label' => __d('public','Kod pocztowy')
                                ));

                                echo $this->Metronic->input('_city', array(
                                    'placeholder' => $profile['Profile']['city'],
                                    'label' => __d('public','Miejscowość')
                                ));

                                echo $this->Metronic->input('_community', array(
                                    'placeholder' => $profile['Profile']['community'],
                                    'label' => __d('public','Gmina')
                                ));

                                echo $this->Metronic->input('_district', array(
                                    'placeholder' => $profile['Profile']['district'],
                                    'label' => __d('public','Powiat')
                                ));

                                echo $this->Metronic->input('_province', array(
                                    'placeholder' => $profile['Profile']['province'],
                                    'label' => __d('public','Województwo')
                                ));

//                                echo $this->Form->input('_country_id', array(
//                                    'label' => 'Państwo',
//                                    'type' => 'select',
//                                    'options' => $countries,
//                                    'div' => 'form-group',
//                                    'class' => 'form-control'
//                                ));
                                ?>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    <button class="btn blue-madison" type="submit"><?php echo __d('public', 'Potwierdź') ?></button>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <?php echo !isset($this->params['named']['user']) ? $this->element('Profile/profile') : ''; ?>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN PORTLET -->
                        <?php echo $this->Session->flash('updatedProfile'); ?>
                        <?php if($tmp_profile && !isset($this->params['named']['user'])): ?>
                            <div class="note note-info">
                                <h4 class="block"><?php echo __d('public', 'Informacja') ?>:</h4>
                                <p>
                                    <?php echo __d('public', 'Wysłane przez Ciebie zmiany profilu czekają na zatwierdzenie. Proszę o cierpliwość.') ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <div class="portlet light">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public', 'Dane profilu') ?></span>
                                </div>

                            </div>
                            <?php if(isset($this->params['named']['user'])): ?>
                                <div class="clearfix">
                                    <?php echo $this->Html->link(
                                       __d('public', 'Lista pracowników'),
                                        array('controller' => 'profiles', 'action' => 'index'),
                                        array('class' => 'btn btn-sm yellow margin-bottom pull-right ml')
                                    );?>
                                    <?php echo $this->Html->link(
                                        __d('public','Przejdź do edycji'), array('controller' => 'profiles', 'action' => 'edit_hr', $profile['Profile']['id']),
                                        array('class' => 'btn btn-sm blue margin-bottom pull-right ml')
                                    );?>
                                    <?php echo $this->Html->link(
                                        __d('public','Przejdź do zatrudnienia'), array('controller' => 'vacations', 'action' => 'index', 'user' => $profile['Profile']['user_id']),
                                        array('class' => 'btn btn-sm green-haze margin-bottom pull-right')
                                    );?>                              
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
                                                                <?php echo __d('public', 'Imię i nazwisko') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['firstname'] . ' ' . $profile['Profile']['surname']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Data urodzenia') ?>:
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($profile['Profile']['date_of_birth'])
                                                                {
                                                                    echo date('Y-m-d', strtotime($profile['Profile']['date_of_birth']));
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Miejsce urodzenia') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['place_of_birth']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Imiona rodziców') ?>:
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($profile['Profile']['father_name'] && $profile['Profile']['mother_name'])
                                                                {
                                                                    echo $profile['Profile']['father_name'] . ', ' . $profile['Profile']['mother_name'];
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Nazwisko rodowe') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['family_surname']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'PESEL') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['pesel']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Wykształcenie') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['education']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Rodzaj dowodu tożsamości') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['type_of_card_id']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Seria i numer dowodu tożsamości') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['card_id_number']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Nazwa banku') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['bank_name']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Numer konta') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['account_number']; ?>
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
                                                                <?php echo $profile['Profile']['nip']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Urząd skarbowy') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['revenue']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Miejsce pracy') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['place_of_work']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Etat') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $uch['UserContractHistory']['state']; ?>
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
                                                        <?php if(!isset($this->params['named']['user'])): ?>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Wynagrodzenie') ?>:
                                                            </td>
                                                            <td>
                                                                <?php if(isset($uch['UserContractHistory']['id'])): ?>
                                                                    <span show-salary data-netto="0"  data-id="<?php echo $uch['UserContractHistory']['id'];  ?>"></span>
                                                                <?php endif; ?>
                                                            </td>
                                                 
                                                    </tr>
                                                    <?php endif; ?>
                                                    <tr>
                                                        <td class="col-md-6">
                                                            <?php echo __d('public', 'Okres zatrudnienia') ?>:
                                                        </td>
                                                        <td>
                                                            <?php echo $uch['UserContractHistory']['employment_start'].' - '.$uch['UserContractHistory']['employment_end']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-6">
                                                            <?php echo __d('public', 'Ilość urlopu rocznie') ?>:
                                                        </td>
                                                        <td>
                                                            <?php echo $uch['UserContractHistory']['vacation_days']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-6">
                                                            <?php echo __d('public', 'Prawo do renty / emerytury') ?>:
                                                        </td>
                                                        <td>
                                                            <?php echo $profile['Profile']['right_to_pension'] ? 'Tak' : 'Nie'; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-6">
                                                            <?php echo __d('public', 'Bezrobotny / student') ?>:
                                                        </td>
                                                        <td>
                                                            <?php echo $profile['Profile']['unemployed'] ? 'Tak' : 'Nie'; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-6">
                                                            <?php echo __d('public', 'Oddział NFZ') ?>:
                                                        </td>
                                                        <td>
                                                            <?php echo $profile['Profile']['nfz']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-6">
                                                            <?php echo __d('public', 'Orzeczenie o niepełnosprawności') ?>:
                                                        </td>
                                                        <td>
                                                            <?php echo $profile['Profile']['disabled'] ? 'Tak' : 'Nie'; ?>
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
                                                                <?php echo __d('public', 'Numer telefonu służbowy') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['work_phone']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Numer telefonu prywatny') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['private_phone']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Numer osoby bliskiej') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['friend_phone']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Adres email służbowy') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['User']['email']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Adres email prywatny') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['private_email']; ?>
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
                                                                <?php echo __d('public', 'Ulica') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['reg_street']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Nr domu') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['reg_house_number']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Nr lokalu') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['reg_flat_number']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Kod pocztowy') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['reg_postcode']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Miejscowość') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['reg_city']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Gmina') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['reg_community']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Powiat') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['reg_district']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Województwo') ?>:
                                                            </td>
                                                            <td>
                                                                <?php echo $profile['Profile']['reg_province']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <?php echo __d('public', 'Państwo') ?>:
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if (isset($countries[$profile['Profile']['reg_country_id']]))
                                                                {
                                                                    echo $countries[$profile['Profile']['reg_country_id']];
                                                                }
                                                                ?>
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
    <?php echo $profile['Profile']['street']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-6">
                                                                    <?php echo __d('public', 'Nr domu') ?>:
                                                                </td>
                                                                <td>
    <?php echo $profile['Profile']['house_number']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-6">
                                                                    <?php echo __d('public', 'Nr lokalu') ?>:
                                                                </td>
                                                                <td>
    <?php echo $profile['Profile']['flat_number']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-6">
                                                                    <?php echo __d('public', 'Kod pocztowy') ?>:
                                                                </td>
                                                                <td>
    <?php echo $profile['Profile']['postcode']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-6">
                                                                    <?php echo __d('public', 'Miejscowość') ?>:
                                                                </td>
                                                                <td>
    <?php echo $profile['Profile']['city']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-6">
                                                                    <?php echo __d('public', 'Gmina') ?>:
                                                                </td>
                                                                <td>
    <?php echo $profile['Profile']['community']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-6">
                                                                    <?php echo __d('public', 'Powiat') ?>:
                                                                </td>
                                                                <td>
    <?php echo $profile['Profile']['district']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-6">
                                                                    <?php echo __d('public', 'Województwo') ?>:
                                                                </td>
                                                                <td>
    <?php echo $profile['Profile']['province']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-6">
                                                                    <?php echo __d('public', 'Państwo') ?>:
                                                                </td>
                                                                <td>
    <?php 
        if(isset($countries[$profile['Profile']['country_id']])) {
            echo $countries[$profile['Profile']['country_id']]; 
        }
    ?>
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

                                <?php if(!isset($this->params['named']['user'])): ?>
                                    <div class="alert alert-block alert-info fade in margin-top-20">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <h4 class="alert-heading"><?php echo __d('public', 'Informacja') ?>:</h4>
                                        <p>
                                            <?php echo __d('public', 'Zmiany powyższych danych są możliwe poprzez zgłoszenie ich do sekretariatu') ?>.
                                        </p>
                                        <p>
                                            <a href="#change_profile_modal" data-toggle="modal" class="btn btn-circle red-sunglo btn-sm"><?php echo __d('public', 'Wyślij powiadomienie') ?></a>
                                        </p>
                                    </div>
                                <?php endif; ?>
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