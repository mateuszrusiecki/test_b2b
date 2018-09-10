<?php echo $this->Metronic->portlet(__d('public','Tabela płac')); ?>
<?php echo empty($isAllow)?$this->element('Profile/password'):$this->element('Profile/table_payments'); ?> 
<?php echo $this->Metronic->portletEnd(); ?>