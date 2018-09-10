<div class="categories index">
    <?php echo $this->element('Categories/table_index'); ?>
    <?php echo $this->element('cms/paginator'); ?>
</div>
<div class="actions">
	<h3><?php echo  __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></li>
	</ul>
</div>