<!--Modal: Dodawanie osoby kontaktowej-->
<div aria-hidden="false" role="new_contact" tabindex="-1" id="new_contact" class="modal fade in"><div class="modal-backdrop fade in"></div>
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
                <h4 class="modal-title"><?php echo $client_details['Client']['name']; ?> - <?php echo __d('public','nowa osoba kontaktowa');?></h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public','Imię');?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('firstname', array(
                                'placeholder' => __d('public', 'Wpisz imię'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
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
                                'placeholder' => __d('public', 'Wpisz nazwisko'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
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
                ?>
                <?php echo $this->Form->submit('Zapisz', array('class' => 'btn blue', 'div' => false)); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>