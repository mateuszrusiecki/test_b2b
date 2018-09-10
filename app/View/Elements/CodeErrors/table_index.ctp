<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('user_id', __d('cms', 'User Id')); ?></th>
                <th><?php echo $this->Paginator->sort('name', __d('cms', 'Name')); ?></th>
                <th><?php echo $this->Paginator->sort('href', __d('cms', 'Link')); ?></th>
                <th><?php echo $this->Paginator->sort('message', __d('cms', 'Message')); ?></th>
                <th><?php echo $this->Paginator->sort('url', __d('cms', 'Url')); ?></th>
                <th><?php echo $this->Paginator->sort('line', __d('cms', 'Line')); ?></th>
                <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($codeErrors as $codeError):
                ?>
                <tr data-id="<?php echo $codeError['CodeError']['id']; ?>">
                    <td><?php echo h($codeError['Profile']['firstname'].' '.$codeError['Profile']['surname']); ?>&nbsp;</td>
                    <td><?php echo h($codeError['CodeError']['name']); ?>&nbsp;</td>
                    <td><?php echo h($codeError['CodeError']['href']); ?>&nbsp;</td>
                    <td><?php echo h($codeError['CodeError']['message']); ?>&nbsp;</td>
                    <td><?php echo h($codeError['CodeError']['url']); ?>&nbsp;</td>
                    <td><?php echo h($codeError['CodeError']['line']); ?>&nbsp;</td>
                    <td><?php echo $this->FebTime->niceShort($codeError['CodeError']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($codeError['CodeError']['modified']); ?></td>
                    <td class="actions">
                        <?php echo $this->Permissions->link(__('View'), array('action' => 'view', $codeError['CodeError']['id'])); ?>
                        <?php //echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $codeError['CodeError']['id'])); ?>
    <?php //echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $codeError['CodeError']['id']), null, __('Are you sure you want to delete # %s?', $codeError['CodeError']['name'])); ?>
                    </td>
                </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>