<?php
echo $this->Html->script('/eurocookie/js/cookie.min');
echo $this->Html->css('/eurocookie/css/eurocookie');

?>
<div id="eurociastko"></div>
<?php $openCookieInfo =  $this->Html->link('<strong>cookie i innych technologii</strong>', array('plugin' => 'eurocookie', 'controller' => 'eurocookies', 'action' => 'politykaCookies'), array('class' => 'openCookieInfo', 'escape' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var eurociastko = $.cookie("cookie-zgoda");
        
        if (typeof eurociastko == 'undefined') {
            $("div#eurociastko").html('<div class="inner">Ta strona używa <?php echo $openCookieInfo; ?> .<br /> Korzystając z niej wyrażasz zgodę na ich używanie, zgodnie z aktualnymi ustawieniami przeglądarki. <a class="close" href="#">×</a></div>').slideDown(1500);
            $("div#eurociastko").delegate('a','click',function() {
                $(this).parents('div#eurociastko').slideUp(1000, function() {
                    $.cookie("cookie-zgoda", 1, {
                        expires: 365
                    });
                    $(this).remove();
                });
                return false;
            });
        
        }
    });
</script>

<?php $this->Fancybox->init('$(".openCookieInfo")', array(''), true); ?>
