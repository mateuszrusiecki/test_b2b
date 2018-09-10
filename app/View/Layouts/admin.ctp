<?php
/**
 * Defaul layout for ayd control panel
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?> &bull; <?php echo Configure::read('App.AppName'); ?></title>

        <?php echo $this->FebHtml->meta('icon', $this->Html->url('/img/layouts/admin/feb_ico.png')); ?>
        <?php echo $this->Html->css(array('reset', 'admin', 'shared', 'menuList', 'flag', 'ui-lightness/jquery-ui')); ?>
        <?php echo $this->Html->script(array('jquery.min', 'jquery-ui.min', 'jquery.ui.datepicker-pl', 'admin')); ?> 

        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    
    <body >
        <div id="container">
            <?php
            echo $this->element('cms/header');
            echo $this->element('cms/menu');
            ?>
            <div id="nav"class="clearfix" >
                <?php
                echo $this->Menu->render(MenuCMS::TOP);
                //echo $this->element('Searcher.Searchers/menu');
                ?>
            </div>

            <div id="content" class="clearfix <?php echo $clip ? '' : 'clip'; ?>">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>

                <div class="clearfix" id="contentCms">
                    <?php echo $this->fetch('content'); ?>
                </div>
                <?php echo $this->element('cms/left_menu'); ?>

            </div>
            <div id="footer">
                <?php echo Configure::read('App.AppName'); ?> CMS
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>

        <?php echo $this->fetch('PermissionGroupContentMenu'); ?>
        <?php echo $this->element('User.Users/session_time_out'); ?>

    </body>


</html>