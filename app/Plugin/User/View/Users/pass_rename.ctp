<?php
echo $this->Form->create('User', array('action' => 'pass_rename/'.$form->value('id'),'class'=>'clearfix'));

echo $this->Form->hidden('id');
echo $this->Form->input('pass',array('type'=>'password','label'=>'Hasło:'));
echo $this->Form->input('newpassword',array('type'=>'password','label'=>'Nowe hasło:'));
echo $this->Form->input('confirmpass',array('type'=>'password','label'=>'Powtórz hasło'));
echo $this->Form->end('zmień');
?>