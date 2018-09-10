<div class="row">
    <?php echo $this->element('Clients/client_list'); ?>
    <div class="col-md-9 col-xs-12">
        <div class="portlet light">
			<div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-share font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase pull-left"><?php echo __d('public', 'Raport z leadów'); ?></span>
					
					<div class="actions pull-right">
                        <a class="btn btn-sm btn-circle red-sunglo " href="#" data-toggle="modal" ng-click="doTheBack()">
                            <i class="fa fa-arrow-circle-left"></i> <?php echo __d('public', 'Powrót'); ?> </a>
                    </div>
                </div>
            </div>
			
			<?php if($post): ?>
            <div class="portlet-body">
				<h3><?php echo $profile['Profile']['firstname'].' '.$profile['Profile']['surname'] ?></h3>
				<h4><?php echo __d('public','Klient');?>: <?php echo $client_details['Client']['name'] ?></h4>
				<h4><?php echo __d('public','Zakres');?>: <?php echo $data['ClientLeadReport']['date_start'].' - '.$data['ClientLeadReport']['date_end'] ?></h4>
			
				<div class="table-scrollable table-scrollable-borderless">
					<table class="table table-hover table-light">
						<tbody>
							<tr>
								<td class="col-md-6"><?php echo __d('public','Ilość utworzonych leadów');?></td>
								<td> <?php echo $lead_created ?></td>
							</tr>
							<tr>
								<td class="col-md-6"><?php echo __d('public','Ilość leadów wygranych');?></td>
								<td> <?php echo $lead_win ?></td>
							</tr>
							<tr>
								<td class="col-md-6"><?php echo __d('public','Ilość leadów przegranych');?></td>
								<td> <?php echo $lead_lose ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<?php if($leads_win_query): ?>
				<?php //debug($leads_win_query) ?>
					<?php echo $this->Metronic->portlet(__d('public', 'Lista leadów wygranych'), 0, 'fa', 'green'); ?>	
						<div class="table-scrollable table-scrollable-borderless">
							<table class="table table-hover table-light">
								<tbody>
									<?php foreach($leads_win_query as $lead):?>
										<tr>
											<td class="col-md-6"><a href="/client_leads/view/<?php echo $lead['ClientLead']['client_id'].'/'.$lead['ClientLead']['id'];?>" ><?php echo $lead['ClientLead']['name'];?></a></td> 
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php echo $this->Metronic->portletEnd(); ?>
				<?php endif; ?>
				
				<?php if($leads_lost_query): ?>
					<?php echo $this->Metronic->portlet(__d('public', 'Lista leadów przegranych'), 0, 'fa', 'red'); ?>
						<div class="table-scrollable table-scrollable-borderless">
							<table class="table table-hover table-light">
								<thead>
									<tr>
										<th><?php echo __d('public', 'Lead') ?></th>
										<th><?php echo __d('public', 'Komentarz') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($leads_lost_query as $lead):?>
										<tr>
											<td class="col-md-6"><a href="/client_leads/view/<?php echo $lead['ClientLead']['client_id'].'/'.$lead['ClientLead']['id'];?>" ><?php echo $lead['ClientLead']['name'];?></a></td> 
											<td><?php echo $lead['ClientLead']['comment'];?></td>
										</tr>

									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php echo $this->Metronic->portletEnd(); ?>
				<?php endif; ?>
				
				
				<?php echo $this->Form->create('ClientLeadReport', array(
					'url' => array(
						'controller' => 'clients',
						'action' => 'lead_report'
					), 'class' => 'form-horizontal'
				)); ?>
					<?php echo $this->Form->input('ClientLeadReport.date_start', array(
						//'value' => $this->Session->read('Auth.User.id'),
						'type' => 'hidden',
						'label' => false 
					)); ?>

					<?php echo $this->Form->input('ClientLeadReport.date_end', array(
						//'value' => $this->Session->read('Auth.User.id'),
						'type' => 'hidden',
						'label' => false
					)); ?>

					<?php echo $this->Form->input('user_id', array(
						'value' => $this->Session->read('Auth.User.id'),
						'type' => 'hidden',
						'label' => false
					)); ?>
					
					<?php echo $this->Form->input('client_id', array(
						'value' => $client_id,
						'type' => 'hidden',
						'label' => false
					));?>
					<?php echo $this->Form->input('client_name', array(
						'value' => $client_details['Client']['name'],
						'type' => 'hidden',
						'label' => false
					));?>

					<?php echo $this->Form->input('csv', array(
						'value' => 1,
						'type' => 'hidden',
						'label' => false
					)); ?>
					<?php echo $this->Form->submit(__d('public', 'Pobierz CSV'), array('class' => 'btn btn-sm btn-circle red-sunglo pull-left', 'div' => false)); ?>

				<?php echo $this->Form->end(); ?>
				
				<div class="clearfix"></div>
			</div>
			<?php else: ?>
				<h3><?php echo __d('public','Nie wybrano zakresu dat.');?></h3>
			<?php endif; ?>
		</div>
	</div>
	
</div>
