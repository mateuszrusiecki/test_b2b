<?php //echo $this->Form->create('ClientProject');                 ?>

<?php $this->Html->addCrumb('CRM', array('controller' => 'clients', 'action' => 'index')); ?>
<?php $this->Html->addCrumb(__d('public', 'Nowy projekt'), array('controller' => 'clients', 'action' => 'index')); ?>

<?php
$project_id = empty($project['ClientProject']['id']) ? null : $project['ClientProject']['id'];
echo $this->element('ClientProjects/add_tabs', array('project_id' => $project_id, 'active' => 'add_payment'));
?>
<div class="row"  ng-controller="AddPaymentCtrl" ng-init="payments = <?php echo h(json_encode($payments)); ?>">
    <div class="col-md-6"  id="drop_field"
         ng-drop-success="onDrop($data,$event)"
         ng-drop="true" 
         >
             <?php echo $this->Metronic->portlet(__d('public', 'Harmonogram płatności')); ?>
		
            <h4 class=" center top0">
				<?php echo __d('public', 'Realizacja projektu'); echo ': '.$project['ClientProject']['start_project'].' - '.$project['ClientProject']['end_project'] ?> 
			</h4> 
			
        <div class="row">
            <div class="form">
                <div class="form-horizontal">
                    <div class="note note-success" ng-hide="(payments | deleted).length">
                        <h4><?php echo __d('public', 'Upuść tutaj aby dodać płatność'); ?></h4>
                    </div>
                    <div ng-cloak ng-repeat="(key, payment) in payments | deleted" >

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
                                    <a class="remove" ng-click="payment.delete = true" href="javascript:;"> 
                                    <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body" >  
                                <?php
                                echo $this->Form->input('ClientProject.name', array('label' => __d('public', 'Nazwa'), 'ng-model' => 'payment.name', 'type' => 'text', 'class' => 'form-control'
                                ));
                                ?>

                                <?php
                                echo $this->Form->input('ClientProject.date', array('label' => __d('public', 'Data'), 'ng-model' => 'payment.date', 'date-picker','readonly'=>"true", 'type' => 'text', 'class' => 'form-control'
                                ));
                                ?>
                                <div class="col-md-12"  ng-show="payment.type == 'cycle'">
                                    <?php
                                    echo $this->Metronic->input('ClientProject.payment_day', array('label' => __d('public', 'Dzien płatności'), 'ng-model' => 'payment.payment_day', 'options' => $payment_day
                                    ));
                                    ?>
                                </div>
                                <div class="col-md-12"  ng-show="payment.type == 'cycle'">
                                    <?php
                                    echo $this->Metronic->input('ClientProject.interval', array('label' => __d('public', 'Okres'), 'ng-model' => 'payment.interval', 'options' => $interval
                                    ));
                                    ?>
                                </div>
                                <div ng-hide="payment.payment_type > 0">
                                    <?php echo $this->Form->input('ClientProject.price', array('label' => __d('public', 'Kwota netto'), 'ng-model' => 'payment.price', 'type' => 'text', 'class' => 'form-control')); ?>
                                </div>
                                <div ng-show="payment.payment_type > 0">
                                    <?php echo $this->Form->input('ClientProject.price', array('label' => __d('public', 'Kwota netto'), 'ng-model' => 'payment.price', 'type' => 'text', 'class' => 'form-control','disabled'=>'disabled')); ?>
                                </div>
                                <div ng-show="payment.type == 'cycle'">
                                    <?php
                                    echo $this->Form->input('ClientProject.date_to', array(
                                        'label' => __d('public', 'Data ostatniej płatności'),
                                        'ng-model' => 'payment.date_to',
                                        'date-picker',
                                        'readonly'=>"true",
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
        </div>
        <?php echo $this->Metronic->portletEnd(); ?>


    </div>
    <div class="col-md-6" ng-init="project = <?php echo h(json_encode($project['ClientProject'])); ?>">
        <?php echo $this->Metronic->portlet(__d('public', 'Opcje')); ?>
        <div class="clearfix">

            <h4 class="center top0"><?php echo __d('public', 'Do zapłaty'); echo ': '.$project['ClientProject']['total_budget'] ?> zł</h4> 
			
            <h3 class="inline"><?php echo __d('public', 'Płatności'); ?></h3> 
            <br>
            <br>

            <span ng-init="$id = 4" class="icon-btn" id="add_payment" href="#" data-allow-transform="true" ng-drag="true" ng-drag-data="{type: 'payment'}" >
                <i class="fa fa-money"><i></i></i>
                <div>
                    <?php echo __d('public', 'Dodaj płatność'); ?>
                </div>
            </span>
            <span ng-init="$id = 5" class="icon-btn" href="#" data-allow-transform="true" ng-drag="true" ng-drag-data="{type: 'cycle','interval':'1','payment_day':'1'}">
                <i class="fa fa-refresh"><i></i></i>
                <div>
                    <?php echo __d('public', 'Dodaj płatność cykliczną'); ?>
                </div>
            </span>
            <br>
            <br>
            <div class="alert alert-block alert-info fade in">
                <p>
                    <?php echo __d('public', 'Płatność cykliczna będzie powtarzana aż do dnia zakończenia
                realizacji. Jeżeli umowa jest automatycznie przedłużana,
                płatność będzie powtarzana'); ?>.
                </p>
            </div>

            <h3>Przedłużanie umowy</h3>
            <?php echo $this->Metronic->input('ClientProject.auto_project', array('label' => __d('public', 'Automatycznie przedłużaj umowę'), 'ng-model' => 'project.auto_project', 'type' => 'checkbox')); ?>
            <?php echo $this->Metronic->input('ClientProject.interval_project', array('label' => 'Okres', 'options' => $interval, 'ng-model' => 'project.interval_project', 'empty' => 'Wybierz okres')); ?>
            <div class="alert alert-block alert-info fade in">
                <p>
                    <?php echo __d('public', 'Umowa będzie automatycznie przedłużana od daty jej
                zakończenia o wskazany okres czasu'); ?>.<br>
                    <?php echo __d('public', 'Płatności jednokrotne nie będą powtarzane
                Płatności cykliczne będą powtarzane'); ?>.
                </p>
            </div>

            <div class="row">
                <?php
//echo $this->Html->link('<i class="fa fa-reply"></i> ' . __d('cms', 'Wróć do budżetowania'), array('action' => 'add_budget', $project['ClientProject']['id']), array('class' => 'btn btn-sm  pull-left', 'escape' => false));
                echo $this->Form->create('ClientProject');
                ?>
                <textarea class="ng-hide" name="data[ClientProject][payments]">{{payments}}</textarea>
                <textarea class="ng-hide" name="data[ClientProject][project]">{{project}}</textarea>

            </div>
            <button class="col-xs-12 col-md-5 btn btn-sm  pull-left mobile-mb5" type="submit" name="back_to_budget" value="1">
                <i class="fa fa-reply"></i> <?php echo __d('cms', 'Wróć do budżetowania') ?>
            </button>
            <?php
            echo $this->Form->button('<i class="fa fa-list-alt"></i> ' . __d('public', 'Zapisz i kontynuuj'), array('class' => 'col-xs-12  col-md-6 btn btn-sm red-sunglo pull-right', 'escape' => false, 'type' => 'submit'));
            echo $this->Form->end();
            ?>
        </div>
        <?php echo $this->Metronic->portletEnd(); ?>
    </div>
</div>
<?php // /echo $this->Form->end();   ?>

<?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker'); ?>
<?php echo $this->Html->script('angular/controllers/AddPaymentCtrl.js', array('block' => 'angular')); ?>


<div>


</div>