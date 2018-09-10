
<?php echo $this->Metronic->portlet(__d('public', 'Częściowy protokół odbioru: ').$report['ClientProjectShedule']['name']); ?>	

<div class="acceptanceReports view">
    <a class="btn btn-sm yellow margin-bottom pull-right ml" ng-href="/acceptance_reports/index">Powrót do listy</a>
    
<h2><?php  echo __('PROTOKÓŁ CZĘŚCIOWEGO ODBIORU PRAC');?></h2>
   
	<dl>
		<dt><?php echo __d('public','Zamawiający'); ?></dt>
		<dd>
			<?php echo $report['Client']['name'].' '.__d('public', 'ul.').$report['Client']['street'].','.$report['Client']['zipcode'].' '.$report['Client']['city']; ?>
		</dd>
		<dt><?php echo __d('public','Wykonawca'); ?></dt>
		<dd>
			<?php echo $executor['Settings']['value']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('public','Prace realizowano do dnia'); ?></dt>
		<dd>
			<?php echo $report['ClientProjectShedule']['date']; ?>
		</dd>
		
		<dt><?php echo __d('cms', 'Zakres wykonanych robót objętych niniejszym protokołem jest zgodny z zakresem prac wskazanym w umowie'); ?>.</dt>
        <dd></dd>
        
		<dt><?php echo __d('cms', 'Na podstawie niniejszego protokołu odebrano następujące rodzaje prac'); ?>:</dt>
		<dd>
			<?php echo nl2br($report['AcceptanceReport']['task_list']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Uwagi i zastrzeżenia'); ?></dt>
		<dd>
			<?php echo h($report['AcceptanceReport']['opinion']); ?>
			&nbsp;
		</dd>
        
        <dt>
            <?php if($report['AcceptanceReport']['acceptance']): echo __d('cms', 'Protokół został zaakceptowany'); ?>
            <?php else: echo __d('cms', 'Protokół nie jest zaakceptowany'); ?>
            <?php endif; ?>
        </dt>
    
		
		
	</dl>
</div>

<?php echo $this->Metronic->portletEnd(); ?>