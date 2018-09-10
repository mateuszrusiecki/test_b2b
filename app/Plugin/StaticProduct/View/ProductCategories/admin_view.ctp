<div class="productCategories view">
<h2><?php  echo __('Product Category');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($productCategory['ProductCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($productCategory['ProductCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Parent Id'); ?></dt>
		<dd>
			<?php echo h($productCategory['ProductCategory']['parent_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Lft'); ?></dt>
		<dd>
			<?php echo h($productCategory['ProductCategory']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Rght'); ?></dt>
		<dd>
			<?php echo h($productCategory['ProductCategory']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($productCategory['ProductCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($productCategory['ProductCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product Category'), array('action' => 'edit', $productCategory['ProductCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product Category'), array('action' => 'delete', $productCategory['ProductCategory']['id']), null, __('Are you sure you want to delete # %s?', $productCategory['ProductCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Category'), array('action' => 'add')); ?> </li>
	</ul>
</div>
