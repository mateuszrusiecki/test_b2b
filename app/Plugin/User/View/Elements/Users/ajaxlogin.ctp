<?php $this->set('title_for_layout', __d('users', 'Logowanie')); ?>
<?php echo $this->Html->css('login') ?>
<div id="contentGradient">
    <div class="fixed_overlay">
        <div class="overlay_content"></div>
        <div class="ajax_login_form" >
            <?php echo $this->Form->create('User', array('plugin' => 'user','admin' => false, 'controller' => 'users','action' => 'login', 'class' => 'clearfix')); ?>
            <div id="orangeLoginHeader">
                <h3><?php echo __d('public', 'Witaj użytkowniku') ?>!</h3>
            </div>
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth'); ?>
            <?php
                echo $this->Form->input('email', array('label' => 'E-mail:'));
                echo $this->Form->input('pass', array('label' => 'Hasło:', 'type' => 'password', 'value' => ''));
                echo $this->Js->submit('Zaloguj', array('update' => '#contentGradient', 'url' => array('plugin' => 'user','admin' => false, 'controller' => 'users', 'action' => 'ajaxlogin')));
                echo $this->Form->end();
                echo $this->Js->writeBuffer();
            ?>
        </div>
    </div>

</div>