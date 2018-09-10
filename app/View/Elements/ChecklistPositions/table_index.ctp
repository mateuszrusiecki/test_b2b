<div class="table-scrollable">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-briefcase"></i> <?php echo __d('cms', 'Name'); ?></th>
                <th>
                    <i class="fa fa-calendar"></i> <?php echo __d('cms', 'Created'); ?>
                    <?php //echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?>
                </th>
                <th class="actions"><i class="fa fa-user"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($groups as $group):
                ?>
                <tr data-id="<?php echo $group['Group']['id']; ?>">
                    <td><?php echo h($group['Group']['name']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->FebTime->niceShort($group['Group']['created']); ?>
                        &nbsp;&middot;&nbsp;
                        <?php echo $this->FebTime->niceShort($group['Group']['modified']); ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Permissions->link('<i tooltip="'.__d('public', 'Edytuj dokument').'" class="fa fa-pencil-square  large-icon pull-right"></i>', array('action' => 'view_group', $group['Group']['id']), array('escape' => false)); ?>

                        <?php echo $this->Permissions->link('<i tooltip="'.__d('public', 'Drukuj').'" class="fa fa-print large-icon pull-right"></i> ', array('action' => 'print_group', $group['Group']['id'], 'ext' => 'pdf'), array('escape' => false)); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>