<?php $product = json_decode($orderItem['product'], true); ?>
<?php $product_prices = Commerce::calculateByPriceType($orderItem['price'], $orderItem['tax_rate'], 1, $orderItem['discount']); ?>
<td class="photo"><div>
        <?php echo $this->Html->link('usuń', array('action' => 'delete', $orderItem['id']), array('class' => 'deleteFile')); ?>&nbsp;<?php echo $this->Js->writeBuffer(); ?>
        <?php
        echo!empty($product['Photo']['img']) ? $this->Image->thumb('/files/photo/' . $product['Photo']['img'], array('width' => '135', 'height' => '100', 'frame' => '#fff')) : '';
//debug($product);
        echo!empty($product['WindowConfiguration']['id']) ? $this->element('Window.WindowConfigurations/draw', array(
                    'windowConfiguration' => $product,
                    'objectID' => 'mainDraw' . $product['WindowConfiguration']['id'],
                    'destWidth' => 100,
                    'destHeight' => 80,
                )) : '';
        echo!empty($product['FabricStyle']['id']) ? $this->Image->thumb('/files/fabricstyle/' . $product['FabricStyle']['img'], array('width' => '100', 'height' => '80', 'frame' => '#fff')) : '';
        ?>
    </div></td>
<td>
    <?php
    $product = json_decode($orderItem['product']);
    if (isset($product->Product)) {
        echo $this->Image->thumb('/files/product/' . $product->Product->img, array('width' => 100, 'height' => 100));
    } else if(isset($product->Configuration)) {
        echo $this->Image->thumb('/img/layouts/default/default_bunch.png', array('width' => 100, 'height' => 100));
    }
    ?>
    <h2><?php echo $orderItem['name']; ?></h2>
</td>
<td>
    <?php if ($this->action == 'cart' || $this->action == 'quantity') { ?>
        <?php echo $this->Form->input('Order.quantity', array('id' => 'OrderItemQuantity' . $orderItem['id'], 'value' => $orderItem['quantity'], 'type' => 'numeric', 'maxlength' => 2, 'label' => 'x')); /* 'after'=>$this->Html->image('Commerce.commerce/refresh.png', array(
          'onclick' => "quantityUpdate({$orderItem['id']})"
          )) */ ?>
        <script type="text/javascript">
            //<![CDATA[
            $('#<?php echo 'OrderItemQuantity' . $orderItem['id']; ?>').change(function(){
                quantityUpdate(<?php echo $orderItem['id']; ?>)
            });
            //]]>
        </script>
    <?php } else { ?>
        <?php echo $orderItem['quantity']; ?>
    <?php } ?>
</td>
<?php if ($this->action == 'cart' || $this->action == 'quantity' || $this->action == 'order_checkout') { ?>

    <td class="deleteTD">
        <?php echo $this->Number->currency($product_prices['final_price_gross'], 'PLN '); ?>
        <script type="text/javascript">      
            $(function(){
                $('#razem-bez-wysylki').html('<?php echo $this->Number->currency($total, 'PLN '); ?>');
                $('#razem-bez-wysylki').attr('total', '<?php echo $total; ?>');
                updateTotalPrice($('#sendMetodCartForm :radio:checked'));
            });
        </script>
    </td>
<?php } else { ?>
    <td >
        <?php //echo $this->Number->currency($product_prices['final_price_gross'] * $orderItem['quantity'], 'PLN '); ?>    
        <?php echo $this->Number->currency($product_prices['final_price_gross'], 'PLN '); ?>
        <script type="text/javascript">
            $(function(){
                $('#razem-bez-wysylki').html('<?php echo $this->Number->currency($total, 'PLN '); ?>');
                $('#razem-bez-wysylki').attr('total', '<?php echo $total; ?>');
                updateTotalPrice($('#sendMetodCartForm :radio:checked'));
            });
        </script>
    </td>
<?php } ?>
