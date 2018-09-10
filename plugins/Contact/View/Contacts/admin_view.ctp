<div class="contacts view">
<h2><?php  echo __('Contact');?></h2>
	<dl>
		<dt><?php echo __d('cms', 'Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Email'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Name'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Show'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['show']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Modified'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('cms', 'Created'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contact'), array('action' => 'edit', $contact['Contact']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contact'), array('action' => 'delete', $contact['Contact']['id']), null, __('Are you sure you want to delete # %s?', $contact['Contact']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contact'), array('action' => 'add')); ?> </li>
	</ul>
</div>
