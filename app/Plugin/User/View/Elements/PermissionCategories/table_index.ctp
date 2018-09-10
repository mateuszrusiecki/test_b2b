<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-suitcase"></i> <?php echo $this->Paginator->sort('name', __d('cms', 'Name')); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
                <th class="actions"><i class="fa fa-cogs"></i> <?php echo __d('cms', 'Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($permissionCategories as $permissionCategory):
                ?>
                <tr data-id="<?php echo $permissionCategory['PermissionCategory']['id']; ?>">
                    <td><?php echo h($permissionCategory['PermissionCategory']['name']); ?>&nbsp;</td>
                    <td><?php echo $this->FebTime->niceShort($permissionCategory['PermissionCategory']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($permissionCategory['PermissionCategory']['modified']); ?></td>
                    <td class="actions text-right">
                        <?php echo $this->Permissions->link('<i class="fa fa-edit font-large" tooltip="Edytuj"></i>', array('action' => 'edit', $permissionCategory['PermissionCategory']['id']), array('escape' => false)); ?>
                        <?php echo $this->Permissions->postLink('<i class="fa fa-close font-large" tooltip="Usuń"></i>', array('action' => 'delete', $permissionCategory['PermissionCategory']['id']), array('escape' => false), __d('cms', 'Usuwanie kategorii uprawnień wiaże się z licznymi powiązaniami masz świadomość tego, że trzeba przeładować ręcznie tabelę uprawnień?', $permissionCategory['PermissionCategory']['name'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>