<?php $order = $actualOrder; ?>
<?php $title = __d('public', 'PODGLĄD ZAMÓWIENIA NUMER: '.$order['Order']['hash']); ?>
<?php $this->set('title_for_layout', $title); ?>
<?php echo $this->Html->css('ui-lightness/jquery-ui-1.8.14.custom',null, array('inline'=>false)) ?>
<?php echo $this->Html->script('jquery-ui-1.8.14.custom.min', array('inline'=>false)) ?>
<?php echo $this->Html->css('/commerce/css/commerce', null, array('inline' => false)) ?>
<?php echo $this->Html->css('configurator', null, array('inline' => false)) ?>
<div id="my-account" class="orders">
    <h1><?php echo $title ?></h1>
    <div class="blueNav">
        <?php echo $this->element('customer/menu'); ?>
    </div>
    <div class="orders">
        <table cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th><?php echo __d('public', 'Nazwa produktu'); ?></th>
                <th><?php echo __d('public', 'Cena brutto'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $key = 0;
            //jeśli status zam. wskazuje, że pliki już są zaakceptowane - to nie można dodawać nowych
            $deny_adding_files = false;
            if($order['Order']['order_status_id'] > 30 ){
                $deny_adding_files = true;
            }
            foreach ($order['OrderItem'] as $orderItem):
                $class = ($key % 2 == 0) ? ' class="altrow"' : '';
                ++$key;
                ?>
                <tr <?php echo $class; ?>  <?php echo 'id="' . 'quantity' . $orderItem['id'] . '"' ?>>
                    <?php $product = json_decode($orderItem['product'], true); ?>
                    <?php $product_prices = Commerce::calculateByPriceType($orderItem['price'], $orderItem['tax_rate'], 1, $orderItem['discount']); ?>

                    <td class="photo" style="padding: 5px 10px;"><?php 
                    
                    echo!empty($product['Photo']['img']) ? $this->Image->thumb('/files/photo/'.$product['Photo']['img'], array('width' => '135', 'height' => '100','frame'=>'#fff')) : '&nbsp;'; 
                    
                        echo !empty($product['WindowConfiguration']['id'])?$this->element('Window.WindowConfigurations/draw', array(
                            'windowConfiguration' => $product, 
                            'objectID' => 'mainDraw'.$product['WindowConfiguration']['id'],
                            'destWidth' => 129,
                            'destHeight' => 100,
                            )):'';
                        echo !empty($product['FabricStyle']['id'])?$this->Image->thumb('/files/fabricstyle/'.$product['FabricStyle']['img'], array('width' => '135', 'height' => '100','frame'=>'#fff')) :'';
                    
                    ?></td>
                    <td>
                        <h2><?php echo $orderItem['name']; ?></h2>
                        
                        <span class="desc"><?php echo $orderItem['desc']; ?></span>
                    </td>
                    <td>
                        <?php echo ($product_prices['price_gross'] != $product_prices['final_price_gross']) ? '<span class="through">' . $this->FebNumber->priceFormat($product_prices['price_gross']) . '</span><br />' : ''; ?>
                        <?php echo $this->Number->currency($product_prices['final_price_gross'], 'EUR'); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
                
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" style="text-align: right;padding-right: 20px"><?php echo __d('commerce', 'RAZEM:'); ?></th>
                    <th><?php echo $this->Number->currency($order['Order']['total'], 'EUR'); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>    
    
    <div>
        <?php echo $this->Html->link(__d('public', 'Szczegóły zamówienia (do druku)'), array('action' => 'order_details', $order['Order']['id'])); ?>
    </div>
    
</div>