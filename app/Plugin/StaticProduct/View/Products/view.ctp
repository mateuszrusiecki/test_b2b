<?php $this->set('title_for_layout', $product['Product']['title']); ?>
<?php echo $this->Html->addCrumb('Produkty', array('action' => 'index')); ?>
<?php echo $this->Html->addCrumb($product['Product']['title'], '/' . $this->params->url, array('id' => 'selected')); ?>

<?php echo $this->Html->script('StaticProduct.zoomy.min', array('inline' => false)); ?>
<?php echo $this->Html->css('StaticProduct.zoomy', null, array('inline' => false)); ?>

<div class="products index clearfix">
    <div id="rightPageColumn">
        <div class="clearfix" id="borderPage">
            <h1><?php echo $product['Product']['title'] ?></h1>
            <div class="clearfix">
                <div class="clearfix">
                    <div class="productRight">
                        <?php //debug($product);  ?>
                        <?php $image = $this->Image->thumb('/files/photo/' . $product['Photo']['img'], array('width' => 230, 'height' => 210, 'crop' => true)); ?>
                        <?php echo $this->Html->link($image, '/files/photo/' . $product['Photo']['img'], array('class' => 'zoom', 'escape' => false));  ?>
                        <div class="colorProductBoxView">
                            <?php if (!empty($product['Product']['pdf'])): ?>
                                <?php echo $this->Html->link(__d('public', 'Pobierz pełna broszurę produktu'), '/files/product/' . $product['Product']['pdf'], array('class' => 'pdf')); ?>
                            <?php endif; ?>
                            <?php echo $this->Html->link(__d('public', 'Wyślij zapytanie'), array('controller'=>'pages','plugin'=>'page','action'=>'view','kontakt'), array('class' => 'list')) ?>
                        </div>
                    </div>
                    <div class="productLeft">
                        <?php echo $product['Product']['tiny_content']; ?>
                    </div>
                </div>
            </div>
            <div class="tabs">
                <ul>

                    <li><?php echo $this->Html->link(__d('public', 'Opis'), '#opis') ?></li>

                    <?php if (!empty($product['Product']['tech'])): ?>
                        <li><?php echo $this->Html->link(__d('public', 'Dane techniczne'), '#dane-techniczne') ?></li>
                    <?php endif; ?>

                    <?php if (!empty($product['Product']['application'])): ?>
                        <li> <?php echo $this->Html->link(__d('public', 'Zastosowania'), '#zastosowania') ?></li>
                    <?php endif; ?>

                    <?php if (!empty($product['Photos'])): ?>
                        <li><?php echo $this->Html->link(__d('public', 'Wygląd produktu'), '#wyglad-produktu') ?></li>
                    <?php endif; ?>

                    <?php if (!empty($accessories)): ?>
                        <li><?php echo $this->Html->link(__d('public', 'Akcesoria'), '#akcesoria') ?></li>
                    <?php endif; ?>

                    <?php if (!empty($simiarProducts)): ?>
                        <li><?php echo $this->Html->link(__d('public', 'Podobne produkty'), '#podobne-produkty') ?></li>
                    <?php endif; ?>

                </ul>


                <?php if (!empty($product['Product']['content'])): ?>
                    <div id="opis">
                        <?php echo $product['Product']['content'] ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($product['Product']['tech'])): ?>
                    <div id="dane-techniczne">
                        <?php echo $product['Product']['tech'] ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($product['Product']['application'])): ?>
                    <div id="zastosowania">
                        <?php echo $product['Product']['application'] ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($product['Photos'])): ?>
                    <div id="wyglad-produktu">
                        <div class="clearfix">
                            <br />
                            <b><?php echo __d('public', 'Zdjęcia produktu'); ?></b>
                            <br /><br />
                            <div class="clearfix productPhoto">
                                <?php
                                foreach ($product['Photos'] as $photo) {
                                    $image = $this->Image->thumb('/files/photo/' . $photo['img'], array('width' => 145, 'height' => 141, 'frame' => '#ffff'));
                                    echo $this->Html->link($image, "/files/photo/" . $photo['img'], array('escape' => false));
                                }
                                ?>
                            </div>
                            <br />
                            <?php echo $product['Product']['layout'] ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($accessories)): ?>
                    <div id="akcesoria">
                        <div class="clearfix">
                            <?php foreach ($accessories as $product): ?>
                                <div class="clearfix halfBox">
                                    <div>
                                        <h2><?php echo $product['Product']['title']; ?></h2>
                                        <?php echo $product['Product']['tiny_content']; ?>
                                    </div>
                                    <?php $image = @$this->Image->thumb('/files/photo/' . $product['Photo']['img'], array('width' => 120, 'frame' => '#ffff'), array('title' => $product['Photo']['title'])); ?>
                                    <?php echo $this->Html->link($image, array('action' => 'view', $product['Product']['slug']), array('escape' => false)); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($simiarProducts)): ?>
                    <div id="podobne-produkty">
                        <div class="clearfix">
                            <?php foreach ($simiarProducts as $product): ?>
                                <div class="clearfix halfBox">
                                    <div>
                                        <h2><?php echo $product['Product']['title']; ?></h2>
                                        <?php echo $product['Product']['tiny_content']; ?>
                                    </div>
                                    <?php $image = @$this->Image->thumb('/files/photo/' . $product['Photo']['img'], array('width' => 120, 'frame' => '#ffff'), array('title' => $product['Photo']['title'])); ?>
                                    <?php echo $this->Html->link($image, array('action' => 'view', $product['Product']['slug']), array('escape' => false)); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <?php echo $this->Html->script('jquery-ui.min'); ?>
    <script type="text/javascript">
        jQuery('.tabs').tabs();
        $(function () {
            $('.zoom').zoomy();
        }(jQuery))
    </script>
    <div id="leftPageColumn">
        <?php echo $this->element('Products/nav_product', array('productCategories' => $productCategories)); ?>
    </div>
</div>
<?php// $this->Fancybox->init('$(".productPhoto a")'); ?>
<?php echo $this->element('default/crumb'); ?>