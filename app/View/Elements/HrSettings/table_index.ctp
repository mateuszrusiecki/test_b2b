<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-arrows-h"></i> <?php echo __d('public', 'Marża'); ?></th>
                <th><i class="fa fa-eraser"></i> <?php echo __d('public', 'Bufor'); ?></th>
                <th><i class="fa fa-code-fork"></i> <?php echo __d('public', 'Płace It'); ?></th>
                <th><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Host'); ?></th>
                <th><i class="fa fa-user"></i> <?php echo __d('public', 'Login do email'); ?></th>
                <th><i class="fa fa-barcode"></i> <?php echo __d('public', 'Hasło do email'); ?></th>
                <th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($hrSettings as $hrSetting):
                ?>
                <tr data-id="<?php echo $hrSetting['HrSetting']['id']; ?>">
                    <td><?php echo h($hrSetting['HrSetting']['margin']); ?>&nbsp;</td>
                    <td><?php echo h($hrSetting['HrSetting']['buffer']); ?>&nbsp;</td>
                    <td><?php echo h($hrSetting['HrSetting']['it_rate']); ?>&nbsp;</td>
                    <td><?php echo h($hrSetting['HrSetting']['hostname']); ?>&nbsp;</td>
                    <td><?php echo h($hrSetting['HrSetting']['username']); ?>&nbsp;</td>
                    <td><?php echo h($hrSetting['HrSetting']['password']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Permissions->postLink('<i class="fa fa-close large-icon pull-right" tooltip="'.__d('public', 'Usuń').'"></i>', array('action' =>
                            'delete', $hrSetting['HrSetting']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $hrSetting['HrSetting']['hostname'])); ?>
                        <?php echo $this->Permissions->link('<i class="fa fa-eye large-icon pull-right" tooltip="'.__d('public', 'Szybki podgląd').'"></i>', array('action' => 'view', $hrSetting['HrSetting']['id']), array('escape' => false)); ?>
                        <?php echo $this->Permissions->link('<i class="fa fa-pencil-square  large-icon pull-right" tooltip="'.__d('public', 'Edytuj dokument').'"></i>', array('action' => 'edit', $hrSetting['HrSetting']['id']), array('escape' => false)); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>