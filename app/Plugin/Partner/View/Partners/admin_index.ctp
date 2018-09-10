<div class="partners index">
	<h2><?php echo __('Partnerzy');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('img');?></th>
			<th><?php echo $this->Paginator->sort('modified');?> / <?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($partners as $partner): ?>
	<tr>
		<td><?php echo h($partner['Partner']['name']); ?>&nbsp;</td>
		<td><?php echo $this->Image->thumb('/files/partner/'.$partner['Partner']['img'], array('width'=>100,'height'=>100)); ?>&nbsp;</td>
		<td><?php echo h($partner['Partner']['modified']); ?> / <?php echo h($partner['Partner']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $partner['Partner']['id'])); ?>
			<div class="button"> Edytuj<br />
                <?php
                 echo $this->Html->div('clearfix',$this->element('Translate.flags/flags', array('url' => array_merge(array('action'=>'edit',$partner['Partner']['id'])),'active' => $partner['translateDisplay'],'title'=>__d('cms','Edytuj') ))); ?>
            </div>
			<?php echo $this->element('Translate.flags/trash', array('data'=>$partner,'model'=>'Partner')); ?> 
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nowy partner'), array('action' => 'add')); ?></li>
	</ul>
</div>
