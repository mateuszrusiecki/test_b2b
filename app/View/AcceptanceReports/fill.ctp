
<div class="acceptanceReports form">
    

</div>

<?php echo $this->Metronic->portlet(__d('public', 'Częściowy protokół odbioru: ').$report['ClientProjectShedule']['name']); ?>	

<div class="acceptanceReports view">
   
<h2><?php  echo __('PROTOKÓŁ CZĘŚCIOWEGO ODBIORU PRAC');?></h2>
    <?php echo $this->Form->create('AcceptanceReport'); ?>
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

            <dt><?php echo __d('cms', 'Zakres wykonanych robót objętych niniejszym protokołem jest zgodny z zakresem prac wskazanym w umowie'); ?>.</dt>
            <dd></dd>

            <dt><?php echo __d('cms', 'Na podstawie niniejszego protokołu odebrano następujące rodzaje prac'); ?>:</dt>
            <dd>
                <?php echo nl2br($report['AcceptanceReport']['task_list']); ?>
                &nbsp;
            </dd>
        <?php if($report['AcceptanceReport']['acceptance']): //wyświetlam gdy protokół jest zaakceptowany, żeby klient nie mógł odakceptować:)?>
            <dt><?php echo __d('cms', 'Uwagi i zastrzeżenia'); ?></dt>
            <dd>
				<?php echo $this->Form->textarea('opinion', array('class' => 'form-control input-sm','value'=>$report['AcceptanceReport']['opinion'],'disabled'=>'disabled')); ?>
            </dd>
            <dt>
                <?php echo __d('cms', 'Protokół został zaakceptowany'); ?>. 
                <?php echo __d('public', 'Kliknij') ?> <?php echo '<a href="http://'.$_SERVER['SERVER_NAME'].'/user/users/login">tutaj</a>'?>
                <?php echo __d('public', 'aby zalogować się do Panelu i zapoznać się z listą dokumentów') ?>.
            </dt>
        <?php else: ?>
            <dt><?php echo __d('cms', 'Uwagi i zastrzeżenia'); ?></dt>
            <dd>
				<?php echo $this->Form->textarea('opinion', array('class' => 'form-control input-sm','value'=>$report['AcceptanceReport']['opinion'])); ?>
            </dd>
            <dt>
                <?php  
                    echo $this->Form->input('acceptance', array(
                        'label' => false,
                        'type' => 'checkbox',
                        'checked'=>$report['AcceptanceReport']['acceptance'],
                        'div' => false,
                    ));  
                    echo $this->Form->input('id', array(
                        'label' => false,
                        'type' => 'hidden',
                        'checked'=>$report['AcceptanceReport']['id'],
                        'div' => false,
                    ));  
                    echo __d('cms', 'Akceptuję protokół częściowy');
                    
                    echo $this->Form->input('date_end', array(
                        'label' => false,
                        'type' => 'hidden',
                        'value'=>$report['ClientProjectShedule']['date'],
                        'div' => false,
                    ));  
                    echo $this->Form->input('accept_date', array(
                        'label' => false,
                        'type' => 'hidden',
                        'value'=>date('Y-m-d'),
                        'div' => false,
                    ));  
                ?>
            </dt>
            <dd></dd>
            <dd><?php echo __d('cms', 'Zaakceptowany protokół zostanie dodany do plików projektu w formacie PDF'); ?></dd>
    
            <?php echo $this->Form->button( __d('public', 'Zapisz'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-left poitnier', 'escape' => false, 'type' => 'submit')); ?>

        <?php endif; ?>
        </dl>
    
    <?php echo $this->Form->end(); ?>
</div>

<?php echo $this->Metronic->portletEnd(); ?>