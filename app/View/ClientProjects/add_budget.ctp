<?php //echo $this->Form->create('ClientProject');        ?>

<?php $this->Html->addCrumb('CRM', array('controller' => 'clients', 'action' => 'index')); ?>
<?php $this->Html->addCrumb(__d('public', 'Nowy projekt'), array('controller' => 'clients', 'action' => 'index')); ?>
<?php
$project_id = empty($project['ClientProject']['id']) ? null : $project['ClientProject']['id'];
echo $this->element('ClientProjects/add_tabs', array('project_id' => $project_id, 'active' => 'add_budget'));
?>
<div class="row" ng-controller="ClientProjectBudgetCtrl" ng-init="<?php echo empty($clientProjectBudget) ? '' : 'teams =' . a($clientProjectBudget) ?>">
    <div class="col-md-7" ng-init=" <?php echo empty($hr_settings['it_rate']) ? 'hr_settings =' . a($hr_settings) : '' ?>">

        <?php echo $this->Metronic->portlet(__d('public', 'Budżet')); ?>
        <div class="row" ng-cloak>
            <div class=" col-md-6 col-xs-12 mb5">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="number" style="font-size:{{sumPrice| fontSize}}px">
                            {{teams| sumPaymentInAll | formatPrice}} zł
                        </div>
                        <div class="desc">
                            <?php echo __d('public', 'Koszty projektowe'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-md-6 col-xs-12 mb5">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-history"></i>
                    </div>
                    <div class="details">
                        <div class="number"  style="font-size:{{sumPrice| fontSize}}px">
                            {{teams| sumBufferInAll | formatPrice}} zł
                        </div>
                        <div class="desc">
                            <?php echo __d('public', 'Bufor'); ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="  col-md-6 col-xs-12 mb5">
                <div class="dashboard-stat green-haze">
                    <div class="visual">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="details">
                        <div class="number"  style="font-size:{{sumPrice| fontSize}}px">
                            {{teams| sumMarginInAll | formatPrice}} zł
                        </div>
                        <div class="desc">
                            <?php echo __d('public', 'Marża'); ?>
                        </div>
                    </div>

                </div>
            </div>


            <div class="  col-md-6 col-xs-12 mb5">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number"  style="font-size:{{sumPrice| fontSize}}px">
                            {{
                                        sumPrice = (teams | sumPaymentInAll) + (teams | sumMarginInAll) + (teams | sumBufferInAll) | formatPrice
                            }} zł
                        </div>
                        <div class="desc">
                            <?php echo __d('public', 'Do zapłaty'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php echo $this->Metronic->portletEnd(); ?>
        <div class="clear"></div>
        <?php echo $this->Metronic->portlet(__d('public', 'Dodaj pozycję budżetową'), false, 'fa fa-users', 'purple'); ?>

        <div class="input-group">
            <?php echo $this->Form->input('section', array('ng-model' => 'section', 'class' => 'form-control', 'empty' => __d('public', 'Wybierz'), 'div' => 'false', 'label' => false)); ?>
            <div ng-init="uneditableSectionsList = <?php echo h(json_encode($uneditableSectionsList)) ?>"></div>
            <span class="input-group-btn">
                <button type="button" class="btn blue" ng-click="addBudget();" ng-init="sections =<?php echo h(json_encode($sections, true)); ?>"><?php echo __d('public', 'Dodaj'); ?></button>
            </span>
        </div>
        <div ng-if="addBudgetMessage" class="error-message"><?php echo __d('public', 'Dział juz jest na liście') ?></div>


        <!-- /input-group -->
        <?php echo $this->Metronic->portletEnd(); ?>

        <div class="portlet box green" ng-cloak ng-repeat="team in teams" ng-hide="team.delete">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-users"></i>
                    {{team.section.activity_name}}
                </div>

                <div class="tools">
                    <a class="collapse" href="javascript:;">
                    </a>
                    <!--                    <a class="reload" href="javascript:;">&nbsp;
                                        </a>-->
                    <i class="fa fa-close font-white pointer" ng-click="onDeleteTeam($sectionId = team.section.section_id)">&nbsp;
                    </i>
                </div>
                <div class="actions">

                    <a class="btn btn-default btn-sm"  ng-click="addPayment(team.section.section_id)" href="javascript:;">
                        <i class="fa fa-plus"></i> <?php echo __d('public', 'Dodaj'); ?> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form">
                    <div class="form-horizontal">
                        <div class="form-actions top fluid">
                            <div class="col-md-5">
                                <?php echo $this->Metronic->input('ClientProjectBudget.activity_name', array('ng-model' => 'team.section.activity_name', 'type' => 'text', 'label' => __d('public', 'Nazwa działania'))); ?>
                            </div>
                            <div class="col-md-5 col-md-offset-2">
                                <?php echo $this->Metronic->input('ClientProjectBudget.pm', array('ng-model' => 'team.section.pm', 'type' => 'text', 'label' => __d('public', 'Link do PM '))); ?>
                            </div>
                        </div>
                        <div class="form-row-seperated">
                            <div class="form-group" ng-cloak ng-repeat="payment in team.payments"  ng-hide="payment.delete">
                                <div class="col-md-12">
                                    <span class="close" ng-click="onDeletePayment(team.section.section_id, $index)"> x </span>
                                    <div>&nbsp;</div>
                                </div>
                                <div class="col-md-4 mobile-mb5">
                                    <?php echo $this->Form->input('ClientProjectBudgetPosition.name', array('ng-model' => 'payment.name', 'placeholder' => __d('public', 'Nazwa'), 'type' => 'text', 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
                                </div>
                                <div class="col-md-4 mobile-mb5">
                                    <div class="input-group input-icon right">
                                        <?php echo $this->Form->input('ClientProjectBudgetPosition.hours', array('ng-model' => 'payment.time', 'placeholder' => __d('public', 'Czas'), 'type' => 'text', 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
                                        <span class="input-group-addon">h</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-icon right">
                                        <?php echo $this->Form->input('ClientProjectBudgetPosition.price', array('ng-model' => 'payment.price', 'ng-disabled' => 'payment.disabled', 'placeholder' => __d('public', 'Koszt'), 'type' => 'text', 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
                                        <span class="input-group-addon">zł</span>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <h4 class="pull-right">= {{payment.time * payment.price| formatPrice}} zł</h4>
                                </div>



                                <div class="form-edit">
                                    <?php echo $this->Form->input('ClientProjectBudgetPosition.id', array('ng-model' => 'payment.id', 'value' => '{{payment.id}}', 'type' => 'hidden', 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
                                </div>
                            </div>


                            <div class="form-group bufor_pozycji_budzetowej">
                                <div class="col-md-4">
                                    <h4><?php echo __d('public', 'Bufor'); ?></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-icon right">
                                        <?php echo $this->Form->input('ClientProjectBudget.buffer_percentage', array('ng-model' => 'team.section.buffer_percentage', 'type' => 'text', 'required' => 'required', 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <h4>= {{ team.section.buffer_value = ((team.section.buffer_percentage || 0) / 100) * (team.payments | sumPaymentInTeam) | formatPrice}} zł</h4>
                                </div>
                            </div>
                            <div class="form-group marza_pozycji_budzetowej">
                                <div class="col-md-4">
                                    <h4><?php echo __d('public', 'Marża') ?></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-icon right">
                                        <?php
                                        echo $this->Form->input(
                                                'ClientProjectBudget.margin_percentage', array(
                                            'ng-model' => 'team.section.margin_percentage',
                                            'ng-blur' => 'team.section.margin_percentage = 1 * team.section.margin_percentage < 35?35:team.section.margin_percentage',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'label' => false,
                                            'div' => false
                                        ));
                                        ?>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                    <div ng-if="1 * team.section.margin_percentage < 35" class="error-message"><?php echo __d('public', 'minimalna wartość marży to') ?> 35%</div>
                                </div>

                                <div class="col-md-4">
                                    <h4>= {{ team.section.margin_value = (((team.payments | sumPaymentInTeam) / ((100 - (team.section.margin_percentage || 0)))) * 100) - (team.payments | sumPaymentInTeam) | formatPrice}} zł</h4>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions bottom fluid">

                            <div class="row">
                                <div class="col-md-7">
                                    <?php echo __d('public', 'Koszty pozycji budżetowej') ?>
                                </div>
                                <div class="col-md-5">
                                    <?php //echo $this->Form->input('ClientProjectBudget.position_cost', array('ng-model' => 'team.section.position_cost', 'type' => 'hidden', 'class' => 'form-control', 'label' => false, 'div' => false));  ?>

                                    = {{ team.section.position_cost = (team.payments | sumPaymentInTeam) | formatPrice}} zł
                                </div>
                                <div class="col-md-7">
                                    <?php echo __d('public', 'Wartość pozycji budżetowej') ?>
                                </div>
                                <div class="col-md-5">
                                    <?php //echo $this->Form->input('ClientProjectBudget.position_value', array('ng-model' => 'team.section.position_value', 'type' => 'hidden', 'class' => 'form-control', 'label' => false, 'div' => false));  ?>

                                    = {{
                                                    team.section.position_value = (((team.payments | sumPaymentInTeam) / ((100 - (team.section.margin_percentage || 0)))) * 100) + (((team.section.buffer_percentage || 0) / 100) * (team.payments | sumPaymentInTeam)) | formatPrice
                                    }} zł
                                </div>
                            </div>

                            <?php echo $this->Form->input('ClientProjectBudget.section_id', array('ng-model' => 'team.section.section_id', 'type' => 'hidden', 'label' => false, 'div' => false)); ?>


                        </div>
                        <div class="form-edit">
                            <?php echo $this->Form->input('ClientProjectBudget.id', array('ng-model' => 'team.section.section_id', 'type' => 'hidden', 'value' => '{{team.section.section_id}}', 'label' => false)); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-5" ng-init="project = <?php echo h(json_encode($project)) ?>">
        <?php echo $this->Metronic->portlet(__d('public', 'Opcje')); ?>

        <?php echo $this->Form->create('ClientProject'); ?>

        <h3 class="inline"><?php echo __d('public', 'Status projektu') ?></h3> 
        <br/> <br/>

        <?php
        echo $this->Metronic->input('ClientProject.status', array('label' => __d('public', 'Status'),
            'options' => array(
                __d('public', 'Przed podpisaniem umowy'), __d('public', 'Podpisana umowa'), __d('public', 'Zakończony'), __d('public', 'Wewnętrzny')
        )));
        ?>
        <?php echo $this->Metronic->input('ClientProject.start_project', array('class' => 'date-picker form-control', 'type' => 'text', 'readonly', 'label' => __d('public', 'Data rozpoczęcia'), 'ng-model' => 'project.ClientProject.start_project')); ?>
        <?php echo $this->Metronic->input('ClientProject.end_project', array('class' => 'date-picker form-control', 'type' => 'text', 'readonly', 'label' => __d('public', 'Data zakończenia'), 'ng-model' => 'project.ClientProject.end_project')); ?>
        <?php
        $warranty[1] = __d('public', '1 miesiąc');
        $warranty[3] = __d('public', '3 miesiące');
        $warranty[6] = __d('public', '6 miesięcy');
        $warranty[12] = __d('public', 'rok');
        $warranty[24] = __d('public', '2 lata');
        echo $this->Metronic->input('ClientProject.warranty', array('class' => 'form-control', 'options' => $warranty, 'empty' => __d('public', 'brak'), 'label' => __d('public', 'Długośc gwarancji')));
        ?>

        <h3 class="inline"><?php echo __d('public', 'Dodatkowe informacje') ?></h3> 
        <br/><br/>

        <div data-color-format="rgba" data-color="{{ (project.ClientProject.color) ? project.ClientProject.color : '#3865a8'}}"  class="input-group color colorpicker-default">
            <span class="input-group-btn">
                <button type="button" class="btn default"><i></i>&nbsp;</button>
            </span>
<?php echo $this->Metronic->input('ClientProject.color', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'readonly', 'default' => '#3865a8', 'ng-model' => 'project.ClientProject.color')); ?>
        </div>
        <!-- /input-group -->
<?php echo $this->Metronic->input('ClientProject.notes', array('type' => 'textarea', 'label' => __d('public', 'Uwagi') . '<br><small>' . __d('public', 'Np. informacja kto kalkuloweał projekt') . '</small>', 'ng-model' => 'project.ClientProject.notes')); ?>
        <div class="row">

            <?php
            //echo $this->Html->link('<i class="fa fa-reply"></i> ' . __d('cms', 'Wróć do konfiguracji'), array('action'=>'add',$project['ClientProject']['client_lead_id']), array('class' => 'btn btn-sm  pull-left', 'escape' => false));
            echo $this->Form->create('ClientProject');
            ?>
            <textarea class="ng-hide" name="data[ClientProject][teams]">{{ teams}}</textarea>
            <div class="col-md-6  col-xs-12 mobile-mb5">

                <button class="btn btn-sm col-xs-12" type="submit" name="back_to_start" value="1">
                    <i class="fa fa-reply"></i> <?php echo __d('cms', 'Wróć do konfiguracji') ?> 
                </button>
            </div>
            <div class="col-md-6  col-xs-12">

                <?php
                echo $this->Form->button('<i class="fa fa-list-alt"></i> ' . __d('public', 'Zapisz i kontynuuj'), array('class' => 'col-xs-12 btn btn-sm red-sunglo pull-right', 'escape' => false, 'type' => 'submit'));
                ?>
            </div>
        </div>
<?php echo $this->Form->end(); ?>



<?php echo $this->Metronic->portletEnd(); ?>
    </div>
</div>



<?php //echo $this->Form->end();     ?>

<?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker'); ?>
<?php echo $this->Html->script('angular/controllers/ClientProjectBudgetCtrl.js', array('block' => 'angular')); ?>