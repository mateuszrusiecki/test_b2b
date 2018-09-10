<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <?php /* <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> */ ?>
        <title><?php echo $title_for_layout; ?></title>
    </head>
    <body>
        <?php echo $content_for_layout; ?>
    <style type="text/css">
        /* <![CDATA[ */
        * {
            font-family: Arial;
        }
        p { margin: 0; }
        div.footer{
            min-width: 600px;
            width: 100%;
            float: left;
            clear: left;
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            line-height: 14px;
        }
        div.top{
            padding: 0 2%;
            background: #f28d00;
            height: 30px;
            color: #fff;
            width: 96%;
            padding-top: 9px;
            float: left;
            position: relative;
            z-index: 2;
            line-height: 20px;
        }
        div.top img{
            display: inline-block;
            margin-top: -21px;
            position: relative;
            z-index: 2;
        }
        .fl{
            float: left;
        }
        .fr{
            float: right;
        }
        div.top a{
            color: #fff;
            text-decoration: none;
        }
        div.bottom{
            width: 96%;
            float: left;
            clear: left;
            background: #f4f4f4;
            color: #969696;
            position: relative;
            z-index: 0;
            padding-top: 30px;
            padding-bottom: 20px;
            padding-left: 2%;
            padding-right: 2%;
        }
        div.bottom span{
            color: #000;
            width: 100%;
            float: left;
        }
        div.bottom p{
            margin-top: 5px;
            width: 100%;
            float: left;
        }
        /* ]]> */
    </style>
    <div class="footer">
        <div class="top">
            <a href="http://www.feb.net.pl" class="fl">www.feb.net.pl</a>
            <img src="http://www.b2b-test.febdev.pl/img/feb_mail.png" alt="<?php echo Configure::read('App.AppName'); ?>" />
            <p  class="fr">tel./fax: +48 17 852 92 46</p>
        </div>
        <div class="bottom"> 
            <span><?php echo __d('public', 'System B2B Fabryki e-biznesu') ?></span><br />
            <p>
                <?php echo __d('public', 'Prosimy nie odpowiadać, wiadomość została wygenerowana automatycznie przez system informatyczny Fabryki e-Biznesu Sp. z o. o.') ?>
            </p>
        </div>
    </div>
</html>
