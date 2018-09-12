<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-at"></i> <?php echo $this->Paginator->sort('email', 'Email'); ?></th>
                <th><i class="fa fa-check"></i> <?php echo $this->Paginator->sort('active', 'Aktywny'); ?></th>
                <th><i class="fa fa-users"></i> <?php echo __d('public', 'Grupy') ?></th>
                <th><i class="fa fa-sitemap"></i> <?php echo __d('public', 'Dział') ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('created', 'Zmodyfikowano'); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('modified', 'Ostatnie logowanie'); ?></th>
                <th class="actions"><i class="fa fa-cogs"></i> <?php echo __d('cms', 'Akcje'); ?></th>
            </tr>
        </thead>
        <?php
        $i = 0;

        foreach ($users as $user):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class; ?>>
                <td><?php echo $user['User']['email']; ?>&nbsp;</td>
                <td><?php echo $user['User']['active'] ? 'Tak' : 'Nie'; ?>&nbsp;</td>
                <td>
                    <?php
                    foreach ($user['Group'] AS $group) {
                        echo $group['name'] . '<br />';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (!empty($user['Section'])) {
                        foreach ($user['Section'] AS $section) {
                            echo $section['name'] . '<br />';
                        }
                    } else {
                        echo '-';
                    }
                    ?>
                </td>
                <td><?php echo $user['User']['created']; ?>&nbsp;</td>
                <td><?php echo $user['User']['last_login']; ?>&nbsp;</td>
                <td class="actions">

                    <?php
                    if (!empty($user['Section'][0]) && $user['Section'][0]['name'] == 'Zarząd') {
                        //nie wyświetlam 'zaloguj jako'
                    } else {
                        echo $this->Html->link('<i class="fa fa-users" tooltip="Zaloguj jako"></i>', array('action' => 'login_like', $user['User']['id']), array('escape' => false));
                    }
                    ?>
                    <?php // echo $this->Html->link(__d('cms', 'Szczegóły'), array('action' => 'view', $user['User']['id'])); ?>
                    <?php echo $this->Html->link('<i class="fa fa-edit font-large" tooltip="Edytuj"></i>', array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
                    <?php echo $this->Html->link('<i class="fa fa-minus-circle font-large" tooltip="Dezaktywuj"></i>', array('action' => 'deactivate', $user['User']['id']), array('escape' => false), __d('cms', 'Jesteś pewien, że chcesz dezaktywować użytkownika "%s"?', $user['User']['email'])); ?>
                    <?php echo $this->Html->link('<i class="fa fa-close font-large" tooltip="Usuń"></i>', array('action' => 'delete', $user['User']['id']), array('escape' => false), __d('cms', 'Jesteś pewien, że chcesz usunąć użytkownika "%s"?', $user['User']['email'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>