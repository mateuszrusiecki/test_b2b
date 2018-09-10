<!DOCTYPE html>
<!--[if IE 8]> <html lang="pl" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="pl" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<?php $description = Configure::read('Meta.title'); ?>
<html lang="pl" class="no-js" ng-app="b2bApp" >
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
        <?php echo $this->Html->scriptBlock("window.loadedDependencies = [];"); ?>
        <?php
        echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all');
        echo $this->Html->css('colorbox');
        echo $this->Html->css('/assets/global/plugins/font-awesome/css/font-awesome.min.css');
        echo $this->Html->css('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css');
        echo $this->Html->css('/assets/global/plugins/bootstrap/css/bootstrap.min.css');
        echo $this->Html->css('/assets/global/plugins/uniform/css/uniform.default.css');
        echo $this->Html->css('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');
        echo $this->Html->css('/assets/admin/pages/css/pricing-table.css');
        echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css');
        echo $this->Html->css('/assets/global/plugins/fullcalendar/fullcalendar.min.css');
        echo $this->Html->css('/assets/global/plugins/jqvmap/jqvmap/jqvmap.css');
        echo $this->Html->css('/assets/global/plugins/morris/morris.css');
        echo $this->Html->css('/assets/admin/pages/css/tasks.css');
        echo $this->Html->css('/assets/global/css/components-rounded.css');
        echo $this->Html->css('/assets/global/css/plugins.css');
        echo $this->Html->css('/assets/admin/layout4/css/layout.css');
        echo $this->Html->css('/assets/admin/layout4/css/themes/light.css');
        echo $this->Html->css('/assets/admin/layout4/css/custom.css');
        echo $this->Html->css('/assets/admin/pages/css/todo.css');
        echo $this->Html->css('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css');
        echo $this->Html->css('/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css');
        echo $this->Html->css('/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');
        echo $this->Html->css('/assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min');
        echo $this->Html->css('/assets/global/plugins/select2/select2.css');
        echo $this->Html->css('/assets/admin/pages/css/timeline2015.css');
        echo $this->Html->css('/css/introjs.css');
        echo $this->Html->css('jquery.qtip.min.css');
        echo $this->Html->css('ngDraggable.css');
        echo $this->Html->css('style');
        echo $this->Html->css('flag');
        echo $this->Html->css('angular-ui-tree.min');
//        echo $this->Html->css('dataTables.bootstrap');

        echo $this->Html->css('/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');
        echo $this->Html->css('/assets/admin/pages/css/profile.css');
        echo $this->Html->css('/assets/admin/pages/css/tasks.css');

        echo $this->Html->script('/assets/global/plugins/jquery.min.js');
        echo $this->Html->script('CodeError');
        echo $this->Html->script('/assets/global/plugins/bootstrap/js/bootstrap.min.js');
        echo $this->Html->script('/assets/global/plugins/select2/select2.min');
        echo $this->Html->script('/assets/global/plugins/datatables/all.min');
        echo $this->Html->script('jquery.qtip.min.js');
//        echo $this->Html->script('/js/datatable.js');

        echo $this->Html->script('/assets/global/plugins/fullcalendar/lib/moment.min.js');

