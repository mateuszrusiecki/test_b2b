<script>
    $(document).ready(function() {   
        var data = {}
        data = <?php echo json_encode($this->request->data) ?>;
        gdata = {data : data};
         
        var configm_text = "Faktura została już wygenerowana. Pomimo tego chcesz zmienić zamówienie?";
        //        $('#OrderShipmentPriceNet').val(gdata.data.Order.shipment_price_net);
        //        $('#OrderShipmentPriceGross').val(gdata.data.Order.shipment_price_gross);
        //        

        $('#OrderShipmentPriceGross').change(function(){
            var toSend = {
                data: {
                    Order: {
                        id: gdata.data.Order.id,
                        shipment_price: $(this).val()
                    }
                }
            };
            changeOrder('<?php echo $this->Html->url(array('action' => 'ajaxedit')) ?>', toSend, $('#orders-items'), function(){
            });
            return false;
        });   
            
        $('#shipment_method_id').change(function(){
            var toSend = {
                data: {
                    Order: {
                        id: gdata.data.Order.id,
                        shipment_method_id: $(this).val()
                    }
                }
            };
            changeOrder('<?php echo $this->Html->url(array('action' => 'ajaxedit')) ?>', toSend, $('#orders-items'), function(){
                //                    window.location.reload();                     return false;
            });
            return false;
        });   
            
            
        $('.updatePrices').change(function(){
            //myThis = $(this);
            //console.debug(myThis);
                
            var toSend = {
                data: {
                    Order: {
                        id: gdata.data.Order.id,
                        payment_type: $(this).val()
                    }
                }
            };
            changeOrder('<?php echo $this->Html->url(array('action' => 'ajaxedit')) ?>', toSend, $('#orders-items'), function(){
                //myThis.attr('checked','checked');
                //console.debug(myThis);
            });
            //myThis.attr('checked','checked');
            return true;
        });        
            
            
        $('.ajaxEditDiscount').editable(function(value, settings) {
            if (value > 100) value = 100;
            if (value < 0) value = 0;
                            
            var toSend = {
                data: {
                    Order: {
                        id: gdata.data.Order.id
                    },
                    OrderItem: {
                        id: $(this).parent().attr('orderelement'),
                        discount: value
                    }
                }
            };
            changeOrder('<?php echo $this->Html->url(array('action' => 'ajaxedit')) ?>', toSend, $('#orders-items'))
            return value;
        }, {  
            width: '40px',
            type     : 'textarea',
            submit   : 'OK'
        }); 
        
        $('.ajaxEditQuantity').editable(function(value, settings) {
            var toSend = {
                data: {
                    Order: {
                        id: gdata.data.Order.id
                    },
                    OrderItem: {
                        id: $(this).parent().attr('orderelement'),
                        quantity: value
                    }
                }
            };
            changeOrder('<?php echo $this->Html->url(array('action' => 'ajaxedit')) ?>', toSend, $('#orders-items'))
            return value;
        }, {  
            width: '40px',
            type     : 'textarea',
            submit   : 'OK'
        });
        $('.ajaxEditPrice').editable(function(value, settings) {
     
            var toSend = {
                data: {
                    Order: {
                        id: gdata.data.Order.id
                    },
                    OrderItem: {
                        id: $(this).parent().attr('orderelement'),
                        price: value
                    }
                }
            };            
            changeOrder('<?php echo $this->Html->url(array('action' => 'ajaxedit')) ?>', toSend, $('#orders-items'));
            return value;
        }, {  
            width: '40px',
            type     : 'textarea',
            submit   : 'OK'
        });
            
            
        $('.ajaxEditShipmentDiscount').editable(function(value, settings) {
            
            if (value > 100) value = 100;
            if (value < 0) value = 0;
            var toSend = {
                data: {
                    Order: {
                        id: gdata.data.Order.id,
                        shipment_discount: value
                    }
                }
            };            
            changeOrder('<?php echo $this->Html->url(array('action' => 'ajaxedit')) ?>', toSend, $('#orders-items'));
            return '';
        }, {  
            width: '40px',
            type     : 'textarea',
            submit   : 'OK'
        });
            
        $('.ajaxEditShipmentPriceGross').editable(function(value, settings) {
            var toSend = {
                data: {
                    Order: {
                        id: gdata.data.Order.id,
                        shipment_price: value
                    }
                }
            };            
            changeOrder('<?php echo $this->Html->url(array('action' => 'ajaxedit')) ?>', toSend, $('#orders-items'));
            return '';
        }, {  
            width: '40px',
            type     : 'textarea',
            submit   : 'OK'
        });
            
        $('.ajaxSetAllDiscount').editable(function(value, settings) {
            if (value > 100) value = 100;
            if (value < 0) value = 0;
            var toSend = {
                data: {
                    Order: {
                        id: gdata.data.Order.id,
                        discount: value
                    }
                }
            };            
            changeOrder('<?php echo $this->Html->url(array('action' => 'ajaxedit')) ?>', toSend, $('#orders-items'));
            return '';
        }, {  
            width: '40px',
            type     : 'textarea',
            submit   : 'OK',
            placeholder: 'Kliknij aby ustawić'
        });
            
    });
</script>


