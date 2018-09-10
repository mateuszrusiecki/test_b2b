
<?php if($this->Session->read('pm_login')): ?>
	
	<div class="text_center">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public','Jesteś zalogowany jako: '); ?><br/> <?php echo $this->Session->read('pm_login');?> </span>
		</div>

		<a class="btn btn-circle yellow-gold center" href="/pm/logout" title="<?php echo __d('public','Wyloguj');?>"><?php echo __d('public','Wyloguj');?></a>
	</div>
<?php else: ?>

    <div>
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public','Zaloguj się aby mieć dostęp do PM');?> </span>
        </div>

        <?php //echo $this->Form->create('Pm',array('url' => array('controller' => 'pm', 'action' => 'login'))); ?>
        <form action="/pm/login" id="PmLoginForm" method="post" accept-charset="utf-8" class="ng-pristine ng-invalid ng-invalid-required" autocomplete="off">
        <div style="display:none;">
            <input type="hidden" name="_method" value="POST">
            <input style="display:none" type="text" name="fakeusernameremembered"/>
            <input style="display:none" type="password" name="fakepasswordremembered"/>
        </div>											

            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9"><?php echo __d('public','Email');?></label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <?php echo $this->Form->input('PM.login', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9"><?php echo __d('public','Hasło');?></label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <!--<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Hasło" name="pass"/>-->
                    <?php echo $this->Form->input('PM.password', array('div' => false, 'class' => 'form-control', 'label' => false, 'type' => 'password')); ?>
                </div>
            </div>

            <?php $options = array(
                'label' => __d('public','Zaloguj'),
                'class' => 'btn green-haze clear'

            ); ?>

        <?php echo $this->Form->end($options); ?>
	</div>
<?php endif; ?>