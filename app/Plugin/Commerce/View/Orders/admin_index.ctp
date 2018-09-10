<div class="filtruj clearfix">
    <?php echo $this->Filter->formCreate($filtersSettings, array('legend' => 'Status zamówienia', 'submit' => 'szukaj')); ?>
    <?php $this->Paginator->options(array('url' => $filtersParams)); ?>
</div>

<div class="orders index">
    <h2><?php
        echo __d('commerce', 'Lista Zamówień') . ' - ';
        echo ($status == 1) ? "<b>W trakcie realizacji</b>" : "<b>Zrealizowane</b>";
    ?></h2>
    <?php echo $this->Element('Orders/table_index'); ?> 
    <?php echo $this->Element('cms/paginator'); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link('Lista zamówień w trakcie realizacji', array('plugin' => 'commerce', 'admin' => 'admin', 'controller' => 'orders', 'action' => 'index', 1)) ?></li>
        <li><?php echo $this->Html->link('Lista zamówień zrealizowanych', array('plugin' => 'commerce', 'admin' => 'admin', 'controller' => 'orders', 'action' => 'index', 2)) ?></li>
        <li><?php echo $this->Html->link(__('Lista zamówień - anulowane'), array('action' => 'index_cancel', 'plugin' => 'commerce', 'controller' => 'orders')); ?></li>
        <li><?php echo $this->Html->link(__('Lista zamówień - w koszykach'), array('action' => 'index_chart', 'plugin' => 'commerce', 'controller' => 'orders')); ?></li>
    </ul>
</div>