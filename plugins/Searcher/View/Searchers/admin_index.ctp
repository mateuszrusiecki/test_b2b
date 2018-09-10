<div class="searchers index">
    <h2><?php echo __d('cms', 'Lista'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('model'); ?></th>
            <th><?php echo $this->Paginator->sort('row_id'); ?></th>
            <th><?php echo $this->Paginator->sort('selected'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?>&nbsp;║&nbsp;<?php echo $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($searchers as $searcher):
            ?>
            <tr>
                <td><?php echo h($searcher['Searcher']['id']); ?>&nbsp;</td>
                <td><?php echo h($searcher['Searcher']['model']); ?>&nbsp;</td>
                <td><?php echo h($searcher['Searcher']['row_id']); ?>&nbsp;</td>
                <td><?php echo h($searcher['Searcher']['selected']); ?>&nbsp;</td>
                <td><?php echo $this->FebTime->niceShort($searcher['Searcher']['created']); ?>&nbsp;║&nbsp;<?php echo $this->FebTime->niceShort($searcher['Searcher']['modified']); ?></td>
                <td class="actions">
                    <?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $searcher['Searcher']['id'])); ?>
                    <?php echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $searcher['Searcher']['id'])); ?>
                    <?php echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $searcher['Searcher']['id']), null, __('Are you sure you want to delete # %s?', $searcher['Searcher']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->Element('cms/paginator'); ?></div>
