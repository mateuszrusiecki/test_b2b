<?php echo $this->Metronic->portlet(__d('public','Lista działów')); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Lista działów'), array('action' => 'admin_index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Nowy dział'), array('action' => 'admin_add'), array('class' => 'btn btn-sm blue btn-sm margin-bottom pull-right poitnier')); ?>

</div>
<h2><?php echo __d('cms', 'Lista działów'); ?></h2>
<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-suitcase"></i> <?php echo $this->Paginator->sort('name'); ?></th>
                <th class="actions"><i class="fa fa-cogs"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <?php foreach ($sections as $section): ?>
            <tr>
                <td><?php echo h($section['Section']['name']); ?>&nbsp;</td>
                <td class="actions">
                    <?php
                    if (empty($section['User'])) {
                        echo $this->Form->postLink('<i class="fa fa-close  font-large " tooltip="Zamknij"></i>', array('action' => 'delete', $section['Section']['id']), array('escape' => false, 'class' => 'pull-right font-large margin-left-5'), __('Are you sure you want to delete # %s?', $section['Section']['name']));
                    }
                    ?>
                    <?php echo $this->Html->link('<i class="fa fa-edit  font-large " tooltip="Edytuj"></i>', array('action' => 'edit', $section['Section']['id']), array('escape' => false, 'class' => 'pull-right font-large margin-left-5')); ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
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
<?php echo $this->Metronic->portletEnd(); ?>
