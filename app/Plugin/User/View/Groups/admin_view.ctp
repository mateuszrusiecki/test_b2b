<?php echo $this->Metronic->portlet('Grupa: ' . $group['Group']['name']); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Usuń %s', 'grupę'), array('action' => 'delete', $group['Group']['id']), array('class' => 'btn btn-sm red btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Edytuj %s', 'grupę'), array('action' => 'edit', $group['Group']['id']), array('class' => 'btn btn-sm blue btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Lista %s', 'grup'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>

</div>
<dl><?php
    $i = 0;
    $class = ' class="altrow"';
    ?>
    <dt<?php if ($i % 2 == 0) echo $class; ?>><?php echo __d('cms', 'Alias'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
        <?php echo $group['Group']['alias']; ?>
        &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class; ?>><?php echo __d('cms', 'Zmodyfikowano'); ?> (<?php echo __d('cms', 'Zmodyfikowano'); ?>)</dt>
    <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
        <?php echo $group['Group']['created']; ?> (<?php echo $group['Group']['modified']; ?>)
        &nbsp;
    </dd>
</dl>
<div class="related">
    <h2><?php echo __d('cms', 'Uprawnienia %s', 'grupy'); ?></h2>
    <?php if (!empty($group['Permission'])): ?>
        <div class="table-scrollable" id="issuesAssignedTo">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th><?php echo __d('cms', 'Id'); ?></th>
                        <th><i class="fa fa-suitcase"></i> <?php echo __d('cms', 'Nazwa'); ?></th>
                        <th><i class="fa fa-calendar"></i> <?php echo __d('cms', 'Zmodyfikowano'); ?></th>
                        <th class="actions"><i class="fa fa-cogs"></i>  <?php echo __d('cms', 'Akcje'); ?></th>
                    </tr>
                </thead>
                <?php
                $i = 0;
                foreach ($group['Permission'] as $permission):
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
                    ?>
                    <tr<?php echo $class; ?>>
                        <td><?php echo $permission['id']; ?></td>
                        <td><?php echo $permission['name']; ?></td>
                        <td><?php echo $permission['modified']; ?></td>
                        <td class="actions">
                            <?php
                            echo $this->Html->link(__d('cms', 'Usuń powiązanie'), array(
                                'controller' => 'permissions',
                                'action' => 'delete_rp',
                                'Group',
                                $group['Group']['id'],
                                $permission['id']
                                    ), null, __d('cms', 'Jesteś pewnien, że chcesz usunąć uprawnienie grupy "%s" do zasobu "%s"?', $group['Group']['name'], $permission['name'])
                            );
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
    <?php echo $this->Html->link(__d('cms', 'Dodaj %s', 'uprawnienie'), array('controller' => 'permissions', 'action' => 'add_rp', 'Group', $group['Group']['id']), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>

