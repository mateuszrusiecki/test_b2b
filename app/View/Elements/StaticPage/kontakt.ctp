<h3><?php echo __d('public', 'Formularz kontaktowy'); ?></h3>

<?php echo $this->Form->create(); ?>
<?php echo $this->Form->input('name',array('label'=>'Imię i nazwisko')); ?>
<?php echo $this->Form->input('email',array('label'=>'E-mail')); ?>
<?php echo $this->Form->input('phone',array('label'=>'Telefon')); ?>
<?php echo $this->Form->input('desc',array('label'=>'Wiadomość', 'type'=>'text')); ?>
<?php echo $this->Form->input('Wyślij', array('type'=>'submit','class'=>'btn', 'label'=>false)); ?>
<?php echo $this->Form->end(); ?>