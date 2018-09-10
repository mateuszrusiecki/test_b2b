

<?php $this->Html->addCrumb(__d('public','Mój profil'), array('controller' => 'profiles', 'action' => 'metrics')); ?>
<div ng-controller="ProfileController">

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
                        <div class="portlet light">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public', 'Zatrudnienie'); ?> 
                                    </span>

                                </div>
                            </div>
                            <?php if(isset($this->params['named']['user'])): ?>
                                <div class="clearfix">                                
                                    <?php echo $this->Html->link(
                                        __d('public','Lista pracowników'),
                                        array('controller' => 'profiles', 'action' => 'index'),
                                        array('class' => 'btn btn-sm yellow margin-bottom pull-right ml')
                                    );?>          
                                    <?php echo $this->Html->link(
                                        __d('public','Przejdź do edycji'), array('controller' => 'profiles', 'action' => 'edit_hr', $profile['Profile']['id']),
                                        array('class' => 'btn btn-sm blue margin-bottom pull-right ml')
                                    );?>
                                    <?php echo $this->Html->link(
                                        __d('public','Przejdź do metryki'), array('controller' => 'profiles', 'action' => 'metrics', 'user' => $profile['Profile']['user_id']),
                                        array('class' => 'btn btn-sm green-haze margin-bottom pull-right')
                                    );?>
                                </div>
                            <?php endif; ?>
                            <div class="portlet-body">
                                
                                <div class="tabbable-custom nav-justified">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active ">
                                            <a href="#arrangement" data-toggle="tab"><?php echo __d('public', 'Umowa'); ?></a>
                                        </li>
                                        <li class="">
                                            <a href="#contract_history" data-toggle="tab"><?php echo __d('public', 'Historia zatrudnienia'); ?></a>
                                        </li>
                                        <li class="">
                                            <a href="#worktime" data-toggle="tab"><?php echo __d('public', 'Czas pracy'); ?></a>
                                        </li>
                                        <li class="">
                                            <a href="#vacations" data-toggle="tab"><?php echo __d('public', 'Urlopy'); ?></a>
                                        </li>
                                        <li class="">
                                            <a href="#proposal" data-toggle="tab"><?php echo __d('public', 'Złóż wniosek urlopowy'); ?></a>
                                        </li>
                                    </ul>
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="arrangement">
                                            <div class="table-scrollable table-scrollable-borderless">
                                                <?php echo $this->element('Vacations/arrangement'); ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane " id="contract_history">
											 <?php echo $this->element('Vacations/contract_history'); ?>
                                        </div>
                                        <div class="tab-pane " id="worktime">
											 <?php echo $this->element('work_time'); ?>
                                        </div>
                                        <div class="tab-pane" id="vacations">
                                                <?php echo $this->element('Vacations/list', array('profile_id' => $profile_id, 'calendar' => $calendar_id,'user_contract'=>$user_contract)); ?>

                                        </div>
                                        <div class="tab-pane" id="proposal">
                                            <div class="table-scrollable table-scrollable-borderless">
												<?php echo $this->element('Vacations/add'); ?>
                                            </div>


                                        </div>
                                        <div>


                                        </div>
                                    </div>
                                </div>
                                <!--END TABS-->

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


