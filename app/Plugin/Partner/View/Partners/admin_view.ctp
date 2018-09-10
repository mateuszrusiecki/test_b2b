<div class="partners view">
<h2><?php  echo __('Partner');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Img'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['img']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Partner'), array('action' => 'edit', $partner['Partner']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Partner'), array('action' => 'delete', $partner['Partner']['id']), null, __('Are you sure you want to delete # %s?', $partner['Partner']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Partners'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Partner'), array('action' => 'add')); ?> </li>
	</ul>
</div>
