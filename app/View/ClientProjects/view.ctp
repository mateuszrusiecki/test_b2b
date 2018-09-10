

<?php echo $this->element('ClientProjects/view_tiles'); ?>

<div class="row">
    <div class="col-md-12 " ng-controller="TimeLineCtrl">
        <h4><?php echo __d('public', 'Harmonogram realizacji projektu') ?></h4>
        <div class="portlet" ng-init="addRows(<?php echo a($timeline); ?>); addRowsPayment(<?php echo a($timelinePayments); ?>)">
            <div timeline="model"  timeline-options="options" timeline-selection="false"></div>
        </div>
    </div>
</div>

<?php //echo $this->Metronic->portlet(); ?>
<div class="portlet light col-xs-12">
    <div class="tabbable-custom nav-justified">
        <ul class="nav nav-tabs nav-justified">
            <li class="active">
                <a data-toggle="tab" href="#personal" ng-click="section = 0">
                    <?php echo __d('public', 'Cały projekt') ?>
                </a>
            </li>
            <?php
            if ($sections != false)
            {
                foreach ($sections as $section)
                {
                    ?>
                    <li>
                        <a data-toggle="tab" href="#personal" ng-click="section = <?php echo $section['Section']['id']; ?>">
                            <?php echo $section['Section']['name']; ?>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>

        <!--BEGIN TABS-->
        <div class="tab-content">
            <div id="personal" class="tab-pane active">
                <div class="table-scrollable table-scrollable-borderless">
                    <div class="col-md-6">
                        <?php echo $this->Metronic->portlet(__d('public', 'Log projektu'), 0, 'fa fa-info', 'blue'); ?>
                        <?php echo $this->element('ClientProjects/log_list'); ?>
                        <?php echo $this->Metronic->portletEnd(); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Metronic->portlet(__d('public', 'Notatki'), 0, 'fa fa-comments-o', 'purple'); ?>
                        <a id="project_notes" name="project_notes" class="anchor"></a>
                        <?php echo $this->element('ClientProjects/add_project_note'); ?>

                        <?php echo $this->element('ClientProjects/notes_list'); ?>
                        <?php echo $this->Metronic->portletEnd(); ?>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <?php echo $this->element('ClientProjects/document_list'); ?>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <?php echo $this->Metronic->portlet(__d('public', 'Zespół projektowy'), 0, 'fa  fa-users', 'yellow'); ?>
                        <?php if (!empty($section)) { ?>
                            <?php
                            $project_id = $clientProject['ClientProject']['id'];
                            foreach ($sections as $section) { ?>
                                <div ng-show="!(section > 0) || section == <?php echo $section['Section']['id']; ?>">
                                    <h3><?php echo $section['Section']['name'] ?>, koordynator:
                                        <?php echo $section['Supervisor']['Profile']['name'] ?></h3>
                                    <div class="tiles">
                                        <?php
                                        foreach ($section['Profile'] as $profile)
                                        {
                                            echo $this->element('ClientProjects/profile_feb_cart', compact('profile', 'project_id'));
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <h3><?php echo __d('public', 'Kierownik projektu i Handlowiec') ?></h3>
                        <div class="tiles">
                            <?php
                            echo $this->element('ClientProjects/profile_feb_cart', array('profile' => $leader, 'project_id' => $clientProject['ClientProject']['id']));
                            echo $this->element('ClientProjects/profile_feb_cart', array('profile' => $accountManager, 'project_id' => $clientProject['ClientProject']['id']));
                            ?>
                        </div>

                        <h3><?php echo __d('public', 'Osoby kontaktowe klienta') ?></h3>
                        <div class="tiles">
                            <?php
                            $clientContacts = empty($clientContacts) ? array() : $clientContacts;
                            foreach ($clientContacts as $profile)
                            {
                                $profile['Profile']['name'] = $profile['ClientContact']['firstname'] . ' ' . $profile['ClientContact']['surname'];
                                $profile['Profile']['position'] = '<i class="fa fa-at"></i> ' . $profile['ClientContact']['email'];
                                $profile['Profile']['position'] .= ' <br>';
                                $profile['Profile']['position'] .= empty($profile['ClientContact']['phone']) ? '' : '<i class="fa fa-phone"></i> ' . $profile['ClientContact']['phone'];
                                $profile['default'] = 1;
                                echo $this->element('ClientProjects/profile_cart', array('profile' => $profile, 'project_id' => $clientProject['ClientProject']['id']));
                            }
                            ?>
                        </div>
                        <?php echo $this->Metronic->portletEnd(); ?>
                    </div>
                </div>
            </div>
<script type="text/javascript">
    $('.userTile > div > .tile-right').hover(function () {
        $(this).closest('.userTile').addClass('hover');
    }, function () {
        $(this).closest('.userTile').removeClass('hover');
    });
    $('.userTile > div > .tile-left a.btn').hover(function () {
        $(this).closest('.userTile').addClass('hoverLink');
    }, function () {
        $(this).closest('.userTile').removeClass('hoverLink');
    });
</script>
        </div>
    </div>
</div>
<?php //echo $this->Metronic->portletEnd(); ?>
<?php $this->Html->script('jsapi.js', array('inline' => false)); ?>
<?php $this->Html->script('/assets/timeline/timeline-min', array('inline' => false)); ?>
<?php $this->Html->css('/assets/timeline/timeline.css', null, array('inline' => false)); ?>
<?php $this->Html->script('angular/timeline-directive', array('block' => 'angular')); ?>
<?php $this->Html->script('angular/controllers/TimeLineCtrl', array('block' => 'angular')); ?>
<?php $this->Html->script('angular/controllers/ProfileCartCtrl', array('block' => 'angular')); ?>
<?php $this->Html->script('/assets/timeline/timeline-locales', array('inline' => false)); ?>