<div class="users form">
<?php echo $this->Form->create('User', array('url' =>'/'.$this->params->url ));?>
    <div class="clear"></div>
	<fieldset>
 		<legend><?php echo  __d('users', 'Aktywacja konta'); ?></legend>
	<?php
		//echo $this->Form->input('name', array('label' => __d('users', 'Nazwa')));
		echo $this->Form->hidden('email', array('readonly' => true));
		echo $this->Metronic->input('newpassword', array('placeholder' => __d('users', 'Hasło'), 'type' => 'password', 'value' => ''));
		echo $this->Metronic->input('confirmpassword', array('placeholder' => __d('users', 'Powtórz hasło'), 'type' => 'password', 'value' => ''));
	?>
	</fieldset>
	<div class="form-actions">
    <button type="submit" class="btn blue-madison pull-right">
        <?php echo __d('public', 'Zapisz') ?> <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
<?php echo $this->Form->end();?>
</div>
