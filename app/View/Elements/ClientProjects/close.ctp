
<?php
if (!$clientProject['ClientProject']['close_realization'] && ($user_permission == 'all' || $user_permission = 'manager'))
{
    ?>
    <?php if (($clientProject['ClientProject']['user_id'] == $user_id) || $user_permission == 'all'): ?>
        <!--<span  ng-click="closeProjectModalCheck(<?php echo $clientProject['ClientProject']['id'] ?>)"  class="tile bg-red-intense pointer">-->
        <a href="" ng-click="closeProjectModalCheck(<?php echo $clientProject['ClientProject']['id'] ?>)">
        <?php else: ?>
            <!--<span class="tile bg-grey pointer" tooltip="<?php echo __d('public', 'Projekt może zakończyć tylko koordynator projektu') ?>">-->
            <a href="">
            <?php endif ?>

            <i class="fa fa-power-off font-white font-large" tooltip="<?php echo __d('public', 'Zakończ projekt'); ?>"></i>
        </a>
        <?php //modal potwierdzenie wyboru  ?>
        <div ng-cloak class="modal-backdrop fade in ng-cloak" ng-show="closeProjectModal"></div>
        <div ng-cloak  aria-hidden="true" tabindex="-1" ng-show="closeProjectModal" class="angular-modal ng-cloak font-black text-left">
            <!--<div id="sessionTimeout-dialog" class="modal ng_modal fade in" ng-class="projCloseRealization ? 'in' : ''" aria-hidden="false">-->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" ng-click="closeProjectModal = false;" class="close" type="button">×</button>
                        <h4 class="modal-title"><?php echo __d('public', 'Zamykanie projektu') ?></h4>
                    </div>
                    <form method="post" action="<?php echo $this->Html->url(array('action' => 'close_realization', 1)); ?>" >
                        <?php echo $this->Form->input('ClientProject.id', array('value' => $clientProject['ClientProject']['id'], 'type' => 'hidden')) ?>
                        <?php echo $this->Form->input('ClientProject.name', array('value' => $clientProject['ClientProject']['name'], 'type' => 'hidden')) ?>
                        <?php echo $this->Form->input('ClientProject.acceptance_report', array('value' => $clientProject['ClientProject']['acceptance_report'], 'type' => 'hidden')) ?>
                        <div class="modal-body">
                            <p><?php echo __d('public', 'Czy jesteś pewien, że chcesz zamknąć projekt') ?> <?php echo $clientProject['ClientProject']['name'] ?>?</p>
                            <?php echo empty($supervisor['Section']['email']) ? '' : $this->Form->input('ClientProject.supervisor_email', array('value' => $supervisor['Section']['email'], 'type' => 'hidden')) ?>
                            <div class="note note-danger" ng-hide="closeProjectModalSupervisor">
                                <i class="fa  fa-exclamation-triangle "></i>
                                <b><?php echo __d('public', 'Uwaga') ?>!</b><br>
                                <?php echo __d('public', 'Brak protokołu odbioru/umowy') ?>. <b><?php echo empty($supervisor['Section']['profile_name']) ? '' : ($supervisor['Section']['profile_name']) ?></b> 
                                <?php echo __d('public', 'otrzyma powiadomienie') ?>.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn default" type="button"  ng-click="closeProjectModal = false;"><?php echo __d('public', 'Anuluj') ?></button>
                            <button class="btn blue" type="submit" ><?php echo __d('public', 'OK') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    <?php } ?>
    <?php
    if ($clientProject['ClientProject']['close_realization'] && ($user_permission == 'all' || $user_permission == 'manager'))
    {
        ?>
        <i class="fa fa-toggle-on  font-white font-large pointer"  onClick="javascript:document.getElementById('openClientProject').submit();">
            <form method="post" id="openClientProject" action="<?php echo $this->Html->url(array('action' => 'close_realization', 0)); ?>" class="tile bg-red-intense">
                <?php echo $this->Form->input('ClientProject.id', array('value' => $clientProject['ClientProject']['id'], 'type' => 'hidden')) ?>
                <?php echo $this->Form->input('ClientProject.acceptance_report', array('value' => $clientProject['ClientProject']['acceptance_report'], 'type' => 'hidden')) ?>
            </form>
        </i>
    <?php } ?> 

