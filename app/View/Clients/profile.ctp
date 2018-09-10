<?php 
    $userProfile = $this->Session->read('Auth.User');
?>
<!-- MODAL -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="photo_profile" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public','Dodawanie zdjęcia profilowego') ?></h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable-custom nav-justified">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#photo_profile_file" data-toggle="tab">
                                        <?php echo __d('public','Wgraj zdjęcie z dysku') ?> </a>
                                </li>
                                <li > 
                                    <a href="#photo_profile_url" data-toggle="tab">
                                        <?php echo __d('public','Wklej link') ?> </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="photo_profile_file">
                                    <h4><?php echo __d('public','Dodaj zdjęcie z dysku') ?></h4>
                                    <?php
                                    $urlForm = array('action' => 'add_photo', 'controller' => 'users', 'plugin' => 'user');
                                    echo $this->Form->create('User', array('url' => $urlForm, 'type' => 'file'));
                                    echo $this->Form->input('avatar', array(
                                        'type' => 'file',
                                        'label' => false
                                    ));
                                    ?>
                                    <button type="submit" class="btn blue-madison pull-right"><?php echo __d('public','Dodaj') ?></button>
                                    <?php
                                    echo $this->Form->end();
                                    ?>
                                    <div class="clearfix"></div>

                                </div>
                                <div class="tab-pane" id="photo_profile_url">
                                    <h4>Wklej link</h4>
                                    <?php
                                    echo $this->Form->create('User', array('url' => $urlForm));
                                    echo $this->Metronic->input('avatar_url', array(
                                        'value'=> $userProfile['avatar_url']
                                            ), array(
                                        'label' => false
                                    ));
                                    ?>
                                    <button type="submit" class="btn blue-madison pull-right"><?php echo __d('public','Dodaj') ?></button>
                                    <?php
                                    echo $this->Form->end();
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default"><?php echo __d('public','Zamknij') ?></button>
                <!--<button type="submit" class="btn blue-madison">Dodaj</button>-->
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->

<div class="row">
    <!-- PORTLET MAIN -->
    <div class="col-md-4">
    <div class="portlet light profile-sidebar-portlet">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            <?php 
            $avatarOptions = array('width'=>'512','height'=>'512','class' => 'img-responsive');
            echo $this->element('default/avatar', compact('userProfile','avatarOptions'));
            ?>
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <?php echo $userProfile['name'] ?>
            </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <div class="profile-userbuttons">
            <button class="btn btn-circle green-haze btn-sm" href="#photo_profile" data-toggle="modal" type="button"><?php echo __d('public','Zmień zdjęcie profilowe') ?></button>
        </div>
        
    </div>
    </div>
    <!-- END PORTLET MAIN -->
	
	
  
	
    <!-- PORTLET MAIN -->
    <div class="col-md-4">
    <div class="portlet light">
        <div class="portlet-title">
            <h4 class="profile-desc-title font-blue-madison pull-left"><?php echo __d('public','Zmiana hasła') ?></h4>
            <div class="tools">
                <a href="javascript:;" class="expand"></a>
            </div>
        </div>
        <div class="portlet-body">
            <span class="profile-desc-text"><?php echo __d('public','Wprowadź dane poniżej, aby zmienić hasło') ?>.</span>
            <div class="margin-top-20">
                <?php
                echo $this->Form->create('User', array('url' => array('plugin' => 'user', 'controller' => 'users', 'action' => 'change_password')));

                echo $this->Metronic->input('old_password', array(
                    'placeholder' => __d('public','Stare hasło'),
                    'type' => 'password'
                        ), array(
                    'label' => false,
                    'icon' => 'icon-lock'
                ));
                echo $this->Metronic->input('new_password', array(
                    'placeholder' => __d('public','Nowe hasło'),
                    'type' => 'password'
                        ), array(
                    'label' => false,
                    'icon' => 'icon-lock'
                ));
                echo $this->Metronic->input('confirm_password', array(
                    'placeholder' => __d('public','Potwierdź nowe hasło'),
                    'type' => 'password'
                        ), array(
                    'label' => false,
                    'icon' => 'icon-lock'
                ));
                ?>
                <div class="profile-userbuttons">
                    <button type="submit" class="btn btn-circle red-sunglo btn-sm"><?php echo __d('public','Potwierdź') ?></button>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    </div>
    <!-- END PORTLET MAIN -->
	

	
</div>