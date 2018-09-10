<?php
echo $this->Html->script('scanner/scanner', array('inline' => false));
echo $this->Html->script('angular/controllers/ScannerCtrl', array('block' => 'angular'));
?>
<!-- Start tabela dokumenty -->
<?php echo $this->element('ClientProjects/add_file_modal') ?>
<?php echo $this->element('ClientProjects/scan_file_modal') ?>
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
                    <?php echo __d('public', 'Faktury sprzedażowe'); ?> </a>
            </li>
            <li>
                <a href="#change_shopping" data-toggle="tab">
                    <?php echo __d('public', 'Faktury zakupowe'); ?> </a>
            </li>
            <li>
                <a href="#change_issuing" data-toggle="tab">
                    <?php echo __d('public', 'Faktury do wystawienia'); ?> </a>
            </li>
        </ul>
        <!--BEGIN TABS-->
        <div class="tab-content">
            <div class="tab-pane active" id="change_document">
                <?php echo $this->element('Hrs/hrs_documents'); ?>
            </div>
            <div class="tab-pane" id="change_sale">
                <div class="table-scrollable table-scrollable-borderless">
                    <?php echo $this->element('Hrs/hrs_invocies', array('type' => 1)); ?>
                </div>
            </div>
            <div class="tab-pane" id="change_shopping">
                <div class="table-scrollable table-scrollable-borderless">
                    <?php echo $this->element('Hrs/hrs_invocies', array('type' => 2)); ?>
                </div>
            </div>
            <div class="tab-pane" id="change_issuing">
                <div class="table-scrollable table-scrollable-borderless">
                    <?php echo $this->element('Hrs/hrs_invocies_issuing', array('type' => 3)); ?>
                </div>
            </div>

            <div class="modal modal1 fade" id="basic" tabindex="-1" role="basic" aria-hidden="true" style="display: none;" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title"><?php echo __d('public', 'Zmień opis faktury') ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="note note-warning" ng-if="desc_error">
                                <p> <?php echo __d('public', 'Wystąpił błąd') ?>. </p>
                            </div>

                            <textarea name="description" ng-model="invoice.description" class="col-md-12 mb5 form-control margin-bottom-10 ng-pristine ng-valid ng-scope ng-touched float-none">
								{{ invoice.description}} </textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn default" data-dismiss="modal"><?php echo __d('public', 'Zamknij') ?></button>
                            <button type="button" ng-click="updateDescription()" class="btn blue"><?php echo __d('public', 'Zapisz') ?></button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal modal2 fade" id="link_invoice_to_project" tabindex="-1" role="link_invoice_to_project" aria-hidden="true" style="display: none;" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title"><?php echo __d('public', 'Przypisz fakturę do projektu') ?></h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            echo $this->Metronic->input('project_id', array(
                                'label' => false,
                                'ng-model' => 'project_id',
                                'class' => 'form-control clear',
                                'type' => 'select',
                                'options' => $projectList,
                                'required' => 'required',
                                'empty' => __d('public', 'wybierz projekt')
                            ));
                            ?>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn default" data-dismiss="modal"><?php echo __d('public', 'Zamknij') ?></button>
                            <button type="button" ng-click="linkInvoiceToProject(project_id)" class="btn blue"><img ng-if="loading" src="/img/loader_orange_blue.gif" alt="loading" /> <?php echo __d('public', 'Zapisz') ?></button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>

<!-- Koniec tabela dokumenty -->