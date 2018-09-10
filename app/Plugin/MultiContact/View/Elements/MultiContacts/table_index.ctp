<h2><?php echo __d('cms', 'Multi Contacts'); ?></h2>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('label', __d('cms', 'Label')); ?></th>
            <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody class="tableSort">
        <?php
        foreach ($multiContacts as $multiContact):
            ?>
            <tr data-id="<?php echo $multiContact['MultiContact']['id']; ?>">
                <td><?php echo h($multiContact['MultiContact']['label']); ?>&nbsp;</td>
                <td><?php echo $this->FebTime->niceShort($multiContact['MultiContact']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($multiContact['MultiContact']['modified']); ?></td>
                <td class="actions">
                    <?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $multiContact['MultiContact']['id'])); ?>
                    <?php echo $this->Permissions->link(__('Edit'), array('action' => 'edit', $multiContact['MultiContact']['id'])); ?>
                    <?php echo $this->Permissions->postLink(__('Delete'), array('action' => 'delete', $multiContact['MultiContact']['id']), null, __('Are you sure you want to delete # %s?', $multiContact['MultiContact']['label'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript">
    $(function(){
        $("tbody.tableSort").sortable({
            containment: 'parent',
            stop: function(event, ui) {
                var reLocate = {}; 
                $("tbody.tableSort").find('tr').each(function(index, object) {
                    reLocate[index] = $(object).attr('data-id');
                }); 
                $.ajax({
                    url: '<?php echo $this->Html->url(array('action' => 'sort')); ?>',
                    dataType: 'html',
                    type: 'POST',
                    data: {
                        data: {
                            reLocate: reLocate
                        }
                    },
                    error: function(data) {
                        alert('<?php echo __d('cms', 'Wystąpił krytyczny bład, skontaktuj się z administratorem') ?>');
                        location.reload();
                    }
                });
            }
        });
        $("tbody.tableSort").disableSelection();   
    });
</script>