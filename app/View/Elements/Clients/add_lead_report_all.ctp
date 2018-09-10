<!--Modal: Dodawanie notatek-->
<div aria-hidden="false" role="new_note" tabindex="-1" id="new_report" class="modal fade in"><div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            echo $this->Form->create('ClientLeadReport', array(
                'url' => array(
                    'controller' => 'clientLeads',
                    'action' => 'lead_report_all'
                ), 'class' => 'form-horizontal'));
            ?>
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public','Raport - wszystkie leady');?></h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo __d('public','Data od');?></label>
                        <div class="col-md-10">
                            <?php
								echo $this->Metronic->input('date_start', array(
									'label' => false,
									//'placeholder'=> __d('public','Data od'),
									'type' => 'text',
									'class' => 'form-control form-control-inline date-picker input-small',
									'required'=>'required'
								)); 
							?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo __d('public','Data do');?></label>
                        <div class="col-md-10">
                            <?php
								echo $this->Metronic->input('date_end', array(
									'label' => false,
									//'placeholder'=> __d('public','Data do'),
									'type' => 'text',
									'class' => 'form-control form-control-inline date-picker input-small',
								));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public','Zamknij');?></button>
                <?php
                echo $this->Form->input('user_id', array(
                    'value' => $this->Session->read('Auth.User.id'),
                    'type' => 'hidden',
                    'label' => false
                ));
                ?>
                <?php echo $this->Form->submit(__d('public', 'Generuj'), array('class' => 'btn blue', 'div' => false)); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>