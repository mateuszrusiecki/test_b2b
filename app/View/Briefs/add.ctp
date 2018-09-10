<div class="row clearfix" ng-controller="BiefAddCtrl">
    <div class="col-xs-12" 
         ng-init="input = <?php echo empty($brief['Brief']) ? '[]' : a($brief['Brief']); ?>;
                         questions = <?php echo empty($brief['BriefQuestion']) ? '[]' : a($brief['BriefQuestion']); ?>;
         ">
        <div class="profile-sidebar right-profile">
            <?php echo $this->Metronic->portlet(__d('public', 'Pytania opcjonalne')); ?>
            <div class="clearfix option-choose" id="option-choose">
                <span
                    ng-repeat="briefDefaultQuestion in briefDefaultQuestions| briefGroup"  
                    ng-click="$parent.groupQuestionCurrent[briefDefaultQuestion.group] = !$parent.groupQuestionCurrent[briefDefaultQuestion.group]" 
                    ng-class="{'green-haze': groupQuestionCurrent[briefDefaultQuestion.group],'default':!groupQuestionCurrent[briefDefaultQuestion.group]}" 
                    ng-init="$id = 1"  
                    ng-drag="true" 
                    ng-drag-data="{content:briefDefaultQuestion.group,default:true}" 
                    class="min-width-118 margin-bottom-10 margin-right-10 poitnier btn btn-sm margin-bottom pull-left">
                    <i class="fa fa-arrows pull-right"></i>
                    <span class="question_group_{{briefDefaultQuestion.id}}">{{briefDefaultQuestion.group}}</span>
                </span>
            </div>
            <div class="clearfix">
                <div class="panel panel-default margin-top-15"  ng-repeat="briefDefaultQuestion in briefDefaultQuestions" ng-show="groupQuestionCurrent[briefDefaultQuestion.group] == true">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{briefDefaultQuestion.category}}</h3>
                    </div>
                    <div class="panel-body" ng-repeat="question in briefDefaultQuestion.questions">
                        {{question.content}}
                    </div>
                </div>

                <?php echo $this->Metronic->portlet(__d('public', 'Opcje'), 0, 'fa fa-cogs', 'blue', 0, null, 0); ?>

                <div class="panel-body no-padding">
                    <div class="clearfix row">
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'DODAJ KATEGORIĘ') ?></span>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <input ng-model="customInput.category" type="text" class="form-control">
                                </div>
                                <div class="clearfix mt5">

                                    <span class="poitnier btn btn-sm green-seagreen pull-right" ng-click="addCategory(customInput.category);"><?php echo __d('public', 'Dodaj kategorię') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div  class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <i class="fa fa-arrows pull-right pointer"
                                       ng-repeat="$id in [99]"  
                                       ng-drag="true" 
                                       ng-drag-data="{content:customInput.content, default: false}"
                                       tooltip="<?php echo __d('public', 'Przeciągnij pytanie do kategorii') ?>"
                                       ng-show="customInput.content"
                                       ></i>
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'DODAJ PYTANIE') ?></span>
                                </div>
                                <div class="clearfix margin-top-10" >

                                    <textarea 
                                        ng-model="customInput.content" 
                                        type="text" 
                                        class="form-control"

                                        >
                                    </textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $this->Metronic->portletEnd(); ?>
            </div>
            <?php echo $this->Metronic->portletEnd(); ?>
        </div>
        <div class="profile-content">
            <?php echo $this->Metronic->portlet(__d('public', 'Brief [pytanie oferowe]')); ?>
            <div class="row">
                <div class="col-xs-12" ng-init="input.client_lead_id = <?php echo $client_lead_id; ?>">
                    <?php echo $this->Metronic->portlet(__d('public', 'Informacje'), 0, null, 'blue', 0); ?>
                    <div class="clearfix">
                        <div class="col-xs-6">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Tytuł briefa') ?></span>

                                </div>
                                <div class="clearfix margin-top-15">
                                    <input ng-model="input.name" type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 ">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Opiekun klienta') ?></span>

                                </div>
                                <div class="clearfix margin-top-15">
                                    <?php echo $this->Form->input('guardian_id', array('ng-model' => 'input.guardian_id', 'label' => false, 'div' => false, 'class' => 'form-control')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-xs-6">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Klient') ?></span>

                                </div>
                                <div class="clearfix margin-top-15">
                                    <p><?php echo $client_lead['Client']['name'] ?></p>
                                    <p><?php echo __d('public', 'email') ?>: <?php if($client_lead['Client']['email']) echo 'email: '.$client_lead['Client']['email'] ?></p>
                                    <p><?php if($client_lead['Client']['phone']) echo 'tel.: '.$client_lead['Client']['phone'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 ">
                            
                        </div>
                    </div>
                    <?php echo $this->Metronic->portletEnd(); ?>
                </div>




                <div ng-repeat="category in questions| briefCategory" 
                     data-category="category.category_name"
                     ng-drop-success="onDropComplete($data, category.category_name)"
                     ng-drop="true" 
                     ng-cloak 
                     class="col-xs-12" id="brief_question_category_{{ $index }}"
                     >
                    <div class="portlet box purple">
                        <div class="portlet-title">

                            <div class="caption">
                                <i class=""></i>
                                {{category.category_name}}
                            </div>
                            <div class="tools caption">
                                <a title="" data-original-title="" href="" ng-class="{'expand':collapsed6813,'collapse':!collapsed6813}" class="expand_link collapse">
                                    <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                </a>
                                <span class="pointner pull-right">
                                    <span 
                                        ng-click="category.delete = true; "
                                        class="close_white brief_category_close" 
                                        > x </span>
                                </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="alert alert-success alert-dismissable">
                                <?php echo __d('public', 'Przeciągnij i upuść tutaj aby dodać') ?>
                            </div>
                            <div 
                                ng-repeat="question in questions| briefQuestion:category.category_name |deleted" 
                                ng-if="question.content | length"
                                class="clearfix"
                                >
                                <span class="pointner pull-right">
                                    <span 
                                        ng-click="question.delete = true"
                                        class="close"
                                        > x </span>
                                </span>
                                <div class="col-xs-10">{{question.content}}</div>
                                <hr />
                            </div>
                            <?php echo $this->Metronic->portletEnd(); ?>
                        </div>
                        <div class="col-xs-12"
                             ng-drop-success="onDropComplete($data)"
                             ng-drop="true" 
                             >
                            <div class="alert alert-success alert-dismissable">
                                <?php echo __d('public', 'Przeciągnij i upuść tutaj aby dodać') ?>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <?php /* ?>
                              <div class="alert alert-success alert-dismissable">
                              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                              <strong>Dokument został zapisany na liście dokumentów związanych z leadem Mój lead!</strong>
                              <br />
                              Opcjonalnie możesz wykorzystać link do briefa: <br />
                              <a class="alert-link" href="">
                              Kliknij aby otworzyć brief
                              </a>
                              </div>
                              <?php /* */ ?>
                            <div class="clearfix">
                                <a href="client_leads/view/<?php echo $client_lead['ClientLead']['client_id'].'/'.$client_lead['ClientLead']['id'] ?>" data-toggle="modal" 
                                   class="btn btn-sm green-haze btn-sm margin-bottom poitnier pull-left"><i class="fa fa-arrow-circle-left"></i> <?php echo __d('public', 'Powrót do leada') ?></a>  
                                
                                <?php echo $this->Form->create(); ?>
                                <textarea ng-hide="true" ng-cloak name="data[questions]">{{questions}}</textarea>
                                <textarea ng-hide="true" ng-cloak name="data[input]">{{input}}</textarea>
                                <input ng-hide="true" ng-cloak name="data[client_info]" value="1">
                                <button type="submit" class="btn btn-sm yellow margin-bottom pull-right ml"><?php echo __d('public', 'Zapisz i powiadom klienta') ?></button>
                                <?php echo $this->Form->end(); ?>
                                
                                <?php echo $this->Form->create(); ?>
                                <textarea ng-hide="true" ng-cloak name="data[questions]">{{questions}}</textarea>
                                <textarea ng-hide="true" ng-cloak name="data[input]">{{input}}</textarea>
                                <button type="submit" class="btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier"><?php echo __d('public', 'Zapisz') ?></button>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php echo $this->Html->script('angular/controllers/BiefAddCtrl.js?v=' . rand(), array('block' => 'angular')); ?>