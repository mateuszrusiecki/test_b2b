
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

                        <div class="portlet light panel_pm">


                            <?php if ($login_to_pm): ?>
                                <div class="login_form">
                                    <?php echo $this->element('Pm/login'); ?>
                                </div>
                            <?php else: ?>

                                <div class="">
                                </div>

                                <div class="portlet-title caption-subject list-group-item pm_title">

                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public', 'Podsumowanie zadań w systemie PM'); ?> </span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <form ng-submit="submit()" ng-controller="MainCtrl">
                                                <?php
                                                echo $this->Metronic->input('search_box', array(
                                                    //'label' => __d('public','Szukaj'),
                                                    'placeholder' => __d('public', 'Szukaj'),
                                                    'type' => 'text',
                                                    'ng-model' => 'name',
                                                    'class' => ' form-control form-control-inline',
                                                ));
                                                ?>
                                            </form>
                                        </div>	

                                        <div class="col-md-6" ng-controller="MainCtrl">
                                            <?php
                                            echo $this->Metronic->input('project_quick_jump_box', array(
                                                'class' => 'form-control col-md-3',
                                                'options' => $projects,
                                                'type' => 'select',
                                                'ng-change' => 'jump()',
                                                'ng-model' => 'projects',
                                                'ng-init' => 'projects = 0',
                                            ));
                                            ?> 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" id="assigned_to_me">
                                    <?php echo $this->Metronic->portlet(__d('public','Zadania przypisane do mnie'), 1); ?>
                                    <div class="table-scrollable" id="issuesAssignedTo">
                                        <?php if (isset($issuesAssignedTo['issues'][0])): ?>
                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                <thead>  
                                                    <tr>
                                                        <th><?php echo __d('public', '#'); ?> </th>
                                                        <th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Projekt'); ?></th>
                                                        <th><i class="fa fa-signal"></i> <?php echo __d('public', 'Priorytet'); ?></th>
                                                        <th><i class="fa fa-calendar"></i> <?php echo __d('public', 'Termin'); ?></th>
                                                        <th><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Temat'); ?></th>
                                                        <th><i class="fa fa-user"></i> <?php echo __d('public', 'Osoba przypisująca'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($issuesAssignedTo['issues'] as $issue):
                                                        ?>
                                                        <tr data-id="<?php //echo $vac['Vacation']['id'];        ?>" class="status_<?php echo $issue['tracker']['id'] ?> priority_<?php echo $issue['priority']['id'] ?>">
                                                            <td><?php echo $issue['id'] ?></td>
                                                            <td><?php echo $issue['project']['name'] ?></td>
                                                            <td><?php echo $issue['priority']['name'] ?></td>
                                                            <td class="<?php
                                                            if (isset($issue['due_date']) && $issue['due_date'] < date('Y-m-d')): echo 'exceeded';
                                                            endif;
                                                            ?>"><?php
                                                                    if (isset($issue['due_date']))
                                                                        echo $issue['due_date'];
                                                                    else
                                                                        echo " - ";
                                                                    ?></td>
                                                            <td><a href="http://pm.feb.net.pl/issues/<?php echo $issue['id'] ?>" target="blank"><?php echo $issue['subject'] ?></a></td>
                                                            <td><?php echo $issue['author']['name'] ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php else: ?>
                                            <div class="note note-info">
                                                <h4><?php echo __d('public', 'W tym momencie brak zadań przypisanych'); ?></h4>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php echo $this->Metronic->portletEnd(); ?>
                                </div>


                                <div class="col-md-12" id="added_by_me">
                                    <?php echo $this->Metronic->portletHiden(__d('public','Zadania utworzone przeze mnie'), 1); ?>
                                    <div class="table-scrollable">

                                        <?php if (isset($issuesReported['issues'][0])): ?>
                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo __d('public', '#'); ?> </th>
                                                        <th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Projekt'); ?></th>
                                                        <th><i class="fa fa-signal"></i> <?php echo __d('public', 'Priorytet'); ?></th>
                                                        <th><i class="fa fa-calendar"></i> <?php echo __d('public', 'Termin'); ?></th>
                                                        <th><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Temat'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($issuesReported['issues'] as $issue):
                                                        ?>
                                                        <tr data-id="<?php //echo $vac['Vacation']['id'];        ?>" class="status_<?php echo $issue['tracker']['id'] ?> priority_<?php echo $issue['priority']['id'] ?>">
                                                            <td><?php echo $issue['id'] ?></td>
                                                            <td><?php echo $issue['project']['name'] ?></td>
                                                            <td><?php echo $issue['priority']['name'] ?></td>
                                                            <td class="<?php
                                                            if (isset($issue['due_date']) && $issue['due_date'] < date('Y-m-d')): echo 'exceeded';
                                                            endif;
                                                            ?>"><?php
                                                                    if (isset($issue['due_date']))
                                                                        echo $issue['due_date'];
                                                                    else
                                                                        echo " - ";
                                                                    ?></td>
                                                            <td><a href="http://pm.feb.net.pl/issues/<?php echo $issue['id'] ?>" target="blank"><?php echo $issue['subject'] ?></a></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php else: ?>
                                            <div class="note note-info">
                                                <h4><?php echo __d('public', 'W tym momencie brak zadań przypisanych'); ?></h4>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php echo $this->Metronic->portletEnd(); ?>

                                </div>

                                <div class="clear clearfix"></div>

                            <?php endif; ?>
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