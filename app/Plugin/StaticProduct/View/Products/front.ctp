<?php foreach($products as $product):?>    
<div class="borderBottomBox">
    <div class="doorBoxRight">
            <?php $productlink = array(
                    'plugin' => 'static_product', 
                    'controller' => 'products', 
                    'action' => 'view', 
                    $product['Product']['slug']
                ); ?>
        <?php echo $product['Product']['title']; ?><br />
        <span>€ <?php echo $product['Product']['price']; ?></span>
    </div>
    <?php echo $this->Html->link(__d('public', 'Kaufen') . '&nbsp;»', array('plugin' => 'commerce', 'controller' => 'order_items', 'action' => 'add', $product['Product']['id']), array('class' => 'darkButton', 'escape' => false)); ?>
            <?php echo $this->Image->thumb('/files/photo/' . $product['Photo']['img'], array('width' =>62, 'height' => 150 ,'frame'=>'#ffffff'), array(
                'url'=> $productlink,
                'class' => 'fl'
            )); ?>
</div>  
<?php endforeach; ?>