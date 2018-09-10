<div class="row">
    <?php echo $this->element('Clients/client_list'); ?>
    <div class="col-md-9 col-xs-12" ng-init="clinet_archived = <?php echo (int) $client_details['Client']['archive']; ?>">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-share font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase pull-left"><?php
                        echo $client_details['Client']['name'];
                        if ($client_details['Client']['archive'])
                            echo __d('public', '(zarchiwizowany)')
                            ?></span> 

                    <div class="actions pull-right">
                        <?php //if(!$client_details['Client']['archive']){    ?>
                        <a href="/clients" class="btn btn-circle red-sunglo btn-sm"><i class="fa-arrow-circle-left fa"></i> <?php echo __d('public', 'Powrót do listy klientów') ?></a>
                        
                        <a class="btn btn-circle red-sunglo " href="#new_lead" data-toggle="modal" ng-disabled="clinet_archived">
                            <i class="fa fa-plus"></i> <?php echo __d('public', 'Nowy lead'); ?> 
                        </a>
                            
                        <a href="#info" data-toggle="modal">
                            <i class="fa fa-info-circle font-blue-hoki font-large info-circle" tooltip-placement="right"> </i> 
                        </a>
                        <?php //}    ?>
                    </div>
                </div>
            </div>
            <div class="portlet-body">

                <?php
                echo $this->Session->flash('note'); // Flash związany z notatkami
                echo $this->Session->flash('contact'); // Flash związany z osobami kontaktowymi
                echo $this->Session->flash('archive'); //Flash archiwizacji klienta
                echo $this->Session->flash('report'); //Flash raportów
                ?>

                <div class="">

                    <div class="">
                        <div id="crm_informacje" class="tab-pane <?php echo!empty($session_note) || (empty($session_note) && empty($session_contact)) ? 'active' : ''; ?>">

                            <h3>
                                <?php echo __d('public', 'Informacje'); ?>
                                <a href="#new_contact" data-toggle="modal" class="new_contact btn btn-sm btn-circle red-sunglo pull-right" ng-disabled="clinet_archived">
                                    <i class="fa fa-plus"></i> <?php echo __d('public', 'Dodaj nową osobę'); ?>
                                </a>
                                <a href="#edit_client" data-toggle="modal" class="edit_client btn btn-sm btn-circle red-sunglo pull-right" ng-disabled="clinet_archived">
                                    <i class="fa fa-edit"></i> <?php echo __d('public', 'Edytuj klienta'); ?>
                                </a>
                            </h3>

                            <?php echo $this->element('Clients/client_contact'); ?>

                            <div class="clearfix"></div>
                            <hr />

                            <?php if ($leads): ?>
                                <div class="actions pull-right">
                                    <a href="#new_report" data-toggle="modal" class="btn btn-sm btn-circle red-sunglo">
                                        <i class="fa fa-plus"></i> <?php echo __d('public', 'Generuj raport'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <h3><?php echo __d('public', 'Lista leadów') ?></h3>
                            <?php echo $this->element('Clients/lead_list'); ?>
                            <div class="clearfix"></div>
                            <hr />

                            <?php if (isset($allProjects)) { ?>
                                <h3><?php echo __d('public', 'Lista projektów') ?></h3>
                                <?php echo $this->element('ClientProjects/table_index_no_ajax'); ?> 
                                <hr />
                            <?php } ?>


                            <h3><?php echo __d('public', 'Płatności') ?></h3>
                            <?php echo $this->element('Payments/table_index'); ?> 
                            <div class="clearfix"></div>
                            <hr/>
                            <h3 class="pull-left" style="margin-top:0 !important;"><?php echo __d('public', 'Notatki'); ?></h3>
                            <div class="actions pull-right">
                                <a href="#new_note" data-toggle="modal" class="btn btn-sm btn-circle red-sunglo " ng-disabled="clinet_archived">
                                    <i class="fa fa-plus"></i> <?php echo __d('public', 'Nowa notatka'); ?>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                            <?php
                            if (!empty($client_notes)):
                                foreach ($client_notes as $note):
                                    ?>
                                    <div class="note note-warning">
                                        <h4 class="block"><?php echo $note['ClientNote']['title']; ?></h4>
                                        <p>
                                            <?php echo nl2br($note['ClientNote']['content']); ?>
                                        </p>
                                        <p>
                                            <a href="#client_note_<?php echo $note['ClientNote']['id']; ?>" data-toggle="modal" class="btn btn-circle btn-sm btn-default"><i class="fa fa-times"></i> <?php echo __d('public', 'Usuń') ?></a>
                                        </p>
                                    </div>
                                    <?php
                                endforeach;
                            else:
                                echo '<em>' . __d('public', 'Brak notatek') . '</em>';
                            endif;
                            ?>
                        </div>
                        <hr/>
                        <div class="clearfix"></div>


                        <a ng-hide="clinet_archived" class="btn btn-circle  btn-default" href="#client_archive" title="<?php echo __d('public', 'Archiwizuj klienta'); ?>" data-toggle="modal">
                            <i class="fa fa-archive red-sunglo"></i>  <?php echo __d('public', 'Archiwizuj klienta'); ?> 
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php echo $this->element('Clients/add_client_lead'); ?>

<?php echo $this->element('Clients/add_lead_report'); ?>

<?php echo $this->element('Clients/add_client_note'); ?>

<?php echo $this->element('Clients/add_client_contact'); ?>
<?php echo $this->element('Clients/edit_client'); ?>

<?php echo $this->element('Clients/edit_and_delete_client_contact'); ?>



<!-- Modale do potwierdzenia usuwania notatek -->
<?php
if (!empty($client_notes)):
    foreach ($client_notes as $note):
        ?>
        <div aria-hidden="true" role="client_note_<?php echo $note['ClientNote']['id']; ?>" tabindex="-1" id="client_note_<?php echo $note['ClientNote']['id']; ?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                        <h4 class="modal-title"><?php echo __d('public', 'Potwierdź usunięcie'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <?php echo __d('public', 'Czy na pewno chcesz usunąć notatkę'); ?>: <?php echo $note['ClientNote']['title']; ?>?
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                        <?php
                        echo $this->Html->link('Potwierdź', array('action' => 'delete_client_note', $note['ClientNote']['id']), array('class' => 'btn blue', 'escape' => false));
                        ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <?php
    endforeach;
endif;
?>


<div aria-hidden="true" role="info" tabindex="-1" id="info" class="modal fade" style="display: none;"><div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="form-horizontal ng-pristine ng-valid" >
                    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>            
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                        <h4 class="modal-title"> <?php echo __d('public', 'Lead') ?></h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <?php echo __d('public', 'Lead jest notatką z działań handlowca z
                            klientem w celu sprzedaży konkretnego produktu, jest prekursorem
                            projektu. Lead jest tworzony gdy klient jest zainteresowany ofertą.
                            Jeden handlowiec tworzy wiele leadów, może ich być wiele dla jednego
                            klienta, a każdy odzwierciedla próbę sprzedaży innego produktu') ?>. 
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    </div>        
                </div>
                <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>
</div>


<div aria-hidden="true" role="client_archive" tabindex="-1" id="client_archive" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Potwierdź archiwizację'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo __d('public', 'Czy na pewno chcesz zarchiwizowac klienta'); ?>: <?php echo $client_details['Client']['name']; ?>?
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                <?php
                echo $this->Html->link('Potwierdź', array('action' => 'archive_client', $client_details['Client']['id']), array('class' => 'btn blue', 'escape' => false));
                ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>