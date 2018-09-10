<header id="header" class="clearfix">
	<div id="logo" class="clearfix">
	   <?php echo $this->Html->image('layouts/admin/febcms.png', array('url'=>'/admin')); ?>
	</div>
	<?php if($this->Session->check('Auth.User')){ ?>
         <div id="userInfoBox">
            <span class="orange"> <?php echo __d('public', 'Witaj').' '.$this->Session->read('Auth.User.name').' ('.$this->Session->read('Auth.User.email').')'; ?></span> 
            &nbsp;|&nbsp;
            
            <?php if ($this->Session->read('Auth.User._referer_id')): ?>
                <span> <?php echo __d('public', 'Powrót').' '.$this->Html->link($this->Session->read('Auth.User._referer_name').' ('.$this->Session->read('Auth.User._referer_email').')', array('plugin' => 'user', 'admin' => 'admin', 'controller' => 'users', 'action' => 'back_login')); ?></span> 
                &nbsp;|&nbsp;
            <?php endif; ?>
            
            <?php 
            echo $this->Permissions->link('Ustawienia', array('plugin'=>'user', 'controller'=>'users','action'=>'edit', 'admin'=>true, $this->Session->read('Auth.User.id'))); 
            echo '&nbsp;|&nbsp;'; 
            echo $this->Permissions->link('Strona frontowa', array('plugin'=> false, 'controller'=>'fronts','action'=>'front', 'admin'=>false)); 
            echo '&nbsp;|&nbsp;'; 
            ?>
            
            <?php echo $this->Html->link('Wyloguj', array('plugin'=>'user', 'controller'=>'users','action'=>'logout', 'admin'=>false)) ?>            
            <br />
            Ostatnio zalogowany: 
            <?php echo $this->Html->requestAction(array('plugin' => 'user', 'action'=>'last_login', 'controller'=>'users_logs', 'admin'=>false)); ?>
            <div class="clearfix">
                <?php echo $this->element('Translate.flags/flags'); ?>
            </div>
            
        </div>
    <?php } ?>
</header>
