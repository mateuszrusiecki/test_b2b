<div class="contact_data col-md-3">
	<span class="text-center">&nbsp;<?php //echo __d('public', 'Dane kontaktowe'); ?></span>
	<div class="text-center">
		<address>
			<h4><strong class="client_name"><?php echo $client_details['Client']['name']; ?></strong></h4>
			<?php echo $client_details['Client']['street']; ?><br />
			<?php echo $client_details['Client']['zipcode']; ?> <?php echo $client_details['Client']['city']; ?><br />
			<abbr title="Telefon">Tel:</abbr> <?php echo $client_details['Client']['phone']; ?><br />
			<a href="mailto:<?php echo $client_details['Client']['email']; ?>?bcc=crm@feb.net.pl">
				<?php echo $client_details['Client']['email']; ?></a>
		</address>
	</div>
</div>

<div class="crm_informacje_contact_list jcarousel margin-bottom-10 col-md-9">
	<ul>
		
		<?php if($client_contacts): ?>
		<?php foreach ($client_contacts as $client_contact) { ?>
				<li>
					<div class="todo-tasklist-item todo-tasklist-item-border-green">

						<div class="todo-tasklist-item-text">
							<h3 class="text-center"><?php echo $client_contact['ClientContact']['firstname'] . ' ' . $client_contact['ClientContact']['surname']; ?></h3>
							<div class="text-left">

									<span class="icon-envelope" aria-hidden="true"></span>
										<?php echo!empty($client_contact['ClientContact']['email']) ? $client_contact['ClientContact']['email'] : '<em>'.__d('public', 'Brak').'</em>'; ?><br />

										<span class="icon-call-end" aria-hidden="true"></span>
										<?php echo!empty($client_contact['ClientContact']['phone']) ? $client_contact['ClientContact']['phone'] : '<em>'.__d('public', 'Brak').'</em>'; ?><br />

										<span class="icon-call-end" aria-hidden="true"></span>
										<?php echo!empty($client_contact['ClientContact']['phone2']) ? $client_contact['ClientContact']['phone2'] : '<em>'.__d('public', 'Brak').'</em>'; ?><br />

										<span class="icon-note" aria-hidden="true"></span> <?php echo __d('public', 'Dodatkowe informacje'); ?>:<br />
										<?php echo!empty($client_contact['ClientContact']['note']) ? $client_contact['ClientContact']['note'] : '<em>'.__d('public', 'Brak').'</em>'; ?><br /><br />

										<a href="#client_contact_<?php echo $client_contact['ClientContact']['id']; ?>" data-toggle="modal" title="<?php echo __d('public', 'Usuń'); ?>"><i class="fa fa-times"></i></a>

										<a href="#edit_client_contact_<?php echo $client_contact['ClientContact']['id']; ?>" data-toggle="modal" title="<?php echo __d('public', 'Edytuj'); ?>"><i class="fa fa-edit"></i></a>

							</div>
						</div>
					</div>

				<?php // echo $year . "-" . $month . ": " . $work_hours . "<br />"; ?>
				</li>
		<?php } ?>
	<?php endif; ?>
	</ul>
</div>

<?php if($client_contacts): ?>
	<a class="jcarousel-next btn btn-icon-only default pull-right" href="#"><i class="fa fa-angle-right"></i></i></a>
	<a class="jcarousel-prev btn btn-icon-only default pull-right" href="#"><i class="fa fa-angle-left"></i></a>
<?php endif; ?>
