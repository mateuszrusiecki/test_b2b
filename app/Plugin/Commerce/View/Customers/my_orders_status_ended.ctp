<?php $title = __d('public', 'ZAMÓWIENIA ZREALIZOWANE'); ?>
<?php $this->set('title_for_layout', $title); ?>

<div id="my-account">
    <h1><?php echo $title ?></h1>
    <div class="blueNav">
        <?php echo $this->element('customer/menu'); ?>
    </div>
    <div id="my-account-content">
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th>NR ZAMÓWIENIA</th>
                <th>DATA</th>
                <th>WARTOŚĆ</th>
                <th>SZCZEGÓŁY</th>
            </tr>
            <?php 
            $key =0;
            foreach($this->request->data['Order'] as $order):
            $altrow =  ($key%2 == 0)?'altrow':'';
             ?>
                <tr <?php echo $altrow?'class="'.$altrow.'"':''; ?>>
                    <td><b><?php echo $order['hash']; ?></b></td>
                    <td><?php echo $order['created']; ?></td>
                    <td><?php echo $order['total']; ?> zł</td>
                    <td><?php echo $this->Html->link('Szczegóły', array('action' => 'order_item', $order['id'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>