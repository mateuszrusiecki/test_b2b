<!-- Modale do potwierdzenia usuwania osób kontaktowych -->
<?php
if (!empty($client_contacts)):
    foreach ($client_contacts as $client_contact):
        ?>
        <div aria-hidden="true" role="client_contact_<?php echo $client_contact['ClientContact']['id']; ?>" tabindex="-1" id="client_contact_<?php echo $client_contact['ClientContact']['id']; ?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                        <h4 class="modal-title"><?php echo __d('public', 'Potwierdź usunięcie'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <?php echo __d('public', 'Czy na pewno chcesz usunąć osobę kontaktową'); ?>: <?php echo $client_contact['ClientContact']['firstname'] . ' ' . $client_contact['ClientContact']['surname']; ?>?
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                        <?php
                        echo $this->Html->link('Potwierdź', array('action' => 'delete_client_contact', $client_contact['ClientContact']['id']), array('class' => 'btn blue', 'escape' => false));
                        ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div aria-hidden="true" role="edit_client_contact_<?php echo $client_contact['ClientContact']['id']; ?>" tabindex="-1" id="edit_client_contact_<?php echo $client_contact['ClientContact']['id']; ?>" class="modal fade">
            <div class="modal-dialog">
        <div class="modal-content">
            <?php
            echo $this->Form->create('ClientContact', array(
                'url' => array(
                    'controller' => 'clients',
                    'action' => 'add_client_contact'
                ), 'class' => 'form-horizontal'));
            ?>
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo $client_details['Client']['name']; ?> - <?php echo __d('public','edytuj osobę kontaktową');?></h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public','Imię');?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('firstname', array(
                                'placeholder' =>  __d('public','Wpisz imię'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
								'value' => $client_contact['ClientContact']['firstname'],
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public','Nazwisko');?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('surname', array(
                                'placeholder' =>  __d('public','Wpisz nazwisko'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
								'value' => $client_contact['ClientContact']['surname'],
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public','Email');?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('email', array(
                                'placeholder' => __d('public', 'Wpisz adres email'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
								'value' => $client_contact['ClientContact']['email'],
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public','Telefon');?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('phone', array(
                                'placeholder' => __d('public', 'Wpisz numer telefonu'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
								'value' => $client_contact['ClientContact']['phone'],
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public','Telefon dodatkowy');?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('phone2', array(
                                'placeholder' => __d('public', 'Wpisz dodatkowy numer telefonu'),
                                'class' => 'form-control',
                                'type' => 'text',
								'value' => $client_contact['ClientContact']['phone2'],
                                'label' => false
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public','Notatka');?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('note', array(
                                'placeholder' => __d('public', 'Wpisz treść notatki'),
                                'class' => 'form-control',
								'value' => $client_contact['ClientContact']['note'],
                                'label' => false
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public','Zamknij');?></button>
                <?php
                echo $this->Form->input('client_id', array(
                    'value' => $client_details['Client']['id'],
                    'type' => 'hidden',
                    'label' => false
                ));
				
                echo $this->Form->input('id', array(
                    'value' => $client_contact['ClientContact']['id'],
                    'type' => 'hidden',
                    'label' => false
                ));
                ?>
                <?php echo $this->Form->submit('Zapisz', array('class' => 'btn blue', 'div' => false)); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
            <!-- /.modal-dialog -->
        </div>
        <?php
    endforeach;
endif;
?>