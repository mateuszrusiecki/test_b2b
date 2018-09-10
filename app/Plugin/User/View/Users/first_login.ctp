<?php $this->set('title_for_layout', __d('users', 'Logowanie')); ?>

<?php $this->Html->script('login', array('inline' => false)) ?>

<?php
$message = $this->Session->flash();
    $message_auth = $this->Session->flash('auth');
if ($this->Session->read('Auth.redirect') == '/'):
    $message_auth = null;
endif;
?>

<?php if (!empty($message) || !empty($message_auth)): ?>
    <?php echo empty($message)?'':$message; ?>
    <?php echo empty($message_auth)?'':$message_auth; ?>
<?php endif; ?>


<?php echo $this->Form->create('User', array('action' => 'first_login', 'id' => 'loginForm', 'class' => 'login-form')); ?>
<h4 class="text-center"><?php echo __d('public', 'Podaj swój adres email aby otrzymać link aktywacyjny do konta') ?></h4>
<div class="alert alert-danger display-hide">
    <button class="close" data-close="alert"></button>
    <span>Uzupełnij dane.</span>
</div>
<div class="form-group">
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9"><?php echo __d('public', 'Email') ?></label>
    <div class="input-icon" >
        <i class="fa fa-user"></i>
        <?php echo $this->Form->input('email', array('class' => 'form-control placeholder-no-fix','value'=>'', 'div' => false, 'label' => false, 'placeholder' => __d('public', 'E-mail'))); ?>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn blue-madison pull-right">
        Wyślij <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>

</form>