<?php 
echo $this->FebHtml->meta('description', __d('users', 'Przypominanie utraconego hasła', true),array('inline'=>false));
//echo $this->FebHtml->meta('keywords','',array('inline'=>false));
$this->set('title_for_layout', __d('users', 'Formularz przypominania hasła', true));
?>

<?php
$message = $this->Session->flash();
if ($this->Session->read('Auth.redirect') != '/'):
    $message_auth = $this->Session->flash('auth');
endif;

if (!empty($message) || !empty($message_auth)):
    echo empty($message)?'':$message; 
	echo empty($message_auth)?'':$message_auth;
endif;
?>

<?php echo $this->Form->create('User');?>

	<h3><?php echo __d('public', 'Witaj nowy pracowniku FEB!') ?></h3>
	<p>
		<?php echo __d('public', 'Wpisz służbowy adres email, aby ustawić hasło dla konta w systemie') ?>.
	</p>
	<div class="form-group">
		<div class="input-icon">
			<i class="fa fa-envelope"></i>
			<?php echo $this->Form->input('email', array('div' => false, 'class' => 'form-control placeholder-no-fix', 'label' => false, 'placeholder' => __d('public', 'Email'), 'type' => 'text')); ?>
		</div>
	</div>
	<div class="form-actions">
<!--		<button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Powrót </button>-->
		<button type="submit" class="btn blue-madison pull-right">
			Potwierdź <i class="m-icon-swapright m-icon-white"></i>
		</button>
	</div>
<?php //echo $this->Form->submit(__d('users','Wyślij')); ?>
<?php echo $this->Form->end();?>
