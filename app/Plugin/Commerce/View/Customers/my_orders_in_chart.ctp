<?php $title = __d('public', 'W Koszyku'); ?>
<?php $this->set('title_for_layout', $title); ?>

<div id="my-account">
    <?php echo $this->element('customer/menu'); ?>
    <div id="my-account-content">
        <h1><?php echo $title ?></h1>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th>Data</th>
                <th>Status</th>
                <th>Wartość</th>
                <th>Zapłacono</th>
                <th>Szczegóły</th>
            </tr>
            <?php foreach($this->request->data['Order'] as $order): ?>
                <tr>
                    <td><?php echo $order['created']; ?></td>
                    <td><?php //echo $orderStatuses[$order['order_status_id']]; ?></td>
                    <td><?php echo $order['total']; ?> zł</td>
                    <td><?php //echo $order['paymentTotal']; ?> zł</td>
                    <td>Szczegóły</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>