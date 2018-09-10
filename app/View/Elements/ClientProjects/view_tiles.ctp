<?php echo $this->Html->script('angular/controllers/ViewTilesCtrl', array('block' => 'angular')); ?>
<div class="projectView" ng-controller="ViewTilesCtrl">
    <div class="row">
        <div class="col-xs-12">
            <div class="modifiedProjectTopTitle projectTopTitle" style="border-left: 7px solid <?php echo $clientProject['ClientProject']['color']; ?>;">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h2><span>[<?php echo $clientProject['ClientProject']['alias']; ?>]</span> <?php echo $clientProject['ClientProject']['name']; ?></h2><span>(status: <b>w realizacji</b>)</span><br />
                        <p>
                            <?php echo __d('public', 'Kierownik projektu'); ?>: 
                            <b>
                                <?php echo $clientProject['Profile']['firstname'] . ' ' . $clientProject['Profile']['surname']; ?>
                            </b>
                        </p>
                        <p>
                            <?php echo __d('public', 'Klient'); ?>:
                            <b>
                                <?php echo $clientProject['Client']['name']; ?>&nbsp;&nbsp;&nbsp;
                                <span class="fa fa-phone"></span> <?php echo $clientProject['Client']['phone']; ?>
                                <span class="fa fa-envelope-o"></span> <a class="color-white" href="mailto::<?php echo $clientProject['Client']['email']; ?>"><?php echo $clientProject['Client']['email']; ?></a>
                            </b>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 text-right projectTopTitleOptions">
                        <?php if ($clientProject['ClientProject']['close_realization'] && ($user_permission == 'all' || $user_permission == 'manager')) { ?>
                            <a href="<?php echo $this->Html->url(array('controller' => 'base_modules', 'action' => 'index', $clientProject['ClientProject']['id'])); ?>">
                                <i class="fa fa-file-text font-white font-large" tooltip="<?php echo __d('public', 'Przejdź do bazy modułów'); ?>"></i>
                            </a>
                            <?php if (!$clientProject['ClientProject']['project_database']): ?>
                                <a href="<?php echo $this->Html->url(array('controller' => 'base_projects', 'action' => 'create', $clientProject['ClientProject']['id'])); ?>">
                                    <i class="fa fa-share-alt font-white font-large" tooltip="<?php echo __d('public', 'Dodaj do bazy projektów'); ?>"></i>
                                </a>  
                            <?php endif; ?>
                            <?php if (!$clientProject['ClientProject']['modules_database']): ?>        
                                <a href="<?php echo $this->Html->url(array('controller' => 'base_modules', 'action' => 'create', $clientProject['ClientProject']['id'])); ?>">
                                    <i class="fa fa-th font-white font-large" tooltip="<?php echo __d('public', 'Dodaj do bazy modułów'); ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php } ?>
                        <a target="_blank" href="/bonus_panels/bonus/<?php echo md5($clientProject['ClientProject']['id']); ?>">
                            <i class="fa fa-dollar font-white font-large" tooltip="<?php echo __d('public', 'Panel premii'); ?>"></i>
                        </a>
                        <?php echo $this->element('ClientProjects/share'); ?>
                        <?php if ($user_permission == 'all' || $user_permission == 'manager' || $user_permission == 'trader') { ?>
                            <a href="<?php echo $this->Html->url(array('action' => 'add', $clientProject['ClientProject']['client_lead_id'])); ?>">
                                <i class="fa fa-cogs font-white font-large" tooltip="<?php echo __d('public', 'Edytuj'); ?>"></i>
                            </a>
                        <?php } ?>
                        <?php if (!$clientProject['ClientProject']['close_financing']) { //zakończenie finansowania jest możliwe tylko po oznaczeniu wszystkich platności jako wykonanych  ?>
                            <div aria-hidden="false" role="sessionTimeoutDialog2" tabindex="-1" id="sessionTimeoutDialog2" class="modal fade closing_project ng-cloak" my-modal ng-class="projCloseFinancing ? 'in' : ''">
                                <!--<div id="sessionTimeout-dialog" style="display:{{projCloseFinancing?'block':'none'}}" class="modal fade in" aria-hidden="false">-->
                                <div class="modal-dialog modal-small">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button aria-hidden="true" data-dismiss="modal" ng-click="projCloseFinancing = false;" class="close" type="button">×</button>
                                            <h4 class="modal-title"><?php echo __d('public', 'Zamykanie finansowania projektu') ?></h4>
                                        </div>
                                        <form method="post" action="<?php echo $this->Html->url(array('action' => 'close_financing', 1)); ?>" >
                                            <?php echo $this->Form->input('ClientProject.id', array('value' => $clientProject['ClientProject']['id'], 'type' => 'hidden')) ?>
                                            <div class="modal-body">
                                                <?php echo __d('public', 'Czy jesteś pewien że chcesz oznaczyć płatność za projekt') ?> <?php echo $clientProject['ClientProject']['name'] ?> <?php echo __d('public', 'jako kompletną i zakończoną') ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn default" type="button" data-dismiss="modal" ng-click="projCloseFinancing = false;"><?php echo __d('public', 'Anuluj') ?></button>
                                                <button class="btn blue" type="submit" ><?php echo __d('public', 'OK') ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php if ($user_permission == 'all') { ?>
                                <?php if ($all_payments_done): ?>
                                    <a href="#sessionTimeoutDialog2" data-toggle="modal">
                                    <?php else: ?>
                                        <a style="z-index: 1000" tooltip="<?php echo __d('public', 'Nie można zakońcyć finansowania projektu, gdyż nie wszystkie płatności zostały oznaczone jako wykonane') ?>">	
                                        <?php endif; ?>
                                        <i class="fa fa-minus-circle font-white font-large" tooltip="<?php echo __d('public', 'Zakończ finansowanie'); ?>"></i>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                            <?php echo $this->element('ClientProjects/close'); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($user_permission == 'all' || $user_permission == 'manager') { ?>
    <div class="row">
        <?php if ($user_permission == 'all' || $user_permission == 'manager' || $access) { ?>
            <?php echo $this->element('ClientProjects/view_titles/budget_popup'); ?>
        <?php } ?>
            
        <?php echo $this->element('ClientProjects/view_titles/departments_involved_popup'); ?>
        <?php echo $this->element('ClientProjects/view_titles/shedule_realization_popup'); ?>
        <?php echo $this->element('ClientProjects/view_titles/shedule_payment_popup'); ?>
        

        
        
    </div>
    <?php } ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="tiles">
                    <a href="poll/polls/view/client_project_id/<?php echo $clientProject['ClientProject']['id']; ?>" class="tile bg-green-haze col-xs-2">
                        <!--<a class="tile bg-green-haze"  tooltip="Moduł jest w trakcie realizacji">-->
                        <div class="tile-body">
                            <i class="fa fa-list-alt"></i>
                        </div>
                        <div class="tile-object">
                            <div class="name">
                                <b><?php echo __d('public', 'CSMS') ?></b>
                            </div>
                            <div class="number">
                            </div>
                        </div>
                    </a>
                    <a href="/new_clients/main#/projects/lead_id/<?php echo $clientProject['ClientProject']['client_lead_id']; ?>" class="tile bg-purple-plum" tooltip="<?php echo __d('public', 'Moduł jest w realizacji') ?>">
                        <!--<a class="tile bg-purple-plum" tooltip="Moduł jest w trakcie realizacji">-->
                        <div class="tile-body">
                            <i class="fa fa-file-picture-o"></i>
                        </div>
                        <div class="tile-object">
                            <div class="name">
                                <b><?php echo __d('public', 'GC') ?></b>
                            </div>
                            <div class="number">
                            </div>
                        </div>
                    </a>
                    <a href="/text_documents/index/<?php echo $clientProject['ClientProject']['client_lead_id']; ?>" class="tile bg-yellow-gold">
                        <div class="tile-body">
                            <i class="fa fa-file-text"></i>
                        </div>
                        <div class="tile-object">
                            <div class="name">
                                <b><?php echo __d('public', 'TC') ?></b>
                            </div>
                            <div class="number">
                            </div>
                        </div>
                    </a>
                    <a href="/project_mockups/project_mockups/index/<?php echo $clientProject['ClientProject']['id']; ?>" class="tile bg-green-seagreen">
                        <div class="tile-body">
                            <i class="fa fa-sitemap"></i>
                        </div>
                        <div class="tile-object">
                            <div class="name">
                                <b><?php echo __d('public', 'Makietowanie') ?></b>
                            </div>
                            <div class="number">
                            </div>
                        </div>
                    </a>

                    <a href="/briefs/view/<?php echo $clientProject['ClientProject']['client_lead_id']; ?>/1" class="tile bg-purple-medium">
                        <div class="tile-body">
                            <i class="fa fa-lightbulb-o"></i>
                        </div>
                        <div class="tile-object">
                            <div class="name">
                                <b><?php echo __d('public', 'Briefing') ?></b>
                            </div>
                            <div class="number">
                            </div>
                        </div>
                    </a>


                    <?php if ($user_permission == 'all' || $user_permission == 'manager') { ?>
                        <a href="<?php echo Router::url(array('controller' => 'client_domains', 'action' => 'index', $clientProject['ClientProject']['id'])); ?>" class="tile bg-yellow-gold">
                            <div class="tile-body">
                                <i class="fa fa-line-chart"></i>
                            </div>
                            <div class="tile-object">
                                <div class="name">
                                    <b><?php echo __d('public', 'SEO') ?></b>
                                </div>
                                <div class="number">
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>


        
        




    </div>
