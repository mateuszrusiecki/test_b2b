<!--Modal: Dodawanie leadu-->
<div aria-hidden="false" role="new_lead" tabindex="-1" id="new_lead" class="modal fade in"><div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            echo $this->Form->create('ClientLead', array(
                'url' => array(
                    'controller' => 'client_leads',
                    'action' => 'add'
                ), 'class' => 'form-horizontal'));
            ?>
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo $client_details['Client']['name']; ?> - <?php echo __d('public','nowy lead');?></h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __d('public','Nazwa');?></label>
                        <div class="col-md-8">
                            <?php
                            echo $this->Form->input('name', array(
                                'class' => 'form-control',
                                'label' => false,
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __d('public','Kategoria');?></label>
                        <div class="col-md-8">
                            <?php
                            echo $this->Form->input('lead_category_id', array(
                                'class' => 'form-control',
                                'label' => false,
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __d('public','Status');?></label>
                        <div class="col-md-8">
                            <?php
                            echo $this->Form->input('lead_status_id', array(
                                'class' => 'form-control',
                                'label' => false,
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __d('public','Szansa');?>(%)</label>
                        <div class="col-md-8">
                            <?php
                            echo $this->Form->input('probability', array(
                                'class' => 'form-control',
                                'label' => false,
                                'type' => 'select',
                                'empty' => __d('public', 'wybierz'),
                                'required' => 'required',
                                'options' => array(
                                    10 => 10,
                                    20 => 20,
                                    30 => 30,
                                    40 => 40,
                                    50 => 50,
                                    60 => 60,
                                    70 => 70,
                                    80 => 80,
                                    90 => 90,
                                    100 => 100
                                )
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __d('public','Wartość');?></label>
                        <div class="col-md-8">
                            <?php
                            echo $this->Form->input('amount', array(
                                'class' => 'form-control',
                                'label' => false,
                                'type' => 'text',
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __d('public','Waluta');?></label>
                        <div class="col-md-8">
                            <?php
                            echo $this->Form->input('currency_id', array(
                                'class' => 'form-control',
                                'label' => false,
                                'required' => 'required'
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
                echo $this->Form->input('user_id', array(
                    'value' => $this->Session->read('Auth.User.id'),
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