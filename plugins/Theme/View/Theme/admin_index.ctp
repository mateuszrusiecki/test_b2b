<?php $appThemed =  Configure::read('App.themed'); ?>
<div class="idndex">
    <div class="theme<?php echo empty($appThemed)?' active':''; ?>">
            <h2><?php echo __d('cms','Default'); ?></h2>
            <div class="clearfix">
                <?php 
                $url = $appThemed?'':array('action'=>'deactivate');
                echo $this->Html->image('/Theme/img/screenshot.png', array('url'=>$url)) ?>
                <div class="contentInfo">
                    Autor : Default<br />
                    Name : Default
                </div>
            </div>
        <?php echo ($appThemed)?$this->Permissions->link('Aktywuj globalnie ', array('action'=>'activate'), array('class'=>'themeLink')):'Aktywny globalnie' ?>
        <?php $userTheme = $this->Session->read('Auth.User.themed');
        echo empty($userTheme)?'Aktywny':$this->Html->link('Aktywacja', array('action'=>'user_activate'), array('class'=>'themeLink')) ?>
        </div>
    <?php foreach($themes as $theme){ ?>
        <div class="theme<?php echo $appThemed == $theme['id']?' active':''; ?>">
            <h2><?php echo $theme['id']; ?></h2>
            <div class="clearfix">
                <?php 
                $url = $appThemed == $theme['id']?'':array('action'=>'activate',$theme['id']);
                echo $this->Html->image('/theme/'.$theme['id'].'/img/screenshot.png', array('url'=>$url)) ?>
                <div class="contentInfo">
                    <?php
                    foreach($theme['info'] as $info=>$list){
                        echo $info .' : '.$list . '<br />';
                        
                    } ?>
                </div>
            </div>
        <?php echo ($appThemed == $theme['id'])?'Aktywny globalnie':$this->Permissions->link('Aktywuj globalnie ', array('action'=>'activate',$theme['id']), array('class'=>'themeLink')) ?>
        <?php $userTheme = $this->Session->read('Auth.User.themed');
        echo ($userTheme == $theme['id'])?'Aktywny':$this->Html->link('Aktywacja', array('action'=>'user_activate',$theme['id']), array('class'=>'themeLink')) ?>
        </div>
    <?php } ?>
</div>