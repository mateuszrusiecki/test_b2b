<?php
/**
 * Defaul layout for ayd control panel
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta name="viewport" content="user-scalable=no, initial-scale = 1, minimum-scale = 1, maximum-scale = 1, width=device-width" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        
        
        <title><?php echo $title_for_layout; ?> &bull; <?php echo Configure::read('App.AppName'); ?></title>

        <?php echo $this->FebHtml->meta('icon', $this->Html->url('/img/layouts/admin/feb_ico.png')); ?>
        <?php echo $this->Html->css(array('app')); ?>
        <?php echo $this->Html->script(array('jquery.min', 'app', 'library', 'base', 'table', 'initialize_1')); ?> 

        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>

    <body>
        <?php echo $this->element('cms/menu'); ?>    
        <?php echo $this->element('cms/header'); ?>
        <?php echo $this->element('cms/stream'); ?>
        
        <div id="dashboard">
            <div class="scroll con">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        <div id="footer">
            <div class="con">
                <?php echo Configure::read('App.CmsName') ? Configure::read('App.CmsName') : 'FEB CMS'; ?>
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
        <?php echo $this->fetch('PermissionGroupContentMenu'); ?>
        <?php echo $this->element('User.Users/session_time_out'); ?>
    </body>
</html>