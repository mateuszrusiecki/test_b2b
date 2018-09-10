<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-calendar"></i> <?php echo __d('cms', 'year'); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo __d('cms', 'month'); ?></th>
                <th><i class="fa fa-calendar-o"></i> <?php echo __d('cms', 'work_hours'); ?></th>
                <th><i class="fa fa-calendar-o"></i> <?php echo __d('cms', 'work_days'); ?></th>
                <th><i class="fa fa-calendar-o"></i> <?php echo __d('cms', 'days_off'); ?></th>
                <th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($workTimes as $workTime):
                ?>
                <tr data-id="<?php echo $workTime['WorkTime']['id']; ?>">
                    <td><?php echo h($workTime['WorkTime']['year']); ?>&nbsp;</td>
                    <td><?php echo h($workTime['WorkTime']['month']); ?>&nbsp;</td>
                    <td><?php echo h($workTime['WorkTime']['work_hours']); ?>&nbsp;</td>
                    <td><?php echo h($workTime['WorkTime']['work_days']); ?>&nbsp;</td>
                    <td><?php echo h($workTime['WorkTime']['days_off']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Permissions->postLink('<i class="fa fa-close large-icon pull-right" tooltip="Usuń"></i> ', array('controller' => 'work_times', 'action' => 'delete', $workTime['WorkTime']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $workTime['WorkTime']['id'])); ?>
                        <?php echo $this->Permissions->link('<i class="fa fa-eye large-icon pull-right" tooltip="Szybki podgląd"></i> ', array('action' => 'view', $workTime['WorkTime']['id']), array('escape' => false)); ?>
                        <?php echo $this->Permissions->link('<i class="fa fa-pencil-square  large-icon pull-right" tooltip="Edytuj dokument"></i>', array('controller' => 'work_times', 'action' => 'edit', $workTime['WorkTime']['id']), array('escape' => false)); ?>
                    </td>
<!--                    <td class="actions">
                        <?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $workTime['WorkTime']['id'])); ?>
                        <?php // echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $workTime['WorkTime']['id'])); ?>
                        <?php // echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $workTime['WorkTime']['id']), null, __('Are you sure you want to delete # %s?', $workTime['WorkTime']['id'])); ?>
                    </td>-->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>