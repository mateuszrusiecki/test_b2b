<?php if (!empty($products)): ?>
<div id="table_select">
    <table class="similar_products" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo __d('cms', 'Title'); ?></th>
                <th><?php echo __d('cms', 'Photo Id'); ?></th>
                <th><?php echo __d('cms', 'Action'); ?></th>
            </tr>
            
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr data-id="<?php echo $product['Product']['id']; ?>">
                    <td><?php echo $product['Product']['title'];  ?></td>
                    <td><?php echo $this->Image->thumb('/files/photo/' . $product['Photo']['img'], array('width' => 100, 'height' => 100)) ?></td>
                    <td><?php echo $this->Form->button('X'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif;  ?>