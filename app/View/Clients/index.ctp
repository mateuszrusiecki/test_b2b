<div class="row">
    <?php echo $this->element('Clients/client_list'); ?>
    <div class="col-md-9 col-xs-12">
        <?php
        // Flash związany z klientem
        echo $this->Session->flash('client');
        echo $this->Session->flash('delete');
        ?>
        <div class="note note-info">
            <h4 class="block"><?php echo __d('public', 'Informacja') ?></h4>
            <p>
                <?php echo __d('public', 'Wybierz klienta z listy, aby zobaczyć szczegóły lub') ?>:<br />
            </p>
            <p>
                <a href="#new_client" data-toggle="modal" class="btn btn-circle red-sunglo btn-sm"><i class="fa-plus fa"></i> <?php echo __d('public', 'Dodaj klienta') ?></a>
                <a href="/clients/archive" class="btn btn-circle red-sunglo btn-sm"><i class="fa-archive fa"></i> <?php echo __d('public', 'Zobacz zarchiwizowanych klientów') ?></a>
            </p>
        </div>
    </div>
</div>

<!--Modal: Dodawanie klienta-->
<div aria-hidden="false" role="new_client" tabindex="-1" id="new_client" class="modal fade in"><div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            echo $this->Form->create('Client', array(
                'url' => array(
                    'controller' => 'clients',
                    'action' => 'add_client'
                ), 'class' => 'form-horizontal'));
            ?>
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Dodawanie klienta') ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public', 'Nazwa') ?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('name', array(
                                'placeholder' => __d('public', 'Wpisz nazwę'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public', 'Ulica') ?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('street', array(
                                'placeholder' => __d('public', 'Wpisz ulicę'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public', 'Kod pocztowy') ?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('zipcode', array(
                                'placeholder' => __d('public', 'Wpisz kod pocztowy'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public', 'Miasto') ?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('city', array(
                                'placeholder' => __d('public', 'Wpisz miasto'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public', 'Państwo') ?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('country', array(
                                'placeholder' => __d('public', 'Wpisz państwo') ,
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public', 'Telefon kom.') ?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('phone', array(
                                'placeholder' => __d('public', 'Wpisz telefon komórkowy(do powiadomień sms)') ,
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public', 'Strona WWW') ?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('site', array(
                                'placeholder' => __d('public', 'Wpisz adres WWW'),
                                'class' => 'form-control',
                                'label' => false,
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public', 'Email') ?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('email', array(
                                'placeholder' => __d('public', 'Wpisz adres email'),
                                'class' => 'form-control',
                                'label' => false
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                <?php
                echo $this->Form->input('account_manager_id', array(
                    'value' => $this->Session->read('Auth.User.id'),
                    'type' => 'hidden',
                    'label' => false
                ));
                ?>
                <?php echo $this->Form->submit(__d('public', 'Zapisz'), array('class' => 'btn blue', 'div' => false)); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>