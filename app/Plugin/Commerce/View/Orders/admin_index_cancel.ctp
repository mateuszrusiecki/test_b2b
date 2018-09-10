<div class="orders index">
    <h2><?php echo __('Lista zamówień anulowanych'); ?></h2>
    <?php echo $this->Element('Orders/table_index'); ?> 
    <?php echo $this->Element('cms/paginator'); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link('Lista zamówień w trakcie realizacji', array('plugin' => 'commerce', 'admin' => 'admin', 'controller' => 'orders', 'action' => 'index', 1)) ?></li>
        <li><?php echo $this->Html->link('Lista zamówień zrealizowanych', array('plugin' => 'commerce', 'admin' => 'admin', 'controller' => 'orders', 'action' => 'index', 2)) ?></li>
        <li><?php echo $this->Html->link(__('Lista zamówień - w koszykach'), array('action' => 'index_chart', 'plugin' => 'commerce', 'controller' => 'orders')); ?></li>
    </ul>
</div>