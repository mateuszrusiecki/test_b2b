
<div class="contact_data col-md-3">
		<h3 class="text-center"><?php echo $lead['ClientLead']['name']; ?></h3>
		<div class="text-center">
			<address>
				<h4><strong><?php echo __d('public', 'Status'); ?>: <?php echo $lead['LeadStatus']['name']; ?></strong></h4>
				<h5><?php echo __d('public', 'Kategoria'); ?>: <?php echo $lead['LeadCategory']['name']; ?></h5>
				<h5><?php echo __d('public', 'Wartość'); ?>: <?php echo $lead['ClientLead']['amount'] . ' ' . $lead['Currency']['code']; ?></h5>	
			</address>
		</div>
</div>

<div class="lead_informacje_contact_list jcarousel margin-bottom-10 col-md-9">
	<ul>
	<?php if (!empty($lead_contacts)): ?>
		<?php foreach ($lead_contacts as $lead_contact):?>
			<li>
				<div class="todo-tasklist-item todo-tasklist-item-border-green">

					<div class="todo-tasklist-item-text">
					<h3 class="text-center"><?php echo $lead_contact['firstname'] . ' ' . $lead_contact['surname']; ?></h4>
					<p>
						<span class="icon-envelope" aria-hidden="true"></span>
						<?php echo!empty($lead_contact['email']) ? $lead_contact['email'] : '<em>'.__d('public', 'Brak').'</em>'; ?><br/>

						<span class="icon-call-end" aria-hidden="true"></span>
						<?php echo!empty($lead_contact['phone']) ? $lead_contact['phone'] : '<em>'.__d('public', 'Brak').'</em>'; ?><br/>

						<span class="icon-call-end" aria-hidden="true"></span>
						<?php echo!empty($lead_contact['phone2']) ? $lead_contact['phone2'] : '<em>'.__d('public', 'Brak').'</em>'; ?><br/>

						<span class="icon-note" aria-hidden="true"></span><?php echo __d('public', 'Dodatkowe informacje'); ?> :<br />
						<?php echo!empty($lead_contact['note']) ? $lead_contact['note'] : '<em>'.__d('public', 'Brak').'</em>'; ?>
					</p>
					<p>
						<a href="#lead_contact_<?php echo $lead_contact['id']; ?>" data-toggle="modal" title="<?php echo __d('public', 'Usuń'); ?>"><i class="fa fa-times"></i></a>
						<a href="#edit_lead_contact_<?php echo $lead_contact['id']; ?>" data-toggle="modal" title="<?php echo __d('public', 'Edytuj'); ?>"><i class="fa fa-edit"></i></a>
					</p>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	<?php else:
		echo '<div class="col-xs-12"><em>'.__d('public', 'Brak osób kontaktowych').'</em></div>';
	endif;?>
	</ul>
</div>


<?php if($client_contacts): ?>
	<a class="jcarousel-next btn btn-icon-only default pull-right" href="#"><i class="fa fa-angle-right"></i></i></a>
	<a class="jcarousel-prev btn btn-icon-only default pull-right" href="#"><i class="fa fa-angle-left"></i></a>
<?php endif; ?>
