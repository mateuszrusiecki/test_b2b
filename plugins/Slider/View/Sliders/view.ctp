<div class="sliders view">
<h2><?php  echo __('Slider');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Tiny Name'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['tiny_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Text Color'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['text_color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Button Text'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['button_text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Button Link'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['button_link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Img'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['img']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($slider['Slider']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Slider'), array('action' => 'edit', $slider['Slider']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Slider'), array('action' => 'delete', $slider['Slider']['id']), null, __('Are you sure you want to delete # %s?', $slider['Slider']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sliders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Slider'), array('action' => 'add')); ?> </li>
	</ul>
</div>
