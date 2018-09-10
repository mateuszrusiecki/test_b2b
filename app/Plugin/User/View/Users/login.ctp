<?php $this->set('title_for_layout', __d('users', 'Logowanie')); ?>

<?php $this->Html->script('login', array('inline' => false)) ?>

<?php
$message = $this->Session->flash();
    $message_auth = $this->Session->flash('auth');
if ($this->Session->read('Auth.redirect') == '/'):
    $message_auth = null;
endif;

if (!empty($message) || !empty($message_auth)):
    ?>
    <div class="alert alert-danger display-hide" style="display: block;">
        <button data-close="alert" class="close"></button>
        <span>
            <?php echo empty($message)?'':$message; ?>
            <?php
            echo empty($message_auth)?'':$message_auth;
            ?>
        </span>
    </div>

    <?php
endif;
?>
<?php
//echo $this->Form->input('remember', array('type' => 'checkbox', 'label' => 'Zapamiętaj mnie'));
//echo $this->Html->link(__d('users', 'Nie pamiętasz hasła? Przypomnij hasło.'), array('action' => 'pass_recall'));
?>

<!--<div id="welcome">
<?php //echo $this->Html->image('layouts/login/feb_cms.png', array('id' => 'logoCms'));   ?> 
    <div id="password">
<?php
//        echo $this->Form->create('User', array('action' => 'login', 'id' => 'loginForm', 'class' => 'clearfix'));
//        echo $this->Form->input('email', array('div' => 'input username', 'label' => false, 'placeholder' => __d('users', 'E-mail')));
//        echo $this->Form->input('pass', array('div' => 'input password', 'label' => false, 'placeholder' => __d('users', 'Password'), 'type' => 'password'));
//        echo $this->Form->button(__d('users', 'Zaloguj'));
//        echo $this->Form->end();
?>    
    </div>
</div>-->
<?php echo $this->Form->create('User', array('action' => 'login', 'id' => 'loginForm', 'class' => 'login-form')); ?>
<h3 class="form-title"><?php echo __d('public', 'Zaloguj się na swoje konto') ?></h3>
<div class="alert alert-danger display-hide">
    <button class="close" data-close="alert"></button>
    <span>Uzupełnij dane.</span>
</div>
<div class="form-group">
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9"><?php echo __d('public', 'Email') ?></label>
    <div class="input-icon">
        <i class="fa fa-user"></i>
        <?php echo $this->Form->input('email', array('class' => 'form-control placeholder-no-fix', 'div' => false, 'label' => false, 'placeholder' => __d('public', 'E-mail'))); ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9"><?php echo __d('public', 'Hasło') ?></label>
    <div class="input-icon">
        <i class="fa fa-lock"></i>
        <!--<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Hasło" name="pass"/>-->
        <?php echo $this->Form->input('pass', array('div' => false, 'class' => 'form-control placeholder-no-fix', 'label' => false, 'placeholder' => __d('public', 'Hasło'), 'type' => 'password')); ?>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn blue-madison pull-right">
        Zaloguj <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
<div class="forget-password">
    <h4><?php echo __d('public', 'Zapomniałeś hasła?') ?></h4>
    <p>
        <?php echo __d('public', 'Nie szkodzi, kliknij') ?>
        <a href="javascript:;" id="forget-password"><?php echo __d('public', 'tutaj') ?></a>,
        <?php echo __d('public', 'aby zresetować hasło') ?>.
    </p>
</div>
</form>
<?php echo $this->Form->create('User', array('action' => 'reset_password', 'class' => 'forget-form')); ?>
<h3><?php echo __d('public', 'Zapomniałeś hasła?') ?></h3>
<p>
    <?php echo __d('public', 'Wpisz swój adres email, aby zresetować hasło') ?>.
</p>
<div class="form-group">
    <div class="input-icon">
        <i class="fa fa-envelope"></i>
        <?php echo $this->Form->input('forget', array('div' => false, 'class' => 'form-control placeholder-no-fix', 'label' => false, 'placeholder' => __d('public', 'Email'), 'type' => 'text')); ?>
    </div>
</div>
<div class="form-actions">
    <button type="button" id="back-btn" class="btn">
        <i class="m-icon-swapleft"></i> <?php echo __d('public', 'Powrót') ?> </button>
    <button type="submit" class="btn blue-madison pull-right">
        <?php echo __d('public', 'Potwierdź') ?> <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
</form>