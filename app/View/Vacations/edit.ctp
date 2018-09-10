
	
<?php $this->Html->addCrumb(__d('public','Mój profil'), array('controller' => 'profiles', 'action' => 'metrics')); ?>
<div ng-controller="ProfileController">

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
                        <?php echo $this->Session->flash('updatedProfile'); ?>
                        
                        <div class="portlet light">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public','Zatrudnienie');?>
									</span>
										
                                </div>
                            </div>
                            <div class="portlet-body">
								
								<div class="tabbable-custom nav-justified">
									<ul class="nav nav-tabs nav-justified">
										<li class="">
											<a href="#arrangement" data-toggle="tab"><?php echo __d('public','Umowa');?></a>
										</li>
                                        <li class="">
                                            <a href="#contract_history" data-toggle="tab"><?php echo __d('public', 'Historia zatrudnienia'); ?></a>
                                        </li>
										<li class=" ">
											<a href="#worktime" data-toggle="tab"><?php echo __d('public','Czas pracy');?></a>
										</li>
										<li class=" ">
											<a href="#vacations" data-toggle="tab"><?php echo __d('public','Urlopy');?></a>
										</li>
										<li class="active">
											<a href="#proposal" data-toggle="tab"><?php echo __d('public','Edytuj wniosek urlopowy');?></a>
										</li>
									</ul>
									<!--BEGIN TABS-->
									<div class="tab-content">
										<div class="tab-pane" id="arrangement">
											<div class="table-scrollable table-scrollable-borderless">
												<?php echo $this->element('Vacations/arrangement'); ?>
											</div>
										</div>
                                        <div class="tab-pane " id="contract_history">
											 <?php echo $this->element('Vacations/contract_history'); ?>
                                        </div>
										<div class="tab-pane" id="worktime">
											<div class="table-scrollable table-scrollable-borderless">
												
											 <?php echo $this->element('work_time'); ?>
											</div>
										</div>
										<div class="tab-pane" id="vacations">
											<div class="table-scrollable table-scrollable-borderless">
												<?php echo $this->element('Vacations/list', array('no_print' => 1)); ?>
											</div>
										</div>
										 <div class="tab-pane active" id="proposal">
											<div class="table-scrollable table-scrollable-borderless">
												<?php echo $this->element('Vacations/edit'); ?>
											</div>


										</div>
										<div>


										</div>
									</div>
									<!--END TABS-->
								</div>
									

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
