
        <a href="#sheduleRealizationDialog" data-toggle="modal" class="col-md-3 col-sm-6 col-xs-12 mb5" ng-click="getRealizationsPopupData(<?php echo $clientProject['ClientProject']['id'] ?>)">
            <div class="dashboard-stat green-haze">
                <div class="visual">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="details">

                    <div class="desc"><?php echo __d('public', 'HARMONOGRAM REALIZACJI'); ?></div>
                </div><i class="fa fa-chevron-circle-right"></i>

            </div>
        </a>

            <div aria-hidden="false" role="sheduleRealizationDialog" tabindex="-1" id="sheduleRealizationDialog" class="modal fade ng-cloak" my-modal>
                <div class="modal-dialog modal-small">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title"><?php echo __d('public', 'Harmonogram realizacji') ?></h4>
                        </div>

                        <div class="modal-body">
                            <div class="tile-body">
                            
                                <div class="portlet box green-jungle">
                                    <div class="portlet-title nowrap">
                                        <div class="caption">
                                            <i class="fa fa-anchor"></i>
                                            <?php echo __d('public', 'Kamień milowy'); ?>  
                                        </div>
                                        <div class="tools">
                                            <a title="" data-original-title="" href="" ng-class="{'expand':collapsed,'collapse':!collapsed}" class="expand_link collapse">
                                                <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">  
                                        <?php echo  __d('public', 'Początek umowy'); ?>
                                        <?php echo $clientProject['ClientProject']['start_project']; ?>
                                    </div>
                                </div>
                                <div ng-cloak  ng-repeat="(key, payment) in realizations_popup_data | deleted" ng-switch="payment.type">

                                    <div ng-switch-when="cycle">
                                        <div class="portlet box blue-madison">
                                            <div class="portlet-title nowrap">
                                                <div class="caption">
                                                    <i class="fa fa-refresh"></i><?php echo __d('public', 'Wydarzenie cykliczne'); ?>
                                                </div>
                                                <div class="tools">
                                                    <a title="" data-original-title="" href="" ng-class="{'expand':collapsed,'collapse':!collapsed}" class="expand_link collapse">
                                                        <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                                    </a>
                                                    <a class="remove" ng-click="payment.delete = true" href="javascript:;"> 
                                                        <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">  
                                                <?php echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Nazwa'), 'ng-model' => 'payment.name', 'type' => 'text','disabled'=>'disabled')); ?>
                                                <?php echo $this->Metronic->input('ClientProject.date', array('label' => __d('public', 'Data początkowa'), 'ng-model' => 'payment.date', 'disabled' => 'disabled', 'type' => 'text')); ?>
                                                <?php echo $this->Metronic->input('ClientProject.payment_day', array('label' => __d('public', 'Dzien miesiąca'), 'ng-model' => 'payment.payment_day','disabled'=>'disabled')); ?>
                                                <?php echo $this->Metronic->input('ClientProject.interval', array('label' => __d('public', 'Okres(miesiące)'), 'ng-model' => 'payment.interval','disabled'=>'disabled')); ?>
                                                <?php echo $this->Metronic->input('ClientProject.date_to', array('label' => __d('public', 'Data końcowa'), 'ng-model' => 'payment.date_to', 'disabled'=>'disabled', 'type' => 'text')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div ng-switch-when="stage">
                                        <div class="portlet box red-intense">
                                            <div class="portlet-title nowrap">
                                                <div class="caption">
                                                    <i class="fa fa-arrows-h"></i>
                                                    <?php echo __d('public', 'Etap'); ?> 
                                                </div>
                                                <div class="tools">
                                                    <a title="" data-original-title="" href="" ng-class="{'expand':collapsed,'collapse':!collapsed}" class="expand_link collapse">
                                                        <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                                    </a>
                                                    <a class="remove" ng-click="payment.delete = true" href="javascript:;"> 
                                                        <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">  
                                                <?php echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Tytuł etapu'), 'ng-model' => 'payment.name', 'type' => 'text','disabled'=>'disabled')); ?>
                                                <?php echo $this->Metronic->input('ClientProject.date', array('label' => __d('public', 'Data początkowa'), 'ng-model' => 'payment.date', 'disabled'=>'disabled', 'type' => 'text',)); ?>
                                                <?php echo $this->Metronic->input('ClientProject.date_to', array('label' => __d('public', 'Data końcowa'), 'ng-model' => 'payment.date_to', 'disabled'=>'disabled', 'type' => 'text',)); ?>
                                                <?php echo $this->Metronic->input('ClientProject.desc', array('label' => __d('public', 'Szczegółowy opis etapu'), 'ng-model' => 'payment.desc', 'type' => 'textarea','disabled'=>'disabled')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div ng-switch-when="milestone">
                                        <div class="portlet box green-jungle">
                                            <div class="portlet-title nowrap">
                                                <div class="caption">
                                                    <i class="fa fa-anchor"></i>
                                                    <?php echo __d('public', 'Kamień milowy'); ?>  
                                                </div>
                                                <div class="tools">
                                                    <a title="" data-original-title="" href="" ng-class="{'expand':collapsed,'collapse':!collapsed}" class="expand_link collapse">
                                                        <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                                    </a>
                                                    <a class="remove" ng-click="payment.delete = true" href="javascript:;"> 
                                                        <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">  
                                                <?php echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Nazwa kamienia'), 'ng-model' => 'payment.name', 'type' => 'text','disabled'=>'disabled')); ?>
                                                <?php echo $this->Metronic->input('ClientProject.date', array('label' => __d('public', 'Data'), 'ng-model' => 'payment.date', 'disabled'=>'disabled', 'type' => 'text')); ?>
                                                <?php echo $this->Metronic->input('ClientProject.desc', array('label' => __d('public', 'Lista zadań:'), 'ng-model' => 'payment.desc', 'type' => 'textarea','disabled'=>'disabled')); ?>
                 
                                            </div>
                                        </div>
                                    </div>
                                    <div ng-switch-when="agreement">
                                        <div class="portlet box yellow-crusta">
                                            <div class="portlet-title nowrap">
                                                <div class="caption">
                                                    <i class="fa fa-file-text-o"></i>
                                                    <?php echo __d('public', 'Nowa umowa'); ?>   
                                                </div>
                                                <div class="tools">
                                                    <a title="" data-original-title="" href="" ng-class="{'expand':collapsed,'collapse':!collapsed}" class="expand_link collapse">
                                                        <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                                    </a>
                                                    <a class="remove" ng-click="payment.delete = true" href="javascript:;"> 
                                                        <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">  
                                                <?php echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Nazwa umowy'), 'ng-model' => 'payment.name', 'type' => 'text','disabled'=>'disabled')); ?>
                                                <?php echo $this->Metronic->input('ClientProject.date', array('label' => __d('public', 'Data rozpoczęcia'), 'ng-model' => 'payment.date', 'disabled'=>'disabled', 'type' => 'text')); ?>
                                                <?php echo $this->Metronic->input('ClientProject.date_to', array('label' => __d('public', 'Data zakonczenia'), 'ng-model' => 'payment.date_to', 'disabled'=>'disabled', 'type' => 'text')); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="portlet box green-jungle">
                                    <div class="portlet-title nowrap">
                                        <div class="caption">
                                            <i class="fa fa-anchor"></i>
                                            <?php echo __d('public', 'Kamień milowy'); ?>  
                                        </div>
                                        <div class="tools">
                                            <a title="" data-original-title="" href="" ng-class="{'expand':collapsed,'collapse':!collapsed}" class="expand_link collapse">
                                                <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">  
                                        <?php echo __d('public', 'Koniec umowy'); ?>
                                        <?php echo $clientProject['ClientProject']['end_project']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn default" type="button" data-dismiss="modal"><?php echo __d('public', 'Zamknij') ?></button>
                        </div>
                    </div>
                </div>
            </div>
        