<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-check"></i> <?php echo $this->Paginator->sort('active', __d('cms', 'Active')); ?></th>
                <th><i class="fa fa-suitcase"></i> <?php echo $this->Paginator->sort('name', __d('cms', 'Name')); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('N', __d('cms', 'N')); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('m', __d('cms', 'M')); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('d', __d('cms', 'D')); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('H', __d('cms', 'H')); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('i', __d('cms', 'I')); ?></th>
                <th><i class="fa fa-chain"></i> <?php echo $this->Paginator->sort('url', __d('cms', 'Url')); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
                <th class="actions"><i class="fa fa-cogs"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($crons as $cron):
                ?>
                <tr data-id="<?php echo $cron['Cron']['id']; ?>">
                    <td><?php echo h($cron['Cron']['active']); ?>&nbsp;</td>
                    <td><?php echo h($cron['Cron']['name']); ?>&nbsp;</td>
                    <td><?php echo h($cron['Cron']['N']); ?>&nbsp;</td>
                    <td><?php echo h($cron['Cron']['m']); ?>&nbsp;</td>
                    <td><?php echo h($cron['Cron']['d']); ?>&nbsp;</td>
                    <td><?php echo h($cron['Cron']['H']); ?>&nbsp;</td>
                    <td><?php echo h($cron['Cron']['i']); ?>&nbsp;</td>
                    <td><?php echo h($cron['Cron']['url']); ?>&nbsp;</td>
                    <td><?php echo $this->FebTime->niceShort($cron['Cron']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($cron['Cron']['modified']); ?></td>
                    <td class="actions">
                        <?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $cron['Cron']['id'])); ?>
                        <?php echo $this->Permissions->link('<i class="fa fa-edit font-large" tooltip="Edytuj"></i>', array('action' => 'edit', $cron['Cron']['id']), array('escape' => false)); ?>
                        <?php echo $this->Permissions->postLink('<i class="fa fa-close font-large" tooltip="Usuń"></i>', array('action' => 'delete', $cron['Cron']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $cron['Cron']['name'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>