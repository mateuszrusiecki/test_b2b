<?php $order ?>
<?php $title = __d('public', 'PODGLĄD ZAMÓWIENIA NUMER: '.$order['Order']['hash']); ?>
<?php $this->set('title_for_layout', $title); ?>
<?php echo $this->Html->css('cms-print', null, array('inline' => false)) ?>
<?php echo $this->Html->css('configurator', null, array('inline' => false)) ?>

<div id="my-account" class="orders">
    <h1><?php echo $title ?></h1>


        <b>Data utworzenia zamówienia:</b> <?php echo $this->FebTime->niceShort($order['Order']['created']); ?><br/>
        <b>Ostatnia modyfikacja:</b> <?php echo $this->FebTime->niceShort($order['Order']['modified']); ?><br/><br/>

        <table id="order-table" class="noBorder">
            <tr>
                <td>
                    <fieldset id="customer-contact">
                        <legend>Dane Klienta</legend>
                        <?php echo $order['Customer']['contact_person']; ?><br />
                        <?php echo $order['Customer']['email']; ?><br />
                        <?php echo $order['Customer']['phone']; ?><br />
                        
                    </fieldset>
                </td>
                <td>
                    <fieldset>
                        <legend>Status</legend>
                        
                        <?php echo $orderStatuses[$order['Order']['order_status_id']]; ?>  <br />
                        <?php echo $order['Order']['track_number']; ?>  <br />
                        <?php echo $order['Order']['vat']; ?>  <br />
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td>
                    <fieldset id="shipment-metod">
                        <legend>Dane do Wysyłki</legend>
                        <?php echo $order['Order']['address']['name']; ?>  <br />
                        <?php echo $order['Order']['address']['address']; ?>  <br />
                        <?php echo $order['Order']['address']['post_code']; ?> <?php echo $order['Order']['address']['city']; ?>  <br />
                        <?php echo $order['Order']['address']['country_id']; ?>      <br />
                    </fieldset>
                </td>
                <td rowspan="1">
                    <fieldset id="invoice-identities">
                        <legend>Dane do Faktury</legend>
                        <?php echo $order['Order']['invoice_identity']['name']; ?><br />
                        <?php echo $order['Order']['invoice_identity']['address']; ?><br />
                        <?php echo $order['Order']['invoice_identity']['post_code']; ?> <?php echo $order['Order']['invoice_identity']['city']; ?><br />
                        <?php echo $order['Order']['invoice_identity']['country_id']; ?><br />
                        <?php if($order['Order']['invoice_identity']['iscompany'] == 1){ ?>
                            <?php echo __d('commerce', 'NIP: ').$order['Order']['invoice_identity']['nip']; ?><br />
                        <?php } ?>
                        
                    </fieldset>
                </td>
            </tr>
        </table>


    <div class="orders">
            <?php
            $key = 0;
            foreach ($order['OrderItem'] as $orderItem): ?>
                <?php echo $this->element($orderItem['product_plugin'].'.Commerce/OrderItemDetails', array('orderItem' => $orderItem, 'order' => $order)); ?>
            <?php endforeach; ?>
    </div>    
    
    <?php //debug($order); 
    ?>
<table cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?php echo __d('public', 'Summe'); ?></th>
        <th><?php echo __d('public', 'Wartość netto'); ?></th>
        <th><?php echo __d('public', 'Wartość VAT'); ?></th>
        <th><?php echo __d('public', 'Wartość brutto'); ?></th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td><?php echo $this->Number->currency($order['Order']['total']-$order['Order']['total_tax_value'], 'EUR'); ?></td>
            <td><?php echo $this->Number->currency($order['Order']['total_tax_value'], 'EUR'); ?></td>
            <td><?php echo $this->Number->currency($order['Order']['total'], 'EUR'); ?></td>
        </tr>
    </tbody>
</table>
    
    
</div>