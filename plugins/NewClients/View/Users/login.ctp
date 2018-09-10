<?php
    echo $this->Html->css('../assets/admin/pages/css/login.css');
?>
<div class="login">
    <div class="logo">
    <div class="users content">
        <?php echo $this->Form->Create('User', array('class'=>'login-form'));?>
        <h3 class="form-title">Wprowadź swój email i hasło</h3>
        <div class="alert">
            <?php echo $this->Session->flash();?>
        </div>
        <div class="form-group">
            <div class="input-icon">
              <i class="fa fa-user"></i>
              <input class="form-control plcaeholder-no-fix" name="data[User][username]" id="UserUsername" required="required" type="text" autocomplete="off"
              placeholder="e-mail">
              <?php //echo $this->Form->input('username', array('label' => ''));?>
          </div>
        </div>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control placeholder-no-fix" name="data[User][password]" required="required" id="UserPassword" autocomplete="off" placeholder="Hasło">
            </div>
            <?php //echo $this->Form->input('password', array('label' => 'Hasło', 'type'=>'password'));?>
        </div>
        <div class="form-actions">
            <label class="checkbox"></label>
            <button type="submit" class="btn green pull-right">Zaloguj</button>
        <?php //echo $this->Form->end('Zaloguj'); ?>
        </div>
    </div>
</div>
