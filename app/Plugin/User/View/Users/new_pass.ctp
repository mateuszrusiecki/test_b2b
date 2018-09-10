<?php $this->set('title_for_layout', __d('users', 'Resetowanie hasła')); ?>

<?php
$message = $this->Session->flash();
$message_auth = $this->Session->flash('auth');
$message_password = $this->form->error('User.newpassword');
$message_confirm = $this->form->error('User.confirmpassword');
if (!empty($message) || !empty($message_auth) || !empty($message_password) || !empty($message_confirm)):
    ?>
    <div class="alert alert-danger display-hide" style="display: block;">
        <button data-close="alert" class="close"></button>
        <span>
            <?php echo $message; ?>
            <?php echo $message_auth; ?>
            <?php echo $message_password; ?>
            <?php echo $message_confirm; ?>
        </span>
    </div>
<?php endif; ?>

<?php echo $this->Form->create('User', array('id' => 'loginForm', 'class' => 'login-form', 'url' => Router::url(array('controller' => 'users', 'action' => 'new_pass', $id, $hash)))); ?>
<h3 class="form-title"><?php echo __d('public', 'Resetowanie hasła') ?></h3>
<div class="alert alert-danger display-hide">
    <button class="close" data-close="alert"></button>
    <span><?php echo __d('public', 'Uzupełnij dane') ?>.</span>
</div>
<div class="form-group">
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9"><?php echo __d('public', 'Email') ?></label>
    <div class="input-icon">
        <i class="fa fa-lock"></i>
        <?php echo $this->Form->input('newpassword', array('class' => 'form-control placeholder-no-fix', 'error' => false, 'type' => 'password', 'div' => false, 'label' => false, 'placeholder' => __d('public', 'Nowe hasło'))); ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9"><?php echo __d('public', 'Hasło') ?></label>
    <div class="input-icon">
        <i class="fa fa-lock"></i>
        <!--<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Hasło" name="pass"/>-->
        <?php 
        echo $this->Form->input('confirmpassword', array('div' => false, 'type' => 'password', 'error' => false, 'class' => 'form-control placeholder-no-fix', 'label' => false, 'placeholder' => __d('public', 'Powtórz nowe hasło'), 'type' => 'password')); ?>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn blue-madison pull-right">
        Zmień <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
<?php echo $this->Form->end(); ?>