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
                                    <h4><?php echo __d('public', 'Wklej link') ?></h4>
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

<div class="profile-sidebar">
    <!-- PORTLET MAIN -->
    <div class="portlet light profile-sidebar-portlet">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            <?php 
            $avatarOptions = array('width'=>'135','height'=>'135','class' => 'img-responsive');
            echo $this->element('default/avatar', compact('userProfile','avatarOptions'));
            ?>
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <?php echo $profile['Profile']['firstname'] . ' ' . $profile['Profile']['surname']; ?>
            </div>
            <div class="profile-usertitle-job">
                <?php echo $profile['Profile']['position']; ?>
            </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <div class="profile-userbuttons">
            <button class="btn btn-circle green-haze btn-sm" href="#photo_profile" data-toggle="modal" type="button"><?php echo __d('public','Zmień zdjęcie profilowe') ?></button>
        </div>
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li <?php if (!empty($this->params['action']) && $this->params['action'] == 'metrics') echo 'class="active"'; ?>>
                    <?php 
                        echo $this->Html->link(
                            '<i class="icon-user"></i> '.__d('public','Metryka'), 
                            array('controller' => 'profiles', 'action' => 'metrics'), 
                            array('escape' => false)
                        ); 
                    ?>
                </li>
                <li <?php if (!empty($this->params['controller']) && $this->params['controller'] == 'vacations') echo 'class="active"'; ?>>
                    <?php 
                        echo $this->Html->link(
                            '<i class="icon-note"></i> '.__d('public','Zatrudnienie'), 
                            array('controller' => 'vacations', 'action' => 'index'), 
                            array('escape' => false)
                        ); 
                    ?>
                </li>
                <li <?php if (!empty($this->params['action']) && $this->params['action'] == 'personal_aim') echo 'class="active"'; ?>>
                    <?php 
                        echo $this->Html->link(
                            '<i class="icon-puzzle"></i> '.__d('public','Cel osobisty'), 
                            array('controller' => 'profiles', 'action' => 'personal_aim'), 
                            array('escape' => false)
                        ); 
                    ?>
                </li>
                <li <?php if (!empty($this->params['controller']) && $this->params['controller'] == 'pm') echo 'class="active"'; ?>>
                    <?php 
                        $action = array('controller' => 'pm', 'action' => 'index');
                        isset($this->params['named']['user']) ? $action['user'] = $profile['Profile']['user_id'] : '';
                    ?>
                    <?php echo $this->Html->link('<i class="icon-calendar"></i> '.__d('public','Mój PM'), $action, array('escape' => false)); ?>
                    
                    <span class="btn fright pm_btn" ng-click="showDetails = ! showDetails"><i class="icon-settings pm_settings"></i> </span>
                </li>
            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <!-- END PORTLET MAIN -->
	
	
    <!-- PORTLET PM -->
	<div class="pm_portlet" ng-show="showDetails">
		<?php echo $this->Metronic->portlet(__d('public', 'Pm'), 1); ?>
			<?php if($_SESSION['Auth']['User']['pm_user']): ?>
				<div class="text_center">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i>
						<span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public','Jesteś zalogowany jako: '); ?><br/> </span> 
							<?php echo $_SESSION['Auth']['User']['pm_user'];?>
					</div>

					<a class="btn btn-circle yellow-gold center" href="/pm/logout" title="<?php echo __d('public','Wyloguj');?>"><?php echo __d('public','Wyloguj');?></a>
				</div>
			<?php else: ?>
				<div class="text_center">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i>
						<span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public','Nie jesteś zalogowany '); ?><br/> </span>
						<br/>
						<?php echo __d('public','Aby w pełni korzystać z systemu zaloguj się do ') ?>
						<?php
							echo $this->Html->link(
								__d('public','PM'), 
								array(
									'controller' => 'pm',
									'action' => 'index'
								), array('escape' => false) 
							);
						?>.
					</div>

				</div>
			<?php endif; ?>
		<?php echo $this->Metronic->portletEnd(); ?>		
	</div>
    <!-- END PORTLET PM -->
	
    <!-- PORTLET MAIN -->
    <div class="portlet light">
        <div class="portlet-title">
            <h4 class="profile-desc-title font-blue-madison pull-left"><?php echo __d('public','Zmiana hasła') ?></h4>
            <div class="tools">
                <a href="javascript:;" class="expand"></a>
            </div>
        </div>
        <div class="portlet-body display-hide">
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
    <!-- END PORTLET MAIN -->
	

	
</div>