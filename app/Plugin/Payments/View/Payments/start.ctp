<h1><?php echo __d('public', "Płatność", true); ?></h1>
<div>

    <form id="payformID" action="<?php echo $payment_params['post']['url']; ?>" enctype="multipart/form-data" method="post" name="payform">
        <?php foreach($payment_params['post']['data'] AS $key => $value){ ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
        <?php } ?>
            <input type="hidden" name="js" value="0" />
        
        <?php 
        
        switch($payment_params['payment_gate']){
            case 'platnosci.pl':
                echo '<input class="submit" type="submit" value="Zapłac poprzez Platnosci.pl" />';
                break;
        }
        
        ?>
    </form>

    <script type="text/javascript">
    //<![CDATA[

        document.forms['payform'].js.value=1;
         
        function submitGo(){
            //wysłanie formularza
            $('#payformID')[0].submit();
            $('#payformID .submit').attr('disabled', 'disabled');
        }
        submitGo();
    //]]>
    </script>
        
</div>

