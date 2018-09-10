<?php 
echo $this->FebHtml->meta('description', __d('users', 'Przypominanie utraconego hasła', true),array('inline'=>false));
//echo $this->FebHtml->meta('keywords','',array('inline'=>false));
$this->set('title_for_layout', __d('users', 'Formularz przypominania hasła', true));
?>

<h1><?php printf(__d('users', 'Przypomnienie %s'), __d('users', 'hasła')); ?></h1>
<?php echo $this->Form->create('User');?>
	<?php
		echo $this->Form->input('email');
	?>
<?php echo $this->Form->submit(__d('users','Wyślij')); ?>
<?php echo $this->Form->end();?>
