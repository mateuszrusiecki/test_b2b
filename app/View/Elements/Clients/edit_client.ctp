<!--Modal: Dodawanie klienta-->
<?php
if (empty($client_details['Client']['comarch_id']))
{
    ?>
    <div aria-hidden="false" role="edit_client" tabindex="-1" id="edit_client" class="modal fade in"><div class="modal-backdrop fade in"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <?php
                echo $this->Form->create('Client', array(
                    'url' => array(
                        'controller' => 'clients',
                        'action' => 'edit_client'
                    ), 'class' => 'form-horizontal'));
                echo $this->Form->hidden('id', array('value' => $client_details['Client']['id']));
                ?>
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Edycja danych klienta') ?></h4>
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
                                    'default' => $client_details['Client']['name'],
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
                                    'default' => $client_details['Client']['street'],
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
                                    'default' => $client_details['Client']['zipcode'],
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
                                    'default' => $client_details['Client']['city'],
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
                                    'placeholder' => __d('public', 'Wpisz państwo'),
                                    'class' => 'form-control',
                                    'type' => 'text',
                                    'default' => $client_details['Client']['country'],
                                    'label' => false
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo __d('public', 'Telefon kom') ?>.</label>
                            <div class="col-md-9">
                                <?php
                                echo $this->Form->input('phone', array(
                                    'placeholder' => __d('public', 'Wpisz telefon'),
                                    'class' => 'form-control',
                                    'type' => 'text',
                                    'label' => false,
                                    'default' => $client_details['Client']['phone'],
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
                                    'default' => $client_details['Client']['site'],
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
                                    'default' => $client_details['Client']['email'],
                                    'label' => false
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo __d('public', 'NIP') ?></label>
                        <div class="col-md-9">
                            <?php
                            echo $this->Form->input('nip', array(
                                'placeholder' => __d('public', 'Wpisz NIP'),
                                'class' => 'form-control',
                                'default'=>$client_details['Client']['nip'],
                                'label' => false
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    <?php
                    echo $this->Form->input('account_manager_id', array(
                        'default' => $client_details['Client']['account_manager_id'],
                        'type' => 'hidden',
                        'label' => false
                    ));
                    echo $this->Form->input('user_id', array(
                        'default' => $client_details['Client']['user_id'],
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
    <?php
} else
{
    ?>
    <div aria-hidden="false" role="edit_client" tabindex="-1" id="edit_client" class="modal fade in"><div class="modal-backdrop fade in"></div>

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Edycja'); ?></h4>
                </div>
                <div class="modal-body">
                    Nie ma możliwości edycji, klient jest w sytemie optima, aby zmienić dane nalezy udać się do sekretariatu i zmienić w sytemie optima po zmianie danych w sekretaracie należy pobrać zmiany
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    <a class="btn btn-danger" href="/clients/connect_client_to_optima/<?php echo $client_details['Client']['id']; ?>">Pobierz zmiany</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
<?php } ?>