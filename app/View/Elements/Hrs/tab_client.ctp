<?php echo $this->Metronic->portlet(__d('public', 'Lista dokumentów')); ?>
<div class="portlet-body">
    <div class="tabbable-custom nav-justified">
        <ul class="nav nav-tabs nav-justified">
            <li class="active">
                <a href="#change_document" data-toggle="tab">
                    <?php echo __d('public', 'Dokumenty'); ?> </a>
            </li>
            <li>
                <a href="#change_sale" data-toggle="tab">
                    <?php echo __d('public', 'Faktury'); ?> </a>
            </li>
        </ul>
        <!--BEGIN TABS-->
        <div class="tab-content" ng-init="user_permission = '<?php echo $_SESSION['user_permission'] ?>'">
            <div class="tab-pane active" id="change_document">
                <?php echo $this->element('Hrs/hrs_documents'); ?>
            </div>
            <div class="tab-pane" id="change_sale">
                <div class="table-scrollable table-scrollable-borderless">
                    <?php echo $this->element('Hrs/hrs_invocies', array('type' => 1)); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>

<!-- Koniec tabela dokumenty -->