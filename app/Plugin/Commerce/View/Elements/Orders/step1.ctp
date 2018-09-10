<?php if (!empty($order['OrderItem'])): ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="photo">&nbsp;</th>
                <th><?php echo __d('public', 'Produkt'); ?></th>
                <th><?php echo __d('public', 'Ilość'); ?></th>
                <th><?php echo __d('public', 'Cena'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($order['OrderItem'] as $orderItem):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>  <?php echo 'id="' . 'quantity' . $orderItem['id'] . '"' ?>>
                    <?php echo $this->element('Orders/order_product', array('orderItem' => $orderItem)); ?>
                </tr>
            <?php endforeach; ?>  
        </tbody>     
    </table>

    <?php //echo $this->Fancybox->init('jQuery("a.cartItemDetails")', array(), true); ?>

    <div class="widthCenter">
        <div class="summaryText clearfix" >
            <?php echo __d('public', 'Razem:'); ?>  
            <b>
                <span id="razem-bez-wysylki"></span> 
            </b>
        </div>

        <?php
        $shipmentMethodOptions = array();
        //debug($shipmentMethods);
        foreach ($shipmentMethods as $value) {
            $shipmentMethodOptions[$value['ShipmentMethod']['id']] = array('price' => $value['ShipmentMethod']['final_price_gross'], 'price_on_delivery' => $value['ShipmentMethod']['cash_on_delivery_price'], 'name' => $value['ShipmentMethod']['name'], 'tax_rate' => $value['ShipmentMethod']['tax_rate']);
        }
        //debug($shipmentMethodOptions);
        ?>
        <script type="text/javascript">            
            function updateTotalPrice() {                 
                var shipments =    <?php echo json_encode($shipmentMethods); ?>;
                var selected = $('.shipment-price').val();
                var price = 0;
                for(key in shipments) {
                    if(selected == shipments[key].ShipmentMethod.id) {
                        if($('input[type="radio"]:checked.updatePrices').val() == 0) {
                            price = shipments[key].ShipmentMethod.shipment_price;
                        } else {
                            price = (parseFloat(shipments[key].ShipmentMethod.shipment_price) + parseFloat(shipments[key].ShipmentMethod.cash_on_delivery_price)).toFixed(2);
                        }
                        $('#shipmentCost').text(price);
                        $('#sendMethod').text(shipments[key].ShipmentMethod.name);
                    }
                }
                $('#razem-z-wysylka').html(((((parseFloat($('#razem-bez-wysylki').attr('total').replace(',', '.').replace(' ',''))+parseFloat(price.replace(',', '.'))).toFixed(2)))+"").replace('.', ','));
            }
                                       
            $(function(){
                var payment = <?php echo json_encode($shipmentMethodOptions); ?>;
                //console.debug(payment);

                $('#razem-z-wysylka').html('<i>Wybierz sposób wysyłki </i>');
               
                $('.shipment-price').change(function(){
                    updateTotalPrice();
                });                         
                //console.debug(payment);
                $('.updatePrices').click(function(){
                                                      
                    var paymentType = $(this).val();  
                    if (paymentType == 0) {
                        $('.shipment-price option').each(function(obj, b) {                                    
                            $(b).text(payment[$(b).attr('value')].name + ' PLN ' + parseFloat(payment[$(b).attr('value')].price).toFixed(2).replace(".", ",").replace(',00',''));                           
                        });  
                    } else { // if (paymentType == 1) {
                        $('.shipment-price option').each(function(obj, b){
                            $(b).text(payment[$(b).attr('value')].name + ' PLN ' + (parseFloat(payment[$(b).attr('value')].price_on_delivery) + parseFloat(payment[$(b).attr('value')].price)).toFixed(2).replace(".", ",").replace(',00',''));                            
                        });  
                    }
                    updateTotalPrice();                               
                });
                                       
                updateTotalPrice();
            });
                                    
            function quantityUpdate(id){
                jQuery.ajax({
                    url: '<?php echo $this->Html->url(array('action' => 'quantity')) ?>'+'/'+id,
                    data: jQuery('#quantity'+id+' input').serialize(),
                    dataType: 'html',
                    type: "POST",
                    success: function(data) {
                        jQuery('#quantity'+id).html(data);
                                            
                    }
                });
            }
                                    
        </script>
        <?php
        $shipmentMethodOptionsShow = array();

        //debug($shipmentMethods);

        foreach ($shipmentMethods as $k => $value) {
            $img = empty($value['ShipmentMethod']['img']) ? '' : $this->Html->image('/files/shipmentmethod/' . $value['ShipmentMethod']['img']);
            $shipmentMethodOptionsShow[$value['ShipmentMethod']['id']] = $value['ShipmentMethod']['name'] . ' PLN ' . $value['ShipmentMethod']['shipment_price'];
        }
        ?>

        <h1 class="clearfix blue">
            <div class="halfBox">
                <?php echo __d('public', 'Sposób wysyłki'); ?>
            </div>
        </h1>
        <?php //echo $this->Form->create('Order'); ?>
        <div class="clearfix">

            <div id="sendMetodCartForm" class="halfBox">
                <div class="radioType">
                    <?php echo $this->Form->input('Order.shipment_method_id', array('legend' => false, 'type' => 'select', 'options' => $shipmentMethodOptionsShow, 'class' => "shipment-price")); ?>
                    <?php echo $this->Form->hidden('Order.shipment_price', array('id' => 'shipmentPrice')); ?>
                </div>
            </div>
        </div>
        <div class="summaryText clearfix">
            <?php echo __d('public', 'Do zapłaty:'); ?>  
            <b> <?php echo 'PLN '; ?>
                <span id="razem-z-wysylka"></span> 
                <?php echo __d('public', '(brutto)'); ?>
            </b>
        </div>              
        <?php //echo $this->Form->end(); ?>
    </div>
<?php endif; ?>
<?php //echo $this->Html->link('<h1 class="green">Dalej</h1>', array('plugin' => 'commerce', 'controller' => 'customers', 'action' => 'add'), array('escape'=>false,'class'=>'fr'));  ?>
