<script type="text/javascript">
    $(function(){
        var sessionTimeOut = <?php echo CakeSession::$sessionTime - time(); ?> - 60;
 
        setTimeout(function(){
            $.ajax({
                url: '<?php echo $this->Html->url(array('admin' => false, 'plugin' => 'user', 'controller' => 'users', 'action' => 'ajaxlogin')); ?>',
                dataType: 'html',
                type: 'POST',
                success: function(html) {
                    if ($('#contentGradient').length) {
                        $('#contentGradient').html(html);
                    } else {
                        $('body').append(html);
                    }

                }
            });
        }, sessionTimeOut*1000);
    });
</script>