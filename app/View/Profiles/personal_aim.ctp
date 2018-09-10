<?php $this->Html->addCrumb(__d('public','Cel osobisty'), array('controller' => 'profiles', 'action' => 'personal_aim')); ?>


<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <?php echo $this->element('Profile/profile'); ?>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PORTLET -->
                    <?php echo $this->Metronic->portlet(__d('public','Mój cel osobisty'), 1); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (empty($aim['PersonalAim']['name'])): ?>
                                <div class="note note-info">
                                    <h4 class="block"><?php echo __d('public', 'Informacja') ?></h4>
                                    <p>
                                        <?php echo __d('public', 'Dodaj swój cel osobisty, aby codziennie sukcesywnie się do niego przybliżać. Dzięki temu nawet ambitne cele stają się realne!') ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <?php
                            echo $this->Session->flash('aim');
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 text-center">
                            <?php if (empty($aim['PersonalAim']['photo_url']) && empty($aim['PersonalAim']['photo'])): ?>
                                <img src="holder.js/350x250/text:Brak zdjęcia." alt="">
                            <?php elseif (!empty($aim['PersonalAim']['photo'])): ?>
                                <img src="/files/personalaim/<?php echo $aim['PersonalAim']['photo']; ?>" alt="" class="img-responsive">
                            <?php elseif (!empty($aim['PersonalAim']['photo_url'])): ?>
                                <img src="<?php echo $aim['PersonalAim']['photo_url']; ?>" alt="" class="img-responsive">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-5">
                            <?php
                            echo $this->Form->create('PersonalAim', array('url' => 'personal_aim_update','type'=>'file'));

                            echo $this->Metronic->input('name', array(
                                'placeholder' => __d('public','Wpisz nazwę swojego celu'),
                                'value' => !empty($aim['PersonalAim']['name']) ? $aim['PersonalAim']['name'] : '',
                                'label' => 'Nazwa'
                            ));

                            echo $this->Metronic->input('start_date', array(
                                'placeholder' => __d('public','Podaj początek realizacji'),
                                'class' => 'form-control form-control-inline date-picker',
                                'value' => !empty($aim['PersonalAim']['start_date']) ? $aim['PersonalAim']['start_date'] : '',
                                'label' => 'Początek realizacji'
                            ));

                            echo $this->Metronic->input('end_date', array(
                                'placeholder' => __d('public','Podaj koniec realizacji'),
                                'class' => 'form-control form-control-inline date-picker',
                                'value' => !empty($aim['PersonalAim']['end_date']) ? $aim['PersonalAim']['end_date'] : '',
                                'label' => 'Koniec realizacji'
                            ));

                            echo $this->Form->input('user_id', array(
                                'type' => 'hidden',
                                'value' => $this->Session->read('Auth.User.id')
                            ));
                            ?>

                            <?php echo __d('public', 'Stopień realizacji') ?>: <span id="slider-snap-inc-amount"></span>
                            <div id="slider-snap-inc" class="slider bg-blue-madison"></div>

                            <?php
                            echo $this->Form->input('status', array(
                                'type' => 'hidden',
                                'id' => 'inputProgress'
                            ));
                            ?>

                            <?php echo $this->element('Profile/modal_photo', array('no_form' => true)); ?>
                            <div class="text-right margin-top-20">
                                <a class="btn grey" href="#photo" data-toggle="modal"><i class="fa fa-camera"></i> <?php echo __d('public', 'Dodaj zdjęcie') ?></a>
                                <button class="btn blue-madison" type="submit"><i class="fa fa-check"></i> <?php echo __d('public', 'Zapisz') ?></button>
                            </div>

                            <?php echo $this->Form->end(); ?>

                            <script>
                                jQuery(document).ready(function () {
                                    // snap inc
                                    $("#slider-snap-inc").slider({
                                        value: <?php echo!empty($aim['PersonalAim']['status']) ? $aim['PersonalAim']['status'] : '0'; ?>,
                                        min: 0,
                                        max: 100,
                                        step: 5,
                                        slide: function (event, ui) {
                                            $("#slider-snap-inc-amount").text(ui.value + "%");
                                            $("#inputProgress").val(ui.value);
                                        }
                                    });

                                    $("#slider-snap-inc-amount").text($("#slider-snap-inc").slider("value") + "%");
                                    $("#inputProgress").val($("#slider-snap-inc").slider("value"));
                                });
                            </script>
                        </div>
                    </div>
                    <?php echo $this->Metronic->portletEnd(); ?>
                    <!-- END PORTLET -->
                </div>
            </div>

        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<!-- END PAGE CONTENT-->