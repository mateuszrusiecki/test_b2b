<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pl">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8"/>
        <title><?php echo $title_for_layout; ?> - feb.b2b</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">

        <?php
        echo $this->Html->meta('icon', '/img/layouts/default/feb_ico.png');
        echo $this->Html->meta('keywords', Configure::read('Meta.keywords'));
        echo $this->Html->meta('description', Configure::read('Meta.description'));
        ?>

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <?php
        echo $this->Html->css('/assets/global/plugins/font-awesome/css/font-awesome.min.css');
        echo $this->Html->css('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css');
        echo $this->Html->css('/assets/global/plugins/bootstrap/css/bootstrap.min.css');
        echo $this->Html->css('/assets/global/plugins/uniform/css/uniform.default.css');
        echo $this->Html->css('/assets/admin/pages/css/login3.css');
        echo $this->Html->css('/assets/global/css/components-rounded.css');
        echo $this->Html->css('/assets/global/css/plugins.css');
        echo $this->Html->css('/assets/admin/layout/css/layout.css');
        echo $this->Html->css('/assets/admin/layout/css/themes/default.css');
        echo $this->Html->css('/assets/admin/layout/css/custom.css');

        echo $this->Html->script('/assets/global/plugins/jquery.min.js');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body class="login">
        <div class="logo">
            <a href="/">
                <img src="/img/_logo_email.png" alt=""/>
            </a>
        </div>
        <div class="content">
            <!--Log in screen-->
            <?php echo $this->fetch('content'); ?>
        </div>
        <div class="copyright">
            <table class="dotacja">
                <tr>
                    <td><img src="/uploaded/ue/poig.png" alt='poig' style="max-height: 100px" /></td>
                    <td><img src="/uploaded/ue/efrr.png" alt='efrr' style="max-height: 70px"/></td>
                </tr>
            </table>
            Dotacje na innowacje – inwestujemy w waszą przyszłość <br/>
            2015 &copy; Fabryka e-biznesu.
        </div>

        <!--[if lt IE 9]>
        <script src="../../assets/global/plugins/respond.min.js"></script>
        <script src="../../assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <?php
        echo $this->Html->script('/assets/global/plugins/jquery-migrate.min.js');
        echo $this->Html->script('/assets/global/plugins/bootstrap/js/bootstrap.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery.blockui.min.js');
        echo $this->Html->script('/assets/global/plugins/uniform/jquery.uniform.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery.cokie.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js');
        echo $this->Html->script('/assets/global/plugins/jquery-validation/js/localization/messages_pl.js');
        echo $this->Html->script('/assets/global/plugins/select2/select2.min.js');
        echo $this->Html->script('/assets/global/scripts/metronic.js');
        echo $this->Html->script('/assets/admin/layout/scripts/layout.js');
        echo $this->Html->script('/assets/admin/layout/scripts/demo.js');
        echo $this->Html->script('/assets/global/plugins/backstretch/jquery.backstretch.min.js');
//        echo $this->Html->script('/assets/admin/pages/scripts/login.js');
        echo $this->Html->script('/assets/admin/pages/scripts/login-soft.js');
        ?>
        <script>
            jQuery(document).ready(function () {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                Login.init();
                Demo.init();
                
                $.backstretch([
                    "../../assets/admin/pages/media/bg/5.jpg"
                    ], {
                      fade: 1000,
                      duration: 8000
                }
                );
            });
        </script>
    </body>
</html>