<?php echo $this->Html->link(__d('commerce', 'Szczegóły zamówienia'), array('action' => 'view', $this->request->data['Order']['id'])); ?>
<br />
<?php echo $this->Html->link(__d('commerce', 'Specyfikacja zamówienia'), array('action' => 'specification', $this->request->data['Order']['id'])); ?>
<table class="orderItem-table">
    <tr>
        <th><?php echo __d('commerce', 'Nazwa') ?></th>
        <th><?php echo __d('commerce', 'Ilość') ?></th>
        <th><?php echo __d('commerce', 'Cena Netto [PLN]') ?></th>
        <th><?php echo __d('commerce', 'VAT') ?></th>
        <th><?php echo __d('commerce', 'Cena Brutto [PLN]') ?></th>
        <th><?php echo __d('commerce', 'Rabat') ?>&nbsp<span class="ajaxSetAllDiscount"></span>[%]</th>
        <th><?php echo __d('commerce', 'Razem bez rabatu') ?></th>
        <th><?php echo __d('commerce', 'Razem z rabatem') ?></th>
    </tr>
    <?php foreach ($this->request->data['OrderItem'] as $orderItem): ?>
        <?php //debug($this->Html->); ?>
        <?php $priceDetalis = Commerce::calculateByPriceType($orderItem['price'], $orderItem['tax_rate'], 1) ?>

        <tr orderelement ="<?php echo $orderItem['id']; ?>">
            <td><?php echo $orderItem['name']; ?><span class="product-desc"><?php echo isset($orderItem['desc']) ? $orderItem['desc'] : ""; ?></span></td>
            <td class="ajaxEditQuantity"><?php echo $orderItem['quantity']; ?></td>
            <td class="ajaxEditPrice"><?php echo $priceDetalis['price_net']; ?></td>
            <td><?php echo ($orderItem['tax_rate'] * 100) . '%'; ?></td>
            <td><?php echo $this->Number->currency($priceDetalis['price_gross'], 'EUR'); ?></td>
            <td class="ajaxEditDiscount"><?php echo $orderItem['discount']; ?></td>
            <td><?php echo $this->FebNumber->priceFormat(Commerce::getPriceForEachOrderItem($priceDetalis['price_gross'], $orderItem['quantity'])); ?></td>
            <td><b><?php echo $this->FebNumber->priceFormat(Commerce::getPriceForEachOrderItem($priceDetalis['price_gross'], $orderItem['quantity'], $orderItem['discount'])); ?></b></td>
        </tr>
    <?php endforeach ?>
    <?php
    $orderItemPrice = Commerce::getTotalPricesForOrder($this->request->data);
    $shipmentPrices = Commerce::calculateByPriceType($this->request->data['Order']['shipment_price'], $this->request->data['Order']['shipment_tax_rate'], 1, $this->request->data['Order']['shipment_discount']);
    ?>
    <tr>
        <th colspan="2"><?php echo __d('commerce', 'Wysyłka i transport') ?>:</th>
        <td colspan="4"></td>
        <th colspan="1" style="text-align: right"><?php echo __d('commerce', 'Wartość Zamówienia') ?>:</th>
        <td><b><?php echo $this->Number->currency($orderItemPrice['final_price_gross'], 'EUR'); ?></b></td>
    </tr>

    <tr>
        <td colspan="2"><?php echo $this->Form->input('shipment_method_id', array('label' => false, 'id' => 'shipment_method_id', 'options' => $shipmentMethods, 'selected' => $order['shipment_method_id'])); ?></td>
        <td class="ajaxEditShipmentPriceGross" ><?php echo $this->request->data['Order']['shipment_price_net'] ?></td>
        <td><?php echo ($this->request->data['Order']['shipment_tax_rate'] * 100) . '%'; ?></td>
        <td><?php echo $this->Number->currency($shipmentPrices['price_gross'], 'EUR'); ?></td>
        <td class="ajaxEditShipmentDiscount"><?php echo $this->request->data['Order']['shipment_discount']; ?></td>
        <th><?php echo $this->Number->currency($shipmentPrices['price_gross'], 'EUR'); ?></th>
        <th><b><?php echo $this->Number->currency($shipmentPrices['final_price_gross'], 'EUR'); ?></b></th>
    </tr>
    <tr>
        <td colspan="6">
            <div class="radioInline">
                <?php
                $attributes = array('legend' => false, 'class' => 'updatePrices');
                echo $this->Form->radio('Order.payment_type', $paymentTypes, $attributes);
                ?>
            </div>
        </td>
        <th style="text-align: right"><?php echo __d('commerce', 'Do Zapłaty') ?>:</th>
        <?php
        $total = Commerce::getTotalPricesForOrder($this->request->data);
        $total = $total['final_price_gross'];
        ?>
        <td id="total-price" valign="middle"><?php echo $this->FebNumber->priceFormat($total) ?></td>
    </tr>

    <tr>
        <td colspan="7" style="text-align: right"><?php echo __d('commerce', 'Zapłacono') ?>:</td>
        <th><b><?php echo $this->Number->currency($paymentTotal, 'EUR'); ?></b></th>
    </tr>
    <?php if (($total - $paymentTotal) > 0) { ?>
        <tr>
            <td colspan="7" style="text-align: right"><?php echo __d('commerce', 'Pozostało') ?>:</td>
            <th><?php echo $this->FebNumber->priceFormat(($total - $paymentTotal)); ?></th>
        </tr>
    <?php } ?>
</table>

