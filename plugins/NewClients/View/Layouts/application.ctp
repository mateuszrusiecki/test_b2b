<!DOCTYPE html>
<html lang="pl" ng-app="febApp">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon', '/img/layouts/default/feb_ico.png');
        echo $this->Html->meta('keywords', Configure::read('Meta.keywords'));
        echo $this->Html->meta('description', Configure::read('Meta.description'));


//        echo $this->Html->css('../assets/global/css/components.css');
//        echo $this->Html->css('../assets/global/css/plugins.css');
//        echo $this->Html->css('../assets/admin/layout/css/layout.css');
//        echo $this->Html->css('../assets/admin/layout/css/themes/default.css');
//        echo $this->Html->css('/new_clients/css/application.css');

        echo $this->Html->css('///fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all');
        echo $this->Html->css('../assets/global/plugins/font-awesome/css/font-awesome.min.css');
        echo $this->Html->css('../assets/global/plugins/simple-line-icons/simple-line-icons.min.css');
        echo $this->Html->css('../new_clients/css/ng-table.min.css');
        echo $this->Html->css('../new_clients/css/angular-multi-select.min.css');
        echo $this->Html->css('../new_clients/css/ngDialog.min.css');
        echo $this->Html->css('../new_clients/css/ngDialog-theme-default.min.css');
        echo $this->Html->css('../new_clients/css/bootstrap.min.css');
        echo $this->Html->css('../assets/global/plugins/font-awesome/css/font-awesome.min.css');
        echo $this->Html->css('../assets/global/plugins/simple-line-icons/simple-line-icons.min.css');
        echo $this->Html->css('../assets/global/plugins/bootstrap/css/bootstrap.min.css');
        echo $this->Html->css('../assets/global/plugins/uniform/css/uniform.default.css');
        echo $this->Html->css('../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');
        echo $this->Html->css('../assets/admin/pages/css/pricing-table.css');
        echo $this->Html->css('../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css');
        echo $this->Html->css('../assets/global/plugins/fullcalendar/fullcalendar.min.css');
        echo $this->Html->css('../assets/global/plugins/jqvmap/jqvmap/jqvmap.css');
        echo $this->Html->css('../assets/global/plugins/morris/morris.css');
        echo $this->Html->css('../assets/admin/pages/css/tasks.css');
        echo $this->Html->css('../assets/global/css/components-rounded.css');
        echo $this->Html->css('../assets/global/css/plugins.css');
        echo $this->Html->css('../assets/admin/layout4/css/layout.css');
        echo $this->Html->css('../assets/admin/layout4/css/themes/light.css');
        echo $this->Html->css('../assets/admin/layout4/css/custom.css');
        echo $this->Html->css('../assets/admin/pages/css/todo.css');
        echo $this->Html->css('../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css');
        echo $this->Html->css('../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css');
        echo $this->Html->css('../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');
        echo $this->Html->css('../assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min');
        echo $this->Html->css('../assets/global/plugins/select2/select2.css');
        echo $this->Html->css('../assets/admin/pages/css/timeline2015.css');
        echo $this->Html->css('jquery.qtip.min.css');
        echo $this->Html->css('ngDraggable.css');
        echo $this->Html->css('NewClients.application.css');
        echo $this->Html->css('style.css');
        echo $this->Html->css('angular-ui-tree.min');


        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
    </head>
    <body class="page-header-fixed page-sidebar-closed ">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
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
                
                <div style="display: inline-block; padding-top: 30px; color: #5b9bd1; font-size: 14px; font-weight: 600;">
                    <a href="/">
                        Powrót do systemu
                    </a>
                </div>
                
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <?php // echo $this->element('default/menu'); ?>
                <!-- BEGIN PAGE TOP -->               
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <form class="search-form search-form-expanded" action="extra_search.html" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" placeholder="Szukaj..." name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                            </span>
                        </div>
                    </form>
                    <!-- END HEADER SEARCH BOX -->

                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="separator hidden-xs">
                            </li>
                            <?php // echo $this->Element('default/suggestion'); ?>
                            <!--                            <li ng-controller="MessagesInfoCtrl" id="header_notification_bar" class="dropdown dropdown-extended dropdown-dark 
                                                            /*dropdown-notification*/
                                                            ">
                                                            <a ng-mouseover="setMessagesReaded()" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                                                                <i class="icon-bell"></i>
                                                                <span ng-bind="messages.length || 0" class="badge badge-default"></span>
                                                            </a>    
                                                            <ul class="dropdown-menu">
                                                                <li class="external">
                                                                    <h3><strong ng-bind="messages.length || 0"></strong> nowych powiadomień</h3>
                                                                    <a href="/profiles/messages">wszystkie</a>                                         
                                                                </li>
                                                                <li>
                                                                    <div style="position: relative; overflow: hidden; width: auto; max-height: 274px;">
                                                                        <ul data-handle-color="#637283" style="max-height: 274px; overflow: hidden; width: auto;" class="overflow-hidden dropdown-menu-list" data-initialized="1">
                                                                            <li ng-cloak ng-repeat="message in messages">
                                                                                <a href="/profiles/messages">
                                                                                    <span class="time">{{message.Message.received| limitTo : 10}}</span>
                                                                                    <span class="details">
                                                                                        <span ng-class="{'label-success' : message.Message.message_type_id == 1, 'label-warning' : message.Message.message_type_id == 2, 'label-danger' : message.Message.message_type_id == 3}" class="label label-sm label-icon">
                                                                                            <i ng-class="{'fa-check' : message.Message.message_type_id == 1, 'fa-minus' : message.Message.message_type_id == 2, 'fa-close' : message.Message.message_type_id == 3}"  class="fa"></i>
                                                                                        </span>
                                                                                        <span ng-if="message.Message.body.length <= 30">{{message.Message.body}}</span>
                                                                                        <span ng-if="message.Message.body.length > 30">{{message.Message.body| limitTo : 30}} ...</span>
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                        </ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(99, 114, 131); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 121.359px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div> 
                                                                </li>
                                                            </ul>
                                                        </li>-->

                            <li class="separator">
                            </li>
                            <!-- END TODO DROPDOWN -->
                            <?php echo $this->element('default/user_menu'); ?>
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
                                    'Błąd'
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
                            $this->Html->addCrumb('Błąd');
                        ?>
                        <?php echo $this->Html->getCrumbs(' <i class="fa fa-circle"></i> ', array('text' => 'Strona główna', 'escape' => false)); ?> 
                    </ul>
                    <?php echo $this->Session->flash(); ?>
                    <div id="content">
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="page-footer text-center">
            2015 &copy; feb.b2b / Fabryka e-biznesu.
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <?php
        echo $this->Html->script('/new_clients/js/jquery.min.js');
        echo $this->Html->script('/new_clients/js/bootstrap.min.js');
        echo $this->Html->script('/new_clients/js/angular.min.js');
        echo $this->Html->script('/new_clients/js/angular-route.min.js');
        echo $this->Html->script('/new_clients/js/angular-multi-select.js');
        echo $this->Html->script('/new_clients/js/bootbox.min.js');
        echo $this->Html->script('/new_clients/js/ngDialog.min.js');
        echo $this->Html->script('/new_clients/js/ng-table.min.js');
        echo $this->Html->script('/new_clients/js/application.js');
        echo $this->Html->script('/new_clients/js/directives.js');
        echo $this->Html->script('/new_clients/js/services.js');
        echo $this->Html->script('/new_clients/js/filters.js');
        echo $this->Html->script('/new_clients/js/utils.js');
        echo $this->fetch('script');
        ?>
    </body>
</html>
