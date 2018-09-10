<?php echo $this->Html->script('/commerce/js/webtoolkit.aim'); ?>
<script type="text/javascript">  
    var messageBlock = { 
            message: ' Ładowanie... <?php echo $this->Html->image('layouts/default/ajax-loader.gif', array('alt' => '...', 'style' => 'vertical-align:middle;display:inline;')); ?>',
            css:  { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                'border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            }  
        };
    
    function completeCallbackUpdate(response, formId) {
        $('#'+formId).parents('tr').unblock();
        $('#'+formId).parents('.fileInfoCont').html(response);
    }
    function completeCallbackNew(response, formId) {
        $('#'+formId).parents('tr').unblock();
        $('#'+formId).parents('td').html(response);
    }
    function startCallbackUpdate(thisForm){
        //console.debug($(thisForm).parent().parent());
        $(thisForm).parents('tr').block(messageBlock);
        /*$(thisForm).parents('.fileInfoCont').parent().parent().block({
            message: '<?php echo $this->Html->image('layouts/default/ajax-loader.gif', array('alt' => '...', 'style' => 'vertical-align:middle;display:inline;')); ?> Ładowanie...',
            css: { border: '0px none', padding: '0px', background: 'transparent' }             
        }); */
    }
    function startCallbackNew(thisForm){
        $(thisForm).parents('tr').block(messageBlock);

    }
</script>
<?php $cartLink = array('plugin' => 'commerce', 'controller' => 'orders', 'action' => 'cart'); ?> 
<div class="cartSmall">
    <?php if(empty($order)): ?>
        <?php $order = $this->Html->requestAction(array('plugin' => 'commerce', 'controller'=>'orders', 'action'=>'mini_cart', 'admin'=>false, 'user' => false)); ?>
    <?php endif; ?>
    <?php if(!empty($order['OrderItem'])): ?>
    <?php //echo $this->Html->link('Koszyk', $cartLink, array('class'=>'fl')); ?> 
    <div class="cartSmallTop">
        <?php echo $this->Html->image('layouts/default/cart_min.png', array('url'=>$cartLink,'class'=>'fr','id'=>'cartMinButton')) ?>
        
        <div class="cartSmallTopBorder">
            <?php 
            $countProd = count($order['OrderItem']);
            echo  $countProd.' '.__n('produkt','produktów',$countProd).'&nbsp;&raquo;'; 
            ?>
        </div>
        <?php $total = Commerce::getTotalPricesForOrder($order); ?>
        <?php echo 'Razem: <span class="orange">'.$febNumber->priceFormat($total['final_price_gross']).'</span>'; ?>
    </div>
        <script type="text/javascript">
        	jQuery('.cartSmallTop a,.cartSmallTopBorder').hover(function(){
        	   jQuery('.cartContentSmall:first').css({'display':'block'});
        	});
        	jQuery('.cartSmall').hover(function(){},function(){
        	   jQuery('.cartContentSmall:first').css({'display':'none'});
        	})
        </script>
    <div class="cartContentSmall br-all">
        <?php foreach($order['OrderItem'] as $orderItem){ 
            $tmpPrice = Commerce::calculateByPriceType($orderItem['price'], $orderItem['tax_rate'], $orderItem['quantity'], $orderItem['discount']); ?>
            <div class="productSmallOrderItem clearfix">
                <?php $product = json_decode($orderItem['product'],true); ?>
                <div class="clearfix productSmallTitle">
                    <div class="fr"><?php echo $febNumber->priceFormat($tmpPrice['final_price_gross']); ?></div>
                    <?php 
                        echo !empty($product['Product']['img'])?$image->thumb($product['Product']['img'],'Product', array('width'=>33 , 'height'=>33)):'';
                        echo $orderItem['name']; 
                    ?>
                </div>
                <span><?php echo ($orderItem['quantity']) ?> <?php __d('public', 'sztuki'); ?> <?php echo $orderItem['desc']; ?></span>
            </div>
        <?php } ?>
        <div class="productSmallOrderItem toCash clearfix">
            <?php echo $this->Html->link('Do kasy »', $cartLink); ?>
        </div>
    </div>
    <?php else: ?>
    <div class="cartSmallTop">
        <?php echo $this->Html->image('layouts/default/cart_min.png', array('class'=>'fr','id'=>'cartMinButton')) ?>
        <div class="cartSmallTopBorder">
            <?php 
            echo  '0 '.__n('produkt','produktów',0); 
            ?>
        </div>
        <?php echo 'Razem: <span class="orange">'.$febNumber->priceFormat(0).'</span>'; ?>
    </div>
     <?php endif; ?>
     
</div>

