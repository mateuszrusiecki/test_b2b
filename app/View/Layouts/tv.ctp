<!DOCTYPE html>
<!--[if IE 8]> <html lang="pl" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="pl" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<?php $description = Configure::read('Meta.title'); ?>
<html lang="pl" class="no-js"  ng-app="tvApp">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8"/>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <title>
            <?php echo!empty($title) ? $title : ( $title_for_layout ? $title_for_layout : ''); ?>
            - feb.b2b
        </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <?php
        echo $this->Html->meta('icon', '/img/layouts/default/feb_ico.png');
        echo $this->Html->meta('keywords', Configure::read('Meta.keywords'));
        echo $this->Html->meta('description', Configure::read('Meta.description'));
        ?>

        <?php if ((strpos($_SERVER['SERVER_NAME'], '.feb.net.pl') > 0) || ((Configure::read('Meta.robots') == 'noindex'))): ?>
            <meta name="robots" content="noindex, nofollow" />
        <?php else: ?>
            <meta name="robots" content="index, follow" />
        <?php endif; ?>
        <?php
        echo $this->fetch('meta');
        echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all');
        echo $this->Html->css('/assets/global/plugins/font-awesome/css/font-awesome.min.css');
        echo $this->Html->css('/assets/global/plugins/bootstrap/css/bootstrap.min.css');
        echo $this->Html->css('/assets/global/plugins/uniform/css/uniform.default.css');
        echo $this->Html->css('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');
        echo $this->Html->css('/assets/admin/layout4/css/layout.css');
        echo $this->Html->css('/assets/global/css/components-rounded.css');
        echo $this->Html->css('/assets/global/css/plugins.css');
        echo $this->Html->css('/assets/admin/layout4/css/custom.css');
        echo $this->fetch('css');

        echo $this->Html->script('/assets/global/plugins/jquery.min.js');
        echo $this->Html->script('/assets/global/plugins/angularjs/angular.min.js');
        echo $this->Html->scriptBlock("var app = angular.module('tvApp',[])");
        echo $this->fetch('script');
        ?>
    </head>
    <body class="page-header-fixed page-sidebar-closed ">
        <?php echo $this->element('GoogleAnalytics.googleAnalytics');
        ?>  

        <div class="page-content-wrapper">
            <div class="page-content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>


        <div class="page-footer text-center">
            2015 &copy; feb.b2b / Fabryka e-biznesu.
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>

        <?php
        echo $this->element('sql_dump');
        ?>

    </body>
</html>