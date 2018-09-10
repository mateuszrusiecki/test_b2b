<!--Modal: Dodawanie osoby kontaktowej-->
<div aria-hidden="false" role="new_contact" tabindex="-1" id="new_contact" class="modal fade in"><div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo $lead['ClientLead']['name']; ?> - <?php echo __d('public', 'nowa osoba kontaktowa') ?></h4>
            </div>
            <div class="modal-body">
                <div class="tabbable-custom nav-justified">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a data-toggle="tab" href="#tab_1_1_1"><?php echo __d('public', 'Wybierz z listy') ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab_1_1_2"><?php echo __d('public', 'Dodaj nową osobę') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
						<?php if($client_contacts): ?>
                        <div id="tab_1_1_1" class="tab-pane active">
                            <div class="table-scrollable">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo __d('public', 'Imię i nazwisko') ?>
                                            </th>
                                            <th>
                                                <?php echo __d('public', 'Email') ?>
                                            </th>
                                            <th>
                                                <?php echo __d('public', 'Akcja') ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($client_contacts as $client_contact): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $client_contact['ClientContact']['firstname']; ?>
                                                    <?php echo $client_contact['ClientContact']['surname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $client_contact['ClientContact']['email']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $found = 0;
                                                    foreach ($lead_contacts as $lead_contact)
                                                    {
                                                        if ($client_contact['ClientContact']['id'] == $lead_contact['id'])
                                                        {
                                                            $found = 1;
                                                        }
                                                    }
                                                    if ($found)
                                                    {
                                                        echo $this->Html->link('<i class="fa fa-check"></i> '.__d('public', 'Dodano'), array(
                                                            'controller' =>'clients',
                                                            'action' => 'add_lead_contact_list',
                                                                ), array(
                                                            'class' => 'btn btn-circle red-sunglo btn-sm',
                                                            'disabled' => 'disabled',
                                                            'escape' => false
                                                        ));
                                                    } else
                                                    {
                                                        echo $this->Html->link('<i class="fa fa-plus"></i> '.__d('public', 'Dodaj'), array(
                                                            'controller' =>'clients',
                                                            'action' => 'add_lead_contact_list',
                                                            $lead['ClientLead']['id'],
                                                            $client_contact['ClientContact']['id']
                                                                ), array(
                                                            'class' => 'btn btn-circle red-sunglo btn-sm',
                                                            'escape' => false
                                                        ));
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
						<?php endif; ?>
					
                        <div id="tab_1_1_2" class="tab-pane">

                            <?php
                            echo $this->Form->create('ClientContact', array(
                                'url' => array(
                                    'controller' => 'clients',
                                    'action' => 'add_client_contact'
                                ), 'class' => 'form-horizontal'));
                            ?>

                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo __d('public', 'Imię') ?></label>
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
                                    <label class="col-md-3 control-label"><?php echo __d('public', 'Nazwisko') ?></label>
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
                                    <label class="col-md-3 control-label"><?php echo __d('public', 'Email') ?></label>
                                    <div class="col-md-9">
                                        <?php
                                        echo $this->Form->input('email', array(
                                            'placeholder' => __d('public', 'Wpisz adres email'),
                                            'class' => 'form-control',
                                            'type' => 'text',
                                            'label' => false
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo __d('public', 'Telefon') ?></label>
                                    <div class="col-md-9">
                                        <?php
                                        echo $this->Form->input('phone', array(
                                            'placeholder' => __d('public', 'Wpisz numer telefonu'),
                                            'class' => 'form-control',
                                            'type' => 'text',
                                            'label' => false
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo __d('public', 'Telefon dodatkowy') ?></label>
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
                                    <label class="col-md-3 control-label"><?php echo __d('public', 'Notatka') ?></label>
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
                            <?php
                            echo $this->Form->input('client_id', array(
                                'value' => $lead['ClientLead']['client_id'],
                                'type' => 'hidden',
                                'label' => false
                            ));
                            echo $this->Form->input('ClientLead.id', array(
                                'type' => 'hidden',
                                'value' => $lead['ClientLead']['id']
                            ));
                            ?>
                            <?php echo $this->Form->submit(__d('public','Dodaj'), array('class' => 'btn blue pull-right', 'div' => false)); ?>
                            <?php echo $this->Form->end(); ?>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>