<h2><span></span><?php echo __d('cms', 'Products'); ?></h2>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th><?php echo $this->Paginator->sort('photo_id', __d('cms', 'Photo Id')); ?></th>
        <th><?php echo $this->Paginator->sort('product_category_id', __d('cms', 'Product Category Id')); ?></th>
        <th><?php echo $this->Paginator->sort('title', __d('cms', 'Title')); ?></th>
        <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php
    foreach ($products as $product):
        ?>
        <tr attrId="<?php echo $product['Product']['id']; ?>">
            <td>
                <?php if(!empty($product['Photo']['img'])):  ?>
                    <?php echo $this->Image->thumb('/files/photo/' . $product['Photo']['img'], array('width' => 100, 'height' => 100)) ?>
                <?php endif;  ?>
            </td>
            <td>
                <?php echo $this->Permissions->link(@$productCategories[$product['Product']['product_category_id']], array('controller' => 'product_categories', 'action' => 'edit', $product['Product']['product_category_id'])); ?>
            </td>
            <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
            <td><?php echo $this->FebTime->niceShort($product['Product']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($product['Product']['modified']); ?></td>
            <td class="actions">
                <?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>
                <?php echo $this->Permissions->link(__('Zdjęcia'), array('plugin' => 'photo', 'controller' => 'photos', 'action' => 'index', 'Product', $product['Product']['id'])); ?>
                
                <div class="button"><?php echo __d('cms', 'Edit'); ?><br />
                    <?php echo $this->Html->div('clearfix', $this->element('Translate.flags/flags', array('url' => array_merge(array('action' => 'edit', $product['Product']['id'])), 'active' => $product['translateDisplay'], 'title' => __d('cms', 'Edit')))); ?>
                </div>
                <?php echo $this->element('Translate.flags/trash', array('data' => $product, 'model' => 'Product')); ?> 
            </td>
        </tr>
    <?php endforeach; ?>
</table>