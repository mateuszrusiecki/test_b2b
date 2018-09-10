<?php
//echo $this->FebHtml->meta('description','',array('inline'=>false));
//echo $this->FebHtml->meta('keywords','',array('inline'=>false));
$this->set('title_for_layout', __d('public', 'Koszyk'));
?>
<?php //echo $this->Html->css('/commerce/css/commerce', null, array('inline' => false))    ?>
<?php //echo $this->Html->css('configurator', null, array('inline' => false))    ?>
<?php //echo $this->Html->css('ui-lightness/jquery-ui-1.8.14.custom', null, array('inline' => false))    ?>
<?php //echo $this->Html->script('jquery-ui-1.8.14.custom.min', array('inline' => false))    ?>
<?php //echo $this->Html->script('/commerce/js/jquery.priceformat');    ?>


<?php
$this->Html->addCrumb('Konfiguracja', '/');
$this->Html->addCrumb('Koszyk', '/');
echo $this->element('default/crumb');
?>

<div class="orders view clearfix">

    <h1><span><?php echo __d('public', 'KOSZYK'); ?></span></h1>
    <?php //echo $this->element('Orders/steps', array('plugin' => 'commerce', 'step' => 1)); ?>

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
                            price = shipments[key].ShipmentMethod.shipment_price;
                        }
                    }
                    $('#razem-z-wysylka').html(((((parseFloat($('#razem-bez-wysylki').attr('total').replace(',', '.').replace(' ',''))+parseFloat(price.replace(',', '.'))).toFixed(2)))+"").replace('.', ','));
                }
                       
                $(function(){
                    $('#razem-z-wysylka').html('<i>Wybierz sposób wysyłki </i>');
       
                    $('.shipment-price').change(function(){
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

            foreach ($shipmentMethods as $k => $value) {
                $img = empty($value['ShipmentMethod']['img']) ? '' : $this->Html->image('/files/shipmentmethod/' . $value['ShipmentMethod']['img']);
                $shipmentMethodOptionsShow[$value['ShipmentMethod']['id']] = $value['ShipmentMethod']['name'] . ' PLN ' . $value['ShipmentMethod']['shipment_price'];
            }
            //debug($shipmentMethodOptionsShow);
            ?>
            <?php echo $this->Form->create('Order'); ?>
            <div class="clearfix">
                <div class="halfBox">
                    <div class="radioType">
                        <?php //echo $this->Form->radio('Order.payment_type', $paymentTypes, array('legend' => false, 'separator' => '</div><div class="radioType">', 'class' => 'updatePrices'));  ?>
                    </div>
                </div>
                <div id="sendMetodCartForm" class="halfBox">
                    <div class="radioType">
                        <?php echo $this->Form->input('Order.shipment_method_id', array('legend' => false, 'type' => 'select', 'options' => $shipmentMethodOptionsShow, 'class' => "shipment-price")); ?>
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
            <?php echo $this->Form->submit('PRZEJDŹ DO ZAMÓWIENIA ›', array('class' => 'orangeButton', 'escape' => false)); ?>
            <?php echo $this->Form->end(); ?>
        </div>
    <?php endif; ?>
    <?php //echo $this->Html->link('<h1 class="green">Dalej</h1>', array('plugin' => 'commerce', 'controller' => 'customers', 'action' => 'add'), array('escape'=>false,'class'=>'fr'));  ?>

</div>