<?php echo $this->Html->script(array('jquery-ui-1.8.14.custom.min'), array('inline' => false)); ?>
<?php echo $this->Html->css(array('ui-lightness/jquery-ui-1.8.14.custom'), null, array('inline' => false)); ?>

<?php echo $this->Form->create('Payment', array('action' => 'add')); ?>
<fieldset>
    <legend>Płatności</legend>
    <?php
    echo $this->Form->hidden('user_plugin');
    echo $this->Form->hidden('user_model');
    echo $this->Form->hidden('user_row_id');
    echo $this->Form->hidden('related_plugin');
    echo $this->Form->hidden('related_model');
    echo $this->Form->hidden('related_row_id');
    echo $this->Form->hidden('redirect');

    $payment_gate = array('przelew' => 'przelew', 'gotówka' => 'gotówka', 'pobranie' => 'pobranie', 'zwrot' => 'zwrot');
    echo $this->Form->input('payment_gate', array('label' => 'typ płatności', 'options' => $payment_gate));
    echo $this->Form->input('title', array('label' => 'tytuł'));
    echo $this->Form->input('amount', array('label' => 'kwota', 'before' => '&nbsp;zł'));
    echo $this->Form->input('payment_date', array('label' => 'data', 'type' => 'text'));
    ?>
</fieldset>
<?php echo $this->Form->end('zapisz'); ?>
<script type="text/javascript">
    var d = new Date();
    h = d.getHours();
    i = d.getMinutes();
    s = d.getSeconds();
    jQuery( "#PaymentPaymentDate" ).datepicker({ dateFormat: 'yy-mm-dd '+h+':'+i+':'+s });
</script>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link('Lista zamówień w trakcie realizacji', array('plugin' => 'commerce', 'admin' => 'admin', 'controller' => 'orders', 'action' => 'index', 1)) ?></li>
        <li><?php echo $this->Html->link('Lista zamówień zrealizowanych', array('plugin' => 'commerce', 'admin' => 'admin', 'controller' => 'orders', 'action' => 'index', 2)) ?></li>
        <li><?php echo $this->Html->link(__('Lista zamówień - anulowane', true), array('action' => 'index_cancel', 'plugin' => 'commerce', 'controller' => 'orders')); ?></li>
        <li><?php echo $this->Html->link(__('Lista zamówień - w koszykach', true), array('action' => 'index_chart', 'plugin' => 'commerce', 'controller' => 'orders')); ?></li>
    </ul>
</div>