//        echo $this->Html->script('/assets/global/plugins/jquery-ui.custom.min.js');
        echo $this->Html->script('/assets/global/plugins/flot/jquery.flot.min.js');
        echo $this->Html->script('/assets/global/plugins/flot/jquery.flot.resize.min.js');
        echo $this->Html->script('/assets/global/plugins/flot/jquery.flot.pie.min.js');
        echo $this->Html->script('/assets/global/plugins/flot/jquery.flot.stack.min.js');
        echo $this->Html->script('/assets/global/plugins/flot/jquery.flot.crosshair.min.js');
        echo $this->Html->script('/assets/global/plugins/flot/jquery.flot.categories.min.js');

        echo $this->Html->script('/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery.sparkline.min.js');

        echo $this->Html->script('/assets/global/plugins/fullcalendar/fullcalendar.js', array('block' => 'angular'));
        echo $this->Html->script('/assets/global/plugins/fullcalendar/lang-all.js', array('block' => 'angular'));
        echo $this->Html->script('/assets/global/plugins/fullcalendar/calendar.js', array('block' => 'angular'));

        echo $this->Html->script('/js/intro.js');
        echo $this->Html->script('/js/jquery.colorbox-min.js');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <base href="/">  <!--NIE USTAWIAC BASE NA GRAPHICS_COLLABORATION!!!-->
    </head>
    <body class="page-header-fixed page-sidebar-closed " ng-controller="MainCtrl" ng-class="{
            'bodyHidden'
            : bodyHidden}">
              <?php echo $this->element('GoogleAnalytics.googleAnalytics');
              ?>  

        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top" data-position="bottom" data-intro="<?php echo __d('public', 'Zaczynamy od górnego panelu') ?>" data-step="1">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="/">
                        <img class="logo-default" src="/img/_logo_front.png" alt="Fabryka e-biznesu" style="margin-top:10px;" />
                    </a>
                    <div class="menu-toggler sidebar-toggler hidden-md hidden-lg">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <?php
                if (!empty($_SESSION['Auth']['User']['id']))
                {
                    echo $this->element('default/menu');
                }
                ?>
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <?php echo $this->element('default/search'); ?>

                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">

                        <ul class="nav navbar-nav pull-right">
                            <?php
                            if (!empty($_SESSION['Auth']['User']['id']))
                            {
                                ?>
                                <li class="separator hidden-xs">
                                </li>
                                <?php echo $this->element('default/language'); ?>

                                <li class="separator hidden-xs">
                                </li>
                                <?php echo $this->Element('default/suggestion'); ?>
                                <li ng-controller="MessagesInfoCtrl" id="header_notification_bar" class="dropdown dropdown-extended dropdown-dark"
                                    data-intro="<?php echo __d('public', 'Powiadomienia systemowe. Wyświetla się tu liczba nowych powiadomień. Pełną listę można zobaczyć po najechaniu i kliknięciu \'wszystkie\'') ?>" data-step="30">
                                    <a ng-mouseover="setMessagesReaded()" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                                        <i class="icon-bell"></i>
                                        <span ng-bind="messages.length || 0" class="badge badge-default"></span>
                                    </a>    
                                    <ul class="dropdown-menu">
                                        <li class="external">
                                            <h3><strong ng-bind="messages.length || 0"></strong> <?php echo __d('public', 'nowych powiadomień') ?></h3>
                                            <a href="/profiles/messages">wszystkie</a>                                         
                                        </li>
                                        <li>
                                            <div style="position: relative; overflow: hidden; width: auto; max-height: 274px;">
                                                <ul data-handle-color="#637283" style="max-height: 274px; overflow: hidden; width: auto;" class="overflow-hidden dropdown-menu-list" data-initialized="1">
                                                    <li ng-cloak ng-repeat="message in messages">
                                                        <a href="/profiles/messages">
                                                            <span class="time">{{message.Message.received| limitTo : 10}}</span>
                                                            <span class="details">
                                                                <span ng-class="{
                                                                                                                                                            'label-success'
                                                                                                                                                            : message.Message.message_type_id ==  1,  'label-warning': message.Message.message_type_id == 2, 'label-danger' : message.Message.message_type_id == 3}" class="label label-sm label-icon">
                                                                    <i ng-class="{
                                                                                                                                                                'fa-check'
                                                                                                                                                                : message.Message.message_type_id== 1, 'fa-minus': message.Message.message_type_id == 2, 'fa-close' : message.Message.message_type_id == 3}"  class="fa"></i>
                                                                </span>
                                                                <span ng-if="message.Message.body.length <= 30">{{message.Message.body}}</span>
                                                                <span ng-if="message.Message.body.length > 30">{{message.Message.body| limitTo : 30}} ...</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(99, 114, 131); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 121.359px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div> 
                                        </li>
                                    </ul>
                                </li>

                                <li class="separator">
                                </li>
                                <?php
                            }
                            ?>
                            <!-- END TODO DROPDOWN -->
                            <?php
                            if (!empty($_SESSION['Auth']['User']['id']))
                            {
                                echo $this->element('default/user_menu');
                            } else
                            {
                                echo $this->element('default/not_logged_menu');
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>

        
        <div class="page-container">
            <?php
            if (!empty($_SESSION['Auth']['User']['id']))
            {
                echo $this->Element('default/menu_mobile');
            }
            ?>

            <div class="page-content-wrapper">
                <div class="page-content">

                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE HEAD -->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1><?php
                                if (isset($title))
                                    echo $title;
                                else
                                    echo __d('public', 'Błąd')
                                    ?></h1>
                        </div>
                        <!-- END PAGE TITLE -->
                    </div>
                    <!-- END PAGE HEAD -->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <?php
                        if (isset($subtitle))
                            $this->Html->addCrumb($subtitle);
                        else
                            $this->Html->addCrumb(__d('public', 'Błąd'));
                        ?>
                        <?php echo $this->Html->getCrumbs(' <i class="fa fa-circle"></i> ', array('text' => __d('public', 'Strona główna'), 'escape' => false)); ?> 
                        <?php //echo $this->Html->getCrumbList(array('text' => 'Strona główna', 'escape' => false),' <i class="fa fa-circle"></i> ');   ?> 
                    </ul>
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Session->flash('auth'); ?>
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
        </div>


        <div class="page-footer text-center">
            <table class="dotacja">
                <tr>
                    <td style="text-align:left;"><img src="/uploaded/ue/poig.png" alt=''/></td>
                    <td class="dot_info"> Dotacje na innowacje – inwestujemy w waszą przyszłość <br/>2015 &copy; feb.b2b / Fabryka e-biznesu.</td>
                    <td style="text-align:right;"><img src="/uploaded/ue/efrr.png" alt=''/></td>
                </tr>
            </table>
            <div class="dot_info_div">Dotacje na innowacje – inwestujemy w waszą przyszłość <br/>2015 &copy; feb.b2b / Fabryka e-biznesu.</div>

            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        
        <div class="facebook">
            <i class="fa fa-info-circle font-red-sunglo font-large info-circle facebook-przycisk"> </i>
            <div class="facebook-ramka"> <a onclick="javascript:introJs().start();" href="javascript:void(0);" class="btn btn-large btn-success samouczek color-white" >Rozpocznij<br/> samouczek</a> </div>
        </div>
        

        <?php
//            echo $this->Html->requestAction(array('plugin' => 'eurocookie', 'controller' => 'eurocookies', 'action' => 'cookie', 'admin' => false));

       //echo $this->element('sql_dump');

        echo $this->Html->script('/assets/global/plugins/jquery-migrate.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js');
        echo $this->Html->script('/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery.blockui.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery.cokie.min.js');
        echo $this->Html->script('/assets/global/plugins/uniform/jquery.uniform.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery.sparkline.min.js');
        echo $this->Html->script('/assets/global/scripts/metronic.js');
        echo $this->Html->script('/assets/admin/layout4/scripts/layout.js');
        echo $this->Html->script('/assets/admin/layout4/scripts/demo.js');
        echo $this->Html->script('/assets/admin/pages/scripts/index3.js');
        echo $this->Html->script('/assets/admin/pages/scripts/tasks.js');
        echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');
        echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js');
        echo $this->Html->script('/assets/global/plugins/holder.js');
        echo $this->Html->script('/assets/admin/pages/scripts/components-jqueryui-sliders.js');

        echo $this->Html->script('/js/jquery.jcarousel.min.js');
        echo $this->Html->script('/js/jquery.jcarousel-pagination.min.js');

        echo $this->Html->script('/assets/global/plugins/angularjs/angular.min.js');
        echo $this->Html->script('/assets/global/plugins/angularjs/angular-sanitize.min.js');
        echo $this->Html->script('/assets/global/plugins/angularjs/angular-touch.min.js');
        echo $this->Html->script('/assets/global/plugins/angularjs/plugins/angular-ui-router.min.js');
        echo $this->Html->script('/assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js');
        echo $this->Html->script('/assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js');
        $rand = rand(0, 100);
        echo $this->fetch('angular-lib');
        echo $this->Html->script('angular/app.js?v=' . $rand);
        $lang = Configure::read('Config.language');
        echo $this->Html->scriptBlock("app.constant('language','{$lang}');");
        echo $this->Html->script('angular/timeline');
        echo $this->Html->script('angular/filter.js?v=' . $rand);
        echo $this->Html->script('angular/directive.js?v=' . $rand);
        echo $this->Html->script('angular/angular-translate.min');
        echo $this->Html->script('angular/ngDraggable');
        echo $this->Html->script('angular/angular-ui-tree.min');
        echo $this->Html->script('angular/angular-bootstrap-checkbox.js');
        echo $this->Html->script('angular/datatables/angular-datatables.js');
        echo $this->Html->script('angular/services/services.js');
        echo $this->Html->script('angular/profileController');
        echo $this->Html->script('angular/controllers/CalendarsCtrl');
        echo $this->Html->script('angular/controllers/BaseProjectsCtrl');
        echo $this->Html->script('angular/controllers/BaseModulesCtrl');
        echo $this->Html->script('angular/controllers/BaseModuleCtrl');
        echo $this->Html->script('angular/controllers/BaseProjectCtrl');
        echo $this->Html->script('angular/controllers/SearchersCtrl');
        echo $this->Html->script('angular/controllers/TextDocumentsCtrl');
        echo $this->Html->script('angular/controllers/TextDocumentCtrl');
        echo $this->Html->script('angular/controllers/MessagesCtrl');
        echo $this->Html->script('angular/controllers/EventsCtrl');
        echo $this->Html->script('angular/controllers/ProjectDetailCtrl');
        echo $this->Html->script('angular/controllers/EventsViewCtrl');
        echo $this->Html->script('angular/controllers/MessagesInfoCtrl');
        echo $this->Html->script('angular/controllers/MainCtrl.js?v=' . $rand);
        echo $this->Html->script('angular/controllers/MenuCtrl.js?v=' . $rand);
        echo $this->Html->script('angular/controllers/SuggestionCtrl.js?v=' . $rand);
        echo $this->Html->script('angular/angular-file-upload-all.min');
        echo $this->Html->script('angular/controllers/TimePickerCtrl');
        echo $this->Html->script('angular/controllers/UpdateProfileCtrl.js?v=' . $rand);
        echo $this->Html->script('angular/controllers/ProfilesCtrl.js?v=' . $rand);
        echo $this->Html->script('angular/controllers/ContractsCtrl.js?v=' . $rand);
        echo $this->Html->script('angular/controllers/VacationsCtrl.js?v=' . $rand);

        echo $this->Html->script('modalEffects');
        echo $this->Html->script('classie');
        echo $this->Html->script('/assets/global/plugins/angularjs/plugins/angular-resource.js');
        echo $this->fetch('angular');
        echo $this->Html->script('angular/LC_MESSAGES/pol.js');
        echo $this->Html->script('angular/LC_MESSAGES/eng.js');
        ?>

        <!--[if lt IE 9]>
        <script src="../../assets/global/plugins/respond.min.js"></script>
        <script src="../../assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->

        <script>
                    jQuery(document).ready(function () {

                        Metronic.init(); // init metronic core componets
                        Layout.init(); // init layout
                        Tasks.initDashboardWidget(); // init tash dashboard widget  
                        ComponentsPickers.init();
                        //                ComponentsjQueryUISliders.init();


                        $('.jcarousel').jcarousel();
                        $('.jcarousel-prev').jcarouselControl({
                            target: '-=1'
                        });
                        $('.jcarousel-next').jcarouselControl({
                            target: '+=1'
                        });
                        
                        $('div.facebook').mouseenter(function(){
                            $(this).stop(true, false).animate({"left": "0"}, 80);
                        });
                        $('div.facebook').mouseleave(function(){
                            $(this).stop(true, false).animate({"left": "-112px"}, 80);
                        });
                        
                    });</script>

        <script type="text/javascript">
                    $('a.colorbox').colorbox({maxWidth: '90%', maxHeight: '90%', close: 'Zamknij'});</script>

    </body>
</html>