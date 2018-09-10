<div class="portlet light">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo $title; ?></span>
        </div>
    </div>
    <div class="clearfix">
        <?php
        echo $this->Html->link(
                __d('public','Lista pracowników'), array('controller' => 'profiles', 'action' => 'index'), array('class' => 'btn btn-sm yellow margin-bottom pull-right ml')
        );
        ?>
        <?php
        echo $this->Html->link(
                __d('public','Przejdź do metryki'), array('controller' => 'profiles', 'action' => 'metrics',
            'user' => $profile['Profile']['user_id']), array('class' => 'btn btn-sm blue margin-bottom pull-right ml')
        );
        ?>
        <?php
        echo $this->Html->link(
                __d('public','Przejdź do zatrudnienia'), array('controller' => 'vacations', 'action' => 'index',
            'user' => $profile['Profile']['user_id']), array('class' => 'btn btn-sm green-haze margin-bottom pull-right')
        );
        ?>   
    </div>
    <div class="portlet-body">       
        <?php echo $this->Form->create('Profile', array('controller' => 'profiles', 'action' => 'edit_hr', 'url' => $formUrlParams)); ?>

        <!--TABS HEADERS-->
        <div class="tabbable-custom nav-justified">
            <ul class="nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#personal" data-toggle="tab"><?php echo __d('public', 'Dane personalne') ?> </a>
                </li>
                <li>
                    <a href="#tax" data-toggle="tab"><?php echo __d('public', 'Dane podatkowe i ubezpieczeniowe') ?> </a>
                </li>
                <li>
                    <a href="#address" data-toggle="tab"><?php echo __d('public', 'Dane teleadresowe') ?> </a>
                </li>
                <li>
                    <a href="#employment" data-toggle="tab"><?php echo __d('public', 'Uprawnienia') ?> </a>
                </li>
            </ul>

            <!--BEGIN TABS-->
            <div class="tab-content">
                <div class="tab-pane active" id="personal">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <?php
                            echo $this->Metronic->input('firstname', array(
                                'placeholder' => $profile['Profile']['firstname'],
                                'value' => $profile['Profile']['firstname'],
                                'label' => __d('public','Imię')
                            ));

                            echo $this->Metronic->input('surname', array(
                                'placeholder' => $profile['Profile']['surname'],
                                'value' => $profile['Profile']['surname'],
                                'label' => __d('public','Nazwisko')
                            ));

                            echo $this->Metronic->input('User.email', array(
                                'placeholder' => $profile['User']['email'],
                                'value' => $profile['User']['email'],
                                'label' => __d('public','Email służbowy')
                            ));

                            echo $this->Metronic->input('date_of_birth', array(
                                'placeholder' => $profile['Profile']['date_of_birth'],
                                'value' => $profile['Profile']['date_of_birth'],
                                'type' => 'text',
                                //'ng-model' => '_date_of_birth',
                                'class' => 'form-control form-control-inline date-picker',
                                'label' => __d('public','Data urodzenia')
                            ));

                            echo $this->Metronic->input('place_of_birth', array(
                                'placeholder' => $profile['Profile']['place_of_birth'],
                                'value' => $profile['Profile']['place_of_birth'],
                                'label' => __d('public','Miejsce urodzenia')
                            ));

                            echo $this->Metronic->input('father_name', array(
                                'placeholder' => $profile['Profile']['father_name'],
                                'value' => $profile['Profile']['father_name'],
                                'label' => __d('public','Imię ojca')
                            ));
                            echo $this->Metronic->input('mother_name', array(
                                'placeholder' => $profile['Profile']['mother_name'],
                                'value' => $profile['Profile']['mother_name'],
                                'label' => __d('public','Imię matki')
                            ));

                            echo $this->Metronic->input('family_surname', array(
                                'placeholder' => $profile['Profile']['family_surname'],
                                'value' => $profile['Profile']['family_surname'],
                                'label' => __d('public','Nazwisko rodowe')
                            ));
                            ?>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <?php
                            echo $this->Metronic->input('pesel', array(
                                'placeholder' => $profile['Profile']['pesel'],
                                'value' => $profile['Profile']['pesel'],
                                'label' => __d('public','PESEL')
                            ));

                            echo $this->Metronic->input('education', array(
                                'placeholder' => $profile['Profile']['education'],
                                'value' => $profile['Profile']['education'],
                                'label' => __d('public','Wykształcenie')
                            ));

                            echo $this->Metronic->input('type_of_card_id', array(
                                'placeholder' => $profile['Profile']['type_of_card_id'],
                                'value' => $profile['Profile']['type_of_card_id'],
                                'type' => 'text',
                                'label' => __d('public','Rodzaj dokumentu tożsamości'),
                            ));

                            echo $this->Metronic->input('card_id_number', array(
                                'placeholder' => $profile['Profile']['card_id_number'],
                                'value' => $profile['Profile']['card_id_number'],
                                'label' => __d('public','Numer i seria dowodu tożsamości')
                            ));

                            echo $this->Metronic->input('bank_name', array(
                                'placeholder' => $profile['Profile']['bank_name'],
                                'value' => $profile['Profile']['bank_name'],
                                'label' => __d('public','Nazwa banku')
                            ));

                            echo $this->Metronic->input('account_number', array(
                                'placeholder' => $profile['Profile']['account_number'],
                                'value' => $profile['Profile']['account_number'],
                                'label' => __d('public','Numer konta')
                            ));

                            echo $this->Metronic->input('place_of_work', array(
                                'placeholder' => $profile['Profile']['place_of_work'],
                                'value' => $profile['Profile']['place_of_work'],
                                'label' => __d('public','Miejsce pracy')
                            ));
                            ?>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tax">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <?php
                            echo $this->Metronic->input('nip', array(
                                'placeholder' => $profile['Profile']['nip'],
                                'value' => $profile['Profile']['nip'],
                                'label' => __d('public','NIP')
                            ));

                            echo $this->Metronic->input('revenue', array(
                                'placeholder' => $profile['Profile']['revenue'],
                                'value' => $profile['Profile']['revenue'],
                                'label' => __d('public','Urząd skarbowy')
                            ));
                            ?>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <?php
                            echo $this->Metronic->input('nfz', array(
                                'placeholder' => $profile['Profile']['nfz'],
                                'value' => $profile['Profile']['nfz'],
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
                            echo $this->Form->input('right_to_pension', $right_to_pension);

                            $unemployed = array(
                                'label' => __d('public','Bezrobotny / student'),
                                'type' => 'checkbox'
                            );
                            if ($profile['Profile']['unemployed'])
                            {
                                $unemployed['checked'] = 'checked';
                            }
                            echo $this->Form->input('unemployed', $unemployed);

                            $disabled = array(
                                'label' => __d('public','Orzeczenie o niepełnosprawności'),
                                'type' => 'checkbox'
                            );
                            if ($profile['Profile']['disabled'])
                            {
                                $disabled['checked'] = 'checked';
                            }
                            echo $this->Form->input('disabled', $disabled);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="address">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <?php
                            echo $this->Metronic->input('work_phone', array(
                                'placeholder' => $profile['Profile']['work_phone'],
                                'value' => $profile['Profile']['work_phone'],
                                'label' => __d('public','Numer telefonu służbowy')
                            ));

                            echo $this->Metronic->input('private_phone', array(
                                'placeholder' => $profile['Profile']['private_phone'],
                                'value' => $profile['Profile']['private_phone'],
                                'label' => __d('public','Numer telefonu prywatny')
                            ));
                            ?>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <?php
                            echo $this->Metronic->input('friend_phone', array(
                                'placeholder' => $profile['Profile']['friend_phone'],
                                'value' => $profile['Profile']['friend_phone'],
                                'label' => __d('public','Numer osoby bliskiej')
                            ));

                            echo $this->Metronic->input('private_email', array(
                                'placeholder' => $profile['Profile']['private_email'],
                                'value' => $profile['Profile']['private_email'],
                                'label' => __d('public','Adres email prywatny')
                            ));
                            ?>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="margin-top-20">
                                <blockquote>
                                    <h4><?php echo __d('public', 'Adres zameldowania') ?>:</h4>
                                </blockquote>
                                <?php
                                echo $this->Metronic->input('reg_street', array(
                                    'placeholder' => $profile['Profile']['reg_street'],
                                    'label' => __d('public','Ulica')
                                ));

                                echo $this->Metronic->input('reg_house_number', array(
                                    'placeholder' => $profile['Profile']['reg_house_number'],
                                    'label' => __d('public','Nr domu')
                                ));

                                echo $this->Metronic->input('reg_flat_number', array(
                                    'placeholder' => $profile['Profile']['reg_flat_number'],
                                    'label' => __d('public','Nr lokalu')
                                ));

                                echo $this->Metronic->input('reg_postcode', array(
                                    'placeholder' => $profile['Profile']['reg_postcode'],
                                    'label' => __d('public','Kod pocztowy')
                                ));

                                echo $this->Metronic->input('reg_city', array(
                                    'placeholder' => $profile['Profile']['reg_city'],
                                    'label' => __d('public','Miejscowość')
                                ));

                                echo $this->Metronic->input('reg_community', array(
                                    'placeholder' => $profile['Profile']['reg_community'],
                                    'label' => __d('public','Gmina')
                                ));

                                echo $this->Metronic->input('reg_district', array(
                                    'placeholder' => $profile['Profile']['reg_district'],
                                    'label' => __d('public','Powiat')
                                ));

                                echo $this->Metronic->input('reg_province', array(
                                    'placeholder' => $profile['Profile']['reg_province'],
                                    'label' => __d('public','Województwo')
                                ));

                                echo $this->Form->input('reg_country_id', array(
                                    'label' => __d('public','Państwo'),
                                    'type' => 'select',
                                    'default' => 'PL',
                                    'options' => $countries,
                                    'div' => 'form-group',
                                    'class' => 'form-control'
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">

                            <div class="margin-top-20" ng-show="different_address">
                                <blockquote>
                                    <h4><?php echo __d('public', 'Adres zamieszkania') ?></h4>
                                </blockquote>
                                <?php
                                echo $this->Metronic->input('street', array(
                                    'placeholder' => $profile['Profile']['street'],
                                    'label' => __d('public','Ulica')
                                ));

                                echo $this->Metronic->input('house_number', array(
                                    'placeholder' => $profile['Profile']['house_number'],
                                    'label' => __d('public','Nr domu')
                                ));

                                echo $this->Metronic->input('flat_number', array(
                                    'placeholder' => $profile['Profile']['flat_number'],
                                    'label' => __d('public','Nr lokalu')
                                ));

                                echo $this->Metronic->input('postcode', array(
                                    'placeholder' => $profile['Profile']['postcode'],
                                    'label' => __d('public','Kod pocztowy')
                                ));

                                echo $this->Metronic->input('city', array(
                                    'placeholder' => $profile['Profile']['city'],
                                    'value' => $profile['Profile']['city'],
                                    'label' => __d('public','Miejscowość')
                                ));

                                echo $this->Metronic->input('community', array(
                                    'placeholder' => $profile['Profile']['community'],
                                    'label' => __d('public','Gmina')
                                ));

                                echo $this->Metronic->input('district', array(
                                    'placeholder' => $profile['Profile']['district'],
                                    'label' => __d('public','Powiat')
                                ));

                                echo $this->Metronic->input('province', array(
                                    'placeholder' => $profile['Profile']['province'],
                                    'label' => __d('public','Województwo')
                                ));

                                echo $this->Form->input('country_id', array(
                                    'label' => __d('public','Państwo'),
                                    'type' => 'select',
                                    'default' => 'PL',
                                    'options' => $countries,
                                    'div' => 'form-group',
                                    'class' => 'form-control'
                                ));

                                echo $this->Metronic->input('id', array(
                                    'placeholder' => $profile['Profile']['id'],
                                    'type' => 'hidden'
                                ));

                                echo $this->Metronic->input('user_id', array(
                                    'placeholder' => $profile['Profile']['user_id'],
                                    'type' => 'hidden'
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="employment">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo $this->Form->input('Group.Group.0', array(
                                'label' => __d('public','Grupa uprawnień'),
                                'type' => 'select',
                                'default' => __d('public','wybierz'),
                                'options' => $perm_groups,
                                'value' => $group_id,
                                'div' => 'form-group',
                                'class' => 'form-control',
                            ));

                            echo $this->Form->input('Section.Section.0', array(
                                'label' => __d('public','Dział'),
                                'type' => 'select',
                                'default' => __d('public','wybierz'),
                                'options' => $sections,
                                'value' => $section_id,
                                'div' => 'form-group',
                                'class' => 'form-control'
                            ));
                            
                            $supervisor = false;
                            if(!empty($profile['Section'][0]['supervisor']) && $profile['User']['id'] == $profile['Section'][0]['supervisor']){
                                $supervisor = true;
                            }
                            echo $this->Form->input('Section.supervisor_chceck', array(
                                'label' => __d('public','Kierownik działu'),
                                'type' => 'checkbox',
                                'div' => 'form-group',
                                'checked' => $supervisor,
                                'class' => 'form-control'
                            ));
                            ?>
                        </div>
                        <!--                        <div class="col-md-6 col-xs-12">
                        <?php
//                            echo $this->Metronic->input('hourly_rate', array(
//                                'placeholder' => $profile['Profile']['hourly_rate'],
//                                'value' => $profile['Profile']['hourly_rate'],
//                                'label' => 'Aktualna stawka godzinowa*'
//                            ));
                        ?>
                                                </div>-->
                        <!--						<div class="col-md-12">
                                                                                *Stawka roboczogodziny dla pracownika, wartość obliczana
                                                                                automatycznie na podstawie wynagrodzenia duże brutto, kosztów
                                                                                ogólnych i ilości pracowników
                                                                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">
            <?php
            echo $this->Form->submit(__d('public','Zapisz'), array('class' => 'btn blue-madison pull-right'));
            echo $this->Form->end();
            ?>
        </div>
    </div>       
</div>
