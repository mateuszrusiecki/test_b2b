<?php echo $this->Metronic->portlet($profile['Profile']['firstname'].' '.$profile['Profile']['surname'].' - '.__d('public','wyślij dane do konta')); ?>

<div class="portlet-body">       

    <div class="row">
        <div class="col-md-6 col-xs-12">
			<?php echo $this->Form->create('User', array()); ?>
			
            <?php
            echo $this->Metronic->input('credentials', array(
                'label' => __d('public','Pracownik otrzyma maila z linkiem do konta w systemie.<br/> Poniżej można załączyć dodatkowe dane - do służbowego konta pocztowego, febook, pm, itp.'),
				'required' => 'required',
				'type'=>'textarea',
				'value'=>__d('public','Mail służbowy').': '.$profile['User']['email'].'
Hasło:'
				
            ));

			echo $this->Form->submit(__d('public','Wyślij'), array('class' => 'btn blue-madison pull-right'));
			echo $this->Form->end();
            ?>
        </div>
    </div>
</div>

<?php echo $this->Metronic->portletEnd(); ?>