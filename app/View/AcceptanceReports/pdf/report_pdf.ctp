<div class="page-logo" style="position: absolute;z-index: 1000">
    <img class="logo-default" src="http://<?php echo $_SERVER['SERVER_NAME']?>/img/_logo_front.png" alt="Fabryka e-biznesu" style="margin-top:10px;">
</div>

<div class="acceptanceReportsPdf">
    <div class="col-xs-12">
		<h2 style="text-align: center;padding-top: 15px; font-weight: bold"><?php echo __d('public','Protokół Częściowego odbioru prac') ?></h2>
        
<br/><br/><br/>
	<dl>
        <dt><?php echo __d('public','Nazwa zadania'); ?></dt>
        <dd>
            <?php echo '"'.$report['ClientProjectShedule']['name'].'" '.__d('public','w projekcie').': '.$report['ClientProject']['name']; ?>
        </dd>
		<dt><?php echo __d('public','Zamawiający'); ?></dt>
		<dd>
			<?php echo $report['Client']['name'].' '.__d('public', 'ul.').$report['Client']['street'].','.$report['Client']['zipcode'].' '.$report['Client']['city']; ?>
		</dd>
		<dt><?php echo __d('public','Wykonawca'); ?></dt>
		<dd>
			<?php if(isset($executor['Settings']['value'])) echo $executor['Settings']['value']; else echo __d('public','Fabryka e-biznesu')?>
			&nbsp;
		</dd>
		<dt><?php echo __d('public','Prace realizowano do dnia'); ?></dt>
		<dd>
			<?php echo $report['ClientProjectShedule']['date']; ?>
		</dd>
		<dt><?php echo __d('public','Data dokonania odbioru'); ?></dt>
		<dd>
			<?php echo $report['AcceptanceReport']['accept_date']; ?>
			&nbsp;
		</dd>
		
        
		<dt><?php echo __d('cms', 'Na podstawie niniejszego protokołu odebrano następujące rodzaje prac'); ?>:</dt>
		<dd>
			<?php echo nl2br($report['AcceptanceReport']['task_list']); ?>
			&nbsp;
		</dd>
        
		<dt><?php echo __d('cms', 'Zakres wykonanych robót objętych niniejszym protokołem jest zgodny z zakresem prac wskazanym w umowie'); ?>.</dt>
        <dd></dd>
        
		<dt><?php echo __d('cms', 'Uwagi i zastrzeżenia'); ?></dt>
		<dd>
			<?php echo h($report['AcceptanceReport']['opinion']); ?>
			&nbsp;
		</dd>
        
    
		
		
	</dl>
        <div class="clear-fix"><br/><br/><br/><br/><br/></div>
        <div class="pull-left center">
            <span>.................................................</span><br/>
            <span><?php echo __d('public', 'Podpis zamawiającego'); ?>
                <br/>
                <?php echo __d('public', '(osoby uprawnionej do odbioru protokołu)'); ?></span>
        </div>
        <div class="pull-right center">
            <span>.......................................................... </span><br/>
            <span>
                <?php echo __d('public', 'Podpis wykonawcy'); ?>
                <br/>
                <?php echo __d('public', 'osoby uprawnionej do wystawienia protokołu odbioru)'); ?>
            </span>
        </div>
          
    </div>

</div>

