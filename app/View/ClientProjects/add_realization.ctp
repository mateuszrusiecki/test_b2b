<?php echo $this->Form->create('ClientProject'); ?>
<?php $this->Html->addCrumb('CRM', array('controller' => 'clients', 'action' => 'index')); ?>
<?php $this->Html->addCrumb(__d('public', 'Nowy projekt'), array('controller' => 'clients', 'action' => 'index')); ?>

<?php
$project_id = empty($project['ClientProject']['id']) ? null : $project['ClientProject']['id'];
echo $this->element('ClientProjects/add_tabs', array('project_id' => $project_id, 'active' => 'add_realization'));
?>
<div class="row"  ng-controller="AddRealizationCtrl" ng-init="payments = <?php echo h(json_encode($shedules)); ?>">
    <div class="col-md-6" id="drop_field"
         ng-drop-success="onDrop($data,$event)"
         ng-drop="true" 
         >
             <?php echo $this->Metronic->portlet(__d('public', 'Harmonogram realizacji')); ?>
        <div class="row">
            <div class="form">
                <div class="note note-success" ng-hide="(payments | deleted).length">
                    <h4><?php echo __d('public', 'Upuść tutaj aby dodać harmonogram realizacji'); ?></h4>
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
                        <?php echo  __d('public', 'Początek umowy'); ?>
                        <?php echo $project['ClientProject']['start_project']; ?>
                    </div>
                </div>
                <div ng-cloak  ng-repeat="(key, payment) in payments | deleted" ng-switch="payment.type">
                    
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
                                <?php echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Nazwa'), 'ng-model' => 'payment.name', 'type' => 'text')); ?>
                                <?php echo $this->Metronic->input('ClientProject.date', array('label' => __d('public', 'Data początkowa'), 'ng-model' => 'payment.date', 'date-picker', 'readonly' => "true", 'type' => 'text')); ?>
                                <?php echo $this->Metronic->input('ClientProject.payment_day', array('label' => __d('public', 'Dzien miesiąca'), 'ng-model' => 'payment.payment_day', 'options' => $payment_day)); ?>
                                <?php echo $this->Metronic->input('ClientProject.interval', array('label' => __d('public', 'Okres'), 'ng-model' => 'payment.interval', 'options' => $interval)); ?>
                                <?php echo $this->Metronic->input('ClientProject.date_to', array('label' => __d('public', 'Data końcowa'), 'ng-model' => 'payment.date_to', 'date-picker', 'readonly' => "true", 'type' => 'text')); ?>
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
                                <?php echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Tytuł etapu'), 'ng-model' => 'payment.name', 'type' => 'text')); ?>
                                <?php echo $this->Metronic->input('ClientProject.date', array('label' => __d('public', 'Data początkowa'), 'ng-model' => 'payment.date', 'date-picker', 'readonly' => "true", 'type' => 'text',)); ?>
                                <?php echo $this->Metronic->input('ClientProject.date_to', array('label' => __d('public', 'Data końcowa'), 'ng-model' => 'payment.date_to', 'date-picker', 'readonly' => "true", 'type' => 'text',)); ?>
                                <?php echo $this->Metronic->input('ClientProject.desc', array('label' => __d('public', 'Szczegółowy opis etapu'), 'ng-model' => 'payment.desc', 'type' => 'textarea')); ?>
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
                                <?php echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Nazwa kamienia'), 'ng-model' => 'payment.name', 'type' => 'text')); ?>
                                <?php echo $this->Metronic->input('ClientProject.date', array('label' => __d('public', 'Data'), 'ng-model' => 'payment.date', 'date-picker', 'readonly' => "true", 'type' => 'text')); ?>
                                
                                    <?php echo $this->Metronic->input('ClientProject.desc', array('label' => __d('public', 'Lista zadań:'), 'ng-model' => 'payment.desc', 'type' => 'textarea','class'=>'ng-hide')); ?>
                                    
                                <div class="brief_answer_div">
                                    <pre>{{ payment.desc }} <i ng-show="payment.desc" class="fa fa-trash-o font-purple pull-right pointer" tooltip="Wyczyść listę" ng-click="payment.desc = ''"></i></pre>
                                </div>
                                
                                <div class="brief_answer_div">
                                    <input type="text" class="form-control brief_answer_input" placeholder="Dodaj do listy" ng-model="payment.add_to_list" 
										ng-keypress="$event.which==13 ? payment.desc = payment.desc + '- ' + payment.add_to_list +'\n' : ''; $event.which==13 ? $event.preventDefault() :''; $event.which==13 ? payment.add_to_list='' :''" />
                                    <i class="fa fa-arrow-circle-o-right font-purple" tooltip="Dodaj" ng-click="payment.add_to_list ? payment.desc = payment.desc + '- ' + payment.add_to_list + '\n' : '';payment.add_to_list=''"></i>
                                </div>                    
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
                                <?php echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Nazwa umowy'), 'ng-model' => 'payment.name', 'type' => 'text')); ?>
                                <?php echo $this->Metronic->input('ClientProject.date', array('label' => __d('public', 'Data rozpoczęcia'), 'ng-model' => 'payment.date', 'date-picker', 'readonly' => "true", 'type' => 'text')); ?>
                                <?php echo $this->Metronic->input('ClientProject.date_to', array('label' => __d('public', 'Data zakonczenia'), 'ng-model' => 'payment.date_to', 'date-picker', 'readonly' => "true", 'type' => 'text')); ?>
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
                        <?php echo $project['ClientProject']['end_project']; ?>
                    </div>
                </div>

            </div>
        </div>
        <?php echo $this->Metronic->portletEnd(); ?>


    </div>
    <div class="col-md-6">
        <?php echo $this->Metronic->portlet(__d('public', 'Opcje')); ?>


        <h3 class="inline"><?php echo __d('public', 'Elementy realizacyjne'); ?></h3> 
        <br>
        <br>

        <span class="icon-btn pointer" id="add_stage" ng-init="$id = 43" data-allow-transform="true" ng-drag="true" ng-drag-data="{type: 'stage'}">
            <i class="fa fa-arrows-h"><i></i></i>
            <div>
                <?php echo __d('public', 'Dodaj etap'); ?>
            </div>
        </span>
        <span class="icon-btn pointer" id="add_milestone" ng-init="$id = 42" data-allow-transform="true" ng-drag="true" ng-drag-data="{type: 'milestone'}">
            <i class="fa fa-anchor"><i></i></i>
            <div>
                <?php echo __d('public', 'Dodaj kamień milowy'); ?>
            </div>
        </span>
        <span class="icon-btn pointer" id="add_cycle_event" ng-init="$id = 41" data-allow-transform="true" ng-drag="true" ng-drag-data="{type: 'cycle','interval':'1','payment_day':'1'}">
            <i class="fa fa-refresh"><i></i></i>
            <div>
                <?php echo __d('public', 'Dodaj wydarzenie cykliczne'); ?>
            </div>
        </span>
        <span class="icon-btn pointer" id="add_new_agrement" ng-init="$id = 40" data-allow-transform="true" ng-drag="true" ng-drag-data="{type: 'agreement'}">
            <i class="fa fa-file-text-o "><i></i></i>
            <div>
                <?php echo __d('public', 'Dodaj nową umowę'); ?>
            </div>
        </span>
        <br>
        <br>

        <div class="row">
            <?php echo $this->Form->create('ClientProject'); ?>
            <textarea class="ng-hide" name="data[ClientProject][payments]">{{payments}}</textarea>
			<?php if($project['ClientProject']['agreement'] == false){ ?>
				<?php echo $this->element('ClientProjects/projectWithoutAgreementNotification'); ?>
			<?php } ?>
			

            <div class="col-md-6  col-xs-12">
                <button class="btn btn-sm col-xs-12 mobile-mb5" type="submit" name="back_to_payment" value="1">
                    <i class="fa fa-reply"></i> <?php echo __d('cms', 'Wróć do har. płatności') ?>
                </button>
            </div>

            <div class="col-md-6  col-xs-12">
                <?php
                echo $this->Form->button('<i class="fa fa-list-alt"></i> ' . __d('cms', 'Zapisz projekt'), array('class' => 'col-xs-12 btn btn-sm btn-circle red-sunglo pull-right', 'escape' => false, 'type' => 'submit'));
                ?>
            </div>



            <?php echo $this->Form->end(); ?>
        </div>
        <?php echo $this->Metronic->portletEnd(); ?>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker'); ?>
<?php echo $this->Html->script('angular/controllers/AddRealizationCtrl.js', array('block' => 'angular')); ?>

<div>


</div>