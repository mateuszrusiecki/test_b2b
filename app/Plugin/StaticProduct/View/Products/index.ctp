<?php $this->set('title_for_layout', $categoryName); ?>
<div class="products index clearfix">

    <div id="rightPageColumn">
        <div class="clearfix" id="borderPage">
            <h1><?php echo $categoryName;  ?></h1>
            <div class="clearfix">
                <?php
                foreach ($products as $i => $product) {
                    $class = ($i % 2 == 0) ? ' border' : '';
                    $productLink = array('action' => 'view', $product['Product']['slug']);
                    ?>
                    <div class="halfProduct<?php echo $class; ?>">

                        <div class="clearfix">
                            <?php echo $this->Image->thumb('/files/photo/' . $product['Photo']['img'], array('width' => 100, 'height' => 90, 'crop' => true), array('url' => $productLink)); ?>
                            <div class="contentProduct">
                                <h2><?php echo $this->Html->link($product['Product']['title'], $productLink); ?></h2>
                                <?php echo $this->Text->truncate(strip_tags($product['Product']['content']),300); ?>
                            </div>
                        </div>
                        <?php echo $this->Html->div('moreProduct', $this->Html->link(__d('public', 'więcej'), $productLink), array('escape' => false)); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php echo $this->Element('default/paginator'); ?>
    </div>

    <div id="leftPageColumn">
        <?php echo $this->element('Products/nav_product'); ?>
    </div>
</div>

<?php 
$this->Html->addCrumb($categoryName, $this->here ); 
echo $this->element('default/crumb'); ?>