

        <a  href="#shedulePaymentDialog" data-toggle="modal" class="col-md-3 col-sm-6 col-xs-12 mb5" ng-click="getPaymentsPopupData(<?php echo $clientProject['ClientProject']['id'] ?>)">
            <div class="dashboard-stat yellow-gold">
                <div class="visual">
                    <i class="fa fa-money"></i>
                </div>
                <div class="details">

                    <div class="desc"><?php echo __d('public', 'HARMONOGRAM PŁATNOŚCI'); ?></div>
                </div><i class="fa fa-chevron-circle-right"></i>

            </div>
        </a>
            <div aria-hidden="false" role="shedulePaymentDialog" tabindex="-1" id="shedulePaymentDialog" class="modal fade ng-cloak" my-modal>
                <div class="modal-dialog modal-small">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title"><?php echo __d('public', 'Harmonogram płatności') ?></h4>
                        </div>

                        <div class="modal-body">
                            <div class="tile-body">
                                <div ng-cloak ng-repeat="(key, payment) in payment_popup_data | deleted" >

                                    <div class="portlet box " ng-class="{'blue-madison':(payment.type == 'payment'),'red':(payment.type == 'cycle')}">
                                        <div class="portlet-title nowrap">

                                            <div class="caption">
                                                <i class="fa " ng-class="{'fa-money':(payment.type == 'payment'),'fa-refresh':(payment.type == 'cycle')}"></i><span ng-show="payment.type == 'cycle'"><?php echo __d('public', 'Płatność cykliczna') ?></span>
                                                <span ng-show="payment.type == 'payment'" class="ng-hide"><?php echo __d('public', 'Płatność') ?></span>
                                            </div>
                                            <div class="tools">
                                                <a title="" data-original-title="" href="" ng-class="{'expand':collapsed,'collapse':!collapsed}" class="expand_link collapse">
                                                    <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                                </a>
                                                
                                            </div>
                                        </div>
                                        <div class="portlet-body" >  
                                            <?php echo $this->Form->input('ClientProject.name', array('label' => __d('public', 'Nazwa'), 'ng-model'=>'payment.name', 'type'=>'text', 'class'=>'form-control','disabled'=>'disabled' )); ?>

                                            <?php echo $this->Form->input('ClientProject.date', array('label' => __d('public', 'Data'), 'ng-model'=>'payment.date', 'type'=>'text', 'class'=>'form-control','disabled'=>'disabled' )); ?>
                                            
                                            <div  ng-show="payment.type == 'cycle'">
                                                <?php echo $this->Metronic->input('ClientProject.payment_day', array('label'=> __d('public', 'Dzien płatności'), 'ng-model'=>'payment.payment_day','disabled'=>'disabled'  )); ?>
                                            </div>
                                            <div  ng-show="payment.type == 'cycle'">
                                                <?php echo $this->Metronic->input('ClientProject.interval', array('label'=> __d('public', 'Okres(miesiące)'), 'ng-model'=>'payment.interval','disabled'=>'disabled' )); ?>
                                            </div>
                                                <?php echo $this->Form->input('ClientProject.price', array('label' => __d('public', 'Kwota'), 'ng-model' => 'payment.price', 'type' => 'text', 'class' => 'form-control','disabled'=>'disabled' )); ?>
                                            <div ng-show="payment.type == 'cycle'">
                                                <?php
                                                echo $this->Form->input('ClientProject.date_to', array(
                                                    'label' => __d('public', 'Data ostatniej płatności'),
                                                    'ng-model' => 'payment.date_to',
                                                    'disabled'=>'disabled',
                                                    'type' => 'text',
                                                    'class' => 'form-control'
                                                        ), array(
                                                            'icon' => "fa fa-calendar",
                                                            'side' => 'right'
                                                        )
                                                );
                                                ?>
                                            </div>

                                        </div>
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