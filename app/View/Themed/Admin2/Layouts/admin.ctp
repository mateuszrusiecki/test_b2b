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
        <title><?php 
            echo $title_for_layout; 
            if(!empty($olympic_program_id)){
                echo ' &raquo; '.$olympicProgramsList[$olympic_program_id];
            }
            ?> &raquo; <?php echo Configure::read('App.AppName'); 
        ?></title>
        <?php echo $this->Html->meta('icon', $this->Html->url('/img/layouts/admin/feb_ico.png')); ?>

        <!-- CSS -->
        <?php //echo $this->Html->css('cake.generic'); ?>
        <?php echo $this->Html->css('reset') ?>
        <?php echo $this->Html->css('admin') ?>
        <?php echo $this->Html->css('admin_shared') ?>
        <?php echo $this->Html->css('shared') ?>
        <?php echo $this->Html->css('menuList') //menu ?>
        <?php echo $this->Html->css('flag'); ?>
        <?php echo $this->Html->css('blitzer/jquery-ui'); ?>
        <!-- JAVASCRIPT -->

        <?php echo $this->Html->script('jquery.min'); ?> 
        <?php echo $this->Html->script('jquery-ui.min'); ?> 
        <?php echo $this->Html->script('jquery.ui.datepicker-pl'); ?> 
        

        <script type="text/javascript">
            //<![CDATA[
            //start menu on init
            $(document).ready(function() {
                jQuery('#flashMessage').click(function(){
                    jQuery(this).css('display', 'none');
                });
                $('.tabs').tabs();
                $('.subNav').each(function(){
                    var width = $(this).width();
                    var obj = $(this).find('ul');
                    var ulWidth = obj.width();
                    if (ulWidth < width) {
                        obj.css('width', width);
                    }
                });
            });
            //]]>
        </script>
        <!--scripts for layout -->
        <?php echo $scripts_for_layout; ?>
    </head>
    <body >
        <div id="container">
            <?php
            echo $this->element('cms/header');
            ?>
            <?php
            echo $this->element('cms/menu');
            $clip = true;//$this->Html->requestAction(array('controller' => 'users', 'action' => 'menu', 'admin' => false, 'plugin' => 'user'));
            ?>

            <div id="content" class="clearfix <?php echo $clip ? 'clip' : ''; ?>">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>

                <div class="clearfix" id="contentCms">
                    <?php echo $content_for_layout; ?>
                </div>
                <?php echo $this->element('cms/left_menu'); ?>

            </div>
            <div id="footer">
                <?php echo Configure::read('App.AppName'); ?> CMS
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>