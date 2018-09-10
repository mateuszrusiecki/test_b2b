<script>
    $(document).ready(function() {   

    });
</script>
<fieldset>
    <legend>Płatności:</legend>
<ul>
    <?php foreach($payments as $k => $payment) { ?>
    <li><?php echo $payment['payment_gate']; ?> - <?php echo $febNumber->priceFormat($payment['amount']); ?> <b>(<?php echo $statuses[$payment['status']]; ?>)</b> <?php echo $payment['payment_date']; ?></li>
    <?php } ?>
</ul>
</fieldset>