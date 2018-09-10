
<?php if($leads): ?>
	<div class="table-scrollable" id="lead_list">
		<table class="table table-striped table-bordered table-advance table-hover" id="leads_list">
			<thead>
				<tr>
					<th>
						<i class="fa fa-info-circle font-red-sunglo font-large info-circle"
                           tooltip-html-unsafe="<?php echo __d('public', 'Mail do leadu:<br/> aby wysłac mail do leadu należy<br/> wpisać adres crm@febdev.pl <br/>a w tytule podać <br/> poniższe oznaczenie np. #7') ?>">
                        </i> 
					</th>
					<th>
						<i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa'); ?>
					</th>
					<th>
						<i class="fa fa-inbox "></i> <?php echo __d('public', 'Kategoria'); ?>
					</th>
					<th>
						<i class="fa fa-bar-chart-o "></i> <?php echo __d('public', 'Status'); ?>
					</th>
					<th>
						<i class="fa fa-question "></i> <?php echo __d('public', 'Szansa'); ?>(%)
					</th>
					<th>
						<i class="fa fa-money  "></i> <?php echo __d('public', 'Kwota'); ?>
					</th>
					<th>
						<i class="fa fa-dollar "></i> <?php echo __d('public', 'Waluta'); ?>
					</th>
					<th>
						<i class="fa fa-user"></i> <?php echo __d('public', 'Handlowiec'); ?>
					</th>
					<th>
						<i class="fa fa-user"></i> <?php echo __d('public', 'Założony'); ?>
					</th>
					<th>
						<i class="fa fa-cog"></i> <?php echo __d('public', 'Opcje'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; ?>
				<?php foreach ($leads as $lead): ?>
					<tr>
						<td>
							#<?php echo $lead['ClientLead']['id']; ?>
						</td>
						<td class="highlight">
							<?php echo $lead['ClientLead']['name'] ?>
						</td>
						<td>
							<?php echo $leadCategories[$lead['ClientLead']['lead_category_id']]; ?>
						</td>
						<td>
							<?php echo $leadStatuses[$lead['ClientLead']['lead_status_id']]; ?>
						</td>
						<td>
							<?php echo $lead['ClientLead']['probability']; ?>
						</td>
						<td>
							<?php echo $lead['ClientLead']['amount']; ?>
						</td>
						<td>
							<?php echo $currencies[$lead['ClientLead']['currency_id']]; ?>
						</td>
						<td>
							<?php echo $lead['Profile']['firstname'] . ' ' . $lead['Profile']['surname']; ?>
						</td>
						<td>
							<?php echo date('Y-m-d',strtotime($lead['ClientLead']['created'])); ?>
						</td>
						<td>
                            <a href="mailto:<?php echo $client_details['Client']['email']; ?>?subject=Lead #<?php echo $lead['ClientLead']['id']; ?>&bcc=crm@feb.net.pl" tooltip="Mail do klienta, który zostanie umieszczny w logu leadu"><i class="fa fa-envelope-o"></i></a>
							<?php echo $this->Html->link('<i class="fa fa-eye large-icon pull-right" tooltip="'.__d('public','Podgląd').'"></i>', array('controller'=>'client_leads','action' => 'view', $client_id, $lead['ClientLead']['id']),array('class'=>'lead_link','escape' => false)); ?>
                            <!--<a href="/text_documents/update_from_lead/" class="margin-left-5"><i class="fa fa-file-text pull-right font-large" tooltip="TC" ></i></a>-->
                            <a href="/text_documents/index/<?php echo $lead['ClientLead']['id']; ?>" class="margin-left-5"><i class="fa fa-file-text pull-right font-large" tooltip="TC" ></i></a>
						</td>
					</tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<?php echo '<em>' . __d('public', 'Brak leadów') . '</em>'; ?>
<?php endif; ?>