<!-- Modale do potwierdzenia usuwania osób kontaktowych -->
<?php
if (!empty($lead_contacts)):
    foreach ($lead_contacts as $lead_contact):
        ?>
        <div aria-hidden="true" role="lead_contact_<?php echo $lead_contact['id']; ?>" tabindex="-1" id="lead_contact_<?php echo $lead_contact['id']; ?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                        <h4 class="modal-title"><?php echo __d('public', 'Potwierdź usunięcie'); ?></h4>
                    </div>
                    <div class="modal-body">
						<?php echo __d('public', 'Czy na pewno chcesz usunąć osobę kontaktową'); ?>: <?php echo $lead_contact['firstname'] . ' ' . $lead_contact['surname']; ?>?
					</div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
						<?php 
						if(isset($lead['ClientLead']['id'])){
							echo $this->Html->link('Potwierdź', array('controller' => 'client_leads','action' => 'delete_lead_contact', $lead['ClientLead']['id'],$lead_contact['id']), array('class' => 'btn blue', 'escape' => false));
						} else {
							echo $this->Html->link('Potwierdź', array('controller' => 'clients','action' => 'delete_client_contact', $lead_contact['id']), array('class' => 'btn blue', 'escape' => false));
						}
						?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


		<div aria-hidden="true" role="edit_lead_contact_<?php echo $lead_contact['id']; ?>" tabindex="-1" id="edit_lead_contact_<?php echo $lead_contact['id']; ?>" class="modal fade">
			<div class="modal-dialog">
			<div class="modal-content">
				<?php echo $this->Form->create('ClientContact', array(
					'url' => array(
						'controller' => 'clients',
						'action' => 'add_client_contact'
					), 'class' => 'form-horizontal'));
				?>
					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
						<h4 class="modal-title"><?php echo $lead['ClientLead']['name']; ?> - <?php echo __d('public', 'edytuj osobę kontaktową'); ?></h4>
					</div>
					<div class="modal-body">

						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo __d('public', 'Imię') ?></label>
								<div class="col-md-9">
									<?php echo $this->Form->input('firstname', array(
										'placeholder' => __d('public', 'Wpisz imię'),
										'class' => 'form-control',
										'type' => 'text',
										'label' => false,
										'value' => $lead_contact['firstname'],
										'required' => 'required'
									)); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo __d('public', 'Nazwisko') ?></label>
								<div class="col-md-9">
									<?php echo $this->Form->input('surname', array(
										'placeholder' => __d('public', 'Wpisz nazwisko'),
										'class' => 'form-control',
										'type' => 'text',
										'label' => false,
										'value' => $lead_contact['surname'],
										'required' => 'required'
									)); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo __d('public', 'Email') ?></label>
								<div class="col-md-9">
									<?php echo $this->Form->input('email', array(
										'placeholder' => __d('public', 'Wpisz adres email'),
										'class' => 'form-control',
										'type' => 'text',
										'value' => $lead_contact['email'],
										'label' => false
									)); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo __d('public', 'Telefon') ?></label>
								<div class="col-md-9">
									<?php echo $this->Form->input('phone', array(
										'placeholder' => __d('public', 'Wpisz numer telefonu'),
										'class' => 'form-control',
										'type' => 'text',
										'value' => $lead_contact['phone'],
										'label' => false
									)); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo __d('public', 'Telefon dodatkowy') ?></label>
								<div class="col-md-9">
									<?php echo $this->Form->input('phone2', array(
										'placeholder' => __d('public', 'Wpisz dodatkowy numer telefonu'),
										'class' => 'form-control',
										'type' => 'text',
										'value' => $lead_contact['phone2'],
										'label' => false
									)); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo __d('public', 'Notatka') ?></label>
								<div class="col-md-9">
									<?php echo $this->Form->input('note', array(
										'placeholder' => __d('public', 'Wpisz treść notatki'),
										'class' => 'form-control',
										'value' => $lead_contact['note'],
										'label' => false
									)); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public','Zamknij');?></button>
						<?php
						echo $this->Form->input('client_id', array(
							'value' => $lead['ClientLead']['id'],
							'type' => 'hidden',
							'label' => false
						));
						echo $this->Form->input('id', array(
							'value' => $lead_contact['id'],
							'type' => 'hidden',
							'label' => false
						));
						echo $this->Form->input('ClientLead.id', array(
							'type' => 'hidden',
							'value' => $lead['ClientLead']['id']
						));
						?>
						<?php echo $this->Form->submit(__d('public', 'Zapisz'), array('class' => 'btn blue', 'div' => false)); ?>
					</div>
				<?php echo $this->Form->end(); ?>
			</div>
			<!-- /.modal-content -->
		</div>
		</div>
        <?php
    endforeach;
endif;
?>