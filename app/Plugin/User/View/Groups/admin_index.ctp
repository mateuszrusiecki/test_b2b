<?php echo $this->Metronic->portlet('Grupy Użytkowników'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Dodaj %s', 'użytkownika'), array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Dodaj grupę'), array('action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>

    <?php echo $this->Permissions->link(__d('cms', 'Lista %s', 'użytkowników'), array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-sm blue btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Uprawnienia %s', 'grup'), array('controller' => 'permissions', 'action' => 'groups'), array('class' => 'btn btn-sm grey btn-sm margin-bottom pull-right poitnier')); ?>

</div>
<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
        <!--        <th><?php //echo $this->Paginator->sort(__d('cms', ''Kolejność'), 'order');        ?></th> -->
                <th><i class="fa fa-suitcase"></i>  <?php echo $this->Paginator->sort(__d('cms', 'Nazwa'), 'name'); ?></th>
                <th><i class="fa fa-minus"></i>  <?php echo $this->Paginator->sort(__d('cms', 'Alias'), 'alias'); ?></th>
                <th><i class="fa fa-calendar"></i>  <?php echo $this->Paginator->sort(__d('cms', 'Zmodyfikowano'), 'modified'); ?></th>
                <th class="actions"><i class="fa fa-cogs"></i>  <?php echo __d('cms', 'Akcje'); ?></th>
            </tr>
        </thead>
        <?php
        $i = 0;
        foreach ($groups as $group):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class; ?>>
                <td><?php echo $group['Group']['id']; ?>&nbsp;</td>
        <!--        <td><?php //echo $group['Group']['order'];         ?>&nbsp;</td> -->
                <td><?php echo $group['Group']['name']; ?>&nbsp;</td>
                <td><?php echo $group['Group']['alias']; ?>&nbsp;</td>
                <td><?php echo $group['Group']['modified']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link('<i class="fa fa-close font-large margin-left-5 pull-right" tooltip="Usuń"></i>', array('action' => 'delete', $group['Group']['id']), array('escape' => false), __d('cms', 'Jesteś pewien, że chcesz usunąć grupę "%s"?', $group['Group']['name'])); ?>
                    <?php echo $this->Html->link('<i class="fa fa-edit font-large margin-left-5 pull-right" tooltip="Edytuj"></i>', array('action' => 'edit', $group['Group']['id']), array('escape' => false)); ?>
                    <?php echo $this->Html->link('<i class="fa fa-cubes font-large margin-left-5 pull-right" tooltip="Szczegóły"></i>', array('action' => 'view', $group['Group']['id']), array('escape' => false)); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php echo $this->element('cms/paginator'); ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
