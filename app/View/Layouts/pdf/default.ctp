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
        echo $this->Html->css($this->Html->url('/css/reset.css',true));
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body class="clearfix">
        <?php echo $this->fetch('content'); ?>
    </body>
</html>