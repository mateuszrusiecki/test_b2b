<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <title>
            <?php echo $title_for_layout; ?> 
        </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php
		
        //echo $this->Html->css($this->Html->url('/assets/global/plugins/bootstrap/css/bootstrap.min.css',true));
        echo $this->Html->css($this->Html->url('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',true));
        echo $this->Html->css($this->Html->url('/assets/global/plugins/font-awesome/css/font-awesome.min.css',true));
		
        echo $this->Html->css($this->Html->url('/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',true));
        echo $this->Html->css($this->Html->url('/assets/admin/pages/css/profile.css',true));
		echo $this->Html->css($this->Html->url('/css/style.css',true));
        echo $this->Html->css($this->Html->url('/assets/global/css/components-rounded.css',true));
        echo $this->Html->css($this->Html->url('/assets/admin/pages/css/tasks.css',true));
        echo $this->Html->script($this->Html->url('/assets/global/plugins/bootstrap/js/bootstrap.min.js',true));
        echo $this->Html->script($this->Html->url('/assets/global/scripts/metronic.js',true));
		
        echo $this->fetch('meta');
       // echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
<!--		<link rel="stylesheet" type="text/css" media="all" href="http://feb.b2b/assets/global/plugins/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" media="all" href="http://feb.b2b/assets/global/css/components-rounded.css" />-->

        <style>
			.second-silver > div:nth-of-type(2n+1) {
				background: #F5F5F5;
			}

			.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
				position: relative;
				min-height: 1px;
				padding-right: 15px;
				padding-left: 15px;
			}

			.portlet {
				margin-top: 0px;
				margin-bottom: 25px;
				padding: 0px;
				-webkit-border-radius: 4px;
				-moz-border-radius: 4px;
				-ms-border-radius: 4px;
				-o-border-radius: 4px;
				border-radius: 4px;
			}
        </style>
    </head>
    <body class="clearfix">
        <?php echo $this->fetch('content'); ?>
    </body>
</html>