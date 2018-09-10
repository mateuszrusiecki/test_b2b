<div class="orderPaySelect">
    <?php echo $this->Html->image('layouts/default/gold_padlock.png', array('id' => 'goldPadlock')); ?>
    <div>
        <?php echo $this->Form->radio('Order.payment_type', $paymentTypes, array('legend' => false, 'div' => false, 'separator' => '</div><div class="radio input">', 'class' => 'updatePrices')); ?>
    </div>
</div>