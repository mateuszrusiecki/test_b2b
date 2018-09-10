<!--Modal: Dodawanie notatek-->
<div aria-hidden="false" role="new_note" tabindex="-1" id="new_note" class="modal fade in"><div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            echo $this->Form->create('ClientNote', array(
                'url' => array(
                    'controller' => 'clients',
                    'action' => 'add_client_note'
                ), 'class' => 'form-horizontal'));
            ?>
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo $client_details['Client']['name']; ?> - <?php echo __d('public','nowa notatka');?></h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo __d('public','Tytuł');?></label>
                        <div class="col-md-10">
                            <?php
                            echo $this->Form->input('title', array(
                                'placeholder' => __d('public', 'Wpisz tytuł notatki'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'label' => false,
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo __d('public','Treść');?></label>
                        <div class="col-md-10">
                            <?php
                            echo $this->Form->input('content', array(
                                'placeholder' => __d('public', 'Wpisz treść notatki'),
                                'class' => 'form-control',
                                'label' => false,
                                'required' => 'required'
                            ));
							 //echo $this->FebTinyMce4->input('content', array('name' => 'data[ClientNote][content]', 'id' => 'ClientNoteContent', 'label' => false), 'full');
            
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
