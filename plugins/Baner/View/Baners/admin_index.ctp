<div class="baners index">
	<h2><?php __('Baners');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('url', __('URL'));?></th>
			<th><?php echo $this->Paginator->sort('name', __('Nazwa'));?></th>
			<th><?php echo $this->Paginator->sort('clicks_counter', __('Ilość kliknięć'));?></th>
			<th><?php echo $this->Paginator->sort('shows_counter', __('Ilość wyświetleń'));?></th>
			<th><?php echo $this->Paginator->sort('group', __('Grupa'));?></th>
			<th><?php echo $this->Paginator->sort('published', __('Publikowany'));?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($baners as $baner):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->link($baner['Baner']['url'], $baner['Baner']['url'], array('target' => '_blank')); ?>&nbsp;</td>
		<td><?php echo h($baner['Baner']['name']); ?>&nbsp;</td>
		<td><?php echo h($baner['Baner']['clicks_counter']); ?>&nbsp;</td>
		<td><?php echo h($baner['Baner']['shows_counter']); ?>&nbsp;</td>
		<td><?php echo h($baner['Baner']['group']); ?>&nbsp;</td>
        
		<td><?php 
            if ($baner['Baner']['published']) { 
                echo "TAK"; 
            } else {
                echo "NIE";
            }
        ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $baner['Baner']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $baner['Baner']['id']), null, __('Are you sure you want to delete # %s?', $baner['Baner']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Baner'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Statystyki'), array('action' => 'baner_stats')); ?></li>
	</ul>
</div>